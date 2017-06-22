<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include __DIR__ . '/../vendor/autoload.php';

// USES
use SNFe\Empresas;


$snfe_token="klb09hj";
$snfe_token_secret="jhulko67@#hj";

putenv('SNFE_TOKEN='.$snfe_token);
putenv('SNFE_TOKEN_SECRET='.$snfe_token_secret);


$empresasService = new Empresas();

$empresaNova = [
	'razao_social'=>'Mundial Bebidas e Gás Ltda.',
	'nome_fantasia'=>'Mundial Bebidas e Gás',
	'cnpj'=>'37.649.100/0001-53',
	'endereco'=>'PRAÇA DA BIBLIA',
	'numero'=>'s/n',
	'complemento'=>'QD.04  LT.16',
	'bairro'=>'RODOVIARIO',
	'cidade'=>'Santa Barbara de Goias',
	'estado'=>'GO',
	'cep'=>'75390-000',
	'responsavel_nome'=>'Kalenin de Moraes Branco',
	'responsavel_email'=>'kalenin+mundial@gasdelivery.com.br',
	'responsavel_telefone'=>'(13)99176-2125',
];
try {
	$ret = $empresasService->create(['data'=>$empresaNova]);
	var_dump($ret);
} catch (Exception $e) {
	var_dump($e->getMessage());
}




