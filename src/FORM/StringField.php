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
    $widget.= ($this->open)=='open'?"<div class='fields'>":"";

    if (!empty($this->errorMessage))
    {
        $widget .= '<div class="cpInvalid">'.$this->errorMessage.'</div>';
        $widget .= '<label class="field half">'.$this->label.'<input placeholder='.$this->label.' class="is-invalid" type="text" name="'.$this->name.'"';
    }
    else{
        $widget .= '<label class="field half">'.$this->label.'<input placeholder='.$this->label.' type='.$type.' name="'.$this->name.'"';
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
    $widget .= ' /></label>';
    $widget.= ($this->open)=='close'?"</div>":"";

    return $widget;
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