<?php 

function show($stuff)
{
	echo "<pre>";
	print_r($stuff);
	echo "</pre>";
}

function esc($str)
{
	return htmlspecialchars($str);
}

function redirect($path)
{
	header("Location: " . ROOT."/".$path);
	die;
}

function dateDiffInDays($date1, $date2) { 
    
    // Calculating the difference in timestamps 
    $diff = strtotime($date2) - strtotime($date1); 
  
    // 1 day = 24 hours 
    // 24 * 60 * 60 = 86400 seconds 
    return abs(round($diff / 86400)); 
} 

function timeDiff($time1, $time2) { 
    
    // Calculating the difference in timestamps 
    $diff = strtotime($time1) - strtotime($time2); 
  
    // 1 day = 24 hours 
    // 24 * 60 * 60 = 86400 seconds 
    return round(abs($diff / 3600), 1); 
} 



