<tr>
<td valign="top" style='height:28.0pt;text-align:center;' colspan="9">
<p class="MsoNormal" align="center" style='font-size:12.0pt;'><?php echo $nome;
//Jos&eacute; Roberto Pasqualete Junior?></p>
</td>
</tr>
<tr>
	<?php
	$dbg=false; 
	$totalrazao = 0;
	for($x = 0;$x<9;$x++){
		$widthCol = $cols[$x]*$razao;?>
	<td style='width:<?php echo $widthCol; ?>pt;<?php echo ($dbg)?"border-color:black;border-style:solid;border-width:1px;":"";?>'>&nbsp;
	<?php if($dbg){
	$totalrazao = $totalrazao+$cols[$x];?>
	<small><small><small><?php echo $widthCol. ' # '.$cols[$x].(($x>=8)?" = ".$totalrazao:"");?></small></small></small>
	<?php }?>
	</td>
	<?php }?>		
</tr>
