<?php

class Submitorder
{
    use Controller;

    public function index()
    {
        $data = [];
        if (!isset($_SESSION['USER'])) {
            redirect('login');
        }
        if (isset($_SESSION['USER']) && $_SESSION['USER']->u_status  == 2) {
            redirect('home');
        }
        if(!isset($_SESSION['submit_dt']))
		{
			redirect('admin');
		}
        
        $recd = new Records;
        if (!empty($recd->recordsrsncd())) {
            $data['rsn_cd'] = 1;
            

            $start_week = date("Y-m-d H:i:s", strtotime($_SESSION['submit_dt']['str_dt']));
            $end_week = date("Y-m-d H:i:s", strtotime($_SESSION['submit_dt']['ed_dt']." +23 Hours"));


            $mn = dateDiffInDays($start_week, $end_week);
            //show($mn);
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
                $rvsw["u_date"] = date('Y-m-d', strtotime($start_week)) . ' to ' . date('Y-m-d', strtotime($end_week));
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
            //show($rsm);
            $data['location'] = $recd->locationlist();
            $data["info"] = $rsm;
            $data['total'] = $dayhous;
            $data['tot_b_hrs'] = $all_ttb;
            $data['tot_r_hrs'] = $all_ttreg;
            $data['tot_pay'] = $all_pay;
            $data['tot_bpay'] = $all_bpay;
            $data['tot_rpay'] = $all_rpay;
            $data['s_dt'] = $start_week;
            $data['e_dt'] = $end_week;
        } else{
            $data['rsn_cd'] = 2;
        }

        if (isset($_POST['order']) && $_POST['order'] == "Submit") {
            $history = new History;
            $relation = new Relation;
            $v_numb = $history->getversion();
            if (!empty($v_numb)) {
                $vnb = ($v_numb[0]->version + 1);
            } else {
                $vnb = 1;
            }
            $datas = [];
            foreach ($rsm as $rrss) {
                $datas["u_id"] = $rrss["u_id"];
                $datas["reg_hrs"] = $rrss["reg"];
                $datas["bonus_hrs"] = $rrss["bn"];
                $datas["tot_hrs"] = $rrss["tt_hrs"];
                $datas["reg_pay"] = $rrss["reg_t"];
                $datas["bonus_pay"] = $rrss["bn_t"];
                $datas["tot_pay"] = $rrss["tt_roll"];
                $datas["version"] = $vnb;

                $res = $history->insertquery($datas);
                //show($datas);
                if (!empty($res)) {
                    $h_id = $res;
                    $u_id = $rrss["u_id"];
                    $ids = $history->findalldatebyrsndate($_POST['s_dt'],$_POST['e_dt'],$u_id);
                    foreach ($ids as $is) {
                        $dts = [];
                        $dts["h_id"] = $h_id;
                        $dts["r_id"] = $is->r_id;
                        $relation->insert($dts);
                    }
                }
            }
            $r_cd = 1;
            $history->updaterecordbydate($_POST['s_dt'],$_POST['e_dt']);

            redirect("historypay");
        }

        $this->view('submitorder', $data);
    }
}