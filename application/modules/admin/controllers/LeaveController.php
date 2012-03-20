<?php
include_once(APPLICATION_PATH.'/modules/admin/models/DbTable/Login.php');

class Admin_LeaveController extends Zend_Controller_Action
{
	public function homeAction()
	{
			$session=new Zend_Session_Namespace();
			if(isset($session->id))
			{
				$this->view->email="<b>".$session->email."</b>";	
					
			}
			else
			{
				$this->_helper->redirector('login','index');
			}
	}
	
	public function employeeAction()
	{
		$session=new Zend_Session_Namespace();
			if(isset($session->id))
			{
				$this->view->email="<b>".$session->email."</b>";	
					
			}
			else
			{
				$this->_helper->redirector('login','index');
			}	
	}
	
	public function empPostAction()
	{
		$session=new Zend_Session_Namespace();
			if(isset($session->id))
			{
				$this->view->email="<b>".$session->un."</b>";	
				$this->render('employee');
				
				$data= new Model_DbTable_Employee();
				if($this->getRequest()->isPost())
				{
					$fn=$this->getRequest()->getPost('fname');
					$ln=$this->getRequest()->getPost('lname');
					$email=$this->getRequest()->getPost('lname');
					$gn=$this->getRequest()->getPost('lname');	

					$ins=$data->insertData($fn,$ln,$email,$gn);
				}
					
			}
			else
			{
				$this->_helper->redirector('login','index');
			}
		
	}
	public function viewempAction()
	{
		$session=new Zend_Session_Namespace();
			if(isset($session->id))
			{				
				$this->view->email="<b>".$session->email."</b>";
				$data= new Model_DbTable_Login();
				
				$EmpData=$data->viewEmp();
				$this->view->resultviews = $EmpData;
				$this->render('viewemp');
					
			}
			else
			{
				$this->_helper->redirector('login','index');
			}	
			 
		
	}
	
	public function searchAction()
	{
		
	}
	
	
	public function locationAction()
	{
		$session=new Zend_Session_Namespace();
			if(isset($session->id))
			{
				$this->view->email="You are logged in as <b>".$session->email."</b>";
				
			}
			else
			{
				$this->_helper->redirector('login','index');
			}
	}
	
}