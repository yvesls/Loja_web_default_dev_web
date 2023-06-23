<?php
require_once 'includes/cabecalho.inc.php';
session_start();
$cliente = $_SESSION["cliente"];
$total = $_SESSION["total"];
$carrinho = $_SESSION["carrinho"];
?>

<center>
    <h1>Dados da compra</h1>
    <br>

</center>
<?php
require_once 'includes/rodape.inc.php';
?>