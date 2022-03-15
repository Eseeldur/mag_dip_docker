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
			<form class="form" name="search_form" action="adding.html">
			<div class= "vozvrat">
			
					<!-- <a class="form_button" href="adding.html">Добавление литературы</a> -->
					<button class="form_button">Добавление литературы</button>
				
			</div>
		
			
			</form>
			
			<form class="form" name="search_form"  action="index.html"> 
			
				
				<div class= "vozvrat">
					 <!-- <a class="form_button" href="index.html">Возврат на главную</a> -->
					<button class="form_button">Возврат на главную страницу</button>
				</div>
			</form>
			</div>
			
			<div>
				<?php
					
					if ($_POST) {
						$servername = "localhost";
						$username = "admin";
						$password = "NTLTB25qj7un";
						$dbname = "litsyl";
						$user_link = trim($_POST['User_Link']);
						$key_words = trim($_POST['Key_words']);
						$name = trim($_POST['Name']);
						//echo "<br> Данные: $user_link, $key_words <br>";
						
				
						$error = false;
						$errortext = "<p> <b> <font color='red'><h3>При добавлении в базу данных произошли следующие ошибки: </h3></font></p><ul>";
						if (empty($user_link)) {
							$error = true;
							$errortext .="<li><font color='red'>Вы не заполнили поле литературной ссылки по ГОСТ!</font></li>";
						}	else {	
							}
						if (empty($key_words)) {
							$error = true;
							$errortext .= " <li><font color='red'>Вы не заполнили поле с ключевыми словами!</font></li>";
						} else {
						}
						$errortext .="</ul></b>";
						if ($error){
							echo($errortext);
						} else {
							//подключение к базе данных
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
								echo "Текущий набор символов: " . mysqli_character_set_name($conn);
							}

							//printf("Host information: %s\n", mysqli_get_host_info($conn));
							echo "Host information: " . mysqli_get_host_info($conn) ."\n";
							
							/*
							$dbcon = mysql_connect("localhost","root","Double64");
										
							mysql_set_charset('utf8',$dbcon);
							mysql_select_db("litsyl",$dbcon);
										
							if(!$dbcon) {
								echo "<p>Произошла ошибка при подсоединении к MySQL!</p>".mysql_error();
								exit();
							} else {
								if (!mysql_select_db("litsyl",$dbcon)) {
									echo ("<p>Выбранной базы данных не существует!</p>");
								}
							}
							*/
							//проверка на существование работы в БД
							//$sql_query_exist = "SELECT id FROM Links WHERE Link LIKE '%$name%'"
							//$result = mysqli_query($conn, $sql_query_exist);
							//$result = mysqli_query("SELECT id FROM Links WHERE Link LIKE '%$name%'",$dbcon);	 
							//$row = mysqli_fetch_array($result);
							$row = mysqli_fetch_array(mysqli_query($conn, "SELECT id FROM Links WHERE Link LIKE '%$name%'"));
							
							if(!empty($row["id"])) {
								exit("Работа уже существует в базе данных. <form class='form' method='get' action='adding.html'><button class='form_button'>Измените ссылку?</button></form>.");
							}
							else {	 
								//Запись в БД данных SQL запросом
								$sql_query_add = mysqli_query($conn,"INSERT INTO Links (Key_words,Link) Values ('$key_words $user_link','$user_link')");
								
								if (!$sql_query_add) {echo "Запрос не прошел.Попробуйте еще раз.";}
								else{
									echo "<h3 text-align='center'>Вы успешно добавили работу!</h3>";
								}
							}
							/* close connection */
							mysqli_close($conn);
						}
					}
					if (($_POST&&$error)|| !$_POST){
						echo"<h3>Так делать нельзя!</h3>";}
				?>


			</div>
    </body>
    </html>
