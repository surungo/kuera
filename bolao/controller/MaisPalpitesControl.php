<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/bolao/model/bean/PartidaBean.php';
include_once PATHAPP . '/mvc/bolao/model/business/PartidaBusiness.php';

$bean = new PartidaBean ();
$partidaBusiness = new PartidaBusiness ();

$idobj = (isset ( $_POST ['idobj'] )) ? $_POST ['idobj'] : null;
$conteudo = (isset ( $_POST ['conteudo'] )) ? $_POST ['conteudo'] : textoExemplo();
$conteudoAnterior = (isset ( $_POST ['conteudoAnterior'] )) ? $_POST ['conteudoAnterior'] : "";

$rank = (isset ( $_POST ['rank'] )) ? $_POST ['rank'] : rankExemplo();
$rankAnterior = (isset ( $_POST ['rankAnterior'] )) ? $_POST ['rankAnterior'] : "";


$slpartida = (isset ( $_POST ['partida'] )) ? $_POST ['partida'] : "";
if($slpartida>0){
    $partidaBean = $partidaBusiness->findById($slpartida);
    $conteudo = $partidaBean->gettexto();
}

$result0 = "";
$result1 = "";
$inppeso =  "";
if($conteudoAnterior==$conteudo){
    $result0 = (isset ( $_POST ['result0'] )) ? $_POST ['result0'] : "";
    $result1 = (isset ( $_POST ['result1'] )) ? $_POST ['result1'] : "";
    $inppeso = (isset ( $_POST ['inppeso'] )) ? $_POST ['inppeso'] : "";
}
$ckplacar = (isset ( $_POST ['ckplacar'] )) ? $_POST ['ckplacar'] : "0";
$ckplacarseparado = (isset ( $_POST ['ckplacarseparado'] )) ? $_POST ['ckplacarseparado'] : "0";
$ckjogo = (isset ( $_POST ['ckjogo'] )) ? $_POST ['ckjogo'] : "0";
$ckdata = (isset ( $_POST ['ckdata'] )) ? $_POST ['ckdata'] : "0";
$ckjogoseparado = (isset ( $_POST ['ckjogoseparado'] )) ? $_POST ['ckjogoseparado'] : "0";
$ckrank = (isset ( $_POST ['ckrank'] )) ? $_POST ['ckrank'] : "0";
$ckrankatual = (isset ( $_POST ['ckrankatual'] )) ? $_POST ['ckrankatual'] : "0";

