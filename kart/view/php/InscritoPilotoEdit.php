<input type="hidden" id="selcampeonato" name="selcampeonato"
	value="<?php echo $selcampeonato;?>"?>
<?php
$dbg = 0;
if (Choice::ABRIR == $choice) {
	$urlInclude = PATHAPP . '/mvc/kart/view/php/InscritoEdit.php';
	include $urlInclude;
}

// manter os relatorios da tela anterior no estado que estavam
for($ix = 0; $ix < count ( $relatorios ); $ix ++) {
	$relatorio = $relatorios [$ix];
	$idcolecao = $relatorio ["idcolecao"];
	$titulo = $relatorio ["titulo"];
	$collection = $relatorio ["colecao"];
	$edicao = $relatorio ["choice"];
	$display = $relatorio ["display"];
	?>
<input type="hidden" idcolecao="<?php echo $idcolecao;?>"
	name="btn_<?php echo $idcolecao;?>" id="btn_<?php echo $idcolecao;?>"
	class="displaycolecao"
	value="<?php echo ($display=="none")?"Mostrar":"Esconder";?>"
	<?php echo $idcolecao;?> _display="<?php echo $display;?>">
<?php

}

Util::echobr ( $dbg, 'InscritoPilotoEdit $idobj  ', $idobj );
Util::echobr ( $dbg, 'InscritoPilotoEdit $choice ', $choice );
Util::echobr ( $dbg, 'InscritoPilotoEdit $idurl ', $idurl );
Util::echobr ( $dbg, 'InscritoPilotoEdit $selcampeonato ', $selcampeonato );
Util::echobr ( $dbg, 'InscritoPilotoEdit $pilotoBean->getid() ', $pilotoBean->getid () );
if (Choice::VALIDAR == $choice) {
	
	?>
<style>
.manter {
	background-color: aqua;
}
</style>
<script>
	$(document).ready(function(){
		$(".camposOp").click(function(){
			$(".GP"+$(this).attr("grupo")).removeClass("manter");
			$(this).addClass("manter");
			$("#"+$(this).attr("grupo")).val($(this).val());
			
		});

		
	});
</script>
<?php if(count($pilotosSemelhantes)){?>
<table class="list" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr>
    <?php
		if ($editar == true) {
			?> 
      <th class="headerlink">&nbsp;</th> 
		<?php
		}
		?> 
	  <th class="header">CPF</th>
			<th class="header">Nome</th>
			<th class="header">DtNascimento</th>
		</tr>
	</thead>

	<tbody>
	<?php
		
for($i = 0; $i < count ( $pilotosSemelhantes ); $i ++) {
			$pilotoSemelhanteBean = $pilotosSemelhantes [$i];
			$corlinha = ($i % 2 == 0) ? "par" : "impar";
			?>
	<tr class="<?php echo $corlinha;?>">
			<td>Selecionar</td>
			<td>
			<?php echo $pilotoSemelhanteBean->getcpf();?>
    	</td>
			<td>
			<?php echo $pilotoSemelhanteBean->getnome();?>
		</td>
			<td>
			<?php echo $pilotoSemelhanteBean->getdtnascimento();?>
		</td>


		</tr>
	<?php }?>
  </tbody>
</table>

<?php }?>
<TABLE>
	<TR id="headerPage">
		<TD>CPF</TD>
		<TD>
			<?php echo $inscritoBean->getcpf();?>
			<input type="hidden" id="cpf" name="cpf"
			value="<?php echo ($inscritoBean->getcpf()=='')?$pilotoBean->getcpf():$inscritoBean->getcpf();?>">
		</TD>
		<TD>
			<?php echo $selcampeonatoBean->getnome();?>
			
		</TD>

	</TR>
	<TR>

		<TD colspan="3" align="center">Clique no campo de deseja manter no
			piloto.</TD>
	</TR>

	<TR>
		<TD>&nbsp;</TD>
		<TD>Inscrito <input type="hidden" id="inscrito" name="inscrito"
			value="<?php echo $inscritoBean->getid();?>"?>
		</TD>
		<TD>Piloto <input type="hidden" id="piloto" name="piloto"
			value="<?php echo $pilotoBean->getid();?>"?>

		</TD>
	</TR>
	<TR>
		<TD>
			Nome
			<?php
	if ($inscritoBean->getnome () == '') {
		$manterPiloto = " manter";
		$manterInscrito = "";
		$mantervalor = $pilotoBean->getnome ();
	} else {
		$manterPiloto = "";
		$manterInscrito = " manter";
		$mantervalor = $inscritoBean->getnome ();
	}
	?>
			<input type="hidden" id="nome" name="nome"
			value="<?php echo $mantervalor;?>">
		</TD>
		<TD><INPUT size="30" type="text" id="nomeInscrito" name="nomeInscrito"
			grupo="nome" class="GPnome camposOp<?php echo  $manterInscrito;?>"
			value="<?php echo $inscritoBean->getnome();?>"></TD>
		<TD><INPUT size="30" type="text" id="nomePiloto" name="nomePiloto"
			grupo="nome" class="GPnome camposOp<?php echo  $manterPiloto;?>"
			value="<?php echo $pilotoBean->getnome();?>"></TD>
	</TR>
	<TR>
		<TD>
			Apelido
			<?php
	if ($inscritoBean->getapelido () == '') {
		$manterPiloto = " manter";
		$manterInscrito = "";
		$mantervalor = $pilotoBean->getapelido ();
	} else {
		$manterPiloto = "";
		$manterInscrito = " manter";
		$mantervalor = $inscritoBean->getapelido ();
	}
	?>
			<input type="hidden" id="apelido" name="apelido"
			value="<?php echo $mantervalor;?>">
		</TD>
		<TD><INPUT size="30" type="text" id="apelidoInscrito"
			name="apelidoInscrito" grupo="apelido"
			class="GPapelido camposOp<?php echo  $manterInscrito;?>"
			value="<?php echo $inscritoBean->getapelido();?>"></TD>
		<TD><INPUT size="30" type="text" id="apelidoPiloto"
			name="apelidoPiloto" grupo="apelido"
			class="GPapelido camposOp<?php echo  $manterPiloto;?>"
			value="<?php echo $pilotoBean->getapelido();?>"></TD>
	</TR>
	<TR>
		<TD>
			Telefone
			<?php
	if ($inscritoBean->gettelefone () == '') {
		$manterPiloto = " manter";
		$manterInscrito = "";
		$mantervalor = $pilotoBean->gettelefone ();
	} else {
		$manterPiloto = "";
		$manterInscrito = " manter";
		$mantervalor = $inscritoBean->gettelefone ();
	}
	?>
			
			<input type="hidden" id="telefone" name="telefone"
			value="<?php echo $mantervalor;?>">
		</TD>
		<TD><INPUT size="30" type="text" id="telefoneInscrito"
			name="telefoneInscrito" grupo="telefone"
			class="GPtelefone camposOp<?php echo  $manterInscrito;?>"
			value="<?php echo $inscritoBean->gettelefone();?>"></TD>
		<TD><INPUT size="30" type="text" id="telefonePiloto"
			name="telefonePiloto" grupo="telefone"
			class="GPtelefone camposOp<?php echo  $manterPiloto;?>"
			value="<?php echo $pilotoBean->gettelefone();?>"></TD>
	</TR>
	<TR>
		<TD>
			Email
			<?php
	if ($inscritoBean->getemail () == '') {
		$manterPiloto = " manter";
		$manterInscrito = "";
		$mantervalor = $pilotoBean->getemail ();
	} else {
		$manterPiloto = "";
		$manterInscrito = " manter";
		$mantervalor = $inscritoBean->getemail ();
	}
	?>
			<input type="hidden" id="email" name="email"
			value="<?php echo $mantervalor;?>">
		</TD>
		<TD><INPUT size="30" type="text" id="emailInscrito"
			name="emailInscrito" grupo="email"
			class="GPemail camposOp<?php echo  $manterInscrito;?>"
			value="<?php echo $inscritoBean->getemail();?>"></TD>
		<TD><INPUT size="30" type="text" id="emailPiloto" name="emailPiloto"
			grupo="email" class="GPemail camposOp<?php echo  $manterPiloto;?>"
			value="<?php echo $pilotoBean->getemail();?>"></TD>
	</TR>
	<script>
$(document).ready(function() {
  $("#dtnascimento").mask("99/99/9999");
  
});
</script>
	<TR>
		<TD>
			Data de nascimento
			<?php
	if ($inscritoBean->getdtnascimento () == '') {
		$manterPiloto = " manter";
		$manterInscrito = "";
		$mantervalor = $pilotoBean->getdtnascimento ();
	} else {
		$manterPiloto = "";
		$manterInscrito = " manter";
		$mantervalor = $inscritoBean->getdtnascimento ();
	}
	?>
			<input type="hidden" id="dtnascimento" name="dtnascimento"
			value="<?php echo  Util::timestamptostr('d/m/Y',$mantervalor);?>">
		</TD>
		<TD><INPUT size="30" type="text" id="dtnascimentoInscrito"
			name="dtnascimentoInscrito" grupo="dtnascimento"
			class="GPdtnascimento camposOp<?php echo  $manterInscrito;?>"
			value="<?php echo  Util::timestamptostr('d/m/Y',$inscritoBean->getdtnascimento());?>">
		</TD>
		<TD><INPUT size="30" type="text" id="dtnascimentoPiloto"
			name="dtnascimentoPiloto" grupo="dtnascimento"
			class="GPdtnascimento camposOp<?php echo  $manterPiloto;?>"
			value="<?php echo  Util::timestamptostr('d/m/Y',$pilotoBean->getdtnascimento());?>">
		</TD>
	</TR>
	<TR>
		<TD>
			Peso
			<?php
	if ($inscritoBean->getpeso () == '') {
		$manterPiloto = " manter";
		$manterInscrito = "";
		$mantervalor = $pilotoBean->getpeso ();
	} else {
		$manterPiloto = "";
		$manterInscrito = " manter";
		$mantervalor = $inscritoBean->getpeso ();
	}
	?>
			<input type="hidden" id="peso" name="peso"
			value="<?php echo $mantervalor;?>">
		</TD>
		<TD><INPUT size="30" type="text" id="pesoInscrito" name="pesoInscrito"
			grupo="peso" class="GPpeso camposOp<?php echo  $manterInscrito;?>"
			value="<?php echo $inscritoBean->getpeso();?>"></TD>
		<TD><INPUT size="30" type="text" id="pesoPiloto" name="pesoPiloto"
			grupo="peso" class="GPpeso camposOp<?php echo  $manterPiloto;?>"
			value="<?php echo $pilotoBean->getpeso();?>"></TD>
	</TR>


	<TR>
		<TD colspan="2"><?php echo isset($mensagem)?$mensagem:''; ?></TD>
	</TR>
	<TR>
		<TD colspan="2"><?php
	echo $button->btSalvar ( $idobj, $idurl );
	echo $button->btVoltar ( $idurl );
	?></TD>
	</TR>
</TABLE>

<?php }?>
