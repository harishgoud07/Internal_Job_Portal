<?php
class Application_models_Utilities{

    private $db;
    public function _construct(){
            $this->db = Zend_Db_Table::getDefaultAdapter();
    }


    function get_user_details(){
        $storage = new Zend_Auth_Storage_Session();
        return  $storage->read();;
    }
}