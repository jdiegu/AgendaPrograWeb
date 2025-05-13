<?php
/*
Archivo:  tabpersonal.php
Objetivo: consulta general sobre personal hospitalario y acceso a operaciones detalladas
Autor:
*/
include_once("models/Usuario.php");
session_start();
$sErr = "";
$sNom = "";
$oUsuario = null;

$oUsers = null;
$arrUsers = null;


/*Verificar que exista sesión*/
if (isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])) {
  $oUsuario = $_SESSION["usuario"];
  $sNom = $oUsuario->getNombre();
  $sClave = $oUsuario->getClave();

  try {
    $arrUsers = $oUsuario->buscarTodos();
  } catch (Exception $e) {
    //Enviar el error específico a la bitácora de php (dentro de php\logs\php_error_log
    error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
    $sErr = "Error en base de datos, comunicarse con el administrador";
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
    <h3>Contactos</h3>
    <form class="tabla" name="formTablaGral" method="post" action="crudUsuarios.php">
      <input type="hidden" name="txtClave">
      <input type="hidden" name="txtOpe">

      <?php if ($_SESSION["tipo"] == "admin"): ?>
        <input type="submit" name="Submit" value="Crear Nuevo" onClick="txtClave.value='<?php echo $sClave; ?>';txtOpe.value='a'">
      <?php endif; ?>

      <div class="tablaRes">

        <table border="1">
          <thead>
            <tr>
              <td>Clave</td>
              <td>Nombre</td>
              <td>Contrase&ntilde;a</td>
              <td>Tipo Usuario</td>
              <td>Operaci&oacute;n</td>

            </tr>
          </thead>
          <tbody>

            <?php
            if ($arrUsers != null) {
              foreach ($arrUsers as $oUsu) {
                ?>
                <tr>
                  <td class="llave"><?php echo $oUsu->getClave(); ?></td>
                  <td><?php echo $oUsu->getNombreCompleto(); ?></td>
                  <td><?php echo $oUsu->getPwd(); ?></td>
                  <td><?php echo $oUsu->getTipoUsuario(); ?></td>

                  <td>
                    <input type="submit" name="Submit" value="Modificar"
                      onClick="txtClave.value=<?php echo $oUsu->getClave(); ?>; txtOpe.value='m'">

                    <button type="button" onclick="popup( '¿Seguro que quiere eliminar este usuario?',
                'Nombre: <?php echo $oUsu->getNombreCompleto(); ?>',
                'Tipo Usuario: <?php echo $oUsu->getTipoUsuario(); ?>',
                'Contraseña: <?php echo $oUsu->getPwd(); ?>','', 'usuABC.php',
                <?php echo $oUsu->getClave(); ?>)">
                      Borrar
                    </button>
                  </td>


                </tr>
                <?php
              }//foreach
            } else {
              ?>
              <tr>
                <td colspan="2">No hay datos</td>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
      </div>

    </form>
  </main>

  <?php include_once("aside.html"); ?>
</div>


<script src="js/popup.js"></script>

<?php

if (isset($_REQUEST["msg"])) {
  $sMsg = $_REQUEST["msg"] ?? "";
  echo '<script>popupMsg("' . $sMsg . '")</script>';
}

include_once("pie.html");
?>