<?php 
$title = "Liste des projets";
include __DIR__.'/header.php'; 
?>
<body class="d-flex flex-column h-100">
<?php include __DIR__.'/navbar.php'; ?>
<main class="flex-shrink-0 mt-5" >
<div class="container mt-5  mt-3 mb-5">
    <div class="card">
    <div class="card-header  bg-danger">
        <h2 class="text-white p-3">Projets</h2>
    </div>
    <div class="card-content">
      <table class="table text-center table-hover table-striped">
      <tr class="thead-dark">
         <th>ID</th>
         <th>Groupe</th>
         <th>Fichier</th>
      </tr>
      <?php 
      //ouverture du fichier json
       if(file_exists("fichier.json")){
          //ouvre le fichier
          $data = file_get_contents('fichier.json');
          $fichiers = json_decode($data);
          foreach($fichiers as $fichier){
          ?>
            <tr>
                 <td><?= $fichier->id ?></td>
                 <td><?= $fichier->groupe ?></td>
                 <td>
                   <a href="<?= $fichier->url ?>" download class="btn btn-danger">Telecharger</a>
                 </td>
            </tr>
          <?php
          }
       }
      ?>
      </table>
    </div>
   </div>
</div>
</main>
<?php include __DIR__.'/footer.php';  ?>
</body>
</html>