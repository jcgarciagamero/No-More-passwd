<?php
session_start();
if($_SESSION["loggedin"] == false)
{
  header('Location: index.html');
}

else {
print("Enhorabuena has completado el proceso");}