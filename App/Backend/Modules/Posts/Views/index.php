<h1 class="mt-5 text-center">Il y a actuellement <?= $posts_number ?> article(s).</h1>

<table class="table table-strip">
    <tr>
       <th>ID</th>
       <th>Titre</th>
       <th>Date d'ajout</th>
       <th>Dernière modification</th>
       <th>Action</th></tr>
    <?php foreach ($posts as $post): ?>
    <tr>
        <td><?= $post['id']; ?></td>
        <td><?= $post['title']; ?></td>
        <td>le <?= $post['created_at']->format('d/m/Y à H\hi'); ?></td>
        <td>
            <?= ($post['created_at'] == $post['updated_at'] 
                ? '-' 
                : 'le '.$post['updated_at']->format('d/m/Y à H\hi')
                )
            ?> 
        </td>
        <td>
            <a href="post-update-<?= $post['id'] ?>.html">
                <i class="fas fa-pen"></i> Modifier
            </a> 
            <a href="post-delete-<?= $post['id'] ?>.html" 
                onclick="return confirm('Voulez-vous supprimer cet article?')">
                <i class="fas fa-trash ml-4"></i> Supprimer
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<hr>
<p class="text-center">
    <a href="/admin/list-comments.html" class="btn btn-outline-secondary">
        Voir les commentaires en attente de modération
    </a>
</p>