<?php
include_once PATHPUBPHPINCLUDE . '/headerList.php';
?>

<br>
Sem acumular pontos
<input id="semAcumular" name="semAcumular" type="checkbox"
value="1" <?php echo ($semAcumular=="1")?"checked":""; ?>
/>
Inverter Colunas
<input id="inverterColunas" name="inverterColunas" type="checkbox"
value="1" <?php echo ($inverterColunas=="1")?"checked":""; ?>
/>

<table class="listTable" cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr>
			<th class="headerlink">&nbsp;</th> 
			<th class="headerlink">&nbsp;</th> 
			<?php 
			
			$max = count($collectionPartidas)*10;
			foreach ($collectionPartidas as &$partida)  {?>
			<th class="header"><?php echo $partida->getnome();?>
			<?php echo $partida->getpeso();?></th>
			<?php } ?>
		</tr>
	</thead>

	<tbody>
	<?php
	$strings = array();
	foreach ($collection as &$apostadores) {
		$corlinha = ($i % 2 == 0) ? "par" : "impar";
		?>

		<tr class="<?php echo $corlinha;?>">
    		<td>&nbsp;</td> 
    		
    		<?php $first = true;
    		$string = array();
    		$count=1;
    		foreach ($apostadores as &$aposta) {
    		    if($first){
    		        $first=false;
        		?>
                	<td>
            			<?php echo $aposta->getnome();?>
            		</td>
            			
        		
        		<?php 
        		}
        		?>    
    		<td>
    			<?php 
    			if($semAcumular==0){
    				echo $aposta->getpontoacumulado();
				}else{
					echo $aposta->getpontos();
    			}			
    			$string[]="[\"".$aposta->getpartida()->getdtpartida()."\",".$aposta->getpontos()."]";
    			$count++;?>    			
    	    </td>
    		<?php 
    		}
    		$strings[] ="[".implode(",",$string)."]";
    		?>
		</tr>
	<?php }?>
  </tbody>
