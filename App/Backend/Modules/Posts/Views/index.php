<p style="text-align: center">Il y a actuellement <?= $posts_number ?> news. En voici la liste :</p>
 
<table>
  <tr>
      <th>Auteur</th>
      <th>Titre</th>
      <th>Date d'ajout</th>
      <th>Dernière modification</th>
      <th>Action</th></tr>
    <?php foreach ($posts as $post): ?>
    <tr>
        <td> <?= $post['user_id']; ?></td>
        <td> <?= $post['title']; ?></td>
        <td>le <?= $post['created_at']->format('d/m/Y à H\hi'); ?></td>
        <td>
            <?= ($post['created_at'] == $post['updated_at'] 
                ? '-' 
                : 'le '.$post['updated_at']->format('d/m/Y à H\hi'))
            ?> 
        </td>
        <td>
            <a href="post-update-<?= $news['id'] ?>.html">
                <img src="/images/update.png" alt="Modifier" />
            </a> 
            <a href="news-delete-<?= $news['id'] ?>.html">
                <img src="/images/delete.png" alt="Supprimer" />
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>