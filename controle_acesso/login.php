<?php
session_start();

if(isset($_GET['logar'])){
	
	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];
	$erro = false;
	$login_valido = false;
	
	
	if(!$erro && strlen(trim($usuario)) <= 0){
		$erro = true;
		$_SESSION['mensagem'] = '<div class="alert alert-danger" role="alert">Usuário não informado.</div>';
	}
	
	if(!$erro && strlen(trim($usuario)) <= 0){
		$erro = true;
		$_SESSION['mensagem'] = '<div class="alert alert-danger" role="alert">Senha não informada.</div>';
	}
	
	if(!$erro){
		
		$conn = mysqli_connect('10.14.93.20', 'root', '123456', 'db_gabriel_leandro') or die ('Ocorreu um erro ao conectar com o banco de dados');
		$query = " SELECT * FROM tb_usuario WHERE ds_usuario = '$usuario' AND fl_ativo = 1 ";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		
		if (mysqli_affected_rows($conn) > 0){
			
			// valida senha
			$query2 = " SELECT * FROM tb_senha WHERE id_usuario = '".$row["id_usuario"]."' AND ds_senha_cripto = '".md5($senha)."' ";
			
			$result2 = mysqli_query($conn, $query2);
			$row2 = mysqli_fetch_assoc($result2);
			
			//echo mysqli_affected_rows($conn);exit();
			
			if (mysqli_affected_rows($conn) > 0){
				$login_valido = true;
				
				$_SESSION['id_usuario'] = $row["id_usuario"];
				$_SESSION['id_perfil'] = $row["id_perfil"];
				$_SESSION['nm_usuario'] = $row["nm_usuario"];
				
				header("location: index.php");
				exit();
				
			}else{
				
				$_SESSION['mensagem'] = '<div class="alert alert-danger" role="alert">Usuário ou senha invalida.</div>';
				header("location: login.php");
				exit();
			}
			
		}
		
	}
	
}

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Usuários</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    </head>

    <body>
        <div class="container mt-5 card-header">
            <h1>Login</h1>
           
		   <form action="?logar" method="post" name="login_form" id="login_form">
				<?php if(isset($_SESSION['mensagem'])) echo $_SESSION['mensagem']; ?>
				<div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="user">Usuário</label>
                            <input type="text" class="form-control" name="usuario" id="usuario">
                        </div>
                    </div>
					
					<div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="user">Senha</label>
                            <input type="password" class="form-control" name="senha" id="senha" maxlength="15">
                        </div>
                    </div>
					
					<button type="submit" class="btn btn-primary">Entrar</button>
					
                </div>
				</form>
		   
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="index.js"></script>
		<?php unset($_SESSION['mensagem']); ?>
    </body>
</html>