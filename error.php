<?php
/*************************************************************/
/* Archivo:  error.php
 * Objetivo: manejo de errores
 * Autor: BAOZ
 *************************************************************/
include_once("cabecera.html");
include_once("menu.php");
session_start();
?>

<div class="layout">
<main>
	<h1>Error</h1>
	<h4><?php echo ((isset($_REQUEST["sError"])) ? $_REQUEST["sError"] : "Otro error"); ?></h4>
	<?php
	if (isset($_SESSION["usuario"])) {
		?>
		<a href="inicio.php">Regresar al inicio</a>
		<?php
	} else {
		?>
		<a href="index.php">Regresar al inicio</a>
		<?php
	}
	?>
</main>

<?php include_once("aside.html") ?>

</div>
<?php
include_once("pie.html");
?>