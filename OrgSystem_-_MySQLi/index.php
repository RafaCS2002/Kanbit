<?php
	require('class/classControl.php');

	if(@$_POST['loginButton'] != ''){
		
		$senha = hash('SHA256',$_POST['senha']);
		$ctrl = new control();
		$resultado = $ctrl -> userData($_POST['login']);
		
		if($resultado->num_rows == 1){
			$dados = $resultado->fetch_array(MYSQLI_ASSOC);
			
			if($dados['access'] == 'enable'){
				$login = $ctrl->login($dados,$senha);
			}else{
				?>
					<script language="javascript" type="text/javascript">
						alert('Seu Login está desabilitado, entre em contato com o suporte.');
					</script>
				<?php
			}
		}else{
			?>
				<script language="javascript" type="text/javascript">
					alert('Não existe no Sistema');
				</script>
			<?php
		}
		
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/styleindex.css" rel="stylesheet"/>
		<title>KanBit - Login</title>
	</head>

	<body>
		<div class="box log">
			<form  method="POST" name="formlogin">
				<div class="form-group">
					<div class="box head">
						<a class="txt titlelog">KanBit</a></br>
					</div>
					<div class="box body">
						<label class="txt logs">Login</label>
						</br>
						<input class="form-control" style="margin-top:4px;width:190px;" type="text" name="login"/>
						</br></br>
						<label class="txt logs">Senha</label>
						</br>
						<input class="form-control" style="margin-top:4px;width:190px;" type="password" name="senha"/>
						</br></br>
						<input class="txt" style="margin-left:65px;font-weight:bold;" type="submit" value="Entrar" name="loginButton"/>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>


