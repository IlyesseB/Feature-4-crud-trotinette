<?php
session_start();

if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('connect.php');

    $idModeleTrott = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `SPECTROTT` WHERE `idModeleTrott` = :id;';

    $query = $db->prepare($sql);

    $query->bindValue(':id', $idModeleTrott, PDO::PARAM_INT);

    $query->execute();

    $VitesseMax = $query->fetch();

    if(!$VitesseMax){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: index.php');
    }
}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails d'une trottinette</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <h1>Détails d'une trottinette <?= $VitesseMax['VitesseMax'] ?></h1>
                <p>ID : <?= $VitesseMax['idModeleTrott'] ?></p>
                <p>Vitesse Max : <?= $VitesseMax['VitesseMax'] ?></p>
                <p>Capacite Energie : <?= $VitesseMax['CapaciteEnergie'] ?></p>
                <p><a href="index.php">Retour</a> <a href="edit.php?id=<?= $VitesseMax['idModeleTrott'] ?>">Modifier</a></p>
            </section>
        </div>
    </main>
</body>
</html>