<!DOCTYPE html>
<html>
<head>
	<title>Movies BoxOffice App</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body class="container">

	<h1>Box Office Table</h1>
	<form action="boxoffice.php" method="post">
		<table>
			<tr>
				<td>movie_id</td>
				<td><input type="text" name="movie_id"></td>
			</tr>
			<tr>
				<td>rating</td>
				<td><input type="text" name="rating"></td>
			</tr>
			<tr>
				<td>domestic_sales</td>
				<td><input type="text" name="domestic_sales"></td>
			</tr>
			<tr>
				<td>international_sales</td>
				<td><input type="text" name="international_sales"></td>
			</tr>		
		</table>
		<br>
		<button type="submit" name="submit">Create New Box Office</button>
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
				$movie_id = $_POST['movie_id'];
				$rating = $_POST['rating'];
				$domestic_sales = $_POST['domestic_sales'];
				$international_sales = $_POST['international_sales'];

				$sql = "INSERT INTO box_office (movie_id,rating,domestic_sales,international_sales)
				VALUES ($movie_id,$rating, $domestic_sales, $international_sales)";

				if ($conn->query($sql) === TRUE) {
				    echo "New record created successfully";
				} else {
				    echo "Error: " . $sql . "<br>" . $conn->error;
				}

			}

			$sql = "SELECT * FROM box_office";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
				echo '<table class="table table-striped">'.
					 '<tr>'.
					 '<th>movie_id</th>'.
					 '<th>rating</th>'.
					 '<th>domestic_sales</th>'.
					 '<th>international_sales</th>'.					 
					 '</tr>';
				while($row = $result->fetch_assoc()) {
					echo '<tr>'.
						 '<td>'. $row["movie_id"]. "</td>" .
						 '<td>'. $row["rating"]. "</td>" .
						 '<td>'. $row["domestic_sales"]. "</td>" .
						 '<td>'. $row["international_sales"]. "</td>" .						 
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