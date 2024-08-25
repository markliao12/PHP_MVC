<?php

class Addtime
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
        if (!isset($_SESSION['srch_dt'])) {
            unset($_SESSION['srch_dt']);
            redirect('admin');
        }
        $recd = new Records;
        $data['emp']=$recd->findAllemp();
        
        $data['location'] = $recd->locationlist();
        if(isset($_POST['add_dt'])&&$_POST['add_dt']=="Submit")
        {
            $dat['u_id'] = $_POST['u_id'];
            $dat['r_state'] = $_POST['r_state'];
            $dat['r_time'] = date("Y-m-d H:i:s", strtotime($_POST['r_time']));
            $dat['r_ip']=$_POST['r_ip'];
            $dat['rsn_cd']=1;
            $recd->insertrecord($dat);
            
            
            redirect('addtime');
            
        }

        $this->view('addtime', $data);
    }
}