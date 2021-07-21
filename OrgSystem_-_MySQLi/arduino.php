<?php
	include('class/classConnection.php');
	
	$con = new connection();
	if(@$_GET["qnt"] != null){
		$qnt = $con->qntPatient();
	}
	
	if(@$_GET["upd"] != null){
		$upd = $_GET["upd"];
		$id = $_GET["id"];
		$update = $con->updateEstado($upd,$id);
	}
	
	if(@$_GET["idIni"] != null){
		$qnt = $_GET["idIni"];
		$select = $con->selectPatient($qnt);
	}
	
	
?>