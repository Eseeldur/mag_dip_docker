<!DOCTYPE html>
<html >
    <head>
        <title>Поиск ссылок на научные работы</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<link href="Css.css" rel="stylesheet" type="text/css">
    </head>
    <body>
			<div id='K'>
			<div id='kartinka'> <img src="main_logo.png"  vspace="25"> </div>
			</div>
			
			<div class="FORM">
			
			<div class="form" name="search_form">
			
					<button class="form_button" >Добавление литературы</button> 
					
					<div class="popup">
					  <div class="popup__container">
						<div class="popup__wrapper">
						  <div id="blablabla">
						  
							<form role="form" action="auth.php" autocomplete="off" method="POST">
							  <label>Login:</label>
							  <input class="form_input" type="text" name="login">
							  <label>Password:</label>
							  <input class="form_input" type="text" name="pass">
							  <button class="form_button" type="submit" class="btn_btn-success">Отправить</button>
							</form>
							
						  </div>
						</div>
					  </div>
					</div>
					<script>
						const button = document.querySelector('button');
						const form = document.querySelector('#blablabla');
						const popup = document.querySelector('.popup');

						button.addEventListener('click', () => {
						  form.classList.add('open');
						  popup.classList.add('popup_open');
						});
					</script>
			</div>
		
			
			<form class="form" name="search_form" method="post" action="easyrequest.php"> 
			
				<div id='box' class="input-field" >
					<input class="form_input" type="text" name="request"  placeholder="Укажите ключевые слова для поиска">
				</div>    
				
				<div >
					 <button class="form_button" type="submit">Поиск</button>
				</div>
			</form>
			</div>
			
			<div>
			<?php
			
				$servername = "localhost";
				$username = "admin";
				$password = "NTLTB25qj7un";
				$dbname = "litsyl";
				$request =($_POST['request']);//trim удаляет пробелы
				#$conn = new mysqli($servername, $username, $password, $dbname);
				
				if (empty($request)) {
					echo"<font color='red'>Вы ничего не написали.</font>";
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
						echo "Ошибка при загрузке набора символов utf-8" . $conn->error;
						exit();
					}else {
						echo "Текущий набор символов: " . mysqli_character_set_name($conn);
					}

					//printf("Host information: %s\n", mysqli_get_host_info($conn));
					echo "Host information: " . mysqli_get_host_info($conn) ."\n";
					$sql_query = "SELECT id, Key_words, Link FROM Links WHERE Key_words LIKE '%".$request."%'";
					$result = mysqli_query($conn, $sql_query);
					//$row = $result->fetch_assoc();
					$row_cnt = mysqli_num_rows($result);
					#if ($result->num_rows > 0) {
					if ($row_cnt > 0) {
						echo "<ol>";
						while ($row = mysqli_fetch_assoc($result)) {
							echo "<li>" .$row["Link"]. "</li>";
						}
						echo "</ol>";
					} else {
						echo "Ничего не найдено.";
					}
					/* close connection */
					mysqli_close($conn);
				//$conn = mysql_connect($servername, $username, $password);
				//mysql_select_db($dbname,$conn);
				//if (empty($request)) {
				//	echo"<font color='red'>Вы ничего не написали.</font>";
				//}else{
					
				//	if (!$conn) {
				//		echo 'Не могу соединиться с БД. Код ошибки: ' . mysql_connect_errno() . ', ошибка: ' . mysql_connect_error();
				//		exit;
				//	}
				
				//if (!mysql_set_charset("utf8",$conn)) {
				//	printf("Ошибка при загрузке набора символов utf8: %s\n", mysql_error($conn));
				//	exit();
				//}
				//else {
				//	printf ("Текущий набор символов: %s\n", $conn->character_set_name());
				//}
				
				#$sql = "SELECT id, Key_words, Link FROM test WHERE Key_words LIKE '%".$request."%'";
				
				#$result = $conn->query($sql);
				//$result = mysql_query("SELECT id, Key_words, Link FROM Links WHERE Key_words LIKE '%".$request."%'",$conn);
				#$row_cnt = $result->num_rows;
				//$row_cnt = mysql_num_rows($result);
				#if ($result->num_rows > 0) {
				//if ($row_cnt > 0) {
				//	echo "<ol>";
				//	while ($row = mysql_fetch_assoc($result)) {
				//		echo "<li>" .$row["Link"]. "</li>";
				//	}
				//	echo "</ol>";
				//} else {
				//	echo "Ничего не найдено.";
				//}
				
				//mysql_close($conn);
				}
			?>
			
			
			</div>
    </body>
    </html>
