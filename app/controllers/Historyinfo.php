<?php

class Historyinfo
{
    use Controller;

    public function index()
    {
        $data = [];
        unset($_SESSION['p_view']);
        if (!isset($_SESSION['USER'])) {
            redirect('login');
        }
        if (isset($_SESSION['USER']) && $_SESSION['USER']->u_status == 2) {
            redirect('home');
        }
        if(!isset($_SESSION['history_view']))
		{
			redirect('historypay');
		}

        if (isset($_POST['pinfo']) && $_POST['pinfo'] == "View") {
            $_SESSION['p_view']['version'] = $_SESSION['history_view']['version'];
            $_SESSION['p_view']['u_date'] = $_SESSION['history_view']['u_date'];
            $_SESSION['p_view']['u_id'] = $_POST['u_id'];
            redirect('pinfo');
        }
        
        $recd = new Records;

        $rows = $recd->getpaysub($_SESSION['history_view']['version']);

        $data['info']=$rows;


        $this->view('historyinfo', $data);
    }
}