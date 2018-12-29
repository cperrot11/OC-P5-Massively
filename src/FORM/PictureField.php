<?php
namespace App\src\FORM;

class PictureField extends Field
{
  public function buildWidget()
  {
    $widget = '';
    $widget.= ($this->open)=='open'?"<div class='fields'>":"";
    
    if (!empty($this->errorMessage))
    {
      $widget .= '<div class="text-danger">'.$this->errorMessage.'</div>';
      $widget .= '<label class="field half">'.$this->label.'<textarea placeholder='.$this->label.' class="is-invalid" name="'.$this->name.'"';
    }
    else{
        $widget .= '<label class="field half image fit"><img src="../uploads/'.$this->value.'" alt=""></label>';
    }
    $widget.= ($this->open)=='close'?"</div>":"";
    return $widget;
  }
}
