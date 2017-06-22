<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include __DIR__ . '/../vendor/autoload.php';

// USES
use SNFe\Certificados;
use SNFe\CertificadosEmpresas;

$snfe_token="klb09hj";
$snfe_token_secret="jhulko67@#hj";

$certPassword = 'bama1515';

putenv('SNFE_TOKEN='.$snfe_token);
putenv('SNFE_TOKEN_SECRET='.$snfe_token_secret);


//Gets certificate from file and encode in base64
$certificadosService = new Certificados();

$filename = "./MUNDIAL_CERTIFICADO.pfx";
$content = base64_encode(file_get_contents($filename));

// Error - {"status":"fail","message":"Informe a qual empresa percente este certificado!!"}
// $certificadoNovo = [ 'pass'=>$certPassword, 'conteudo'=>$content, 'empresas_id'=>$idComp];
$certificadoNovo = [ 'pass'=>$certPassword, 'conteudo'=>$content];
try {
	$retCert = $certificadosService->create(['data'=>$certificadoNovo]);
	var_dump($retCert);
} catch (Exception $e) {
	var_dump($e->getMessage());
}

// Links certificate to Company
$idCert = ""; // Pegar o ID do certificado criado e colocar aqui
$certificadosEmpresasService = new CertificadosEmpresas();
$certificadoEmpresaNovo = [ 'certificados_id'=>$idCert, 'empresas_id'=>$idComp ];
try {	
	$retCertEmpre = $certificadosEmpresasService->create(['data'=>$certificadoEmpresaNovo]);
	var_dump($retCertEmpre);
} catch (Exception $e) {
	var_dump($e->getMessage());
}
