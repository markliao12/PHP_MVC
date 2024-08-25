<?php


class Locations
{
    use Controller;

    public function index()
    {
        $data = [];
        unset($_SESSION['w_location']);
        if (!isset($_SESSION['USER'])) {
            redirect('login');
        }
        if (isset($_SESSION['USER']) && $_SESSION['USER']->u_status == 2) {
            redirect('home');
        }
        $locations = new WLocations;
        $data['work'] = $locations->findalllocations();
        $data['staus'] = $locations->findlocationstatus();
        if (isset($_POST['edit']) && $_POST['edit'] == 'Edit') {
            $_SESSION['w_location'] = $_POST['location_id'];
            redirect('editlocation');
        }
        if (isset($_POST['ldelete']) && $_POST['ldelete'] == 'Delete') {
            $locations->locationdelete($_POST['location_id']);
            redirect('locations');
        }


        $this->view('locations', $data);
    }
}