$selecoes = $partidaBusiness->getselecoes();
$pessoas = $partidaBusiness->getpessoas(); 
$cltpartidas;
if($idperfilatual==1||$idperfilatual==17){
    $cltpartidas = $partidaBusiness->findAll();
}
if($conteudo!=null){

    ///$bean->settexto($conteudo);
    
    $textoArray = preg_split( '/\r\n|\r|\n/', $conteudo);
    $jogoArray = preg_grep('/^\\d{1,2}\\/\\d{1,2}\\/\\d{4}.*/',$textoArray);
    sort($jogoArray);
    $jogoArray=array_filter($jogoArray);
    $jogo=$jogoArray[0];
    
    $selecao1 = "";
    $selecao2 = "";
    $posAnt=0;
    foreach ($selecoes as &$selecao) {
        $jogo = str_ireplace($selecao.$selecao, " ".$selecao, $jogo);
        $pos = stripos($jogo,$selecao);
        if($pos>-1){
            if($pos>$posAnt){
                if($selecoes2==""){
                    $selecoes2=$selecao;
                }else{
                    $selecoes1=$selecoes2;
                    $selecoes2=$selecao;
                }
            }else{
                $selecoes1=$selecao;
            }   
            $posAnt = $pos;
            
        }
        
    }
    preg_match_all('/\dX\d/',$jogo,$m);
    $v1 = $m[0][0];
    $resultado = preg_split( '/X/', $v1);
    if(count($resultado)<2){
        $resultado=array("0","0");
        $inppeso=20;
    }
    $part = preg_split( '/ - /', $jogo);
    $datajogo = $part[0];
    
    //echo $jogo;
?>	<br>
<?php if($ckrank=="1"){ ?>[ Rk = Rank ]<?php }?>
<?php if($ckrankatual=="1"){ ?>[ RA = Rank Atualizado ]<?php }?>
<?php if($ckplacar=="1"){ ?>[ PA = Placar Aposta ]<?php }?>
<?php if($ckplacarseparado=="1"){?>[ A1 = Placar Aposta 1][ A2 = Placar Aposta 2]<?php }?>
<?php if($ckjogoseparado=="1"){?>[ R1 = Placar Resultado 1][ R1 = Placar Resultado 2]<?php }?>[ TA = Tipo Acerto]
<br>

	<table class="listTable" cellspacing="0" cellpadding="0" border="0" style="float:right;">
		<thead>
		<tr>
    	    <th class="header"></th>
    	    <?php if($ckrank=="1"){ ?>
            	<th class="header">Rk</th>
			<?php }?>
    	    <?php if($ckrankatual=="1"){ ?>
            	<th class="header">RA</th>
			<?php }?>
			<th class="header">Nome</th>
			<?php if($ckplacar=="1"){ ?>
            	<th class="header">PA</th>
			<?php }?>
			<?php if($ckplacarseparado=="1"){?>
				<th class="header">A1</th>
				<th class="header">A2</th>
			<?php }?>
			<th class="header">Pts</th>
			<?php if($ckjogo=="1"){?>
			<th class="header">Jogo</th>
			<?php } ?>
			<?php if($ckjogoseparado=="1"){?>
				<th class="header">Jogo</th>
				<th class="header">R1</th>
				<th class="header">R2</th>
			<?php }?>
			<?php if($ckdata=="1"){?>
			<th class="header">Data</th>
			<?php }?>
			<th class="header">TA</th>
		</tr>
	</thead>

	<tbody>
<?php     
if($rank!=""){
    $rankarray = preg_split( '/\r\n|\r|\n/', $rank);
}
$peso = 0;
foreach ($pessoas as &$pessoa) {
    $ranklinha = "";
    foreach ($rankarray as &$ranklinha) {
        $posrank = stripos($ranklinha,$pessoa);
        if($posrank>-1){
            break;
        }
    }
    $rankcols = preg_split( '/\t/', $ranklinha);
    $rankp = $rankcols[3];
    
    $linha = "";
    foreach ($textoArray as &$linha) {
        $pos = stripos($linha,$pessoa);
        if($pos>-1){
            break;
        }
    }
    $nomepontos= preg_split( '/\dx\d/', $linha);
    
    $pontos  = str_ireplace(" pontos","",$nomepontos[1]);
    $pontos  = str_ireplace(" ponto","",$pontos);
    
    preg_match_all('/\dx\d/',$linha,$placarAux);
    $placar = $placarAux[0][0];
    $placarArr = preg_split( '/x/', $placar);
    $placar1 = $placarArr[0];
    $placar2 = $placarArr[1];
    $tipoAcerto = 0;
    
    // cabeça
    $result0 = ($result0=="")?$resultado[0]:$result0;
    $result1 = ($result1=="")?$resultado[1]:$result1;
    if($placar1==$result0 && $placar2==$result1){
        $tipoAcerto = 25;
    }
    // vencedor e placar vencedor
    if( $tipoAcerto == ""  &&
        $result0 > $result1 &&
        $placar1 > $placar2 &&
        $placar1==$result0 && 
        $placar2!=$result1)
    {
        $tipoAcerto = 18;
    }
    if( $tipoAcerto == ""  &&
        $result0 < $result1 &&
        $placar1 < $placar2 &&
        $placar1!=$result0 &&
        $placar2==$result1){
        $tipoAcerto = 18;
    }
    // vencedor e saldo
    if( $tipoAcerto == "" &&
        $result0 > $result1 &&
        $placar1 > $placar2 &&
       ($placar1-$placar2) == ($result0-$result1))
    {
        $tipoAcerto = 15;
    }
    if( $tipoAcerto == ""  &&
        $result0 < $result1 &&
        $placar1 < $placar2 &&
       ($placar2 - $placar1) == ($result1-$result0))
    {
        $tipoAcerto = 15;
    }
    if( $tipoAcerto == "" &&
        $result0 == $result1 &&
        $placar1 == $placar2 &&
        $placar1 != $result0 &&
       ($placar1 - $placar2) == 0 &&
       ($result0-$result1) == 0)
    {
        $tipoAcerto = 15;
    }
    // vencedor e placar perdedor
    if( $tipoAcerto == ""  &&
        $result0 > $result1 &&
        $placar1 > $placar2 &&
        $placar1!=$result0 &&
        $placar2==$result1)
    {
        $tipoAcerto = 12;
    }
    if( $tipoAcerto == ""  &&
        $result0 < $result1 &&
        $placar1 < $placar2 &&
        $placar1==$result0 &&
        $placar2!=$result1)
        
    {
        $tipoAcerto = 12;
    }
    // apenas vencedor 
    if( $tipoAcerto == ""  &&
        $result0 > $result1 &&
        $placar1 > $placar2 &&
        $placar1!=$result0 &&
        $placar2!=$result1)
    {
        $tipoAcerto = 10;
    }
    if( $tipoAcerto == ""  &&
        $result0 < $result1 &&
        $placar1 < $placar2 &&
        $placar1!=$result0 &&
        $placar2!=$result1)
        
    {
        $tipoAcerto = 10;
    }
    //empate
    if( $tipoAcerto == ""  &&
        $placar1==$placar2 &&
        ($result0-$result1)!=0)
    {
        $tipoAcerto = 4;
    }
        
    if($inppeso == "" && 
        //$result0 == "" && 
        //$result1 == "" && 
        $tipoAcerto > 0 &&
        $peso !=  $pontos/$tipoAcerto){
        $peso = $pontos/$tipoAcerto;
    }
    if($inppeso != "" ){
        $peso = $inppeso;
        $mostrapontos = $tipoAcerto*$inppeso;
    }else{
        $mostrapontos = $pontos;
    }
    
    
    
    ?>
    <tr>
    	<td>
    	</td>
    <?php if($ckrank=="1"){ ?>
    	<td>
    <?php echo $rankp;?>  
    	</td>
    <?php }?>
    <?php if($ckrankatual=="1"){ ?>
    	<td>
    <?php echo ($rankp+$mostrapontos);?>  
    	</td>
    <?php }?>
    	<td>
    <?php echo $pessoa;?>  
    	</td>
    <?php if($ckplacar=="1"){ ?>
    	<td>
    <?php echo $placar;?>  
    	</td>
    <?php }?>
    <?php  if($ckplacarseparado=="1"){ ?>    	
    	<td>
    <?php echo $placar1;?>  
    	</td>
    	<td>
    <?php echo $placar2;?>  
    	</td>
    <?php  }?>
    	<td>
    <?php echo $mostrapontos;?>  
    	</td>
	<?php if($ckjogo=="1"){?>
		<td>
    <?php echo $selecoes1." ".$resultado[0]." x ".$resultado[1]." ".$selecoes2;?>  
    	</td>
	<?php  }?>
	<?php  if($ckjogoseparado=="1"){ ?>    	
    	<td>
    <?php echo $selecoes1." x ".$selecoes2;?>  
    	</td>
    	<td>
    <?php echo $resultado[0];?>  
    	</td>
    	<td>
    <?php echo $resultado[1];?>  
    	</td>
    <?php  }?>
    
	
    <?php if($ckdata=="1"){?>
		<td>
    <?php echo $datajogo;?>  
    	</td>
	<?php }?>
			
		<td>
    <?php echo $tipoAcerto;?>  
    	</td>			
    </tr>
    <?php
    
    //echo $pessoa.": ". $placar ." ---  ". $pontos  ."  pontos <br>";
    
}
//echo $conteudo;

?>
	</tbody>
</table>

<?php 
}
$inppeso = $peso;

