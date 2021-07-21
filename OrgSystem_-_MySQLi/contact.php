<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Contact</title>
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
		include('class/classControl.php');
		$ctrl = new control();
		if(@$_POST['button_enviar'] !=''){
			$contact = $ctrl->contact($_POST['nome'],$_POST['sobrenome'],$_POST['email'],$_POST['mensagem']);
				
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
							$senha = '';
							$_SESSION['senha'] = '';
							$login = '';
							$_SESSION['login'] = '';
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
            
			<form action="contact.php" method="post" name="contact_form">
				<h2>Contato <small></small></h2>
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-4">
							<label class="txt logs">Nome</label></br>
							<input class="form-control" type="text" name="nome" required/></br></br>
							<label class="txt logs">Sobrenome</label></br>
							<input class="form-control" type="text" name="sobrenome" required/></br></br>
							<input class="btn btn-success" type="submit" value="Enviar" name="button_enviar"></br></br>
						</div>
						<div class="col-md-4">
							<label class="txt logs">Email</label></br>
							<input class="form-control" placeholder="Ex.: exemplo@gmail.com" type="email" name="email" required/></br></br>
							<label class="txt logs">Mensagem</label></br>
							<textarea class="form-control" cols="41" rows="7" type="text" name="mensagem"></textarea></br></br>
						</div>
					</form>
						<div class="col-md-4">
							<label class="txt logs">Onde estamos</label></br>
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3602.6864682423247!2d-49.25185058530678!3d-25.448743639864915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94dce4fa6efc33fb%3A0xf59b7a692eb85a0a!2sTECPUC!5e0!3m2!1spt-BR!2sbr!4v1586806516569!5m2!1spt-BR!2sbr" 
							width="326" height="286" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
						</div>
					</div>

				</div>
				
					<div class="row">
						<div class="col-md-12">
							<hr>
							</hr>
							<center><b>Telefone:</b> 0000-0000 | <b>Endereço:</b> R. Imac. Conceição, 1155 - Prado Velho, Curitiba - PR, 80215-901 | <b>Email:</b> kanbitcorp@gmail.com</center>
						</div>
						
					</div>
				</div>
				
		
			
		</div>
    </div>
</body>
</html>