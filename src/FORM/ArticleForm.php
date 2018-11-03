<?php
/**
 * Created by PhpStorm.
 * User: c.perrotin
 * Date: 26/09/2018
 * Time: 16:14
 */

namespace App\src\FORM;


class ArticleForm extends FormBuilder
{
    public function build()
    {
        $this->form->add(new StringField([
            'label' => 'Titre',
            'name' => 'title',
            'maxLength' => 30,
            'validators' => array(
                new NotNullValidator('Merci de spécifier le titre'),
                new MaxLengthValidator('Le titre spécifié est trop long 30 max', 30)
            )
        ]))
            ->add(new TextField([
                'label' => 'Content',
                'name' => 'content',
                'rows' => 7,
                'cols' => 50,
                'validators' => array(
                    new NotNullValidator('Contenu vide impossible')
                )
        ]))
            ->add(new StringField([
                'label' => 'Auteur',
                'name' => 'author',
                'readonly' => true
        ]))
            ->add(new StringField([
            'label' => 'Date',
            'name' => 'DateAdded',
            'readonly' => true
        ]));

    }
}