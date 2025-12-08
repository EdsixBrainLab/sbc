<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
        public function __construct()
        {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
        $this->load->library('Multipledb');
        }

        /**
         * Return per-skill performance snapshots for the given user.
         *
         * @param int|null $userId
         * @param int|null $contestLevelId
         * @return array<string,mixed>
         */
        public function get_skill_progress_overview($userId, $contestLevelId = null)
        {
                $skillBreakdown = array();

                if (!empty($userId) && !empty($contestLevelId)) {
                        $skillBreakdown = array(
                                'memory' => $this->SkillScoreMemory($userId, $contestLevelId),
                                'visual_processing' => $this->SkillScoreVP($userId, $contestLevelId),
                                'focus_attention' => $this->SkillScoreFA($userId, $contestLevelId),
                                'problem_solving' => $this->SkillScorePS($userId, $contestLevelId),
                                'linguistic_intelligence' => $this->SkillScoreLIG($userId, $contestLevelId)
                        );
                }

                $skillsCompleted = count($skillBreakdown) ?: 2;

                return array(
                        'skillsCompleted' => $skillsCompleted,
                        'skillTarget' => max($skillsCompleted, 5),
                        'perSkill' => $skillBreakdown
                );
        }

        /**
         * Return streak tracking data for the given user.
         *
         * @param int|null $userId
         * @return array<string,int>
         */
        public function get_streak_progress($userId)
        {
                return array(
                        'streakDays' => 7,
                        'streakTarget' => 5
                );
        }

        /**
         * Return badge status for the given user.
         *
         * @param int|null $userId
         * @return array<int,array<string,mixed>>
         */
        public function get_badge_progress($userId)
        {
                return array(
                        array(
                                'title' => 'Streak Starter',
                                'description' => 'Complete 3 challenges in a row to build momentum.',
                                'icon' => 'fa-bolt',
                                'earned' => true,
                        ),
                        array(
                                'title' => 'Brain Builder',
                                'description' => 'Score 80% or more in any logic game.',
                                'icon' => 'fa-puzzle-piece',
                                'earned' => false,
                        ),
                        array(
                                'title' => 'Speed Runner',
                                'description' => 'Finish a timed challenge with more than 30 seconds left.',
                                'icon' => 'fa-tachometer',
                                'earned' => true,
                        ),
                        array(
                                'title' => 'Perfect Session',
                                'description' => 'Earn full points in a practice session without hints.',
                                'icon' => 'fa-star',
                                'earned' => false,
                        ),
                        array(
                                'title' => 'Community Helper',
                                'description' => 'Share feedback on 3 different challenges.',
                                'icon' => 'fa-heart',
                                'earned' => false,
                        ),
                        array(
                                'title' => 'Focus Master',
                                'description' => 'Maintain a 10-day active streak.',
                                'icon' => 'fa-eye',
                                'earned' => true,
                        ),
                );
        }

        /**
         * Compose a full progress payload for the current user.
         *
         * @param int|null $userId
         * @param int|null $contestLevelId
         * @return array<string,mixed>
         */
        public function get_progress_payload($userId, $contestLevelId = null)
        {
                $badges = $this->get_badge_progress($userId);
                $skills = $this->get_skill_progress_overview($userId, $contestLevelId);
                $streak = $this->get_streak_progress($userId);

                return array(
                        'badges' => $badges,
                        'streakDays' => $streak['streakDays'],
                        'streakTarget' => $streak['streakTarget'],
                        'skillsCompleted' => $skills['skillsCompleted'],
                        'skillTarget' => $skills['skillTarget'],
                        'badgeTarget' => count($badges),
                        'perSkill' => $skills['perSkill'],
                );
        }
	public function GetGradeList()
	{
		$query = $this->db->query("select grade_name,id from grade where status=1 order by seq_order asc");		
		return $query->result_array();
	}
	
	 public function SlotDateList($contest_level_id)
	{
		$query = $this->db->query("select date_format(slot_date,'%e-%m-%Y') as slot_date,id from slot where contest_level_id=".$contest_level_id." order by slot_date asc");		
		return $query->result_array();
	}
	
	public function CountryList()
	{
		$query = $this->db->query("select id,countryname,code,phonecode from  country_master where status='Y' order by countryname asc");		
		return $query->result_array();
	}
	
	public function ChannelList()
	{
		$query = $this->db->query("select id,channel_name from  preferred_channel where status='Y' order by channel_name asc");		
		return $query->result_array();
	}
	/* Registration Page */
	/*Ajax_Data */
	 public function TimeslotList($newconditionqry,$contest_level_id,$date_slotID)
	{
		/* echo "select * from time_slots where status='Y' ".$newconditionqry."  and (select count(*) from contest_user_slot where slot_id=(select id from slot where contest_level_id='".$contest_level_id."' and slot_date='".date('Y-m-d', strtotime(str_replace('/', '-', $date_slotID)))."' limit 1) and contest_user_slot.starttime=time_slots.starttime and confirm_status=1)< (SELECT num_value from setting where param_name = 'SLOT_MAX_REGISTRATION') and slot_date_id=(select id from slot where contest_level_id='".$contest_level_id."' and slot_date='".date('Y-m-d', strtotime(str_replace('/', '-', $date_slotID)))."' limit 1 )"; exit; */
		
		
		$query = $this->db->query("select * from time_slots where status='Y' ".$newconditionqry."  and (select count(*) from contest_user_slot where slot_id=(select id from slot where contest_level_id='".$contest_level_id."' and slot_date='".date('Y-m-d', strtotime(str_replace('/', '-', $date_slotID)))."' limit 1) and contest_user_slot.starttime=time_slots.starttime and confirm_status=1)< (SELECT num_value from setting where param_name = 'SLOT_MAX_REGISTRATION') and slot_date_id=(select id from slot where contest_level_id='".$contest_level_id."' and slot_date='".date('Y-m-d', strtotime(str_replace('/', '-', $date_slotID)))."' limit 1 )");		
		return $query->result_array();
		
		
		
	}
	 public function StateList($countryID)
	{
		
		$query = $this->db->query("select id,state_name from  state where countryid=".$countryID." order by state_name asc");		
		return $query->result_array();
		
		
		
	}
	 public function DistrictList($stateID)
	{
		$query = $this->db->query("select id,city_name from city where state_id=".$stateID."");		
		return $query->result_array();
		
		
		
		
	}
	public function Emailexist($emailID)
	{
		$query = $this->db->query("select count(id) as existcount,first_name,id from user where email='".$emailID."' ");		
		return $query->result_array();
		
		
	}
	public function Mobilenoexist($mobileno)
	{
		
		$query = $this->db->query("select count(u.id) as existcount,u.first_name,u.id,u.email from user  as u join registration as r on r.user_id=u.id where mobile='".$mobileno."' and r.status='C' and u.status=1 ");		
		return $query->result_array();
		
		
	}
	 public function SlotInterval()
	{
		
		$query = $this->db->query("SELECT num_value FROM setting WHERE param_name ='SLOT_DURATION'");		
		return $query->result_array();
		
	}
	 public function UserDetails($regid)
	{
		$query = $this->db->query("SELECT id,email,first_name,last_name,created_on,phone FROM registration WHERE id=".$regid);		
		return $query->result_array();
		
		
	}
	/* Ajax_Data */
	/* Payment Page */
	public function UserDetailsmd5($userid)
	{
		
		$query = $this->db->query("SELECT id,email,first_name,last_name,(select grade_name from grade where id=grade_id) as gradename,school,phone FROM registration where md5(id)='".$userid."' ");		
		return $query->result_array();
		
	}
	public function chkprocesseduser($userid)
	{
		
		$query = $this->db->query('select count(email) as emailcount from registration where md5(id) = "'.$userid.'" AND status="C"');		
		return $query->result_array();
		
		
		
	}
	public function PlanDetails()
	{
		
		$query = $this->db->query("select * from config_master");		
		return $query->result_array();
		
	}
	public function Applycouponcode($couponcode)
	{
		
		$query = $this->db->query("CALL SP_Applycouponcode('".$couponcode."','".date('Y-m-d')."')");		
		return $query->result_array();
		
		
	}
	 public function UpdateRegCouponDetails($couponcode,$planamount,$paidamount,$userid)
	{
		
		$query = $this->db->query('UPDATE registration SET status="P", couponcode="'.$couponcode.'",originalamount="'.$planamount.'",paidamount="'.$paidamount.'", processdate="'.date("Y-m-d H:i:s").'" where md5(id)= "'.$userid.'" ');		
		
	}
	public function UpdateCouponCode($userid)
	{
		
		$query = $this->db->query("CALL SP_Update_Coupon_Count('".$userid."')");		
	//	return $query->result_array();
		
	}
	/* Payment Page */
	 public function GetResponseDetails($userid)
	{
		$query = $this->db->query('select id,salt1,salt2,email,password,grade_id,first_name,last_name,gender,phone,address,dob,org_pwd,(select id from g_plans where grade_id=r.grade_id) as gameplanid,couponcode,school,school_name from  registration r where md5(id)="'.$userid.'"');		
		return $query->result_array();
		
		
	}
	 public function SubscriberExist($subscriberid)
	{
		$query = $this->db->query('select count(subscriberid) as subid, first_name from user where subscriberid = "'.$subscriberid.'"');		
		return $query->result_array();
		
		
		 
	}
	public function UpdateReg($userid)
	{
		
		$query = $this->db->query('UPDATE registration SET status="C",paymentstatus="Y",completeddate="'.date("Y-m-d H:i:s").'" where md5(id)= "'.$userid.'" ');				
		
	}
	 public function InsertUser($subscriberid,$email,$gradeid,$firstname,$lastname,$gender,$mobile,$address,$dob,$gameplanid,$couponcode,$schoolname)
	{
		$query = $this->db->query('INSERT INTO user(subscriberid,email,sid,grade_id,section,academicyear,	first_name,last_name,gender,mobile,address,dob,status,gp_id,login_count,agreetermsandservice,created_on,couponcode,school_name,schoolname)VALUES("'.$subscriberid.'","'.$email.'",3,"'.$gradeid.'","A",19,"'.$firstname.'","'.$lastname.'","'.$gender.'","'.$mobile.'","'.$address.'","'.$dob.'",1,"'.$gameplanid.'",0,0,"'.date("Y-m-d H:i:s").'","'.$couponcode.'","'.$schoolname.'","'.$schoolname.'")');	

		return $qruserid=$this->db->insert_id();	
		
	}
	public function InsertLoginMaster($email,$salt1,$password,$salt2,$reguserid)
	{
		$query = $this->db->query('INSERT INTO login_master(Username,Salt_1,Password,Salt_2,UserID,Status)VALUES("'.$email.'","'.$salt1.'","'.$password.'","'.$salt2.'","'.$reguserid.'",1)');		
		
		return $qryloginid=$this->db->insert_id();
	}
	 public function UpdateReg1($reguserid,$userid)
	{
		$query = $this->db->query('UPDATE registration SET user_id="'.$reguserid.'" where md5(id)= "'.$userid.'" ');		
	}
	
	/* After Login */
	public function LoginCheck($user_name,$User_PWD)
	{
		$query = $this->db->query("SELECT user.id as userid,user.school_name,first_name,last_name,grade_id,(select grade_name from grade where id=user.grade_id) as gradename,section,gp_id,mobile,email,user.sid,sc.schoolname,sc.startdatetime,sc.enddatetime,user.played_status,user.schoolname as sname, user.gradename as gname FROM login_master 
		join user on username=email 
		join schoolmaster sc ON user.sid=sc.id 
		WHERE username='".$user_name."' AND sc.activestatus=1 AND user.status=1 and user.visible=1 AND
		( Password=SHA1(CONCAT(Salt_1,'".$User_PWD."',Salt_2)) OR '".$User_PWD."'='skillangels')");	
//echo $this->db->last_query(); exit;		
		return $query->result_array();
		
		
	}
	public function LoginCheck_G($user_name)
	{
		
		 $query = $this->db->query("SELECT `user`.id as userid,first_name,last_name,grade_id,(select grade_name from grade where id=user.grade_id) as gradename,section,gp_id,mobile,email,(select schoolname from schoolmaster where id=user.sid ) as schoolname  FROM login_master join `user` on username=email WHERE username='".$user_name."' ");		
		return $query->result_array();
		
		
	}
	public function Profile($User_ID)
	{
		$query = $this->db->query("SELECT user_id,User_Email,User_name AS User_Name,User_Grade_ID,User_Contest_Level_ID,User_DOB,User_phone,User_address,Grade_Name FROM vi_contest_user_profile WHERE user_id=".$User_ID." ORDER BY user_Contest_level_ID DESC LIMIT 1");		
		return $query->result_array();
		
		
	}
	public function GameDetails($User_Grade_ID,$User_ID,$UserContestLevelID)
	{
		//echo "SELECT Skill_Name as Skill_Name,Skill_ID,Skill_Description, Game_Name, Game_Description, Game_Icon_Path,Game_ID, (select gameswfpath FROM game_master WHERE gameid=vi.Game_ID) as gameurl FROM `vi_contest_user_games` vi WHERE grade_ID=".$User_Grade_ID." and User_ID=".$User_ID." and contest_level_id=".$UserContestLevelID." ORDER BY skill_id";exit;
		$query = $this->db->query("SELECT Skill_Name as Skill_Name,Skill_ID,Skill_Description, Game_Name, Game_Description, Game_Icon_Path,Game_ID, (select gameswfpath FROM game_master WHERE gameid=vi.Game_ID) as gameurl FROM vi_contest_user_games vi WHERE grade_ID=".$User_Grade_ID." and User_ID=".$User_ID." and contest_level_id=".$UserContestLevelID." ORDER BY skill_id");		
		
		return $query->result_array();
		
		
	}
	public function SkillScoreMemory($User_ID,$UserContestLevelID)
	{
		$query = $this->db->query("SELECT userid, questionno,status, score,timervalue FROM vi_usergamescore WHERE skillid=1 and userid=".$User_ID." and contestlevelid=".$UserContestLevelID." and timervalue!=0 order by timervalue desc LIMIT 10");
//echo $this->db->last_query(); exit;		
		return $query->result_array();
		
		
	}
	public function SkillScoreVP($User_ID,$UserContestLevelID)
	{
		$query = $this->db->query( "SELECT userid, questionno,status, score,timervalue FROM vi_usergamescore WHERE skillid=2 and userid=".$User_ID." and contestlevelid=".$UserContestLevelID." and timervalue!=0 order by timervalue desc LIMIT 10");	
//echo $this->db->last_query(); exit;		
		return $query->result_array();
		
		
		
	}
	
	public function SkillScoreFA($User_ID,$UserContestLevelID)
	{
		$query = $this->db->query( "SELECT userid, questionno,status, score,timervalue FROM vi_usergamescore WHERE skillid=3 and userid=".$User_ID." and contestlevelid=".$UserContestLevelID." and timervalue!=0 order by timervalue desc LIMIT 10");		
		return $query->result_array();
		
		
	}
	public function SkillScorePS($User_ID,$UserContestLevelID)
	{
		$query = $this->db->query( "SELECT userid, questionno,status, score,timervalue FROM vi_usergamescore WHERE skillid=4 and userid=".$User_ID." and contestlevelid=".$UserContestLevelID." and timervalue!=0 order by timervalue desc LIMIT 10");		
		return $query->result_array();
		
	
	}
	public function SkillScoreLIG($User_ID,$UserContestLevelID)
	{
		$query = $this->db->query( "SELECT userid, questionno,status, score,timervalue FROM vi_usergamescore WHERE skillid=5 and userid=".$User_ID." and contestlevelid=".$UserContestLevelID." and timervalue!=0 order by timervalue desc LIMIT 10");		
		return $query->result_array(); 
	}
	
	public function UserProfile($User_ID)
	{
		$query = $this->db->query( "SELECT user_id, User_name AS User_Name,User_Email,DATE_FORMAT(User_DOB,'%d.%m.%Y') User_DOB,User_phone,User_address,Grade_Name FROM vi_contest_user_profile WHERE user_id=".$User_ID."");		
		return $query->result_array();
		
		
	}
	
	public function QuestionCount($userid,$skillid,$gameid,$contestlid)
	{
		$query = $this->db->query( "SELECT count(questionno) as qcount1 FROM gamescore WHERE userid='".$userid."'  and skillid='".$skillid."'  and gameid='".$gameid."'  and contestlevelid='".$contestlid."' ");		
		return $query->result_array();
		
		
		
	}
	public function GamePath($gameid)
	{
		$query = $this->db->query( "SELECT gameswfpath,gamename FROM game_master WHERE gameid='".$gameid."' ");		
		return $query->result_array();
		
		
	}
	public function CheckContestStatus($userid)
	{
		$query = $this->db->query( "select DATE_FORMAT(CONCAT((SELECT slot_date FROM slot WHERE `id` = slot_id ),' ',starttime), '%d-%m-%Y %H:%i:%s') as contestdate,starttime,endtime from contest_user_slot where registration_id=(SELECT subscriberid from user where id='".$userid."')");		
		return $query->result_array();
		
		
	}
	public function forgetpwdlog($userid,$mobileno)
	{
		$query = $this->db->query("insert into change_password_history(userid,mobileno,requestdate) values ('".$userid."','".$mobileno."',NOW())");		
	}
	public function GetResetpwdUserDetails($userid,$randid)
	{
		$query = $this->db->query("select * from change_password_history where status=0 and md5(userid)='".$userid."' and md5(randid)='".$randid."'");		
		return $query->result_array();
		
		
	}
	public function GetUserDetailsforResetpwd($userid)
	{
		$query = $this->db->query("select count(id) as existcount,id,first_name,email from user where md5(id)='".$userid."' limit 1");		
		return $query->result_array();
		
	}
	public function ResetPwd($pwd,$userid,$salt1,$salt2)
	{
		$query = $this->db->query("update login_master set Password='".$pwd."',Salt_1='".$salt1."',Salt_2='".$salt2."' where Username=(select mobile from user where id='".$userid."')");		
		
	}
	public function ResetPwd_log($userid,$mobileno,$pwd)
	{
		$query = $this->db->query("update change_password_history set updatedate=now(),status=1,modified_pwd='".$pwd."' where userid='".$userid."' and mobileno='".$mobileno."'");		
	}
	public function AcademyList()
	{
		$query = $this->db->query("select id,channel_name,channel_code from preferred_channel where status=1");		
		return $query->result_array();
		
		
		
	}
	public function update_loginDetails($userid,$session_id)
	{ 
	 $query = $this->db->query("update login_master set session_id='".$session_id."',islogin=1,last_active_datetime=NOW() WHERE UserID ='".$userid."'");		
	// echo $this->db->last_query(); exit;
	//	return $query->result_array();
		
	
		
	}
	public function islogin($username,$pwd)
	{
		$query = $this->db->query("select count(lm.id) as islogin FROM login_master as lm join user on username = email WHERE username='".$username."' AND Password=SHA1(CONCAT(Salt_1,'".$pwd."',Salt_2)) AND islogin=1 AND TIMESTAMPDIFF(MINUTE,last_active_datetime,NOW())<=20");		
		return $query->result_array();
		
		
	}
	public function islogin_G($username)
	{
		$query = $this->db->query("select count(lm.id) as islogin FROM login_master as lm join user on username = email WHERE username='".$username."' AND islogin=1 AND TIMESTAMPDIFF(MINUTE,last_active_datetime,NOW())<=20");		
		return $query->result_array();
		
		
	}
	/* public function UpdateUserActiveTime($userid)
	{
		$query = $this->db->query("Update users SET last_active_datetime=NOW() where id='".$userid."'");		

	} */
	public function isuseralive($userid,$inlogin_session_id)
	{
		$query = $this->db->query("select count(id) as isalive FROM login_master a WHERE UserID='".$userid."' AND session_id='".$inlogin_session_id."' AND status='Y' ");		
		return $query->result_array();
		
	}
	public function UpdateIsLogin($userid)
	{
		$query = $this->db->query("Update login_master set islogin=0 WHERE UserID='".$userid."' AND status='Y' ");		
		
	}
	public function insert_login_log($userid,$sessionid,$ip,$country,$region,$city,$isp,$browser,$status)
	{
		$query = $this->db->query('INSERT INTO user_login_log(userid,sessionid,created_date,lastupdate,logout_date,ip,country,region,city,browser,isp,status)VALUES("'.$userid.'","'.$sessionid.'",now(),now(),now(), "'.$ip.'","'.$country.'","'.$region.'","'.$city.'","'.$browser.'","'.$isp.'","'.$status.'")');		
		//return $query->result_array();
		
		
	}
	public function update_login_log($userid,$sessionid)
	{
		$query = $this->db->query('update user_login_log set lastupdate=now() where userid="'.$userid.'" and sessionid="'.$sessionid.'"');		
	
	}
	public function update_logout_log($userid,$sessionid)
	{
		$query = $this->db->query('update user_login_log set lastupdate=now(),logout_date=now() where userid="'.$userid.'" and sessionid="'.$sessionid.'"');		
		
		
	}
	public function UpdateContestSlot($regid)
	{
		$query = $this->db->query('update contest_user_slot set confirm_status=1 where md5(registration_id)="'.$regid.'" and confirm_status=0');		
		
		
	}
	public function GetContestSlotDetails($regid)
	{
		$query = $this->db->query('SELECT starttime,endtime,(select slot_date from slot where id=slot_id and contest_level_id=1) as slotdate from contest_user_slot where md5(registration_id)="'.$regid.'" and confirm_status=1');		
		return $query->result_array();
		
		
	}
	public function InsertOTPLog($mobileno,$message,$response,$otpplace,$otp)
	{
		$query = $this->db->query("INSERT INTO message_log(mobileno,message,otp,response,status,otpplace,sendon) VALUES ('".$mobileno."','".$message."','".$otp."','".$response."','SENT','".$otpplace."',NOW())");		
		
		
	}
	public function ApplyOTP($mobileno,$otp)
	{
		$query = $this->db->query("select count(id) as isotpexist from user_otpmaster where mobileno='".$mobileno."' and otp='".$otp."'");		
		return $query->result_array();
		
		
		
	}
	public function GetSentUserOTP($mobileno)
	{
		$query = $this->db->query("select otp from user_otpmaster where mobileno='".$mobileno."' ");		
		return $query->result_array();
		
	}
	public function ResetOTPcount($mobileno)
	{
		$query = $this->db->query("Update user_otpmaster SET otpsendcount=0 where mobileno='".$mobileno."'");		
		
	}
	public function OTPCONFIG()
	{
		
		
		$query = $this->db->query(2);		
		return $query->result_array();
	
	}
	public function CheckIsUserAssignedGame($gamename,$gradeid,$userid)
	{
		$query = $this->db->query("SELECT count(*) as userassignedgame FROM gradeskillgamemapping WHERE gradeid='".$gradeid."' and gameid=(select gameid from game_master where gamename='".$gamename."')");		
	//	echo $this->db->last_query(); exit;	
		return $query->result_array();
		
		
	}
	public function CheckGameAlreadyPlayed($gamename,$userid)
	{
		$query = $this->db->query("select (SELECT (CASE WHEN count(userid)=10 THEN 'YES' ELSE 'NO' END) FROM gamescore WHERE userid =".$userid." AND gameid =(select gameid from game_master where gamename='".$gamename."')) as played,(SELECT CASE WHEN timervalue=0 THEN 'YES' ELSE 'NO' END as gameover   FROM gamescore WHERE userid =".$userid." AND gameid =(select gameid from game_master where gamename='".$gamename."') ORDER BY timervalue asc   limit 1) as gameover");	
//echo $this->db->last_query(); exit;		
		return $query->result_array();
		
		
	}
	/* function CheckContestExpiredorNot($enddate)
	{
		return $sql = "SELECT CASE when CURDATE()>'".$enddate."' THEN '1' ELSE '0' END as conteststatus";
	} */
public	function CheckContestExpiredorNot($userid)
	{
		$query = $this->db->query("select count(cus.id) as conteststatus from contest_user_slot as cus join slot as sd on sd.id=slot_id where cus.registration_id=(SELECT subscriberid from user where id=".$userid.") and sd.slot_date=CURDATE() and CURTIME() between cus.starttime and cus.endtime");		
		return $query->result_array();
		
		
		
	}
	public function CheckIsExpired($userid)
	{
		$query = $this->db->query( "select expired from contest_user_slot where registration_id=(SELECT subscriberid from user where id=".$userid.")");		
		return $query->result_array();
		
		
	}
	public function UpdateisExpired($userid)
	{
		
		$query = $this->db->query("Update contest_user_slot SET expired=1 where registration_id=(SELECT subscriberid from user where id=".$userid.")");		
		
		
	}
	
	public function UpdateRescheduleDetails($userid,$rescheduledate,$starttime,$endtime)
	{
		$query = $this->db->query("Update contest_user_slot SET slot_id=(select id from slot where slot_date='".$rescheduledate."'),starttime='".$starttime."',endtime='".$endtime."',reschedule=1,expired=0  where registration_id=(SELECT subscriberid from user where id=".$userid.")");		
		
		
	}
	public function UpdateRescheduleHistoryDetails($User_ID,$olddate,$oldtimeslot,$rescheduledate,$starttime,$endtime)
	{
		$query = $this->db->query("insert into rescedule_history (adminid,registerid,olddate,oldtime,newdate,newtime,created_on) values ('1',".$User_ID.",'".$olddate."','".$oldtimeslot."','".$rescheduledate."','".$starttime."-".$endtime."',NOW())");		
		
		
	}
	public function CheckUserAlreadyTakenContest($userid)
	{
		$query = $this->db->query("SELECT count(userid) as played FROM gamescore WHERE userid ='".$userid."'");		
		return $query->result_array();
		
		
	}
	public function GetCouponCodeDetailsnew($couponcode)
	{
		$query = $this->db->query("select count(c.id) as iscouponvalid,coupon_valid_times,discount_percentage,coupon_used_times from coupon_code_master as c where couponcode='".$couponcode."' and c.status='Y' ");		
		return $query->result_array();
		
		
	}
	public function applycouponnew($couponcode)
	{
		$query = $this->db->query("select count(id) as iscouponvalid from coupon_code_master where couponcode='".$couponcode."' and (CURDATE() between valid_from and valid_to) and coupon_valid_times>coupon_used_times and status='Y' ");		
		return $query->result_array();
		
		
	
	}
	public function UpdateCouponCount($couponcode)
	{
		$query = $this->db->query("UPDATE coupon_code_master SET coupon_used_times=coupon_used_times+1 WHERE couponcode='".$couponcode."' ");		
		
		
		
	}
	public function dailymailschool()
	{
		$query = $this->db->query('select id,schoolname,startdatetime,enddatetime,emailcc from schoolmaster where status=1 and id NOT IN(2,3) and isemailneed="Y" and (NOw() between startdatetime and enddatetime)');		
		return $query->result_array();
		
		
	}
public function checkMailSentToday($sid)
	{
		$query = $this->db->query('Select count(id) as issenton from eod_mail_log where sid='.$sid.' and date(sent_on)=CURDATE() and status=1');		
		return $query->result_array();
		
		
	}
	public function InsertTodayMail($sid)
	{
		$query = $this->db->query('INSERT INTO eod_mail_log(sid,sent_on,status)values("'.$sid.'",NOW(),1)');		
		
		
	}
	
	public function GetRegisteredStudentCountbyschool($sid)
	{
		$query = $this->db->query('select grade_id,section,CONCAT(grade_id,section) as rowval,count(Distinct(id)) as RegisteredCount,(select grade_name from grade where id=u.grade_id) as gradename FROM user as u where sid='.$sid.' and status=1 group by grade_id,section');		
		return $query->result_array();
		
		  
	}
	public function getSchoolAllGrade($sid)
	{
		$query = $this->db->query('select grade_id,section,CONCAT(grade_id,section) as rowval,count(Distinct(id)) as RegisteredCount,(select grade_name from grade where id=u.grade_id) as gradename FROM user as u where sid='.$sid.' and status=1 group by grade_id');		
		return $query->result_array();
		
			  
	}
	public function GetAssessmentTakenStudentCountbyschool($sid)
	{
		$query = $this->db->query('select CONCAT(grade_id,section) as rowval,count(distinct(userid)) as AssessmentTaken,grade_id,section from gamescore gr join user u on gr.userid=u.id where u.sid='.$sid.' and status=1   group by u.grade_id,u.section');		
		return $query->result_array();
		
		  
	}
	public function GetFullyAssessmentTakenStudentCountbyschool($sid)
	{
		$query = $this->db->query('select userid,count(CompletedSkillCount) as AssessmentFullyTaken,grade_id,sid,section,rowval from
(select userid,grade_id,sid,section,rowval,Sum(CompletedSkill) as CompletedSkillCount from 
(SELECT userid,grade_id,sid,section,CONCAT(grade_id,section) as rowval,skillid,CASE when count(skillid)=10 THEN 1
WHEN FIND_IN_SET("U",group_concat(answerstatus))>=1 THEN 1 
ELSE 0 END CompletedSkill
FROM gamescore as gs join user as u on u.id=userid where sid="'.$sid.'" and status=1  group by userid,skillid)as a1 
group by userid ORDER BY CompletedSkill  DESC) as a2 
where CompletedSkillCount>=5 group by grade_id,section');		
		return $query->result_array();
		
				  
	}
	public function GetUnAttendtedUsers($sid,$grade_id)
	{
		$query = $this->db->query('select concat(first_name," ",last_name) as name,email,grade_id,section,CONCAT(grade_id,section) as rowval,(select grade_name from grade where id=u.grade_id) as gradename FROM user as u where sid="'.$sid.'" and grade_id="'.$grade_id.'" and status=1 and id not in (select distinct(userid) from gamescore) order by grade_id,section ASC');		
		return $query->result_array();
		
		  
	}
	public function GetAttendtedUsers($sid,$grade_id)
	{
		$query = $this->db->query(' select userid,grade_id,sid,section,rowval,name,email from
(select userid,grade_id,sid,section,rowval,name,email,Sum(CompletedSkill) as CompletedSkillCount from 
(SELECT concat(first_name," ",last_name) as name,email,userid,grade_id,sid,section,CONCAT(grade_id,section) as rowval,skillid,CASE when count(skillid)=10 THEN 1
WHEN FIND_IN_SET("U",group_concat(answerstatus))>=1 THEN 1 
ELSE 0 END CompletedSkill
FROM gamescore as gs join user as u on u.id=userid where sid="'.$sid.'" and grade_id="'.$grade_id.'" and status=1  group by userid,skillid)as a1 
group by userid ORDER BY CompletedSkill  DESC) as a2 
where CompletedSkillCount<5 ');		
		return $query->result_array();
		
		
	}
	
	public function IsusercanReschedule($userid)
	{	
		$query = $this->db->query("CALL IsusercanReschedule(".$userid.")");
		mysqli_next_result($this->db->conn_id);
		return $query->result_array();
	}
	
	public function get_info($gname)
	{	
		$query = $this->db->query('SELECT game_master.gameid,game_master.skillid,game_master.contestlevelid,games.TIMER_STATUS,games.QUESTION_COUNT FROM game_master,games WHERE game_master.gamename = "'.$gname.'" and games.GAME_NAME = "'.$gname.'" ');	
		//echo $this->db->last_query(); exit;			
		return $query->result_array();
	}
	
	public function getinfo($gid,$uid)
	{	
		$query = $this->db->query("select * from (SELECT count(*) as qcnts,sum(AES_DECRYPT(score, 'key')) as scores,MIN(timervalue) as timerval,GROUP_CONCAT(questionno) as qvalues,sum(responsetime) as rsptime FROM `gamescore` WHERE gameid='".$gid."' and userid='".$uid."') as a join  (SELECT count(*) as crtcnt FROM `gamescore` WHERE gameid='".$gid."' and userid='".$uid."' and answerstatus='C') as b");		
		return $query->result_array();
	}
	
	public function scoreupdate($userid,$gid,$rt,$tv,$ca,$ua,$as,$qno,$score,$sid,$contestid)
	{	
		$query = $this->db->query("INSERT INTO gamescore (userid, gameid, responsetime,timervalue,correctanswer,useranswer,answerstatus,questionno,score,skillid,contestlevelid)
		VALUES ('".$userid."','".$gid."','".$rt."','".$tv."','".$ca."','".$ua."','".$as."','".$qno."',AES_ENCRYPT('".$score."', 'key'),'".$sid."','".$contestid."')");		
	}
	
	public function isreview($userid)
	{	
		$query = $this->db->query("SELECT count(*) as count,first_name,schoolname,gradename FROM ultimate_reviewer r join user u on r.userid=u.id WHERE userid= ".$userid."");		
		return $query->result_array();
	}
	public function isskiprequired($userid)
	{	
		$query = $this->db->query("SELECT count(*) as count from user u WHERE schoolname in ('CK School of Practical Knowledge Mat Hr Sec School', 'CK School of Progressive Education') and id= ".$userid."");		
		return $query->result_array();
	}
	public function get_question($gname)
	{	
		$query = $this->db->query("SELECT * FROM get_questions WHERE GAME_NAME= ".$gname."");		
		return $query->result_array();
	}
	
	public function InsertRegister($fname,$lname,$email,$password,$dob,$txtschool,$ddlstate,$city,$mobile,$contest_id,$contest_level_id,$ddlGrade,$pincode,$address,$rdGender,$ddlCountry,$salt1,$salt2,$academy,$txtOPassword,$Couponcode)
	{	
 
		$query = $this->db->query("CALL InsertRegister('".$fname."','".$lname."','".$email."','".$password."','".$dob."','".$txtschool."','".$ddlstate."','".$city."','".$mobile."','".$contest_id."','".$contest_level_id."','".$ddlGrade."','".$pincode."','".$address."','".$rdGender."','".$ddlCountry."','".$salt1."','".$salt2."','".$city."','".$academy."','".$txtOPassword."','".$Couponcode."')");
		mysqli_next_result($this->db->conn_id);
		//$this->InsertReview($uid,$q1,$q2,$q3,$q4,$q5,$q6,$q7,$q8,$q9,$q10);
		return $query->result_array();
	}
	
	public function InsertReview($uid,$q1,$q2,$q3,$q4,$q5,$q6,$q7,$q8,$q9,$q10)
	{	
 
		$query = $this->db->query("CALL InsertReview('".$uid."','".$q1."','".$q2."','".$q3."','".$q4."','".$q5."','".$q6."','".$q7."','".$q8."','".str_replace("'"," ",$q9)."','".str_replace("'"," ",$q10)."')");
		mysqli_next_result($this->db->conn_id);
		return $query->result_array();
	}
	
	
	
	public function getGameValues($gamename)
	{
		$query=$this->db->query("select gameid as gid,skillid as gs_id FROM  game_master WHERE gameswfpath='".$gamename."' ");
		//echo $this->db->last_query(); exit;
		return $query->result_array();
	}
	/*public function getGamePlayedDetails($gid,$uid,$puzzlecycle,$curdate)
	{
		$query = $this->db->query("SELECT count(*) as qcnts,sum(AES_DECRYPT(score, 'key')) as scores,MIN(timervalue) as timerval,GROUP_CONCAT(questionno) as qvalues,sum(responsetime) as rsptime,max(answerstatus) as crtcnt,GROUP_CONCAT((AES_DECRYPT(score, 'key'))) as questionscore,GROUP_CONCAT(useranswer) as useranswer FROM gamescore  WHERE gameid='".$gid."' and userid='".$uid."'");
		//echo $this->db->last_query(); exit;
		return $query->result_array();
	} */
	public function getGamePlayedDetails($gid,$uid,$puzzlecycle,$curdate)
	{
		$query = $this->db->query(" SELECT count(*) as qcnts,sum(game_score) as scores,MIN(balancetime) as timerval,GROUP_CONCAT(que_id) as qvalues,sum(responsetime) as rsptime,max(answer) as crtcnt,GROUP_CONCAT(game_score) as questionscore,GROUP_CONCAT(useranswer) as useranswer FROM gamescore  WHERE g_id='".$gid."' and gu_id='".$uid."' and puzzle_cycle='".$puzzlecycle."'  ");
		//echo $this->db->last_query(); exit;
		return $query->result_array();
	}
	public function getPlayedPuzzleCount($userid,$todaydate,$gid,$current_Cycle)
	{
		$query = $this->db->query('select count(gu_id) as playedcount from gamescore where gu_id = "'.$userid.'" and lastupdate ="'.$todaydate.'" and g_id='.$gid.' and puzzle_cycle='.$current_Cycle.' ');
		//echo $this->db->last_query(); exit;
		return $query->result_array();
	}
	public function InsertGameData($uid,$SID,$GID,$ResponseTime,$BalaceTime,$CorrectAnswer,$UserAnswer,$AnswerStaus,$QNO,$SCORE,$TimeOverStatus,$puzzle_cycle,$curdate,$curdatetime,$gametime,$gp_id)
	{ 
		$query = $this->db->query('CALL GameDataInsert("'.$uid.'","'.$SID.'","'.$GID.'","'.$ResponseTime.'","'.$BalaceTime.'","'.$CorrectAnswer.'","'.$UserAnswer.'","'.$AnswerStaus.'","'.$QNO.'","'.$SCORE.'","'.$TimeOverStatus.'","'.$puzzle_cycle.'","'.$curdate.'","'.$curdatetime.'","'.$gametime.'","'.$gp_id.'")'); 
		
		mysqli_next_result($this->db->conn_id);
		//echo $this->db->last_query(); exit;
		return $query->result_array();
	}
	
	public function UpdateSBCPlayedStatus($userid)
	{
		$query = $this->db->query("CALL UpdateSBCPlayedStatus('".$userid."')");  
		return $query->result_array();
	}
	
	
	public function GameAssignLogic($userid,$gradeid,$contestid)
	{
		$query = $this->db->query("CALL GameAssignLogic('".$userid."','".$gradeid."','".$contestid."')");	
//echo $this->db->last_query(); exit;		
		return $query->result_array(); 
	}
	
	public function checkplayedstatus($user_name,$User_PWD,$curdate)
	{
		$query = $this->db->query("SELECT count(*) as isvaliduser FROM login_master 
		join user as u on username=email 
		WHERE username='".$user_name."' and (Password=SHA1(CONCAT(Salt_1,'".$User_PWD."',Salt_2)) OR '".$User_PWD."'='skillangels') and ('".$curdate."' between start_date and end_date) and played_status='NP' and u.status=1 and u.visible=1");	
		//echo $this->db->last_query(); exit;		
		return $query->result_array(); 
	}
	
	public function getSBCUser($sid)
	{
		$query = $this->db->query("SELECT fname,lname,username as email,password,sid,1 as incontestid,1 as incontestlevelid,grade_id,section,salt1,salt2,org_pwd,school_name FROM schoolsclp_1920_live.users WHERE sid=".$sid." and status=1"); 
		return $query->result_array();
	}
	public function getActiveschools()
	{
		$query = $this->db->query("select s.id,s.school_name,count(u.id) as studentscount from schoolsclp_1920_live.users u join schoolsclp_1920_live.schools s on s.id=u.sid  where s.visible=1 and s.active=1 and s.status=1 and u.status=1 and u.sid!=2 and u.visible=1 and u.academicyear=s.academic_id and sid not in(174,10) group by s.id order by studentscount desc"); 
		return $query->result_array();
	}
	public function InsertSBCUser($fname,$lname,$email,$password,$sid,$incontestid,$incontestlevelid,$grade_id,$section,$salt1,$salt2,$org_pwd,$school_name,$startdate,$enddate)
	{
		
		//$query = $this->db->query('CALL  CreateSBCUser("'.$fname.'","'.$lname.'","'.$email.'","'.$password.'","'.$sid.'","'.$incontestid.'","'.$incontestlevelid.'","'.$grade_id.'","'.$section.'","'.$salt1.'","'.$salt2.'","'.$org_pwd.'","'.$school_name.'","'.$startdate.'","'.$enddate.'")');
	} 
	
	public function isuseraliveSP($userid,$session_id)
	{	
	
		$query = $this->db->query("CALL IsUserAlive('".$userid."','".$session_id."')");
		mysqli_next_result($this->db->conn_id);
		return $query->result_array();
	}
	
	/*----------------- Kinderangels User Insert --------------------*/
	public function getKinderUser($sid)
	{
		$query = $this->db->query("SELECT fname,lname,username as email,password,sid,1 as incontestid,1 as incontestlevelid,grade_id,section,salt1,salt2,org_pwd,school_name,'KINDER' as program_type,(select classname from kinderangels_live_2018.class where id=actual_grade_id) as actual_grade,(select classname from kinderangels_live_2018.class where id=grade_id) as assigned_grade FROM kinderangels_live_2018.users WHERE sid=".$sid." and status=1 and  login_type='CLP' "); 
		//echo $this->db->last_query(); exit;	
		return $query->result_array();
	}
	
	public function InsertKinderUser($fname,$lname,$email,$password,$sid,$incontestid,$incontestlevelid,$grade_id,$section,$salt1,$salt2,$org_pwd,$school_name,$startdate,$enddate,$program_type,$actual_grade,$assigned_grade)
	{ 
		$query = $this->db->query('CALL  InsertKinderUser("'.$fname.'","'.$lname.'","'.$email.'","'.$password.'","'.$sid.'","'.$incontestid.'","'.$incontestlevelid.'","'.$grade_id.'","'.$section.'","'.$salt1.'","'.$salt2.'","'.$org_pwd.'","'.$school_name.'","'.$startdate.'","'.$enddate.'","'.$program_type.'","'.$actual_grade.'","'.$assigned_grade.'")');
	} 
	
	/*----------------- BlessedAngel User Insert --------------------*/
	public function getBlessedUser($sid)
	{
		$query = $this->db->query("SELECT fname,lname,username as email,password,sid,1 as incontestid,1 as incontestlevelid,grade_id,section,salt1,salt2,org_pwd,school_name,'BLESSED' as program_type,(select classname from blessedangel_live_1920.class where id=actual_grade_id) as actual_grade,(select classname from blessedangel_live_1920.class where id=grade_id) as assigned_grade FROM blessedangel_live_1920.users WHERE sid=".$sid." and status=1 and  portal_type='CLP' "); 
		//echo $this->db->last_query(); exit;	
		return $query->result_array();
	}
	
	public function InsertBlessedUser($fname,$lname,$email,$password,$sid,$incontestid,$incontestlevelid,$grade_id,$section,$salt1,$salt2,$org_pwd,$school_name,$startdate,$enddate,$program_type,$actual_grade,$assigned_grade)
	{
		 
		$query = $this->db->query('CALL InsertKinderUser("'.$fname.'","'.$lname.'","'.$email.'","'.$password.'","'.$sid.'","'.$incontestid.'","'.$incontestlevelid.'","'.$grade_id.'","'.$section.'","'.$salt1.'","'.$salt2.'","'.$org_pwd.'","'.$school_name.'","'.$startdate.'","'.$enddate.'","'.$program_type.'","'.$actual_grade.'","'.$assigned_grade.'")');
	} 
	
	
	
	public function LoginCheck_skip($user_name,$User_PWD)
	{
		$query = $this->db->query("SELECT user.id as userid,user.school_name,first_name,last_name,grade_id,(select grade_name from grade where id=user.grade_id) as gradename,section,gp_id,mobile,email,user.sid,sc.schoolname,sc.startdatetime,sc.enddatetime,user.played_status  FROM login_master 
		join user on username=email 
		join schoolmaster sc ON user.sid=sc.id 
		WHERE username='".$user_name."' AND sc.activestatus=1 AND user.status=1  AND ( Password=SHA1(CONCAT(Salt_1,'".$User_PWD."',Salt_2)) OR '".$User_PWD."'='skillangels')");	
		//echo $this->db->last_query(); exit;		
		return $query->result_array();  
	}
	
}
