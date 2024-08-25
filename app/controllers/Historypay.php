<?php

class Historypay
{
    use Controller;

    public function index()
    {
        $data = [];
        unset($_SESSION['history_view']);
        if (!isset($_SESSION['USER'])) {
            redirect('login');
        }
        if (isset($_SESSION['USER']) && $_SESSION['USER']->u_status == 2) {
            redirect('home');
        }

        $recd = new Records;



        $rsw = [];
        $rsws = [];
        $ver = $recd->getversion();
        
        if (!empty($ver)) {
            for ($j = 1; $j <= $ver[0]->version; $j++) {
                $all_tt = 0;
                $all_ttb = 0;
                $all_ttreg = 0;
                $all_pay = 0;
                $all_bpay = 0;
                $all_rpay = 0;
                $all_emp = 0;
                
                $rows = $recd->historypaybyversion($j);
                if (!empty($rows)) {
                    foreach ($rows as $rw) {
                        $all_emp = $all_emp + 1;
                        $all_tt = $all_tt + $rw->tot_hrs;
                        $all_ttb = $all_ttb + $rw->bonus_hrs;
                        $all_ttreg = $all_ttreg + $rw->reg_hrs;
                        $all_pay = $all_pay + $rw->tot_pay;
                        $all_bpay = $all_bpay + $rw->bonus_pay;
                        $all_rpay = $all_rpay + $rw->reg_pay;
                    }
                    $rsws['emp'] = $all_emp;
                    $rsws['tt_hrs'] = $all_tt;
                    $rsws['ttb_hrs'] = $all_ttb;
                    $rsws['ttr_hrs'] = $all_ttreg;
                    $rsws['tt_pay'] = $all_pay;
                    $rsws['ttb_pay'] = $all_bpay;
                    $rsws['ttr_pay'] = $all_rpay;

                    $rsws['versionid'] = $j;
                    $rwsd = $recd->getfirstdaytime($j);
                    $lwsd = $recd->getlastdaytime($j);
                    $start_week = date("Y-m-d", strtotime($rwsd[0]->r_time));
                    $end_week = date("Y-m-d", strtotime($lwsd[0]->r_time));
                    $rsws["u_date"] = $start_week . ' to ' . $end_week;

                    array_push($rsw, $rsws);
                }
            }

            if (isset($_POST['viewinfo']) && $_POST['viewinfo'] == "View") {
                $_SESSION['history_view']['version'] = $_POST['version_id'];
                $_SESSION['history_view']['u_date'] = $_POST['u_date'];
                redirect('historyinfo');
            }
            krsort($rsw);
            $data['info'] = $rsw;
        }


        $this->view('historypay', $data);
    }
}
