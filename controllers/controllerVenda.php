<?php
require_once '../dao/VendaDAO.inc.php';
require_once '../classes/Venda.inc.php';
require_once '../classes/Cliente.inc.php';

$opcao = $_REQUEST['opcao'];

if($opcao == "incluirVenda") { 
    $metodoPagamento = $_REQUEST["metodoPagamento"];
 
    session_start();

    $cliente = $_SESSION["cliente"];
    $total = $_SESSION["total"];
    $carrinho = $_SESSION["carrinho"];

    $venda = new Venda($cliente->getCpf(), $total);

    $vendaDAO = new VendaDAO();
    $vendaDAO->incluirVenda($venda, $carrinho);

    if($metodoPagamento == "boleto") {
        echo "Emitir o boleto bancário";
        header("Location: ../views/boleto/meuBoleto.php");
    } else if ($metodoPagamento == "cartao") {
        echo "dados cartao";
    }

    unset($_SESSION["carrinho"]);
}

?>