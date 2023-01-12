<?php

  require('config.php');

  $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

  try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    if ($pdo) {
        
    } else {
        echo "Verbinding mislukt";
    }
  } catch(PDOException $e) {
    echo $e->getMessage();
  }
  $sql = "SELECT Id
                ,Merk
                ,Model
                ,Topsnelheid
                ,Prijs
          FROM DureAuto";

  $statement = $pdo->prepare($sql);
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_OBJ);

  $rows = "";
  foreach ($result as $i) {
    $rows .= "<tr>
            <td>$i->Merk</td>
            <td>$i->Model</td>
            <td>$i->Topsnelheid</td>
            <td>$i->Prijs</td>
            <td>
                <a href='delete.php?Id=$i->Id'>
                    <button>X</button>
                </a>
            </td>
            </tr>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PHP PDO CRUD</title>
    <style>
        body {
            background-color: #242424;
            margin-right: 50rem;
            margin-left: 45rem;
            margin-top: 10rem;
        }
        h3 {
            color: #FFF;
            font-family: Arial, Helvetica, sans-serif;
            text-transform: uppercase;
            font-size: 20px;
        }
        table {
            color: #FFF;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 20px;
            border-collapse: collapse;
            width: 100%;
        }
        thead {
            background-color: #c6f0f7;
            color: #000;
            margin: 10px 10px 10px 10px;
        }
    </style>
</head>
<body id="read">
    <h3>Vijf duurste auto ter wereld!</h3>
    <table border='1'>
        <thead>
            <th>Merk</th>
            <th>Model</th>
            <th>Topsnelheid</th>
            <th>Prijs</th>
            <th>Delete</th>
        </thead>
        <tbody>
            <?= $rows; ?>
        </tbody>
    </table>
</body>
</html>