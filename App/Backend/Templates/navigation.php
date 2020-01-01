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
            <a class="nav-link" href="/"><i class="fa fa-home"></i> Accueil</a>
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
                <?php if($user->userIsAdmin()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/post-insert.html">Ajouter un article</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link bg bg-danger text-white" href="/admin/logout.html">
                        Déconnexion
                    </a>
                </li>
            </div>
        <?php else: ?>
            <li class="nav-item active">
                <a class="nav-link" href="/login">
                    <i class="fa fa-sign-in-alt"></i> Connexion
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/register">
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