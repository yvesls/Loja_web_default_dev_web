<?php

require './autoloader.php';
require_once '../../classes/Cliente.inc.php';

use OpenBoleto\Banco\BancoDoBrasil;
use OpenBoleto\Agente;

session_start();

$cliente = $_SESSION["clienteLogado"];
$total = $_SESSION["total"];

$sacado = new Agente($cliente->getNome(), $cliente->getCpf(), $cliente->getLogradouro(), $cliente->getCep(), $cliente->getCidade(), $cliente->getEstado());
$cedente = new Agente('Comércio Eletrônico Desweb LTDA', '02.123.123/0001-11', 'Rua Principal 403 Lj 23', '29500-000', 'Alegre', 'ES');

$boleto = new BancoDoBrasil(array(
    // Parâmetros obrigatórios
    'dataVencimento' => new DateTime('+5 days'),
    'valor' => $total,
    'sequencial' => 1234567,
    'sacado' => $sacado,
    'cedente' => $cedente,
    'agencia' => 1724, // Até 4 dígitos
    'carteira' => 18,
    'conta' => 10403005, // Até 8 dígitos
    'convenio' => 1234, // 4, 6 ou 7 dígitos

    // Caso queira um número sequencial de 17 dígitos, a cobrança deverá:
    // - Ser sem registro (Carteiras 16 ou 17)
    // - Convênio com 6 dígitos
    // Para isso, defina a carteira como 21 (mesmo sabendo que ela é 16 ou 17, isso é uma regra do banco)

    // Parâmetros recomendáveis
    //'logoPath' => 'http://empresa.com.br/logo.jpg', // Logo da sua empresa
    'contaDv' => 2,
    'agenciaDv' => 1,
    'descricaoDemonstrativo' => array( // Até 5
        'Compra de produtos da loja web UFES',
        'Teste de emissão de boleto',
    ),
    'instrucoes' => array( // Até 8
        'Após o dia 5 dias da data de vencimento, o boleto estará cancelado',
        'Não receber após o vencimento.',
    ),

    // Parâmetros opcionais
    //'resourcePath' => '../resources',
    //'moeda' => BancoDoBrasil::MOEDA_REAL,
    //'dataDocumento' => new DateTime(),
    //'dataProcessamento' => new DateTime(),
    //'contraApresentacao' => true,
    //'pagamentoMinimo' => 23.00,
    //'aceite' => 'N',
    //'especieDoc' => 'ABC',
    //'numeroDocumento' => '123.456.789',
    //'usoBanco' => 'Uso banco',
    //'layout' => 'layout.phtml',
    //'logoPath' => 'http://boletophp.com.br/img/opensource-55x48-t.png',
    //'sacadorAvalista' => new Agente('Antônio da Silva', '02.123.123/0001-11'),
    //'descontosAbatimentos' => 123.12,
    //'moraMulta' => 123.12,
    //'outrasDeducoes' => 123.12,
    //'outrosAcrescimos' => 123.12,
    //'valorCobrado' => 123.12,
    //'valorUnitario' => 123.12,
    //'quantidade' => 1,
));

echo $boleto->getOutput();
