<hr>
<h2 class="text-center">Liste des commentaires en attente de modération</h2> 
<table class="table table-strip">
    <tr>
       <th>ID</th>
       <th>Commentaire</th>
       <th>Date d'ajout</th>
       <th>Dernière modification</th>
       <th colspan="2" class="text-center">Modérer</th>
    </tr>   
    <?php foreach ($comments as $comment): ?>
        <tr>
            <td><?= $comment['id']; ?></td>
            <td><?= $comment['content']; ?></td>
            <td>le <?= $comment['created_at']; ?></td>
            <td>
                <?= ($comment['created_at'] == $comment['updated_at'] 
                    ? '-' 
                    : 'le ' .$comment['updated_at']
                    )
                ?> 
            </td>
            <td>
                <?= $comment['validate'] 
                    ? "<i class='btn btn-outline-success'>Validé</i>" 
                    :'<a href="comment-update-'.$comment['id'] .'.html" 
                        class="btn btn-outline-info"> <i class="fas fa-pen"> Modérer</i>
                    </a>'; 
                ?> 
                <a href="comment-delete-<?= $comment['id'] ?>.html" 
                    onclick="return confirm('Voulez-vous supprimer ce commentaire?')"
                    class="btn btn-outline-danger">
                    <i class="fas fa-trash"></i> Supprimer
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>