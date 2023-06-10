<div align="center">
    <?php
    require_once 'includes/cabecalho.inc.php';
    session_start();

    $fabricantes = $_SESSION['fabricantes'];

    //if($_SESSION["logado"]) {
    if (isset($_REQUEST["erro"])) {   //Verifica se o parâmetro "erro" existe
        if ((int)($_REQUEST["erro"]) == 1) {    //Captura o "erro"
            echo ("<b><font face='Verdana' size='2' color='red'>Ocorreu um erro ao inserir o produto.</font></b>");
        } else if ($_REQUEST["erro"] == 2) {
            echo ("<b><font face='Verdana' size='2' color='red'>" . $_SESSION['erro2'] . "</font></b>");
        }
    }

    if (isset($_REQUEST["inclusao"])) {
        if ($_REQUEST["inclusao"] == 1) {
            echo ("<b><font face='Verdana' size='2' color='green'>Incluído com sucesso!</font></b>");
        }
    }
    ?>

    <form align="center" action="../controllers/controllerProduto.php" method="POST">
        <h2>Cadastrar produto</h2><br><br>
        Nome: <input type="text" size="20" name="nome"><br><br>
        Data de fabricação: <input type="text" size="20" name="dataFabricacao"><br><br>
        Preço: <input type="text" size="20" name="preco"><br><br>
        Quantidade em estoque: <input type="text" size="20" name="estoque"><br><br>
        Descrição do produto: <textarea name="descricao" rows="4" cols="50"></textarea><br><br>
        Número de referência: <input type="text" size="20" name="referencia"><br><br>

        Fabricante: <select name="fabricante">
            <option value="0">-</option>
            <?php
            foreach ($fabricantes as $fab) {
                echo "<option value='" . $fab->codigo . "'>$fab->nome</option>";
            }
            ?>
        </select>
        <p>
            <input type="hidden" name="opcao" value="incluir">
            <input type="submit" value="Registrar"><input type="reset" value="Cancelar">
    </form>

    <?php
    require_once 'includes/rodape.inc.php';
    //} else {
    //    header("Location:../index.html");
    //}
    ?>
</div>