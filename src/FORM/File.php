<?php
namespace App\src\FORM;

class File extends Field
{
  public function buildWidget()
  {
    $widget = '';

    if (!empty($this->errorMessage))
    {
      $widget .= '<div class="text-danger">'.$this->errorMessage.'</div>';
      $widget .= '<input placeholder='.$this->label.' type="file" class="form-control is-invalid" name="'.$this->name.'"';
    }
    else{
        $widget .= '<input placeholder='.$this->label.' type="file" class="form-control" name="'.$this->name.'"';
    }
    if (!empty($this->value))
    {
        $widget .= htmlspecialchars($this->value);
    }
    $widget .= '>';

    return $widget.'</input>';
  }
}