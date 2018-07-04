<!DOCTYPE html>
<html>
	<head>
		<title>Movix.me</title>
		<link rel="stylesheet" href="includes/style.css">
		<link href="https://fonts.googleapis.com/css?family=Alef" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
		<meta charset="UTF-8">

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
					<li><a href="workers.php">העובדים</a></li>
					<li><a href="#">השמת משמרת</a></li>
					<li><a href="#">תלונות של עובדים</a></li>
					<li><a href="#">איחורים על הסעה</a></li>
					<li><a href="#">אישור סידור עבודה</a></li>
					<li><a href="#">תלונות</a></li>
					<li><a href="#">שלח הודעה לעובדים</a></li>
					<li><a href="#">היסטוריית פעולות</a></li>
				</ul>
			</nav>
			
			<main class="workerPage">
				<h1>כל העובדים</h1>

				<table>
				    <tr>
					  	<th>שם העובד</th>
				      	<th>מספר טלפון</th>
				      	<th>תאריך התחלת עבודה</th>
						<th>  </th>
				    </tr>
				    
				    <?php
						include('db.php');		
					
						//get data from DB to display
					    $query1  = "SELECT * FROM tbl_workers_209 order by lastname";
					    $result = mysqli_query($connection, $query1);
					    if(!$result) { 
					        die("DB query failed.");
					    }	
					
						//echo data
					   	while($row = mysqli_fetch_assoc($result)) {
					       //output data from each row
					       echo "<tr>"."<td>" . $row["firstname"] ." " . $row["lastname"] . "</td><td>" .$row["phone"] ."</td><td>" .$row["date"] 
					       		."</td><td><a href=workersForm.php?number=".$row["number"].">עריכה</a></td>" ."</tr>";
					   	}
					
						//release returned data
						mysqli_free_result($result);	
					
						//close DB connection
						mysqli_close($connection);
					?>
				    
				</table>
				<button class="btn btn-primary">הדפסה</button>
				<a href="workersForm.php" class="btn btn-primary">הוספה</a>	             
			</main>		
		</div>
		<script src="includes/script.js"></script>
	</body>
</html>