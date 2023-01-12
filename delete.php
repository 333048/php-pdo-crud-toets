<?php
    require('config.php');

    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

    try {
        $pdo = new PDO($dsn, $dbUser, $dbPass);
        if ($pdo) {
            echo "Gelukt!";
        } else {
            echo "Niet gelukt!";
        }
    } catch(PDOException $e) {
        $e->getMessage();
    }

    $sql = "DELETE FROM DureAuto
            WHERE Id = :Id";

    $statement = $pdo->prepare($sql);
    $statement->bindValue(':Id', $_GET['Id'], PDO::PARAM_INT);
    $result = $statement->execute();

    if ($result) {
        echo "Verwijderd!";
        header('Refresh:3; url=read.php');
    } else {
        echo "Niet verwijderd!";
        header('Refresh:3; url=read.php');
    }
?>