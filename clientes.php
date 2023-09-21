<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Hello Dev!</h1>
        <p>This is the landing page of <strong>Dev</strong>.</p>
        <?php
    $user = "example_user";
    $password = "password";
    $database = "e_comerce";
    $table = "clientes";

    try {
      $db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);
      echo "<h4>Nossos clientes</h4><hr><ol>";
      foreach ($db->query("SELECT * FROM $table ORDER BY cliente_nome") as $row) {
        echo
        "<li>"
          .
          $row['cliente_nome'] . "\t",
        $row['cliente_sobrenome'] . "," . "\t",
        $row['cliente_sexo'] . "," . "\t",
        $row['cliente_cpf'] . "," . "\t",
        $row['cliente_data_nascimento'] . "\n"
          .
          "</li>";
      }
      echo "</ol>";
    } catch (PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
      die();
    }
    ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>