<?php
if ($_SERVER['REQUEST_METHOD']=="POST") {
	$nome="";
	$data_nascimento="";
	$nacionalidade="";
	

	if (isset($_POST['nome'])) {
		$nome=$_POST['nome'];
	}
	else{
		echo '<script>alert("É obrigatório o preenchimento do nome.");</script>';
	}
	if (isset($_POST['data_nascimento'])) {
		$data_nascimento=$_POST["data_nascimento"];
	}
	
	if (isset($_POST['nacionalidade'])) {
		$nacionalidade=$_POST['nacionalidade'];
	}


	$con=new mysqli("localhost", "root", "", "projeto-filmes");

	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso á base de dados. <br>".$con->connect_error;
		exit;
	}
	else{
		$sql="insert into filmes (titulo, sinopse, idioma, quantidade, data_lancamento) values (?,?,?,?,?)";
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			
			$stm->bind_param('sssis', $nome, $data_nascimento, $nacionalidade);
			$stm->execute();
			$stm->close();

			echo '<script>alert("Livro adicionado com sucesso")</script>';
			echo "Aguarde um momento. A reencaminhar página";
			header ("refresh:5;url=index.php");
		}
		else{
			echo ($con->error);
			echo "Aguarde um momento. A reencaminhar página";
			header ("refresh:5; url=index.php");
		}
	}
}
else{
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Adicionar Atores</title>
	</head>
	<body>
		<h1>Adicionar Atores</h1>
		<form action="filmes_create.php" method="POST">
		<label>Nome</label><input type="text" name="nome" required><br>
		<label>Data_Nascimento</label><input type="date" name="data_nascimento"><br>
		<label>Nacionalidade</label><input type="text" name="nacionalidade"><br>
        <input type="submit" name="enviar">
	</form>
	</body>
	</html>
<?php
}
?>