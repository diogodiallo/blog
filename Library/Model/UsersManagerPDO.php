<?php

namespace Model;
 
use \Entity\User;
 
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
    $requete->bindValue(':token', $user->token());
 
    $requete->execute();
  }
 
  public function count()
  {
    return $this->dao->query('SELECT COUNT(id) FROM users')->fetchColumn();
  }
 
  public function delete($id)
  {
    $this->dao->exec('DELETE FROM users WHERE id = '.(int) $id);
  }
 
  public function getAllUsers()
  {
    $sql = 'SELECT id, username, email, password, lastname, firstname, created_at
            FROM users 
            ORDER BY id DESC';
 
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
 
    $users = $requete->fetchAll();
 
    foreach ($users as $user)
    {
      $user->setCreated_at(new \DateTime($user->created_at()));
    }
 
    $requete->closeCursor();
 
    return $users;
  }

  public function getUserBy($identify)
  {
    $sql = 'SELECT u.id, username, email, r.name, u.password, lastname, firstname, created_at
            FROM users u
            INNER JOIN roles r 
              ON r.id = u.role_id
            WHERE (email = :identify OR username = :identify)';
 
    $request = $this->dao->prepare($sql);
    $request->bindValue(':identify', $identify);
    $request->execute();

    $user = $request->fetch();
    $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
    return $user;
  }

  public function getUser($user)
  {
    	$sql = 'SELECT u.id, u.role_id, r.name, u.username, u.email, u.token, u.password, created_at
            FROM users u
            INNER JOIN roles r
              ON u.id = u.role_id
            WHERE u.username = ?
            ORDER BY u.id';
 
		$req = $this->dao->prepare($sql);
		$req->execute([$user]);
		$userConnected = $req->fetch();
		$req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
		return $userConnected;
  }
 
  public function getUnique($id)
  {
		$requete = $this->dao->prepare('SELECT id, username, email, password, lastname, firstname, created_at 
										FROM users 
										WHERE id = :id');
		$requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
		$requete->execute();
	
		$requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
	
		if ($user = $requete->fetch())
		{
		$user->setCreated_at(new \DateTime($user->created_at()));
	
		return $user;
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

  public function findUserBy($username)
  {
    $req = $this->dao->prepare("SELECT id, email, username, token 
                                FROM users
                                WHERE username = ?  
                              ");
    $req->execute([$username]);

    return $req->fetch();                   
  }

 
  public function updateUser($username)
  {
		$requete = $this->dao->prepare('UPDATE users 
										SET isConfirmed = 1, 
										token = :token,
                                    	WHERE username = :username
                                    ');
	
		$requete->bindValue(':username', $username);
		$requete->bindValue(':token', '');
	
		$requete->execute();
  }

  /**
   * Gestion des permissions des posts, comments et users modules 
   */ 
  public function addPostPermission()
  {
    $req = $this->dao->prepare("INSERT INTO permissions(module, description) 
                        VALUES('POSTS', 'Voir un article'),
                        ('POSTS', 'Ajouter un article'),
                        ('POSTS', 'Modifier un article'),
                        ('POSTS', 'Supprimer un article')
                    ");
    $req->execute();
  }

  public function addUserPermission()
  {
    $req = $this->dao->prepare("INSERT INTO permissions(module, description) 
                        VALUES('USERS', 'Afficher un utilisateur'),
                        ('USERS', 'Ajouter un utilisateur'),
                        ('USERS', 'Modifier un utilisateur'),
                        ('USERS', 'Supprimer un utilisateur')
                    ");
    $req->execute();
  }

  public function addCommentPermission()
  {
    $req = $this->dao->prepare("INSERT INTO permissions(module, description) 
                        VALUES('COMMENTS', 'Voir un commentaire'),
                        ('COMMENTS', 'Ajouter un commentaire'),
                        ('COMMENTS', 'Modifier un commentaire'),
                        ('COMMENTS', 'Supprimer un commentaire')
                    ");
    $req->execute();
  }

  public function addPostRolePermission()
  {
    $req = $this->dao->prepare("INSERT INTO roles_permissions(role_id, permission_id, permission_module) 
                        VALUES(1, 1, 'POSTS'),
                        (1, 2, 'POSTS'),
                        (1, 3, 'POSTS'),
                        (1, 4, 'POSTS'),
                        (2, 1, 'POSTS'),
                        (2, 2, 'POSTS'),
                        (2, 3, 'POSTS')
                    ");
    $req->execute();
  }


  public function getRolesPermissions()
  {
    $req = $this->dao->prepare("SELECT rp.role_id, permission_id, permission_module 
                                FROM roles_permissions rp
                                LEFT JOIN users u 
                                  ON rp.role_id = u.role_id
                                WHERE rp.role_id = ?  
                              ");
    
    $req->execute(['rp.role_id']);

    while ($row = $req->fetch()) {
      $_SESSION['role_id'] = $row['role_id'];
      $_SESSION['permission_id'] = $row['permission_id'];
      $_SESSION['permission_module'] = $row['permission_module'];
    }
  }
}