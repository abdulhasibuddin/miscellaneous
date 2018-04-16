<?php
	$server = "localhost";
	$user = "root";
	$pass = "";
	$db = "bl";

	$conn = new mysqli($server, $user, $pass, $db);
	if($conn->connect_error)
	{
		die("Connection failed: ".$conn->connect_error);
	}

	$word = $sentiment = $pos = $msg = "";

	if(isset($_POST['submit'])==TRUE)
	{
		$word = $_POST['lexemeText'];
		$sentiment = $_POST['sentiment'];
		$pos = $_POST['pos'];

		if($word=="" or $sentiment=="--সেন্টিমেন্ট--" or $pos=="--পদ--")
		{
			$msg = "All fields should be selected!";
		}
		else if($msg=="")
		{
			$sql = "INSERT INTO lexicon_table (word, sentiment, pos) VALUES (?, ?, ?)";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("sss", $word, $sentiment, $pos);
			mysqli_set_charset($conn, 'utf8');
			$stmt->execute();

			$stmt->close();
			$conn->close();

			$msg = "Inserted successfully!";
			echo "<br>word = ".$word;
			echo "<br>sentiment = ".$sentiment;
			echo "<br>pos = ".$pos;
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>MySQL-Bangla-Entry</title>
</head>
<body>
	<form action="" method="post">
		<table id="buildTable">
			<tr>
				<?php
					echo $msg;
					$msg = "";
				?>
			</tr>
			<tr>
				<th>শব্দ</th>
				<th>সেন্টিমেন্ট</th>
				<th>বাক্য</th>
			</tr>
			<tr>
				<td>
					<input type="text" name="lexemeText" required autofocus>
				</td>
				<td>
					<select name="sentiment">
						<option>--সেন্টিমেন্ট--</option>
						<option value="ভালো">ভালো</option>
						<option value="খারাপ">খারাপ</option>
						<option value="নিরপেক্ষ">নিরপেক্ষ</option>
						<option value="প্রশ্নবোধক">প্রশ্নবোধক</option>
						<option value="নাবোধক">নাবোধক</option>
						<option value="বিশ্ময়বোধক">বিশ্ময়বোধক</option>
					</select>
				</td>
				<td>
					<select name="pos">
						<option>--পদ--</option>
						<option value="বিশেষ্য">বিশেষ্য</option>
						<option value="বিশেষণ">বিশেষণ</option>
						<option value="সর্বনাম">সর্বনাম</option>
						<option value="অব্যয়">অব্যয়</option>
						<option value="ক্রিয়া">ক্রিয়া</option>
					</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" name="submit" value="Insert">
				</td>
			</tr>
		</table>
	</form>
</body>
</html>
