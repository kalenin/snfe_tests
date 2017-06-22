<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include __DIR__ . '/../vendor/autoload.php';

// USES
use SNFe\Empresas;
use SNFe\EmpresasInvoice;


$snfe_token="klb09hj";
$snfe_token_secret="jhulko67@#hj";

putenv('SNFE_TOKEN='.$snfe_token);
putenv('SNFE_TOKEN_SECRET='.$snfe_token_secret);


$idComp = '374';

$empresasService = new Empresas();
try {
	$ret = $empresasService->get($id=$idComp);
	var_dump($ret);
} catch (Exception $e) {
	var_dump($e->getMessage());
}

$id 			= $ret->id;
$telefone 		= $ret->responsavel_telefone;
$email 			= $ret->responsavel_email;
$ie 			= "104070943";
$endereco 		= $ret->endereco;
$numero 		= $ret->numero;
$complemento 	= $ret->complemento;
$bairro 		= $ret->bairro;
$cep 			= $ret->cep;
$pais_id 		= "1058";
$estado_id 		= "52" ;
$cidade_id 		= "5219100" ;
$nfce_id_token 	= '000001';
$nfce_token 	= "2a35b8217eabebe1z";

$empresaInvoiceService = new EmpresasInvoice();

$empresaInvoiceNovo = [
	'empresas_id'			=>	$idComp,
	'tp_tpImp'				=>	'1',
	'tp_tpEmis'				=>	'1',
	'tp_Amb'				=>	'2',
	'telefone'				=>	$telefone,
	'email'					=>	$email,
	'serie_55'				=>	'2',
	'serie_65'				=>	'2',
	'tp_CRT'				=>	'3',
	'inscricao_estadual'	=>	$ie,
	'endereco'				=>	$endereco,
	'numero'				=>	$numero,
	'complemento'			=>	$complemento,
	'bairro'				=>	$bairro,
	'cep'					=>	$cep,
	'pais_id'				=>	$pais_id,
	'estado_id'				=>	$estado_id,
	'cidade_id'				=>	$cidade_id,
	'nfce_id_token'			=>	$nfce_id_token,
	'nfce_token'			=>	$nfce_token,
];
var_dump($empresaInvoiceNovo);
try {
	// Erro: {"status":"fail","message":"Formato Inv\u00e1lido - T003"}
	$retEmpInvoice = $empresaInvoiceService->create(['data'=>$empresaInvoiceNovo]);
	var_dump($retEmpInvoice);
} catch (Exception $e) {
	var_dump($e->getMessage());
}