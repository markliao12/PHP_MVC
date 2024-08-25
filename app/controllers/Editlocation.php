<?php


class Editlocation
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
        if (!isset($_SESSION['w_location'])) {
            redirect('locations');
        }
        $w_id = $_SESSION['w_location'];
        $locations = new WLocations;

        $data['location'] = $locations->findlocation($w_id)[0];
        $data['staus'] = $locations->findlocationstatus();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $locations->updatelocation($w_id, $_POST);
            redirect('locations');
        }

        $this->view('editlocation', $data);
    }
}
