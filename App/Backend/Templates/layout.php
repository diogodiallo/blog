
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Diogo DIALLO ">
    <meta name="generator" content="Jekyll v3.8.5">
    <title><?= $title ?? 'Backend du blog'; ?></title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
            crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/united/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="/Public/css/design.css" rel="stylesheet" type="text/css">
  </head>
<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="/"><abbr title="Diogo DIALLO">DD</abbr> Blog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" 
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
                    <li class="nav-item ml-5">
                        <a class="nav-link" href="/admin/">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/post-insert.html">
                            Ajouter un article
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link bg bg-danger text-white" 
                            href="/admin/logout.html">Déconnexion
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="/admin/login">
                            <i class="fas fa-sign-in-alt"></i> Connexion
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
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            </div>
        </nav>
    </header>

    <main role="main">
        <div class="container mt-5">
            <?= $content; ?>
        </div>

        <!-- FOOTER -->
        <footer class="container fixed-bottom">
            <p class="float-right"><a href="#">Back to top</a></p>
            <p>&copy; 2017-2019 Company, Inc. &middot; 
                <a href="#">Privacy</a> &middot; <a href="#">Terms</a>
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
