<?php
/**
 * Created by PhpStorm.
 * User: c.perrotin
 * Date: 26/09/2018
 * Time: 16:14
 */

namespace App\src\FORM;


class ContactForm extends FormBuilder
{
    public function build()
    {
        $this->form->add(new StringField([
            'label' => 'Votre nom',
            'name' => 'nom',
            'maxLength' => 30,
            'validators' => array(
                new NotNullValidator('Merci de spécifier votre nom'),
                new MaxLengthValidator('Le titre spécifié est trop long 30 max', 30)
            )
        ]))
            ->add(new StringField([
                'label' => 'Votre adresse email',
                'name' => 'mail'
            ]))
            ->add(new TextField([
                'label' => 'Votre message',
                'name' => 'content',
                'rows' => 5,
                'cols' => 30,
                'validators' => array(
                    new NotNullValidator('Contenu vide impossible')
                )
        ]));

    }
}