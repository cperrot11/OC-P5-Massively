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
            'open' => 'open',
            'validators' => array(
                new NotNullValidator('Merci de spécifier le titre'),
                new MaxLengthValidator('Le titre spécifié est trop long 50 max', 50)
            )
        ]))
            ->add(new StringField([
                'label' => 'Date',
                'name' => 'DateAdded',
                'open' => 'close',
                'readonly' => true
            ]))
            ->add(new StringField([
                'label' => 'Chapô',
                'name' => 'chapo',
                'validators' => array(
                    new NotNullValidator('Merci de spécifier le chapô'),
                    new MaxLengthValidator('Le chapô spécifié est trop long 512 max', 512)
                )
            ]))
            ->add(new TextField([
                'label' => 'Contenu',
                'name' => 'content',
                'rows' => 5,
                'cols' => 50,
                'validators' => array(
                    new NotNullValidator('Contenu vide impossible')
                )
        ]))
            ->add(new StringField([
                'label' => 'Auteur',
                'name' => 'author',
                'open' => 'open',
                'readonly' => true
        ]))

            ->add(new StringField([
                'label'=>'Fichier image actuel',
                'name'=>'picture_file',
                'open' => 'close',
                'readonly' => true
            ]))
            ->add(new PictureField([
                'label'=>'Fichier image',
                'name'=>'picture_file',
                'open' => 'open'
            ]))
            ->add(new File([
                'label'=>'Nouveau fichier image',
                'name'=>'picture',
                'open' => 'close',
                'validators' => array(
                    new PictureSizeValidator('Taille maximum 2Mo',2000000,isset($_FILES['picture'])?$_FILES['picture']['size']:0),
                    new PictureValidator('Extension autorisés = jpg, jpeg, bmp, png uniquement')
                )
        ]))
;
    }
}