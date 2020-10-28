<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css.css">
</head>

<body>

  <div class="cards">
    <div class="card">
      <h2>Búsqueda binaria con PHP</h2>

      <?php

      $seleccionArray = $_POST['entradaDataOr'];
      $falloInputs = false;
      $method =  $_POST['entradaOrdenacion'];

      if (empty($method)){
        echo "<p> No ha introducido un valor de ordenación </p>";
        $falloInputs = true;
      }
      if ($seleccionArray == "arrayManualOr") {
        $arraySinTratar =  $_POST['numerosOr'];
        $array = explode(" ", $arraySinTratar);
        $arrayString = implode(", ", $array);
      }
      if ($seleccionArray == "arrayPredefinidoOr") {
        $array = array(1, 5, 3, 7, 8, 6, 2, 70, 9, 10);
        $arrayString = implode(", ", $array);
      }
      if ($seleccionArray == "arrayRandomOr") {
        $arrayLength =  $_POST["longitudOr"];
        $array = randomArray($arrayLength);
        $arrayString = implode(", ", $array);
      }
      if ($seleccionArray == "defaultOr"){
        echo "<p> No ha introducido un parametro válido en la aplicación </p>";
        $falloInputs = true;
      }

      function randomArray($arrayLength)
      {
        $randomArray = array();
        for ($i = 0; $i < $arrayLength; $i++) {
            $x = rand(0, 100);
          $randomArray[$i] = $x;
        }
        return $randomArray;
      }

      function burbuja($A,$n)
      {
          for($i=1;$i<$n;$i++)
          {
                  for($j=0;$j<$n-$i;$j++)
                  {
                          if($A[$j]>$A[$j+1])
                          {$k=$A[$j+1]; $A[$j+1]=$A[$j]; $A[$j]=$k;}
                  }
          }
   
        return $A;
      }

      function insercionDirecta($A,$n)
      {
   
          for ($i = 1; $i < $n; $i++)
          {
                   $v = $A[$i];
                   $j = $i - 1;
                   while ($j >= 0 && $A[$j] > $v)
                   {
                            $A[$j + 1] = $A[$j];
                            $j--;
                   }
   
                   $A[$j + 1] = $v;
          }
   
          return $A;
      }

      echo "hola"


      ?>
    </div>
  </div>

</body>

</html>