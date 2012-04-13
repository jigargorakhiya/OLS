<?php

class Model_DbTable_Leave extends Zend_Db_Table_Abstract
{
	protected $_name='leave';
	
	public function insertLeave($id,$fdate,$tdate,$dayCount,$res)
	{
		$data = array(
		'user_id'=> $id,
		'fromdate'=> $fdate,
		'todate'=> $tdate,
		'daycount'=>$dayCount,
        'reason'=> $res
		);
		
		try{
		$result=$this->insert($data);
		return true;
	  }
	 catch(exception $e){
		echo "<br/>".$e;exit;
	 }	 
	}
	
	public function viewLeave($eid)
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
								->where('user_id='.$user);
								

			$resultsRows = $this->getAdapter()->fetchAll($select);			
			//Zend_Debug::dump($resultsRows);
			return $resultsRows;
		}	
	}
}