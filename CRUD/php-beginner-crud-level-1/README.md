Mateu Massó Grau

# 1

En la primera pregunta se deberan modificar para que enseñen un dolar, para esto, concatenaremos en el echo, un . "$" y en el index, añadiremos un $ antes del td cuando creamos una nueva tabla

# 2

Estamos guardando la imagen en la bdd como un varchar, ya que estamos guardando el nombre del archivo, para que luego pasarselo al html como el src para que este lo ejecute y enseñe. La imagen estara dentro de la carpeta php-beginner/uploads/laimagen. Para recuperarla podemos entrar en la ruta via el navegador. La logica combrueba que el formato de la imagen sea el correcto, que su nombre no sea el mismo que el de otra, que ocume menos de 1MB, y que exista en la ruta y si no, lo crea, y que la carpeta exista, sino la crea.

# 3

Debemos cojer la logica de la imagen, añadirla al update, hacer la query update y cambiarla para añadirle la imagen. En el formulario especificarle la id, y añadirle los campos para que enseñe la imagen,  y añadirle al getter los parametros necesarios