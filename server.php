<?php
session_start();


$username = "";


$errors = array(); 
$db = mysqli_connect('localhost', 'admin', 'admin', 'cisco');

if (isset($_POST['sing_doc'])) {
  $id = mysqli_real_escape_string($db, $_POST['id']);
  $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
  $apellido = mysqli_real_escape_string($db, $_POST['apellido']);
  $contraseña = mysqli_real_escape_string($db, $_POST['contraseña']);
  $contraseña_2 = mysqli_real_escape_string($db, $_POST['contraseña_2']);
  
  if (empty($id)) { array_push($errors, "No ha ingresado id valido"); }
  if (empty($nombre)) { array_push($errors, "Es necesario ingresar un nombre"); }
  if (empty($apellido)) { array_push($errors, "Es necesario ingresar un apellido"); }
  if (empty($contraseña)) { array_push($errors, "No ha ingresado una contraseña valida"); }
  if ($contraseña != $contraseña_2) {
	array_push($errors, "La contraseña no concuerda");
  }

  $user_check_query = "SELECT * FROM docente WHERE id='$id' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) {
    if ($user['id'] === $id) {
      array_push($errors, "Id ya existente");
    }
  }
  if (count($errors) == 0) {
  	$password = md5($contraseña);
  	$stmt = $db->prepare("INSERT INTO docente (id, nombre, apellido, contraseña) VALUES(?, ?, ?, ?)");
    $stmt->bind_param("ssss", $ce, $un, $do, $tr);
    $ce = $id;
    $un = $nombre;
    $do = $apellido;
    $tr = $pass;
    $stmt->execute();
  	$_SESSION['username'] = $id;
  	$_SESSION['success'] = "Has iniciado sesión";
  	header('location: index.php');
  }
}
if (isset($_POST['sing_alum'])) {
    $mat = mysqli_real_escape_string($db, $_POST['matricula']);
    $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($db, $_POST['apellido']);
    $doc = mysqli_real_escape_string($db, $_POST['doc']);
    $contraseña = mysqli_real_escape_string($db, $_POST['contraseña']);
    $contraseña_2 = mysqli_real_escape_string($db, $_POST['contraseña_2']);
  
    if (empty($id)) { array_push($errors, "No ha ingresado id valido"); }
    if (empty($nombre)) { array_push($errors, "Es necesario ingresar un nombre"); }
    if (empty($apellido)) { array_push($errors, "Es necesario ingresar un apellido"); }
    if (empty($doc)) { array_push($errors, "Es necesario id de docente"); }
    if (empty($contraseña)) { array_push($errors, "No ha ingresado una contraseña valida"); }
    if ($contraseña != $contraseña_2) {
    array_push($errors, "La contraseña no concuerda");
    }
  
    $user_check_query = "SELECT * FROM alumnos WHERE mat='$mat' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    
    if ($user) {
      if ($user['mat'] === $mat) {
        array_push($errors, "Id ya existente");
      }
    }

  	$q_doc_check = "SELECT * FROM alumnos WHERE doc='$doc'";
  	$results = mysqli_query($db, $q_doc_check);
  	if (mysqli_num_rows($results) == 0) {
      array_push($errors, "Id de docente no valido");
    }
  
    if (count($errors) == 0) {
      $password = md5($contraseña);
      $stmt = $db->prepare("INSERT INTO alumnos (mat, nombre, apellido, doc, contraseña) VALUES(?, ?, ?, ?, ?)");
      $stmt->execute(array($id, $nombre, $apellido, $password));
      $_SESSION['username'] = $mat;
      $_SESSION['success'] = "Has iniciado sesión";
      header('location: index.php');
    }
}

if (isset($_POST['login_doc'])) {
  $id = mysqli_real_escape_string($db, $_POST['id']);
  $contraseña = mysqli_real_escape_string($db, $_POST['contraseña']);

  if (empty($id)) {
  	array_push($errors, "No has ingresado tu ID");
  }
  if (empty($contraseña)) {
  	array_push($errors, "No has ingresado tu contraseña");
  }

  if (count($errors) == 0) {
  	$password = md5($contraseña);
  	$query = "SELECT * FROM docente WHERE id='$id' AND contraseña='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $id;
  	  $_SESSION['success'] = "Has iniciado sesión";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Credenciales incorrectas");
  	}
  }
}
if (isset($_POST['login_alum'])) {
  $mat = mysqli_real_escape_string($db, $_POST['matricula']);
  $contraseña = mysqli_real_escape_string($db, $_POST['contraseña']);

  if (empty($mat)) {
  	array_push($errors, "No has ingresado tu matricula");
  }
  if (empty($contraseña)) {
  	array_push($errors, "No has ingresado tu contraseña");
  }

  if (count($errors) == 0) {
  	$password = md5($contraseña);
  	$query = "SELECT * FROM alumnos WHERE mat='$mat' AND contraseña='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $mat;
  	  $_SESSION['success'] = "Has iniciado sesión";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Credenciales incorrectas");
  	}
  }
}
?>