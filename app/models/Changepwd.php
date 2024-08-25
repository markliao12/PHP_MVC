<?php

class Changepwd
{
	
	use Model;

	protected $table = 'users';

	protected $allowedColumns = [
        
		'password'
			
	];

}