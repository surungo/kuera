<!doctype html>
<html lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">

		<title>GRIDS</title>
		
		

<link rel="stylesheet" type="text/css" href="jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="jquery-3.3.1.js"></script>
<script type="text/javascript" charset="utf8" src="jquery.dataTables.min.js"></script>
<style>
	body{
		font-family: Arial, Helvetica, sans-serif;
		background-image: url("img/Fundo.jpg");
		text-align: center;
	}
	.display{
		width:33%;
		padding:1px;
	}
	#tela{
		width: 780px;
	}
	#logo{
		width: 360px;
	}
	#headerc{
		width: 97%;
		padding-bottom: 20px;
	}
	#corpo {
		width:100%;
		
	}	
	#corpo td{
		
		
	}
	.btn{
		border: 4px outset white;
		margin: 5px;
		border-radius : 10px;
	}
	
	h2 {
  		text-shadow: 2px 2px black;
  		color: #eee;
	}
	#patrocinadores{
		width:100%;
		padding-top: 50px;
		background-image: url("patrocinadores.png")>
		
	}
</style>
	</head>
	<body>
	<div id="tela">
<table id="headerc">
    <tr>
		<td colspan="3">
			<img id="logo" src="engecarlogo.png">
		</td>
	</tr>
	<tr>
		<td align="center" colspan="3">
			<h2>GRIDS DAS CATEGORIAS MENU</h2>
		</td>
	</tr>
		<tr>
		<td align="center" colspan="3">
			&nbsp;
		</td>
	</tr>
	<tr>
		<td align="center" colspan="3">
			<h2>02 ETAPA</h2>
		</td>
	</tr>
	<tr>
		<td align="center" class="btn" onclick='window.open("grid.php?f=1&e=2","_BLANK");'>
			<h2>MASTER</h2>
		</td>
		<td align="center" class="btn" onclick='window.open("grid.php?f=2&e=2","_BLANK");'>
			<h2>SPRINTER B</h2>
		</td>
		<td align="center" class="btn" onclick='window.open("grid.php?f=3&e=2","_BLANK");'>	
			<h2>SPRINTER A</h2>
		</td>
	</tr>
</table>
</div>
	</body>
</html>