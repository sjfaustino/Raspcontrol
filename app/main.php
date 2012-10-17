<?php session_start();
if($_SESSION['username'] == ""){
	require('index.php'); 
	die;
}


	require('_lib/classes/_ram.php'); 
	require('_lib/classes/_pitemp.php'); 
	require('_lib/classes/_hdd.php'); 
	require('_lib/classes/_cpu.php'); 
	require('_lib/classes/_uptime.php'); 
	require('_lib/includes/_header.php'); 
	require('_lib/classes/_network.php');
	require('_lib/classes/_who.php');
	require('_lib/classes/_versionCheck.php'); 
            
?>
	<div class="versionCheckContainer">
		<?php //$versionCheck = new versionCheck; $checkVersion = $versionCheck->checkVersion(); ?>
	</div>
    <div id="firstBlockContainer">
		
        <div class="firstBlockWrapper">
			<?php $uptime = new systemUptime; $getSystemUptime = $uptime->getSystemUptime();?>
        	
        	<div class="clear"></div>
        	
        	<br/><br/>

	        <?php $load = new cpuLoad; $getLoad = $load->getCpuLoad();?>
        	
        	<div class="clear"></div>
        	
        	<br/><br/>
        	
        	<?php $ram = new ramPercentage; $percentage = $ram->freeMemory(); $percentage = $ram->freeSwap();?>
        	
        	<div class="clear"></div>
		<br/>
		<br/>
        	<?php $heat = new heatPercentage; $heatpercent = $heat->getCurrentTemp(); ?>
        	<div class="clear"></div>
        	
        	<br/><br/>

        	<?php $hdd = new hddPercentage; $storagepercentage = $hdd->freeStorage();?>
        	
        	<div class="clear"></div>
        	
        	<br/><br/>        	
            
            <?php //$net = networkUsage(); echo "Received: ".$net['rx']." Megabytes Sent: ".$net['tx']." Megabytes Total: ".($net['rx']+$net['tx'])." Megabytes"; ?>
            <?php $network = new network; $networkUseage = $network->networkUsage(); ?>

            <div class="clear"></div>
        	
        	<br/><br/>

        	<?php $users = new usersLoggedIn; $getusers = $users->getusersLoggedIn();?>
       	</div>
       	<br/><br/>
    </div>
    
    <?php require('_lib/includes/_footer.php'); ?>
    
   <script type="text/javascript">
	<!--
	function rebootWarn() {
		var answer = confirm("WARNING: This will make your Raspberry Pi temporarily unavailable, it may also connect back to the network with a different IP.")
		if (answer){
			alert("Rebooting...!")
			window.location = "_lib/commands/_reboot.php";
		}
		else{
			alert("Reboot Aborted")
		}
	}
    
	function firmwareMsg() {
		alert("Firmware updating")
		window.location = "_lib/commands/_updatefirmware.php";
	}
	
	var poll = {
		"start" : function () {
			this.timer = setInterval("poll.update()", this.delay);
		},
		"stop" : function () {	
			clearInterval(this.timer);
		},
		"update" : function (reset) {
			if (reset) {
				this.stop();
				this.start();
			}
			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange=function() {
				if (xhr.readyState==4 && xhr.status==200) {
					poll.success(xhr.responseText);
				}
			}
			xhr.open("get", '_lib/AJAX/update.php');
			xhr.send();
		},
		"success" : function (data) {
			var container = document.getElementById("firstBlockContainer");
			var updateLog = document.getElementById("lastAJAXUpdate");
			var d = new Date();
			var time = d.toLocaleTimeString();
			container.innerHTML = data;
			updateLog.innerHTML = time + " (local time)";
		},
		"error" : function () {
			this.stop();
			alert("Error updating!");
		},
		"adjustDelay" : function (delay) {
			this.stop();
			this.delay = parseInt(delay);
			this.start();
		},
		"delay" : 60000,
		"timer" : 0
	}
	poll.start();
	//-->
	</script>
