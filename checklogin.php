
<?php
session_start();
if($_SESSION["loggedin"] == false)
{
  header('Location: ../index.html');
}
?>

<?php

$host_db = "";
$user_db = "";
$pass_db = "";
$db_name = "";
$username = $_POST['username'];
$password = $_POST['password'];
$username = hash('sha256', $username);
$conexion = new mysqli($host_db, $user_db,  $pass_db);
mysqli_select_db($conexion, $db_name); 

$query8= "SELECT password FROM bot where usuario = '$username'";
$resultado8 = mysqli_query($conexion, $query8);
$rows8=mysqli_fetch_array($resultado8);
$pass = $rows8[0];  


if(!empty($password)){

if(!empty($pass)) {   

	if($password === $pass){
	$_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
     $conected = new mysqli($host_db, $user_db,  $pass_db) or die(mysqli_error());
		mysqli_select_db($conected, $db_name); 
		$conexion = "UPDATE bot set password = '' where usuario = '$username'";
		mysqli_query($conected, $conexion) or die("");

    header ("Location: prueba.php");

} else {print("Ha habido algún problema");}

 }

 else {
 	print("Ha habido algún error");
 }}
 else{
 	print("Ha habido algún error");
 }