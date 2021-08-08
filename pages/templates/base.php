<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?= $title ?> | Postfiles</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet"  href="assets/css/style.css?v=<?= time() ?>">
    <link rel="icon" type="image/png" sizes="16x16"  href="assets/images/icon/favicon-16x16.png">
<body class="d-flex flex-column h-100">
    <nav class="navbar navbar-expand-sm bg-violet navbar-dark fixed-top">
      <a class="navbar-brand" href="home">
       <img src="assets/images/icon/android-icon-36x36.png" class="rounded mr-2" alt="">Postfiles</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb" aria-expanded="true">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="share"><i class="fa fa-share"></i> Share folder<icon> </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="folder"> <i class="fa fa-folder"></i> Dossier<icon></a>
            </li>
        </ul>
    </nav>
    <main>
        <?= $content ?>
    </main>
    <footer class="footer mt-auto py-3 bg-violet">
    <div class="container">
    <p class="text-white text-center h-3">
            Copyright &copy; Postfiles <?= date('Y') ?> -<?= date('Y') + 1 ?> - All Right reserved
        </p>
    </div>
</footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <?php 
    require_once('includes/function.php');
    if($_SERVER["REQUEST_URI"] == '/'.get_name_app() . '/share'){
    ?>
     <script src="assets/js/app.js"></script>
    <?php }
    ?>
    
</body>
</html>