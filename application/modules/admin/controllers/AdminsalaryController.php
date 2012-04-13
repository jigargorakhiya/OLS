<?php
include_once(APPLICATION_PATH.'/modules/admin/models/DbTable/Salary.php');

class Admin_AdminsalaryController extends Zend_Controller_Action
{
	public function viewsalaryAction()
	{
		$session=new Zend_Session_Namespace();
		if(isset($session->id))
		{
			$this->view->name="<b>".$session->name."</b>";
			$data=new Model_DbTable_Salary();
			$SalaryData=$data->viewSalary();
			
			$this->view->resultviews=$SalaryData;			
			$this->render('viewsalary');//print_r($SalaryData);exit;
			
		}
		else
		{
			$this->_helper->redirector('login','index');
		}
	}
	
	
	public function createsalaryAction()
	{
		$session=new Zend_Session_Namespace();
		if(isset($session->id))
		{
			$this->view->name="<b>".$session->name."</b>";
			$data=new Model_DbTable_Salary();
			$emp=$data->getEmp();	
			$this->view->resultviews=$emp;
			$this->render('createsalary');
		}
		else
		{
			$this->_helper->redirector('login','index');
		}
	}
	public function salaryAction()
	{
		$session=new Zend_Session_Namespace();
			if(isset($session->id))
			{				
				$this->view->email="<b>".$session->email."</b>";
				
				$sid=$this->_request->getParam('salary_id');
				
				$data=new Model_DbTable_Salary();
				$salary=$data->salaryDetails($sid);
				$this->view->resultviews = $salary;
				$this->render('salary');
					
			}
			else
			{
				$this->_helper->redirector('login','index');
			}	
	}
	
	public function insertsalarydetailsAction()
	{
		$session=new Zend_Session_Namespace();
		if(isset($session->id))
		{
				
				if($this->getRequest()->isPost())
				{
					$data= new Model_DbTable_Salary();
					$id=$this->getRequest()->getPost('name');
					
					
					$sday=$this->getRequest()->getPost('sday');
					$smnth=$this->getRequest()->getPost('smonth');
					$syear=$this->getRequest()->getPost('syear');					
					$sdate=$syear."-".$smnth."-".$sday;
					
					$days=$this->getRequest()->getPost('days');
					$bs=$this->getRequest()->getPost('basicsalary');	
					$ma=$this->getRequest()->getPost('medical');
					$ea=$this->getRequest()->getPost('extra');
					$gross=$this->getRequest()->getPost('grosspay');
					$tax=$this->getRequest()->getPost('tax');
					$tds=$this->getRequest()->getPost('tds');
					$unpaid=$this->getRequest()->getPost('unpaidleave');
					$netpay=$this->getRequest()->getPost('netpay');
					$bonus=$this->getRequest()->getPost('bonus');				
					
					$ins=$data->insertData($id,$sdate,$days,$bs,$ma,$ea,$gross,$tax,$tds,$unpaid,$netpay,$bonus);
					
					
					$this->_helper->redirector('viewsalary', 'adminsalary');
					exit;
				}
				else
				{
					$this->_helpert->redirector('login','index');
				}
		}
	}
	
	public function deleteAction()
	{
		$session=new Zend_Session_Namespace();
		if(isset($session->id))
		{
			$sid=$this->_request->getParam('salary_id');
			
			$data=new Model_DbTable_Salary();
			$data->deleteSalary($sid);
			$this->_helper->redirector('viewsalary','adminsalary');
			exit;
		}
		else
		{
			$this->_helper->redirector('login','index');
		}
	}
	public function searchsalaryAction()
	{
	
			$session=new Zend_Session_Namespace();
			if(isset($session->id))
			{
				$this->view->name="<b>".$session->name."</b>";
				
				$name=$this->getRequest()->getPost('name');				
				$data = new Model_DbTable_Salary();
				
				$search=$data->searchSalary($name);								
				$this->view->resultviews=$search;				
				$this->render('searchsalary');				

			}
			else
			{
				$this->_helper->redirector('login','index');
			}
	}
}
?>