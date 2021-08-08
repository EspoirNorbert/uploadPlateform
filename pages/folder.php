<?php
session_start();
ob_start();
$title = "Folders";
?>
<div class="container mt-5">
  <div class="results">
  <form>
      <div class="form-group">
          <input type="search" name="q" id="q" class="form-control form-control-lg" placeholder="Search (foldername) for example: webapp">
          <i class="fa fa-search"></i>
          <small class="text-muted text-center">Research bar not available </small>
      </div>
 
</form>

</div>
<div class="row  p-3">
<?php
    //ouverture du folder json
    if (file_exists("databases/folders.json")) {
      //ouvre le folder
      $data = file_get_contents('databases/folders.json');
      $folders = json_decode($data);
      //sort table
      arsort($folders);
      if (empty($folders)) {
    ?>
 
    <div class="d-flex flex-column p-5 w-50 text-center  mx-auto">
        <h5>Aucun aucun folder ajouté pour le moment</h5>
        <a href="share" class="w-50 mx-auto  btn-lg btn btn-violet">Share a folder</a>
      </div>
    <?php 
    } 
    else {
?>
  <?php
      foreach ($folders as $folder) {
    ?>
    <div class="col-md-6 col-lg-3 mb-3 shadow-sm folder-list">
      <h5 class="mt-2 folder_title"><i class="fa fa-folder"></i> <?= $folder->folder_name ?></h5>
      <p>Author <strong> <?= $folder->folder_author->lastname ?> <?= $folder->folder_author->firstname ?></strong> <br> 
         published at <strong><?= $folder->folder_publish_date ?></strong> 
      </p>
      <a href="<?= $folder->folder_url ?>" download class="btn btn-block btn-violet mb-2"><i class="fa fa-cloud-download" aria-hidden="true"></i> Downlad</a>
      </div>
      <?php
        }
      }
      ?>
    </div>
    </div>
<?php
  }
  $content = ob_get_clean();
  require_once('templates/base.php');
