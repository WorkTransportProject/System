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
				<h1> עובד קיים  </h1>
				<form id="posts" method="get" action=""> 
				<?php
				    include('db.php');    
				
				    $queries = array();
                    echo parse_str($_SERVER['QUERY_STRING'], $queries);    
					if(!empty($queries)){
                		$workerNumber = $queries['number'];	
					} else {
						$workerNumber = null;
					}
					
			 		//get data from DB to display
                	$query1  = "SELECT * FROM tbl_workers_209 where number='$workerNumber'";
                	$result = mysqli_query($connection, $query1);
            
                	$worker = mysqli_fetch_assoc($result);		

					echo "
						<section>
							<label><input type=text required id=firstname name=firstname value=".$worker['firstname']."> :שם פרטי</label>
							<label><input type=text required id=lastname name=lastname value=".$worker['lastname']."> :שם משפחה</label> 
							<label><input type=text required id=number  pattern=[0-9]+ name=number value=".$worker['number']."> :מספר עובד</label>
							<label><input type=tel required id=phone pattern=[0-9]+ name=phone value=".$worker['phone']."> :מספר טלפון</label>
							<label><input type=text required id=depart name=depart value=".$worker['depart']."> :מחלקה</label>
							<label><input type=date required id=date name=date value=".$worker['date']."> :תאריך התחלה </label>			
					        <label><input type=text required id=address name =address value=".$worker['address']."> :כתובת </label>
						</section>
						
						<section>
				           <label>כיוון הסעה </label>
				          		<select name =direction>
									<option value=פיזור ואיסוף>פיזור ואיסוף</option>
									<option value=פיזור>פיזור</option>
				                	<option value=עסיפה>עסיפה</option>
				                	<option value=לא זכי להסעות>לא זכי להסעות</option>
				            	</select>
							<label> מקבל הודעות SMS <input type=checkbox id=checkSMS name=checkSMS "; if($worker['sms'] != 0){ echo "checked";} echo"></label>
							<label class=positionLeft> זכאי להסעות <input type=checkbox id=checkTransport name=checkTransport "; if($worker['transport'] != 0){ echo "checked";} echo"></label>
							<h2>  אסיפה  </h2>
							<div class=inputDiv>
								<label>
									<input type=text name=arriveFrom  placeholder= חדרה , שכונה > מ-תחנה
									<input type=text name=arriveTo placeholder=שוהם >  ל
								</label>
							</div>
							<h2> פיזור </h2>
							<div class=inputDiv>
								<label>
									<input type=text name=leaveFrom  placeholder= שוהם  >  מ-תחנה:
									<input type=text name=leaveTo  placeholder= חדרה , שכונה 9  >  ל
								</label>
							</div>
						</section>";
					//release returned data
                    mysqli_free_result($result);   
                
                    //close DB connection
                    mysqli_close($connection);
				?>
				<div class="clear"></div>
				<a href="workers.php" class="btn btn-primary">חזרה</a>
				<?php 
					if(!empty($queries)){
						echo "<button type=submit name=delete class='btn btn-primary'>מחיקה</button>";
					}
				?>
				<button type="submit" name="update" class="btn btn-primary">עדכון</button>
				</form>
				

			</main>		
			
		</div>
		<script src="includes/script_form.js"></script>
		<script src="includes/script.js"></script>
	</body>
</html>