<?php

class Model_DbTable_Leave extends Zend_Db_Table_Abstract
{
	protected $_name='leave';
	
	public function viewLeave()
	{	
	
		$session = new Zend_Session_Namespace(); 
		if (isset($session->id)) 
		{	
			$user = $session->id;
			/*$query = $this->select();
			$resultRows = $this->fetchAll($query);
			return $resultRows;*/
			$select = $this->_db->select()
								->from(array('leave'=>'leave'),array('leave_id','user_id','fromdate','todate','daycount','reason','status'))
								->join(array('login'=>'login'),'leave.user_id=login.user_id',array('name','designation'));
								

			$resultsRows = $this->getAdapter()->fetchAll($select);			
			//Zend_Debug::dump($resultsRows);
			return $resultsRows;
		}	
		
	}
	
	public function leave($LeaveId)
	{
			$session = new Zend_Session_Namespace(); 
		if (isset($session->id)) 
		{
			/*$query = $this->select()
					->where('leave_id='.$LeaveId);
			$resultRows = $this->fetchAll($query);
			return $resultRows;*/
			
			$select = $this->_db->select()
								->from(array('leave'=>'leave'),array('leave_id','user_id','fromdate','todate','daycount','reason','status'))
								->join(array('login'=>'login'),'leave.user_id=login.user_id',array('name','designation'))
								->where('leave_id=?',$LeaveId);
								
			$resultsRows = $this->getAdapter()->fetchAll($select);			
			//Zend_Debug::dump($resultsRows);
			return $resultsRows;
		}
	}
	
	public function deleteLeave($LeaveId)
	{
		$session = new Zend_Session_Namespace(); 
		if (isset($session->id)) 
		{
			$db = Zend_Db_Table::getDefaultAdapter();
			$where = $db->quoteInto('leave_id = ?', (int)$LeaveId);
			$db->delete('leave', $where);
		}
	}
	
	public function searchLeave($name)
	{
		$session = new Zend_Session_Namespace(); 
		if (isset($session->id)) 
		{	
			$user = $session->id;
			
			$select = $this->_db->select()
								->from(array('leave'=>'leave'),array('leave_id','user_id','fromdate','todate','daycount','reason'))
								->join(array('login'=>'login'),'leave.user_id=login.user_id',array('name','designation'))
								->where('name LIKE ?', $name.'%');
								

			$resultsRows = $this->getAdapter()->fetchAll($select);			
			//Zend_Debug::dump($resultsRows);
			return $resultsRows;
		}	
		
	}
	
	public function updateLeaveStatus($lid,$status)
	{
		$data=array(
		'status'=>$status
		);
		
		try {
			$this->update($data,'leave_id='.(int)$lid);
		}
		 catch(exception $e){
		echo "<br/>".$e;exit;
		}	 
	}
}
	

