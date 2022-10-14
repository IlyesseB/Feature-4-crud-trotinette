<?php
// On démarre une session
session_start();

if($_POST){
    if(isset($_POST['id']) && !empty($_POST['id'])
    && isset($_POST['VitesseMax']) && !empty($_POST['VitesseMax'])
    && isset($_POST['CapaciteEnergie']) && !empty($_POST['CapaciteEnergie'])){
        require_once('connect.php');

        $idModeleTrott = strip_tags($_POST['id']);
        $VitesseMax = strip_tags($_POST['VitesseMax']);
        $CapaciteEnergie = strip_tags($_POST['CapaciteEnergie']);

        $sql = 'UPDATE `SPECTROTT` SET `VitesseMax`=:VitesseMax, `CapaciteEnergie`=:CapaciteEnergie, WHERE `idModeleTrott`=:id;';

        $query = $db->prepare($sql);

        $query->bindValue(':id', $idModeleTrott, PDO::PARAM_INT);
        $query->bindValue(':VitesseMax', $VitesseMax, PDO::PARAM_INT);
        $query->bindValue(':CapaciteEnergie', $CapaciteEnergie, PDO::PARAM_INT);

        $query->execute();

        $_SESSION['message'] = "Trottinette modifié";
        require_once('close.php');

        header('Location: index.php');
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('connect.php');

    $idModeleTrott = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `SPECTROTT` WHERE `idModeleTrott`=:id;';

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
    <title>Modifier une Trottinette</title>

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
                <h1>Modifier une Trottinette</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="VitesseMax">Vitesse Max</label>
                        <input type="text" id="VitesseMax" name="VitesseMax" class="form-control" value="<?= $VitesseMax['VitesseMax']?>">
                    </div>
                    <div class="form-group">
                        <label for="CapaciteEnergie">Capacite Energie</label>
                        <input type="text" id="CapaciteEnergie" name="CapaciteEnergie" class="form-control" value="<?= $VitesseMax['CapaciteEnergie']?>">
                    </div>
                    <input type="hidden" value="<?= $VitesseMax['idModeleTrott']?>" name="id">
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>