echo $datajogo ." - ";
echo $selecoes1." ".$resultado[0]." ";?>
<input type="text" id="result0" size="4" name="result0" value="<?php echo $result0; ?>" />
 x 
<input type="text" id="result1" size="4" name="result1" value="<?php echo $result1; ?>" />
<?php
echo $resultado[1]." ".$selecoes2. " ..  Peso: ".$peso;
?>
<input type="text" id="inppeso" size="4" name="inppeso" value="<?php echo $inppeso; ?>"><br>
<?php 
echo $button->btAtualizarLista($idurl); ?>
<br>
Mostrar rank 
<input type="checkbox" id="ckrank" name="ckrank" value="1"
<?php echo ($ckrank=="1")?"checked":""; ?>
/>...
Mostrar rank atualizado "tem que usar o rank anterior".
<input type="checkbox" id="ckrankatual" name="ckrankatual" value="1"
<?php echo ($ckrankatual=="1")?"checked":""; ?>
/>
<br>
Mostrar placar 
<input type="checkbox" id="ckplacar" name="ckplacar" value="1"
<?php echo ($ckplacar=="1")?"checked":""; ?>
/>
.....
Mostrar placar separado
<input type="checkbox" id="ckplacarseparado" name="ckplacarseparado" value="1"
<?php echo ($ckplacarseparado=="1")?"checked":""; ?>
/>
<br>
Mostrar Jogo
<input type="checkbox" id="ckjogo" name="ckjogo" value="1"
<?php echo ($ckjogo=="1")?"checked":""; ?>
/>.....
Mostrar Jogo placar separado
<input type="checkbox" id="ckjogoseparado" name="ckjogoseparado" value="1"
<?php echo ($ckjogoseparado=="1")?"checked":""; ?>
/>
<br>
Mostrar Data
<input type="checkbox" id="ckdata" name="ckdata" value="1"
<?php echo ($ckdata=="1")?"checked":""; ?>
/>

