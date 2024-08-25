<?php

class Updatetime
{
	
	use Model;

	protected $table = 'records';

	protected $allowedColumns = [
        
		'r_id',
        'r_time',
		'r_ip'
	];

}