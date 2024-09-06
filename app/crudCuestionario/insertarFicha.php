<?php

session_start();

require "../funciones.php";

try{
  $link = conectar();
  $idAsp = getIDByUser($_SESSION['usuario']);

  // Inserción en la tabla fichapersonal
  $sql = "INSERT INTO fichapersonal
              (
              Nombre,
              Apellido1,
              Apellido2,
              Sexo,
              Nacimiento,
              EstadoCivil,
              NivelEstudios,
              Ocupacion,
              Ciudad,
              Departamento,
              Estrato,
              Vivienda,
              PersonasACargo,
              Aspirante_idAspirante)
  VALUES (
          '{$_POST['nombre']}',
          '{$_POST['apellido1']}',
          '{$_POST['apellido2']}',
          '{$_POST['sexo']}',
          '{$_POST['nacimiento']}',
          '{$_POST['estadocivil']}',
          '{$_POST['nivel']}',
          '{$_POST['ocupacion']}',
          '{$_POST['ciudadR']}',
          '{$_POST['departamentoR']}',
          '{$_POST['estrato']}',
          '{$_POST['tipovivienda']}',
          '{$_POST['personas']}',
          '$idAsp')";

  $link->query($sql);

  // Determinar el tipo de cargo
  $a = $_POST['tipocargo'];

  if (strpos($a, 'Jefatura') !== false) {
      $_SESSION['cargo'] = 'jefe';
  }

  // Inserción en la tabla fichatrabajo
  $sql = "INSERT INTO fichatrabajo
              (
              Ciudad,
              Departamento,
              Tiempo,
              Cargo,
              TipoCargo,
              TiempoCargo,
              TipoContrato,
              HorasTrabajo,
              TipoSalario,
              Area_idArea,
              Aspirante_idAspirante)
  VALUES (
          '{$_POST['ciudadT']}',
          '{$_POST['departamentoT']}',
          '{$_POST['tiempoT']}',
          '{$_POST['cargo']}',
          '{$_POST['tipocargo']}',
          '{$_POST['tiempocargo']}',
          '{$_POST['tipocontrato']}',
          '{$_POST['horas']}',
          '{$_POST['tiposalario']}',
          '{$_POST['area']}',
          '$idAsp')";

  $link->query($sql);

  header("Location: ../pruebas.php?estado=guardado");
}catch(Exception $e){
  echo $e->getMessage();
  exit;
}

