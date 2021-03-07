<?php 
session_start();
$title = "Joindre vos projets";
extract($_SESSION);
include __DIR__.'/header.php'; 
?>
<body class="d-flex flex-column h-100">
<?php include __DIR__.'/navbar.php'; ?>
<main class="flex-shrink-0 mt-5" >
<div class="container mt-3 mb-5">
    <div class="card w-50 mx-auto">
        <div class="card-header  bg-danger">
        <h2 class="text-white p-3">Joindre vos projets</h2>
        </div>
        <div class="card-content">
         <form action="file_upload.php" method="post" class="p-4" enctype="multipart/form-data">
         <?php if(isset($message)) {
            echo "<div class='alert alert-danger'>$message</div>";
            unset($message);
         } ?>
            <div class="form-group">
             <label for="groupe">Groupe</label>
             <input type="text" name="groupe" placeholder="nom du pays" required id="groupe" class="form-control form-control-lg">
            </div>
            <div class="form-group">
             <label for="fichier">Fichier</label>
             <input type="file" name="file"  id="file" accept=".zip" required class="form-control form-control-lg">
             <small>Seul les fichiers zip sont acceptes</small>
            </div>
        </div>
        <div class="card-footer bg-danger"> 
            <div class="row">
                <div class="text-center offset-md-4 col-md-2">
                    <button class="btn btn-danger btn-lg" name="benvoyer" type="submit">Envoyer</button>   
                </div>
            </div>
            </form>
        </div>
   </div>
</div>
</main>
<?php include __DIR__.'/footer.php';  ?>
</body>
</html>