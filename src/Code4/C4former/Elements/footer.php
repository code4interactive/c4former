<?php
/**
 * Created by CODE4Interactive.
 * User: Artur Bartczak
 */

namespace Code4\C4former\Elements;

use Code4\C4former\BaseElement;
use Code4\C4former\ElementInterface;
use Code4\C4former\Facades\C4former;

class footer extends BaseElement implements ElementInterface {

    protected $type = "footer";
    protected $multiple;

    public function render() {

    	$element = '<footer>';
        foreach($this->collection->all() as $i) {

            $element .= $i->render();

        }
        $element .= '</footer>';

        return $element;

    }

}