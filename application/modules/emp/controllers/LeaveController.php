<?php
include_once(APPLICATION_PATH.'/modules/emp/models/DbTable/Login.php');

class Emp_LeaveController extends Zend_Controller_Action
{
	public function homeAction()
	{
			$session=new Zend_Session_Namespace();
			if(isset($session->id))
			{
				$this->view->name="<b>".$session->name."</b>";	
					
			}
			else
			{
				$this->_helper->redirector('login','index');
			}
	}	
					
	public function viewprofileAction()
	{
		$session=new Zend_Session_Namespace();
			if(isset($session->id))
			{				
				$this->view->name="<b>".$session->name."</b>";
				
				$data= new Model_DbTable_Login();
				
				
				$EmpData=$data->viewEmp();
				
				$this->view->resultviews = $EmpData;
				$this->render('viewprofile');
					
			}
			else
			{
				$this->_helper->redirector('login','index');
			}	
			 
		
	}
	
	
	
	public function updateprofileAction()
	{
		$session=new Zend_Session_Namespace();
			if(isset($session->id))
			{
				$this->view->name="<b>".$session->name."</b>";	
				$this->render('editprofile');
				
				$data= new Model_DbTable_Login();
				if($this->getRequest()->isPost())
				{
					$name=$this->getRequest()->getPost('name');
					
					$bday=$this->getRequest()->getPost('bday');
					$bmnth=$this->getRequest()->getPost('bmonth');
					$byear=$this->getRequest()->getPost('byear');					
					$bdate=$byear."-".$bmnth."-".$bday;			
					
					$jday=$this->getRequest()->getPost('jday');
					$jmnth=$this->getRequest()->getPost('jmonth');
					$jyear=$this->getRequest()->getPost('jyear');
					$jdate=$jyear."-".$jmnth."-".$jday;
					
					$eday=$this->getRequest()->getPost('eday');
					$emnth=$this->getRequest()->getPost('emonth');
					$eyear=$this->getRequest()->getPost('eyear');					
					$edate=$eyear."-".$emnth."-".$eday;
					
					$phoneno=$this->getRequest()->getPost('phoneno');
					$add=$this->getRequest()->getPost('add');	
					$qf=$this->getRequest()->getPost('qf');
					$jod=$this->getRequest()->getPost('jod');
					$email=$this->getRequest()->getPost('email');
					$pwd=$this->getRequest()->getPost('pwd');
					$gn=$this->getRequest()->getPost('gender');
					$ms=$this->getRequest()->getPost('ms');
					$desg=$this->getRequest()->getPost('desig');
					$status=$this->getRequest()->getPost('status');
					$pan=$this->getRequest()->getPost('pancard');				
					
					
					$ins=$data->updateData($name,$bdate,$phoneno,$add,$qf,$jdate,$edate,$gn,$ms,$desg,$email,$pwd,$pan,$status);				
					
					$this->_helper->redirector('viewprofile', 'Leave');
					exit;				
					
				}
					
			}
			else
			{
				$this->_helper->redirector('login','index');
			}
		
	}
	public function empclassAction()
	{
		$session=new Zend_Session_Namespace();
			if(isset($session->id))
			{				
				$this->view->email="<b>".$session->email."</b>";
				
				$empid=$this->_request->getParam('id');
				$data= new Model_DbTable_Login();
				
				$emp=$data->empClass($empid);
				$this->view->resultviews = $emp;
				$this->render('empclass');
					
			}
			else
			{
				$this->_helper->redirector('login','index');
			}	
	}
	
	public function editprofileAction()
	{
		$session=new Zend_Session_Namespace();
			if(isset($session->id))
			{				
				$this->view->email="<b>".$session->email."</b>";
				
				
				$data= new Model_DbTable_Login();
				
				$emp=$data->editProfile();
				$this->view->resultviews = $emp;
				$this->render('editprofile');
					
			}
			else
			{
				$this->_helper->redirector('login','index');
			}	
	}
	
	public function changepassAction()
	{
		
	}
	
	public function changepasspostAction()
	{
		$session=new Zend_Session_Namespace();
		if(isset($session->id))
		{
			$this->view->name="<b>".$session->name."</b>";
			$data=new Model_DbTable_Login();
			
			$op=$this->getRequest()->getPost('old_pass');
			$np=$this->getRequest()->getPost('pass');
			$cp=$this->getRequest()->getPost('cp');
			
			if($np==$cp)
			{
				$chpass=$data->changePassword($op);	
				$this->view->success=
			}
			
			else
			{
				$this->view->newpassword="New Password and Confirm password do not match";
				$this->render('changepass');
			}

		
			
			
			
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