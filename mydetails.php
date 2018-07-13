<!DOCTYPE html>
<html>
	<head>
		<title>Movix.me</title>
		<link rel="stylesheet" href="includes/style.css">
		<link href="https://fonts.googleapis.com/css?family=Alef" rel="stylesheet">
		<meta charset="UTF-8">

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
	</head>
	
	<body>
		<div id="wrapper">
			<header class="primaryHeader">
				<a id="logo" href="index.html"></a>
				<a id="user" href="#"></a>
				<a id="bell" href="#"></a>
				<div>
					<form action="#" method="get">
						<input type="search" id="search" placeholder="Search">
					</form>
				</div>
			</header>
			
			<nav class="primaryMenu"  id="menu">
				<ul id="navList">
					<li><a href="#">סידור העבודה שלי</a></li>
					<li><a href="#">שינוי מיקום</a></li>
					<li><a href="#">איפה ההסעה</a></li>
					<li><a href="#">איחרתי על ההסעה</a></li>
					<li><a href="#">חופשים</a></li>
					<li><a href="#">תלונות</a></li>
					<li><a href="#">פרטים שלי</a></li>
					<li><a href="#">הגדרות</a></li>
				</ul>
			</nav>
			
			<main class="Mydetails">
				<h1>פרטים שלי </h1>
				<?php
				    include('db.php'); 
					$default = 5831784231;  
				
				    $queries = array();
                    echo parse_str($_SERVER['QUERY_STRING'], $queries);    
					if(!empty($queries)){
                		$workerNumber = $queries['user'];	
					} else {
						$workerNumber = $default;
					}
					
			 		//get data from DB to display
                	$query1  = "SELECT * FROM tbl_workers_209 where number='$workerNumber'";
                	$result = mysqli_query($connection, $query1);
                	$worker = mysqli_fetch_assoc($result);
                    mysqli_free_result($result);  	
					
					//get data from DB to display
                	$query2  = "SELECT * FROM tbl_workerTransport_209 where number='$workerNumber'";
                	$result = mysqli_query($connection, $query2);
                	$transport = mysqli_fetch_assoc($result);
                    mysqli_free_result($result);  		

				?>
				<table>

				    <tr>
						<td>שם פרטי :</td>
					 	<td><?php echo $worker['firstname'] ?></td>
				   	</tr>
					<tr>
					    <td>שם משפחה :</td>
					 	<td><?php echo $worker['lastname'] ?></td>
				    </tr>
				    <tr>
					    <td>מספר טלפון :</td>
					 	<td><?php echo $worker['phone'] ?></td>
				    </tr>
				    <tr>
						<td>מחלקה :</td>
					 	<td><?php echo $worker['depart'] ?></td>
				    </tr>
					<tr>
					    <td>תאריך התחלה :</td>
					 	<td><?php echo $worker['date'] ?></td>
						
				    </tr>
				    <tr>
					    <td>כתובת :</td>
					 	<td><?php echo $worker['address'] ?></td>
				    </tr>
				    <tr>
						<td>מקבל הודעות SMS :</td>
					    <td><input type="checkbox" name="checkSMS" disabled="disabled" <?php if($worker['sms'] != 0){ echo "checked";} ?>></td>
				    </tr>
					<tr>
					
					    <td>אסיפה :</td>
				    	<td><b>מ-תחנה: </b><?php echo $transport['arriveFrom'] ?> </td>
						<td><b>ל: </b><?php echo $transport['arriveTo'] ?>  </td>

				    </tr>
				    <tr>
					    <td>פיזור :</td>

						<td><b>מ-תחנה: </b><?php echo $transport['leaveFrom'] ?>  </td>
						<td><b>ל: </b><?php echo $transport['leaveTo'] ?>   </td>
				    </tr>
				</table>
				<a class="btn btn-primary">חזרה</a>	
				<?php 
                    //close DB connection
                    mysqli_close($connection);
				?>	           
			</main>		
		</div>

		<script src="includes/script.js"></script>
	</body>
</html>