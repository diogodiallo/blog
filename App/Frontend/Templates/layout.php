<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Diogo DIALLO">
    <title><?= $title ?? 'Blog perso professionel'; ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" 
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
            crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="/Public/css/design.css" rel="stylesheet" type="text/css">
  </head>
<body>
    <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="/"><abbr title="Diogo DIALLO">DD</abbr> Blog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" 
                    data-target="#navbarCollapse" 
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">
                        <i class="fa fa-home"></i> Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">Qui suis-je?</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/posts">Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">Contactez-moi</a>
                </li>
                <?php if ($user->isAuthenticated()): ?>
                    <div class="ml-5 d-flex justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/">Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/post-insert.html">Ajouter un article</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link bg bg-danger text-white" href="/admin/logout.html">
                                Déconnexion
                            </a>
                        </li>
                    </div>
                <?php else: ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="/admin/login">
                            <i class="fa fa-signin-in-alt"></i> Connexion
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="/admin/register">
                            <i class="fa fa-arrow-alt-circle-up"></i> Inscripton
                        </a>
                    </li>
                <?php endif; ?>
                
            </ul>
            <form class="form-inline mt-2 mt-md-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
            </form>
            </div>
        </nav>
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
            <svg class="bd-placeholder-img" width="100%" height="100%" 
                xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" 
                focusable="false" role="img"><rect width="100%" height="100%" fill="#777"/>
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
                    <a class="btn btn-lg btn-primary" href="/regsiter.php" role="button">Sign up</a>
                </p>
            </div>
            </div>
        </div>
        <div class="carousel-item">
            <svg class="bd-placeholder-img" width="100%" height="100%" 
                xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" 
                focusable="false" role="img"><rect width="100%" height="100%" fill="#777"/>
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
            <svg class="bd-placeholder-img" width="100%" height="100%" 
                xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" 
                focusable="false" role="img"><rect width="100%" height="100%" fill="#777"/>
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
        <div class="container">
            <?= $content; ?>
        </div>

        <!-- FOOTER -->
        <footer class="container fixed-bottom">
            <p class="float-right"><a href="#">Back to top</a></p>
            <p>&copy; <?= date("Y") ?> - <?= date("Y", strtotime("+2 years")) ?> 
            <a href="/contact">Contact</a> &middot; 
            <a href="/admin/">Admin</a>
        </p>
        </footer>
    </main>

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
