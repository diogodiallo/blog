<div class="card">
    <header class="card-header bg-primary text-light">
        <h4 class="card-title">
            Profil de <?= strtoupper($_SESSION['user']); ?>
        </h4>
        <p>
            <strong>Statut : </strong>
            <em>
                <?= 
                    ($_SESSION['user_role_id'] == 1 
                        ? 'Membre simple' 
                        : ($_SESSION['user_role_id'] == 2 ? "Admin" : "")
                    
                    ); 
                ?>
            </em> - Inscrit le : <?= date("d-m-Y á H:i", strtotime($userConnected['created_at'])) ?>
        </p>
    </header>
    <div class="card-body">
        <?=
            (!empty($_SESSION['user_firstname']) || !empty($_SESSION['user_lastname']))
                ? 'Bienvenue ' . $_SESSION['user_firstname'] . " " . strtoupper($_SESSION['user_lastname'])
                : 'Bienvenue ' . $_SESSION['user'];
        ?>
    </div>
</div>