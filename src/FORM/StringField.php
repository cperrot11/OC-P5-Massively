<?php
namespace App\src\FORM;

class StringField extends Field
{
  protected $maxLength;
  private $type;
  
  public function buildWidget()
  {
    $widget = '';
    $type = !($this->password)? '"text"' : '"password"';

    if (!empty($this->errorMessage))
    {
        $widget .= '<div class="text-danger">'.$this->errorMessage.'</div>';
        $widget .= '<label class="control-label">'.$this->label.'</label>';
        $widget .= '<input class="form-control is-invalid" type="text" name="'.$this->name.'"';
    }
    else{
        $widget .= '<label>'.$this->label.'</label><input type='.$type.' name="'.$this->name.'"';
    }

    
    if (!empty($this->value))
    {
      $widget .= ' value="'.htmlspecialchars($this->value).'"';
    }
    
    if (!empty($this->maxLength))
    {
      $widget .= ' maxlength="'.$this->maxLength.'"';
    }

    return $widget .= ' />';
  }
  
  public function setMaxLength($maxLength)
  {
    $maxLength = (int) $maxLength;
    
    if ($maxLength > 0)
    {
      $this->maxLength = $maxLength;
    }
    else
    {
      throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
    }
  }
}