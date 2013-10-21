<?php
namespace Code4\C4former;

use Code4\Platform\Platform;
use Illuminate\Config\FileLoader;
use Illuminate\Support\Collection as Col;
use Illuminate\Support\Facades\Config;

use Underscore\Types\Arrays as Arrays;
use Underscore\Types\String as Strings;

/**
 *
 *
 *
 */

class C4Former {

    protected $app;
    protected $collection;
    public $populator;
    protected $values;
    protected $valid = false;
    protected $response;

    const FIELDSPACE = 'Code4\C4former\Elements\\';
    const APPSPACE = 'Form';


    public function __construct($app) {
        $this->app = $app;
        $this->collection = new Collection(array());
        $this->collection->setApp($app);
        $this->collection->setForm($this);
        $this->populator = new Populator();
    }

    public function getNewInstance() {

        return new C4Former($this->app);

    }

    public function instance() {
        return $this;
    }


    public function load($config=null) {

        $config = \Config::get($config);

        if (is_array($config)) {

            foreach ($config as $f) {

                if (!is_array($f)) continue;
                if (!array_key_exists('id', $f)) continue;
                if (!array_key_exists('type', $f)) continue;

                $this->addField($f['type'], $f['id'], $f);
            }
        }
        if (!is_array($config))
            return $this;
    }

    public function validate($response = array()) {

        $validationRules = array();
        $attributeNames = array(); //Collected for correct error message
        $attributeIds = array(); //Collected for identifying field id (for displaying error message)

        //Iteration on elements. If element has validation rules - add them to Laravel validators
        foreach($this->collection->all() as $item) {
            $validationRules = $item->validate($validationRules);
            $attributeNames = $item->attributeName($attributeNames);
            $attributeIds = $item->attributeId($attributeIds);
        }

        $validator = \Validator::make(\Input::all(), $validationRules);
        $validator->setAttributeNames($attributeNames);

        if ($validator->fails())
        {
            $messages = $validator->messages();

            foreach($validationRules as $name=>$r) {

                $fieldMessages = '';

                foreach($messages->get($name) as $m) {
                    $fieldMessages .= $m.'<br/>';
                }

                if ($fieldMessages != '') {
                    $response[] = array('id'=>$attributeIds[$name], 'message'=>$fieldMessages);
                }
            }
        }

        $this->response = $response;

        if (count($response)>0) {

            \Notification::error("Przetwarzany formularz zawiera błędy.");
            $this->valid = false;
            return true;

        } else {
            $this->valid = true;
            return false;

        }

    }

    /**
     * Returns valid info
     * @return bool
     */
    public function isValid() {
        return $this->valid;
    }

    /**
     * Returns json response for notification system
     * @return mixed
     */
    public function response() {
        return \Response::json($this->response);
    }


    public function throwError($fieldId, $message) {
        $this->response[] = array("id" => $fieldId, "message"=>$message);
        $this->valid = false;
    }


    /**
     * Populates form with values from model
     * @param $pop
     */
    public function populate($pop) {

        //$this->values = $pop;

        $this->populator->setValues($pop);
        //var_dump($this->populator->getValue('opinie'));


        //Array / Eloquent
        //var_dump($this->queryToArray($pop));

    }

    public function setValues($values) {
        $this->populator->setValues($values);
    }

    /**
     * Transforms an array of models into an associative array
     *
     * @param  array|object $query The array of results
     * @param  string       $value The attribute to use as value
     * @param  string       $key   The attribute to use as key
     * @return array               A data array
     */
    public static function queryToArray($query, $value = null, $key = null)
    {
        // Automatically fetch Lang objects for people who store translated options lists
        // Same of unfetched queries
        if (!($query instanceof Col)) {
            if (method_exists($query, 'get')) $query = $query->get();
            if (!is_array($query)) $query = (array) $query;
        }

        // Populates the new options
        foreach ($query as $model) {

            // If it's an array, convert to object
            if (is_array($model)) $model = (object) $model;

            // Calculate the value
            if ($value and isset($model->$value)) $modelValue = $model->$value;
            elseif (method_exists($model, '__toString')) $modelValue = $model->__toString();
            else $modelValue = null;

            // Calculate the key
            if ($key and isset($model->$key)) $modelKey = $model->$key;
            elseif (method_exists($model, 'getKey')) $modelKey = $model->getKey();
            elseif (isset($model->id)) $modelKey = $model->id;
            else $modelKey = $modelValue;

            // Skip if no text value found
            if (!$modelValue) continue;

            $array[$modelKey] = (string) $modelValue;
        }

        return isset($array) ? $array : $query;
    }



    public function __call($method, $parameters) {

        if ($this->fieldTypeExists($method)) {

            $fieldType = $method;

            $fieldName = array_get($parameters, 0);
            if (!is_null($fieldName) && !is_array($fieldName)) {

                //Searching for existing field
                $field = $this->collection->getFieldById($fieldName);
                if($field) return $field;

                //Add field if there was none found;
                return $this->collection->addField($fieldType, $fieldName);

            }


            //If fieldName is an array it must be a config array;
            if (is_array($fieldName)) {

                $config = $fieldName;
                $name = (array_key_exists("id", $config)) ? $config['id'] : null;
                if (is_null($name)) return null;
                return $this->collection->addField($fieldType, $name, $config);
            }
        }

        //Collection method eg. after, before ...
        if (method_exists($this->collection, $method)) {

            return call_user_func_array(array($this->collection, $method), $parameters);

        }
    }

    /**
     * Check if there is a class for requested field type
     * @param $fieldType
     * @return bool
     */
    public function fieldTypeExists($fieldType) {

        return class_exists(C4Former::FIELDSPACE.$fieldType);

    }


    public function render() {

        foreach($this->collection->all() as $field) {
            echo $field->render();
        }
    }


    public function test() {

        //var_dump($this->collection->all());

    }

}