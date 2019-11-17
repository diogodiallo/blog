<p>Par <em><?= $post['user_id'] ?></em>, le <?= $post['created_at']->format('d/m/Y à H\hi') ?></p>
<h2><?= $post['title'] ?></h2>
<p><?= nl2br($post['content']) ?></p>
 
<?php if ($post['created_at'] != $post['updated_at']) { ?>
    <p style="text-align: right;">
        <small><em>Modifiée le 
            <?= $post['updated_at']->format('d/m/Y à H\hi') ?>
        </em></small>
    </p>
<?php } ?>
 
<p><a href="commenter-<?= $post['id'] ?>.html">Ajouter un commentaire</a></p>
 
<?php
if (empty($comments))
{
?>
<p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
<?php
}
 
foreach ($comments as $comment)
{
?>
<fieldset>
  <legend>
    Posté par <strong><?= htmlspecialchars($comment['user_id']) ?></strong> 
    le <?= $comment['created_at']->format('d/m/Y à H\hi') ?>
    <?php if ($user->isAuthenticated()) { ?> -
      <a href="admin/comment-update-<?= $comment['id'] ?>.html">Modifier</a> |
      <a href="admin/comment-delete-<?= $comment['id'] ?>.html">Supprimer</a>
    <?php } ?>
  </legend>
  <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
</fieldset>
<?php
}
?>
 
<p><a href="commenter-<?= $post['id'] ?>.html">Ajouter un commentaire</a></p>
