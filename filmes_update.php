<?php





session_start();

if (!isset($_SESSION['login'])) {
	$_SESSION['login']="incorreto";
}
if ($_SESSION['login']=="correto" && isset($_SESSION['login'])) {
	//aqui colocamos o conteudo


if ($_SERVER['REQUEST_METHOD']=='POST') {
	$titulo="";
	$sinopse="";
	$quantidade=0;
	$data_lancamento="";
	$idioma="";


	if (isset($_POST['titulo'])) {
		$titulo=$_POST['titulo'];
	}
	else{
		echo '<script>alert("É obrigatório o preenchimento do título.");</script>';
	}
	if (isset($_POST['sinopse'])) {
		$sinopse=$_POST["sinopse"];
	}
	if (isset($_POST['qauntidade'])&& is_numeric($_POST['quantidade'])) {
		$qauntidade=$_POST['quantidade'];
	}
	if (isset($_POST['idioma'])) {
		$idioma=$_POST['idioma'];
	}

	if (isset($_POST['data_lancamento'])) {
		$data_lancamento=$_POST['data_lancamento'];
	}
	$con=new mysqli("localhost","root", "","projeto-filmes");

	if ($con->connect_errno!=0) {
		echo "Ocorreu um erro no acesso á base de dados. <br>".$con->connect_error;
		exit;
	}
	else{
		$sql="update into filmes (titulo, sinopse, idioma, quantidade, data_lancamento) values (?,?,?,?,?)";
		$stm=$con->prepare($sql);

			
			if ($stm!=false) {
				$stm->bind_param("ssssi", $titulo, $sinopse, $idioma, $data_lancamento, $quantidade);
				$stm->execute();
				$stm->close();
				echo '<script>alert("Filme alterado com sucesso!!")</script>';
				echo "Aguarde um momento. A reencaminhar página";
				header ('refresh:5, url=index.php');
			}
			else{

		}
	}
}
else{
	echo ("<h1>Houve um erro ao processar o seu pedido.<br> Dentro de segundos irá ser rencaminhado!</h1>");
				header ("refresh:5; url= index.php");
}



}//login
else{
	echo 'Para entrar nesta página necessita de efetuar <a href="login.php">login</a>';
	header('refresh:2;url=login.php');
}
?>