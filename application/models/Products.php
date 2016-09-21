<?php
class Model_Products extends Zend_Db_Table_Abstract
{
	protected $_name = 'products';
	protected $_primary = 'id';

	public function addProduct($title, $description = "", $order = 0) {
		$data = array (
			'title' => $title,
			'description' => $description,
			'order' => $order
		);

		return $this->insert($data);
	}

	public function fetchProducts($number = 0, $order = "title") {
		if (!$number = (int) $number) {
			$number = 25;
		}

		$select = $this->select()
						->order('order ASC')
						->limit($number, 0);
		$results = $this->fetchAll($select);

		if ($results) {
			return $results;
		}

		return false;
	}
}