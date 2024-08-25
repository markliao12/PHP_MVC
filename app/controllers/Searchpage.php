<?php

class Searchpage
{
    use Controller;

    public function index()
    {
        $data = [];
        $recd = new Records;
        unset($_SESSION['search_info']);
        unset($_SESSION['edit_info']);
        if (!isset($_SESSION['USER'])) {
            redirect('login');
        }
        if (isset($_SESSION['USER']) && $_SESSION['USER']->u_status  == 2) {
            redirect('home');
        }
        if (isset($_SESSION['srch_dt'])) {
            $start_week = $_SESSION['srch_dt']['str_dt'];
            $end_week = $_SESSION['srch_dt']['ed_dt'];
            $locations = $_SESSION['srch_dt']['locations'];



            //show($start_week.'----'.$end_week);
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
                if($locations =='all'){
                    $rows = $recd->weektimeall($dat, $dat1);
                }else{
                    $rows = $recd->weektimelocation($dat, $dat1, $locations);
                }
                
                if (!empty($rows)) {
                    $dats[] = $rows;
                }
                $j++;
                $p++;
            }
            $nm = 0;
            $nip = 0;
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
                        $c = (strtotime($a) - strtotime($b)) / 3600;
                        $z = round($c, 1);
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
                    $rvd[$key]['date'][] = $ky;
                    $rvd[$key]['hrs'][] = array_sum($vl);
                }
            }

            
            
            $rsm = [];
            
            foreach ($rvd as $kd => $valu) {
                $rvsw = [];
                $rrww = [];
                $row = $recd->userbyid($kd);
                $tt_hrs = array_sum($valu['hrs']);
                $rvsw["u_id"] = $kd;
                $rvsw["u_name"] = $row[0]->u_fname . ' ' . $row[0]->u_lname;
                $rvsw["u_date"] = $start_week . ' to ' . $end_week;
                $rvsw['u_sdt'] = $start_week;
                $rvsw['u_edt'] = $end_week;
                $rvsw["tt_hrs"] = $tt_hrs;
                
                
                for($i=0;$i<count($valu['date']);$i++){
                    $a = $valu['date'][$i];
                    $b = date('Y-m-d', strtotime($a . ' + 1 day'));
                    $rowlocation = $recd->locationbydate($a,$b,$kd);
                    $rsmm['dates'] = $a;
                    $rsmm['hrs'] = $valu['hrs'][$i];
                    $rsmm['r_ip'] = $rowlocation[0]->w_address;
                    $rsmm['location'] = $rowlocation[0]->w_address;
                    array_push($rrww, $rsmm);
                }
                
                $rvsw["info"]=$rrww;

                array_push($rsm, $rvsw);
                
            }
            

            $viewarr = [];
            if (isset($_POST['view']) && $_POST['view'] == "View") {
                $viewarr['u_id'] = $_POST['users_id'];
                $viewarr['s_dt'] = $_POST['s_dt'];
                $viewarr['e_dt'] = $_POST['e_dt'];
                $viewarr['tt_hrs'] = $_POST['tt_hrs'];
                $viewarr['u_date'] = $_POST['u_date'];
                $viewarr['locations'] = $_POST['locations'];
                $_SESSION['search_info'] = $viewarr;

                redirect('searchview');
            }

            if (isset($_POST['edittime']) && $_POST['edittime'] == "Edit") {
                $viewarr['u_id'] = $_POST['users_id'];
                $viewarr['d_date'] = $_POST['d_date'];
                $_SESSION['edit_info'] = $viewarr;

                redirect('editinfo');
            }

            //show($rsm);
            $data["info"] = $rsm;
            $data['total'] = $dayhous;
            $data['location'] = $recd->locationlist();

            $this->view('searchpage', $data);
        } else {
            unset($_SESSION['srch_dt']);
            redirect('admin');
        }
    }
}
