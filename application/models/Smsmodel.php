<?php
Class Smsmodel extends CI_Model
{

 public function __construct()
  {
      parent::__construct();

  }

	public function getYear()
	{
      $sqlYear = "SELECT * FROM edu_academic_year WHERE NOW() >= from_month AND NOW() <= to_month AND status = 'Active'";
      $year_result = $this->db->query($sqlYear);
      $ress_year = $year_result->result();

      if($year_result->num_rows()==1)
      {
        foreach ($year_result->result() as $rows)
        {
            $year_id = $rows->year_id;
        }
        return $year_id;
      }
    }


	public function sendSMS($Phoneno,$Message)
	{
         //Your authentication key
         $authKey = "242202ALE69fBMks5bbee06b";

         //Multiple mobiles numbers separated by comma
         $mobileNumber = "$Phoneno";

         //Sender ID,While using route4 sender id should be 6 characters long.
         $senderId = "ENSYFI";

         //Your message to send, Add URL encoding here.
         $message = urlencode($Message);

         //Define route
         $route = "transactional";

         //Prepare you post parameters
         $postData = array(
             'authkey' => $authKey,
             'mobiles' => $mobileNumber,
             'message' => $message,
             'sender' => $senderId,
             'route' => $route
         );

         //API URL
         $url="https://control.msg91.com/api/sendhttp.php";

         // init the resource
         $ch = curl_init();
         curl_setopt_array($ch, array(
             CURLOPT_URL => $url,
             CURLOPT_RETURNTRANSFER => true,
             CURLOPT_POST => true,
             CURLOPT_POSTFIELDS => $postData
             //,CURLOPT_FOLLOWLOCATION => true
         ));


         //Ignore SSL certificate verification
         curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


         //get response
         $output = curl_exec($ch);

         //Print error if any
         if(curl_errno($ch))
         {
             echo 'error:' . curl_error($ch);
         }
         curl_close($ch);
   }
   
   
	function send_sms_for_teacher_leave($number,$leave_type)
	{
		$textmessage = 'Thank you for the information This is to inform you that your '.$leave_type.' has been approved';
		$notes = urlencode($textmessage);
		$this->sendSMS($number,$notes);
	}


	function send_sms_for_teacher_substitution($tname,$sub_teacher,$sub_tname,$leave_date,$cls_id,$period_id)
	{
			$sql="SELECT teacher_id,name,phone FROM edu_teachers WHERE teacher_id='$sub_teacher'";
			$resultset=$this->db->query($sql);
			$res=$resultset->result();

			foreach($res as $cell){
				$phone = $cell->phone;
			}
			
			$sql1="SELECT cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name FROM edu_classmaster AS cm,edu_class AS c,edu_sections AS s WHERE cm.class_sec_id='$cls_id' AND cm.class=c.class_id AND cm.section=s.sec_id ";
			$resultset1=$this->db->query($sql1);
			$res1=$resultset1->result();
			
			foreach($res1 as $cls){
				$cname=$cls->class_name;
				$sename=$cls->sec_name;
			}
				$textmessage='This is to inform you that as '.$tname.' is on leave,'.$sub_tname.' will be the substitute teacher to fill in for '.$cname.'-'.$sename.',period ('.$period_id.') on '.$leave_date.' ';
				$notes = urlencode($textmessage);

				$this->sendSMS($phone,$notes);
	}




	function send_circular_via_sms($title_id,$notes,$tusers_id,$stusers_id,$pusers_id,$bmusers_id,$users_id)
	{
		$year_id=$this->getYear();
		
		$ssql = "SELECT * FROM edu_circular_master WHERE id ='$title_id'";
		$res = $this->db->query($ssql);
		$result =$res->result();
		foreach($result as $rows)
		{ 
			$title = $rows->circular_title;
			$desc = $rows->circular_description;
			$circular_doc = $rows->circular_doc;
		}

	//-----------------------------Teacher----------------------
	 if($tusers_id!='')
			 {
			     $countid=count($tusers_id);
			     //echo $countid;
				 for ($i=0;$i<$countid;$i++)
				 {
					$userid=$tusers_id[$i];
					$sql="SELECT u.user_id,u.user_type,u.user_master_id,t.teacher_id,t.name,t.phone FROM edu_users AS u,edu_teachers AS t WHERE u.user_id='$userid' AND u.user_type='2' AND u.user_master_id=t.teacher_id";
					$tcell=$this->db->query($sql);
					$res=$tcell->result();
					foreach($res as $row)
					{
						$notes =urlencode($desc);
						$phone = $row->phone;
						$this->sendSMS($phone,$notes);
					}
				}

       }
	//-----------------------------Borad Members----------------------
      if($bmusers_id!='')
      {
           $countid=count($bmusers_id);
           for ($i=0;$i<$countid;$i++)
           {
				$userid=$bmusers_id[$i];
				$sql="SELECT u.user_id,u.user_type,u.user_master_id,t.teacher_id,t.name,t.phone FROM edu_users AS u,edu_teachers AS t WHERE u.user_id='$userid' AND u.user_type='5' AND u.user_master_id=t.teacher_id";
				$tcell=$this->db->query($sql);
				$res=$tcell->result();
				foreach($res as $row)
				{
				  $notes =urlencode($notes);
				  $phone = $row->phone;
				  $this->sendSMS($phone,$notes);
				}
            }
        }
//-----------------------------Students----------------------
	 if($stusers_id!='')
	 {
	   $scountid=count($stusers_id);
		 for ($i=0;$i<$scountid;$i++)
		 {
			$clsid=$stusers_id[$i];
			$sql1="SELECT e.enroll_id,e.admission_id,e.admisn_no,e.name,e.class_id,a.admission_id,a.admisn_no,a.name,a.mobile FROM edu_enrollment AS e,edu_admission AS a WHERE e.class_id='$clsid' AND e.admit_year='$year_id' AND e.admission_id=a.admission_id";
			$scell=$this->db->query($sql1);
			$res1=$scell->result();
			foreach($res1 as $row1)
			{
				$notes =urlencode($notes);
				$phone = $row1->mobile;
				$this->sendSMS($phone,$notes);
			}
		}
	 }

	 //-----------------------------Parents----------------------
	  if($pusers_id!='')
	  {
		 $pcountid=count($pusers_id);
		 for ($i=0;$i<$pcountid;$i++)
		 {
			$classid=$pusers_id[$i];

			 $pgid="SELECT e.enroll_id,e.admission_id,e.admisn_no,e.name,e.class_id FROM edu_enrollment AS e WHERE e.class_id='$classid' AND e.admit_year='$year_id'";
			 $pcell=$this->db->query($pgid);
			 $res2=$pcell->result();
			 foreach($res2 as $row2)
			 {
				  $stuid=$row2->admission_id;
				  $class="SELECT id,mobile,admission_id,primary_flag FROM edu_parents WHERE FIND_IN_SET('$stuid',admission_id) AND primary_flag='Yes'";
				  $pcell1=$this->db->query($class);
				  $res3=$pcell1->result();
				foreach($res3 as $row3)
				{
					$notes =urlencode($notes);
					$phone = $row3->mobile;
					$this->sendSMS($phone,$notes);
				}
			 }
		 }
	  }

	//------------------------------ALL-----------------------
	if($users_id!='')
	{
			//------------------------Teacher----------------------
			if($users_id==2)
			{
				$tsql="SELECT u.user_id,u.user_type,u.user_master_id,t.teacher_id,t.name,t.phone FROM edu_users AS u,edu_teachers AS t  WHERE u.user_type='$users_id' AND u.user_master_id=t.teacher_id AND u.status='Active'";
				$res=$this->db->query($tsql);
				$result1=$res->result();
				foreach($result1 as $rows)
				{
					$notes =urlencode($notes);
					$phone = $rows->phone;
					$this->sendSMS($phone,$notes);
				}
			}

			//---------------------------Students----------------------
			if($users_id==3)
			{
				$ssql="SELECT
							u.user_id,
							u.user_type,
							u.user_master_id,
							u.name,
							a.admission_id,
							a.name,
							a.mobile
						FROM
							edu_users AS u,
							edu_admission AS a,
							 edu_enrollment AS e
						WHERE
							u.user_type = '$users_id' AND e.admit_year = '$year_id' AND e.admission_id = a.admission_id AND u.user_master_id = a.admission_id AND u.status = 'Active' AND e.status = 'Active'";
				$res2=$this->db->query($ssql);
				$result2=$res2->result();
				foreach($result2 as $rows1)
				{
					$notes =urlencode($notes);
					$phone = $rows1->mobile;
					$this->sendSMS($phone,$notes);
			   }
			}

			//---------------------------Parents--------------------------------------------
			if($users_id==4)
			{
				$psql="SELECT u.user_id,u.user_type,u.user_master_id,u.name,p.id,p.mobile FROM edu_users AS u,edu_parents AS p WHERE u.user_type='$users_id' AND u.user_master_id=p.id AND u.status='Active'";
				$pres2=$this->db->query($psql);
				$presult2=$pres2->result();
				foreach($presult2 as $prows1)
				{
					$notes =urlencode($notes);
					$phone = $rows1->mobile;
					$this->sendSMS($phone,$notes);
				}
			}
		}

	}

//DOB Wisher for users_dob_wishes

		function student_dob_wishes($cur_date)
		{
           $query="SELECT ee.name,ea.dob,ea.mobile FROM edu_enrollment AS ee LEFT JOIN edu_admission AS ea ON ee.admission_id=ea.admission_id WHERE ee.status='Active' AND CONCAT(YEAR(CURDATE()),DATE_FORMAT(ea.dob,'-%m-%d')) = '$cur_date' AND ee.status='Active'";
           $result=$this->db->query($query);
           $res=$result->result();
           foreach($res as $rows){
             $name = $rows->name;
             $phone = $rows->mobile;
             
			 $textmessage = 'Wishing you a Birthday filled with joy and a year filled with happiness and good health Happy Birthday '.$name.'';
           	 $notes = urlencode($textmessage);
			 $this->sendSMS($phone,$notes);
           }
         }


//  Teacher DOB WIshes
         function teacher_dob_wishes($cur_date)
		 {
          $query1="SELECT name,phone FROM edu_teachers WHERE CONCAT(YEAR(CURDATE()),DATE_FORMAT(dob,'-%m-%d')) = '$cur_date' AND status='Active'";
          $result1=$this->db->query($query1);
          $res=$result1->result();
		  
          foreach($res as $rows){
				$name=$rows->name;
				$phone=$rows->phone;
				$textmessage='Wishing you a Birthday filled with joy and a year filled with happiness and good health Happy Birthday '.$name.'';
				$notes =utf8_encode($textmessage);
				$this->sendSMS($phone,$notes);
           }
         }



//  Group SMS
        function send_msg($group_id,$notes,$user_id,$members_id)
		{
		  $check_type="SELECT * FROM edu_grouping_members WHERE group_title_id='$group_id'";
		  $get_type=$this->db->query($check_type);
		  
		  if($get_type->num_rows()==0){
			echo "";
			}else{
			$res_type=$get_type->result();
			
		foreach($res_type as $row_type){}
			$member_type=$row_type->member_type;
			$group_member_id=$row_type->group_member_id;
		 
         if($member_type='3'){
			 $sql1="SELECT egm.group_member_id,ep.email,ep.mobile FROM edu_grouping_members AS egm
			  LEFT JOIN edu_users AS eu ON eu.user_id=egm.group_member_id LEFT JOIN edu_admission AS ea ON ea.admission_id=eu.user_master_id
			  LEFT JOIN edu_parents AS ep ON FIND_IN_SET(ea.admission_id, ep.admission_id) WHERE  egm.group_title_id='$group_id'";

			   $scell=$this->db->query($sql1);
			   $res1=$scell->result();
			   foreach($res1 as $row1)
			   {
				  $phone = $row1->mobile;
				 $this->sendSMS($phone,$notes);
			   }
         }
		 
         $check_type_staff="SELECT * FROM edu_grouping_members WHERE group_title_id='$group_id'";
         $get_type_staff=$this->db->query($check_type_staff);
         $res_type_staff=$get_type_staff->result();
		 
         foreach($res_type_staff as $row_type_staff){}
			$member_type_staff=$row_type_staff->member_type;
			$group_member_id_staff=$row_type_staff->group_member_id;
			
         if($member_type='2' || $member_type='5'){
			$send_mail="SELECT * FROM edu_users AS A LEFT JOIN edu_teachers AS C ON A.teacher_id = C.teacher_id WHERE A.user_id = '$group_member_id_staff'";
			$get_mail=$this->db->query($send_mail);
			$res_mail=$get_mail->result();
         
				foreach($res_mail as $rows_mail){
				 $phone = $rows_mail->phone;
				 $this->sendSMS($phone,$notes);
			   }
         }
       }
      }



// Home Work SMS

		function send_sms_homework($user_id,$user_type,$createdate,$clssid)
		{
		   $year_id=$this->getYear();

		    $pcell="SELECT p.mobile FROM edu_parents AS p,edu_enrollment AS e WHERE e.class_id='$clssid' AND e.admit_year='$year_id' AND FIND_IN_SET( e.admission_id,p.admission_id) GROUP BY p.name";

			  $pcell1=$this->db->query($pcell);
			  $pcel2=$pcell1->result();
			  foreach($pcel2 as $res)
			  {  
				$cell[]=$res->mobile;
			  }

				echo $sms="SELECT h.title,h.hw_details,h.hw_type,h.test_date,s.subject_name,IFNULL(c.class_name, '') AS class_name,IFNULL(se.sec_name, '') AS sec_name FROM edu_homework AS h
				LEFT JOIN edu_subject AS s ON s.subject_id=h.subject_id
				LEFT JOIN edu_classmaster AS cm ON h.class_id=cm.class_sec_id
				LEFT JOIN edu_class AS c ON cm.class=c.class_id
				LEFT JOIN edu_sections AS se ON  cm.section=se.sec_id
				WHERE h.class_id='$clssid' AND h.year_id='$year_id' AND DATE_FORMAT(h.created_at,'%Y-%m-%d')='$createdate' AND h.subject_id=s.subject_id";
				$sms1 = $this->db->query($sms);
				$sms2 = $sms1->result();

		  foreach ($sms2 as $value)
          {
            $hwtitle=$value->title;
		    $hwdetails=$value->hw_details;
			$subname=$value->subject_name;
			$ht=$value->hw_type;
			$tdat=$value->test_date;
			$class_name=$value->class_name.'-'.$value->sec_name;

			if($ht=='HW'){ $type="Home Work" ; }else{ $type="Class Test" ; }
				$message=$subname.'-'.$hwdetails.'.';
				$home_work_details[]=$message;
			}
				$hdetails=implode('',$home_work_details);
				$phone=implode(',',$cell);
				$count1=count($cell);
                $notes = utf8_encode("Dear parents Class: $class_name'-'$hdetails" );

                $this->sendSMS($phone,$notes);
				
               if($notes){
					$data= array("status" => "success");
                }else{
					$data= array("status" => "failed");
                }
	}


// Attendance SMS

      function send_sms_attendance($attend_id){
         $query="SELECT ee.name,ep.mobile,ee.admission_id,eah.abs_date,eah.student_id,eah.a_status,eah.attend_period,
         CASE WHEN attend_period = 0 THEN 'MORNING'  ELSE 'AFTERNOON' END  AS a_session,CASE WHEN a_status = 'L' THEN 'Leave' WHEN a_status = 'A' THEN 'Absent' ELSE 'OnDuty' END  AS abs_atatus FROM edu_attendance_history AS eah LEFT JOIN edu_enrollment AS ee ON ee.enroll_id=eah.student_id LEFT JOIN edu_parents AS ep ON ee.admission_id=ep.admission_id WHERE eah.attend_id='$attend_id' AND ep.primary_flag='Yes'";

        $result=$this->db->query($query);
        $res=$result->result();
        foreach($res as $rows){
           $st_name=$rows->name;
           $parents_num=$rows->mobile;
           $at_ses=$rows->a_session;
           $abs_date=$rows->abs_date;
           $abs_status=$rows->abs_atatus;

			$notes='Your child '.$st_name.' was marked '.$abs_status.' today, '.$abs_date.' ON '.$at_ses.' To Known more details login into http://bit.ly/2wLwdRQ';

			$this->sendSMS($parents_num,$notes);
        } 
      }


}
	  ?>
