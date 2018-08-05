<!DOCTYPE html>
<html>
<head>
	<title>Movies Box Office App</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body class="container">

	<h1>Movies Table</h1>
	<form action="movies.php" method="post">
		<table>
			<tr>
				<td>id</td>
				<td><input type="text" name="id"></td>
			</tr>
			<tr>
				<td>title</td>
				<td><input type="text" name="title"></td>
			</tr>
			<tr>
				<td>director</td>
				<td><input type="text" name="director"></td>
			</tr>
			<tr>
				<td>year</td>
				<td><input type="text" name="year"></td>
			</tr>
			<tr>
				<td>length_minutes</td>
				<td><input type="text" name="length_minutes"></td>
			</tr>		
		</table>
		<br>
		<button type="submit" name="submit">Create New Movie</button>
		<br>
		<br>
		<?php 

			$servername = "localhost";
			$username = "root";
			$password = "mariadb";
			$dbname = "test";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			} 

			if(isset($_POST['submit'])){
				$id = $_POST['id'];
				$title = $_POST['title'];
				$director = $_POST['director'];
				$year = $_POST['year'];
				$length_minutes = $_POST['length_minutes'];

				$sql = "INSERT INTO movies (id,title,director,year,length_minutes)
				VALUES ($id,'$title', '$director', $year, $length_minutes)";

				if ($conn->query($sql) === TRUE) {
				    echo "New record created successfully";
				} else {
				    echo "Error: " . $sql . "<br>" . $conn->error;
				}

			}

			$sql = "SELECT * FROM movies";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
				echo '<table class="table table-striped">'.
					 '<tr>'.
					 '<th>id</th>'.
					 '<th>title</th>'.
					 '<th>director</th>'.
					 '<th>year</th>'.
					 '<th>length_minutes</th>'.
					 '</tr>';
				while($row = $result->fetch_assoc()) {
					echo '<tr>'.
						 '<td>'. $row["id"]. "</td>" .
						 '<td>'. $row["title"]. "</td>" .
						 '<td>'. $row["director"]. "</td>" .
						 '<td>'. $row["year"]. "</td>" .
						 '<td>'. $row["length_minutes"]. "</td>" .
						 '</tr>';
							
				}
				echo '</table>';
			} else {
				echo "0 results";
			}

		?>
	</form>

</body>
</html>