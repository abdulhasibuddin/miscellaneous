<?php
	//Config:
	$server = "localhost";
	$user = "root";
	$pass = "";
	$db = "GARDEN";

	//Create Database:
	$conn = new mysqli($server, $user, $pass);
	if($conn->connect_error){
		die("Error creating connection 1: ".$conn->connect_error);
	}
	else
	{
		$sql = "CREATE DATABASE IF NOT EXISTS ".$db;
		if($conn->query($sql) === FALSE){
			die("Error creating database: ".$conn->error);
		}
	}
	$conn->close();

	//Create Tables:
	$conn = new mysqli($server, $user, $pass, $db);
	if($conn->connect_error){
		echo "Error creating connection 2: ".$conn->connect_error;
	}


	$sql = "CREATE TABLE IF NOT EXISTS Plant (
		PlantID INT NOT NULL AUTO_INCREMENT,
		Name VARCHAR(100),
		PRIMARY KEY (PlantID)
	) ENGINE=InnoDB";
	if($conn->query($sql) === FALSE){
		echo "Error creating table Plant:".$conn->error;
	}

	$sql = "CREATE TABLE IF NOT EXISTS Pick (
		PickID INT NOT NULL AUTO_INCREMENT,
		PlantID INT NOT NULL,
		pickDate VARCHAR(20),
		Amount INT,
		Weight FLOAT,
		PRIMARY KEY (PickID),
		FOREIGN KEY (PlantID)
		REFERENCES Plant (PlantID)
		ON UPDATE CASCADE
		ON DELETE CASCADE
	) ENGINE=InnoDB";
	if($conn->query($sql) === FALSE){
		echo "Error creating table Pick:".$conn->error;
	}


	//Show selected results:
	$selectResult = "";
	$beginingDate = $endingDate = "";
	if(isset($_POST['selectSubmitBtn']))
	{
		if(isset($_POST['beginingDate']) != ""){
			$beginingDate = $_POST['beginingDate'];
			echo "beginingDate =".$beginingDate."<br>";
		}
		if(isset($_POST['endingDate']) != ""){
			$endingDate = $_POST['endingDate'];
			echo "endingDate =".$endingDate."<br>";
		}

		$sql = "SELECT plant.Name AS name, ROUND(SUM(pick.Weight),2) AS pounds FROM pick JOIN plant WHERE pick.PlantID=plant.PlantID AND (pick.pickDate BETWEEN '$beginingDate' AND '$endingDate')  GROUP BY plant.Name;";
		$result = $conn->query($sql);

		if($result->num_rows>0)
		{
			$th = FALSE;
			while($row = $result->fetch_assoc())
			{
				if($th==FALSE)
				{
					$th = TRUE;
					$selectResult .= "<tr>";
					foreach($row as $key=>$value){
						$selectResult .= "<td><b>".$key."</b></td>";
						continue;
					}
					$selectResult .= "</tr>";
				}
				$selectResult .= "<tr>";
				foreach($row as $key=>$value){
					$selectResult .= "<td>".$value."</td>";
				}
				$selectResult .= "</tr>";
			}
		}
		else{ $selectResult = "0 results!"; }
	}
	

	//Show query results:
	$queryResult = "";
	if(isset($_POST['querySubmitBtn']) and isset($_POST['queryText']) and $_POST['queryText']!="")
	{
		$sql = $_POST['queryText'];
		$result = $conn->query($sql);

		if($result->num_rows>0)
		{
			$th = FALSE;
			while($row = $result->fetch_assoc())
			{
				if($th==FALSE)
				{
					$th = TRUE;
					$queryResult .= "<tr>";
					foreach($row as $key=>$value){
						$queryResult .= "<td><b>".$key."</b></td>";
						continue;
					}
					$queryResult .= "</tr>";
				}
				$queryResult .= "<tr>";
				foreach($row as $key=>$value){
					$queryResult .= "<td>".$value."</td>";
				}
				$queryResult .= "</tr>";
			}
		}
		else{ $queryResult = "0 results!"; }
	}

	if(isset($_POST['plantNameBtn']) AND isset($_POST['plantName']) != "")
	{
		$plantName = $_POST['plantName'];
		$sql = "INSERT INTO Plant (Name) VALUES ('$plantName')";

		if($conn->query($sql) === FALSE){
			echo "Error inserting into table Plant: ".$conn->error;
		}
	}

	if(isset($_POST['pickBtn']))
	{
		$PlantID = $_POST['plantID'];
		$pickDate = $_POST['date'];
		$amount = $_POST['amount'];
		$weight = $_POST['weight'];
		$sql = "INSERT INTO pick(PlantID, pickDate, Amount, Weight) VALUES ('$PlantID', '$pickDate', '$amount', '$weight')";

		if($conn->query($sql) === FALSE){
			echo "Error inserting into table Pick: ".$conn->error;
		}
	}


	//Close connection
	$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Lab</title>
