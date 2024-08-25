<?php

class Pinfo
{
    use Controller;

    public function index()
    {
        $data = [];
        
        if (!isset($_SESSION['USER'])) {
            redirect('login');
        }
        if (isset($_SESSION['USER']) && $_SESSION['USER']->u_status == 2) {
            redirect('home');
        }
        if(!isset($_SESSION['p_view']))
		{
			redirect('historyinfo');
		}

                
        $recd = new Records;

        $rows = $recd->getpaybyid($_SESSION['p_view']['version'],$_SESSION['p_view']['u_id']);

        $rows1 = $recd->weektimebyversion($_SESSION['p_view']['version'],$_SESSION['p_view']['u_id']);

        $data['info']=$rows;
        $data['timeinfo']=$rows1;
        //show($_SESSION['p_view']);
        $this->view('pinfo', $data);
    }
}