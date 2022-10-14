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
        die();
    }

    $sql = 'DELETE FROM `SPECTROTT` WHERE `idModeleTrott` = :id;';

    // On prépare la requête
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $idModeleTrott, PDO::PARAM_INT);

    // On exécute la requête
    $query->execute();
    $_SESSION['message'] = "Trottinette supprimé";
    header('Location: index.php');


}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: index.php');
}