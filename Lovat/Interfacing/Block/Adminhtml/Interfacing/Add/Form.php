<?php

class Lovat_Interfacing_Block_Adminhtml_Interfacing_Add_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form(array(
			"id" => "edit_form",
			"action" => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('interfacing_id'))),
			"method" => "post",
		));

		$apiKey = Mage::registry('lovat_api_key');
		$fieldset = $form->addFieldset("interfacing_add_form", array('legend' => 'Lovat Api create a new access key'));

		if (!empty($apiKey)) {
			$fieldset->addField('apiKey', 'text', array(
				'label' => Mage::helper('interfacing')->__('Current key'),
				'name' => 'apiKey',
				'value' => $apiKey,
				'disabled' => true,
				'after_element_html' => '<div style="margin: 3px 0;">Your current access key. <span style="font-weight:bold">&#8593;</span></div>',
			));
		}

		$fieldset->addField('key', 'text', array(
			'label' => Mage::helper('interfacing')->__('New key'),
			'required' => true,
			'name' => 'key',
			'value' => substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 40),
			'readonly' => true,
			'after_element_html' => '<div style="margin: 3px 0;">New key. <span style="font-weight:bold">&#8593;</span></div>
									<div style="margin: 15px 0;">Important! If the token exists, the system will replace the existing one with a new one. If there is no token in the system, the token will be generated.</div>
									<div style="margin: 1px 0;">Provide the programmer with the generated access key and API KEY name <span style="font-weight:bold;">x-lovat-api-key</span></div>',
		));

		$form->setUseContainer(true);
		$this->setForm($form);

		return parent::_prepareForm();
	}

}