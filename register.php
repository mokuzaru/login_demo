<?php
  //Conexion al servidor
  $conec = mysqli_connect('localhost', 'root','','test');
  //ocultar de vista (encriptar l introducido en el input)
  $user = strip_tags ($_POST ['user'],'<br>');
  //no permitir el ingreso de otras variables al input
  $mail = strip_tags ($_POST ['mail'],'<br>');
  //sha1 es un tipo de encriptación para password
  $password = sha1 ( strip_tags ($_POST ['password'],'<br>'));
  //Guardar la password para luego medirla
  $password_paramedir = strip_tags ($_POST ['password'],'<br>');
  //Calcular el largo del password
  $tamaño = strlen($password_paramedir);
  //Formato de fecha
  $hoy = date ( "Y-m-d H:i:s");
  //Verificar si el password tiene el tamaño minimo
  if ($tamaño<8) {
    echo "Hey! la tienes corta, que al menos tenga 8 caracteres";
    die ();
  }
  //Encriptar a nivel sha1 la repeticion de password
  $r_password = sha1 (strip_tags ( $_POST ['r_password'],'<br>'));
  //aceptación de terminos y condiciones
  $acuerdo = isset ($_POST ['terms']);
  // Si alguno esta vacio..
  if ($user == NULL || $mail == NULL ||$password == NULL || $r_password == NULL) {
    echo "No puede haber espacios vacios";
    die();
  }
  //Verficar si aceptaste los terminos y condiciones
  if ($acuerdo == NULL) {
    echo "Si no estas de acuerdo, no puedes hacer nada :)";
    die();
  }
  //Leer si el usuario ingresado se encuentra en la base de datos
  $query = @mysqli_query ($conec, "SELECT `user` FROM `users` WHERE `user` = '$user'");
  $row = mysqli_fetch_array ($query);
  //Verificar si el nombre de usuario ingresado ya se encuentra en la base de datos
  if ($row [0] == $user) {
    echo "Hey! Sorry pero ese usuario ya existe, escribe otro.";
    die();
  } else {
    $query = @mysqli_query ($conec, "SELECT `mail` FROM `users` WHERE `mail` = '$mail'");
    $row = mysqli_fetch_array ($query);
    //Verificar si el mail ya fue usado en la creacion de otro usuario en la base de datos
    if  ($row [0] == $mail)  {
      echo "Ya existe un usuario con ese mail";
      die();
    } else {
      //Verificar si las contraseñas estan bien escritas
      if  ($password != $r_password)  {
        echo "Los contraseñas no coinciden!";
        die();
      } else {
        //Debugear las variables ingresadas
        echo $hoy;
        echo "<br>";
        echo $user;
        echo "<br>";
        echo $password;
        echo "<br>";
        echo $mail;
        //Enviar los datos al servidor
        $query = @mysqli_query($conec, "INSERT INTO `users` (`id`, `fecha`, `user`, `password`, `mail`) VALUES (NULL, '$hoy', '$user','$password','$mail')");
        //Enviar un mail de confirmación
        $para = $mail;
        $titulo = "Bienvenido a la plataforma Idspanda";
        $mensaje = 'Hola, "' . $user . 'tu usuario es: ' . $user . ' ya puedes ingresar al sistema.';
        $cabeceras = 'From: kenny.otoya@mokuzaru.com' . "\r\n" . phpVersion();
        mail ( $para, $titulo, $mensaje, $cabeceras);

        //Debug de confirmación
        echo "registrado";
        echo "<br>";
        echo "mail enviado";
      }
    }

  }
?>
