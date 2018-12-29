<?php
namespace App\src\FORM;

class File extends Field
{
  public function buildWidget()
  {
    $widget = '';
    $widget.= ($this->open)=='open'?"<div class='fields'>":"";
    if (!empty($this->errorMessage))
    {
      $widget .= '<div class="cpInvalid">'.$this->errorMessage.'</div>';
      $widget .= '<label class="field half">Nouveau fichier<input type="file" class="is-invalid" name="'.$this->name.'"';
    }
    else{
        $widget .= '<label class="field half">Nouveau fichier<input type="file" class="field half" name="'.$this->name.'"';
    }
    if (!empty($this->value))
    {
        $widget .= htmlspecialchars($this->value);
    }
    $widget.= '></input></label>';
    $widget.= ($this->open)=='close'?"</div>":"";
    return $widget;
  }
}
