<?php

class Relation
{
	
	use Model;

	protected $table = 'relation_history';

	protected $allowedColumns = [
        
		'h_id',
		'r_id'
	];
    
}