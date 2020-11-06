<!DOCTYPE html>
<html lang="en">
<!-- @author Mateu Massó Grau -->
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css.css">
  </head>

  <body>

    <div class="cards">
      <div class="card">
        <h2>Ordenación con PHP</h2>

        <?php

        $seleccionArray = $_POST['entradaDataOrdenacion'];
        $method =  $_POST['entradaOrdenacion'];


        if (empty($method)) {
          echo "<p> No ha introducido un valor de ordenación </p>";
        }
        if ($seleccionArray == "arrayManualOr") {
          $arraySinTratar =  $_POST['numerosOr'];
          $array = explode(" ", $arraySinTratar);
        }
        if ($seleccionArray == "arrayPredefinidoOr") {
          $array = array(1, 5, 3, 7, 8, 6, 2, 70, 9, 10);
        }
        if ($seleccionArray == "arrayRandomOr") {
          $arrayLength =  $_POST["longitudOr"];
          $array = randomArray($arrayLength);
        }
        if ($seleccionArray == "defaultOr") {
          echo "<p> No ha introducido un parametro válido en la aplicación </p>";
        }
        if ($method == "burbuja"){
          $arrayLenght = count($array);
          $arrayOrdenado = burbuja($array, $arrayLenght);
          echo "El array ordenado obtenido por burbuja es: ". implode(", ", $arrayOrdenado);
        }
        if ($method == "seleccionDirecta"){
          $arrayLenght = count($array);
          $arrayOrdenado = insercionDirecta($array, $arrayLenght);
          echo "El array ordenado por seleccion Directa obtenido es: ". implode(", ", $arrayOrdenado);
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

        function burbuja($array, $arrayLenght)
        {
          for ($i = 1; $i < $arrayLenght; $i++) {
            for ($j = 0; $j < $arrayLenght - $i; $j++) {
              if ($array[$j] > $array[$j + 1]) {
                $k = $array[$j + 1];
                $array[$j + 1] = $array[$j];
                $array[$j] = $k;
              }
            }
          }

          return $array;
        }

        function insercionDirecta($array, $arrayLenght)
        {
          for ($i = 1; $i < $arrayLenght; $i++) {
            $v = $array[$i];
            $j = $i - 1;
            while ($j >= 0 && $array[$j] > $v) {
              $array[$j + 1] = $array[$j];
              $j--;
            }

            $array[$j + 1] = $v;
          }

          return $array;
        }
        ?>
        
      </div>
    </div>

  </body>

</html>