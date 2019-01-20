<?php
/**
 * Control for Comment Form
 */

namespace App\src\FORM;


class CommentForm extends FormBuilder
{
    /**
     * fields required for the form
     */
    public function build()
    {
        $texte1 = 'Merci de spécifier l\'auteur ';
        $texte1.= '-> connexion obligatoire pour commenter un article';
        $this->form->add(new StringField([
            'label' => 'Pseudo',
            'name' => 'pseudo',
            'maxLength' => 50,
            'readonly' => true,
            'validators' => array(
                new NotNullValidator($texte1),
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