<?php 
$title = "Home Page" ;
ob_start();
?>
<style>
    body{
        overflow: hidden;
    }

</style>
<div class="page-wrap d-flex  flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
                <span class="display-1 d-block">404</span>
                <div class="mb-4 lead">The page you are looking for was not found.</div>
                <a href="home" class="btn btn-link">Back to Home</a>
            </div>
        </div>
    </div>
</div>
<?php 
$content = ob_get_clean();
//includes layout
require_once dirname(__DIR__). '/templates/base.php';
