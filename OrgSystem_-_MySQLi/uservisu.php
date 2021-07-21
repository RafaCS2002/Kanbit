<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Buscar Funcionario </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/locastyle.css">
    <script src="js/locastyle.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function (){
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
    </script>
    <script defer src="js/solid.js"></script>
    <script defer src="js/fontawesome.js"></script>
	<?php
		include ('class/classControl.php');// incluindo a configuração
		session_start();
		$ctrl = new control();
		$totalpag = $ctrl->total();
		
	?>
</head>

<body>
	
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Bem-Vindo <?php echo $_SESSION['nome'];?></h3>
            </div>

            <ul class="list-unstyled components">
                <p><?php echo $_SESSION['cargo'];?></p>
				<li class="active">
					<a href="home.php">Home</a>
				</li>
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Paciente</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="patientvisu.php">Buscar</a>
                        </li>
                        <li>
                            <a href="patientadd.php">Adicionar</a>
                        </li>
						<li>
							<a href="patientalt.php">Alterar</a>
						</li>	
                    </ul>
                </li>
				
                <li>	
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Funcionários</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="uservisu.php">Buscar</a>
                        </li>
                        <li>
                            <a href="useradd.php">Adicionar</a>
                        </li>
						<li>
							<a href="useralt.php">Alterar</a>
						</li>
                    </ul>
                </li>
				
                <li>
                   <a href="contact.php">Contato</a>
                </li>
				
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
					<form action="home.php" method="post" name="logoutsession">
						<input class="btn btn-danger" style="width:100%;" type="submit" value="Logout" name="buttonlogout"/>
					</form>
					<?php //botão de logout
						if (@$_POST['buttonlogout'] == "Logout"){
							$_SESSION['codigo'] = '';
							$_SESSION['perfil'] = '';
							$_SESSION['email'] = '';
							$_SESSION['nome'] = '';
							$_SESSION['cargo'] = '';
							header("Location: index.php");
						}
					?>
                </li>
            </ul>
        </nav>

        <!-- Page Content Holder -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">A</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">B</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">C</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">D</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            
			<form action="uservisu.php" method="post" name="uservisu_form" id="uservisu_form">
				<h2>Buscar por informações de um funcionário </h2></br>
				<input type="text" placeholder="Nome do Funcionário" name="nome" style="height:38px;font-size:20px;"/>
				<input type="submit" class="btn btn-dark" name="buscar" value="Buscar"/>
			</form>
				<div class="line"></div>
				<div class="container-fluid">
					
					<?php
						$table = 'user';
						
						if(@$_POST['buscar'] != '' xor @$_GET['busca'] != null){
							
							?>
								<div class="row" style="border:2px solid #6d7fcc;border-radius:5px 5px 0px 0px;height:30px;">
									<div class="col-md-1" align="center" style="background:#6d7fcc;padding-top:5px;color:white;">Nome</div>
									<div class="col-md-2" align="center" style="background:#6d7fcc;padding-top:5px;border-left:2px solid white;color:white;">Sobrenome</div>
									<div class="col-md-2" align="center" style="background:#6d7fcc;padding-top:5px;border-left:2px solid white;color:white;">Login</div>
									
									<div class="col-md-2" align="center" style="background:#6d7fcc;padding-top:5px;border-left:2px solid white;color:white;">CPF</div>
									<div class="col-md-2" align="center" style="background:#6d7fcc;padding-top:5px;border-left:2px solid white;color:white;">Cargo</div>
									<div class="col-md-3" align="center" style="background:#6d7fcc;padding-top:5px;border-left:2px solid white;color:white;">Email</div>
								</div>
							<?php
							
							
							
							
							if(@$_GET['start'] != ''){
								$start = $_GET['start'];
								$busca = $_GET['busca'];
								if($busca == '0'){
									$busca = null;
								}
							}else{
								$start = 0;
								$busca = $_POST['nome'];
							}
							
								/*echo gettype($busca);
								echo '</br>';
								echo $busca;
								echo '</br>';*/
							
							
								
							$userList = $ctrl->paginacao($table,$start,$busca);
						
							while($rows = $userList->fetch_array(MYSQLI_ASSOC)){
								?>
									<div class="row" style="border-bottom:2px solid #6d7fcc;height:27px;">
										<div class="col-md-1" align="center" style="padding-top:5px;color:#6d7fcc;font-size:15px;"><?php echo $rows['nome'];?></div>
										<div class="col-md-2" align="center" style="padding-top:5px;border-left:2px solid #6d7fcc;color:#6d7fcc;font-size:15px;"><?php echo $rows['sobrenome'];?></div>
										<div class="col-md-2" align="center" style="padding-top:5px;border-left:2px solid #6d7fcc;color:#6d7fcc;font-size:15px;"><?php echo $rows['login'];?></div>
										
										<div class="col-md-2" align="center" style="padding-top:5px;border-left:2px solid #6d7fcc;color:#6d7fcc;font-size:15px;"><?php echo $rows['cpf'];?></div>
										<div class="col-md-2" align="center" style="padding-top:5px;border-left:2px solid #6d7fcc;color:#6d7fcc;font-size:15px;"><?php echo $rows['cargo'];?></div>
										<div class="col-md-3" align="center" style="padding-top:5px;border-left:2px solid #6d7fcc;color:#6d7fcc;font-size:13px;"><?php echo $rows['email'];?></div>
									</div>
								<?php
							}
						
							if($busca == null){
								$busca = "A";
							}
							
							?>
							</br>
							<input type="button" class="btn btn-light" value="Anterior" onclick="decStart(<?php echo $start?>,'<?php echo $busca?>')"/>
							<input type="button" class="btn btn-light" value="Próximo" onclick="addStart(<?php echo $start?>,<?php echo $totalpag?>,'<?php echo $busca?>')"/>
							<?php
							/*echo "";
							echo "";*/
						}else{
						}
						
						
					?>
				</div></br></br>
					<input type="hidden" id="pag" name="hiddenpag" value="1"/>
		</div>
    </div>
</body>
</html>