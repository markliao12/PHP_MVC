<?php

class Updateinfo
{
	
	use Model;

	protected $table = 'users';

	protected $allowedColumns = [
        
		'u_id',
        'u_fname',
		'u_lname',
		'email',
		'u_status',
		'tel',
		'u_reg_pay',
		'u_pay',
		'u_base_hrs',
		'create_dt'
		
	];

}