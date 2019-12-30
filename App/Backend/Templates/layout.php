<?php $this->app->user()->userNotAdmin(); ?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Diogo DIALLO ">

    <title><?= $title ?? 'Backend du blog'; ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
            crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/united/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="/Public/css/design.css" rel="stylesheet" type="text/css">
  </head>
<body id="top">
    <header>
        <?php require('navigation.php'); ?>
    </header>

    <main role="main">
        <div class="container mt-5">
            <?= $content; ?>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="container fixed-bottom mt-5">
        <p class="float-right"><a href="#top">Haut de page</a></p>
        <p>&copy; 2017-2019 Company, Inc. &middot; 
            <a href="#">Privacy</a> &middot; <a href="#">Terms</a>
        </p>
    </footer>

<!-- Scripts -->
<script src="https://kit.fontawesome.com/4f4d950f15.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
        crossorigin="anonymous"></script>

<!-- Fontawesome -->
<script src="https://kit.fontawesome.com/4f4d950f15.js" crossorigin="anonymous"></script>
  </body>
</html>
