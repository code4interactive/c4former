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

class password extends BaseElement implements ElementInterface {

    protected $type = "text";

    public function render() {

        $element = '<input type="password" name="'.$this->name.'" id="'.$this->id.'" placeholder="'.$this->placeholder.'" class="" '.$this->getAttribute('readonly').'>';

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
}