</table>
<div id="chart1" style="height:600px;width:1000px; "></div>
<script>
//$.jqplot('chartdiv',  [<?php echo $strings[0];?>],//[[1, 2],[3,5.12],[5,13.1],[7,33.6],[9,85.9],[11,219.9]]],
	$.jqplot._noToImageButton = true;
	<?php
	$a=0;
	$arraynomes = array();
	foreach ($collectionApostadores as &$apostador) {
	    echo "var ".str_ireplace(" ","_",$apostador->getnome())." = ".$strings[$a];
	    $arraynomes[] = str_ireplace(" ","_",$apostador->getnome());
	    $a++;
	}?>

	var prevYear = [["2011-08-01",398], ["2011-08-02",255.25], ["2011-08-03",263.9], ["2011-08-04",154.24], 
    ["2011-08-05",210.18], ["2011-08-06",109.73], ["2011-08-07",166.91], ["2011-08-08",330.27], ["2011-08-09",546.6], 
    ["2011-08-10",260.5], ["2011-08-11",330.34], ["2011-08-12",464.32], ["2011-08-13",432.13], ["2011-08-14",197.78], 
    ["2011-08-15",311.93], ["2011-08-16",650.02], ["2011-08-17",486.13], ["2011-08-18",330.99], ["2011-08-19",504.33], 
    ["2011-08-20",773.12], ["2011-08-21",296.5], ["2011-08-22",280.13], ["2011-08-23",428.9], ["2011-08-24",469.75], 
    ["2011-08-25",628.07], ["2011-08-26",516.5], ["2011-08-27",405.81], ["2011-08-28",367.5], ["2011-08-29",492.68], 
    ["2011-08-30",700.79], ["2011-08-31",588.5], ["2011-09-01",511.83], ["2011-09-02",721.15], ["2011-09-03",649.62], 
    ["2011-09-04",653.14], ["2011-09-06",900.31], ["2011-09-07",803.59], ["2011-09-08",851.19], ["2011-09-09",2059.24], 
    ["2011-09-10",994.05], ["2011-09-11",742.95], ["2011-09-12",1340.98], ["2011-09-13",839.78], ["2011-09-14",1769.21], 
    ["2011-09-15",1559.01], ["2011-09-16",2099.49], ["2011-09-17",1510.22], ["2011-09-18",1691.72], 
    ["2011-09-19",1074.45], ["2011-09-20",1529.41], ["2011-09-21",1876.44], ["2011-09-22",1986.02], 
    ["2011-09-23",1461.91], ["2011-09-24",1460.3], ["2011-09-25",1392.96], ["2011-09-26",2164.85], 
    ["2011-09-27",1746.86], ["2011-09-28",2220.28], ["2011-09-29",2617.91], ["2011-09-30",3236.63]];
 
    var currYear = [["2011-08-01",796.01], ["2011-08-02",510.5], ["2011-08-03",527.8], ["2011-08-04",308.48], 
    ["2011-08-05",420.36], ["2011-08-06",219.47], ["2011-08-07",333.82], ["2011-08-08",660.55], ["2011-08-09",1093.19], 
    ["2011-08-10",521], ["2011-08-11",660.68], ["2011-08-12",928.65], ["2011-08-13",864.26], ["2011-08-14",395.55], 
    ["2011-08-15",623.86], ["2011-08-16",1300.05], ["2011-08-17",972.25], ["2011-08-18",661.98], ["2011-08-19",1008.67], 
    ["2011-08-20",1546.23], ["2011-08-21",593], ["2011-08-22",560.25], ["2011-08-23",857.8], ["2011-08-24",939.5], 
    ["2011-08-25",1256.14], ["2011-08-26",1033.01], ["2011-08-27",811.63], ["2011-08-28",735.01], ["2011-08-29",985.35], 
    ["2011-08-30",1401.58], ["2011-08-31",1177], ["2011-09-01",1023.66], ["2011-09-02",1442.31], ["2011-09-03",1299.24], 
    ["2011-09-04",1306.29], ["2011-09-06",1800.62], ["2011-09-07",1607.18], ["2011-09-08",1702.38], 
    ["2011-09-09",4118.48], ["2011-09-10",1988.11], ["2011-09-11",1485.89], ["2011-09-12",2681.97], 
    ["2011-09-13",1679.56], ["2011-09-14",3538.43], ["2011-09-15",3118.01], ["2011-09-16",4198.97], 
    ["2011-09-17",3020.44], ["2011-09-18",3383.45], ["2011-09-19",2148.91], ["2011-09-20",3058.82], 
    ["2011-09-21",3752.88], ["2011-09-22",3972.03], ["2011-09-23",2923.82], ["2011-09-24",2920.59], 
    ["2011-09-25",2785.93], ["2011-09-26",4329.7], ["2011-09-27",3493.72], ["2011-09-28",4440.55], 
    ["2011-09-29",5235.81], ["2011-09-30",6473.25]];
 
    var plot1 = $.jqplot("chart1", [<?php echo implode(",", $arraynomes)?>], {
        seriesColors: ["rgba(78, 135, 194, 0.7)", "rgb(211, 235, 59)"],
        title: 'Rank',
        highlighter: {
            show: true,
            sizeAdjust: 1,
            tooltipOffset: 9
        },
        grid: {
            background: 'rgba(57,57,57,0.0)',
            drawBorder: false,
            shadow: false,
            gridLineColor: '#666666',
            gridLineWidth: 2
        },
        legend: {
            show: true,
            placement: 'outside'
        },
        seriesDefaults: {
            rendererOptions: {
                smooth: true,
                animation: {
                    show: true
                }
            },
            showMarker: false
        },
        series: [
	    <?php 
	    $label = array();
	    foreach ($collectionApostadores as &$apostador) {
	        $label[] = "{ label: '".$apostador->getnome()."' }";
	    }
	    ?>
            <?php echo implode(", ",$pessoas)?>
        ],
        axesDefaults: {
            rendererOptions: {
                baselineWidth: 1.5,
                baselineColor: '#444444',
                drawBaseline: false
            }
        },
        axes: {
            xaxis: {
                renderer: $.jqplot.DateAxisRenderer,
                tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                tickOptions: {
                    formatString: "%b %e",
                    angle: -30,
                    textColor: '#dddddd'
                },
               /* min: "2011-08-01",
                max: "2011-09-30",
                tickInterval: "7 days",*/
                drawMajorGridlines: false
            },
            yaxis: {
                renderer: $.jqplot.LogAxisRenderer,
                pad: 0,
                rendererOptions: {
                    minorTicks: 1
                },
                tickOptions: {
                    formatString: "$%'d",
                    showMark: false
                }
            }
        }
    });
 
      $('.jqplot-highlighter-tooltip').addClass('ui-corner-all')

</script>

 
