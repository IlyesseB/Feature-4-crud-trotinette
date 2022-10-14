<?php
session_start();

require_once('connect.php');

$sql = 'SELECT * FROM `SPECTROTT`';

$query = $db->prepare($sql);

$query->execute();

$result = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('close.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des trottinette</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
            <?php
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert alert-danger" role="alert">
                                '. $_SESSION['erreur'].'
                            </div>';
                        $_SESSION['erreur'] = "";
                    }
                ?>
                <?php
                    if(!empty($_SESSION['message'])){
                        echo '<div class="alert alert-success" role="alert">
                                '. $_SESSION['message'].'
                            </div>';
                        $_SESSION['message'] = "";
                    }
                ?>
                <h1>Liste des trottinettes</h1>
                <table class="table">
                    <thead>
                        <th>Id trottinette</th>
                        <th>Vitesse max</th>
                        <th>Capacite energie</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach($result as $VitesseMax){
                        ?>
                            <tr>
                                <td><?= $VitesseMax['idModeleTrott'] ?></td>
                                <td><?= $VitesseMax['VitesseMax'] ?></td>
                                <td><?= $VitesseMax['CapaciteEnergie'] ?></td>
                                <td><a href="details.php?id=<?= $VitesseMax['idModeleTrott'] ?>">Voir</a> <a href="edit.php?id=<?= $VitesseMax['idModeleTrott'] ?>">Modifier</a> <a href="delete.php?id=<?= $VitesseMax['idModeleTrott'] ?>">Supprimer</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <a href="add.php" class="btn btn-primary">Ajouter une trottinette</a>
            </section>
        </div>
    </main>
</body>
</html>