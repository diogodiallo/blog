<?php

namespace Entity;

use \Core\Entity;

class Contact extends Entity
{
	protected $id;
	protected $email;
	protected $name;
	protected $subject;
	protected $content;
	protected $created_at;

	public function isValid()
	{
		return !(empty($this->email) || empty($this->subject) || empty($this->content));
	}

	/**
	 * Get the value of id
	 */
	public function getId()
	{
		return $this->id;
	}

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
	 * Get the value of email
	 */
	public function getEmail()
	{
		return $this->email;
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
	 * Get the value of name
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set the value of name
	 *
	 * @return  self
	 */
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Get the value of subject
	 */
	public function getSubject()
	{
		return $this->subject;
	}

	/**
	 * Set the value of subject
	 *
	 * @return  self
	 */
	public function setSubject($subject)
	{
		$this->subject = $subject;

		return $this;
	}

	/**
	 * Get the value of content
	 */
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * Set the value of content
	 *
	 * @return  self
	 */
	public function setContent($content)
	{
		$this->content = $content;

		return $this;
	}

	/**
	 * Get the value of created_at
	 */
	public function getCreated_at()
	{
		return $this->created_at;
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
}
