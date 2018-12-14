<?php
namespace App\src\FORM;

class PictureField extends Field
{
  public function buildWidget()
  {
    $widget = '';
    
    if (!empty($this->errorMessage))
    {
      $widget .= '<div class="text-danger">'.$this->errorMessage.'</div>';
      $widget .= '<label>'.$this->label.'<textarea placeholder='.$this->label.' class="is-invalid" name="'.$this->name.'"';
    }
    else{
        $widget .= '<span class="image left"><img src="../uploads/'.$this->value.'" alt=""></span>';
    }
    return $widget;
  }
}
