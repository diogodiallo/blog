<?php

namespace Core;

class NotNullValidator extends Validator
{
  public function isValid($value)
  {
    return $value != '';
  }
}
