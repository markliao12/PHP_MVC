<?php 

/**
 * signup class
 */
class Signup
{
	use Controller;

	public function index()
	{
		$data = [];
		if(!isset($_SESSION['USER']))
		{
			redirect('login');
		}
        if(isset($_SESSION['USER'])&&$_SESSION['USER']->u_status ==2)
        {
            redirect('home');
        }
		$user = new Creates;
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$emails = $_POST['email'];
			if(!empty($user->emailexcis($emails)))
			{
				$user->errors['email'] = "Email is already used.";

				$data['errors'] = $user->errors;
			}else
			{
				date_default_timezone_set("America/Toronto");
				$_POST['create_dt']=date("Y-m-d H:i:s");
                $user->insert($_POST);
				redirect('employees');
				//show($_POST);
			}
        }
        
		$data['stu']=$user->findAllstatus();

		$this->view('signup',$data);
	}

}
