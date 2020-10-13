<?php 
$databaseHost = 'localhost';
$databaseName = 'siakad_sttp';
$databaseUsername = 'root';
$databasePassword = '';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
$result = mysqli_query($mysqli, "SELECT * FROM test ORDER BY id DESC");
while($user_data = mysqli_fetch_array($result)) {
	$id=$user_data['id'];
	mysqli_query($mysqli, "DELETE FROM test WHERE id=$id");
	echo "deleted id ".$id.'.';
}
// for ($i=0; $i <= 99999 ; $i++) { 
// 	$result = mysqli_query($mysqli, "INSERT INTO test(name) VALUES('nama".$i."')");
// 	echo mysqli_insert_id($mysqli).'.';
// }
?>