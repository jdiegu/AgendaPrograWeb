<nav>
  <ul>

    <li><a href="inicio.php">Inicio</a></li>

    <?php
    if (isset($_SESSION["usuario"])) {
      if ($_SESSION["tipo"]=="admin") {
        echo '<li><a href="usuarios.php">Usuarios</a></li>';
      } else {
        echo '<li><a href="contactos.php">Contactos</a></li>';
      }
      echo '<li><a href="logout.php">Cerrar Sesion</a></li>';
    }
    ?>
  </ul>
</nav>