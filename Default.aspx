<?php
// Define una variable para que index.php sepa que venimos desde Default.aspx
$viene_de_aspx = true;

// Carga el contenido de index.php sin cambiar la URL en el navegador
include_once('index.php');
exit();
?>
