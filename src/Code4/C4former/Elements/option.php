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

class option extends BaseElement implements ElementInterface {

    protected $type = "option";

    public function render() {
        $this->populateParentValue();

        $selected = "";
        if ($this->parentValue != "" && $this->parentValue == $this->attributes->value) $selected = 'selected="selected"';
         if (is_array($this->parentValue) && in_array($this->attributes->value, $this->parentValue)) $selected = 'selected="selected"';
        return '<option value="'.$this->attributes->value.'" '.$selected.' >'.$this->name.'</option>';

    }
    /*public function setValue($value) {
        $this->attributes->value = $value;
    }

    public function getValue() {
        return $this->attributes->value;
    }*/

}
