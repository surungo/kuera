<?php 
	


//include_once ( PATHKARTPHP.'/Util.php');

?>

<style>
<!--

 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{
	font-size:10.0pt;
	font-family:"Calibri",sans-serif;
	color:black;
	
	}


 /* Page Definitions */
 <?php $pagewidth = 575;?>
 	
.TableGrid{
	width:<?php echo $pagewidth;?>pt;
}
	
div.WordSection1
	{
	page:WordSection1;width:<?php echo $pagewidth;?>pt;/*height:842.0pt;*/
	margin:3.1pt 21.4pt 0pt 28.8pt;
	}
	
	h1
	{
		text-align:center;
		page-break-after:avoid;
		font-size:26.0pt;
		font-family:"Calibri",sans-serif;
		color:black;
		font-weight:normal;
	}

	<?php for($inicio = 10;$inicio < 500; $inicio=$inicio+5){?>
	.entrelinasTDCB<?php echo $inicio?>{
		font-weight:bolder;
		text-align:center;
		height: <?php echo $inicio?>pt;
		
	}
	
	.entrelinasTD<?php echo $inicio?>{
		height: <?php echo $inicio?>pt;
	}
	
	.entrelinasPC<?php echo $inicio?>{
		padding-top: <?php echo $inicio?>px;
		text-align: justify;
	}
	
	<?php }?>
				
	.numberPage{
		text-align: right;
		margin:10.1pt 40.0pt 0pt 0pt;
	}
	
-->
</style>

</head>

<body lang="PT-BR" marginheight="0" marginwidth="0" rightmargin="0" bottommargin="0" leftmargin="0" topmargin="0">

<div class="WordSection1">

<?php 

$dataHoje = Util::hoje();


$razao = $pagewidth/9;
$cols[0] = 0.6;
$cols[1] = 0.6;
$cols[2] = 1.2;
$cols[3] = 0.4;
$cols[4] = 1.0;
$cols[5] = 1.0;
$cols[6] = 0.9;
$cols[7] = 0.6;
$cols[8] = 2.7;

$pageNumber=1;
$ajusteBottomP1 = 100;
$ajusteBottomP1 = 10;
$ajusteBottom=$ajusteBottomP1;
include PATHKARTPHP.'/ContratoVP1.php';
?>
</div>

<p clear=all style='page-break-before:always'></p>
<div class="WordSection1">
<?php 

$pageNumber=2;
$ajusteBottomP2 = 30;
$ajusteBottom=$ajusteBottomP2;
include PATHKARTPHP.'/ContratoVP2.php';

?>

</div>

<p clear=all style='page-break-before:always'></p>
<div class="WordSection1">
<?php 
$pageNumber=3;
$ajusteBottom=$ajusteBottomP1;
include PATHKARTPHP.'/ContratoVP1.php';?>
</div>

<p clear=all style='page-break-before:always'></p>
<div class="WordSection1">
<?php 
$pageNumber=4;
$ajusteBottom=$ajusteBottomP2;
include PATHKARTPHP.'/ContratoVP2.php';?>
</div>

<p clear=all style='page-break-before:always'></p>
<?php  ?>
<div class="WordSection1">
<?php 
$pageNumber=5;
$ajusteBottom=90;
include PATHKARTPHP.'/ContratoVPF.php';
?>
</div>

</body>

</html>
