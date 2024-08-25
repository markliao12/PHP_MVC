<?php

class Empedit
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

        if (!isset($_SESSION['ed_id'])) {
            redirect('employees');
        }

        $user = new Updateinfo;
        $data['emp_info'] = $user->userbyid($_SESSION['ed_id'])[0];
        $data['estatus'] = $user->findAllstatus();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user->updateuser($_SESSION['ed_id'], $_POST);
            redirect('employees');
        }

        $this->view('empedit', $data);
    }
}
