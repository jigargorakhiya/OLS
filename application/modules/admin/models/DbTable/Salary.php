<?php

class Model_DbTable_Salary extends Zend_Db_Table_Abstract
{
	protected $_name='salary';
	
	public function viewsalary()
	{	
		
		$session = new Zend_Session_Namespace(); 
		if (isset($session->id)) 
		{	
			$user = $session->id;
			$select = $this->_db->select()
								->from(array('salary'=>'salary'),array('salary_id','user_id','salarydate','basicsalary','days','tax','tds'))
								->join(array('login'=>'login'),'salary.user_id=login.user_id',array('name','designation'));
								

			$resultsRows = $this->getAdapter()->fetchAll($select);			
			//Zend_Debug::dump($resultsRows);
			return $resultsRows;
		}			
	}
	
	public function getEmp()
	{
		$session=new Zend_Session_Namespace();
		if(isset($session->id))
		{
			$select = $this->_db->select()
								->from(array('salary'=>'salary'),array('user_id'))
								->join(array('login'=>'login'),'login.user_id',array('name','user_id'));
			$resultsRows = $this->getAdapter()->fetchAll($select);			
			
			return $resultsRows;
		}
	}
	
	public function insertData($id,$sdate,$days,$bs,$ma,$ea,$gross,$tax,$tds,$unpaid,$netpay,$bonus)
	{
		$data = array(
		'user_id'=> $id,
		'salarydate'=> $sdate,
        'days'=> $days,
		'basicsalary'=> $bs,
		'medicalallowance'=> $ma,
		'extraallowance'=> $ea,
		'grosspay'=> $gross,
		'tax'=> $tax,
        'tds'=> $tds,
		'unpaidleave'=> $unpaid,
		'netpay'=> $netpay,
		'bonus'=>$bonus
		);
		try{
		$result=$this->insert($data);
	  }
	 catch(exception $e){
		echo "<br/>".$e;exit;
	 }	 
	}
	
	public function salaryDetails($sid)
	{	
		$session = new Zend_Session_Namespace(); 
		if (isset($session->id)) 
			{	
				$select = $this->_db->select()
								->from(array('salary'=>'salary'),array('salary_id','user_id','salarydate','basicsalary','days','medicalallowance','extraallowance',
											 'grosspay','tax','tds','unpaidleave','netpay','bonus'))
								->join(array('login'=>'login'),'salary.user_id=login.user_id',array('name','designation'))
								->where('salary_id=?',$sid);								
				$resultsRows = $this->getAdapter()->fetchAll($select);			
			//Zend_Debug::dump($resultsRows);
				return $resultsRows;				
			}
	}
	
	public function deleteSalary($sid)
	{
	
		$session = new Zend_Session_Namespace(); 
		if (isset($session->id)) 
		{
			$db = Zend_Db_Table::getDefaultAdapter();
			$where = $db->quoteInto('salary_id = ?', (int)$sid);
			$db->delete('salary', $where);
		}
	}
	
	public function searchSalary($name)
	{
		$session = new Zend_Session_Namespace(); 
		if (isset($session->id)) 
		{	
			$user = $session->id;
			
			$select = $this->_db->select()
								->from(array('salary'=>'salary'),array('salary_id','user_id','salarydate','basicsalary','days','medicalallowance','extraallowance',
											 'grosspay','tax','tds','unpaidleave','netpay','bonus'))
								->join(array('login'=>'login'),'salary.user_id=login.user_id',array('name','designation'))
								->where('name LIKE ?', $name.'%');
								

			$resultsRows = $this->getAdapter()->fetchAll($select);			
			//Zend_Debug::dump($resultsRows);
			return $resultsRows;
		}	
		
	}
	
}