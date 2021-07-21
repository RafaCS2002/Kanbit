<?php
	class control{
		protected $mysqli;
			
			public function __construct(){
				$this->mysqli = new mysqli('localhost','root','usbw','orgsystem');
				
			}
			
			function login($dados,$senha){
				
				date_default_timezone_set('America/Sao_Paulo');
				
				if($dados['senha'] == $senha){//SENHA CORRETA
						
						session_start();
						$_SESSION['codigo'] = $dados['ID'];
						//$_SESSION['perfil'] = $dados['perfil_idperfil'];
						$_SESSION['email'] = $dados['email'];
						$_SESSION['nome'] = $dados['nome'];
						$_SESSION['cargo'] = $dados['cargo'];
						
						// DELETAR LOGS ANTERIORES CASO O LOGIN TENHA SIDO EFETUADO
						$id = $dados['ID'];
						$sql_deletar = "DELETE FROM log WHERE userID='$id'";
						$deletar = $this->mysqli->query($sql_deletar);
						
						
						header("Location: home.php");
					
					
				}else{//SENHA INCORRETA
					$id = $dados['ID'];
					$sql_log = "SELECT * FROM log WHERE userID = '$id'";
					$resultado = $this->mysqli->query($sql_log);
					
						if($resultado->num_rows == 3){// TEM 3 LOGS
							//CONFIGURA O LOGIN COMO DESABILITADO
							$sql_blocked = "UPDATE user SET access='disable' WHERE ID='$id'";
							$blocked = $this->mysqli->query($sql_blocked);
							//DELETAR LOGS CASO O LOGIN SEJA BLOQUEADO
							$sql_deletar = "DELETE FROM log WHERE userID='$id'";
							$deletar = $this->mysqli->query($sql_deletar);
							
							?>
								<script language="javascript" type="text/javascript">
									alert('Seu login foi bloqueado');
								</script>
							<?php
							
						}else{// MENOS DE 3 LOGS
							//CAPTURA AS INFORMAÇÕES DO MOMENTO DO LOGIN E ATUALIZA NA TABELA LOG
							$date = date("Y-m-d H:i:s");
							$sql_insertError = "INSERT INTO log (datahora, userID) values('$date', '$id')";
							$inserir = $this->mysqli->query($sql_insertError);
						
							?>
								<script language="javascript" type="text/javascript">
									alert('Senha Incorreta');
								</script>
							<?php
						}
				}
				
			}
			
			function userData($login){
				$sql = "SELECT * FROM user WHERE login = '$login'";
				$resultado = $this->mysqli->query($sql);
				return $resultado;
			}
			
			function userAdd($nome, $sobrenome, $cpf, $access, $senha, $cargo, $email){
				if($nome != null){
					$login = $sobrenome.".".$nome;
					$senhaCrypted = hash('SHA256',$senha);
					$sql_insertFunc = "INSERT INTO user (NOME,SOBRENOME,LOGIN,ACCESS,CPF,SENHA,CARGO,EMAIL) VALUES('$nome', '$sobrenome', '$login', '$access', '$cpf', '$senhaCrypted', '$cargo', '$email')";
					
					if ($this->mysqli->query($sql_insertFunc)){
						?>
							<script language="javascript" type="text/javascript">
								alert('Cadastrado com Sucesso');
							</script>
						<?php
					}else{
						?>
							<script language="javascript" type="text/javascript">
								alert('Ocorreu algum erro');
							</script>
						<?php
					}
				}else{
					return;
				}
			}
			
			function patientadd($nome, $sobrenome, $cpf, $email, $data, $enfermidade, $criticidade, $estado){
				if($nome != null){
					
					$sql_insertpatient = "INSERT INTO patient (NOME,SOBRENOME,CPF,EMAIL,DATA,ENFERMIDADE,CRITICIDADE,ESTADO) VALUES('$nome', '$sobrenome', '$cpf', '$email', '$data', '$enfermidade', '$criticidade', '$estado' )";
					
					if ($this->mysqli->query($sql_insertpatient)){
						?>
							<script language="javascript" type="text/javascript">
								alert('Cadastrado com Sucesso');
							</script>
						<?php
					}else{
						?>
							<script language="javascript" type="text/javascript">
								alert('Ocorreu algum erro');
							</script>
						<?php
					}
				}else{
					return;
				}
			}
			
			
			function paginacao($table,$indice,$search,$o = null){
				
				// get total
				// $t = table
				// $i = numero da pagina
				// $o = campo para ordenação
				// $s = condições da query

				$msgs='';
				$sql = "select * from $table ";
				if($search != 0 xor $search != null){ $sql .= " where nome like '".$search."%' ";}
				if($o != null){$sql .= ' order by '.$o.' ';}
				if($indice != null){
				   
					if($indice <> 0){
						
					 //$indice = $indice + 1; // inicio dos registros mais 1
						$sql .= " limit $indice,10 ";
					}else{
						$sql .= ' limit 0, 10';
					}
				}else{
					$sql .= ' limit 0, 10';
				}
				 $query = $this->mysqli->query($sql);
				 
				   return $query;


			}
			
			function updateSelectUser($id){
				if ($id != ''){
					$sql_request = "SELECT * FROM user WHERE ID LIKE '$id'";
					$dados = $this ->mysqli->query($sql_request);
					return $dados;
				}else{
					echo "Something is wrong";
					echo $id;
				}
			}
			
			function updateUser($id,$nom,$sob,$log,$acc,$accAnt,$pass,$cpf,$carg,$email){
				$sql = "UPDATE user SET";
				if($acc != ""){$sql .= " access='$acc'";}
				if($nom != ""){$sql .= ",nome='$nom'";}
				if($sob != ""){$sql .= ",sobrenome='$sob'";}
				if($log != ""){$sql .= ",login='$log'";}
				if($pass != ""){
					$passCrypted = hash('SHA256',$pass);
					$sql .= ",senha='$passCrypted'";
				}
				if($cpf != ""){$sql .= ",cpf='$cpf'";}
				if($carg != ""){$sql .= ",cargo='$carg'";}
				if($email != ""){$sql .= ",email='$email'";}
				$sql .= " WHERE ID='$id'";
				
				if($uptodate = $this ->mysqli->query($sql)){
					?>
						<script>
							alert("Atualizado com sucesso");
						</script>
					<?php
				}else{
					?>
						<script>
							alert("Erro, não foi possível atualizar");
						</script>
					<?php
				}
			}
			
			function updateSelectpatient($id){
				if ($id != ''){
					$sql_request = "SELECT * FROM patient WHERE id LIKE '$id'";
					$dados = $this ->mysqli->query($sql_request);
					return $dados;
				}else{
					echo "Something is wrong";
					echo $id;
				}
			}
			
			function updatepatient($id,$nom,$sob,$cpf,$email,$enfermidade,$criticidade,$estado){
				$sql = "UPDATE patient SET";
				if($estado != ""){$sql .= " estado='$estado'";}
				if($nom != ""){$sql .= " ,nome='$nom'";}
				if($sob != ""){$sql .= ",sobrenome='$sob'";}
				if($cpf != ""){$sql .= ",cpf='$cpf'";}
				if($email != ""){$sql .= ",email='$email'";}
				if($enfermidade != ""){$sql .= ",enfermidade='$enfermidade'";}
				if($criticidade != ""){$sql .= ",criticidade='$criticidade'";}
				$sql .= " WHERE id='$id'";
				
				if($uptodate = $this ->mysqli->query($sql)){
					?>
						<script>
							alert("Atualizado com sucesso");
						</script>
					<?php
				}else{
					?>
						<script>
							alert("Erro! Não foi possível realizar a ação.");
						</script>
					<?php
				}
			}
			
			function deleteUser($id){
				$sql = "DELETE FROM user WHERE ID='$id'";
				if($deletar = $this->mysqli->query($sql)){
					?>
						<script>
							alert("Deletado com sucesso");
						</script>
					<?php
				}else{
					?>
						<script>
							alert("Erro! Não foi possível realizar a ação.");
						</script>
					<?php
				}
			}
			
			function total(){
				$sql = "SELECT COUNT(*) FROM user";
				$resultado = $this->mysqli->query($sql);
				$val = $resultado->fetch_array();
				$tent=0;
				$bas10=0;
				$maxBas10 = $val[0]/10;
				$maxBas10 = (int)$maxBas10;
				while($tent != $maxBas10){
					$tent++;
				}
				return $tent;
			}
			
			function contact($nome, $sobrenome, $email,$mensagem){
				if($nome != null){
	
					$sql_contact = "INSERT INTO contact (NOME,SOBRENOME,EMAIL,MENSAGEM) VALUES('$nome','$sobrenome','$email','$mensagem')";
					
					if ($this->mysqli->query($sql_contact)){
						?>
							<script language="javascript" type="text/javascript">
								alert('Mensagem enviada com Sucesso');
							</script>
						<?php
					}else{
						?>
							<script language="javascript" type="text/javascript">
								alert('Ocorreu algum erro');
							</script>
						<?php
					}
				}else{
					return;
				}
			}
			
			function logout(){
				session_destroy();
				header("Location:/index.php");
			}
			
			
	}
?>