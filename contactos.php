<?php
/*
Archivo:  tabpersonal.php
Objetivo: consulta general sobre personal hospitalario y acceso a operaciones detalladas
Autor:
*/
include_once("models/Usuario.php");
include_once("models/Contacto.php");
session_start();
$sErr = "";
$sNom = "";
$oUsu = null;

$arrContactos = null;
$oCon = new Contacto();

/*Verificar que exista sesión*/
if (isset($_SESSION["usuario"]) && !empty($_SESSION["usuario"])) {
  $oUsu = $_SESSION["usuario"];
  $sNom = $oUsu->getNombre();
  $sClave = $oUsu->getClave();

  if (isset($_POST["clave"]) && !empty($_GET["clave"])) {
    $sClave = $_GET["clave"];
  }

  try {
    $arrContactos = $oCon->buscarTodos($sClave);
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
    <form class="tabla" name="formTablaGral" method="post" action="crudContactos.php">
      <input type="hidden" name="txtClave">
      <input type="hidden" name="txtOpe">

      <input type="submit" name="Submit" value="Crear Nuevo"
        onClick="txtClave.value='<?php echo $sClave; ?>';txtOpe.value='a'">


      <div class="tablaRes">

        <table border="1">
          <thead>
            <tr>
              <td>Clave</td>
              <td>Nombre</td>
              <td>Numero</td>
              <td>Direccion</td>
              <td>email</td>
              <td>Operaci&oacute;n</td>

            </tr>
          </thead>
          <tbody>

            <?php
            if ($arrContactos != null) {
              foreach ($arrContactos as $oContacto) {
                ?>
                <tr>
                  <td class="llave"><?php echo $oContacto->getId(); ?></td>
                  <td><?php echo $oContacto->getNombre(); ?></td>
                  <td><?php echo $oContacto->getTelefono(); ?></td>
                  <td><?php echo $oContacto->getDireccion(); ?></td>
                  <td><?php echo $oContacto->getEmail(); ?></td>



                  <td>
                    <input type="submit" name="Submit" value="Modificar"
                      onClick="txtClave.value=<?php echo $oContacto->getId(); ?>; txtOpe.value='m'">

                    <button type="button" onclick="popup( '¿Seguro que quiere eliminar este contacto?',
                'Nombre: <?php echo $oContacto->getNombre(); ?>',
                'Telefono: <?php echo $oContacto->getTelefono(); ?>',
                'Direccion: <?php echo $oContacto->getDireccion(); ?>',
                'Email: <?php echo $oContacto->getEmail(); ?>', 'conABC.php',
                <?php echo $oContacto->getId(); ?>)">
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
<!-- #region <script> popupMsg("si")</script>-->

<?php
include_once("pie.html");

if (isset($_REQUEST["msg"])) {
  $sMsg = $_REQUEST["msg"] ?? "";
  echo '<script>popupMsg("' . $sMsg . '")</script>';
}

?>