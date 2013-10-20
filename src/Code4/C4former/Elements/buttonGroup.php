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

class buttonGroup extends BaseElement implements ElementInterface {

    protected $type = "buttonGroup";

    public function render() {

        $addon = '
            <div class="clearfix form-actions">
                <div class="col-md-offset-3 col-md-9">';

            foreach($this->collection->all() as $i) {
                $addon .= $i->render();
            }

        $addon .= '</div>
            </div>';

        return $addon;

    }
}