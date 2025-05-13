<?php
/*
Archivo:  conABC.php

Autor:
*/
include_once("models/Usuario.php");
session_start();

$sErr=""; $sOpe = ""; $sCve = "";
$oUsuario = new Usuario();

	/*Verificar que exista la sesión*/
	if (isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])){
		/*Verifica datos de captura mínimos*/
		if (isset($_POST["txtClave"]) && !empty($_POST["txtClave"]) &&
			isset($_POST["txtOpe"]) && !empty($_POST["txtOpe"])){
			$sOpe = $_POST["txtOpe"];
			$sCve = $_POST["txtClave"];
			$oUsuario->setClave($sCve);

			if ($sOpe != "b"){
				$oUsuario->setNombre($_POST["txtNombre"]);
				$oUsuario->setApPaterno($_POST["txtApePat"]);
				$oUsuario->setApMaterno($_POST["txtApeMat"]);
        $oUsuario->setPwd($_POST["txtPwd"]);
        $oUsuario->setTipoUsuario($_POST["txtTU"]);
			}
			try{
				if ($sOpe == 'a')
					$nResultado = $oUsuario->insertar();
				else if ($sOpe == 'b')
					$nResultado = $oUsuario->borrar();
				else
					$nResultado = $oUsuario->modificar();

				if ($nResultado != 1){
					$sError = "Error en bd";
				}
			}catch(Exception $e){
				//Enviar el error específico a la bitácora de php (dentro de php\logs\php_error_log
				error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
				$sErr = "Error en base de datos, comunicarse con el administrador";
			}
		}
		else{
			$sErr = "Faltan datos";
		}
	}
	else
		$sErr = "Falta establecer el login";

	if ($sErr == "")
		header("Location: usuarios.php");
	else
		header("Location: error.php?sError=".$sErr);
	exit();
?>