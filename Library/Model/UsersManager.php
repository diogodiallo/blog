<?php

namespace Model;

use \Core\Manager;
use \Core\User;

abstract class UsersManager extends Manager
{
	/**
	 * Méthode permettant d'ajouter une news.
	 * @param $post Post La news à ajouter
	 * @return void
	 */
	abstract protected function add(User $user);

	/**
	 * Méthode permettant d'enregistrer un utilisateur.
	 * @param $user User le user à été enregistrer
	 * @see self::add()
	 * @see self::modify()
	 * @return void
	 */
	public function save(User $user)
	{
		if ($user->isValid()) {
			$user->isNew() ? $this->add($user) : $this->modify($user);
		} else {
			throw new \RuntimeException('L\'utilisateur doit être valide pour être enregistré');
		}
	}

	/**
	 * Méthode renvoyant le nombre de users total.
	 * @return int
	 */
	abstract public function count();

	/**
	 * Méthode permettant de supprimer un user.
	 * @param $id int L'identifiant du user à supprimer
	 * @return void
	 */
	abstract public function delete($id);

	/**
	 * Méthode retournant une liste des users demandés.
	 * @param $debut int La première news à sélectionner
	 * @param $limite int Le nombre de news à sélectionner
	 * @return array La liste des news. Chaque entrée est une instance de News.
	 */
	abstract public function getAllUsers();

	/**
	 * Méthode retournant un users précis.
	 * @param $id int L'identifiant du user à récupérer
	 * @return User le user demandé
	 */
	abstract public function getUnique($id);

	/**
	 * Méthode permettant de modifier un user.
	 * @param $user User le user à modifier
	 * @return void
	 */
	abstract protected function modify(User $user);
}
