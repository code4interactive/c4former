<?php
/**
 * Created by CODE4Interactive.
 * User: Artur Bartczak
 * Date: 19.09.13
 * Time: 21:54
 */

namespace Code4\C4former\Elements;


use Code4\C4former\BaseElement;

class close extends BaseElement {

    protected $type = "close";

    public function render() {

        return '</form>';

    }

}