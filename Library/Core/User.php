<?php

namespace Core;


session_start();

class User extends \Core\Entity
{
    public $rights;
    public $id;
    public $username;
    public $email;
    public $password;
    public $firstname;
    public $lastname;
    public $created_at;


    public function isValid()
    {
        return !(empty($this->username) || empty($this->email) || empty($this->password));
    }

    /**  ******* GETTERS *******   */
    /******************************/

    /**
     * Get the value of id
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Get the value of username
     */
    public function username()
    {
        return $this->username;
    }

    /**
     * Get the value of email
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * Get the value of password
     */
    public function password()
    {
        return password_hash($this->password, PASSWORD_BCRYPT);
    }

    /**
     * Get the value of firstname
     */
    public function firstname()
    {
        return $this->firstname;
    }

    /**
     * Get the value of lastname
     */
    public function lastname()
    {
        return $this->lastname;
    }

    /**
     * Get the value of rights
     */
    public function rights()
    {
        return isset($_SESSION['rights']) ? $_SESSION['rights'] : $this->rights;
    }

    /**
     * Get the value of created_at
     */
    public function created_at()
    {
        return $this->created_at;
    }

    /**  ******* SETTERS *******   */
    /******************************/

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }



    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }



    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }



    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }



    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }



    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Set the value of rights
     *
     * @return  self
     */
    public function setRights(array $rights)
    {
        $_SESSION['rights'] = $rights;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

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
        if (!is_bool($authenticated)) {
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
    public function userIsAdmin(): bool
    {
        return ($_SESSION['user_role_id'] == 1) ? true : false;
    }
}
