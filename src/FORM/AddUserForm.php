<?php
/**
 * Created by PhpStorm.
 * User: c.perrotin
 * Date: 26/09/2018
 * Time: 16:14
 */

namespace App\src\FORM;


class AddUserForm extends FormBuilder
{
    /**
     * fields required for the form
     */
    public function build()
    {
        $this->form->add(new StringField([
            'label' => 'Pseudo ',
            'name' => 'login',
            'maxLength' => 50,
            'validators' => array(
                new NotNullValidator('Merci de spécifier votre pseudo'),
                new MaxLengthValidator('pseudo spécifié est trop long 10 max', 10)
            )
            ]))
            ->add(new StringField([
                'label' => 'Nom ',
                'name' => 'name',
                'maxLength' => 30,
                'validators' => array(
                    new NotNullValidator('Merci de saisir votre nom'),
                    new MaxLengthValidator('Nom trop long 30 max', 30)
                )
            ]))
            ->add(new StringField([
                'label' => 'Mot de passe ',
                'password' => true,
                'name' => 'pass',
                'maxLength' => 20,
                'validators' => array(
                    new NotNullValidator('Merci de saisir un mot de passe'),
                    new MaxLengthValidator('mot de passe trop long 10 max', 20)
                )
            ]))
            ->add(new StringField([
                'label' => 'Adresse e-mail ',
                'name' => 'email',
                'maxLength' => 255,
                'validators' => array(
                    new NotNullValidator('Merci de saisir une adresse mail')
//                    créér un email validator
                )
            ]))
        ;
    }
}