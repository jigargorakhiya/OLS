<?php
include_once(APPLICATION_PATH.'/modules/emp/models/DbTable/Leave.php');
require_once ('Zend/Mail.php');

// Create transport
require_once ('Zend/Mail/Transport/Smtp.php');

class Emp_LdController extends Zend_Controller_Action
{
	public function applyleaveAction()
	{
		$session=new Zend_Session_Namespace();
		if(isset($session->id))
		{
			$this->view->name="<b>".$session->name."</b>";
		}
	}
	
	public function applyleavepostAction()
	{
		$session=new Zend_Session_Namespace();
		if(isset($session->id))
		{
			$id=$session->id;
			$Email_From=$session->email;
			$this->view->name="<b>".$session->name."</b>";
			
			$fday=$this->getRequest()->getPost('fday');
			$fmnth=$this->getRequest()->getPost('fmonth');
			$fyear=$this->getRequest()->getPost('fyear');					
			$fdate=$fyear."-".$fmnth."-".$fday;			
					
			$tday=$this->getRequest()->getPost('tday');
			$tmnth=$this->getRequest()->getPost('tmonth');
			$tyear=$this->getRequest()->getPost('tyear');
			$tdate=$tyear."-".$tmnth."-".$tday;
					
			$res=$this->getRequest()->getPost('reason');
			
				
			$dayCount=$this->countSunday($fdate,$tdate);
			
			
			$data = new Model_DbTable_Leave();		
			
			$leave=$data->insertLeave($id,$fdate,$tdate,$dayCount,$res);
			
			if($leave==true)
			{
				
				
				$tr = new Zend_Mail_Transport_Smtp('10.1.1.1');
				Zend_Mail::setDefaultTransport($tr);
				$mail = new Zend_Mail();
				$mail->setFrom($Email_From);
				$mail->addTo("jigarkansara12@gmail.com");
				$mail->setSubject('Leave Request');
				$body .="\n\n Hello Sir \n";
				$body .="I(".$name.")want leave for".$dayCount."for".$res."\n";
				$body .="\n\n"; 
				$mail->setBodyText($body);
				$mail->send();
				
				$this->view->email="<b> Your Request has been send to admin for approval </b>";
				$this->render('applyleave');
			}
			
			//$this->_helper->redirector('applyleave','leave');
			
			
		}
	}
	
	public function CountSunday($from,$to)
	{
    
		$from=date('d-m-Y',strtotime($from));
		$to=date('d-m-Y',strtotime($to));
		$cnt=0;
		$nodays=(strtotime($to) - strtotime($from))/ (60 * 60 * 24); //it will count no. of days
		$nodays=$nodays+1; 
           for($i=0;$i<$nodays;$i++)  
            {       
                $p=0;
            list($d, $m, $y) = explode("-",$from);
            $datetime = strtotime("$d-$m-$y");            
            $nextday = date('d-m-Y',strtotime("+1 day", $datetime));  //this will add one day in from date (from date + 1)
            if($i==0)                            
                $p=date('w',strtotime($from));                            
            else
                $p=date('w',strtotime($nextday));
            
            if($p!=0)            // check whethere value is 0 then its sunday
                $cnt++;                                //count variable of sunday                        
             $from=$nextday;          
             $p++;            
            }             
			return $cnt;
	}
	
	public function viewleaveAction()
	{
		$session=new Zend_Session_Namespace();
			if(isset($session->id))
			{			
				$this->view->name="<b>".$session->name."</b>";
				
				$data= new Model_DbTable_Leave();
				$LeaveData=$data->viewLeave();
				
				$this->view->resultviews = $LeaveData;
				$this->render('viewleave');			
			}
			else
			{
				$this->_helper->redirector('login','index');
			}	
	}	
	
}