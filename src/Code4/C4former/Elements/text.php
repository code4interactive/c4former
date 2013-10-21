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

class text extends BaseElement implements ElementInterface {

    protected $type = "text";

    public function render() {

        $element = '<input type="text" name="'.$this->name.'" id="'.$this->id.'" placeholder="'.$this->placeholder.'" class="" value="'.$this->getValue().'">';

        $addon = '<div class="form-group">
                    '.$this->label().'
                    <div class="col-xs-12 col-sm-1 input-group">
                        '.$this->preaddon().
                         $this->icon($element)
                        .$this->postaddon().'
                    </div>
                </div>';

        return $addon;

    }


    public function renderNaked() {
        return '<input type="text" id="form-field-1" placeholder="'.$this->placeholder.'" class="col-xs-10 col-sm-5">';
    }
}