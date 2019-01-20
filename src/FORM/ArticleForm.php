<?php
/**
 * Field required in article form
 *
 * @link http://wwww.perrotin.eu
 */


namespace App\src\FORM;


/**
 * Class ArticleForm
 *
 * @package App\src\FORM
 */
class ArticleForm extends FormBuilder
{
    /**
     * Fields required for the form
     *
     * @return void
     */
    public function build()
    {
        $texte1 = 'Le titre spécifié est trop long 50 max';
        $texte2= 'Le chapô spécifié est trop long 512 max';
        $actualsize = isset($_FILES['picture'])?$_FILES['picture']['size']:0;
        $this->form->add(
            new StringField(
            [
            'label' => 'Titre',
            'name' => 'title',
            'open' => 'open',
            'validators' => array(
                new NotNullValidator('Merci de spécifier le titre'),
                new MaxLengthValidator($texte1, 50)
                )
            ]
        )
        )
            ->add(
                new StringField(
                [
                'label' => 'Date',
                'name' => 'DateAdded',
                'open' => 'close',
                'readonly' => true
                ]
            )
            )
            ->add(
                new StringField(
                [
                'label' => 'Chapô',
                'name' => 'chapo',
                'validators' => array(
                    new NotNullValidator('Merci de spécifier le chapô'),
                    new MaxLengthValidator($texte2, 512)
                    )
                ]
            )
            )
            ->add(
                new TextField(
                [
                'label' => 'Contenu',
                'name' => 'content',
                'rows' => 5,
                'cols' => 50,
                'validators' => array(
                    new NotNullValidator('Contenu vide impossible')
                    )
                ]
            )
            )
            ->add(
                new StringField(
                [
                'label' => 'Auteur',
                'name' => 'author',
                'open' => 'open',
                'readonly' => true
                ]
            )
            )
            ->add(
                new StringField(
                [
                'label'=>'Fichier image actuel',
                'name'=>'picture_file',
                'open' => 'close',
                'readonly' => true
                ]
            )
            )
            ->add(
                new PictureField(
                [
                'label'=>'Fichier image',
                'name'=>'picture_file',
                'open' => 'open'
                ]
            )
            )
            ->add(
                new File(
                [
                'label'=>'Nouveau fichier image',
                'name'=>'picture',
                'open' => 'close',
                'validators' => array(
                    new PictureSizeValidator('Taille maximum 2Mo',2000000, $actualsize),
                    new PictureValidator('Extension autorisés = jpg, jpeg, bmp, png uniquement')
                    )
                ]
            )
            );
    }
}