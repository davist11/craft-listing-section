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
		return craft()->templates->render('_includes/forms/select', array(
			'name' => $name,
			'value' => $value,
			'options' => $this->_getSections($this->getSettings()->sections != '*')
		));
	}

	public function getSettingsHtml()
	{
		return craft()->templates->render('listingsection/fieldsettings', array(
			'sections' => $this->_getSections(),
			'settings' => $this->getSettings()
		));
	}

	protected function defineSettings()
	{
		return array(
			'sections' => AttributeType::Mixed
		);
	}

	private function _getSections($filtered = false)
	{
		$sections = craft()->db->createCommand()
					->select('handle as value, name as label')
					->from('sections')
					->order('name');

		if($filtered)
		{
			$sections = $sections->where(array('in', 'handle', $this->getSettings()->sections));
		}

		return $sections->queryAll();
	}
}
