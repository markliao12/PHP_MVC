<?php

class Editday
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
        if(!isset($_SESSION['er_id']))
		{
			redirect('editinfo');
		}

        $user = new Updatetime;

        $rows = $user->findtime($_SESSION['er_id']);
        $w_id = $rows[0]->r_ip;
        $data['emp_info'] = $user->userbyid($_SESSION['edit_info']['u_id'])[0];

        $data['location'] = $user->locationlist();
        $data['w_id'] = $w_id;
        $data['r_time'] = date('H:i m/d/Y', strtotime($rows[0]->r_time));

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $dat['r_time'] = date("Y-m-d H:i:s", strtotime($_POST['r_time']));
            $dat['r_ip']=$_POST['r_ip'];
            $r_id = $w_id = $rows[0]->r_id;
            $user->updatetime($r_id, $dat);
            redirect('editinfo');
        }

        //show($_SESSION['r_id']);

        $this->view('editday', $data);
    }
}