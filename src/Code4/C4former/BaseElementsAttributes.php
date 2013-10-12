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

    protected $rules;
    protected $message;
    protected $validation;

    protected $readonly;
    protected $mode;

    protected $icon;
    protected $iconposition;

    protected $preaddon;
    protected $postaddon;

    private $attributes = array();


    public function tooltips() {

        \Log::error('tooltips');
        if (is_null($this->tooltip)) return array();

        $attributes = array(
            "data-rel"=>"tooltip",
            "data-placement"=>"bottom",
            "data-original-title"=>$this->tooltip
        );

        return $this->attributesToString($attributes);
    }


    public function preaddon() {

        if (is_null($this->preaddon)) return null;

        return '<span class="input-group-addon">
                    <i class="'.$this->preaddon.'"></i>
                </span>';

    }

    public function postaddon() {

        if (is_null($this->postaddon)) return null;

        return '<span class="input-group-addon">
                    <i class="'.$this->postaddon.'"></i>
                </span>';

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

}