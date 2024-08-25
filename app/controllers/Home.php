<?php

/**
 * home class
 */
class Home
{
    use Controller;

    public function index()
    {
        $dat = [];
        unset($_SESSION['ed_id']);
        if (!isset($_SESSION['USER'])) {
            redirect('login');
        }
        if (isset($_SESSION['USER']) && $_SESSION['USER']->u_status == 1) {
            redirect('admin');
        }

        $uid = $_SESSION['USER']->u_id;
        date_default_timezone_set("America/Toronto");
        $a = date('Y-m-d'); //今天的開始時間
        $time = strtotime($a);
        //$time = strtotime("-8 hours",$time);
        $a = date("Y-m-d H:i:s", $time);
        $b = date('Y-m-d'); //今天的結束時間
        $time2 = strtotime($b);
        $time2 = strtotime("+24 hours", $time2);
        $b = date("Y-m-d H:i:s", $time2);

        $data['username'] = $_SESSION['USER']->u_fname;

        $recodes = new Records;
        $row = $recodes->sontime($a, $b, $uid);

        $row3 = $recodes->checktime($a, $b, $uid);
        /*if (!empty($row3)) {
            $cktime = strtotime($row3[0]->r_time . ' + 30 minute');
            $nw = date("Y-m-d H:i:s");
            $nw1 = strtotime($nw);
            if ($nw1 > $cktime) {
                $data['able'] = 1;
            } else {
                $data['able'] = 2;
            }
            
        } else {
            $data['able'] = 1;
        }*/
        if (!empty($row3) && $row3[0]->r_state == 1) {
            $data['chktm'] = 2;
            $data['r_ip'] = $row3[0]->r_ip;
        } elseif (!empty($row3) && $row3[0]->r_state != 1) {
            $data['chktm'] = 1;
        } else {
            $data['chktm'] = 1;
        }
        $data['location'] = $recodes->locationlist();
        $data['ontime'] = $row;



        if (isset($_POST['start']) && $_POST['start'] == "Start") {

            $recods = new Records;
            $dat['u_id'] = $uid;
            $dat['r_state'] = 1;
            $dat['r_time'] = date("Y-m-d H:i:s");
            $dat['r_ip'] = $_POST['r_ip'];
            $dat['rsn_cd'] = 1;

            $recods->insertrecord($dat);
            redirect('home');
        }

        /*if (isset($_POST['ckout']) && $_POST['ckout'] == "Clock Out") {

            echo '<script language="javascript">';
            echo 'alert("Only after 30 mins you can Clock out!")';
            echo '</script>';

        }

        if (isset($_POST['ckstart']) && $_POST['ckstart'] == "Start") {

            echo '<script language="javascript">';
            echo 'alert("Only after 30 mins you can Clock In!")';
            echo '</script>';

        }*/

        if (isset($_POST['out']) && $_POST['out'] == "Clock Out") {
            $recods = new Records;
            $dat['u_id'] = $uid;
            $dat['r_state'] = 2;
            $dat['r_time'] = date("Y-m-d H:i:s");
            $dat['r_ip'] = $_POST['r_ip'];
            $dat['rsn_cd'] = 1;

            $recods->insertrecord($dat);
            redirect('home');
        }

        $this->view('home', $data);
    }
}
