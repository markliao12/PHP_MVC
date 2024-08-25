<?php

class Infoviews
{
	use Controller;

	public function index()
    {
        $data=[];
        unset($_SESSION['usr_id']);
        unset($_SESSION['r_id']);
        if(!isset($_SESSION['USER']))
		{
			redirect('login');
		}
        if(isset($_SESSION['USER'])&&$_SESSION['USER']->u_status==2)
        {
            redirect('home');
        }
        if(!isset($_SESSION['view_info']))
		{
			redirect('admin');
		}

        //show($_SESSION['view_info']);

        $recd = new Records;

        if(isset($_POST['empedit'])&&$_POST['empedit']=="Edit")
        {
            $_SESSION['usr_id']=$_POST['users_id'];
            redirect('editpay');
        }

        if(isset($_POST['viewtime'])&&$_POST['viewtime']=="Edit")
        {
            $_SESSION['r_id']=$_POST['r_id'];
            redirect('edittime');
        }

        if(isset($_POST['add_dt'])&&$_POST['add_dt']=="Submit")
        {
            $dat['u_id'] = $_SESSION['view_info']['u_id'];
            $dat['r_state'] = $_POST['r_state'];
            $dat['r_time'] = date("Y-m-d H:i:s", strtotime($_POST['start_dt']));
            $dat['r_ip']=$_POST['r_ip'];
            $dat['rsn_cd']=1;
            $recd->insertrecord($dat);
            $ac=strtotime($_POST['start_dt']);
            $bc=strtotime($_SESSION['view_info']['e_dt']);
            if($ac>$bc){
                $_SESSION['view_info']['e_dt']=date('Y-m-d', strtotime($_POST['start_dt'] . ' +1 day'));
                $_SESSION['view_info']['u_date']=$_SESSION['view_info']['s_dt'].' to '.$_SESSION['view_info']['e_dt'];
            }
            
            redirect('infoviews');
            
        }

        if(isset($_POST['deletetime'])&&$_POST['deletetime']=="Delete"){
            $ids = $_POST['r_id'];
            $recd->recordsdelete($ids);
            redirect('infoviews');
        }
        
        //show($_SESSION['view_info']['e_dt']);
        $start_week = $_SESSION['view_info']['s_dt'];
        $end_week = $_SESSION['view_info']['e_dt'];
        $u_id=$_SESSION['view_info']['u_id'];
        $row1=$recd->oneuserbyid($u_id);
        $row2=$recd->weektime($start_week,$end_week,$u_id);
        $data['location'] = $recd->locationlist();
        $data['tt_hrs']=$_SESSION['view_info']['tt_hrs'];
        $data['u_date']=$_SESSION['view_info']['u_date'];
        $data['usrinfo']=$row1;
        $data['timeinfo']=$row2;
        //show($row2);
        

        $this->view('infoviews',$data);

    }
}