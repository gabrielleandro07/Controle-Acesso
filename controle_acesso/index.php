<?php
session_start();
if(!isset($_SESSION['id_usuario'])){
	header("location: login.php");
	exit();	
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
            <h1>Lista de Usuários</h1>
			<b>Olá:</b> <?php echo $_SESSION['nm_usuario']; ?> - <a href="sair.php">desconectar</a>
			
			
			<?php if($_SESSION['id_perfil'] == 1){ ?>
            <a class="btn btn-primary mb-2 float-right" href="cadastrarUsuario.php" role="button"><i class="fa fa-plus" aria-hidden="true"></i>
                Cadastrar
            </a>
			<?php } ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
						<th>Nome</th>
                        <th>Usuário</th>
                        <th>Data Inclusão</th>
                        <th>Ativo</th>
                        <th>Id Perfil</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include_once 'acao/selecionar.php'; ?>
                </tbody>
            </table>
            <?php if (isset($_SESSION['mensagem'])) echo $_SESSION['mensagem'] ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="index.js"></script>
    </body>
</html>