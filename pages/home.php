<?php 
$title = "Home" ;
ob_start();
?>
<div class="container">
<section class="hero-section  py-3 py-md-5">
    <div class="bg-white shadow-lg p-5">
       <div class="row">
        <div class="col-12 col-lg-6  pt-3 mb-5 mb-lg-0">
            <h1 class="site-headline  font-weight-bold mb-3">Postfile space to share your folders with other students</h1>
            <div class="site-tagline mb-4">
               <p class="lead"> Postfile is sharing plateform allow to all students arround world to share their research and many others 
                   documents
               </p>
               <div class="cta-btns mb-lg-3">
                 <a class="btn btn-outline-violet mr-2 mb-3" href="share">
                   Get Started share <i class="fas fa-arrow-alt-circle-right ml-2"></i>
                 </a>
                 <a class="btn btn-outline-dark mb-3" href="folder">
                  Folders available<i class="fas fa-arrow-alt-circle-right ml-2"></i>
                 </a>
               </div>
           </div>
       </div>
        <div class="col-12 col-lg-6 text-center border-violet rounded">
         <img class="hero-figure mx-auto  p-3" class="mx-auto rounded border-violet p-3 img-fluid " width="500" src="assets/images/home.png" alt="">
        </div>
     </div>
     </div>
    </section>
</div>
<?php 
$content = ob_get_clean();
//includes layout
require_once('templates/base.php');