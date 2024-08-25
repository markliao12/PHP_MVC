<?php

class WLocations
{
	
	use Model;

	protected $table = 'work_location';

	protected $allowedColumns = [
        
		'w_id',
        'w_address',
		'w_status',
		'w_create_dt'
		
	];

}