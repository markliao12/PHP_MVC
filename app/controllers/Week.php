<?php

class Week
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
        
        $recodes = new Records;

        if (!empty($recodes->recordsrsncdbyid($_SESSION['USER']->u_id))) {
            $uid = $_SESSION['USER']->u_id;
            $rsn_cd=1;
            $rw1=$recodes->firstdaytime($rsn_cd,$uid);
            $rw2=$recodes->lastdaytime($rsn_cd,$uid);
    
    
            $start_week = date("Y-m-d", strtotime($rw1[0]->r_time));
            $end_week = date("Y-m-d", strtotime($rw2[0]->r_time." +1 day"));
    
    
            $mn = dateDiffInDays($start_week, $end_week);
            
    
    
            
    
            $j = 0;
            $p = 1;
            $dayhous = 0;
            $w = [];
            $t = [];
            $dats = [];
            for ($i = 0; $i < $mn; $i++) {
    
                $dat = date('Y-m-d', strtotime($start_week . ' +' . $j . ' day'));
                $dat1 = date('Y-m-d', strtotime($start_week . ' +' . $p . ' day'));
                $rows = $recodes->weektime($dat, $dat1, $uid);
                if (!empty($rows)) {
                    $dats[] = $rows;
                }
                $j++;
                $p++;
            }
    
            foreach ($dats as $da) {
                for ($i = 0; $i < count($da); $i++) {
                    if ($da[$i]->r_state == 1) {
                        $t[] = $da[$i]->r_time;
                    }
                    if ($da[$i]->r_state == 2) {
                        $w[] = $da[$i]->r_time;
                    }
                }
            }
    
            $r = 0;
            $v = [];
            $rv = [];
            for ($i = 0; $i < count($w); $i++) {
                $a = $w[$i];
                $b = $t[$i];
                //$c = (strtotime($a) - strtotime($b)) / 3600;
                $z = timeDiff($a, $b);
                if ($r == date('Y-m-d', strtotime($a))) {
                    $v[$r][] = $z;
                } else {
                    $v[date('Y-m-d', strtotime($a))][] = $z;
                }
                $dayhous = $dayhous + $z;
                $r = date('Y-m-d', strtotime($a));
            }
            foreach ($v as $key => $val) {
                $rv[] = array($key, array_sum($val));
            }
    
            $data["times"] = $rv;
            $data['total'] = $dayhous;
        }
        

        $this->view('week', $data);
    }
}
