<?php
/*
Archivo:  abcPersHosp.php
Objetivo: edición sobre Personal Hospitalario
Autor:
*/
include_once("models\Usuario.php");
session_start();

$sErr = "";
$sOpe = "";
$sCve = "";
$sNomBoton = "Borrar";
$oUsuario = new Usuario();
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
      $oUsuario->setClave($sCve);

      try {
        if (!$oUsuario->buscar()) {
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
    $sErr = "Faltan datos";
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
    <form name="abcPH" action="usuABC.php" method="post">
      <input type="hidden" name="txtOpe" value="<?php echo $sOpe; ?>">
      <input type="hidden" name="txtClave" value="<?php echo $sCve; ?>" />

      <label>Nombre : </label>
      <input type="text" name="txtNombre" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
        value="<?php echo $oUsuario->getNombre(); ?>" />

      <label>Apellido Paterno : </label>
      <input type="text" name="txtApePat" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
        value="<?php echo $oUsuario->getApPaterno(); ?>" />

      <label>Apellido Materno: </label>
      <input type="text" name="txtApeMat" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
        value="<?php echo $oUsuario->getApMaterno(); ?>" />

      <label>Tipo usuario: </label>
      <select name="txtTU" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>>
        <option value=0 <?php echo ($oUsuario->getTipoUsuarioNumero() == 0 ? 'selected' : ''); ?>>Elija una opcion
        </option>
        <option value=1 <?php echo ($oUsuario->getTipoUsuarioNumero() == 1 ? 'selected' : ''); ?>>Administrador</option>
        <option value=2 <?php echo ($oUsuario->getTipoUsuarioNumero() == 2 ? 'selected' : ''); ?>>Visualizador</option>
      </select>

      </select>

      <label>Contrase&ntilde;a : </label>
      <input type="text" name="txtPwd" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
        value="<?php echo $oUsuario->getPwd(); ?>" />


      <input type="submit" value="<?php echo $sNomBoton; ?>"
        onClick="return evalua2(txtNombre, txtApePat,txtApeMat, txtPwd, txtTU );" />

      <input type="submit" name="Submit" value="Cancelar" onClick="abcPH.action='usuarios.php';">
    </form>
  </main>

  <?php include_once("aside.html") ?>

</div>

<?php
include_once("pie.html");
?>