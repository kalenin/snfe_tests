<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
include __DIR__ . '/../vendor/autoload.php';

// USES
use SNFe\Actions;
use SNFe\Notas;

$snfe_token="klb09hj";
$snfe_token_secret="jhulko67@#hj";

putenv('SNFE_TOKEN='.$snfe_token);
putenv('SNFE_TOKEN_SECRET='.$snfe_token_secret);

$actionsService = new Actions();
$notasService = new Notas();

$estado_id 		= "52" ;
$cidade_id 		= "5219100" ;
$pais_id 		= "1058";

$destinatario = [
	'cnpj_cpf'		=>	'400.622.718-30',
	'insc_estadual'	=>	'',
	'nome'			=>	'Kalenin de Moraes Branco',
	'tp_fiscal'		=>	'9', //Tipo Fiscal, Inteiro conforme as opções seguintes(1	=>	Contribuinte ICMS,2	=>	Contribuinte isento de Inscrição no cadastro de Contribuintes do ICMS,9	=>	Não Contribuinte, que pode ou não possuir Inscrição Estadual no Cadastro de Contribuintes do ICMS)
	'logradouro'	=>	'Praça Sebastião Vaz',
	'numero'		=>	'422',
	'cep'			=>	'75394-970',
	'complemento'	=>	'Quadra 60 Lote 1',
	'bairro'		=>	'Setor Central',
	'estado_id'		=>	$estado_id,
	'cidade_id'		=>	$cidade_id,
	'pais_id'		=>	$pais_id,
	'email'			=>	'kalenin.moraesb@gmail.com',
	'telefone'		=>	'(13)99176-2125',
];

$transportadora = [
	'CNPJ_CPF'			=>	'37.649.100/0001-53',
	'xNome'				=>	'Mundial Bebidas e Gás Ltda.',
	'IE'				=>	'104070943',
	'xEnder'			=>	'PRAÇA DA BIBLIA s/n QD.04  LT.16',
	'xMun'				=>	'Santa Barbara de Goias',
	'UF'				=>	'GO',
	'veicTransp_placa'	=>	'ASD-1232',
	'veicTransp_UF'		=>	'GO',
	'veicTransp_RNTC'	=>	'',
];

// PERGUNTAR ONDE INFORMO O CFOP PARA CADA PRODUTO
$invoice_lines = [
	[
		'descricao'		=>	'Gás GLP P13',
		'ref'			=>	'GLP-P13',
		'ean13'			=>	'',
		'origem'		=>	'0',
		'observacoes'	=>	'Aqui estão as observações do produto',
		'valor_total'	=>	100.00,
		'quantidade'	=>	10.0000,
		'ncm_id'		=>	'27111910',//'Código NCM/TIPI (somente números)',
		'um_id'			=>	'Un',//'Unidade de medida (Kg,Un,etc)',
		'xPed'			=>	'',
		'nItemPed'		=>	'',
	],
	[
		'descricao'		=>	'Gás GLP P20',
		'ref'			=>	'GLP-P20',
		'ean13'			=>	'',
		'origem'		=>	'0',
		'observacoes'	=>	'Aqui estão as observações do produto',
		'valor_total'	=>	100.00,
		'quantidade'	=>	10.0000,
		'ncm_id'		=>	'27111910',//'Código NCM/TIPI (somente números)',
		'um_id'			=>	'Un',//'Unidade de medida (Kg,Un,etc)',
		'xPed'			=>	'',
		'nItemPed'		=>	'',
	],
];

$faturas = [
	[
		'nome'				=>	'Fatura 1',
		'data_vencimento'	=>	'29/06/2017',
		'valor'				=>	100.00
	],
	[
		'nome'				=>	'Fatura 2',
		'data_vencimento'	=>	'29/07/2017',
		'valor'				=>	100.00
	]
];


$nfeNova = [
	'empresas_id'			=>	'374',
	'invoice_lines'			=>	$invoice_lines,
	'tp_nf'					=>	1,//'Tipo da Nota, Inteiro conforme as opções seguintes(0	=>	Entrada,1	=>	Saida)',
	'tp_doc'				=>	55,//'Documento Fiscal, Inteiro conforme as opções seguintes (55	=>	NFe,65	=>	NFCe)',
	'serie'					=>	2,//'Número da série (1-999)',
	'numero_nf'				=>	1,//'Número da NFe',
	'tp_frete'				=>	0,//'Tipo do Frete, Inteiro conforme as opções seguintes(0	=>	Por Conta do Emitente - CIF,1	=>	Por Conta do Destinatário/remetente - FOB, 2	=>	Por Conta de Terceiros,9	=>	Sem Frete)',
	'posicaofiscal_id'		=>	'',//'ID_POSICAOFISCAL_NA_API',
	'observacoes'			=>	'Estas são observações da nota fiscal',
	'valor_frete'			=>	0.00,
	'valor_seguro'			=>	0.00,
	'valor_outros'			=>	0.00,
	'valor_desconto'		=>	0.00,
	'peso_liquido'			=>	300.00,
	'peso_bruto'			=>	600.00,
	'volume'				=>	0,
	'vol_especie'			=>	'',
	'vol_marca'				=>	'',
	'vol_numero'			=>	0,
	// 'valor_aprox_tributos'	=>	0.00,// Informação calculada do lado da SBAUM
	'tp_idDest' 			=>	1,//'Local de Destino da Operação, Inteiro conforme as opções seguintes(1	=>	Operação interna,2	=>	Operação interestadual,3	=>	Operação com exterior)',
	'tp_finNFe'				=>	1,//'Finalidade de Emissão da NF-e, Inteiro conforme as opções seguintes(1	=>	1-NF-e normal,2	=>	2-NF-e complementar,3	=>	3-NF-e de ajuste,4	=>	4-Devolução)',
	'tp_indFinal'			=>	1,//'Operação com Consumidor Final, Inteiro conforme as opções seguintes(0	=>	Não,1	=>	Consumidor Final)',
	'tp_indPres'			=>	2,//'Indicador de Presença do Comprador, Inteiro conforme as opções seguintes (0	=>	Não se aplica,1	=>	Operação presencial,2	=>	Operação não presencial, pela Internet,3	=>	Operação não presencial, Teleatendimento,4	=>	NFC-e em operação com entrega a domicílio,9	=>	Operação não presencial, outros)',
	'dhCont'				=>	'',//'Data e Hora de entrada em contingência',
	'xJust'					=>	'',//'Justificativa de entrada em Contingência',
	'natOpe'				=>	'Venda',//'Natureza da Operação',
	'cpr_lines'				=>	$faturas,
	'transportadora'		=>	$transportadora,
	'destinatario'			=>	$destinatario,
	'tp_indPag'				=>	1, //'Indicador, Inteiro conforme as opções seguintes (NF-e/NFC-e) (0=>Pagamento à Vista,1=>1-Pagamento à Prazo,2=>2-Outros)'
];

//Erro: {"status":"fail","message":"Call to undefined method App\\invoice\\control\\InvoiceCreate::findString()"}

try {
	$retNfe = $actionsService->criarNota(['data'=>$nfeNova]);
	var_dump($retNfe);
} catch (Exception $e) {
	var_dump($e->getMessage());
}



//Erro: {"status":"fail","message":"SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`snfe`.`notas`, CONSTRAINT `fk_notas_notas_natureza1` FOREIGN KEY (`notas_natureza_id`) REFERENCES `notas_natureza` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION)"}
// try {
// 	$retNfe = $notasService->create(['data'=>$nfeNova]);
// 	var_dump($retNfe);
// } catch (Exception $e) {
// 	var_dump($e->getMessage());
// }