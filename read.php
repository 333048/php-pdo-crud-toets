<?php
    require('config.php');

    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

    try {
        $pdo = new PDO($dsn, $dbUser, $dbPass);

        if ($pdo) {
            echo "Verbinding met de database is gelukt";
        } else {
            echo "Verbinding met de database is mislukt";
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    $sql = "SELECT * FROM Persoon";

    $statement = $pdo->prepare($sql);


    $statement->execute();
    $result = $statement->fetchAll(PDO::FECTH_OBJ);

    var_dump($result);

    $row = "";

    foreach ($result as $info) {
        $row .= "<tr>
                    <td>$info->Id</td>
                    <td>$info->Voornaam</td>
                    <td>$info->Tussenvoegsel</td>
                    <td>$info->Achternaam</td>
                    <td>
                        <a href='edit.php?'>
                        <img src='img/edit.png' alt='edit' width='20px'>
                        </a>
                    </td>
                    <td>
                        <a href='delete.php?id=" . $info->Id . "'>
                        <img src='img/delete.png' alt='delete' width='20px'>
                        </a>
                    </td>
                </tr>";
    }


?>

<h3>Persoonsgegevens</h3>
<br>
<a href="index.php"><input type="text"><button>Nieuw Persoon</button></input></a>
<br><br>
<table border="1">
    <thead>
        <th>Id</th>
        <th>Voornaam</th>
        <th>Tussenvoegsel</th>
        <th>Achternaam</th>
    </thead>
    <tbody>
        <?= $rows; ?>
    </tbody>
</table>