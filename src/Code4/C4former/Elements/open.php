<?php
/**
 * Created by CODE4Interactive.
 * User: Artur Bartczak
 * Date: 19.09.13
 * Time: 21:54
 */

namespace Code4\C4former\Elements;


use Code4\C4former\BaseElement;

class open extends BaseElement {

    protected $type = "open";

    public function render() {

        return '<form class="smart-form '.$this->attributes->class.'" role="form" method="post" action="'.$this->attributes->action.'">';

    }

}
