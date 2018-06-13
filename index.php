<?php
$dbc = mysqli_connect('localhost', 'root', '', 'films');
if(!isset($_COOKIE['user_id'])) {
	if(isset($_POST['submit'])) {
		$user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
		$user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
		if(!empty($user_username) && !empty($user_password)) {
			$query = "SELECT `user_id` , `username` FROM `signup` WHERE username = '$user_username' AND password = SHA('$user_password')";
			$data = mysqli_query($dbc,$query);
			if(mysqli_num_rows($data) == 1) {
				$row = mysqli_fetch_assoc($data);
				setcookie('user_id', $row['user_id'], time() + (60*60*24*30));
				setcookie('username', $row['username'], time() + (60*60*24*30));
				$home_url = 'http://' . $_SERVER['HTTP_HOST'];
				header('Location: '. $home_url);
		
			}
			else {
				echo 'Извините, вы должны ввести правильные имя пользователя и пароль';
			}
		}
		else {
			echo 'Извините вы должны заполнить поля правильно';
		}
	}
}

if(isset($_POST['generate'])) {
	$query = "SELECT `name` FROM `films` ORDER BY RAND() LIMIT 1";
	$result = mysqli_query($dbc,$query);
	$row = mysqli_fetch_row($result);
	echo "<tr>";
    echo "<td>$row[0]</td>";
    echo "</tr>";
}

if(isset($_POST['parse'])) {
	function curl($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_USERAGENT, 'User-Agent:Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36');    
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			
		$return         = curl_exec($ch);
		$curl_info      = curl_getinfo($ch);
		$header_size    = $curl_info['header_size'];
		$headers        = mb_substr($return, 0, $header_size);
		$headers        = explode("\r\n", $headers);
		$headers        = array_filter($headers);
		$body           = mb_substr($return, $header_size); 
		curl_close($ch);
		return array(
			'headers'   => $headers,
			'body'      => $body,
		);
	} 
	 
	$response = curl("https://www.ivi.ru/search/?q=фильмы+на+вечер");
	echo $response['body'];
}


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="css/style.css" rel="stylesheet">
<link href="icon/favicon.ico" rel="shortcut icon" type="image/x-icon" />
</head>
<body>
<header>
<a href="/"><h1>Генератор фильмов</h1></a>
</header>

<section>
<?php
	if(empty($_COOKIE['username'])) {
?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		<label for="username">Логин:</label>
	<input type="text" name="username">
	<label for="password">Пароль:</label>
	<input type="password" name="password">
	<button type="submit" name="submit">Вход</button>
	<a href="signup.php">Регистрация</a>
	</form>
<?php
}
else {
	?>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	
		<button type="submit" name="generate">Сгенерировать</button>
	</form>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	
		<button type="submit" name="parse">Спарсить</button>
	</form>
	<p><a href="exit.php">Выйти(<?php echo $_COOKIE['username']; ?>)</a></p>
<?php	
}
?>
</section>
</body>
</html>