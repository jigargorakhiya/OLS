<?php

class Model_DbTable_Login extends Zend_Db_Table_Abstract
{
	protected $_name='login';
	
	public function checkUser($un,$pwd)
	{
		
		$res=$this->fetchRow(array('email="'.$un.'"','password="'.$pwd.'"'));
		
		if($pwd==$res['password'] && $res['isAdmin']==1)		
			return true;
		else
			return false;

			
			
	}
	
	public function getSessionDetails($un,$pwd)
	{
		$res=$this->fetchRow(array('email="'.$un.'"','password="'.$pwd.'"'));
		return $res;
	}
	
	public function insertData($name,$bdate,$phoneno,$add,$qf,$jdate,$edate,$gn,$ms,$desg,$email,$pwd,$pan,$status)
	{
		$data = array(
		'name'=> $name,
		'birthdate'=> $bdate,
        'phoneno'=> $phoneno,
		'address'=> $add,
		'qualification'=> $qf,
		'joiningdate'=> $jdate,
		'endingdate'=> $edate,
		'gender'=> $gn,
		'maritalstatus'=> $ms,
        'designation'=> $desg,
		'email'=> $email,
		'password'=> $pwd,
		'pancardno'=>$pan,
		'status'=> $status
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
	public function empClass($empid)
	{
			$session = new Zend_Session_Namespace(); 
		if (isset($session->id)) 
		{
			$query = $this->select()
					->where('user_id='.$empid);
			$resultRows = $this->fetchAll($query);
			return $resultRows;
		}
	}
	
	public function editEmp($empid)
	{
			$session = new Zend_Session_Namespace(); 
		if (isset($session->id)) 
		{
			$query = $this->select()
					->where('user_id='.$empid);
			$resultRows = $this->fetchAll($query);
			return $resultRows;
		}
	}
	
	public function updateData($eid,$name,$bdate,$phoneno,$add,$qf,$jdate,$edate,$gn,$ms,$desg,$email,$pwd,$pan,$status)
	{
		$data = array(
		'name'=> $name,
		'birthdate'=> $bdate,
        'phoneno'=> $phoneno,
		'address'=> $add,
		'qualification'=> $qf,
		'joiningdate'=> $jdate,
		'endingdate'=> $edate,
		'gender'=> $gn,
		'maritalstatus'=> $ms,
        'designation'=> $desg,
		'email'=> $email,
		'password'=> $pwd,
		'pancardno'=>$pan,
		'status'=> $status
		);
		
		try{
		$result=$this->update($data,'user_id='.(int)$eid);
	  }
	 
	 catch(exception $e){
		echo "<br/>".$e;exit;
	 }	 
	}
	
	public function deleteEmployee($eid)
	{
		$session = new Zend_Session_Namespace(); 
		if (isset($session->id)) 
		{
			$db = Zend_Db_Table::getDefaultAdapter();
			$where = $db->quoteInto('user_id = ?', (int)$eid);
			$db->delete('login', $where);
		}
	}
	
	public function searchEmp($name)
	{
		$session = new Zend_Session_Namespace(); 
		if (isset($session->id)) 
		{
			
			$query= $this->select()
						  ->where('name LIKE ?', $name.'%');
			
			$rows = $this->fetchAll($query);			
			return $rows;
		}			
			
		
	}
	
}