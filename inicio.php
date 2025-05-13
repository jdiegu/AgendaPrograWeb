<?php
/*************************************************************/
/* Archivo:  inicio.php
 * Objetivo: p�gina de sesi�n iniciada
 * Autor:  BAOZ
 *************************************************************/
include_once("models\Usuario.php");
session_start();
$sErr = "";
$sNom = "";
$sTipo = "";
$oUsu = new Usuario();


if (isset($_SESSION["usuario"])) {
  $oUsu = $_SESSION["usuario"];
  $sNom = $oUsu->getNombreCompleto();
  $sTipo = $_SESSION["tipo"];
} else
  $sErr = "Debe estar firmado";

if ($sErr == "") {
  include_once("cabecera.html");
  include_once("menu.php");
} else {
  header("Location: error.php?sErr=" . $sErr);
  exit();
}
?>
<div class="layout">
<main>
  <h1>Bienvenido <?php echo $sNom; ?></h1>
  <h3>Eres tipo <?php echo $sTipo; ?></h3>
</main>
<?php include_once("aside.html"); ?>
</div>

<?php
include_once("pie.html");
?>