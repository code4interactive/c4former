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
use Code4\C4former\Facades\C4former;

class select extends BaseElement implements ElementInterface {

    protected $type = "select";
    protected $multiple;
    //protected $chosen-select;

    /*public function render() {

        //$element = '<input type="text" name="'.$this->name.'" id="'.$this->id.'" '.$this->tooltips().' placeholder="'.$this->placeholder.'" class="">';

        $m = 'multiple="multiple"';

        $addon = '<div class="form-group">
                    '.$this->label().'
                    <div class="col-xs-12 col-sm-3 input-group">';
        $addon .= '<select class="form-control '.$this->class.'" id="form-field-select-1" name="'.$this->name.'" id="'.$this->id.'" '.$this->tooltips().' placeholder="'.$this->placeholder.'">';

        foreach($this->collection->all() as $i) {

            $addon .= $i->render();

        }

        $addon .= '</select>';


        $addon .= '</div></div>';

        return $addon;

    }*/

    public function render() {
        $this->populateParentValue();
        return \View::make('c4former::select', array(
            'el'=>$this->attributes, 
            'value'=>$this->getValue(),
            'collection'=>array($this->collection->all())
        ));
    }


    ///?????????
    public function fromQuery($results, $value = null, $key = null)
    {
        $array = C4former::queryToArray($results, $value, $key);

        foreach($array as $key => $value) {
            $this->option($key)->attributes->value = $value;
        }

        return $this;
    }


}