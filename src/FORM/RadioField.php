<?php
namespace App\src\FORM;

class RadioField extends Field
{
  protected $checked;

  public function buildWidget()
  {
    $widget = '';

    if (!empty($this->errorMessage))
    {
        $widget .= '<div class="text-danger">'.$this->errorMessage.'</div>';
        $widget .= '<label class="control-label">'.$this->label.'</label>';
        $widget .= '<input class="form-control is-invalid" type="text" name="'.$this->name.'"';
    }
    else{
        $widget .= '<label>'.$this->label.'</label><input type="radio" name="'.$this->name.'"';
    }

    
    if (!empty($this->value))
    {
      $widget .= ' value="'.htmlspecialchars($this->value).'"';
    }
    
    if (!empty($this->checked))
    {
      $widget .= ' checked="'.$this->checked.'"';
    }

    return $widget .= ' />';
  }
}