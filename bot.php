<?php


$botToken = "";
$website = "https://api.telegram.org/bot".$botToken;
$content = file_get_contents("php://input");
$update = json_decode($content, TRUE);
$message = $update["message"];
$chatId = $message["chat"]["id"];
$mensaje = $message["text"];

$host_db = "";
$user_db = "";
$pass_db = "";
$db_name = "";

$conexion = new mysqli($host_db, $user_db,  $pass_db);
mysqli_select_db($conexion, $db_name); 

$query8= "SELECT chatid, usuario FROM bot where chatid = '$chatId'";
$resultado8 = mysqli_query($conexion, $query8);
$rows8=mysqli_fetch_array($resultado8);
$bot = $rows8[0];  
$us = $rows8[1];




if( $mensaje == "/start" and $bot == $chatId ){	
	$content = "Tu id ya está registrado en nuestra base de datos. Para solicitar un nuevo código de acceso introduce NUEVO";
	file_get_contents($website."/sendmessage?parse_mode=Markdown&chat_id=" . $chatId . "&text=" . urlencode($content) );
}

else if( $mensaje == "NUEVO" and $bot == $chatId ){	
		$num_caracteres = "10"; // asignamos el número de caracteres que va a tener la nueva contraseña 
        $nueva_clave = substr(md5(rand()),0,$num_caracteres);
        $content = "Tu nueva clave de acceso es: ".$nueva_clave;
        file_get_contents($website."/sendmessage?parse_mode=Markdown&chat_id=" . $chatId . "&text=" . urlencode($content) );
        $conected = new mysqli($host_db, $user_db, $pass_db) or die(mysqli_error());
		mysqli_select_db($conected, $db_name); 
		$conexion = "UPDATE bot set password = '$nueva_clave' where chatid = '$chatId'";
		mysqli_query($conected, $conexion) or die(""); 
        
}

else if ($mensaje == "/start" and $bot !== $chatId){
$content = "Bienvenido a No More Passwd. ¿Deseas registrarte como usuario en la plataforma?. Responde SI o NO";
file_get_contents($website."/sendmessage?parse_mode=Markdown&chat_id=" . $chatId . "&text=" . urlencode($content) );}

else if ($mensaje == "SI"){
	$content = "Este es tu ID, necesitamos que copies y vuelvas a pegarlo en el chat, para confirmar la operación: ";
	file_get_contents($website."/sendmessage?parse_mode=Markdown&chat_id=" . $chatId . "&text=" . urlencode($content) );	
	file_get_contents($website."/sendmessage?parse_mode=Markdown&chat_id=" . $chatId . "&text=" . urlencode($chatId) );}

else if ($mensaje == "NO"){
	$content = "Entendido. Nos vemos pronto";
	file_get_contents($website."/sendmessage?parse_mode=Markdown&chat_id=" . $chatId . "&text=" . urlencode($content) );}

else if($mensaje == $chatId){
	
	$conected = new mysqli($host_db, $user_db, $pass_db) or die(mysqli_error());
	mysqli_select_db($conected, $db_name); 
	$conexion = "INSERT INTO bot (chatid) values ('$chatId')";
	mysqli_query($conected, $conexion) or die("");            	
	$content = "Ahora necesitamos que introduzcas tu nombre de usuario.";
	file_get_contents($website."/sendmessage?parse_mode=Markdown&chat_id=" . $chatId . "&text=" . urlencode($content) );

	 

}

else if (($bot == $chatId) and (!empty($mensaje)) and (empty($us))){
	$usuario = hash('sha256', $mensaje);
	$conected = new mysqli($host_db, $user_db, $pass_db) or die(mysqli_error());
		mysqli_select_db($conected, $db_name); 
		$conexion = "UPDATE bot set usuario = '$usuario' where chatid = '$chatId'";
		mysqli_query($conected, $conexion) or die(""); 
			$content = "Su usuario ha sido registrado correctamente.";
	file_get_contents($website."/sendmessage?parse_mode=Markdown&chat_id=" . $chatId . "&text=" . urlencode($content) );
}


else {
	$content = "No has introducido ningún comando que sea capaz de enteder. Introduce SI, si quieres utilizar nuestro sistema. Una web o un correo, si quieres actualizar los datos correspondientes a tu ID";
	file_get_contents($website."/sendmessage?parse_mode=Markdown&chat_id=" . $chatId . "&text=" . urlencode($content) );

}
?>

    




			
	
