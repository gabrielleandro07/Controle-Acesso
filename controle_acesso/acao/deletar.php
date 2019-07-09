<?php
	session_start();
	
	$id = $_POST['id'];

	$conn = mysqli_connect('10.14.93.20', 'root', '123456', 'db_gabriel_leandro') or die ('Ocorreu um erro ao conectar com o banco de dados');
	
	// exclui a senha
	$query_senha = "DELETE FROM tb_senha WHERE id_usuario=$id;";
	$result_senha = mysqli_query($conn, $query_senha);
	
	// exclui o usuario
	$query = "DELETE FROM tb_usuario WHERE id_usuario=$id;";
	$result = mysqli_query($conn, $query);

	if ($result){
	    $_SESSION['mensagem'] = '<div class="alert alert-primary" role="alert">Usuário deletado com sucesso</div>';
		
	}else{
	    $_SESSION['mensagem'] = '<div class="alert alert-danger" role="alert">Ocorreu um erro ao deletar o usuário</div>';
	}
	header("Location: ../index.php ");
?>