<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Apiteacher extends CI_Controller {

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}


	function __construct()
    {
        parent::__construct();
		$this->load->model("apiteachermodel");

    }

	public function checkMethod()
	{
		if($_SERVER['REQUEST_METHOD'] != 'POST')
		{
			$res = array();
			$res["scode"] = 203;
			$res["message"] = "Request Method not supported";

			echo json_encode($res);
			return FALSE;
		}
		return TRUE;
	}

//-----------------------------------------------//

	public function disp_Attendence()
	{
 		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Attendence View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$class_id = '';
		$disp_type ='';
		$disp_date = '';
		$from_month = '';
	    //$from_year ='';

		$class_id = $this->input->post("class_id");
		$disp_type = $this->input->post("disp_type");
		$disp_date = $this->input->post("disp_date");
		$month_year = $this->input->post("month_year");
		//$from_year = $this->input->post("from_year");

		$data['result']=$this->apiteachermodel->dispAttendence($class_id,$disp_type,$disp_date,$month_year);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function disp_Monthview()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Attendence View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$class_id = '';
		$student_id ='';
		$from_month = '';
		$from_year ='';
		$class_id = $this->input->post("class_id");
		$student_id = $this->input->post("student_id");
		$month_year = $this->input->post("month_year");
		//$from_month = $this->input->post("from_month");
		//$from_year = $this->input->post("from_year");

		$data['result']=$this->apiteachermodel->dispMonthview($class_id,$student_id,$month_year);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

// Reload Start
	public function reloadHomework()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Homework View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$class_id= '';
		$teacher_id='';
		$hw_type= '';


		$teacher_id = $this->input->post("teacher_id");


		$data['result']=$this->apiteachermodel->reloadHomework($teacher_id);
		$response = $data['result'];
		echo json_encode($response);
	}


    	public function reloadExam()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Homework View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$class_id= '';
		$teacher_id='';
		$hw_type= '';


		$teacher_id = $this->input->post("teacher_id");


		$data['result']=$this->apiteachermodel->reloadExam($teacher_id);
		$response = $data['result'];
		echo json_encode($response);
	}



