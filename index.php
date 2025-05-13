<?php include "cabecera.html" ?>
<?php include "menu.php" ?>

<div class="layout">
<main>

  <form id="formulario" method="post" action="login.php">
    <label>Clave: </label>
    <input type="text" name="clave" required="true" />
    <label>Contrase&ntilde;a: </label>
    <input type="password" name="contrasena" required="true" />
    <input type="submit" value="Enviar" />
  </form>

</main>

<?php include_once("aside.html") ?>

</div>

<?php include "pie.html" ?>