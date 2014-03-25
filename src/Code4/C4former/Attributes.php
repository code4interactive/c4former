<?php
/**
 * Created by CODE4Interactive.
 * User: Artur Bartczak
 * Date: 19.09.13
 * Time: 21:01
 */

namespace Code4\C4former;

class Attributes   {
    protected $attributes = array();


    public function icon() {
    	if ($this->icon) {

    		if ($this->type == 'button' || $this->type == 'submit')
    			return '<i class="fa '.$this->icon.'"></i>';


    		if ($this->iconposition === 'right')
    			return '<i class="icon-append fa '.$this->icon.'"></i>';
    		else 
    			return '<i class="icon-prepend fa '.$this->icon.'"></i>';
    	}

    	return null;
    }

    public function mask() {
    	if ($this->mask) 
    		return 'data-mask="'.$this->mask.'"';

    	return null;
    }

    public function tooltip() {
    	if ($this->tooltip) {

    		return '<b class="tooltip tooltip-top-right">
			<i class="fa fa-warning txt-color-teal"></i> 
			'.$this->tooltip.'</b>';

    		//return 'rel="tooltip" data-placement="bottom" data-original-title="'.$this->tooltip.'"';
    	}
    }


    public function disabled() {
    	if ($this->disabled) {
    		return 'disabled="disabled"';
    	}
    	return false;
    }

    public function setParentValue($parentValue) {
        $this->parentValue = $parentValue;
    }

    /**
     * Magic methods for all attributes
     * @param  [type] $name [description]
     * @return [type]       [description]
     */
    public function __get($name) {
        if (array_key_exists($name, $this->attributes)) {
            return $this->attributes[$name];
        }
        return null;
    }

    public function __set($name, $value) {
        $this->attributes[$name] = $value;
    }

    /**
     * Magiczna metoda dla getów i setów attrybutów
     * Zastępuje wszystkie ręcznie pisane getName, setName itp
     */
    public function __call($name, $arguments) {
        
        if (substr($name, 0, 3) === 'set') {
            $attribute = strtolower(substr($name, 3));
            $this->{$attribute} = $arguments[0];
        } else if(substr($name, 0, 3) === 'get') {
            $attribute = strtolower(substr($name, 3));
            return $this->{$attribute};
        }
    }


}