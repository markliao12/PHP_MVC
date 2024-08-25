<?php

class Records
{
    use Model;
    protected $table = 'records';

	protected $allowedColumns = [

		'u_id',
		'r_state',
		'r_time',
		'r_ip',
		'rsn_cd'
	];


}