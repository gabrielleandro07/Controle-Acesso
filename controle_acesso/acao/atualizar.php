<?php
	session_start();

	$id_usuario = $_POST['id_usuario'];
	$nm_usuario = $_POST['nm_usuario'] or '';
	$ds_usuario = $_POST['ds_usuario'] or '';
	$fl_ativo = $_POST['fl_ativo'] or 0;
	$id_perfil = $_POST['id_perfil'] or '';
	$senha = $_POST['senha'] or '';

	$conn = mysqli_connect('10.14.93.20', 'root', '123456', 'db_gabriel_leandro') or die ('Ocorreu um erro ao conectar com o banco de dados');
	$query = "UPDATE tb_usuario SET nm_usuario = '$nm_usuario', ds_usuario='$ds_usuario', fl_ativo ='$fl_ativo', id_perfil = '$id_perfil' WHERE id_usuario = '$id_usuario' ";

	echo $query;

	$result = mysqli_query($conn, $query);
	
	// atualiza senha
	if(strlen(trim($senha)) > 0){
		
		$senha = " UPDATE tb_senha SET dt_expiracao = DATE_ADD(now(), INTERVAL 60 DAY), ds_senha_cripto = '".md5($senha)."' WHERE id_usuario = '$id_usuario' ";
		$result = mysqli_query($conn, $senha);
		
	}
	

	if (mysqli_affected_rows($conn) > 0){
		
	    $_SESSION['mensagem'] = '<div class="alert alert-primary" role="alert">Usuário atualizado com sucesso</div>';
	}else{
	    $_SESSION['mensagem'] = '<div class="alert alert-danger" role="alert">Ocorreu um erro ao atualizar o usuário</div>';
	}

	header("Location: ../index.php ");
?>