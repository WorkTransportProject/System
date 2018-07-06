<!DOCTYPE html>
<html>
	<head>
		<title>Movix.me</title>
		<link rel="stylesheet" href="includes/style.css">
		<link href="https://fonts.googleapis.com/css?family=Alef" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                    mysqli_free_result($result);  	
					
					//get data from DB to display
                	$query2  = "SELECT * FROM tbl_workerTransport_209 where number='$workerNumber'";
                	$result = mysqli_query($connection, $query2);
                	$transport = mysqli_fetch_assoc($result);
                    mysqli_free_result($result);  		

				?>
					<section>
						<label><input type="text" required id="firstname" name="firstname" <?php echo "value='".$worker['firstname']."'" ?> > :שם פרטי</label>
						<label><input type="text" required id="lastname" name="lastname" <?php echo "value='".$worker['lastname']."'" ?> > :שם משפחה</label> 
						<label><input type="text" required id="number"  pattern="[0-9]+" name="number" <?php echo "value='".$worker['number']."'" ?> > :מספר עובד</label>
						<label><input type="tel" required id="phone" pattern="[0-9]+" name="phone" <?php echo "value='".$worker['phone']."'" ?> > :מספר טלפון</label>
						<label><input type="text" required id="depart" name="depart" <?php echo "value='".$worker['depart']."'" ?> > :מחלקה</label>
						<label><input type="date" required id="date" name="date" <?php echo "value='".$worker['date']."'" ?> > :תאריך התחלה </label>			
				        <label><input type="text" required id="address" name ="address" <?php echo "value='".$worker['address']."'" ?> > :כתובת </label>
					</section>
					
					<section>
						<?php $options = array("פיזור ואיסוף","פיזור","אסיפה","לא זכי להסעות")?>
			           <label>כיוון הסעה </label>
			          		<select id="direction" name="direction">
			          			<?php
				          			for($i = 0;$i < 4;$i++){
									    if($options[$i] == $transport['direction']){
									        echo "<option selected='selected' value='$options[$i]'>$options[$i]</option>";
									    }else{
									        echo "<option value='$options[$i]'>$options[$i]</option>";
									    }
									}
			          			?>
			            	</select>
						<label> מקבל הודעות SMS <input type="checkbox" id="checkSMS" name="checkSMS" <?php if($worker['sms'] != 0){ echo "checked";} ?> ></label>
						<label class="positionLeft"> זכאי להסעות <input type="checkbox" id="checkTransport" name="checkTransport" <?php if($worker['transport'] != 0){ echo "checked";} ?> ></label>
						<h2 id="arriveH">  אסיפה  </h2>
						<div id="arrive" class="inputDiv">
							<label>
								<input type="text" id="arriveTo" name="arriveTo" <?php echo "value='".$transport['arriveTo']."'" ?> > מ-תחנה
								<input type="text" id="arriveFrom" name="arriveFrom" <?php echo "value='".$transport['arriveFrom']."'" ?> >  ל
							</label>
						</div>
						<h2 id="leaveH"> פיזור </h2>
						<div id="leave" class="inputDiv">
							<label>
								<input type="text" id="leaveTo" name="leaveTo"  <?php echo "value='".$transport['leaveTo']."'" ?>  >  מ-תחנה:
								<input type="text" id="leaveFrom" name="leaveFrom" <?php echo "value='".$transport['leaveFrom']."'" ?> >  ל
							</label>
						</div>
					</section>
				<?php 
                    //close DB connection
                    mysqli_close($connection);
				?>
				<div class="clear"></div>
				<a href="workers.php" class="btn btn-primary">חזרה</a>
				<?php 
					if(!empty($queries)){
						echo "<button type=submit name=delete class='btn btn-danger'>מחיקה</button>";
					}
				?>
				<button type="submit" name="update" class="btn btn-success">עדכון</button>
				</form>
			</main>		
		</div>
		<script src="includes/script_form.js"></script>
		<script src="includes/script.js"></script>
	</body>
</html>