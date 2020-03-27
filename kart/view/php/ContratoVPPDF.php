<?php
$dbg = 0;
$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : '0';
$idobj = ($idobj == '0' && isset ( $_GET ['idobj'] )) ? $_GET ['idobj'] : $idobj;
Util::echobr ($dbg , 'ContratoVPPDF $$idobj', $idobj);
Util::echobr ($dbg , 'ContratoVPPDF $_POST ["idobj"]', $_POST ['idobj']);
Util::echobr ($dbg , 'ContratoVPPDF $_GET ["idobj"]', $_GET ['idobj']);
Util::echobr ($dbg , 'ContratoVPPDF URLAPP', URLAPP);
Util::echobr ($dbg , 'ContratoVPPDF LINKORIGEM', LINKORIGEM);


$paramsCVP = "ContratoVPconteudo";
$paramsCVP = $paramsCVP.(($value=="")?"":(($paramsCVP=="")?"":"&") .'value='.$value);
$paramsCVP = $paramsCVP.(($idurl=="")?"":(($paramsCVP=="")?"":"&") .'idurl='.$idurl);
$paramsCVP = $paramsCVP.(($idobj=="")?"":(($paramsCVP=="")?"":"&") .'idobj='.$idobj);
$paramsCVP = $paramsCVP.(($choice=="")?"":(($paramsCVP=="")?"":"&").'choice='.$choice);
$paramsCVP = $paramsCVP.(($action=="")?"":(($paramsCVP=="")?"":"&").'action='.$action);
//$paramsCVP = $paramsCVP.((URLKARTIMG=="")?"":(($paramsCVP=="")?"":"&").'URLKARTIMG='.URLKARTIMG);
$paramsCVP = $paramsCVP.(($paramsCVP=="")?"":"&").'target='.Target::POPUP;
$paramsCVP = $paramsCVP.(($keysession=="")?"":(($paramsCVP=="")?"":"&").'keysession='.$keysession);
$paramsCVP = $paramsCVP.(($token=="")?"":(($token=="")?"":"&").'token='.$token);

$urlContent = LINKORIGEM.'/?'.$paramsCVP;
Util::echobr ($dbg , 'ContratoVPPDF $$urlContent', $urlContent);


$stringhtml = file_get_contents($urlContent);

if($dbg==1){
	echo $stringhtml;
}else{
//definimos uma constante com o nome da pasta
define('MPDF_PATH', PATHKARTPHP.'/mpdf60/');

//incluimos o arquivo
include(MPDF_PATH.'mpdf.php');

//definimos o timezone para pegar a hora local
date_default_timezone_set('America/Sao_Paulo');

//criamos uma variavel e colocamos nela tudo que desejamos que nosso pdf contenha
//$html = "Ol&aacute; mundo";

//instanciamos nossa classe mPDF
$mpdf=new mPDF();

//definimos o tipo de exibicao
$mpdf->SetDisplayMode('fullpage');

//definimos estilos de fonts
$mpdf->useOnlyCoreFonts = true;
//$mpdf->watermark_font = 'DejaVuSansCondensed';

//definimos se vamos exibir a marca d'agua
//$mpdf->showWatermarkText = true;
//$mpdf->SetWatermarkText('Marca d\'agua');

//colocamos um icone de logo tipo no pdf
//$mpdf->SetWatermarkImage('icones/logoif.png', 1, '', array(140,10));

//definimos se sera exibido ou nao o logo no pdf
//$mpdf->showWatermarkImage = true;

//escrve o titulo de nosso pdf
//$mpdf->WriteHTML('<br/><h1>T&iacute;tulo do PDF</h1><hr/>');

//definimos oque vai conter no rodape do pdf
//$mpdf->SetFooter('{DATE j/m/Y H:i}||Pagina {PAGENO}/{nb}');

//e finalmente escrevemos todo nosso conteudo no pdf para exibir
$mpdf->WriteHTML($stringhtml);

//fechamos nossa instancia ao pdf
$mpdf->Output();

//pausamos a tela para exibir o que foi feito
exit();
}
?>
