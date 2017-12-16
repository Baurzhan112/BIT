<!DOCTYPE html>
<html>
<head>
	<title>Аккаунт</title>
</head>
<body>
	<h4><?=$message;?></h6>
	<h3>Аккаунт: <?=$client_name;?></h3>
	<h3>Ваш баланс: <?=$client_balance;?> рублей</h3>
	<form method="POST" action="https://mysite.ru/account/index">
	<p>списание средств: <input type="text" name="write_off"></p>
	<input type="submit" value="списать">
	</form>
	<a href="https://mysite.ru/login/logout">Выйти</a>
</body>
</html>