</head>
<body>
	<table cellpadding="5" cellspacing="2" border="2px;">
		<tr>
			<td><b>Populate Data</b></td>
			<td><b>Select Data</b></td>
			<td><b>Run Query</b></td>
		</tr>
		<tr>
			<td id="populateSection">
				<table>
					<tr>
						<td>
							<form method="post" action="">
								<table id="table1">
									<tr><td><b>Table: Plant</b></td></tr>
									<tr>
										<td>Name: </td>
										<td>
											<input type="text" name="plantName">
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<input type="submit" name="plantNameBtn" value="Insert">
										</td>
									</tr>
								</table>
							</form>
						</td>
					</tr>
					<tr>
						<td>
							<form method="post" action="">
								<table id="table2">
									<tr><td><b>Table: Pick</b></td></tr>
									<tr>
										<td>PlantID: </td>
										<td>
											<input type="text" name="plantID">
										</td>
									</tr>
									<tr>
										<td>Date: </td>
										<td>
											<input type="text" name="date">
										</td>
									</tr>
									<tr>
										<td>Amount: </td>
										<td>
											<input type="text" name="amount">
										</td>
									</tr>
									<tr>
										<td>Weight: </td>
										<td>
											<input type="text" name="weight">
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<input type="submit" name="pickBtn" value="Insert">
										</td>
									</tr>
								</table>
							</form>
						</td>
					</tr>
				</table>
			</td>
			<td id="selectSection">
				<table id="selectTable" cellpadding="5" cellspacing="2">
					<tr>
						<td>
							<form method="post" action="">
								<table cellpadding="5" cellspacing="5">
									<tr>
										<td><b>Begining Date: </b></td>
										<td>
											<input type="text" name="beginingDate" placeholder="mm-dd-yyyy">
										</td>
									</tr>
									<tr>
										<td><b>Ending Date: </b></td>
										<td>
											<input type="text" name="endingDate" placeholder="mm-dd-yyyy">
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<input type="submit" name="selectSubmitBtn" value="Select">
										</td>
									</tr>
								</table>
							</form>
						</td>
					</tr>
					<tr>
						<td><b>Result:</b></td>
					</tr>
					<tr>
						<td>
							<table cellpadding="5" cellspacing="2" border="2px;">
								<?php echo $selectResult; ?>
							</table>
						</td>
					</tr>
				</table>
			</td>
			<td id="querySection">
				<form method="post" action="">
					<table cellpadding="5" cellspacing="5">
						<tr>
							<textarea name="queryText" rows="5" cols="50"></textarea>
						</tr>
						<tr>
							<td>
								<input type="submit" name="querySubmitBtn" value="Run Query">
							</td>
						</tr>
						<tr>
							<td><b>Result:</b></td>
						</tr>
						<tr>
							<td>
								<table cellpadding="5" cellspacing="2" border="2px;">
									<?php echo $queryResult; ?>
								</table>
							</td>
						</tr>
					</table>
				</form>
			</td>
		</tr>
	</table>
</body>
</html>