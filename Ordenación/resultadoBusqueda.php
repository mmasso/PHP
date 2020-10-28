<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css.css">
  </style>

</head>

<body>

  <div class="cards">
    <div class="card">
      <h2>Búsqueda binaria con PHP</h2>

      <?php

      $seleccionArray = $_POST['entradaData'];
      $falloInputs = false;
      $value =  $_POST['valueToFind'];

      if ((empty($value) || !is_numeric($value)) && $value !== "0"){
        $falloInputs = true;
        echo "<p> No ha introducido un valor válido en la aplicación </p>";
      }
      if ($seleccionArray == "arrayManual") {
        $arraySinTratar =  $_POST['numeros'];
        $arraySinOrdenar = explode(" ", $arraySinTratar);
        $array = $arraySinOrdenar;
        sort($array);
        $arrayString = implode(", ", $array);
      }
      if ($seleccionArray == "arrayPredefinido") {
        $array = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        $arrayString = implode(", ", $array);
      }
      if ($seleccionArray == "arrayRandom") {
        $arrayLength =  $_POST["longitud"];
        $arraySinOrdenar = randomArray($arrayLength);
        $array = $arraySinOrdenar;
        sort($array);
        $arrayString = implode(", ", $array);
      }
      if ($seleccionArray == "default"){
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


      function busquedaBinaria($array, $value)
      {
        if (empty($array)) {
          return false;
        }

        $principio = 0;
        $fin = count($array);

        while ($principio <= $fin) {
          $valorMedio = floor($principio + $fin) / 2;

          if ($array[$valorMedio] == $value) {
            return true;
          }

          if ($value < $array[$valorMedio]) {
            $fin = $valorMedio - 1;
          } 
          
          else {
            $principio = $valorMedio + 1;
          }
        }
        return false;
      }


      if (busquedaBinaria($array, $value) == true && $falloInputs == false) {
        echo "<p> El valor $value se encuentra en el siguiente array: </p><p> $arrayString </p>";
      } elseif (busquedaBinaria($array, $value) == false && $falloInputs == false) {
        echo "<p> El valor $value NO se encuentra en el siguiente array: </p><p> $arrayString </p>";
      }

      ?>
    </div>
  </div>

</body>

</html>