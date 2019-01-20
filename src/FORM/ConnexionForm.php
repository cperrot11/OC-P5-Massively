<?php
/**
 * Created by PhpStorm.
 * User: c.perrotin
 * Date: 26/09/2018
 * Time: 16:14
 */

namespace App\src\FORM;


class ConnexionForm extends FormBuilder
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
                new MaxLengthValidator('pseudo spécifié est trop long 50 max', 50)
            )
            ]))
            ->add(new StringField([
                'label' => 'Mot de passe ',
                'password' => true,
                'name' => 'pass',
                'maxLength' => 20,
                'validators' => array(
                    new NotNullValidator('Merci de saisir un mot de passe'),
                    new MaxLengthValidator('mot de passe trop long 20 max', 20)
                )
            ]))
        ;
    }
}