<?php
session_start();
if(!isset($_SESSION['id_usuario'])){
	header("location: login.php");
	exit();	
}

if($_SESSION['id_perfil'] <> 1){
	header("location: index.php");
	exit();	
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Cadastro de Usuário</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		
		<?php
            $conn = mysqli_connect('10.14.93.20', 'root', '123456', 'db_gabriel_leandro') or die ('Ocorreu um erro ao conectar com o banco de dados');
			// perfil
			$perfil = " SELECT * FROM tb_perfil ";
			$result_perfil = mysqli_query($conn, $perfil);
        ?>
		
    </head>

    <body>
        <div class="container mt-5 card-header">
            <h1 class="mb-5">Cadastro de Usuário</h1>
            <form action="acao/inserir.php" method="POST">
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="user">Usuário</label>
                            <input type="text" class="form-control" name="ds_usuario" id="ds_usuario">
                        </div>

                        <div class="form-group col-md-9">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" name="nm_usuario" id="nm_usuario" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="datanascimento">Data de Inclusão</label>
                            <input type="date" class="form-control" name="dt_inclusao" id="dt_inclusao" value="<?php echo date('Y-m-d') ?>" readonly>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="cpf">Ativo</label>
							   <select name="fl_ativo" class="form-control" >
									<option value="1">Ativo</option>
									<option value="0">Inativo</option>
								</select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="perfil">Perfil</label>
                            <select name="id_perfil" class="form-control" >
								<?php
								while($row_perfil = mysqli_fetch_assoc($result_perfil)){
									echo '<option value="'.$row_perfil['id_perfil'].'">'.$row_perfil['descricao'].'</option>';
								}
								?>
							</select>
                        </div>
                    </div>
                </div>
				
				<div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="user">Senha de acesso</label>
                            <input type="password" class="form-control" name="senha" id="senha" maxlength="15">
                        </div>
                    </div>
                </div>
				
                <button type="submit" class="btn btn-primary">Cadastrar</a>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>