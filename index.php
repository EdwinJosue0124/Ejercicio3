
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Recursos/estilos.css">
    <title>Calificaciones de alumnos</title>

</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
<label for="">Ingrese el numero de alumnos </label>
  <input type="number" name="cantidad" min="0" require>
  <input type="submit" value="Generar" name="generar">

</form>
<br>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
  <h1>Ingresos da datos</h1>
  <?php if(isset($_POST['generar'])) {?>
  <?php for($i=1;$i<=$_POST['cantidad'];$i++) {?>
  <label for="">Carnet: </label>
  <input type="text" name="carnet[]" require >
  <label for="">Nombre del alumno:  </label>
  <input type="text" name="nombre[]" require>
  <label for="">Nota 1: </label>
  <input type="text" name="n1[]"  require >
  <label for="">Nota 2: </label>
  <input type="text" name="n2[]"  require>
  <label for="">Nota 3: </label>
  <input type="text" name="n3[]"  require>
  <input type="hidden" name="num" value="<?php echo $_POST['cantidad']; ?>">
  <br><br>
  <br><br>
  <?php }?>
  <?php }?>
  <input type="submit" value="Guardar" name="submit">
</form>

<?php
    if(isset($_POST['submit'])){
      $carnet=$_POST['carnet'];
      $nombre=$_POST['nombre'];
      $nota1=$_POST['n1'];
      $nota2=$_POST['n2'];
      $nota3=$_POST['n3'];
      $numero=$_POST['num'];
      $con=0;
      $con1=0;
      $aprobados=0;
      $reprobados=0;
      $mayorP=null;
      $menorP=null;
      $mejorA=null;
      $peorA=null;

     

      $estudiante=array("carnet"=>$carnet,"nombre"=>$nombre,"nota1"=>$nota1,"nota2"=>$nota2,"nota3"=>$nota3);
      echo "<br><br><br><br><table> <thead><tr><th>Carnet</th><th>Nombre</th><th>Nota promedio</th><th>Estado</th></tr></thead>";
      for($i=0;$i<$numero;$i++){
      $promedio[$i]=($nota1[$i]+$nota2[$i]+$nota3[$i])/3;

      if($promedio[$i]>=6.5)
      {
        echo "<tr><td>{$carnet[$i]}</td><td>{$nombre[$i]}</td>
        <td class=nota>{$promedio[$i]}</td><td>Aprobado</td></tr>";        
        ++$con;
        
      }
      else{
        echo "<tr><td>{$carnet[$i]}</td><td>{$nombre[$i]}</td>
        <td class=nota>{$promedio[$i]}</td><td>Reprobado</td></tr>"; 
        ++$con1;
        
      }
      
      if($promedio[$i]>$mayorP){
        $mayorP=$promedio[$i];
        $mejorA=$nombre[$i];
      }
      else{
          $menorP=$promedio[$i];
          $peorA=$nombre[$i];
      }
    }
    $aprobados=($con/$numero)*100;
    $reprobados=($con1/$numero)*100;
    echo "<tr><td colspan=4 class=Segtitulo>Porcentaje de alumnos aprobados</td></tr>";
    echo "<tr><td colspan=4 class=info>$aprobados%</td></tr>";

    echo "<tr><td colspan=4 class=Segtitulo>Porcentaje de alumnos reprobados</td></tr>";
    echo "<tr><td colspan=4 class=info>$reprobados%</td></tr>";

    echo "<tr><td colspan=4 class=Segtitulo>Alumno con la mayor nota promedio</td></tr>";
    echo "<tr><td colspan=2 class=info>$mejorA</td><td colspan=2 class=info>$mayorP</td></tr>";

    echo "<tr><td colspan=4 class=Segtitulo>Alumno con la menor nota promedio</td></tr>";
    echo "<tr><td colspan=2 class=info>$peorA</td><td colspan=2 class=info>$menorP</td></tr>";

    echo "</table> <br><br>";


  }

?>

</body>
</html>