<?php
/*
Archivo:  conABC.php

Autor:
*/
include_once("models\Contacto.php");
session_start();

$sErr = "";
$sMsg = "";
$sOpe = "";
$sCve = "";
$oContacto = new Contacto();

/*Verificar que exista la sesión*/
if (isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])) {
	/*Verifica datos de captura mínimos*/
	if (
		isset($_POST["txtClave"]) && !empty($_POST["txtClave"]) &&
		isset($_POST["txtOpe"]) && !empty($_POST["txtOpe"])
	) {
		$sOpe = $_POST["txtOpe"];
		$sCve = $_POST["txtClave"];
		$oContacto->setId($sCve);

		if ($sOpe != "b") {
			$oContacto->setNombre($_POST["txtNombre"]);
			$oContacto->setApPaterno($_POST["txtApePat"]);
			$oContacto->setApMaterno($_POST["txtApeMat"]);
			$oContacto->setTelefono($_POST["txtNum"]);
			$oContacto->setDireccion($_POST["txtDir"]);
			$oContacto->setEmail($_POST["txtEmail"]);
		}
		try {
			if ($sOpe == 'a') {
				$nResultado = $oContacto->insertar($sCve);
				$sMsg = "Se inserto el contacto con exito";
			} else if ($sOpe == 'b') {
				$nResultado = $oContacto->borrar();
				$sMsg = "Se elimino el contacto con exito";
			} else {
				$nResultado = $oContacto->modificar();
				$sMsg = "Se modifico el contacto con exito";
			}
			if ($nResultado != 1) {
				$sError = "Error en bd";
			}
		} catch (Exception $e) {
			//Enviar el error específico a la bitácora de php (dentro de php\logs\php_error_log
			error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
			$sErr = "Error en base de datos, comunicarse con el administrador";
		}
	} else {
		$sErr = "Faltan datos";
		if (!isset($_POST["txtOpe"]) or empty($_POST["txtOpe"])) {
			$sErr = $sErr . " operacion ";
		}
		if (!isset($_POST["txtClave"]) or empty($_POST["txtClave"])) {
			$sErr = $sErr . " clave ";
		}
	}
} else
	$sErr = "Falta establecer el login";

if ($sErr == "")
	header("Location: contactos.php?msg=" . $sMsg);
else
	header("Location: contactos.php?msg=" . $sErr);
exit();
?>