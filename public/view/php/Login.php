<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Quera Apps</title>
<link rel="stylesheet" href="<?php echo URLPUBCSS;?>/default.css" />
<link rel="stylesheet" href="<?php echo URLPUBCSS;?>/menu.css" />
<script src="<?php echo URLPUBJS;?>/jquery.js"></script>
<script src="<?php echo URLPUBJS;?>/form.js"></script>
</head>
<body>

	<div id="headerPage"><? echo $tituloApp;
	                    ?><?php echo (
								strrpos($_SERVER['HTTP_HOST'],'127.0.0.1') > -1 ||
								strrpos($_SERVER['HTTP_HOST'],'localhost') > -1
					)?" - <small>[Desenvolvimento]</small>":"";
	
					if(isset($_GET['XDEBUG_SESSION_START'])){
					    echo " - <small>[". PRJROOT ."]</small>";
					}
					
					?>
					
					</div>
	<div class="content">
		<form action="" method="post" name="formautentica"
			id="formautentica">
			<INPUT id="idu" name="idu" type="hidden" value="0" /> <INPUT
				id="idurl" name="idurl" type="hidden" value="0" />
				<?php echo (isset($mensagem))?$mensagem:"";?>
				<div class="fieldset">
				<label id="lbuser"> Usuario </label><br> <input id="user"
					name="user" value="" type="text" />
			</div>
			<div class="fieldset">
				<label id="lbsenha"> Senha </label><br> <input id="senha"
					name="senha" type="password" />
			</div>
			<input id="btnlogin" name="btnlogin" type="submit" value="Entrar" />
		</form>

		<script>
            //App custom javascript
            document.getElementById('user').focus();
        </script>
	</div>

<?php

if(defined ( 'ADMIN' )){


$path = PATHAPPVER;
$GLOBALS['maxDate'] = 0;

function recursive_list($path) {
	$obj_rdi = new RecursiveDirectoryIterator($path);
	$files = array();
	foreach ($obj_rdi as $file) {
		if ('.' != $file->getFilename() && '..' != $file->getFilename()) {
			if ($file->isDir()) {
				$files[$file->getFilename()] = recursive_list($file->getPathname());
			} else {
				$datafile = date("YmdHis",filemtime($file->getFilename()));
				//echo $GLOBALS['maxDate']." < $datafile <br>";
				if( $GLOBALS['maxDate'] < $datafile){
					$GLOBALS['maxDate'] = $datafile;
				}
				$files[] = $file->getFilename();
			}
		}
	}

	return $files;
}
recursive_list($path);

//print_r(recursive_list($path));
?>
<div style="font-size:10px;padding:5px;">
<?php
if(ADMIN)
    echo " ".PRJROOT." - ";
echo $GLOBALS['maxDate'];
//echo "<br>".PATHAPPVER;
?>
</div>
<?php
}
?>
<span style="position: absolute; bottom: 1px;font-size: 6pt;">
BUILDNUMBER:
<?php include PATHAPP."/release.id";?>
</span>
</body>
</html>
