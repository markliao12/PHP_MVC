<?php

class Editinfo
{
	use Controller;

	public function index()
    {
        $data=[];
        unset($_SESSION['usr_id']);
        unset($_SESSION['er_id']);
        unset($_SESSION['eusr_id']);
        if(!isset($_SESSION['USER']))
		{
			redirect('login');
		}
        if(isset($_SESSION['USER'])&&$_SESSION['USER']->u_status==2)
        {
            redirect('home');
        }
        if(!isset($_SESSION['edit_info']))
		{
			redirect('admin');
		}
        $recd = new Records;
        $u_id=$_SESSION['edit_info']['u_id'];
        $u_dt=$_SESSION['edit_info']['d_date'];
        $data['r_time'] = date('H:i m/d/Y', strtotime($_SESSION['edit_info']['d_date']));
        $row1=$recd->oneuserbyid($u_id);
        $row2=$recd->getinfobyid($u_dt,$u_id);
        $data['location'] = $recd->locationlist();
        $data['usrinfo']=$row1;
        $data['timeinfo']=$row2;
        if(isset($_POST['deletetime'])&&$_POST['deletetime']=="Delete"){
            $ids = $_POST['r_id'];
            $recd->recordsdelete($ids);
            redirect('editinfo');
        }
        if(isset($_POST['add_dt'])&&$_POST['add_dt']=="Submit")
        {
            $dat['u_id'] = $_SESSION['edit_info']['u_id'];
            $dat['r_state'] = $_POST['r_state'];
            $dat['r_time'] = date("Y-m-d H:i:s", strtotime($_POST['start_dt']));
            $dat['r_ip']=$_POST['r_ip'];
            $dat['rsn_cd']=1;
            $recd->insertrecord($dat);
            
            
            redirect('editinfo');
            
        }
        if(isset($_POST['viewtime'])&&$_POST['viewtime']=="Edit")
        {
            $_SESSION['er_id']=$_POST['r_id'];
            redirect('editday');
        }
        if(isset($_POST['empedit'])&&$_POST['empedit']=="Edit")
        {
            $_SESSION['eusr_id']=$_POST['users_id'];
            redirect('editdaypay');
        }


        $this->view('editinfo',$data);
    }
}