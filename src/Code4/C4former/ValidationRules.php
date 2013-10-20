<?php
namespace Code4\C4former;

class ValidationRules {

    public function __construct() {

    }

    public function rule() {
        array(
            'accepted'=>'required',
            'active_url' => array('type'=>'url'),
            'after:date' => array('type'=>'date'),
            'alpha' => array('pattern'=>'[a-zA-Z]+'),
            'alpha_dash' => array('pattern'=>'[a-zA-Z0-9-_]+'),
            'alpha_num' => array('pattern'=>'[a-zA-Z0-9]+'),
            'before:date' => array(),
            'between:min,max' => array(),
            'confirmed' => array(),
            'date' => array('type'=>'date'),
            'date_format:format' => array(),
            'different:field' => array(),
            'email' => array('type'=>'email'),
            'exists:table,column'=>array(),
            'image' => array('accept'=>'image/*'),
            'in:foo,bar,...' => array(),
            'integer' => array('type'=>'number'),
            'ip' => array(),
            'max:value' => array('max'=>'value'),
            'mimes:foo,bar,...' => array(),
            'min:value' => array('min'=>'value'),
            'not_in:foo,bar,...' => array(),
            'numeric' => array('type'=>'number'),
            'regex:pattern' => array('pattern'=>'pattern'),
            'required'=>'required',
            'required_if:field,value' => array(),
            'required_with:foo,bar,...' => array(),
            'required_without:foo,bar,...' => array(),
            'same:field' => array(),
            'size:value' => array('maxlength'=>'{value}', 'max'=>'value'),
            'unique:table,column,except,idColumn' => array(),
            'url' => array('type'=>'url')
        );
    }


    public function explodeRules($rules) {

        $rules = explode("|", $rules);
        $validationRules = array();
        $lp = 0;
        foreach($rules as $rule) {
            $validationRules[$lp]['params'] = array();
            if (strpos($rule, ':') !== false)
            {
                list($rule, $parameter) = explode(':', $rule, 2);
                if (strtolower($rule) != 'regex') $validationRules[$lp]['params'] = str_getcsv($parameter);
                else $validationRules[$lp]['params'] = $parameter;

            }
            $validationRules[$lp]['rule'] = studly_case($rule);
            $lp++;
        }

        return $validationRules;

    }



}