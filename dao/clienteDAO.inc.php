<?php
require_once("../classes/Cliente.inc.php");
require_once("conexao.inc.php");
require_once("../utils/utils.inc.php");
class ClienteDAO
{
    private $con;

    public function __construct()
    {
        $conexao = new Conexao();
        $this->con = $conexao->getConexao();
    }

    function efetuarLogin($login, $senha)
    {
        $login = strtolower($login);
        $senha = strtolower($senha);
        $sql = $this->con->prepare("select * from clientes where email = :user and senha = :pass");
        $sql->bindValue(":user", $login);
        $sql->bindValue(":pass", $senha);
        $sql->execute();

        //Conta as linhas no banco de dados
        $cliente = null;
        $count = $sql->rowCount();
        if ($count == 1) {
            $cliente = $sql->fetch(PDO::FETCH_OBJ);
            return $cliente;
        }
        return $cliente;
    }

    public function inserirCliente($cliente)
    {
        $cpf = $cliente->getCPF();
        $nome = $cliente->getNome();
        $logradouro = $cliente->getLogradouro();
        $cidade = $cliente->getCidade();
        $estado = $cliente->getEstado();
        $cep = $cliente->getCEP();
        $telefone = $cliente->getTelefone();
        $data_nascimento = $cliente->getDataNascimento();
        $email = $cliente->getEmail();
        $senha = $cliente->getSenha();
        $rg = $cliente->getRG();

        $sql = "INSERT INTO clientes (cpf, nome, logradouro, cidade, estado, cep, telefone, data_nascimento, email, senha, rg)
              VALUES (:cpf, :nome, :logradouro, :cidade, :estado, :cep, :telefone, :data_nascimento, :email, :senha, :rg)";

        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':logradouro', $logradouro);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':data_nascimento', converteDataMysql($data_nascimento));
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':rg', $rg);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function consultarClientePorId($cpf)
    {
        $sql = "SELECT * FROM clientes WHERE cpf = :cpf";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();
        $resultSet = $stmt->fetch(PDO::FETCH_OBJ);
        $cliente = new Cliente();
        $cliente->setCPF($resultSet->cpf);
        $cliente->setNome($resultSet->nome);
        $cliente->setLogradouro($resultSet->logradouro);
        $cliente->setCidade($resultSet->cidade);
        $cliente->setEstado($resultSet->estado);
        $cliente->setCEP($resultSet->cep);
        $cliente->setTelefone($resultSet->telefone);
        $cliente->setDataNascimento($resultSet->data_nascimento);
        $cliente->setEmail($resultSet->email);
        $cliente->setRG($resultSet->rg);
        return $cliente;
    }

    public function excluirCliente($cpf)
    {
        $sql = "DELETE FROM clientes WHERE cpf = :cpf";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':cpf', $cpf);
        return $stmt->execute();
    }

    public function atualizarCliente($cliente)
    {
        $sql = "UPDATE clientes SET nome = :nome, logradouro = :logradouro, cidade = :cidade, estado = :estado, cep = :cep, telefone = :telefone, data_nascimento = :data_nascimento, email = :email, senha = :senha, rg = :rg WHERE cpf = :cpf";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':nome', $cliente->getNome());
        $stmt->bindParam(':logradouro', $cliente->getLogradouro());
        $stmt->bindParam(':cidade', $cliente->getCidade());
        $stmt->bindParam(':estado', $cliente->getEstado());
        $stmt->bindParam(':cep', $cliente->getCEP());
        $stmt->bindParam(':telefone', $cliente->getTelefone());
        $stmt->bindParam(':data_nascimento', converteDataMysql($cliente->getDataNascimento()));
        $stmt->bindParam(':email', $cliente->getEmail());
        $stmt->bindParam(':senha', $cliente->getSenha());
        $stmt->bindParam(':rg', $cliente->getRG());
        $stmt->bindParam(':cpf', $cliente->getCPF());
        return $stmt->execute();
    }

    public function getClientes()
    {
        $sql = "SELECT * FROM clientes";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $lista = array();

        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $cliente = new Cliente();
            $cliente->setCPF($row->cpf);
            $cliente->setNome($row->nome);
            $cliente->setLogradouro($row->logradouro);
            $cliente->setCidade($row->cidade);
            $cliente->setEstado($row->estado);
            $cliente->setCEP($row->cep);
            $cliente->setTelefone($row->telefone);
            $cliente->setDataNascimento($row->data_nascimento);
            $cliente->setEmail($row->email);
            $cliente->setRG($row->rg);
            $lista[] = $cliente;
        }
        return $lista;
    }
}
