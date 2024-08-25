<?php

class Changes
{
    use Controller;

    public function index()
    {
        $data = [];
        if (!isset($_SESSION['USER'])) {
            redirect('login');
        }
        if (isset($_SESSION['USER']) && $_SESSION['USER']->u_status == 1) {
            redirect('admin');
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user = new Changepwd;
            $user->updateuser($_SESSION['USER']->u_id,$_POST);
            redirect('home');
        }

        $this->view('changes', $data);
    }
}