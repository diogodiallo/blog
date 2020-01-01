<div class="row">
	<?php foreach ($posts as $post) : ?>
		<div class="col-lg-4">
			<svg class="bd-placeholder-img rounded-circle" width="120" height="120" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 140x140">
				<title>Placeholder</title>
				<rect width="100%" height="100%" fill="#777" />
				<text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
			</svg>

			<h2><a href="post-<?= $post['id'] ?>.html"><?= $post['title'] ?></a></h2>
			<div>
				<?= $post['resume'] ?>
			</div>
			<p><a class="btn btn-secondary" href="post-<?= $post['id'] ?>.html">Voir plus &raquo;</a></p>
		</div>
	<?php endforeach; ?>
</div>