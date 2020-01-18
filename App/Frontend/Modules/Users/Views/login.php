<h1 class="text-center mt-5">Connexion</h1>

<div class="row justify-content-center">
	<form action="" method="post" autocomplete="off" class="col-md-6">
		<p class="form-group">
			<label for="identifiant">Identifiant : </label>
			<input type="text" name="identify" id="identifiant" class="form-control" />
		</p>

		<p class="form-group">
			<label for="password">Mot de passe : </label>
			<input type="password" name="password" id="password" class="form-control" />
		</p>

		<input type="submit" name="login" class="btn btn-outline-info btn-lg" value="Connexion" />
		<p class="mt-3">
			<a href="/register" class="xs">S'inscrire</a> &nbsp;
			<!-- <a href="/forgot-password" class="xs">Mot de passe oublié?</a> -->
		</p>
	</form>
</div>