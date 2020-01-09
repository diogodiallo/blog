<hr>
<h2 class="text-center">Liste des commentaires á modérer</h2>
<table class="table table-strip">
    <tr>
        <th>ID</th>
        <th>Commentaire</th>
        <th>Date d'ajout</th>
        <th>Dernière modification</th>
        <th class="text-center">Modérer</th>
    </tr>
    <?php foreach ($comments as $comment) : ?>
        <tr>
            <td><?= $comment['id']; ?></td>
            <td><?= $comment['content']; ?></td>
            <td>le <?= $comment['created_at']; ?></td>
            <td>
                <?= ($comment['created_at'] === $comment['updated_at'])
                    ? '-'
                    : 'le ' . $comment['updated_at'];
                ?>
            </td>
            <td>
                <?= ($comment['validate'] == 1)
                    ? "<i class='btn btn-outline-success'>Valider</i>"
                    : '<a href="comment-update-'. $comment['id'] . '.html"
                        class="btn btn-outline-secondary"> <i class="fas fa-pen"> Modérer</i>
                    </a>';
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>