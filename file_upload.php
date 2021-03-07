<?php
session_start();
if(isset($_POST["benvoyer"])){
    extract($_POST);
    if(isset($_FILES['file'])){
    //definir les variales de $files
     extract($_FILES['file']);
    //chemin de destination des fichiers
    $target_dir = "fichiers/";
    $target_file = $target_dir . basename($name);
    //verfier le type de fichier si c'est un fichier zip
    //declarer le tableau des type acceptes pour les fichier zip
    $accepted_file = ['application/zip' , 'application/x-zip-compressed','multipart/x-zip','application/x-compressed'];
    //si le type de fichier n'existe pas dans ce tableau je renvois un message d'error
    if(!in_array($type,$accepted_file)){
        $_SESSION['message']  = "Desolé, seule les fichiers zip sont autorisés";
        header("location: projet.php?error=1");
        die();
    }
     //verifier si le fichier existe deja
     if(file_exists($target_file)){
       $_SESSION['message'] = "Désolé, Ce fichier existe deja";
       header("location: projet.php?error=2");
       die();
     }
     
     //verifier aussi si le groupe est deja ajouté
    if(file_exists("fichier.json")){
        $decode = json_decode(file_get_contents('fichier.json'));
        foreach($decode as $fichier){
            if($fichier->groupe == $groupe){
             $_SESSION['message']  = "Desolé, Ce groupe a deja eté enregistrer";
             header("location: projet.php?error=2");  
             die();    
            }
        }
    }
    
    if(move_uploaded_file($tmp_name,$target_file)){

        if(file_exists('fichier.json')){
         //recuperer son contenue
         $file_json  = file_get_contents('fichier.json');
         //decoder les donnees json
         $file_json_decode = json_decode($file_json);
        // Get IDs list
        $idsList = array_column($file_json_decode, 'id');
        // Get unique id
        $auto_increment_id = max($idsList) + 1;
         //met les donnees
         $file_data = [
            "id"      =>   $auto_increment_id,
            "groupe"  =>   $groupe,
            "url"     =>   $url="http://".$_SERVER['HTTP_HOST']."/AgilePlateform/".$target_file
           ];
         //ajout des donnes dans le fichier decoede
         $file_json_decode [] = $file_data;
         //on encode tout sa
         $file_json_decode = json_encode($file_json_decode,JSON_UNESCAPED_SLASHES);
         //ajout des donnees dans le fichier
         file_put_contents('fichier.json',$file_json_decode);
         $_SESSION['message'] = "Fichier ajouté avec succes";
         header("location: liste_projet.php");
        }
        else{
         $_SESSION['message'] = "le fichier n'existe pas";
         header("location: projet.php?error=3");
        }
    }
    else{
        $_SESSION['message'] = "Echec lors du transferer tu fichier ressayer";
        header("location: projet.php?error=4");
    } 
    }
}
else{
    header('HTTP/1.0 403 Forbidden');
}