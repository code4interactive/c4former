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

        return '<div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">'.$this->label.'</label>
                    <div class="col-sm-9 input-group">
                        '.$this->preaddon().'
                        <input type="text" name="'.$this->name.'" id="'.$this->id.'" '.$this->tooltips().' placeholder="'.$this->placeholder.'" class="col-xs-10 col-sm-5">
                        '.$this->postaddon().'
                    </div>
                </div>';

        $addon = '
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="icon-phone"></i>
                    </span>

                    <input class="form-control input-mask-phone" type="text" id="form-field-mask-2">
                </div>';




        $text = '<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Input with Icon</label>

										<div class="col-sm-9">
											<span class="input-icon">
												<input type="text" id="form-field-icon-1">
												<i class="icon-leaf blue"></i>
											</span>

											<span class="input-icon input-icon-right">
												<input type="text" id="form-field-icon-2">
												<i class="icon-leaf green"></i>
											</span>
										</div>
									</div>';




    }


    public function renderNaked() {
        return '<input type="text" id="form-field-1" placeholder="'.$this->placeholder.'" class="col-xs-10 col-sm-5">';
    }


}