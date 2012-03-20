<?php

class Model_DbTable_Login extends Zend_Db_Table_Abstract
{
	protected $_name='login';
	
	public function checkUser($un,$pwd)
	{
		$res=$this->fetchRow(array('email="'.$un.'"','password="'.$pwd.'"'));
		
		if($pwd==$res['password'])		
			return true;
		else
			return false;		
	}
	
	public function getSessionDetails($un,$pwd)
	{
		$res=$this->fetchRow(array('email="'.$un.'"','password="'.$pwd.'"'));
		return $res;
	}
	
	public function insertData($fn,$ln,$email,$gn)
	{
		$data = array(
		'firstname'=> $fn,
		'lastname'=> $ln,
        'gender'=> $gn,
		'email'=> $email,
		'phno'=> $phno,
		'fax'=> $fax,
		'user_id'=>$user
		);
		try{
		$result=$this->insert($data);
	  }
	 catch(exception $e){
		echo "<br/>".$e;exit;
	 }	 
	}
	
	public function viewEmp()
	{	
	
		$session = new Zend_Session_Namespace(); 
		if (isset($session->id)) 
		{	
			$user = $session->id;
			$query = $this->select();
			$resultRows = $this->fetchAll($query);
			return $resultRows;
		}
		
		
	}
}