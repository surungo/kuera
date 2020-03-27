<?php
include_once PATHPUBFAC . '/Util.php';
include_once PATHAPP . '/mvc/kart/model/business/EtapaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/business/PilotoBateriaBusiness.php';
include_once PATHAPP . '/mvc/kart/model/bean/EtapaBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/PilotoBateriaBean.php';
include_once PATHAPP . '/mvc/kart/model/bean/BateriaBean.php';
class Grid {
	public function MostrarPilotosEtapa($idetapa) {
		$etapaBean = new EtapaBean ();
		$etapaBean->setid ( $idetapa );
		$etapaBusiness = new EtapaBusiness ();
		$pilotoBateriaClt = $etapaBusiness->findPilotos ( $etapaBean );
		
		?>
<table border="1">
	<tr>
		<td>Nr</td>
		<td>Bateria</td>
		<td>Nome</td>
	</tr>
      <?php
		for($i = 0; $i < count ( $pilotoBateriaClt ); $i ++) {
			?>
          <tr>
		<td>
            <?php
			echo $i;
			?>
             </td>
		<td>
            <?php
			echo $pilotoBateriaClt [$i]->getbateria ()->getnome ();
			?>
             </td>
		<td>
            <?php
			echo $pilotoBateriaClt [$i]->getpiloto ()->getnome ();
			?>
             </td>
	</tr>
       <?php
		}
		?>
      </table>

<?php
	}
}
?>