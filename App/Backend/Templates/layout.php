<?php (!$this->app->user()->userIsAdmin()); ?>
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

    <style>
        /* form elements */
        form {
            width: 80%;
            margin:0 auto; padding: 3px 5px;
            border: 1px solid #f2f2f2; 
            background-color: #772953; 
            color: #ffffff;	
        }
        label {
            display:block;
            font-weight:bold;
            margin:5px 10px;
        }
        input {
            margin: 3px 10px;
            padding:3px;
            border:1px solid #eee;
            border-radius: 15px;
            font: normal 1em Verdana, sans-serif;
            color:#777;
        }
        textarea {
			width: 100%;
            padding:2px;
            font: normal 1em Verdana, sans-serif;
            border:1px solid #eee;
            height:100px;
            display:block;
			color:#777;
			resize: none;
        }
        input.button { 
            width: 80%;
            font: bold 24px Arial, Sans-serif; 
            height: 24px;
            margin: 0;
            padding: 2px 3px; 
            color: #FFF;
            background: #8EB50C  repeat-x 0 0;
            border: none;
        }
    </style>
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
