<?php

class Historyview
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
        if(!isset($_SESSION['history_info']))
		{
			redirect('admin');
		}

        //show($_SESSION['view_info']);

        $recd = new Records;

        $start_week = $_SESSION['history_info']['s_dt'];
        $end_week = $_SESSION['history_info']['e_dt'];
        $u_id=$_SESSION['history_info']['u_id'];
        $row1=$recd->oneuserbyid($u_id);
        $row2=$recd->weektime($start_week,$end_week,$u_id);
        $data['tt_hrs']=$_SESSION['history_info']['tt_hrs'];
        $data['u_date']=$_SESSION['history_info']['u_date'];
        $data['usrinfo']=$row1;
        $data['timeinfo']=$row2;

        

        $this->view('historyview',$data);

    }
}