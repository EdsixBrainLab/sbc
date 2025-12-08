<?php	$counters_hostname="180.179.236.48";
		$counters_database="counters";
		$counters_username="counter";
		$counters_password="c0unt3r";
		$counters_link = mysql_connect($counters_hostname, $counters_username, $counters_password);
		$counters_db_selected = mysql_select_db($counters_database, $counters_link);
