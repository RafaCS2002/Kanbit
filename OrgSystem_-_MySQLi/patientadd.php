<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Adicionar Paciente</title>
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
		session_start();
		include ('class/classControl.php');// incluindo a configuração
		$ctrl = new control();
		if(@$_POST['buttonadd_patient'] != ''){
			$patientadd = $ctrl->patientadd($_POST['nome_pati'],$_POST['sobrenome_pati'],$_POST['cpf_pati'],$_POST['email_pati'],$_POST['data_pati'],$_POST['enfermidade_pati'],$_POST['criticidade_pati'],$_POST['estado_pati']);
			
		}
		
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
            
			<form action="patientadd.php" method="post" name="patienteadd_form">
				<h2>Adicionar Paciente<small></small></h2>
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-4">
							<label class="txt logs">Nome</label></br>
							<input class="form-control" type="text" name="nome_pati" required/></br></br>
							<label class="txt logs">Sobrenome</label></br>
							<input class="form-control" type="text" name="sobrenome_pati" required/></br></br>
							<label class="txt logs" >Criticidade</label></br>
							<select class="form-control" name="criticidade_pati">
								<option value="leve"> Leve </option>
								<option value="moderado"> Moderado </option>
								<option value="critico"> Critico </option>
							</select></br></br>
						</div>
						<div class="col-md-4">
							<label class="txt logs">CPF</label></br>
							<input class="form-control cpf-mask" oninput="mascara(this)" type="text" placeholder="Ex.: 000.000.000-00" maxlength="11" autocomplete="off" data-mask="000.000.000-00" type="text" name="cpf_pati" required/></br></br>
							<label class="txt logs">Email</label></br>
							<input class="form-control" placeholder="Ex.: exemplo@gmail.com" type="email" name="email_pati" required/></br></br>
							<label class="txt logs">Estado</label></br>
							<select class="form-control" name="estado_pati">
								<option value="alta"> Alta </option>
								<option value="andamento" selected> Andamento </option>
							</select></br></br>
						</div>
						<div class="col-md-4">
							<label class="txt logs">Data</label></br>
							<input class="form-control" type="datetime-local" name="data_pati" required/></br></br>
							<label class="txt logs">Enfermidade</label></br>
							<input class="form-control" type="text" name="enfermidade_pati" required/></br></br>
						</div>
					</div>
				</div>

				
					<div class="container-fluid">
					<div class="row">
						<div class="col-md-4">
							<input class="btn btn-success" type="submit" value="Adicionar" name="buttonadd_patient"></br></br>
						</div>
						<div class="col-md-4">
							
						</div>
						<div class="col-md-4">
						
						</div>
					</div>
				</div>
			</form>
			
		</div>
    </div>
</body>
</html>