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
	
	
	public function viewEmp()
	{	
	
		$session = new Zend_Session_Namespace(); 
		if (isset($session->id)) 
		{	
			$user = $session->id;
			$query = $this->select()
							->where('user_id='.$user);
			$resultRows = $this->fetchAll($query);
			return $resultRows;
		}
		
		
	}
	
	public function editProfile()
	{
		$session = new Zend_Session_Namespace(); 
		if (isset($session->id)) 
		{	
			$user = $session->id;
			$query = $this->select()
							->where('user_id='.$user);
			$resultRows = $this->fetchAll($query);
			return $resultRows;
		}
	}
	
	public function updateData($name,$bdate,$phoneno,$add,$qf,$jdate,$edate,$gn,$ms,$desg,$email,$pwd,$pan,$status)
	{
		$session=new Zend_Session_Namespace();
		if(isset($session->id))
		{
			$id=$session->id;
		
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
		
		$result=$this->update($data,'user_id='.(int)$id);
	  }
	 
		catch(exception $e){
			echo "<br/>".$e;exit;
			}	 
		}
	}
	
	public function changePassword($op)
	{
		$session=new Zend_Session_Namespace();
		
		if(isset($session->id))
		{
			$id= $session->id;
			
			//$query= $this->select()
						//->where('user_id='.(int)$id);
			
			//$result=$this->fetchAll($query);
			
			$result=$this->fetchRow('user_id="'.(int)$id.'" ');
			
			$pass=$result['password'];
		
			
			if($op==$pass)	{
			
			 $data= array('password'=>$pass);
					try{
					
					$result=$this->update($data,'user_id='.(int)$id);
				}
				
				catch (exception $e) {
					echo "<br/>".$e;exit;
				}
				
			}
				
			
			
		}
	}
}