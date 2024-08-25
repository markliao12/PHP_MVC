<?php

class Editpay
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

        if (!isset($_SESSION['usr_id'])) {
            redirect('infoviews');
        }

        $user = new Updateinfo;
        $data['emp_info'] = $user->userbyid($_SESSION['usr_id'])[0];
        $data['estatus'] = $user->findAllstatus();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user->updateuser($_SESSION['usr_id'], $_POST);
            redirect('infoviews');
        }

        $this->view('editpay', $data);
    }
}