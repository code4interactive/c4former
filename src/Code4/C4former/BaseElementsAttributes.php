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
    protected $label;
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
    protected $postaddon;

    protected $attributes = array();


    public function icon($element) {

        if (is_null($this->icon)) return $element;

        $position = $this->iconposition == "right" ? 'input-icon-right' : '';

        return '<span class="input-icon '.$position.'">
                    '.$element.'
                    <i class="'.$this->icon.' blue"></i>
                </span>';

    }

    /**
     * Generates label and tooltip for field
     * @return string
     */
    public function label() {

        $tooltip = $this->tooltips() ? '<i class="'.\Icons::$bigger_110.' '.\Icons::$color_pink.' '.\Icons::$icon_question_sign .'" '.$this->tooltips().'></i>' : '';
        return '<label class="col-sm-3 control-label no-padding-right" for="'.$this->id.'">'.$this->label.' '.$tooltip.'</label>';

    }

    /**
     * Generates tooltip attributes
     * @return null|string
     */
    public function tooltips() {

        if (is_null($this->tooltip)) return null;
        $attributes = array(
            "data-rel"=>"tooltip",
            "data-placement"=>"top",
            "data-original-title"=>$this->tooltip,
            "data-container"=>"body"
        );
        return $this->attributesToString($attributes);
    }


    public function preaddon() {

        if (is_null($this->preaddon)) return null;
        if (substr($this->preaddon, 0, 4) == 'icon') {

            return '<span class="input-group-addon">
                    <i class="'.$this->preaddon.'"></i>
                </span>';

        } else {
            return '<span class="input-group-addon">'.$this->preaddon.'</span>';
        }
    }

    public function postaddon() {

        if (is_null($this->postaddon)) return null;
        if (substr($this->postaddon, 0, 4) == 'icon') {

            return '<span class="input-group-addon">
                    <i class="'.$this->postaddon.'"></i>
                </span>';

        } else {
            return '<span class="input-group-addon">'.$this->postaddon.'</span>';
        }
    }


    public function attributesToString($attributes) {

        $txt = "";

        foreach($attributes as $key => $value) {
            $txt .= ' '.$key.' = "'.$value.'" ';
        }
        return $txt;

    }

    public function __get($name) {


    }

    public function getName()
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
    }

    /**
     * Allows to set custom attributes for custom fields
     * @param $attributes
     */
    public function setCustom($attributes) {
        $this->attributes = $attributes;
    }
}