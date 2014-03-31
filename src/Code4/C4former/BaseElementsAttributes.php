<?php
/**
 * Created by CODE4Interactive.
 * User: Artur Bartczak
 * Date: 19.09.13
 * Time: 21:01
 */

namespace Code4\C4former;


use Code4\C4former\Elements;

abstract class BaseElementsAttributes   {

    protected $id;
    protected $name;
    protected $type;

    /*protected $label;
    protected $placeholder;
    protected $tooltip;
    protected $value;
    protected $parentValue;
    protected $class;

    protected $rules;
    protected $message;
    protected $validation;
    protected $action;

    protected $readonly;
    protected $mode;

    protected $icon;
    protected $iconposition;

    protected $preaddon;
    protected $postaddon;*/

    //protected $attributes = array();


    /*public function getAttribute($attributeName, $default=null){
        if (isset($this->$attributeName)) {
            return $attributeName.'="'.$this->$attributeName.'" ';
        } else {
            if ($default != null) {
                return $default;
            }
        }
        return null;
    }*/


    /**
     * Magic methods for all attributes
     * @param  [type] $name [description]
     * @return [type]       [description]
     */
    /*public function __get($name) {
        if (array_key_exists($name, $this->attributes)) {
            return $this->attributes[$name];
        }
        return null;
    }

    public function __set($name, $value) {
        $this->attributes[$name] = $value;
    }*/

    /**
     * Magiczna metoda dla getów i setów attrybutów
     * Zastępuje wszystkie ręcznie pisane getName, setName itp
     */
    /*public function __call($name, $arguments) {

        if (substr($name, 0, 3) === 'set') {
            $attribute = strtolower(substr($name, 3));
            $this->{$attribute} = $arguments[0];
        } else if(substr($name, 0, 3) === 'get') {
            $attribute = strtolower(substr($name, 3));
            return $this->{$attribute};
        }
    }*/


    /**public function getName()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function setValidation($validation)
    {
        $this->validation = $validation;
    }

    public function setPlaceholder($placeholder)
    {
        $this->placeholder = $placeholder;
    }

    public function setClass($class)
    {
        $this->class = $class;
    }

    public function setParentValue($parentValue)
    {
        $this->parentValue = $parentValue;
    }

    public function setAction($action)
    {
        $this->action = $action;
    }*/

    /**
     * Allows to set custom attributes for custom fields
     * @param $attributes
     */
    /*public function setCustom($attributes) {
        $this->attributes = $attributes;
    }*/
}