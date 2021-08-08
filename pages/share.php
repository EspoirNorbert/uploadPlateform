<?php
session_start();
ob_start();
$title = "Share Folder";
?>
<div class="container mt-5"> 
<div id="form"  class="">
<div class="row mb-5 shadow-lg border-violet rounded">
    <div class="col-lg-6 h-100 p-0">
        <img alt="share_file" style="height: 70.9vh;border-radius:.25rem" class="mh-100 img-fluid" src="assets/images/share_file.webp" >
      </div>
     <div class="col-lg-6 h-100 p-0" >
     <div class="card" > <!-- id="formUpload" -->
     <form id="formUpload"  enctype="multipart/form-data" >
         <div class="card-header bg-violet">
           <h2 class="card-title text-white">Partager un dossier</h2>
         </div>
         <div class="card-content p-3">
         <div class="form-group">
	           <label for="name">Your name*</label>
	           <input type="text" name="username" 
              placeholder="for ex :Luc Ouedroaogo"  class="form-control " id="username">
	       </div>
           <div class="form-group">
	           <label for="name">Folder Name*</label>
	           <input type="text" name="foldername" 
             placeholder="for ex: webapp"  class="form-control " id="foldername">
	       </div>
           <div class="custom-file">
           <label  id="folderlabel" data-browse="Upload your folder" for="customFile">Your folder*</label>
            <input type="file" accept=".zip" class="form-control" name="folder" id="folder">
            <small class="text-danger form-text text-muted">Only <strong>Zip </strong>folders is authorized</small>  
          </div>
         </div>
         <div class="card-footer bg-violet">
           <div class="d-flex justify-content-center">
                <button  class="btn w-75 border-violet btn-block bg-white" id="bpublish" name="bpublish" type="submit">Publish your folder</button>   
           </div>  
         </div>
      </form> 
     </div>
     </div>
     </div>
</div>
</div>
<?php 
$content = ob_get_clean();
require_once('templates/base.php');
