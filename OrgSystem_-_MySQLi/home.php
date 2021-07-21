<?php	
	session_start();
	include ('config.php');
		//php do grafico1
		$select = "SELECT * FROM patient";
		$query = $mysqli->query($select);
		
		$cont_alta = 0;
		$cont_andament = 0;
		while($result = $query->fetch_assoc()){
			
			if($result['estado'] == 'alta'){
				$cont_alta ++;
			}else if($result['estado'] == 'andamento'){
				$cont_andament ++;
			}
		}
		//fim
		//php do grafico2
		
			/*Usar a formula do TMP(tempo medio de permanencia)
			(n° pacientes-dia no periodo de um mes)/(n° de saidas no periodode um mes)
			*/
			
			
			// query alta
			$sql1 = "SELECT month(data) as mes,COUNT(*) as total 
			  FROM patient  
			  WHERE estado = 'alta' and year(data) = '2020' group by month(data)";
			$query_1 = $mysqli->query($sql1);	
			while($assoc1 = $query_1->fetch_assoc()){
			$grafico1[$assoc1['mes']] = $assoc1['total'];
			}		  

			// query andamento
			$sql2 = "SELECT month(data) as mes,COUNT(*) as total 
			  FROM patient  
			  WHERE estado = 'andamento' and year(data) = '2020' group by month(data)";
				
			$query_2 = $mysqli->query($sql2);			  
			while($assoc2 = $query_2->fetch_assoc()){
	
			$grafico2[$assoc2['mes']] = $assoc2['total']/ $grafico1[$assoc2['mes']];
			}	
			$tmp = $grafico2;
			
		
		
		//fim
		//php do grafico3
		
		$cont_july = 0;
		$cont_august = 0;
		$cont_september = 0;
		$cont_october = 0;
		$mes = "SELECT MONTH(data) FROM patient"; // mes de agosto
		$query_mes = $mysqli->query($mes);
	
		while($result_mes = $query_mes->fetch_assoc()){
			if($result_mes['MONTH(data)'] == '7'){
				$cont_july ++;
				}else if($result_mes['MONTH(data)'] == '8'){
				$cont_august ++;
				}else if($result_mes['MONTH(data)'] == '9'){
				$cont_september ++;
				}else if($result_mes['MONTH(data)'] == '10'){
				$cont_october ++;
				}else{
			}
		}
		// fim
			
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>KanBit - Home</title>
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
	<!-- codigo do grafico 1-->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([ // aqui e´ onde coloca os dados para aparecer no grafico
          ['Situação', 'Quantidade'],
          ['Concluido',<?php echo $cont_alta; ?>],
          ['Em andamento',<?php echo $cont_andament; ?>],
         
        ]);

        var options = {
          title: 'Casos concluidos', //titulo do grafico
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
	<!-- fim ======= -->
	<!-- codigo do grafico 2-->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([ // dados do grafico
          ['Mês', 'Média'],
          ['Jan',  0],
          ['Fev',  0],
          ['Mar',  0],
          ['Abr',  0],
		  ['Mai', 0],
		  ['Jun', 0],
		  ['Jul', 0],
		  ['Ago',<?php echo $tmp[8]?>],
		  ['Set', 0],
		  ['Out', 0],
		  ['Nov', 0],
		  ['Dez', 0]
		  
        ]);

        var options = {
          title: 'Média por mês', //titulo
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
	<!-- fim ======= -->
	<!-- codigo do grafico 3-->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([ // dados grafico
          ['Mês', 'Quantidade'],//descrição das semanas / quantidade -> aparece quando o mouse fica em cima de uma barra
          ["Julho", <?php echo $cont_july; ?>],
          ["Agosto", <?php echo $cont_august; ?>],
          ["Setembro",<?php echo $cont_september; ?>],
          ["Outubro",<?php echo $cont_october; ?>],
          
        ]);

        var options = { 
          title: 'Entradas por mês',// titulo
          width: 900,
          legend: { position: 'none' },
          chart: { title: 'Cada barra = 1 mês'//subtitulo
                  },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Quantidade'} // descrição dos numeros 
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>

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
					<a href="#">Home</a>
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
					<?php
						if (@$_POST['buttonlogout'] == "Logout"){
							
							header('Location: index.php');
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
            
            <h2>Casos concluidos (Alta)</h2><!-- grafico 1 -->
				<div id="donutchart" style="width: 800px; height: 300px;"></div> <!-- div para chamar o grafico 1-->

            <div class="line"></div>

             <h2>Média de permanência</h2> 
			 <div id="curve_chart" style="width: 800px; height: 400px"></div> <!-- div que chama o grafico 2-->
			
            <div class="line"></div>

            <h2>Entradas por semana</h2>
			  <div id="top_x_div" style="width: 800px; height: 400px;"></div> <!-- div para chamar o grafico 3-->
			
		</div>
    </div>
</body>

</html>