<?php

class History
{
	
	use Model;

	protected $table = 'history';

	protected $allowedColumns = [
        
		'u_id',
		'reg_hrs',
		'bonus_hrs',
		'tot_hrs',
		'reg_pay',
		'bonus_pay',
		'tot_pay',
		'version'
	];
    
}