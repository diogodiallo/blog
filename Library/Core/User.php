<?php

namespace Core;
 
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
  public function userIsAdmin():bool
  {
	if ( ($_SESSION['role_name'] === "Admin" ||  $_SESSION['role_name'] === "Super Admin") ) {
		return true;
	}
	return false;
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