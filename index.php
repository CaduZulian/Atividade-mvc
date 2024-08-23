<?php
require "Controller/index.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Gestão Pedidos - Home</title>
</head>
<body>
<?php
  $controller = new Controller();
  $controller->monta_home();
  ?>
</body>
</html>