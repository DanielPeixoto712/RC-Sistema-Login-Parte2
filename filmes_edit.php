<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
	if (isset($_GET['filme'])&& is_numeric($_GET['filme'])) {
		$idFilme = $_GET['filme'];
		$con=new mysqli("localhost","root", "","projeto-filmes");

		if ($con->connect_errno!=0) {
			echo "<h1>Ocorreu um erro no acesso á base de dados.<br>".$con->connect_error."</h1>";
			exit();
		}
		$sql="Select * from filmes where id_filme=?";
		$stm=$con->prepare($sql);
		if ($stm!=false) {
			$stm->bind_param("i", $idFilme);
			$stm->execute();
			$res=$stm->get_result();
			$livro=$res->fetch_assoc();
			$stm->close();
		}
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<meta charset="ISO-8859-1">
			<title>Editar Filme</title>
<h1>Editar Filmes</h1>
			<form action="filmes_update.php" method="POST">
		<label>Titulo</label><input type="text" name="titulo" required value="<?php echo $livro['titulo']; ?>"><br>
		<label>Sinopse</label><input type="text" name="sinopse" value="<?php echo $livro['sinopse'];?>"><br>
		<label>Quantidade</label><input type="text" name="quantidade" value="<?php echo $livro['quantidade'];?>"><br>
		<label>Idioma</label><input type="text" name="idioma" value="<?php echo $livro['idioma'];?>"><br>
		<label>Data Lançamento</label><input type="text" name="data_lancamento" value="<?php echo $livro['data_lancamento'];?>"><br>
        <input type="submit" name="enviar">
	</form>
	</body>
		
			<?php
			}
			else{
				echo "<h1>Houve um erro ao processar o seu pedido.<br> Dentro de segundos irá ser rencaminhado!</h1>";
				header ("refresh:5; url=index.php");
				
			}
		
		?>
		</html>
	<?php
}
?>