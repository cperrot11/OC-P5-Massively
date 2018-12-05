<?php
namespace App\src\FORM;

class StringField extends Field
{
  protected $maxLength;
  private $type;
  protected $readonly;
  
  public function buildWidget()
  {
    $widget = '';
    $type = !($this->password)? '"text"' : '"password"';

    if (!empty($this->errorMessage))
    {
        $widget .= '<div class="text-danger">'.$this->errorMessage.'</div>';
        $widget .= '<input placeholder='.$this->label.' class="is-invalid" type="text" name="'.$this->name.'"';
    }
    else{
        $widget .= '<input placeholder='.$this->label.' type='.$type.' name="'.$this->name.'"';
    }

    
    if (!empty($this->value))
    {
      $widget .= ' value="'.htmlspecialchars($this->value).'"';
    }
    
    if (!empty($this->maxLength))
    {
      $widget .= ' maxlength="'.$this->maxLength.'"';
    }
    if ($this->readonly)
    {
        $widget.= 'readonly';
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