<?php
namespace App\src\FORM;

class CheckboxField extends Field
{
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
        $widget .= '<label>'.$this->label.'</label><input type="checkbox" name="'.$this->name.'"';
    }

    
    if ($this->value=='Oui')
    {
      $widget .= ' value="'.htmlspecialchars($this->value).'"';
      $widget .= ' checked';
    }

    return $widget .= ' />';
  }
}