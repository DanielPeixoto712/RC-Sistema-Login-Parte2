<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
</head>
<body>
	<h1>Login</h1>
	<form method="POST" action="processa_login.php">
		<label>Nome de Utilizador</label><input type="text" name="user_name" required><br><br>
		<label>Palavra-Passe</label><input type="password" name="password" required><br>
		<input type="submit" name="login"><br>
	</form>
</body>
</html>