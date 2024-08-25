<?php

class Searchview
{
    use Controller;

    public function index()
    {
        $data = [];
        $recd = new Records;
        if (!isset($_SESSION['USER'])) {
            redirect('login');
        }
        if (isset($_SESSION['USER']) && $_SESSION['USER']->u_status  == 2) {
            redirect('home');
        }
        if(!isset($_SESSION['search_info']))
		{
			redirect('searchpage');
		}

        $recd = new Records;

        $start_week = $_SESSION['search_info']['s_dt'];
        $end_week = $_SESSION['search_info']['e_dt'];
        $u_id=$_SESSION['search_info']['u_id'];
        $loca=$_SESSION['search_info']['locations'];
        $row1=$recd->oneuserbyid($u_id);
        if($loca =='all'){
            $row2=$recd->weektime($start_week,$end_week,$u_id);
        }else{
            $row2=$recd->weektimebylocation($start_week,$end_week,$u_id,$loca);
        }
        
        $data['tt_hrs']=$_SESSION['search_info']['tt_hrs'];
        $data['u_date']=$_SESSION['search_info']['u_date'];
        $data['usrinfo']=$row1;
        $data['timeinfo']=$row2;

        $this->view('searchview',$data);

    }
}