<?php
/**
 * Created by PhpStorm.
 * User: c.perrotin
 * Date: 26/09/2018
 * Time: 16:14
 */

namespace App\src\FORM;


class CommentForm extends FormBuilder
{
    public function build()
    {
        $this->form->add(new StringField([
            'label' => 'Pseudo',
            'name' => 'pseudo',
            'maxLength' => 50,
            'readonly' => true,
            'validators' => array(
                new NotNullValidator('Merci de spécifier l\'auteur'),
                new MaxLengthValidator('L\'auteur spécifié est trop long 10 max', 10)
            )
        ]))
            ->add(new TextField([
                'label' => 'Content',
                'name' => 'content',
                'rows' => 7,
                'cols' => 50,
                'validators' => array(
                    new NotNullValidator('Commentaire vide impossible')
                )
            ]));
    }
}