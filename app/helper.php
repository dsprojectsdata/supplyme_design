<?php

if (!function_exists('convertCount')) {
	function convertCount($count)
	{
		if ($count >= 1000 && $count < 1000000) {

			return round(($count/1000), 2) . 'K';
		} elseif ($count >= 1000000 && $count < 100000000) {

			return round(($count/1000000), 2) . 'M';
		} elseif ($count >= 100000000) {

			return round(($count/100000000), 2) . 'B';
		} else {

			return $count;
		}
	}
}

if (!function_exists('human')) {
    function human($time) {
        echo $time->diffForHumans();
    }
}

if (!function_exists('formatSizeUnits')) {
	function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
	}
}