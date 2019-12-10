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
                                        created_at = NOW(),
                                        updated_at = NOW()
                                  ');
 
    $requete->bindValue(':username', $user->username());
    $requete->bindValue(':email', $user->email());
    $requete->bindValue(':password', $user->password());
    $requete->bindValue(':lastname', $user->lastname());
    $requete->bindValue(':firstname', $user->firstname());
 
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
 
  protected function modify(User $user)
  {
    $requete = $this->dao->prepare('UPDATE users 
                                    SET username = :username, email = :email,
                                      password = :password, firstname = :firstname,
                                      lastname = :lastname, updated_at = NOW() 
                                    WHERE id = :id');
 
    $requete->bindValue(':username', $user->username());
    $requete->bindValue(':email', $user->email());
    $requete->bindValue(':password', $user->password());
    $requete->bindValue(':firstname', $user->firstname());
    $requete->bindValue(':lastname', $user->lastname());
    $requete->bindValue(':id', $user->id(), \PDO::PARAM_INT);
 
    $requete->execute();
  }
}