<?php
/**
 * Created by CODE4Interactive.
 * User: Artur Bartczak
 * Date: 19.09.13
 * Time: 21:54
 */

namespace Code4\C4former\Elements;


use Code4\C4former\BaseElement;

class label extends BaseElement {

    protected $type = "label";

    public function render() {

        return '<label class="col-sm-3 control-label no-padding-right">'.$this->value.'</label>';

    }

}