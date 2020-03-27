<?php
// $con = mysql_connect("localhost","c420","*nc$spWQ");
$query = file_get_contents ( "dbfiles/001.DROP CREATE TABLE.SQL" );
roda ( $query );

echo "<br><br>";
$query = file_get_contents ( "dbfiles/004.INSERTS BASICOS.sql" );
roda ( $query );
function roda($query) {
	$con = mysql_connect ( "localhost", "root", "" );
	if (! $con) {
		die ( 'Could not connect: ' . mysql_error () );
	}
	
	mysql_select_db ( "c420", $con );
	
	$result = mysql_query ( $query );
	print_r ( $result );
	
	mysql_close ( $con );
}
?>