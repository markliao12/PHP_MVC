<?php

class Admin
{
    use Controller;

    public function index()
    {
        $data = [];
        $ddate = [];
        unset($_SESSION['srch_dt']);
        unset($_SESSION['view_info']);
        unset($_SESSION['history_info']);
        unset($_SESSION['history_view']);
        unset($_SESSION['submit_dt']);
        if (!isset($_SESSION['USER'])) {
            redirect('login');
        }
        if (isset($_SESSION['USER']) && $_SESSION['USER']->u_status  == 2) {
            redirect('home');
        }
        date_default_timezone_set("America/Toronto");
        $recd = new Records;

        if (!empty($recd->recordsrsncd())) {
            $data['rsn_cd'] = 1;
            $rsn_cd = 1;

            $rw1 = $recd->allfirstdaytime($rsn_cd);
            $rw2 = $recd->alllastdaytime($rsn_cd);
            $start_week = date("Y-m-d", strtotime($rw1[0]->r_time));
            $tmp = date("Y-m-d", strtotime($rw2[0]->r_time." +1 day"));
            $ctmp = date("Y-m-d");
            
            if($ctmp<$tmp){
                $end_week = date("Y-m-d", strtotime($rw2[0]->r_time." +1 day"));
            }else{
                $end_week = date("Y-m-d");
            }
            


            $mn = dateDiffInDays($start_week, $end_week);
            
            $j = 0;
            $p = 1;
            $dayhous = 0;
            $w = [];
            $t = [];
            $dats = [];
            $usersid = $recd->alluserid();
            for ($i = 0; $i < $mn; $i++) {

                $dat = date('Y-m-d', strtotime($start_week . ' +' . $j . ' day'));
                $dat1 = date('Y-m-d', strtotime($start_week . ' +' . $p . ' day'));
                $rows = $recd->weektimeall($dat, $dat1);
                if (!empty($rows)) {
                    $dats[] = $rows;
                }
                $j++;
                $p++;
            }
            
            $nm = 0;
            foreach ($dats as $da) {
                foreach ($da as $val) {
                    if ($nm  == $val->u_id) {
                        if ($val->r_state  == 1) {
                            $t[$nm][] = $val->r_time;
                        }
                        if ($val->r_state  == 2) {
                            $w[$nm][] = $val->r_time;
                        }
                    } else {
                        if ($val->r_state  == 1) {
                            $t[$val->u_id][] = $val->r_time;
                        }
                        if ($val->r_state  == 2) {
                            $w[$val->u_id][] = $val->r_time;
                        }
                    }
                    $nm = $val->u_id;
                }
            }
            ksort($t);
            ksort($w);

            

            $r = 0;
            $v = [];
            $rv = [];
            foreach ($usersid as $ids) {
                $id = $ids->u_id;
                if (!empty($w[$id])) {
                    for ($i = 0; $i < count($w[$id]); $i++) {
                        $a = $w[$id][$i];
                        $b = $t[$id][$i];
                        //$c = (strtotime($a) - strtotime($b)) / 3600;
                        $z = timeDiff($a, $b);
                        if ($r  == date('Y-m-d', strtotime($a))) {
                            $v[$ids->u_id][$r][] = $z;
                        } else {
                            $m = date('Y-m-d', strtotime($a));
                            $v[$id][$m][] = $z;
                        }

                        
                        $dayhous = $dayhous + $z;
                        $r = date('Y-m-d', strtotime($a));
                    }
                }
            }

            
            $rvd = [];
            foreach ($v as $key => $val) {
                foreach ($val as $ky => $vl) {
                    $rv[] = array($key, $ky, array_sum($vl));
                    $rvd[$key][] = array_sum($vl);
                }
            }

           
            $rvsw = [];
            $rsm = [];
            $all_ttb = 0;
            $all_ttreg = 0;
            $all_pay = 0;
            $all_bpay = 0;
            $all_rpay = 0;
            foreach ($rvd as $kd => $valu) {
                $fnum = ceil($mn / 7);
                //show($fnum);
                $row = $recd->userbyid($kd);
                $tt_hrs = array_sum($valu);
                $tb_hrs = $row[0]->u_base_hrs * $fnum;
                if ($tt_hrs <= $tb_hrs) {
                    $tt_reg = $tt_hrs;
                    $tt_b = 0;
                } else {
                    $tt_reg = $tb_hrs;
                    $tt_b = $tt_hrs - $tb_hrs;
                }


                $rvsw["u_id"] = $kd;
                $rvsw["u_name"] = $row[0]->u_fname . ' ' . $row[0]->u_lname;
                $rvsw["u_date"] = $start_week . ' to ' . $end_week;
                $rvsw['u_sdt'] = $start_week;
                $rvsw['u_edt'] = $end_week;
                $rvsw["reg"] = $tt_reg;
                $rvsw["bn"] = $tt_b;
                $rvsw["tt_hrs"] = $tt_hrs;
                $rvsw["reg_t"] = $tt_reg * $row[0]->u_reg_pay;
                $mmm = $row[0]->u_pay - $row[0]->u_reg_pay;
                if ($tt_b > 0) {
                    $rvsw["bn_t"] = ($tt_reg * $mmm) + $tt_b * $row[0]->u_pay;
                } else {
                    $rvsw["bn_t"] = $tt_reg * $mmm;
                }

                $rvsw["tt_roll"] = $rvsw["reg_t"] + $rvsw["bn_t"];
                array_push($rsm, $rvsw);
                $all_ttb = $all_ttb + $tt_b;
                $all_ttreg = $all_ttreg + $tt_reg;
                $all_pay = $all_pay + $rvsw["tt_roll"];
                $all_bpay = $all_bpay + $rvsw["bn_t"];
                $all_rpay = $all_rpay + $rvsw["reg_t"];
            }
            $data['location'] = $recd->locationlist();
            $data["info"] = $rsm;
            $data['total'] = $dayhous;
            $data['tot_b_hrs'] = $all_ttb;
            $data['tot_r_hrs'] = $all_ttreg;
            $data['tot_pay'] = $all_pay;
            $data['tot_bpay'] = $all_bpay;
            $data['tot_rpay'] = $all_rpay;
            
        } else{
            $data['rsn_cd'] = 2;
        }



        if (isset($_POST['select_dt']) && $_POST['select_dt'] == "Submit") {
            if (strtotime($_POST['start_dt']) > strtotime($_POST['end_dt'])) {
                $data['error'] = 'Data select error!';
            } else {
                $ddate['str_dt'] = $_POST['start_dt'];
                $ddate['ed_dt'] = $_POST['end_dt'];
                $ddate['locations'] = $_POST['r_ip'];
                $_SESSION['srch_dt'] = $ddate;
                redirect('searchpage');
            }
        }
        $viewarr = [];
        if (isset($_POST['view']) && $_POST['view'] == "Edit") {
            $viewarr['u_id'] = $_POST['users_id'];
            $viewarr['s_dt'] = $_POST['s_dt'];
            $viewarr['e_dt'] = $_POST['e_dt'];
            $viewarr['u_date'] = $_POST['work_dt'];
            $viewarr['tt_hrs'] = $_POST['tt_hrs'];
            $_SESSION['view_info'] = $viewarr;
            redirect('infoviews');
        }
        if (isset($_POST['view']) && $_POST['view'] == "View") {
            $viewarr['u_id'] = $_POST['users_id'];
            $viewarr['s_dt'] = $_POST['s_dt'];
            $viewarr['e_dt'] = $_POST['e_dt'];
            $viewarr['u_date'] = $_POST['work_dt'];
            $viewarr['tt_hrs'] = $_POST['tt_hrs'];
            $_SESSION['history_info'] = $viewarr;
            redirect('historyview');
        }

        if (isset($_POST['submit_dt']) && $_POST['submit_dt'] == "Submit") {
            $_SESSION['submit_dt']['str_dt'] = $_POST['start_dt'];
            $_SESSION['submit_dt']['ed_dt'] = $_POST['end_dt'];
            redirect('submitorder');
        }


        //show($rsm);



        $this->view('admin', $data);
    }
}
