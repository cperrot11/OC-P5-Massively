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
            'open' => true,
            'validators' => array(
                new NotNullValidator('Merci de spécifier le titre'),
                new MaxLengthValidator('Le titre spécifié est trop long 50 max', 50)
            )
        ]))
            ->add(new StringField([
                'label' => 'Date',
                'name' => 'DateAdded',
                'open' => false,
                'readonly' => true
            ]))
            ->add(new TextField([
                'label' => 'Contenu',
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
                'open' => true,
                'readonly' => true
        ]))

            ->add(new StringField([
                'label'=>'Fichier image actuel',
                'name'=>'picture_file',
                'open' => false,
                'readonly' => true
            ]))
            ->add(new PictureField([
                'label'=>'Fichier image',
                'name'=>'picture_file'
            ]))
            ->add(new File([
                'label'=>'Nouveau fichier image',
                'name'=>'picture',
                'validators' => array(
                    new PictureSizeValidator('Taille maximum 2Mo',2000000,isset($_FILES['picture'])?$_FILES['picture']['size']:0),
                    new PictureValidator('Extension autorisés = jpg, jpeg, bmp, png uniquement')
                )
        ]))
;
    }
}