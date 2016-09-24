<?php
class Application_models_LoginRequests{

    private $db;
    public function _construct(){
            $this->db = Zend_Db_Table::getDefaultAdapter();
    }


    function get_login_requets($values){
       $utilities = new Application_models_Utilities();
       $user_details = $utilities->get_user_details();
      $get_login_request_query =  $this->db->select()
          ->from(array('emp'=>'ijp_employees_list'))
          ->join(array('request'=>'ijp_login_requests'),'emp.eid=request.eid')
          ->where('user_role = ?',$user_details['user_role'])
          ->where('eid = ?',$user_details['eid'])
          ->where('status = ?','P')
          ->order('request.date_of_creation desc');

          return $this->db->fetchAll($get_login_request_query);

       
    }

    function update_login_request_status($values){
        $this->upadte('ijp_login_requests',array('status'=>$values['status'],'date_of_modification'=>new Zend_Db_Expr('now()')),array('request_id =?'=>$values['request_id']));
    }

    function store_login_request($values){
        $insert_login_request_values ['eid'] = $values['last_inserted_emp_id'];
        $insert_login_request_values ['status'] = 'P';
         $insert_login_request_values ['date_of_creation'] = new Zend_Db_Expr('now()');
        $insert_login_request_values ['date_of_modification'] = new Zend_Db_Expr('now()');
$this->db->insert('ijp_login_requests',$insert_login_request_values);
    }
}