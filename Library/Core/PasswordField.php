<?php

namespace Core;
 
class PasswordField extends Field
{
 
  public function buildWidget()
  {
    $widget = '';
 
    if (!empty($this->errorMessage)) {
      $widget .= $this->errorMessage.'<br />';
    }
 
    $widget .= '<label>'.$this->label.' : </label><input type="password" name="'.$this->name.'"';
 
    if (!empty($this->value)) {
      $widget .= ' value="'.htmlspecialchars($this->value).'"';
    }
 
    return $widget .= ' />';
  }

}