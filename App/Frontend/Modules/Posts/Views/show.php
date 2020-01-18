<p>Post écrit par <em><?= ucfirst($post->username) ?></em>, le <?= $post['created_at']->format('d/m/Y à H\hi') ?></p>
<h2><?= $post['title'] ?></h2>
<p class="px-3 bg-secondary text-light">
	<strong>Resumé :</strong> <br>
	<?= $post['resume'] ?>
</p>
<div><?= nl2br($post['content']) ?></div>

<?php if ($post['created_at'] != $post['updated_at']) : ?>
	<p class="float-right">
		<small>
			<em>Modifiée le
				<?= $post['updated_at']->format('d/m/Y à H\hi') ?>
			</em>
		</small>
	</p>
<?php endif; ?>

<?php if ($user->isAuthenticated()) : ?>
	<p>
		<a href="/comment-<?= $post['id'] ?>.html" class="mt-4 btn btn-primary">
			Ajouter un commentaire
		</a>
	</p>
<?php else : ?>
	<p class="alert alert-warning mt-2 mb-3">
		Pour ajouter un commentaire vous devez vous <a href="/register">inscrire</a>
	</p>
<?php endif; ?>

<?php if (empty($comments)) : ?>
	<p>Aucun commentaire n'a encore été posté. Soyez le premier à en laisser un !</p>
<?php endif; ?>

<?php foreach ($comments as $comment) : ?>
	<fieldset>
		<legend>
			Posté par <strong><?= $comment['username'] ?? 'Jean'; ?></strong>
			le <?= $comment['created_at']->format('d/m/Y á H\hi'); ?>
			<?php if ($user->userIsAdmin()) : ?>
				<?php if ($user->isAuthenticated()) : ?> -
					<a href="admin/comment-update-<?= $comment['id'] ?>.html">Modifier</a> |
					<a href="admin/comment-delete-<?= $comment['id'] ?>.html" onclick="return confirm('Voulez-vous supprimer ce commentaire?')">
						Supprimer
					</a>
				<?php endif; ?>
			<?php endif; ?>
		</legend>
		<p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
	</fieldset>
<?php endforeach; ?>

<p class="text-center"><a href="/posts" class="btn btn-outline-info btn-block">Revenir aux articles</a></p>