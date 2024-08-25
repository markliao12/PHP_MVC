<?php

class Employees
{
	use Controller;

	public function index()
	{
        $data=[];
        
        if(!isset($_SESSION['USER']))
		{
			redirect('login');
		}
        if(isset($_SESSION['USER'])&&$_SESSION['USER']->u_status==2)
        {
            redirect('home');
        }
        unset($_SESSION['ed_id']);
        $user = new User;
        $data['emps']=$user->findAllemployees();

        if(isset($_POST['edit'])&&$_POST['edit']=="Edit")
        {
            $_SESSION['ed_id']=$_POST['users_id'];
            redirect('empedit');
        }

        if(isset($_POST['deleter'])&&$_POST['deleter']=="Delete")
        {
            $ids=$_POST['users_id'];
            $user->usrdelete($ids);
            redirect('employees');
        }

        $this->view('employees',$data);

    }
}