<?php 
$dbhost='localhost';
$dbname='tangail_city';
$dbuser='root';
$dbpass='';
try{
$db=new PDO("mysql:host={$dbhost};dbname={$dbname}",$dbuser,$dbpass);
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOExecption $e){

echo"Connection Error..".$e->getMessage;

}

?>