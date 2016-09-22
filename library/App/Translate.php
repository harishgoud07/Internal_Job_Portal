<?php
class App_Translate
{
	public static function translate($message)
	{
        $translate = Zend_Registry::get('Zend_Translate');
		return $translate->_($message);
	}
}
