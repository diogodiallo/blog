<?php

namespace Core;
use \Core\HTTPResponse;
 
session_start();
 
class User
{
  public function getAttribute($attr)
  {
    return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
  }
 
  public function getFlash()
  {
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
 
    return $flash;
  }
 
  public function hasFlash()
  {
    return isset($_SESSION['flash']);
  }
 
  public function isAuthenticated()
  {
    return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
  }
 
  public function setAttribute($attr, $value)
  {
    $_SESSION[$attr] = $value;
  }
 
  public function setAuthenticated($authenticated = true)
  {
    if (!is_bool($authenticated))
    {
      throw new \InvalidArgumentException('La valeur spécifiée à la méthode 
                                            User::setAuthenticated() doit être un boolean');
    }
 
    $_SESSION['auth'] = $authenticated;
  }
 
  public function setFlash($value, $type = 'info')
  {
    $_SESSION['flash'] = $value;
    $_SESSION['type'] = $type;
  }

  /**
   * Filter user not authenticated
   */
  public function userNotAdmin()
  {
	if (!isset($_SESSION['role_name']) && ($_SESSION['role_name'] !== "Admin" 
		||  $_SESSION['role_name'] !== "Super Admin" )) {
		header('Location:/login');
		$this->setFlash('Vous ne disposer pas des droits necessaires pour y accéder!', 'danger');
		exit();
    }
  }

  /**
   * Filter user connected
   * If user is connected => redirect to user profil
   */
  public function userIsConnected()
  {
    if (isset($_SESSION['user'])) {
		header('Location:/profil');
		$this->setFlash('Vous êtes déjà connecté, vous ne pouvez accéder à cette page', 'success');
		exit();
    }
  }



  /**
   ** @param  $module, $id
   * @return int $id
   */
  public function checkPermission($module, $id)
  {
    return in_array($id, $_SESSION['user']['permissions'][$module]);
  }
}