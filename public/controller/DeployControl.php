<?php
include_once PATHPUBFAC . '/HZip.php';
$dbg = 1;

$filename1 = 'kart.zip';
$filename2 = 'public.zip';
$localPath1 = 'mvc\kart';
$localPath2 = 'mvc\public';

$remotePath = '/public_html/kart/';

Util::echobr ( $dbg, 'DeployControl HTTP_HOST', $_SERVER ['HTTP_HOST'] );
if ($_SERVER ['HTTP_HOST'] == '127.0.0.1:4001') {
	
	HZip::zipDir ( $localPath1, $filename1 );
	Util::echobr ( $dbg, 'DeployControl $localPath1 $filename1', $localPath1 . " " . $filename1 );
	HZip::zipDir ( $localPath2, $filename2 );
	Util::echobr ( $dbg, 'DeployControl  $localPath2 $filename2', $localPath2 . " " . $filename2 );
	
	sendFTPfile ( $remotePath, $filename1 );
	sendFTPfile ( $remotePath, $filename2 );
} else {
	Util::echobr ( $dbg, 'DeployControl start unzip ', 2 );
	
	// $dirName = '/public_html/kart/teste';
	$dirName = 'teste';
	Util::echobr ( $dbg, 'DeployControl unzip $dirName', $dirName );
	HZip::unZip ( $filename1, $dirName );
	Util::echobr ( $dbg, 'DeployControl unzip $filename1', $filename1 );
}
$urlC = LISTAR;
include (PATHPUBPHP . '/' . $beanPaginaAtual->geturl () . $urlC . '.php');
function sendFTPfile($remotePath, $filename) {
	$ftp_server = "ftp.engecar-rs.com.br";
	$ftp_user_name = "engecar";
	$ftp_user_pass = "efz4a5s8a6zxs";
	
	$remote_file = $remotePath . $filename;
	
	// set up basic connection
	$conn_id = ftp_connect ( $ftp_server );
	Util::echobr ( $dbg, 'DeployControl  ftp_connect ok', 1 );
	
	// login with username and password
	$login_result = ftp_login ( $conn_id, $ftp_user_name, $ftp_user_pass );
	Util::echobr ( $dbg, 'DeployControl  ftp_login ok', 1 );
	
	// upload a file
	if (ftp_put ( $conn_id, $remote_file, $filename, FTP_ASCII )) {
		echo "successfully uploaded $filename\n<br>";
		// exit;
	} else {
		echo "There was a problem while uploading $filename\n<br>";
		// exit;
	}
	// close the connection
	ftp_close ( $conn_id );
}

exit ();
?>