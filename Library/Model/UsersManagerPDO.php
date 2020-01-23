<?php

namespace Model;

use \Core\User;

class UsersManagerPDO extends UsersManager
{
	protected function add(User $user)
	{
		$requete = $this->dao->prepare('INSERT INTO users 
                                    SET username = :username,
                                        email = :email,
                                        password = :password,
                                        lastname = :lastname,
                                        firstname = :firstname,
										token = :token,
                                        created_at = NOW(),
                                        updated_at = NOW()
                                  ');

		$requete->bindValue(':username', $user->username());
		$requete->bindValue(':email', $user->email());
		$requete->bindValue(':password', $user->password());
		$requete->bindValue(':lastname', $user->lastname());
		$requete->bindValue(':firstname', $user->firstname());
		$requete->bindValue(':token', uniqid("#", true));

		$requete->execute();
	}

	public function count()
	{
		return $this->dao->query('SELECT COUNT(id) FROM users')->fetchColumn();
	}

	public function delete($id)
	{
		$this->dao->exec('DELETE FROM users WHERE id = ' . (int) $id);
	}

	public function getAllUsers()
	{
		$sql = 'SELECT id, username, email, password, lastname, firstname, token, created_at
            	FROM users 
            	ORDER BY id DESC';

		$requete = $this->dao->query($sql);
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Core\User');

		$users = $requete->fetchAll();

		foreach ($users as $user) {
			$user->setCreated_at(new \DateTime($user->created_at()));
		}

		$requete->closeCursor();

		return $users;
	}

	public function getUserBy($identify)
	{
		$sql = 'SELECT u.id, username, role_id, email, r.name, u.password, lastname, 
						firstname, token, created_at
            FROM users u
            INNER JOIN roles r 
              ON r.id = u.role_id
            WHERE (email = :identify OR username = :identify)';

		$request = $this->dao->prepare($sql);
		$request->bindValue(':identify', $identify);
		$request->execute();

		$user = $request->fetch();
		$request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Core\User');
		return $user;
	}

	public function getUser($user)
	{
		$sql = 'SELECT u.id, u.role_id, r.name, u.username, u.token, u.email, u.password, created_at
            FROM users u
            INNER JOIN roles r
              ON u.id = u.role_id
            WHERE u.username = ?
            ORDER BY u.id';

		$req = $this->dao->prepare($sql);
		$req->execute([$user]);
		$userConnected = $req->fetch();
		$req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Core\User');
		return $userConnected;
	}

	public function getUnique($id)
	{
		$requete = $this->dao->prepare('SELECT id, username, email, password, lastname, firstname, created_at 
										FROM users 
										WHERE id = :id');
		$requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
		$requete->execute();

		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Core\User');

		if ($user = $requete->fetch()) {
			$user->setCreated_at(new \DateTime($user->created_at()));

			return $user;
		}

		return null;
	}

	public function getOne($username, $password)
	{
		$requete = $this->dao->prepare('SELECT * FROM users WHERE username = :username');
		$requete->bindValue(':username', $username);
		$requete->execute();

		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Core\User');

		if ($user = $requete->fetch()) {

			$isPasswordCorrect = password_verify($password, $user->password);

			if ($isPasswordCorrect) {
				$rightsRequest = $this->dao->prepare('SELECT rightName FROM rights r
														INNER JOIN users u 
														 ON r.role_id <= :role 
														WHERE u.id = :id
													');

				$rightsRequest->bindValue(':role', $user->role_id);
				$rightsRequest->bindValue(':id', $user->id);
				$rightsRequest->execute();
				
				$userRight = [];

				while ($right = $rightsRequest->fetch()) {
					$userRight[] = strtolower($right['rightName']);
				}

				$user->setRights($userRight);
				$rightsRequest->closeCursor();
				return $user;
			} else {
				return null;
			}
		}

		return null;
	}

	public function userAlreadyExist($field, $value, $table)
	{
		$query = $this->dao->prepare("SELECT id 
                                FROM $table
                                WHERE $field = ?
                              ");
		$query->execute([$value]);

		return $query->rowCount();
	}

	public function modify(User $user)
	{
		$req = $this->dao->exec("UPDATE users SET id = $user");
	}

	public function updateUser($username)
	{
		$requete = $this->dao->prepare('UPDATE users 
										SET isConfirmed = 1,
										token = ""
                                    	WHERE username = :username
                                    ');

		$requete->bindValue(':username', $username);
		$requete->execute();
	}

}
