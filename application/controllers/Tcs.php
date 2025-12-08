<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tcs extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	  public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
				$this->load->model('Dashboard_model');
				$this->load->library('session');			
				$this->load->library('My_PHPMailer');
        }
		
	public function index()  
	{	
		$this->load->view('tcsheader');
		$this->load->view('tcsindex');
		$this->load->view('tcsfooter');
	}
	
	public function userlogin()  
	{	
		
		if ($this->input->post('type')=='ISUSER')
		{
	
			$username =  $this->input->post('user_name');
			$passoword = $this->input->post('User_PWD');
			
			$data['query'] = $this->Dashboard_model->islogin($username,$passoword);
			$islogin=$data['query'][0]['islogin'];
			if($islogin==0)
			{
				echo 0;
			}
			else
			{
				echo 2; exit; // You are logging into another system
			}
		
		} 
		else if($this->input->post('type')=='ISLOGIN')
		{
			
			$username =  $this->input->post('user_name');
			$passoword = $this->input->post('User_PWD');
			$usertype = $this->input->post('usertype');;
			$data['userdetail'] = $this->Dashboard_model->LoginCheck($username,$passoword);
			
			if(isset($data['userdetail'][0]['userid']))
			{ 
			
				$ErrMsg="success"; 
				
				/* if($data['userdetail'][0]['sid']==3)
				{
					$this->session->set_userdata('schoolname',$data['userdetail'][0]['school_name']);
				}
				else
				{ */
					$this->session->set_userdata('schoolname',$data['userdetail'][0]['schoolname']);
				/* } */
				
				if($usertype!='')
				{
					$this->session->set_userdata('usertype',$usertype);
				}
				else
				{
					$this->session->set_userdata('usertype','D');
				}
				
				$this->session->set_userdata(array(
				
				'userId'      =>$data['userdetail'][0]['userid'],
				'name'        => $data['userdetail'][0]['first_name']." ".$data['userdetail'][0]['last_name'],
				'gradeid'     => $data['userdetail'][0]['grade_id'],
				'gp_id'       => $data['userdetail'][0]['gp_id'],
				'mobile'      => $data['userdetail'][0]['mobile'],
				'email'       =>$data['userdetail'][0]['email'],
				'asid'        => $data['userdetail'][0]['sid'],
				'gradename'   => $data['userdetail'][0]['gradename'],
				'section'     => $data['userdetail'][0]['section'],
				'conteststartdate'       => $data['userdetail'][0]['startdatetime'],
				'contestenddate'       => $data['userdetail'][0]['enddatetime'],
				'PlayedStatus'       => $data['userdetail'][0]['played_status']
				
				));
				
				$conteststartdate=$data['userdetail'][0]['startdatetime'];
				$contestenddate=$data['userdetail'][0]['enddatetime'];
				
				$contestenddate=strtotime($this->session->contestenddate);
				$currentDate=strtotime(date('Y-m-d H:i:s'));
				//echo $this->session->contestenddate.'--'.date('Y-m-d H:i:s'); exit;
				//echo $contestenddate.'--'.$currentDate;
				if($contestenddate>=$currentDate)
				{
					$this->session->set_userdata('isexpired','1');
				}
				else
				{
					$this->session->set_userdata('isexpired','0');
				}
				//echo $this->session->isexpired; exit;
				
				/* Generate Unique ID */
				$uniqueId =$this->session->userId."".date("YmdHis")."".round(microtime(true) * 1000);
				$this->session->set_userdata('login_session_id',$uniqueId);
				/* Get IpAddress */
				 if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				 $ip=$_SERVER['HTTP_CLIENT_IP'];}
				 elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
				 {
					$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
				 }
				 else
				 {
					$ip=$_SERVER['REMOTE_ADDR'];
				 }  
				//echo $this->session->userId; exit;
				$update_loginDetails=$this->Dashboard_model->update_loginDetails($this->session->userId,$uniqueId);
				
				$qryloginlog=$this->Dashboard_model->insert_login_log($this->session->userId,$uniqueId,$ip,$_POST['txcountry'],$_POST['txregion'],$_POST['txcity'],$_POST['txisp'],$_SERVER['HTTP_USER_AGENT'],1);
				
				$curdatetime=date('Y-m-d H:i:s');
				$time_one = new DateTime($conteststartdate);
				$time_two = new DateTime($curdatetime);
				$contestdate=$time_one->getTimestamp()- $time_two->getTimestamp();
				
				if($contestdate>0)
				{ 
					echo "COUNTDOWN";exit;
				}
				else
				{	
					echo "PROFILE";exit;
				} 	
			}
			else
			{
				echo "ERROR"; exit;
			}
				
			
		}
		else if($this->input->post('type')=='ISACTIVE')
		{
			//$qryupdateuseractivetime=$this->Dashboard_model->UpdateUserActiveTime($this->session->userId);
			/* $qryloginlog=$this->Dashboard_model->update_login_log($this->session->userId,$this->session->login_session_id);
			$qryuserisalive=$this->Dashboard_model->isuseralive($this->session->userId,$this->session->login_session_id); */
			$qryuserisalive=$this->Dashboard_model->isuseraliveSP($this->session->userId,$this->session->login_session_id);
			$isalive=$qryuserisalive[0]['isalive'];
			
			if($isalive!=1)
			{ 
				$this->session->unset_userdata($key=null);
				$this->session->sess_destroy();
				echo 1;exit;
			}
			else
			{
				echo 0;exit;
			}
		}
	
	}
	
	public function schooluserlogin()  
	{
		if($this->input->post('type')=='ISLOGIN')
		{ 
			$username =  $this->input->post('user_name');
			$passoword = $this->input->post('User_PWD');
			$usertype = $this->input->post('usertype');;
			$data['userdetail'] = $this->Dashboard_model->LoginCheck($username,$passoword);
			
			if(isset($data['userdetail'][0]['userid']))
			{ 
				$key="SA6SBC#";
				$encrypted_Username=openssl_encrypt($username,"AES-128-ECB",$key);
				$encrypted_Password=openssl_encrypt($passoword,"AES-128-ECB",$key);
				$url="user_name=".urlencode($encrypted_Username)."&User_PWD=".urlencode($encrypted_Password)."&usertype=".$usertype;
				echo $url;
			}
			else
			{
				echo 0;
			} 
		} 
	} 
	public function sbclogin()  
	{
		$username =  $this->input->get('user_name');
		//$username =  "SDTr8GkXEFT7Uh+49QEI0w==";
		$passoword = $this->input->get('User_PWD');
		$usertype = $this->input->get('usertype');
		//echo "<pre>";print_r($username);exit;
		$key="SA6SBC#";
		$username=openssl_decrypt($username,"AES-128-ECB",$key);
		$passoword=openssl_decrypt($passoword,"AES-128-ECB",$key);
		
		if($username!='' && $passoword!='' && $usertype!='')
		{
			$data['userdetail'] = $this->Dashboard_model->LoginCheck($username,$passoword);
			
			if(isset($data['userdetail'][0]['userid']))
			{ 
				$ErrMsg="success"; 				 
				$this->session->set_userdata('schoolname',$data['userdetail'][0]['schoolname']);				
				if($usertype!='')
				{
					$this->session->set_userdata('usertype',$usertype);
				}
				else
				{
					$this->session->set_userdata('usertype','D');
				}
				
				$this->session->set_userdata(array(
				
				'userId'      =>$data['userdetail'][0]['userid'],
				'name'        => $data['userdetail'][0]['first_name']." ".$data['userdetail'][0]['last_name'],
				'gradeid'     => $data['userdetail'][0]['grade_id'],
				'gp_id'       => $data['userdetail'][0]['gp_id'],
				'mobile'      => $data['userdetail'][0]['mobile'],
				'email'       =>$data['userdetail'][0]['email'],
				'asid'        => $data['userdetail'][0]['sid'],
				'gradename'   => $data['userdetail'][0]['gradename'],
				'section'     => $data['userdetail'][0]['section'],
				'conteststartdate'       => $data['userdetail'][0]['startdatetime'],
				'contestenddate'       => $data['userdetail'][0]['enddatetime'],
				'PlayedStatus'       => $data['userdetail'][0]['played_status']
				
				));
				
				$conteststartdate=$data['userdetail'][0]['startdatetime'];
				$contestenddate=$data['userdetail'][0]['enddatetime'];
				
				$contestenddate=strtotime($this->session->contestenddate);
				$currentDate=strtotime(date('Y-m-d H:i:s'));
				//echo $this->session->contestenddate.'--'.date('Y-m-d H:i:s'); exit;
				//echo $contestenddate.'--'.$currentDate;
				if($contestenddate>=$currentDate)
				{
					$this->session->set_userdata('isexpired','1');
				}
				else
				{
					$this->session->set_userdata('isexpired','0');
				}
				//echo $this->session->isexpired; exit;
				
				/* Generate Unique ID */
				$uniqueId =$this->session->userId."".date("YmdHis")."".round(microtime(true) * 1000);
				$this->session->set_userdata('login_session_id',$uniqueId);
				/* Get IpAddress */
				 if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				 $ip=$_SERVER['HTTP_CLIENT_IP'];}
				 elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
				 {
					$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
				 }
				 else
				 {
					$ip=$_SERVER['REMOTE_ADDR'];
				 }  
				//echo $this->session->userId; exit;
				$update_loginDetails=$this->Dashboard_model->update_loginDetails($this->session->userId,$uniqueId);
				
				$qryloginlog=$this->Dashboard_model->insert_login_log($this->session->userId,$uniqueId,$ip,$_POST['txcountry'],$_POST['txregion'],$_POST['txcity'],$_POST['txisp'],$_SERVER['HTTP_USER_AGENT'],1);
				
				$curdatetime=date('Y-m-d H:i:s');
				$time_one = new DateTime($conteststartdate);
				$time_two = new DateTime($curdatetime);
				$contestdate=$time_one->getTimestamp()- $time_two->getTimestamp();
				
				 redirect('index.php/home/mygames');
			}
			else
			{
				echo "ERROR"; exit;
			}  
		}
		else
		{
			redirect('index.php');
		}
	}
	
	
	
	public function schooluserlogin_skip()  
	{ 
		$username =  $this->input->post('user_name');
		$passoword = $this->input->post('User_PWD');
		$usertype = $this->input->post('usertype');
		
		$key="SA6SBC#";
		$username=openssl_decrypt($username,"AES-128-ECB",$key);
		$passoword=openssl_decrypt($passoword,"AES-128-ECB",$key);
		
		$data['userdetail'] = $this->Dashboard_model->LoginCheck_skip($username,$passoword);
		
		if(isset($data['userdetail'][0]['userid']))
		{ 
			$key="SA6SBC#";
			$encrypted_Username=openssl_encrypt($username,"AES-128-ECB",$key);
			$encrypted_Password=openssl_encrypt($passoword,"AES-128-ECB",$key);
			$url="user_name=".urlencode($encrypted_Username)."&User_PWD=".urlencode($encrypted_Password)."&usertype=".$usertype;
			echo $url;
		}
		else
		{
			echo 0;
		}  
	} 
	public function sbclogin_skip()  
	{
		$username =  $this->input->get('user_name');
		//$username =  "SDTr8GkXEFT7Uh+49QEI0w==";
		$passoword = $this->input->get('User_PWD');
		$usertype = $this->input->get('usertype');
		//echo "<pre>";print_r($username);exit;
		$key="SA6SBC#";
		$username=openssl_decrypt($username,"AES-128-ECB",$key);
		$passoword=openssl_decrypt($passoword,"AES-128-ECB",$key);
		
		if($username!='' && $passoword!='' && $usertype!='')
		{
			$data['userdetail'] = $this->Dashboard_model->LoginCheck_skip($username,$passoword);
			
			if(isset($data['userdetail'][0]['userid']))
			{ 
				$ErrMsg="success"; 				 
				$this->session->set_userdata('schoolname',$data['userdetail'][0]['schoolname']);				
				if($usertype!='')
				{
					$this->session->set_userdata('usertype',$usertype);
				}
				else
				{
					$this->session->set_userdata('usertype','D');
				}
				
				$this->session->set_userdata(array(
				
				'userId'      =>$data['userdetail'][0]['userid'],
				'name'        => $data['userdetail'][0]['first_name']." ".$data['userdetail'][0]['last_name'],
				'gradeid'     => $data['userdetail'][0]['grade_id'],
				'gp_id'       => $data['userdetail'][0]['gp_id'],
				'mobile'      => $data['userdetail'][0]['mobile'],
				'email'       =>$data['userdetail'][0]['email'],
				'asid'        => $data['userdetail'][0]['sid'],
				'gradename'   => $data['userdetail'][0]['gradename'],
				'section'     => $data['userdetail'][0]['section'],
				'conteststartdate'       => $data['userdetail'][0]['startdatetime'],
				'contestenddate'       => $data['userdetail'][0]['enddatetime'],
				'PlayedStatus'       => $data['userdetail'][0]['played_status']
				
				));
				
				$conteststartdate=$data['userdetail'][0]['startdatetime'];
				$contestenddate=$data['userdetail'][0]['enddatetime'];
				
				$contestenddate=strtotime($this->session->contestenddate);
				$currentDate=strtotime(date('Y-m-d H:i:s'));
				//echo $this->session->contestenddate.'--'.date('Y-m-d H:i:s'); exit;
				//echo $contestenddate.'--'.$currentDate;
				if($contestenddate>=$currentDate)
				{
					$this->session->set_userdata('isexpired','1');
				}
				else
				{
					$this->session->set_userdata('isexpired','0');
				}
				//echo $this->session->isexpired; exit;
				
				/* Generate Unique ID */
				$uniqueId =$this->session->userId."".date("YmdHis")."".round(microtime(true) * 1000);
				$this->session->set_userdata('login_session_id',$uniqueId);
				/* Get IpAddress */
				 if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				 $ip=$_SERVER['HTTP_CLIENT_IP'];}
				 elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
				 {
					$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
				 }
				 else
				 {
					$ip=$_SERVER['REMOTE_ADDR'];
				 }  
				//echo $this->session->userId; exit;
				$update_loginDetails=$this->Dashboard_model->update_loginDetails($this->session->userId,$uniqueId);
				
				$qryloginlog=$this->Dashboard_model->insert_login_log($this->session->userId,$uniqueId,$ip,$_POST['txcountry'],$_POST['txregion'],$_POST['txcity'],$_POST['txisp'],$_SERVER['HTTP_USER_AGENT'],1);
				
				$curdatetime=date('Y-m-d H:i:s');
				$time_one = new DateTime($conteststartdate);
				$time_two = new DateTime($curdatetime);
				$contestdate=$time_one->getTimestamp()- $time_two->getTimestamp();
				
				 redirect('index.php/home/mygames');
			}
			else
			{
				echo "ERROR"; exit;
			}  
		}
		else
		{
			redirect('index.php');
		}
	}
	
	public function countdowntimer()  
	{
			$conteststartdate=$this->session->conteststartdate;
			$curdatetime=date('Y-m-d H:i:s'); //echo $conteststartdate."<br/>".$curdatetime;
			$time_one = new DateTime($conteststartdate);
			$time_two = new DateTime($curdatetime);
			$countdowntime=$time_one->getTimestamp() - $time_two->getTimestamp();
			
			return $countdowntime;
	}
	
	public function countdown()  
	{	
	
		if($this->session->userId=="" || !isset($this->session->userId)){redirect('index.php');}
		
		$userid = $this->session->userId;
		
		$data['userinfo'] = $this->Dashboard_model->Profile($userid);
		$data['qryiscanreschedule'] = $this->Dashboard_model->IsusercanReschedule($userid);
		$data['qryisplayed'] = $this->Dashboard_model->CheckUserAlreadyTakenContest($userid);
		
		if($this->session->isexpired!=1)
		{
		$data['qryofexpire']=$this->Dashboard_model->UpdateisExpired($userid);
		}

		$this->load->view('headerinner', $data);
		$this->load->view('countdown', $data);
		$this->load->view('footer');
	}
	
	public function mygamesold()  
	{
		if($this->session->userId=="" || !isset($this->session->userId)){redirect('index.php');}
		if($this->countdowntimer()<=0){  } else { redirect('index.php/home/countdown'); }
		 
		$userid = $this->session->userId;
		$data['userinfo'] = $this->Dashboard_model->Profile($userid);
		$contestid = $data['userinfo'][0]['User_Contest_Level_ID'];	
		$gradeid = $data['userinfo'][0]['User_Grade_ID'];
		
		$data['GameDetails'] = $this->Dashboard_model->GameDetails($gradeid,$userid,$contestid);
		
		
		$data['mem'] = $this->Dashboard_model->SkillScoreMemory($userid,$contestid);		
		$data['vp'] = $this->Dashboard_model->SkillScoreVP($userid,$contestid);
		$data['fa'] = $this->Dashboard_model->SkillScoreFA($userid,$contestid);
		$data['ps'] = $this->Dashboard_model->SkillScorePS($userid,$contestid);
		$data['ling'] = $this->Dashboard_model->SkillScoreLIG($userid,$contestid);
		
		
		$this->load->view('headerinner', $data);
		$this->load->view('mygames', $data);
		$this->load->view('footer');
	
	}
	public function mygames()  
	{
		
		if($this->session->userId=="" || !isset($this->session->userId)){redirect('index.php');}
		if($this->countdowntimer()<=0){  } else { redirect('index.php/home/countdown'); }
		 
		$userid = $this->session->userId;
		$data['userinfo'] = $this->Dashboard_model->Profile($userid);
		$contestid = $data['userinfo'][0]['User_Contest_Level_ID'];	
		$gradeid = $data['userinfo'][0]['User_Grade_ID'];
		
		//$data['GameDetails'] = $this->Dashboard_model->GameAssignLogic($userid,$gradeid,$contestid);
		/* 
		 
		$data['GameDetails'] = $this->Dashboard_model->GameDetails($gradeid,$userid,$contestid); 
		$data['mem'] = $this->Dashboard_model->SkillScoreMemory($userid,$contestid);		
		$data['vp'] = $this->Dashboard_model->SkillScoreVP($userid,$contestid);
		$data['fa'] = $this->Dashboard_model->SkillScoreFA($userid,$contestid);
		$data['ps'] = $this->Dashboard_model->SkillScorePS($userid,$contestid);
		$data['ling'] = $this->Dashboard_model->SkillScoreLIG($userid,$contestid); */
		
		//echo "<pre>";print_r($data['GameDetails']);exit;
		$this->load->view('headerinner', $data);
		$this->load->view('mygames', $data);
		$this->load->view('footer');
	
	}
	public function mygames_ajax()  
	{	 
		if($this->session->userId=="" || !isset($this->session->userId)){redirect('index.php');}
		if($this->countdowntimer()<=0){  } else { redirect('index.php/home/countdown'); }
		
		$userid = $this->session->userId;
		$data['userinfo'] = $this->Dashboard_model->Profile($userid);
		$contestid = $data['userinfo'][0]['User_Contest_Level_ID'];	
		$gradeid = $data['userinfo'][0]['User_Grade_ID'];
		$data['GameDetails'] = $this->Dashboard_model->GameAssignLogic($userid,$gradeid,$contestid);
		/* $data['GameDetails'] = $this->Dashboard_model->GameDetails($gradeid,$userid,$contestid);
		
		$data['mem'] = $this->Dashboard_model->SkillScoreMemory($userid,$contestid);
		$data['vp'] = $this->Dashboard_model->SkillScoreVP($userid,$contestid);
		$data['fa'] = $this->Dashboard_model->SkillScoreFA($userid,$contestid);
		$data['ps'] = $this->Dashboard_model->SkillScorePS($userid,$contestid);
		$data['ling'] = $this->Dashboard_model->SkillScoreLIG($userid,$contestid); */
			
		$this->load->view('mygames_ajax', $data); 
	}
	
	public function myprofile()  
	{	
		if($this->session->userId=="" || !isset($this->session->userId)){redirect('index.php');}
		if($this->countdowntimer()<=0){  } else { redirect('index.php/home/countdown'); }
	//	if($this->countdowntimer()<=0){ redirect('index.php/home/mygames'); }else { redirect('index.php/home/countdown'); }
		
		$this->load->view('headerinner');
		$this->load->view('profile');
		$this->load->view('footer');
	
	}
	
	public function get_info()
	{
		$gname=$this->input->post('gname');
		$uid=$this->session->userId;  
		$curdate=date('Y-m-d'); 
		
		if($gname!='' && $uid!='')
		{
			$arrgame=$this->Dashboard_model->getGameValues($gname); 
			if(isset($arrgame[0]['gid'])!='' && $arrgame[0]['gid']!='')
			{  
				$current_Cycle=1; 
				$arrPlyedDetails=$this->Dashboard_model->getGamePlayedDetails($arrgame[0]['gid'],$uid,$current_Cycle,$curdate);
				//echo "<pre/>";print_r($arrPlyedDetails);exit;
				$arr=array(
					"gname"=>$gname,
					"gameid"=>$arrgame[0]['gid'],
					"skillid"=>$arrgame[0]['gs_id'],
					"qcnts"=>$arrPlyedDetails[0]['qcnts'],
					"scores"=>$arrPlyedDetails[0]['scores'],
					"timerval"=>$arrPlyedDetails[0]['timerval'],
					"qvalues"=>$arrPlyedDetails[0]['qvalues'],
					"rsptime"=>$arrPlyedDetails[0]['rsptime'],
					"questionscore"=>$arrPlyedDetails[0]['questionscore'],
					"useranswer"=>$arrPlyedDetails[0]['useranswer'],
					"crtcnt"=>$arrPlyedDetails[0]['crtcnt'],
					"puzzle_cycle"=>$current_Cycle,
					"status"=>1
				);
				
			}
			else
			{
				$arr=array(
					"gameid"=>'',
					"gname"=>'',
					"skillid"=>'',
					"qcnts"=>'',
					"scores"=>'',
					"timerval"=>'',
					"qvalues"=>'',
					"rsptime"=>'',
					"questionscore"=>'',
					"useranswer"=>'',
					"crtcnt"=>'',
					"puzzle_cycle"=>'',
					"status"=>0
				);
			}
			echo '{"gameinfo":'.json_encode($arr).'}';exit; 
		}
		else
		{
			$arr=array(
					"gameid"=>'',
					"gname"=>'',
					"skillid"=>'',
					"qcnts"=>'',
					"scores"=>'',
					"timerval"=>'',
					"qvalues"=>'',
					"rsptime"=>'',
					"questionscore"=>'',
					"useranswer"=>'',
					"crtcnt"=>'',
					"puzzle_cycle"=>'',
					"status"=>0
				);
			echo '{"gameinfo":'.json_encode($arr).'}';exit; 
		}
	}
	
	/* public function oldget_info()  
	{	
		if($this->session->userId=="" || !isset($this->session->userId)){redirect('index.php');}
	
		$gname=$this->input->post('gname'); 
		if(isset($gname))
		{ 
			$data['get_info'] = $this->Dashboard_model->get_info($gname);
			//$var = array();
			//echo "<pre>";print_r($data['get_info']);exit;
			foreach($data['get_info'] as $row) 
			{
				$arr[]=$row;
			}
			echo '{"gameinfo":'.json_encode($arr).'}'; exit;
		}
	}
	
	public function getinfo()  
	{	
		if($this->session->userId=="" || !isset($this->session->userId)){redirect('index.php');}
		
		$userid = $this->session->userId;
		$gid=$this->input->post('GID');
		
		if(isset($gid) && isset($userid))
		{
			$uid=$userid;
			$data['getinfo'] = $this->Dashboard_model->getinfo($gid,$uid);
			//$var = array();
		 
		foreach($data['getinfo'] as $row) 
				{
					$arr[]=$row;
				}
		echo '{"info":'.json_encode($arr).'}';
		}
	} */
	public function scoreupdate()
	{
		if(isset($_REQUEST["SID"]) && isset($_REQUEST["GID"]) && isset($_REQUEST["RT"]) && isset($_REQUEST["TV"]) && isset($_REQUEST["CA"]) && isset($_REQUEST["UA"]) && isset($_REQUEST['AS']) && isset($_REQUEST['QNO']) && isset($_REQUEST['SCORE']) && isset($_REQUEST['puzzle_cycle']) && isset($_REQUEST['TOS']))
		{
			 
			$uid=$this->session->userId;  
			$SID=$_REQUEST["SID"]; 
			$GID=$_REQUEST["GID"];
			$ResponseTime=$_REQUEST["RT"];
			$BalaceTime=$_REQUEST["TV"];
			$CorrectAnswer=$_REQUEST["CA"];
			$UserAnswer=$_REQUEST["UA"];
			$AnswerStaus=$_REQUEST["AS"];
			$QNO=$_REQUEST["QNO"];
			$SCORE=$_REQUEST["SCORE"];
			$puzzle_cycle=$_REQUEST["puzzle_cycle"];
			$TimeOverStatus=$_REQUEST["TOS"];
			$todaydaste = date('Y-m-d');
			
			$pid=$this->session->gp_id;			
			$gametime=$_REQUEST["G_T"];			
			
			{
				$arrofPlayedCount=$this->Dashboard_model->getPlayedPuzzleCount($uid,$todaydaste,$GID,$puzzle_cycle);
			
				if($arrofPlayedCount[0]['playedcount']>9)
				{
					echo -2;exit;
				} 
				$curdate=date('Y-m-d'); 
				$curdatetime=date('Y-m-d H:i:s'); 
				
				$GameResult=$this->Dashboard_model->InsertGameData($uid,$SID,$GID,$ResponseTime,$BalaceTime,$CorrectAnswer,$UserAnswer,$AnswerStaus,$QNO,$SCORE,$TimeOverStatus,$puzzle_cycle,$curdate,$curdatetime,$gametime,$pid);
				
                                if($GameResult[0]['OUTPUT']=='GAMEINSERT')
                                {
                                        $arrofGameData=$this->Dashboard_model->UpdateSBCPlayedStatus($uid);
                                        if($arrofGameData[0]['Oresult']>0)
                                        {
                                                $this->session->set_userdata('PlayedStatus','P');
                                        }
                                        $this->session->unset_userdata('progress_cache');
                                        echo 1;exit;
                                }
				else
				{
					echo 'SI';exit;// Closing the popup, 
				}
			}
		} 
		else
		{
			echo -1;
		}
	}
	
	public function result()
	{
		if($this->session->user_id=="" || !isset($this->session->user_id)){redirect('index.php'); exit;}
		if(!isset($_POST)){redirect('index.php'); exit;}
		if(empty($_POST)){redirect('index.php'); exit;}

		$total_ques=$_POST["tqcnt1"];

		if($_POST["aqcnt1"]>10){$attempt_ques=10;}else{$attempt_ques=$_POST["aqcnt1"];}

		$answer=$_POST["cqcnt1"];
		$score=$_POST["gscore1"];
		$a6=$_POST["gtime1"];
		$a7=$_POST["rtime1"];
		$a8=$_POST["crtime1"];
		$a9=$_POST["wrtime1"];	
		$gameid=$this->session->currentgameid;
		
		$braintest_level = $this->session->btestlevel;
		
		if($gameid==0)
		{
			echo '-2';exit;
		}

		$userlang = $this->session->userlang;
		$userid = $this->session->user_id; 
		$lastup_date = date("Y-m-d");
		$cid = 1;
		$data['gameDetails'] = $this->Dashboard_model->getresultGameDetails($userid,$gameid);

		$skillid =$data['gameDetails'][0]['gameskillid'] ; 

		$data['chkschedule'] = $this->Dashboard_model->checkscheduledays($this->session->game_grade,$this->session->section,$this->session->school_id);
		$schedule_val = $data['chkschedule'][0]['scheduleday'];

		$pid =  $this->session->gp_id; 
		

		$arrofinput=array("inSID"=>$this->session->school_id,"inGID"=>$this->session->game_grade,'inUID'=>$userid,'inScenarioCode'=>'GAME_END','inTotal_Ques'=>$total_ques,'inAttempt_Ques'=>$attempt_ques,'inAnswer'=>$answer,'inGame_Score'=>$score,"inPlanid"=>$pid,'inGameid'=>$gameid);

		/*--- Sparkies ----*/
		$sparkies_output=$this->Dashboard_model->insertsparkies($arrofinput);
		$_REQUEST['gameoutput']=$sparkies_output[0]['OUTPOINTS'];
		//$this->session->set_flashdata('newsparky', $sparkies_output[0]['OUTPOINTS']);
		/*--- News Feed ----*/
		$newsfeed_output=$this->Dashboard_model->insertnewsfeeddata($arrofinput);		
		echo $sparkies_output[0]['OUTPOINTS'];exit;
		//$this->load->view('gameresult/Result');
		
	}
	
	
	
	/* public function ScoreUpdate()  
	{	
	if($this->session->userId=="" || !isset($this->session->userId)){redirect('index.php');}
	
	$userid = $this->session->userId;
	$sid = $this->input->post('SID');
	$contestid = $this->input->post('CONTEST_ID');
	$gid = $this->input->post('GID');
	$rt = $this->input->post('RT');
	$tv = $this->input->post('TV');
	$as = $this->input->post('AS');
	$qno = $this->input->post('QNO');
	$score = $this->input->post('SCORE');
	$ca=$this->input->post('CA');
	$ua=$this->input->post('UA');
	
	if(isset($sid) && isset($contestid) && isset($gid) && isset($rt) && isset($tv) && isset($as) && isset($qno) && isset($score) && isset($userid))
	{
		
		$data['scoreupdate'] = $this->Dashboard_model->scoreupdate($userid,$gid,$rt,$tv,$ca,$ua,$as,$qno,$score,$sid,$contestid);

		echo 1; exit;
	}
	} */
	
	public function get_question()  
	{	
	if($this->session->userId=="" || !isset($this->session->userId)){redirect('index.php');}
	
	$userid = $this->session->userId;
	$gname=$this->input->post('gname');
	
	if(isset($gname))
		{
		
		//$var = array();
		$data['get_question'] = $this->Dashboard_model->get_question($gname);
		
		
		foreach($data['get_question'] as $row)
		{
			$dbdata["question_number"]=$row["question_number"];
			$dbdata["question"]=$row["question"];
			$myArray2=explode(',',$row["answer"]);
			$myArray3=explode(',',$row["answervalue"]);
			$myArray = explode(',', $row["choice"]);
			$myArray1 = explode(',', $row["choicevalue"]);
			for($i=1;$i<=sizeof($myArray);$i++)
			{
			$dbdata["ch".$myArray[$i-1]]=$myArray1[$i-1];
			}
			for($i=1;$i<=sizeof($myArray2);$i++)
			{
				
				$dbdata["answer".$myArray2[$i-1]]=$myArray3[$i-1];
			
			}
			
			$arr[]=$dbdata;
		}
		
		echo '{"QUESTION":'.json_encode($arr).'}';
		
		}
	}
	
	public function gameajax()  
	{	
		if($this->session->userId=="" || !isset($this->session->userId)){redirect('index.php');}
		
		$userid = $this->session->userId;
		$gameurl =  $this->input->post('gameurl'); 
		$gname = substr($gameurl, strrpos($gameurl, '/') + 1);
		$gamename = str_replace('games.php?gamename=','', $gname); 
		//print_r($gamename); exit;
		$qryuserassignedgame=$this->Dashboard_model->CheckIsUserAssignedGame($gamename,$this->session->gradeid,$userid);
		
		foreach($qryuserassignedgame as $row)
		{
			$userassignedgame=$row;
		}
		
		$IsUserAssignedGame=$userassignedgame['userassignedgame']; print_r($IsUserAssignedGame); exit;
		
		$qrygamestatus=$this->Dashboard_model->CheckGameAlreadyPlayed($gamename,$this->session->userId);
		
		foreach($qrygamestatus as $row)
		{
			$gameplayedstatus=$row;
		}

		if($gameplayedstatus['played']!='YES' && $gameplayedstatus['gameover']!='YES' && $IsUserAssignedGame!=0)
		{
			echo 'ALLOW';exit;
		}
		else{echo 'IA'; exit;}
	}
	
	
	public function myreports()  
	{	
	
		if($this->session->userId=="" || !isset($this->session->userId)){redirect('index.php');}
		if($this->countdowntimer()<=0){  } else { redirect('index.php/home/countdown'); }
		//if($this->countdowntimer()<=0){ redirect('index.php/home/myreports'); }else { redirect('index.php/home/countdown'); }

		$userid = $this->session->userId;
		$data['userinfo'] = $this->Dashboard_model->Profile($userid);
		$contestid = $data['userinfo'][0]['User_Contest_Level_ID'];	
		$gradeid = $data['userinfo'][0]['User_Grade_ID'];

		$data['GameDetails'] = $this->Dashboard_model->GameDetails($gradeid,$userid,$contestid);

		$data['mem'] = $this->Dashboard_model->SkillScoreMemory($userid,$contestid);
		$data['vp'] = $this->Dashboard_model->SkillScoreVP($userid,$contestid);
		$data['fa'] = $this->Dashboard_model->SkillScoreFA($userid,$contestid);
		$data['ps'] = $this->Dashboard_model->SkillScorePS($userid,$contestid);
		$data['ling'] = $this->Dashboard_model->SkillScoreLIG($userid,$contestid);

		//echo "<pre>";print_r($data); exit;
		
		$this->load->view('headerinner', $data);
		$this->load->view('reports', $data);
		//$this->load->view('footer');
	
	}
	
	public function privacypolicy()  
	{
		$this->load->view('privacypolicy');
	}
	
	public function terms()  
	{
		$this->load->view('terms-conditions');
	}
	
	public function registration()  
	{
		
		$data['GradeList'] = $this->Dashboard_model->GetGradeList();
		$this->load->view('header');
		$this->load->view('register', $data);
		$this->load->view('footer');
	}
	
	public function checkemailexist()  
	{
		$emailid =  $this->input->post('emailID');
		$type =  $this->input->post('CType'); 
		
		if($type=='EC')
		{
		$data['emailid'] = $this->Dashboard_model->Emailexist($emailid);
		echo $data['emailid'][0]['existcount'];
		}
	}
	
	public function payment()  
	{
		$userid =  $_REQUEST['uid']; 
		$create =  $_REQUEST['key'];
		
		if($userid!='' &&$create!='')
	{ 
	$isalreadyreguser=$this->Dashboard_model->chkprocesseduser($userid); //echo $isalreadyreguser;exit;
	
	if($isalreadyreguser[0]['emailcount']==0)
	{ 
		$data['userdetails'] =$this->Dashboard_model->UserDetailsmd5($userid);//echo "<pre>";print_r($qryuserdetails);exit;	
		//$qryuserdetails = $conn->query($qryuserdetails);
		if (count($data['userdetails']) > 0) 
		{
			$qryplandetails =$this->Dashboard_model->PlanDetails();
		
		$data['userid'] = $userid;
		$this->load->view('header');
		$this->load->view('payment',$data);
		$this->load->view('footer');

		}
		else{
			
			redirect(base_url()); exit;
		}
		
	}
	else
	{
		redirect(base_url().''."index.php/home/chk_registration"); exit;
	}
	}
	else
	{		redirect(base_url()); exit;
		 //header("Location:index.php");exit; 
	}
	
		
	
	}
	
	public function paymentresponse()
	{
		
		$regtblid=$_REQUEST['hdnPaymSubscribeID'];
		
		if($regtblid!='')
{
		
		$data['getresponsedetails'] =$this->Dashboard_model->GetResponseDetails($regtblid);//echo $getresponsedetails;exit;
		/* $getresponsedetails = $conn->query($getresponsedetails);
		while($row =$getresponsedetails->fetch_assoc()){
			$data['getresponsedetails'] =$row;
		} */
		//echo "<pre>";print_r($data['getresponsedetails']);exit;
		
		$subscriberid = $data['getresponsedetails'][0]['id'];
		$salt1 = $data['getresponsedetails'][0]['salt1'];
		$salt2 = $data['getresponsedetails'][0]['salt2']; 
		$email = $data['getresponsedetails'][0]['email'];
		$password = $data['getresponsedetails'][0]['password']; 
		$gradeid = $data['getresponsedetails'][0]['grade_id'];
		$firstname = $data['getresponsedetails'][0]['first_name'];
		$lastname = $data['getresponsedetails'][0]['last_name'];
		$gender = $data['getresponsedetails'][0]['gender'];
		$mobile = $data['getresponsedetails'][0]['phone'];
		$address = $data['getresponsedetails'][0]['address'];
		$dob = $data['getresponsedetails'][0]['dob'];
		$gameplanid = $data['getresponsedetails'][0]['gameplanid'];
		$org_pwd = $data['getresponsedetails'][0]['org_pwd'];
		$couponcode = $data['getresponsedetails'][0]['couponcode'];
		$schoolname = $data['getresponsedetails'][0]['school_name'];
		 

		$data['subscriber_exist'] =$this->Dashboard_model->SubscriberExist($subscriberid);
		
		/* $subscriber_exist = $conn->query($subscriber_exist);
		while($row =$subscriber_exist->fetch_assoc())
		{
			$data['subscriber_exist'] =$row;
		} */
	 
		 if($data['subscriber_exist'][0]['subid']==0)
		 {
				$updQuery=$this->Dashboard_model->UpdateReg($regtblid);
				//$conn->query($updQuery);
				
				/* $updQuery=UpdateContestSlot($regtblid);
				$conn->query($updQuery); */

				$qruserid =$this->Dashboard_model->InsertUser($subscriberid,$email,$gradeid,$firstname,$lastname,$gender,$mobile,$address,$dob,$gameplanid,$couponcode,$schoolname);
				/* $conn->query($qruserid); */
				$usertblid=$qruserid;
			
				$qryloginid =$this->Dashboard_model->InsertLoginMaster($email,$salt1,$password,$salt2,$usertblid);
				//$conn->query($qryloginid);
				//echo $loginid=$qryloginid; exit;
				
				$regupdate =$this->Dashboard_model->UpdateReg1($usertblid,$regtblid);
				//$conn->query($regupdate);
				
				$qrycouponcode=$this->Dashboard_model->UpdateCouponCount($couponcode);
				//$conn->query($qrycouponcode);
				 
				$to=$email;
				$baseurl=base_url();
				$subject = 'Super Brain Challenge - Registration Successful';
				$message = '<table align="center" width="800px" border="1" cellspacing="0" cellpadding="0" style="font-size:medium;margin-right:auto;margin-left:auto;border:1px solid rgb(197,197,197);font-family:Arial,Helvetica,sans-serif;background-image:initial;background-repeat:initial">
				<tbody><tr style="display:block;overflow:hidden">
				<td style="float:left;border:0px;"><a href="https://skillangels.com/sbc" target="_blank" ><img src="'.$baseurl.'assets/images/skillangels_logo.png" width="210"  alt="skillangels" /></a>
				</td></tr><tr style="padding:0px;margin:10px 42px 20px;display:block;font-size:13px;font-family:Verdana,Geneva,sans-serif;line-height:18px;text-align:justify">
				<td colspan="2" style="border:0px">Dear '.$firstname.',<br/><br/>Thank you for registering with Super Brain Challenge.<br/>Following are the credentials to access the service at <a href="https://skillangels.com/sbc" target="_blank" >https://skillangels.com/sbc</a><br/><br/>Your username	:'.$email.'<br/>Your password	:'.$org_pwd.' <br/><br/>Wish you the Very Best!!!<br/><br/>Best Regards,<br/>Super Brain Challenge Team<br/>
				</td></tr><tr style=""><td style="text-align:center;color:#ee1b5b;border:0px;background-size:100%;background-image: url('.$baseurl.'assets/images/emailer/Gtecfooter.png);padding-top:20px;padding-bottom:20px;font-family: cursive;font-size: 20px;">
				</td></tr><tr style="display:block;overflow:hidden"><td style="float:left;border:0px;"></td></tr></tbody></table>';
			
				//$this->confirmation_email($to,$subject,$message);
				/* require 'mailer/PHPMailerAutoload.php';
				 
				$mail = new PHPMailer;
				$mail->isSMTP();
				$mail->SMTPDebug = 0;
				$mail->Debugoutput = 'html';
				$mail->Host = "smtp.falconide.com";
				$mail->Port = 587;
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = "";
				$mail->Username = "skillsangelsfal";
				$mail->Password = "SkillAngels@123";
				$mail->setFrom('angel@skillangels.com', 'Super Brain Challenge');
				$mail->addReplyTo('angel@skillangels.com', 'Super Brain Challenge');
				$mail->addAddress($to, ''); //to mail id
				$mail->Subject = $subject;
				$mail->msgHTML($message);
				if (!$mail->send())
				{
					echo $msg="Mailer Error: " . $mail->ErrorInfo;
				}
				else
				{
				   $msg="success";
				}  */
				
			$data['email'] = $email;
			$data['org_pwd'] = $org_pwd;
			
		$this->load->view('header');
		$this->load->view('paymentresponse', $data);
		$this->load->view('footer');
			  
		}
		else
		{
			redirect(base_url().''."index.php/home/chk_registration"); exit;
			//header("Location:chk_registration.php");exit;
		}
}
		
		
			
	}
	
	
	public function chk_registration()
	{
		//$this->load->view('header');
		$this->load->view('chk_registration');
		//$this->load->view('footer');
			
	}
	
	public function insertreg()  
	{
		if($this->input->post('txtEmail')!='' && $this->input->post('txtOPassword')!='' && $this->input->post('ddlGrade')!='' && $this->input->post('txtCouponcode')!='')
		{
			$Defaut_pwd="skillangels";
			
			$rdGender="M";
			if($this->input->post('rdGender')=="M"){$rdGender="M";}else{$rdGender="F";}
			// Generate two salts (both are numerical)
			$salt1 = mt_rand(1000,9999999999);
			$salt2 = mt_rand(100,999999999);

			// Append our salts to the password
			$salted_pass = $salt1.$Defaut_pwd.$salt2;
			// Generate a salted hash
			$pwdhash = sha1($salted_pass);
			// Place into an array
			$salt1 = $salt1;
			$salt2 = $salt2;
			$password = $pwdhash;

			$city = '';
			$academy = '';
			$address='';
			$dob='';
			$pincode='';
			$Couponcode=$this->input->post('txtCouponcode');
			
			$Emailexist = $this->Dashboard_model->Emailexist($this->input->post('txtEmail'));
			
			if($Emailexist[0]['existcount']==0)
			{
				$arrcoupon=$this->Dashboard_model->GetCouponCodeDetailsnew($Couponcode);
				
			if($arrcoupon[0]['iscouponvalid']==1)
			{ 
				$qryapplycoupon=$this->Dashboard_model->applycouponnew($Couponcode);
				
				if($arrcoupon[0]['coupon_valid_times']==0)
				{ // User can use many time
					$isallow =1;
				}
				else if($arrcoupon[0]['coupon_valid_times']>0 && $qryapplycoupon[0]['iscouponvalid']==1)
				{ // Restricted Use
					
					if($qryapplycoupon[0]['iscouponvalid']==1)
					{
						
						$isallow =1;
					}
					else
					{
						$isallow =0;
					}
				}
				else
				{
					$isallow =0;
				} 
				if($isallow==1)
				{
					$uploaddir = 'user_proofs/';
					$imageFileType = pathinfo(basename(basename($_FILES["txtUID"]["name"])),PATHINFO_EXTENSION);
					$uploadfile = $uploaddir .$this->input->post('txtEmail').".".$imageFileType;

					$isfileuploaded='Not Uploaded';
					if (move_uploaded_file($_FILES['txtUID']['tmp_name'], $uploadfile))
					{
						$isfileuploaded='Uploaded';
						//echo "File is valid, and was successfully uploaded.\n";
					} else 
					{
						$isfileuploaded='Not Uploaded';
						//echo "Possible file upload attack!\n";
					}
					$contest_level_id=1;
					$contest_id=1;

					$qryinsertRegister=$this->Dashboard_model->InsertRegister($this->input->post('txtFName'),$this->input->post('txtLName'),$this->input->post('txtEmail'),$password,$dob,$this->input->post('txtSchool'),$this->input->post('ddlState'),$city,$this->input->post('txtMobile'),$contest_id,$contest_level_id,$this->input->post('ddlGrade'),$pincode,$address,$rdGender,$this->input->post('ddlCountry'),$salt1,$salt2,$academy,$Defaut_pwd,$Couponcode);
					
					if($qryinsertRegister[0]['resp']>0)
					{
						$qryUserDetails=$this->Dashboard_model->UserDetails($qryinsertRegister[0]['resp']);
						
						$discount_start_date = $qryUserDetails[0]['created_on']; 
						$cdate = date('YmdHis', strtotime($discount_start_date));
						$to=$this->input->post('txtEmail');
						$baseurl = base_url();
						
						$subject = 'Super Brain Challenge - Registration confirmation';
						$message = '<table align="center" width="800px" border="1" cellspacing="0" cellpadding="0" style="font-size:medium;margin-right:auto;margin-left:auto;border:1px solid rgb(197,197,197);font-family:Arial,Helvetica,sans-serif;background-image:initial;background-repeat:initial">
						<tbody>
						<tr style="display:block;overflow:hidden">
						<td style="float:left;border:0px;">
						<a href="'.$baseurl.'" target="_blank" ><img src="'.$baseurl.'/assets/images/skillangels_logo.png" width="210"  alt="skillangels" /></a>
						</td>
						</tr>
						<tr style="padding:0px;margin:10px 42px 20px;display:block;font-size:13px;font-family:Verdana,Geneva,sans-serif;line-height:18px;text-align:justify">
						<td colspan="2" style="border:0px">
						Dear '.$this->input->post('txtFName').',<br/><br/>
						Thank you for registering with Super Brain Challenge.<br/><br/>
						Click below link to complete user registration :<br/><br/>
						<a href="'.$baseurl.'index.php/home/payment?uid='.md5($qryUserDetails[0]['id']).'&key='.md5($cdate).'" style="color:green" target="_blank" >Click Here</a><br/><br/>
						Wish you the Very Best!!!<br/><br/>
						Best Regards,<br/>
						Super Brain Challenge Team<br/>
						</td>
						</tr>
						<tr style="">
						<td style="text-align:center;color:#ee1b5b;border:0px;background-size:100%;background-image: url('.$baseurl.'/assets/images/emailer/Gtecfooter.png);padding-top:20px;padding-bottom:20px;font-family: cursive;font-size: 20px;">
						</td>
						</tr>
						<tr style="display:block;overflow:hidden">
						<td style="float:left;border:0px;"></td></tr>
						</tbody>
						</table>';
						
						//$this->confirmation_email($to,$subject,$message);
					
						$arrResult=array("response"=>"1","RegID"=>md5($qryUserDetails[0]['id']),"msg"=>"Registered successfully");
						echo json_encode($arrResult);exit;
						
					}
					$arrResult=array("response"=>"0","msg"=>"Please try again...");
					echo json_encode($arrResult);exit; 
				}
				else
				{
					$arrResult=array("response"=>"0","msg"=>"Coupon code has expired");
					echo json_encode($arrResult);exit;
				}
			}
			else
				{
					$arrResult=array("response"=>"0","msg"=>"Invalid Couponcode");
					echo json_encode($arrResult);exit;
				}
		}
		else
			{
				$arrResult=array("response"=>"0","msg"=>"This E-Mail ID is already registered");
				echo json_encode($arrResult);exit;
			}
	}
	else
		{
			$arrResult=array("response"=>"0","msg"=>"Please fill the mandatory fields");
			echo json_encode($arrResult);exit;
		}	
		
	}
	

	
	public function confirmation_email($toemailid,$subject,$message)
{
//Create a new PHPMailer instance
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->SMTPDebug = $this->config->item('CS_SMTP_SMTPDebug');
	$mail->Debugoutput = 'html';
	$mail->Host = $this->config->item('CS_SMTP_HOST');
	$mail->Port = $this->config->item('CS_SMTP_PORT');
	$mail->SMTPAuth = $this->config->item('CS_SMTP_SMTPAuth');
	$mail->SMTPSecure = $this->config->item('CS_SMTP_SMTPSecure');
	$mail->Username = $this->config->item('CS_SMTP_USERNAME');
	$mail->Password = $this->config->item('CS_SMTP_PASSWORD');
	$mail->setFrom($this->config->item('CS_SMTP_SET_FROM_MAILID'), $this->config->item('CS_SMTP_SET_FROM_NAME'));
	$mail->addReplyTo($this->config->item('CS_SMTP_REPLY_TO_MAILID'), $this->config->item('CS_SMTP_REPLY_TO_NAME'));
	$mail->addBCC($this->config->item('CS_SMTP_BCC_MAILID')); 
	$mail->addCC($this->config->item('CS_SMTP_CC_MAILID'));
	$mail->addCC($this->config->item('CS_SMTP_CC1_MAILID')); 
	$mail->addAddress($toemailid, ''); //to mail id
	$mail->Subject = $subject;
	$mail->msgHTML($message);
	if (!$mail->send()) {
	  // echo "Mailer Error: " . $mail->ErrorInfo;exit;
	} else {
	  //echo "Message sent!";exit;
	}  
	
}
	
	
	public function logout()
	{
		if($this->session->userId=="" || !isset($this->session->userId)){redirect('index.php');}
	
		
		if($this->session->usertype=='SK')
		{  
			$redirect_url="https://schools.skillangels.com/";
			//$redirect_url="https://demo.skillangels.com/clpmultilingual/";
		}
		else if($this->session->usertype=='KINDER')
		{  
			$redirect_url="https://kinderangels.com/";
			//$redirect_url="https://demo.skillangels.com/clpmultilingual/";
		}
		else if($this->session->usertype=='BLESSED')
		{  
			$redirect_url="https://blessedangel.org/";
			//$redirect_url="https://demo.skillangels.com/clpmultilingual/";
		}
		else
		{
			$redirect_url=base_url();
		}
		
		$qryupdateislogin=$this->Dashboard_model->UpdateIsLogin($this->session->userId);
		$qryuserlogoutlog=$this->Dashboard_model->update_logout_log($this->session->userId,$this->session->login_session_id);
		unset($_SESSION);
		session_destroy();
		$this->session->sess_destroy();
	
		redirect($redirect_url); 
	}
	 
	public function checkplayedstatus()
	{
		$username =  $this->input->post('email');
		$passoword = $this->input->post('pwd'); 
		if($username!='' && $passoword!='')
		{
			$curdate=date('Y-m-d'); 
			$arrofresult=$this->Dashboard_model->checkplayedstatus($username,$passoword,$curdate);
			echo $arrofresult[0]['isvaliduser'];
		}
		else
		{
			echo 0;
		}
	}
	
	public function createsbcuser()
	{
		/* $sid=$this->uri->segment('3');
		$arrofSchools = $this->Dashboard_model->getActiveschools();
		foreach($arrofSchools as $school)
		{//echo "<br/>".$school['id'];
			$arrofuserdata = $this->Dashboard_model->getSBCUser($school['id']);
			$startdate = '2019-12-30';
			$enddate = '2020-01-31';
			foreach($arrofuserdata as $user)
			{   
				$this->Dashboard_model->InsertSBCUser($user['fname'],$user['lname'],$user['email'],$user['password'],$user['sid'],$user['incontestid'],$user['incontestlevelid'],$user['grade_id'],$user['section'],$user['salt1'],$user['salt2'],$user['org_pwd'],$user['school_name'],$startdate,$enddate);
			}
			echo "<br/>".$school['id']." Completed";
		} */
	}

	/*----------------- Kinderangels User Insert --------------------*/
	public function kinderuser()
	{
		/* $arrofSchools =array(0=>array("id"=>120),1=>array("id"=>121),2=>array("id"=>124),3=>array("id"=>126));
		//echo "<pre>";print_r($arrofSchools);exit;
		foreach($arrofSchools as $school)
		{
			$arrofuserdata = $this->Dashboard_model->getKinderUser($school['id']);
			$startdate = '2020-01-01';
			$enddate = '2020-01-31';
			//echo "<pre>";print_r($arrofuserdata);exit;
			foreach($arrofuserdata as $user)
			{
				$this->Dashboard_model->InsertKinderUser($user['fname'],$user['lname'],$user['email'],$user['password'],$user['sid'],$user['incontestid'],$user['incontestlevelid'],$user['grade_id'],$user['section'],$user['salt1'],$user['salt2'],$user['org_pwd'],$user['school_name'],$startdate,$enddate,$user['program_type'],$user['actual_grade'],$user['assigned_grade']);
			}
			echo "<br/>".$school['id']." Completed"; 
		} */
	}
	
	/*----------------- Blessedangel User Insert --------------------*/
	public function blesseduser()
	{
		/* $arrofSchools =array(0=>array("id"=>3),1=>array("id"=>4),2=>array("id"=>5));
		//echo "<pre>";print_r($arrofSchools);exit;
		foreach($arrofSchools as $school)
		{
			$arrofuserdata = $this->Dashboard_model->getBlessedUser($school['id']);
			$startdate = '2020-01-01';
			$enddate = '2020-01-31';
			//echo "<pre>";print_r($arrofuserdata);exit;
			foreach($arrofuserdata as $user)
			{
				$this->Dashboard_model->InsertBlessedUser($user['fname'],$user['lname'],$user['email'],$user['password'],$user['sid'],$user['incontestid'],$user['incontestlevelid'],$user['grade_id'],$user['section'],$user['salt1'],$user['salt2'],$user['org_pwd'],$user['school_name'],$startdate,$enddate,$user['program_type'],$user['actual_grade'],$user['assigned_grade']);
			}
			echo "<br/>".$school['id']." Completed"; 
		} */
	}
}
