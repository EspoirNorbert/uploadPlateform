<?php
/*****
 * Function file for all function
*/
function get_name_app(){
  //get current file in our case is index.php
  $parse = parse_url($_SERVER["PHP_SELF"]);
  //get path key in  parse array
  $path = $parse['path'];
  //return application name
  return strtok($path, '/');
}

function include_page($url = null){
  //check if url is isset
   extract($_GET);
  if (isset($page) and !empty($page)){
      //mapper cette url a la page concernée
       $filename = 'pages/'. $page . '.php';
       if (file_exists($filename)){
          //on inclue le fichier qui correspond a la page
          require_once ($filename);
       } else {
         //retourne le fichier qui correspond a une erreur 404
         require_once('pages/errors/404.php');
       }
   } else {
      require_once('pages/home.php');
   }
}

function upload_folder(){
  $errors = array();
 //boolean to upload folder
 $file_uploaded = false;
 if(!empty($_POST)){
   //extraction des valeurs de post
    extract($_POST);//$nom ,$uploader
    //verifier si le la variable folders est defini
    if(isset($_FILES['folder']))
    {
       //check data 
       $errors = validate_data_form($_POST);
       //split username
       $username = explode(' ', htmlentities($_POST["username"]));
       $lastname =  $username[0];
       $firstname = null;
       if (sizeof($username) > 1){$firstname = $username[1] ;};
       //extraction des valeurs de files
       extract($_FILES['folder']);//$name,$type,$tmp_name,$error,$size
       //chemin de destination des fichiers
       //new file name
       $fileExt = explode('.', $name);
       //file 
       $fileActualExt  =strtolower(end($fileExt));
       $target_dir = "folders/";
       $target_file = $target_dir . uniqid('', true).'.'. $fileActualExt;
       //verfier le type de fichier si c'est un fichier zip
       //declarer le tableau des type acceptes pour les fichier zip
       $accepted_file = ['application/zip' , 'application/x-zip-compressed','multipart/x-zip','application/x-compressed'];
       
       //si le type de fichier n'existe pas dans ce tableau je renvois un message d'error
       if(!in_array($type,$accepted_file)){
           $errors['folder'] = "Desolé, seule les fichiers zip sont autorisés";
       }      
       
       //verifier si le fichier existe deja
       else if(file_exists($target_file)){
        $errors['folder'] =  "Désolé, Ce fichier existe deja";
       }

       //verifier aussi si le groupe est deja ajouté
       if(file_exists("databases/folders.json")){
        $decode = json_decode(file_get_contents('databases/folders.json'));
        foreach($decode as $folders){
            if($folders->folder_name == $foldername){
               $errors['foldername']= "Desolé, Ce nom de dossier dossier existe deja";
            }
        }
       }
    
       //check if errors table is empty
       if(empty($errors)){
         if(move_uploaded_file($tmp_name,$target_file)){
           if(file_exists('databases/folders.json')){
             //recuperer son contenue
             $file_json  = file_get_contents('databases/folders.json');
             //decoder les donnees json
             $file_json_decode = json_decode($file_json);
             // Get IDs list
             $idsList = array_column($file_json_decode, 'id');
             // Get unique id
            empty($idsList)? $auto_increment_id = 1 : $auto_increment_id =  $auto_increment_id = max($idsList) + 1;
           
             //met les donnees
             $file_data = 
             [
                "id"                  =>   $auto_increment_id,
                "folder_name"         =>   $foldername,
                "folder_url"           =>   "http://".$_SERVER['HTTP_HOST']."/". get_name_app() ."/".$target_file,
                "folder_publish_date"  =>  Date('Y-m-d H:i:s'),
                "folder_author"        =>  array("lastname" => $lastname  ,"firstname" => $firstname )
             ];
             //ajout des donnes dans le fichier decoede
             $file_json_decode [] = $file_data;
             //on encode tout sa
             $file_json_decode = json_encode($file_json_decode,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
             //ajout des donnees dans le fichier
             file_put_contents('databases/folders.json',$file_json_decode);
             //uploder reussit 
             $file_uploaded = true;
            }
          }
          }
       } 
    } 
    else {
      $error['folder'] = 'Folder upload required';
    }
    if(empty($errors)){
      return $file_uploaded;
    } else {
      return $errors;
    }

  }


  
  


  function validate_data_form($array){
  //extract array key
   extract($array);
   //create variable errors
   $errors = [];
   //check data validity
   if (isset($username) and empty($username)){
      $errors['username'] = "Name is required"; 
   }  
   else if ( !preg_match('/^[a-zA-Zéçè\s]+$/',$username) or sizeof(explode(' ', $username)) == 1 ){
    $errors['username'] = "Write your fullname only one name given only letters are authorized";
   }
   if (isset($foldername) and empty($foldername) and !preg_match('/^[a-zA-Zéçè\s]+$/',$foldername) ){
     $errors['folder'] = "FolderName is required";
   } 
   
   return $errors;
}


function createMessageSession(string $data,string $message = null){
    if($message == null)
      return $_SESSION[$data];
    else
    return $_SESSION[$data] = $message;
}

//generate session message and display mesaage
function session_message(string $data){
  if(isset($_SESSION[$data])){
    switch ($data) {
      case 'message':
        echo "<div class='alert alert-danger'>$_SESSION[$data]</div>";
        break;
      case 'success':
        echo "<div class='alert alert-success'>$_SESSION[$data]</div>";
      default:
        echo $_SESSION[$data];
        break;
    }
    unset($_SESSION[$data]);
 }
}

//make var_dump on variable with tag pre
function prearray (array $table){
    echo "<pre>"; var_dump($table) ;echo "</pre>";
}


