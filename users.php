<?php
	ob_start();
	session_start();
	if(isset($_SESSION['user'])!="" && ($_SESSION['tipo'])==2){
		include_once 'dbconnect.php';

		function filterTable($query)
		{
		    $filter_Result = mysql_query($query) or die("Error en: $query: " . mysql_error());;
		    return $filter_Result;
		}


	// function to connect and execute the query

	?>

	<!DOCTYPE html>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Buscar Usuario</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
	<link rel="stylesheet" href="style.css" type="text/css" />
	</head>
	<body>
		<div class="container">
				<div id="login-form">
	        <form action="users.php" class="searchbox_1" method="post">
							<div class="form-group">
									<h2 class="">BUSCAR USUARIO.</h2>
								</div>
	            <input type="text" name="valueToSearch" class="search_1" placeholder="Ingrese Rut"><br><br>
	            <input type="submit" name="search" class="submit_1" value="Ingrese RUT sin puntos ni guión"><br><br>
							<?php
							if(isset($_POST['search']))
							{
									$valueToSearch = $_POST['valueToSearch'];
									// search in all table columns
									// using concat mysql function
									$query = "SELECT * FROM users WHERE CONCAT(userId, userName, userEmail, TIPO) LIKE '%".$valueToSearch."%'";
									$search_result = filterTable($query);
									$count = mysql_num_rows($search_result);
									if($count!=0){
									?>
									<html>
									<head>
									<style>
									table {
    								border-collapse: collapse;
    								width: 100%;
									}

									th, td {
    								padding: 8px;
    								text-align: left;
    								border-bottom: 1px solid #ddd;
									}

									tr:hover{background-color:#f5f5f5}
									</style>
										<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
										<title>Coding Cage - Login & Registration System</title>
										<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
										<link rel="stylesheet" href="style.css" type="text/css" />
									</head>
									<body>
									<table>
											<tr>
													<th>Rut</th>
													<th>Nombre</th>
													<th>Email</th>
													<th>Tipo</th>
											</tr>
						<!-- populate table from mysql database -->
											<?php while($row = mysql_fetch_array($search_result)):?>
											<tr>
													<td><?php echo $row['userId'];?></td>
													<td><?php echo $row['userName'];?></td>
													<td><?php echo $row['userEmail'];?></td>
													<td><?php if(($row['TIPO'])==2){echo 'Administrador';}else{echo 'Operario';}?></td>
											</tr>
											<?php endwhile;?>
									</table>
									</body>
									</html>
									<?php
								}

							}else {
									$query = "SELECT * FROM users";
									$search_result = filterTable($query);
							}



							 ?>




	        </form>
				</div>
				</div>

	    </body>
	</html>
	<?php ob_end_flush();
	}else{
		header("Location: home.php");
	}
	 ?>