<br>
<small>
Vá ao site mais bolão e copia toda a pagina de palpites e cole aqui.<br>
Depois clique atualizar. Verifique se o peso da partida esta correto.
</small>
<br>
<span style="float:left;">
tela de todos os palpites<br>
<?php if(count($cltpartidas)>0){?>
	<select id="partida" name="partida">
		<option value=""></option>
	<?php foreach ($cltpartidas as &$partida) {?>
		<option value="<?php echo $partida->getid(); ?>" <?php echo ($slpartida==$partida->getid())?"selected":";"?>
		><?php echo Util::timestamptostr('d/m/Y H:i:s',$partida->getdtpartida());?> - <?php echo $partida->getnome(); ?></option>
	<?php }?>
	</select>
<?php }?>

<br>
<textarea id="conteudo" name="conteudo" style="font-size: 10px;" rows="60" cols="120"><?php echo $conteudo;?></textarea>
<textarea id="conteudoAnterior" name="conteudoAnterior" style="display: none;"><?php echo $conteudo;?></textarea>

</span>
<span style="float:left;">
tela de classificação<br>
<br>
<textarea id="rank" name="rank" style="font-size: 10px;" rows="60" cols="120"><?php echo $rank;?></textarea>
<textarea id="rankAnterior" name="rankAnterior" style="display: none;"><?php echo $rank;?></textarea>
</span>
<?php 
function rankExemplo(){
    return " 
 Mais Bolão
HOME
MINHA CONTA
BOLÕES
CAMPEONATOS
 Meus Bolões  Copa do Mundo 2018 Bolao Amigos GTIT  Classificação

 

Bolao Amigos GTIT
Copa do Mundo 2018
CLASSIFICAÇÃO
PALPITES
COMENTÁRIOS
DESCRIÇÃO
CONVIDAR AMIGOS
SAIR DESSE BOLÃO

 

Data Inicial
Data Inicial
Data Final
Data Final
#		Nome	
Total	
AP	
GV	
SG	
GP	
AV	
EG
1	Alex Francisco	Alex Francisco	5591	2250	216	975	1500	530	120
2	Roberto Schroeder	Roberto Schroeder	5306	1725	252	1125	972	900	332
3	Emerson Paim de Oliveira	Emerson Paim de Oli...	5070	1650	324	750	1272	610	464
4	Eduardo Bortoluzzi	Eduardo Bortoluzzi	4992	2075	468	825	576	880	168
5	leonardo	leonardo	4945	1475	1134	690	948	530	168
6	Gabriel Borba	Gabriel Borba	4737	950	936	855	1416	320	260
7	Henrique Becker	Henrique Becker	4632	1600	558	480	1344	590	60
8	Rafuxo	Rafuxo	4444	750	576	1380	696	670	372
9	Rodrigo Couto De Souza	Rodrigo Couto De So...	4431	825	882	1050	768	710	196
10	Rodrigo Fehse	Rodrigo Fehse	4359	825	792	720	792	870	360
11	Espinoza	Espinoza	4340	1225	324	885	960	790	156
12	Paulo Barcelos	Paulo Barcelos	4228	1375	324	915	900	390	324
13	Sandro	Sandro	4166	1150	594	630	504	700	588
14	Rafael Girardi Moterle	Rafael Girardi Mote...	4068	1125	252	885	1116	610	80
15	Juliano	Juliano	3724	1200	0	720	1200	400	204

  

 
 
Links
SOBRE
REGULAMENTO
PERGUNTAS FREQUENTES
POLÍTICA DE PRIVACIDADE
Fale Conosco
Nome
Nome
E-mail
E-mail
Mensagem
Mensagem
Copyright © 2017 - Todos os direitos reservados

Este site usa cookies para garantir que você tenha a melhor experiência. Leia mais  
";
}
function textoExemplo(){
return " 
 Mais Bolão
HOME
MINHA CONTA
BOLÕES
CAMPEONATOS
 Meus Bolões  Copa do Mundo 2018 Bolao Amigos GTIT  Palpites

 

Bolao Amigos GTIT
Copa do Mundo 2018
CLASSIFICAÇÃO
PALPITES
COMENTÁRIOS
DESCRIÇÃO
CONVIDAR AMIGOS
SAIR DESSE BOLÃO

 

24/06/2018 15:00h - Arena Kazan PolôniaPolônia 0X3ColômbiaColômbia
Alex Francisco 0x1240 pontos
Roberto Schroeder 1x180 pontos
Emerson Paim de Oli... 1x2200 pontos
Eduardo Bortoluzzi 1x2200 pontos
leonardo 0x1240 pontos
Gabriel Borba 1x180 pontos
Henrique Becker 1x2200 pontos
Rafuxo 1x180 pontos
Rodrigo Couto De So... 1x2200 pontos
Rodrigo Fehse 1x2200 pontos
Espinoza 0x1240 pontos
Paulo Barcelos 3x10 ponto
Sandro 2x10 ponto
Rafael Girardi Mote... 1x180 pontos
Juliano 1x2200 pontos

  

 
 
Links
SOBRE
REGULAMENTO
PERGUNTAS FREQUENTES
POLÍTICA DE PRIVACIDADE
Fale Conosco
Nome
Nome
E-mail
E-mail
Mensagem
Mensagem
Copyright © 2017 - Todos os direitos reservados

Este site usa cookies para garantir que você tenha a melhor experiência. Leia mais ";
}
?>
