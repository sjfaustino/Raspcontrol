<?php
	header('Content-type: application/json');
	require('../classes/_ram.php'); 
	require('../classes/_pitemp.php'); 
	require('../classes/_hdd.php'); 
	require('../classes/_cpu.php'); 
	require('../classes/_uptime.php'); 
	require('../classes/_network.php');
	require('../classes/_who.php');
	
	echo '{';
	echo '"uptime" : ';
	$uptime = new systemUptime;
	$getSystemUptime = $uptime->getSystemUptime(true);
	echo ', "CPU" : ';
	$load = new cpuLoad;
	$getLoad = $load->getCpuLoad(true);
	echo ', "memory" : {';
	$ram = new ramPercentage;
	$percentage = $ram->freeMemory(true);
	echo ',';
	$percentage = $ram->freeSwap(true);
	echo '}, "storage" : ';
	$hdd = new hddPercentage;
	$storagepercentage = $hdd->freeStorage(true);
	echo ',';
	$network = new network;
	$networkUseage = $network->networkUsage(true);
	echo ', "users" : ';
	$users = new usersLoggedIn;
	$getusers = $users->getusersLoggedIn(true);
	echo '}';
?>