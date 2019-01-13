<?php
/**
 * Form object that contains fields for managing entities
 *
 * PHP version 7.2
 *
 * @category Form
 * @package Form
 * @author Christophe PERROTIN
 * @copyright 2018
 * @license MIT License
 * @link http://wwww.perrotin.eu
 */
namespace App\src\FORM;

use App\src\model\Entity;

/**
 * Class Form
 * @package App\src\FORM
 */
class Form
{
    /**
     * @var
     */
    protected $entity;
    /**
     * @var array
     */
    protected $fields = [];

    /**
     * Form constructor.
     * @param Entity $entity
     */
    public function __construct(Entity $entity)
    {
        $this->setEntity($entity);
    }

    /**
     * @param Field $field
     * @return $this
     */
    public function add(Field $field)
    {
        $attr = 'get' . $field->name(); // On récupère le nom du champ.
        $field->setValue($this->entity->$attr()); // On assigne la valeur de l'objet au champ du formulaire.

        $this->fields[] = $field; // On ajoute le champ passé en argument à la liste des champs.
        return $this;
    }

    /**
     * @return string
     */
    public function createView()
    {
        $view = '';

        // On génère un par un les champs du formulaire.
        foreach ($this->fields as $field) {
            $view .= $field->buildWidget() ;
        }

        return $view;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $valid = true;

        // On vérifie que tous les champs sont valides.
        foreach ($this->fields as $field) {
            if (!$field->isValid()) {
                $valid = false;
            }
        }
        return $valid;
    }

    /**
     * @return mixed
     */
    public function entity()
    {
        return $this->entity;
    }

    /**
     * @param Entity $entity
     */
    public function setEntity(Entity $entity)
    {
        $this->entity = $entity;
    }
}