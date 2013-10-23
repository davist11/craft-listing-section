<?php

namespace Craft;

class ListingSection_ListingSectionFieldType extends BaseFieldType
{
	public function getName()
	{
		return Craft::t('Listing Section');
	}

	public function getInputHtml($name, $value)
	{
		return craft()->templates->render('listingsection/select', array(
			'name' => $name,
			'value' => $value,
			'options' => $this->_getSections()
		));
	}

	private function _getSections()
	{
		$sections = craft()->db->createCommand()
					->select('handle, name')
					->from('sections')
					->order('name')
					->queryAll();

		return $sections;
	}
}