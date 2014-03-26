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

class hidden extends BaseElement implements ElementInterface {

    protected $type = "hidden";

    public function render() {

        return '<input type="hidden" name="'.$this->name.'" id="'.$this->id.'" value="'.$this->getValue().'">';

    }
}
