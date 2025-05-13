<?php
/*
Archivo:  abcPersHosp.php
Objetivo: edición sobre Personal Hospitalario
Autor:
*/
include_once("models\Contacto.php");
session_start();

$sErr = "";
$sOpe = "";
$sCve = "";
$sNomBoton = "Borrar";
$oContacto = new Contacto();
$bCampoEditable = false;
$bLlaveEditable = false;

/*Verificar que haya sesión*/
if (isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])) {
  /*Verificar datos de captura*/
  if (
    isset($_POST["txtClave"]) && !empty($_POST["txtClave"]) &&
    isset($_POST["txtOpe"]) && !empty($_POST["txtOpe"])
  ) {
    $sOpe = $_POST["txtOpe"];
    $sCve = $_POST["txtClave"];

    if ($sOpe != 'a') {
      $oContacto->setId($sCve);
      try {
        if (!$oContacto->buscar()) {
          $sError = "Contacto no existe";
        }
      } catch (Exception $e) {
        error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
        $sErr = "Error en base de datos, comunicarse con el administrador";
      }
    }
    if ($sOpe == 'a') {
      $bCampoEditable = true;
      $bLlaveEditable = true;
      $sNomBoton = "Agregar";
    } else if ($sOpe == 'm') {
      $bCampoEditable = true; //la llave no es editable por omisión
      $sNomBoton = "Modificar";
    }
    //Si fue borrado, nada es editable y es el valor por omisión
  } else {
    $sErr = "Faltan datos crudContacto";
    if (!isset($_POST["txtOpe"]) or empty($_POST["txtOpe"])) {
      $sErr = $sErr . " operacion ";
    }
    if (!isset($_POST["txtClave"]) or empty($_POST["txtClave"])) {
      $sErr = $sErr . " clave ";
    }
  }
} else
  $sErr = "Falta establecer el login";

if ($sErr == "") {
  include_once("cabecera.html");
  include_once("menu.php");
} else {
  header("Location: error.php?sError=" . $sErr);
  exit();
}
?>
<div class="layout">
  <main>
    <form name="abcPH" action="conABC.php" method="post">
      <input type="hidden" name="txtOpe" value="<?php echo $sOpe; ?>">
      <input type="hidden" name="txtClave" value="<?php echo $sCve; ?>" />

      <label>Nombre : </label>
      <input type="text" name="txtNombre" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
        value="<?php echo $oContacto->getNombreSolo(); ?>" />

      <label>Apellido Paterno : </label>
      <input type="text" name="txtApePat" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
        value="<?php echo $oContacto->getApPaterno(); ?>" />

      <label>Apellido Materno: </label>
      <input type="text" name="txtApeMat" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
        value="<?php echo $oContacto->getApMaterno(); ?>" />

      <label>Numero : </label>
      <input type="text" name="txtNum" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
        value="<?php echo $oContacto->getTelefono(); ?>" />

      <label>Direccion : </label>
      <input type="text" name="txtDir" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
        value="<?php echo $oContacto->getDireccion(); ?>" />

      <label>Email : </label>
      <input type="text" name="txtEmail" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
        value="<?php echo $oContacto->getEmail(); ?>" />


      <input type="submit" value="<?php echo $sNomBoton; ?>"
        onClick="return evalua(txtNombre, txtApePat,txtApeMat, txtNum, txtDir,txtEmail );" />

      <input type="submit" name="Submit" value="Cancelar" onClick="abcPH.action='contactos.php';">
    </form>
  </main>

  <?php include_once("aside.html") ?>

</div>

<?php
include_once("pie.html");
?>