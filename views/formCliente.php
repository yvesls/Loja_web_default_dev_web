<div align="center">
    <?php
    require_once 'includes/cabecalho.inc.php';
    session_start();
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
    <form align="center" style="padding: 0 0 50px 0;" action="../controllers/controllerCliente.php" method="POST">
        <h2>Cadastrar Cliente</h2><br><br>
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf"><br><br>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome"><br><br>

        <label for="logradouro">Logradouro:</label>
        <input type="text" id="logradouro" name="logradouro"><br><br>

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade"><br><br>

        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado"><br><br>

        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep"><br><br>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone"><br><br>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="text" id="data_nascimento" name="data_nascimento"><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha"><br><br>

        <label for="rg">RG:</label>
        <input type="text" id="rg" name="rg"><br><br>

        <input type="hidden" name="opcao" value="cadastrar">
        <input type="submit" value="Enviar"><input type="reset" value="Cancelar">
    </form>

    <?php
    require_once 'includes/rodape.inc.php';
    ?>
</div>