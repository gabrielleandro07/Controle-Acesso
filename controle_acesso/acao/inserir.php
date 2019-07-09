<?php
	session_start();

	$nm_usuario = $_POST['nm_usuario'] or '';
	$ds_usuario = $_POST['ds_usuario'] or '';
	$fl_ativo = $_POST['fl_ativo'] or 0;
	$id_perfil = $_POST['id_perfil'] or '';
	$senha = md5($_POST['senha']);

	$conn = mysqli_connect('10.14.93.20', 'root', '123456', 'db_gabriel_leandro') or die ('Ocorreu um erro ao conectar com o banco de dados');

	$query = "INSERT INTO tb_usuario (nm_usuario,ds_usuario,dt_inclusao,fl_ativo,id_perfil) VALUES ('$nm_usuario','$ds_usuario',now(),'$fl_ativo','$id_perfil')";

	$result = mysqli_query($conn, $query);

	if (mysqli_affected_rows($conn) > 0){
	    $_SESSION['mensagem'] = '<div class="alert alert-primary" role="alert">Usuário cadastrado com sucesso</div>';
	
		// cadastra a senha
		$query = " INSERT INTO tb_senha (dt_inclusao, dt_expiracao, id_usuario, ds_senha_cripto) VALUES (now(), DATE_ADD(now(), INTERVAL 60 DAY), (SELECT MAX(id_usuario) FROM tb_usuario), '$senha') ";
		$result = mysqli_query($conn, $query);
		
	}else{
	    $_SESSION['mensagem'] = '<div class="alert alert-danger" role="alert">Ocorreu um erro ao inserir o usuário</div>';
	}
	header("Location: ../index.php ");
?>