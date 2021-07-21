<?php
	class connection{
		protected $mysqli;
		public function __construct(){
			$this->mysqli = new mysqli('localhost','root','usbw','orgsystem');
		}	
		function qntPatient(){
			$sql = "SELECT COUNT(*) FROM patient";
			$resultado = $this->mysqli->query($sql);
			$qnt = $resultado->fetch_array();
			echo '[{"quantidade":',$qnt[0],'}]';
		}
		
		function updateEstado($inf,$id){
			date_default_timezone_set('America/Sao_Paulo');
			$date = date("Y-m-d H:i:s");
			$sql = "UPDATE patient SET estado='$inf' WHERE ID=$id";
			if($this->mysqli->query($sql)){
				echo "Atualizou";
			}else{
				echo "Não Atualizou";
			}
		}
		
		function selectPatient($idIni){
			
			$sql = "SELECT id,sobrenome FROM patient WHERE id = $idIni";
			$people = $this->mysqli->query($sql);
			$i = 0;
			while($rows = $people->fetch_array(MYSQLI_BOTH)){
				$id[$i] = $rows['id'];
				$sobrenome[$i] =  $rows['sobrenome'];
				$i++;
			}
			echo '[';
			for($j=0;$j<10;$j++){
				if(@$id[$j]==null){
					break;
				}
				if($j!=0){
					echo ',';
				}
				echo '{"id":',$id[$j],',';
				echo '"sobrenome":"',$sobrenome[$j],'"}';
			}
			echo ']';
		}
		
	}
	
?>