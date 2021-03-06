<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Diogo DIALLO">
    <title><?= $title ?? 'Blog perso professionel'; ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="/../../Public/css/design.css" type="text/css">
    <style>
        /* form elements */
        form {
            width: 80%;
            margin: 0 auto;
            padding: 3px 5px;
            border: 1px solid #f2f2f2;
            background-color: #343A40;
            color: #ffffff;
        }

        label {
            display: block;
            font-weight: bold;
            margin: 5px 10px;
        }

        input {
            margin: 3px 10px;
            padding: 3px;
            border: 1px solid #eee;
            border-radius: 15px;
            font: normal 1em Verdana, sans-serif;
            color: #777;
        }

        textarea {
            width: 100%;
            padding: 2px;
            font: normal 1em Verdana, sans-serif;
            border: 1px solid #eee;
            height: 100px;
            display: block;
            color: #777;
            resize: none;
        }

        input.button {
            width: 80%;
            font: bold 24px Arial, Sans-serif;
            height: 24px;
            margin: 0;
            padding: 2px 3px;
            color: #FFF;
            background: #8EB50C repeat-x 0 0;
            border: none;
        }
    </style>
</head>

<body id="top">
    <header>
        <?php require('navigation.php'); ?>
    </header>

    <main role="main mt-5">

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                        <rect width="100%" height="100%" fill="#777" />
                    </svg>
                    <div class="container">
                        <div class="carousel-caption text-left">
                            <h1>Example headline.</h1>
                            <p>
                                Cras justo odio, dapibus ac facilisis in, egestas eget quam.
                                Donec id elit non mi porta gravida at eget metus. Nullam id dolor
                                id nibh ultricies vehicula ut id elit.
                            </p>
                            <p>
                                <a class="btn btn-lg btn-primary" href="/regsiter.php" role="button">S'inscrire</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                        <rect width="100%" height="100%" fill="#777" />
                    </svg>
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Another example headline.</h1>
                            <p>
                                Cras justo odio, dapibus ac facilisis in, egestas eget quam.
                                Donec id elit non mi porta gravida at eget metus. Nullam id dolor id
                                nibh ultricies vehicula ut id elit.
                            </p>
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                        <rect width="100%" height="100%" fill="#777" />
                    </svg>
                    <div class="container">
                        <div class="carousel-caption text-right">
                            <h1>One more for good measure.</h1>
                            <p>
                                Cras justo odio, dapibus ac facilisis in, egestas eget quam.
                                Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh
                                ultricies vehicula ut id elit.
                            </p>
                            <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <!-- Content area -->
        <div class="container mb-5">
            <?php if ($user->hasFlash()) : ?>
                <p class="alert alert-<?= $_SESSION['type'] ?> text-center">
                    <?= $user->getFlash() ?>
                </p>
            <?php endif; ?>
            <main>
                <?= $content; ?>
            </main>
        </div>

        <!-- FOOTER -->
        <footer class="container fixed-bottom mt-5">
            <p class="float-right"><a href="#">Back to top</a></p>
            <p>
                &copy; <?= date("Y") ?> - <?= date("Y", strtotime("+2 years")) ?>
                <a href="/contact">Contact</a> &middot;
                <a href="/admin/">Admin</a>
            </p>
        </footer>
    </main>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/4f4d950f15.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/4f4d950f15.js" crossorigin="anonymous"></script>
</body>

</html>