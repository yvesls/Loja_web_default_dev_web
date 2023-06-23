<?php
require_once 'includes/cabecalho.inc.php';
require_once '../classes/Item.inc.php';
session_start();
$soma = 0;
$i = 1;
if (isset($_SESSION["carrinho"]) && sizeof($_SESSION["carrinho"]) != 0) { // passar a verificação para a controller
     $carrinho = $_SESSION["carrinho"];
     // Realizar o percurso no vetor de carrinho e colocar as informações em cada linha <tr>

?>

     <center>
          <h2>
               <font face="Arial">Carrinho de Compra</font>
          </h2>
          <p>

          <table border="0" cellspacing="2" width="60%">
               <tr bgcolor="#000098" align="center">

                    <th>
                         <font face="Verdana" size="2" color="#FFFFFF">
                              <font face="Verdana" size="2">Item No</font>
                    </th>
                    <th>
                         <font face="Verdana" size="2" color="#FFFFFF">Ref.</font>
                    </th>
                    <th>
                         <font face="Verdana" size="2" color="#FFFFFF">Nome</font>
                    </th>
                    <th>
                         <font face="Verdana" size="2" color="#FFFFFF">Fabricante</font>
                    </th>
                    <th>
                         <font face="Verdana" size="2" color="#FFFFFF">Quantidade</font>
                    </th>
                    <th>
                         <font face="Verdana" size="2" color="#FFFFFF">Valor produto</font>
                    </th>
                    <th>
                         <font face="Verdana" size="2" color="#FFFFFF">Total produto</font>
                    </th>
                    <th bgcolor="#FFFFFF">
                         <font face="Verdana" size="2" color="#000000">Remover</font>
                    </th>
               </tr>
               <?php

               // --- FOREACH INICIA AQUI
               foreach ($carrinho as $item) {
               ?>
                    <tr align="center">
                         <td>
                              <font face="Verdana" size="2"><?= $i++ ?></font>
                         </td>
                         <td>
                              <font face="Verdana" size="2"><?= $item->getProduto()->getProdutoId() ?> </font>
                         </td>
                         <td>
                              <font face="Verdana" size="2"><?= $item->getProduto()->getNome() ?></font>
                         </td>
                         <td>
                              <font face="Verdana" size="2"><?= $item->getProduto()->getFabricante() ?></font>
                         </td>
                         <td>
                              <font face="Verdana" size="2"><?= $item->getQuantidade() ?></font>
                         </td>
                         <td>
                              <font face="Verdana" size="2"><?= $item->getProduto()->getPreco() ?> R$</font>
                         </td>
                         <td>
                              <font face="Verdana" size="2"><?= $item->getValorItem() ?> R$</font>
                         </td>
                         <td bgcolor="#FFFFFF">
                              <font face="Verdana" size="2"><a href="../controllers/controllerCarrinho.php?opcao=excluir&id=<?= $item->getProduto()->getProdutoId() ?>"><img src="imagens/rem3.jpg"></a></font>
                         </td>
                    </tr>
               <?php
                    $soma += $item->getValorItem();
               }
               ?>
               <tr align="right">
                    <td colspan="5">
                         <font face="Verdana" size="4" color="red"><b>Valor Total = R$ <?= $soma ?></b></font>
                    </td>
               </tr>
          </table>
          <p>
               <hr width="50%">
               <img src="imagens/espaco.png" border="0">
          <p>
               <a href="../controllers/controllerProduto.php?opcao=exibirProdutosVenda"><img src="imagens/botao_continuar_comprando.png" border="0"></a>
               <img src="imagens/espaco.png" border="0">
               <a href="../controllers/controllerCarrinho.php?opcao=processoVenda&total=<?= $soma ?>"><img src="imagens/finalizarCompra.png" border="0"></a>
          <?php
     } else {
          ?>
               <center>
                    <font face="Verdana" size="2" color="red"><b>Não existe produtos no carrinho.</b></font>
                    <br><a href="../controllers/controllerProduto.php?opcao=exibirProdutosVenda">Voltar para o carrinho</a>
               </center>
          <?php
     }
          ?>
     </center>
     <?php
     require_once 'includes/rodape.inc.php';
     ?>