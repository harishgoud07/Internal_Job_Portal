<?php
class Model_Locales extends Zend_Db_Table_Abstract
{
	protected $_name = 'locales';
	protected $_primary = 'id';

	public function addLocale($locale, $title) {
		$data = array (
			'locale' => $locale,
			'title' => $title,
		);

		return $this->insert($data);
	}

	public function fetchLocales() {
		$select = $this->select()
						->where('active = 1')
						->order('title ASC');
		$results = $this->fetchAll($select);

		if ($results) {
			return $results;
		}

		return false;
	}
}