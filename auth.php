<?php
			$servername = "localhost";
			$username = "admin";
			$password = "NTLTB25qj7un";
			$dbname = "litsyl";
			$login = ($_POST['login']); //trim удаляет пробелы
			$Pass = ($_POST['pass']);
			
			if (empty($login)) {
				header("Location: index.html"); exit();
			}
			else {
				$conn = mysqli_connect($servername, $username, $password, $dbname);
				mysqli_set_charset($conn, "utf-8");
				
				/* check connection */ 
				if (!$conn) {
					//printf("Connect failed: %s: %s\n", mysqli_connect_errno(), mysqli_connect_error());
					echo "Connect failed: " . mysqli_connect_errno() . ": " . mysqli_connect_error() ."\n";
					exit();
				}
				if (!$conn->set_charset("utf8")) {
					//printf("Ошибка при загрузке набора символов utf-8 %s\n", $conn->error);
					echo "Ошибка при загрузке набора символов utf-8" . $conn->error . "\n";
					exit();
				}else {
					//printf ("Текущий набор символов: %s\n", mysqli_get_charset($conn));
					//echo "Текущий набор символов: " . mysqli_character_set_name($conn);
				}

				//printf("Host information: %s\n", mysqli_get_host_info($conn));
				//echo "Host information: " . mysqli_get_host_info($conn) ."\n";
				
				$sql_query = "SELECT Login, Password FROM loginpass WHERE Login='$login'";
				$result = mysqli_query($conn, $sql_query);
				$row = $result->fetch_assoc();
					
					
				if($row['Password'] == $Pass) {
					header("Location: adding.html"); exit();
				}
				else {
					header("Location: index.html"); exit();
				}

				/* close connection */
				mysqli_close($conn);
			
			
			
			/*
			$conn = new mysqli($servername, $username, $password, $dbname);
			
			mysqli_set_charset ( $conn , utf-8 );
				
			
				if (!$conn) {
						echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
						exit;
				}
				if (!$conn->set_charset("utf8")) {
					printf("Ошибка при загрузке набора символов utf-8 %s\n", $conn->error);
					exit();
				} else {
					//printf ("Текущий набор символов: %s\n", $conn->character_set_name());
				}
				
				$sql = "SELECT Login, Password FROM lp WHERE Login='$login'";
				$result = $conn->query($sql);
				$row = $result->fetch_assoc();
				
				
				if($row['Password'] == $Pass) {
					header("Location: adding.html"); exit();
				}
				else {
					header("Location: index.html"); exit();
				}
				
				$conn->close();
				*/
			}
		?>
<!DOCTYPE html>
<?//session_start();?>
<html >
    <head>
        <title>Поиск ссылок на научные работы</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<link href="css/Css.css" rel="stylesheet" type="text/css">
    </head>
	<body>
	
		
		
		
	</body>
</html>
