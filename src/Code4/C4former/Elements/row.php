<?php
/**
 * Created by CODE4Interactive.
 * User: Artur Bartczak
 */

namespace Code4\C4former\Elements;

use Code4\C4former\BaseElement;
use Code4\C4former\ElementInterface;
use Code4\C4former\Facades\C4former;

class row extends BaseElement implements ElementInterface {

    protected $type = "row";
    protected $multiple;

    public function render() {

    	$element = '<div class="row">';
        foreach($this->collection->all() as $i) {

            $element .= $i->render();

        }
        $element .= '</div>';

        return $element;

    }

}