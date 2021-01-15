<?php


session_start();

if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if ($_SESSION['login']=="correto" && isset($_SESSION['login'])) {
	//aqui colocamos o conteudo




	$con=new mysqli("localhost","root", "","projeto-filmes");
	if($con->connect_errno!=0){
		echo "Ocorreu um erro no acesso á base de dados".$con->connect_error;
		exit;
	}
	else {
	?>
	<!DOCTYPE html>
	<html style="background-color:#A4A4A4">
	<head>
	<meta charset="ISO-8859-1">
	<title>filmes</title>
	</head>
	<body>
		<h1>Lista de Filmes</h1>
		<?php
		$stm=$con->prepare('select * from filmes');
		$stm->execute();
		$res=$stm->get_result();
		while($resultado = $res->fetch_assoc()){
			echo '<a href="filmes_show.php?filme='.$resultado['id_filme'].'">';
			echo "<h4>".$resultado["titulo"]."</h4>";
			echo "</a>";
			echo '<a href="filmes_edit.php?filme='.$resultado['id_filme'].'"><li>Editar</li></a>';
			echo "<br>";
			echo '<a href="filmes_delete.php?filme='.$resultado['id_filme'].'"><li>Eliminar</li></a>';
			echo "<br>";
		}
		$stm->close();
		?>
	
	<a  href="filmes_create.php" ><h4>Adicionar Filme</h4></a>
	
<hr>

	<h1>Lista de Atores</h1>
		<?php
		$stm=$con->prepare('select * from atores');
		if ($stm!=false) {
			$stm->execute();
			$res=$stm->get_result();
			while($resultado = $res->fetch_assoc()){
				echo '<a href="atores_show.php?ator='.$resultado['id_ator'].'">';
				echo "<h4>".$resultado["nome"]."</h4>";
				echo "</a>";
				echo '<a href="atores_edit.php?ator='.$resultado['id_ator'].'"><li>Editar</li></a>';
				echo "<br>";
				echo '<a href="atores_delete.php?ator='.$resultado['id_ator'].'"><li>Eliminar</li></a>';
				echo "<br>";

			}

			$stm->close();
		}
		?>
		<a  href="atores_create.php" ><h4>Adicionar Ator</h4></a>

<hr>	
		<h1>Lista de Realizadores</h1>
		<?php
		$stm=$con->prepare('select * from realizadores');
		if ($stm!=false) {
			$stm->execute();
			$res=$stm->get_result();
			while($resultado = $res->fetch_assoc()){
				echo '<a href="realizadores_show.php?realizador='.$resultado['id_realizador'].'">';
				echo "<h4>".$resultado["nome"]."</h4>";
				echo "</a>";
				echo '<a href="realizadores_edit.php?realizador='.$resultado['id_realizador'].'"><li>Editar</li></a>';
				echo "<br>";
				echo '<a href="realizadores_delete.php?realizador='.$resultado['id_realizador'].'"><li>Eliminar</li></a>';
				echo "<br>";

			}
		}
					?>
					<a  href="realizadores_create.php" ><h4>Adicionar Realizador</h4></a>

<hr>


					<h1>Lista de Utilizadores</h1>
		<?php
		$stm=$con->prepare('select * from utilizadores');
		if ($stm!=false) {
			$stm->execute();
			$res=$stm->get_result();
			while($resultado = $res->fetch_assoc()){
				echo '<a href="utilizadores_show.php?utilizador='.$resultado['id_utilizador'].'">';
				echo "<h4>".$resultado["nome"]."</h4>";
				echo "</a>";
				echo '<a href="utilizadores_edit.php?utilizador='.$resultado['id_utilizador'].'"><li>Editar</li></a>';
				echo "<br>";
				echo '<a href="utilizadores_delete.php?utilizador='.$resultado['id_utilizador'].'"><li>Eliminar</li></a>';
				echo "<br>";

			}
		}
					?>
					<a  href="utilizadores_create.php" ><h4>Adicionar Utilizadores</h4></a>
					

	<hr>
	

<?php
		$stm->close();
		
		?>
		


	</body>
	</html>
	

	


<?php

}//conection








}//login
else{
	echo 'Para entrar nesta página necessita de efetuar <a href="login.php">login</a>';
	header('refresh:2;url=login.php');
}




