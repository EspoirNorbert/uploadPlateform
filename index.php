<?php 
$title = "Plateforme Home Agile Project";
include __DIR__.'/header.php'; 
?>
<body class="d-flex flex-column h-100">
<?php include __DIR__.'/navbar.php'; ?>
<main class="flex-shrink-0 mt-5" >
<div class="container mt-5 mb-5">
    <div class="card">
        <?php include __DIR__.'/home.php'  ?>
   </div>
</div>
</main>
<?php include __DIR__.'/footer.php';  ?>
</body>
</html>