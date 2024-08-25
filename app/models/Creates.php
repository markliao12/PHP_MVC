<?php

class Creates
{
	
	use Model;

	protected $table = 'users';

	protected $allowedColumns = [
        
		'u_fname',
		'u_lname',
		'email',
		'password',
		'tel',
		'u_status',
		'u_reg_pay',
		'u_pay',
		'u_base_hrs',
		'create_dt'
		
	];

}