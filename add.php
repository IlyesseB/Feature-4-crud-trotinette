<?php
// On démarre une session
session_start();

if($_POST){
    if(isset($_POST['VitesseMax']) && !empty($_POST['VitesseMax'])
    && isset($_POST['CapaciteEnergie']) && !empty($_POST['CapaciteEnergie'])){
        require_once('connect.php');

        $VitesseMax = strip_tags($_POST['VitesseMax']);
        $CapaciteEnergie = strip_tags($_POST['CapaciteEnergie']);

        $sql = 'INSERT INTO `SPECTROTT` (`VitesseMax`, `CapaciteEnergie`) VALUES (:VitesseMax, :CapaciteEnergie);';

        $query = $db->prepare($sql);

        $query->bindValue(':VitesseMax', $VitesseMax, PDO::PARAM_INT);
        $query->bindValue(':CapaciteEnergie', $CapaciteEnergie, PDO::PARAM_INT);

        $query->execute();

        $_SESSION['message'] = "Trottinette ajouté";
        require_once('close.php');

        header('Location: index.php');
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une trottinette</title>

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
                <h1>Ajouter une trottinette</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="VitesseMax">Vitesse max</label>
                        <input type="text" id="VitesseMax" name="VitesseMax" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="CapaciteEnergie">Capacite Energie</label>
                        <input type="number" id="CapaciteEnergie" name="CapaciteEnergie" class="form-control">
                    </div>
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>