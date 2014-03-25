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

class textarea extends BaseElement implements ElementInterface {

    protected $type = "textarea";

    public function render() {
        return \View::make('c4former::textarea', array('el'=>$this->attributes, 'value'=>$this->getValue()));
    }
}