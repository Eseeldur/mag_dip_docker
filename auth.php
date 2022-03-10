<?php
			$servername = "localhost";
			$username = "root";
                        $password = "Double64";
			$dbname = "litsyl";
			$login = ($_POST['login']); //trim удаляет пробелы
			$Pass = ($_POST['pass']);
			
			if (empty($login)) {
				header("Location: index.html"); exit();
			}
			else {
			
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
			}
		?>
<!DOCTYPE html>
<?//session_start();?>
<html >
    <head>
        <title>Поиск ссылок на научные работы</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<link href="Css.css" rel="stylesheet" type="text/css">
    </head>
	<body>
	
		
		
		
	</body>
</html>