// REload end

    	public function disp_Homework()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Homework View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$class_id= '';
		$teacher_id='';
		$hw_type= '';

		$class_id = $this->input->post("class_id");
		$teacher_id = $this->input->post("teacher_id");
		$hw_type = $this->input->post("hw_type");

		$data['result']=$this->apiteachermodel->dispHomework($class_id,$teacher_id,$hw_type);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function disp_Ctestmarks()
	{
	   $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Homework View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$hw_id= '';
		$hw_id = $this->input->post("hw_id");

		$data['result']=$this->apiteachermodel->dispCtestmarks($hw_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function disp_Exams()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Exam View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$class_ids = '';
		$class_ids = $this->input->post("class_ids");

		$data['result']=$this->apiteachermodel->dispExams($class_ids);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function disp_Examdetails()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Exam Details View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$class_id= '';
		$exam_id= '';
		$class_id = $this->input->post("class_id");
	 	$exam_id = $this->input->post("exam_id");

		$data['result']=$this->apiteachermodel->dispExamdetails($class_id,$exam_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


//-----------------------------------------------//

	public function disp_Exammarks()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Exam Marks View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$exam_id = '';
		$class_id = '';
		$subject_id = '';
		$is_internal_external= '';

		$class_id = $this->input->post("class_id");
		$exam_id = $this->input->post("exam_id");
		$subject_id = $this->input->post("subject_id");
		$is_internal_external = $this->input->post("is_internal_external");

		$data['result']=$this->apiteachermodel->dispMarkdetails($class_id,$exam_id,$subject_id,$is_internal_external);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function disp_Reminder()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Reminder View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$user_id = $this->input->post("user_id");

		$data['result']=$this->apiteachermodel->dispReminder($user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//



//-----------------------------------------------//

	public function disp_Communication()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Communication View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$teacher_id= '';
		$teacher_id = $this->input->post("teacher_id");

		$data['result']=$this->apiteachermodel->dispCommunication($teacher_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function disp_Leavetype()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "User Leave View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$user_id = $this->input->post("user_id");

		$data['result']=$this->apiteachermodel->dispLeavetype($user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function disp_Userleaves()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "User Leave View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$user_id = $this->input->post("user_id");

		$data['result']=$this->apiteachermodel->dispUserleaves($user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function disp_Timetablereview()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Timetablereview";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$teacher_id = '';
		$teacher_id = $this->input->post("teacher_id");

		$data['result']=$this->apiteachermodel->dispTimetablereview($teacher_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function add_Userleaves()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "User Leave Add";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

        $user_type = '';
		$user_id = '';
		$leave_master_id = '';
		$leave_type = '';
		$date_from = '';
		$date_to = '';
		$fromTime = '';
		$toTime = '';
		$description = '';

		$user_type = $this->input->post("user_type");
		$user_id = $this->input->post("user_id");
		$leave_master_id = $this->input->post("leave_master_id");
		$leave_type = $this->input->post("leave_type");
		$date_from = $this->input->post("date_from");
		$date_to = $this->input->post("date_to");
		$fromTime = $this->input->post("fromTime");
		$toTime = $this->input->post("toTime");
		$description = $this->input->post("description");

    	$data['result']=$this->apiteachermodel->addUserleaves($user_type,$user_id,$leave_master_id,$leave_type,$date_from,$date_to,$fromTime,$toTime,$description);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function add_Homework()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Homework Add";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

        $class_id = '';
        $teacher_id = '';
        $homeWork_type = '';
        $subject_id = '';
        $title = '';
        $test_date = '';
        $due_date = '';
        $homework_details = '';
        $created_by = '';
        $created_at ='';

		$class_id = $this->input->post("class_id");
        $teacher_id = $this->input->post("teacher_id");
        $homeWork_type = $this->input->post("homeWork_type");
        $subject_id = $this->input->post("subject_id");
        $title = $this->input->post("title");
        $test_date = $this->input->post("test_date");
        $due_date = $this->input->post("due_date");
        $homework_details = $this->input->post("homework_details");
        $created_by = $this->input->post("created_by");
        $created_at = $this->input->post("created_at");

		$data['result']=$this->apiteachermodel->addHomework($class_id,$teacher_id,$homeWork_type,$subject_id,$title,$test_date,$due_date,$homework_details,$created_by,$created_at);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function add_HWmarks()
	{

		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Homework Marks Add";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}



				$hw_masterid = $this->input->post("hw_masterid");
        $student_id = $this->input->post("student_id");
        $marks = $this->input->post("marks");
        $remarks = $this->input->post("remarks");
        $created_by = $this->input->post("created_by");
        $created_at = $this->input->post("created_at");

		$data['result']=$this->apiteachermodel->addHWmarks($hw_masterid,$student_id,$marks,$remarks,$created_by,$created_at);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function view_Examduty()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "View Examduty";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$teacher_id = '';

		$teacher_id = $this->input->post("teacher_id");

		$data['result']=$this->apiteachermodel->viewExamduty($teacher_id);
		$response = $data['result'];
		echo json_encode($response);
	}
//-----------------------------------------------//

//-----------------------------------------------//

	public function add_Reminder()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Reminder Add";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$title = '';
		$description = '';
		$date = '';

		$user_id = $this->input->post("user_id");
        $title = $this->input->post("title");
        $description = $this->input->post("description");
        $date = $this->input->post("date");

		$data['result']=$this->apiteachermodel->addReminder($user_id,$title,$description,$date);
		$response = $data['result'];
		echo json_encode($response);
	}
//-----------------------------------------------//



//-----------------------------------------------//

	public function add_Exammarks()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Exam Marks Add";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$exam_id = '';
        $teacher_id = '';
        $subject_id = '';
        $stu_id = '';
        $classmaster_id = '';
        $internal_mark = '';
        $external_mark = '';
		$marks = '';
        $created_by = '';
   		$is_internal_external= '';

        $exam_id = $this->input->post("exam_id");
        $teacher_id = $this->input->post("teacher_id");
        $subject_id = $this->input->post("subject_id");
        $stu_id = $this->input->post("stu_id");
        $classmaster_id = $this->input->post("classmaster_id");
        $internal_mark = $this->input->post("internal_mark");
        $external_mark = $this->input->post("external_mark");
				$marks = $this->input->post("marks");
        $created_by = $this->input->post("created_by");
        $is_internal_external = $this->input->post("is_internal_external");

		$data['result']=$this->apiteachermodel->addExammarks($exam_id,$teacher_id,$subject_id,$stu_id,$classmaster_id,$internal_mark,$external_mark,$marks,$created_by,$is_internal_external);
		$response = $data['result'];
		echo json_encode($response);
	}
//-----------------------------------------------//


//-----------------------------------------------//

	public function add_Timetablereview()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Timetablereview Add";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
		$time_date = '';
		$class_id = '';
		$subject_id = '';
		$period_id = '';
		$user_type = '';
		$user_id = '';
		$comments = '';
		$created_at = '';


		$time_date = $this->input->post("time_date");
        $class_id = $this->input->post("class_id");
        $subject_id = $this->input->post("subject_id");
        $period_id = $this->input->post("period_id");
        $user_type = $this->input->post("user_type");
        $user_id = $this->input->post("user_id");
        $comments = $this->input->post("comments");
        $created_at = $this->input->post("created_at");

		$data['result']=$this->apiteachermodel->addTimetablereview($time_date,$class_id,$subject_id,$period_id,$user_type,$user_id,$comments,$created_at);
		$response = $data['result'];
		echo json_encode($response);
	}
//-----------------------------------------------//

//-----------------------------------------------//

	public function sync_Attendance()
	{
	    $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Attendance Sync";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

        $ac_year = '';
        $class_id = '';
        $class_total = '';
        $no_of_present = '';
        $no_of_absent = '';
        $attendence_period = '';
        $created_by = '';
        $created_at = '';
        $status = '';

        $ac_year = $this->input->post("ac_year");
        $class_id = $this->input->post("class_id");
        $class_total = $this->input->post("class_total");
        $no_of_present = $this->input->post("no_of_present");
        $no_of_absent = $this->input->post("no_of_absent");
        $attendence_period = $this->input->post("attendence_period");
        $created_by = $this->input->post("created_by");
        $created_at = $this->input->post("created_at");
        $status = $this->input->post("status");

		$data['result']=$this->apiteachermodel->syncAttendance($ac_year,$class_id,$class_total,$no_of_present,$no_of_absent,$attendence_period,$created_by,$created_at,'Active');
		$response = $data['result'];
		echo json_encode($response);
	}
//-----------------------------------------------//

//-----------------------------------------------//

	public function sync_Attendancehistory()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Attendance History Sync";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}


        $attend_id = '';
        $class_id = '';
        $student_id = '';
        $abs_date = '';
        $a_status = '';
        $attend_period = '';
        $a_val = '';
        $a_taken_by = '';
        $created_at = '';
        $status = '';

        $attend_id = $this->input->post("attend_id");
        $class_id = $this->input->post("class_id");
        $student_id = $this->input->post("student_id");
        $abs_date = $this->input->post("abs_date");
        $a_status = $this->input->post("a_status");
        $attend_period = $this->input->post("attend_period");
        $a_val = $this->input->post("a_val");
        $a_taken_by = $this->input->post("a_taken_by");
        $created_at = $this->input->post("created_at");
        $status = $this->input->post("status");

		$data['result']=$this->apiteachermodel->syncAttendancehistory($attend_id,$class_id,$student_id,$abs_date,$a_status,$attend_period,$a_val,$a_taken_by,$created_at,'Active');
		$response = $data['result'];
		echo json_encode($response);
	}
//-----------------------------------------------//

//-----------------------------------------------//

	public function disp_Attendence_classteacher()
	{
 		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Attendence View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$class_id = '';

		$class_id = $this->input->post("class_id");

		$data['result']=$this->apiteachermodel->dispAttendenceclassteacher($class_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function list_Studentattend_classteacher()
	{
 		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Class Teacher Attendence View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$class_id = '';
		$attend_id = '';

		$class_id = $this->input->post("class_id");
		$attend_id = $this->input->post("attend_id");

		$data['result']=$this->apiteachermodel->listStudentattendct($class_id,$attend_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function send_attendance_parents()
	{
 		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Attendence Send to Parents";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$msg_type = '';
		$attend_id = '';

		$attend_id = $this->input->post("attend_id");
		$msg_type = $this->input->post("msg_type");


		$cir = explode(',',$msg_type);
		$cir_cnt = count($cir);

			if($cir_cnt==3)	{
				$data = $this->apiteachermodel->send_attendance_sms($attend_id);
				$data = $this->apiteachermodel->send_attendance_email($attend_id);
				$data = $this->apiteachermodel->send_attendance_notification($attend_id);
			 }

			 if($cir_cnt==2)  {
		 		  	$ct1=$cir[0];
		 	    	$ct2=$cir[1];

		 		  if($ct1=='SMS' && $ct2=='Mail')
		 		  {
					 $data = $this->apiteachermodel->send_attendance_sms($attend_id);
 					$data = $this->apiteachermodel->send_attendance_email($attend_id);
		 		  }
		 		  if($ct1=='SMS' && $ct2=='Notification')
		 		  {
					 $data = $this->apiteachermodel->send_attendance_sms($attend_id);
 					 $data = $this->apiteachermodel->send_attendance_notification($attend_id);
		 		  }
		 		  if($ct1=='Mail' && $ct2=='Notification')
		 		  {
 					$data = $this->apiteachermodel->send_attendance_email($attend_id);
 					$data = $this->apiteachermodel->send_attendance_notification($attend_id);
		 		  }

		 	  }
			 if($cir_cnt==1) {
				  $ct=$cir[0];
				  if($ct=='SMS')
				  {
						$data = $this->apiteachermodel->send_attendance_sms($attend_id);
				  }
				  if($ct=='Mail')
				  {
						$data = $this->apiteachermodel->send_attendance_email($attend_id);
				  }
				  if($ct=='Notification')
				  {
						 $data = $this->apiteachermodel->send_attendance_notification($attend_id);
				  }
			  }

				$data['result']= $this->apiteachermodel->send_attendance_status($attend_id);
				$response = $data['result'];
				echo json_encode($response);

	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function daywisect_homework()
	{
 	    $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Class Teacher Home Work Days";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$class_id = '';
		$class_id = $this->input->post("class_id");

		$data['result']=$this->apiteachermodel->daywisectHomework($class_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function daywisect_allhomework()
	{
 		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Class Teacher View All Home Works Day wise";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$class_id = '';
		$hw_date = '';
		$class_id = $this->input->post("class_id");
		$hw_date = $this->input->post("hw_date");

		$data['result']=$this->apiteachermodel->daywisectAllhomework($class_id,$hw_date);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function send_allhw_parents()
	{
 		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Send All HW for Parents";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$createdate = '';
		$clssid = '';
		$msg_type='';

		$user_id = $this->input->post('user_id');
		$createdate = $this->input->post('hw_created_date');
		$clssid = $this->input->post('class_id');
		$msg_type = $this->input->post("msg_type");

		$cir = explode(',',$msg_type);
		$cir_cnt = count($cir);


			if($cir_cnt==3)	{
				$data = $this->apiteachermodel->send_allhw_sms($user_id,$createdate,$clssid);
				$data = $this->apiteachermodel->send_allhw_email($user_id,$createdate,$clssid);
				$data = $this->apiteachermodel->send_allhw_notification($user_id,$createdate,$clssid);
			 }

			 if($cir_cnt==2)  {
		 		  	$ct1=$cir[0];
		 	    	$ct2=$cir[1];

		 		  if($ct1=='SMS' && $ct2=='Mail')
		 		  {
					 $data = $this->apiteachermodel->send_allhw_sms($user_id,$createdate,$clssid);
 					$data = $this->apiteachermodel->send_allhw_email($user_id,$createdate,$clssid);
		 		  }
		 		  if($ct1=='SMS' && $ct2=='Notification')
		 		  {
					 $data = $this->apiteachermodel->send_allhw_sms($user_id,$createdate,$clssid);
 					 $data = $this->apiteachermodel->send_allhw_notification($user_id,$createdate,$clssid);
		 		  }
		 		  if($ct1=='Mail' && $ct2=='Notification')
		 		  {
 					$data = $this->apiteachermodel->send_allhw_email($user_id,$createdate,$clssid);
 					$data = $this->apiteachermodel->send_allhw_notification($user_id,$createdate,$clssid);
		 		  }

		 	  }
			 if($cir_cnt==1) {
				  $ct=$cir[0];
				  if($ct=='SMS')
				  {
						$data = $this->apiteachermodel->send_allhw_sms($user_id,$createdate,$clssid);
				  }
				  if($ct=='Mail')
				  {
						$data = $this->apiteachermodel->send_allhw_email($user_id,$createdate,$clssid);
				  }
				  if($ct=='Notification')
				  {
						 $data = $this->apiteachermodel->send_allhw_notification($user_id,$createdate,$clssid);
				  }
			  }

		$data['result']=$this->apiteachermodel->updateAllhworkstatus($user_id,$createdate,$clssid);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//



//-----------------------------------------------//

	public function send_singlehw_parents()
	{
 		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Single Home work send to Parents";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$createdate = '';
		$clssid = '';
		$msg_type='';

		$user_id = $this->input->post('user_id');
		$hw_id = $this->input->post('hw_id');
		$clssid = $this->input->post('class_id');
		$msg_type = $this->input->post("msg_type");

		$cir = explode(',',$msg_type);
		$cir_cnt = count($cir);


			if($cir_cnt==3)	{
				$data = $this->apiteachermodel->send_singlehw_sms($user_id,$hw_id,$clssid);
				$data = $this->apiteachermodel->send_singlehw_email($user_id,$hw_id,$clssid);
				$data = $this->apiteachermodel->send_singlehw_notification($user_id,$hw_id,$clssid);
			 }

			 if($cir_cnt==2)  {
		 		  	$ct1=$cir[0];
		 	    	$ct2=$cir[1];

		 		  if($ct1=='SMS' && $ct2=='Mail')
		 		  {
					 $data = $this->apiteachermodel->send_singlehw_sms($user_id,$hw_id,$clssid);
 					$data = $this->apiteachermodel->send_singlehw_email($user_id,$hw_id,$clssid);
		 		  }
		 		  if($ct1=='SMS' && $ct2=='Notification')
		 		  {
					 $data = $this->apiteachermodel->send_singlehw_sms($user_id,$hw_id,$clssid);
 					 $data = $this->apiteachermodel->send_singlehw_notification($user_id,$hw_id,$clssid);
		 		  }
		 		  if($ct1=='Mail' && $ct2=='Notification')
		 		  {
 					$data = $this->apiteachermodel->send_singlehw_email($user_id,$hw_id,$clssid);
 					$data = $this->apiteachermodel->send_singlehw_notification($user_id,$hw_id,$clssid);
		 		  }

		 	  }
			 if($cir_cnt==1) {
				  $ct=$cir[0];
				  if($ct=='SMS')
				  {
						$data = $this->apiteachermodel->send_singlehw_sms($user_id,$hw_id,$clssid);
				  }
				  if($ct=='Mail')
				  {
						$data = $this->apiteachermodel->send_singlehw_email($user_id,$hw_id,$clssid);
				  }
				  if($ct=='Notification')
				  {
						 $data = $this->apiteachermodel->send_singlehw_notification($user_id,$hw_id,$clssid);
				  }
			  }
		$data['result']=$this->apiteachermodel->updateSinglehwhworkstatus($user_id,$hw_id,$clssid);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//



//-----------------------------------------------//

	public function view_special_class()
	{

		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$user_id = $this->input->post("user_id");

		$data['result']=$this->apiteachermodel->view_special_class($user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


//-----------------------------------------------//

	public function view_substitution()
	{

		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$user_id = $this->input->post("user_id");

		$data['result']=$this->apiteachermodel->view_substitution($user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//



//-----------------------------------------------//

	public function view_substitution_for_past()
	{

		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$user_id = $this->input->post("user_id");

		$data['result']=$this->apiteachermodel->view_substitution_for_past($user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function view_timetable_days()
	{

		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$user_id = $this->input->post("user_id");

		$data['result']=$this->apiteachermodel->view_timetable_days($user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


//-----------------------------------------------//

	public function view_timetable_for_teacher()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Timetable View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$teacher_id = '';
		$user_id = $this->input->post("user_id");

		$data['result']=$this->apiteachermodel->view_timetable_for_teacher($user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function view_exam_mark_status()
	{
	  $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Timetable View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}


		$exam_id = $this->input->post("exam_id");
		$class_id = $this->input->post("class_id");

		$data['result']=$this->apiteachermodel->view_exam_mark_status($exam_id,$class_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


//-----------------------------------------------//

	public function update_class_test_marks()
	{
	 $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Timetable View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}


		$hw_masterid = $this->input->post("hw_masterid");
		$student_id = $this->input->post("student_id");
		$marks = $this->input->post("marks");
		$user_id = $this->input->post("user_id");
		$created_at=$this->input->post("created_at");

		$data['result']=$this->apiteachermodel->update_class_test_marks($hw_masterid,$student_id,$marks,$user_id,$created_at);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//





//-----------------------------------------------//

	public function update_exam_marks()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Exam Marks Update";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

				$exam_id = '';
        $teacher_id = '';
        $subject_id = '';
        $stu_id = '';
        $classmaster_id = '';
        $internal_mark = '';
        $external_mark = '';
				$marks = '';
        $created_by = '';
   			$is_internal_external= '';

        $exam_id = $this->input->post("exam_id");
        $teacher_id = $this->input->post("teacher_id");
        $subject_id = $this->input->post("subject_id");
        $stu_id = $this->input->post("stu_id");
        $classmaster_id = $this->input->post("classmaster_id");
        $internal_mark = $this->input->post("internal_mark");
        $external_mark = $this->input->post("external_mark");
				$marks = $this->input->post("marks");
        $created_by = $this->input->post("created_by");
        $is_internal_external = $this->input->post("is_internal_external");

		$data['result']=$this->apiteachermodel->update_exam_marks($exam_id,$teacher_id,$subject_id,$stu_id,$classmaster_id,$internal_mark,$external_mark,$marks,$created_by,$is_internal_external);
		$response = $data['result'];
		echo json_encode($response);
	}
//-----------------------------------------------//





//-----------------------------------------------//

	public function view_exam_details()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Exam Marks Update";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = $this->input->post("user_id");
		$exam_id = $this->input->post("exam_id");
		$class_id = $this->input->post("classmaster_id");

		$data['result']=$this->apiteachermodel->view_exam_details($user_id,$exam_id,$class_id);
		$response = $data['result'];
		echo json_encode($response);
	}
//-----------------------------------------------//


	public function exam_for_teacher(){

		
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Exam Marks Update";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$teacher_id = $this->input->post("teacher_id");

		$data['result']=$this->apiteachermodel->exam_for_teacher($teacher_id);
		$response = $data['result'];
		echo json_encode($response);
	}







}
