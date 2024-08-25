<?php 


class Addlocation
{
	use Controller;

	public function index()
	{
        $data = [];
		if(!isset($_SESSION['USER']))
		{
			redirect('login');
		}
        if(isset($_SESSION['USER'])&&$_SESSION['USER']->u_status==2)
        {
            redirect('home');
        }
        $locations=new WLocations;
        $data['statu']=$locations->findlocationstatus();


        if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$addr = $_POST['w_address'];
			if(!empty($locations->addressexcis($addr)))
			{
				$locations->errors['address'] = "Address is already used.";

				$data['errors'] = $locations->errors;
			}else
			{
				date_default_timezone_set("America/Toronto");
				$_POST['w_create_dt']=date("Y-m-d H:i:s");
                $locations->insert($_POST);
				redirect('locations');
			}
        }

        $this->view('addlocation',$data);
    }
}