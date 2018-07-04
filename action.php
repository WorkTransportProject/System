<?php
	include('db.php');		

	if($_POST['action'] == "add") {
		if(isset($_POST['number']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['phone']) && isset($_POST['date'])&& isset($_POST['depart']) && isset($_POST['address'])) {
			// escape variables for security
			$firstname = mysqli_real_escape_string($connection, $_POST['firstname']);
			$lastname  = mysqli_real_escape_string($connection, $_POST['lastname']);
			$number = mysqli_real_escape_string($connection, $_POST['number']);
			$phone = mysqli_real_escape_string($connection, $_POST['phone']);
			$depart = mysqli_real_escape_string($connection, $_POST['depart']);
			$date = mysqli_real_escape_string($connection, $_POST['date']);
			$date = date("Y-m-d", strtotime($date));
			$address = mysqli_real_escape_string($connection, $_POST['address']);
			
			if($_POST['checkSMS'] == '1'){
				$sms = 1;
			} else {
				$sms = 0;
			}
			if($_POST['checkTransport'] == '1'){
				$transport = 1;
			} else {
				$transport = 0;
			}
	
			//SET: insert new data to DB
			$query = "INSERT INTO tbl_workers_209(firstname, lastname, number, phone, depart, date, address, sms, transport) 
						VALUES ('$firstname','$lastname','$number','$phone','$depart','$date','$address','$sms','$transport')
						ON DUPLICATE KEY UPDATE firstname='$firstname',lastname='$lastname',phone='$phone',depart='$depart',
												date='$date',address='$address',sms='$sms',transport='$transport'";
	
			$result = mysqli_query($connection, $query);		
	 
		}
	}
	else if ($_POST['action'] == "delete") {
		$number = mysqli_real_escape_string($connection, $_POST['number']);
		
		$query = "DELETE FROM tbl_workers_209 WHERE number='$number'";
	
		$result = mysqli_query($connection, $query);	
	}

	//release returned data
	mysqli_free_result($result);	

	//close DB connection
	mysqli_close($connection);
?>