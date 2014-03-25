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
        return \View::make('c4former::text', array('el'=>$this->attributes, 'value'=>$this->getValue()));
    }
}