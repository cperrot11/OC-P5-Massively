<?php
namespace App\src\FORM;

class File extends Field
{
  public function buildWidget()
  {
    $widget = '';

    if (!empty($this->errorMessage))
    {
      $widget .= '<div class="cpInvalid">'.$this->errorMessage.'</div>';
      $widget .= '<input type="file" class="is-invalid" name="'.$this->name.'"';
    }
    else{
        $widget .= '<input type="file" class="field" name="'.$this->name.'"';
    }
    if (!empty($this->value))
    {
        $widget .= htmlspecialchars($this->value);
    }
    $widget .= '>';

    return $widget.'</input>';
  }
}
