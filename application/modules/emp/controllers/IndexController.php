<?php
include_once(APPLICATION_PATH.'/modules/emp/models/DbTable/Login.php');

class Emp_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }
	public function loginAction()
	{
	
		$this->_helper->layout->disableLayout();
		$ses_id=session_id();
		if(empty($ses_id))
		{
			$session=new Zend_Session_Namespace();
			if(isset($session->id))
			{
				$this->_helper->redirector('home','leave');						
			}
		}
	}
	public function loginpostAction()
	{	
		$this->_helper->layout->disableLayout();
		$data= new Model_DbTable_Login();
		if($this->getRequest()->isPost())
		{
			$un=$this->getRequest()->getPost('user');
			$pwd=$this->getRequest()->getPost('pass');
			 
			$check=$data->checkUser($un,$pwd);
			if($check==true)
			{
				$uid=new Model_DbTable_Login();
				$user=$uid->getSessionDetails($un,$pwd);
				$id=$user['user_id'];
				$un=$user['email'];
				$name=$user['name'];
				
							
				
				/*require_once('Zend/Session.php');
 
				$remember = isset($_POST['remember']) && $_POST['remember'];
				$seconds  = 60 * 60 * 24 * 7; // 7 days
 
				if ($remember) {
				Zend_Session::RememberMe($seconds);
				}
				else 
				{
				Zend_Session::ForgetMe();
				}*/
 
				
				$session=new Zend_Session_NameSpace();
				$session->id=$id;
				$session->email=$un;
				$session->name=$name;
							
				
				$this->_helper->redirector('home','leave');			
			}
			else
			{
				$this->view->fail="Wrong username or password";
				$this->render('login');
			}	
		}	
	}
	public function logoutAction()
	{
		Zend_Session::destroy();
			$this->_helper->redirector('login','index');
	}
	public function forgotAction()
	{
		$this->_helper->layout->disableLayout();
	}
}

