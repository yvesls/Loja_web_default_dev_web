<?php
require_once 'includes/cabecalho.inc.php';
require_once '../classes/Cliente.inc.php';
require_once '../classes/Item.inc.php';
require_once '../utils/utils.inc.php';

session_start();

$cliente = $_SESSION["cliente"];
$total = $_SESSION["total"];
$carrinho = $_SESSION["carrinho"];

?>
<div class="corpo" align="center" style="line-height: 3em;">
     <h2>Dados do Cliente</h2>
     <div style="line-height: 1.5;">
          Nome:
          <?= $cliente->getNome() ?></br>
          CPF:
          <?= $cliente->getCpf() ?></br>
          CEP:
          <?= $cliente->getCep() ?></br>
          Telefone:
          <?= $cliente->getTelefone() ?></br>
          Email:
          <?= $cliente->getEmail() ?></br>
     </div>
     <p>
          <hr width="60%">
          <img src="imagens/espaco.png" border="0">
     </p>
     <h2>Dados da compra</h2>
     <table border="0" cellspacing="2" width="60%" class="mt-1">
          <tr bgcolor="#000098" align="center">
               <th>
                    <font face="Verdana" size="2" color="#FFFFFF">
                         <font face="Verdana" size="2">Item</font>
               </th>
               <th>
                    <font face="Verdana" size="2" color="#FFFFFF">Referência</font>
               </th>
               <th>
                    <font face="Verdana" size="2" color="#FFFFFF">Nome</font>
               </th>
               <th>
                    <font face="Verdana" size="2" color="#FFFFFF">Fabricante</font>
               </th>
               <th>
                    <font face="Verdana" size="2" color="#FFFFFF">Qantidade</font>
               </th>
               <th>
                    <font face="Verdana" size="2" color="#FFFFFF">Valor</font>
               </th>
          </tr>
          <?php
          foreach ($carrinho as $idx => $item) {
               ?>
               <tr align="center">
                    <td>
                         <font face="Verdana" size="2">
                              <img src="imagens/produtos/<?= $item->getProduto()->getReferencia() ?>.jpg" width="100"
                                   height="100" border="0">
                         </font>
                    </td>
                    <td>
                         <font face="Verdana" size="2">
                              <?= $item->getProduto()->getProdutoId() ?>
                         </font>
                    </td>
                    <td>
                         <font face="Verdana" size="2">
                              <?= $item->getProduto()->getNome() ?>
                         </font>
                    </td>
                    <td>
                         <font face="Verdana" size="2">
                              <?= $item->getProduto()->getFabricante() ?>
                         </font>
                    </td>
                    <td>
                         <font face="Verdana" size="2">
                              <?= $item->getQuantidade() ?>
                         </font>
                    </td>
                    <td>
                         <font face="Verdana" size="2">
                              <?= formatarMoeda($item->getProduto()->getPreco()) ?>
                         </font>
                    </td>
               </tr>
               <?php
          }
          ?>
          <tr align="center">
               <td colspan="6">
                    <font face="Verdana" size="4" color="red"><b>Valor Total =
                              <?= formatarMoeda($total) ?>
                         </b>
                    </font>
               </td>
          </tr>
     </table>
     <p>
          <hr width="60%">
          <img src="imagens/espaco.png" border="0">
     </p>
     <a href="dadosPagamento.php">
          <button type="button">Próximo >></button>
     </a>
     <div>
          <img src="imagens/espaco.png" border="0" />
     </div>
</div>
<?php
require_once 'includes/rodape.inc.php';
?>