<?php
/**
 * Created by CODE4Interactive.
 * User: Artur Bartczak
 * Date: 19.09.13
 * Time: 21:00
 */

namespace Code4\C4former\Elements;

use Code4\C4former\BaseElement;
use Code4\C4former\ElementInterface;

class button extends BaseElement implements ElementInterface {

    protected $type = "button";

    public function render() {

        $element = '<input type="text" name="'.$this->name.'" id="'.$this->id.'" '.$this->tooltips().' placeholder="'.$this->placeholder.'" class="">';

        $addon = '<button class="btn btn-info '.$this->class.'" type="submit">
                    <i class="'.$this->icon.' bigger-110"></i>
                    Submit
                </button>';


        /*$addon = '<div class="form-group">
                    '.$this->label().'
                    <div class="col-xs-10 col-sm-5 input-group">
                        '.$this->preaddon().
                        $this->icon($element)
                        .$this->postaddon().'
                    </div>
                </div>';*/

        return $addon;

    }


    public function renderNaked() {
        return '<input type="text" id="form-field-1" placeholder="'.$this->placeholder.'" class="col-xs-10 col-sm-5">';
    }
}