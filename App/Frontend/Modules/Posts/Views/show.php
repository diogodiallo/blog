<p>Par <em>Jean (ici user)</em>, le <?= $post['created_at']->format('d/m/Y à H\hi') ?></p>
<h2><?= $post['title'] ?></h2>
<p><?= nl2br($post['content']) ?></p>
 
<?php if ($post['created_at'] != $post['updated_at']): ?>
    <p class="float-right">
        <small><em>Modifiée le 
            <?= $post['updated_at']->format('d/m/Y à H\hi') ?>
        </em></small>
    </p>
<?php endif; ?>
 
<p><a href="commenter-<?= $post['id'] ?>.html">Ajouter un commentaire</a></p>
 
<?php
if (empty($comments)):?>
<p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
<?php endif; ?>
 
<?php foreach ($comments as $comment): ?>
<fieldset>
  <legend>
    Posté par <strong>Jean <!--(ici authenticated username) htmlspecialchars($comment['post_id'])--></strong> 
    le <?= strftime("%d/%m/%Y á %H:%M", strtotime($comment['created_at'])); ?>
    <?php if ($user->isAuthenticated()): ?> -
      <a href="admin/comment-update-<?= $comment['id'] ?>.html">Modifier</a> |
      <a href="admin/comment-delete-<?= $comment['id'] ?>.html">Supprimer</a>
    <?php endif; ?>
  </legend>
  <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
</fieldset>
    <?php endforeach; ?>
 
<!-- <p><a href="commenter-$post['id'].html">Ajouter un commentaire</a></p> -->
