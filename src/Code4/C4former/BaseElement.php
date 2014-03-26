<?php
/**
 * Created by CODE4Interactive.
 * User: Artur Bartczak
 * Date: 19.09.13
 * Time: 21:01
 */

namespace Code4\C4former;

use Code4\C4former\Elements;
use Illuminate\Support\Contracts\RenderableInterface;

abstract class BaseElement implements RenderableInterface {

    protected $collection;

    protected $app;
    protected $form;

    protected $id;
    protected $name;
    protected $type;

    protected $parentValue;

    protected $validation;

    public function __construct($app, $form, $id=null, $config=array()) {

        $this->collection = new Collection(array());
        $this->collection->setApp($app);
        $this->collection->setForm($form);

        //if ($id===null) $id = md5(uniqid(rand(), true));

        $this->app = $app;
        $this->form = $form;
        $this->id = $this->name = $id;

        $this->attributes = new Attributes;

        if (count($config)) $this->load($config);

        return $this;
    }


    /**
     * Loads parameters / attributes from config file / array to this element
     * and creates children if config has 'collection' section
     *
     * @param $config
     */
    public function load($config){
        foreach($config as $field => $value) {

            if ($field != "collection") {
                $this->attributes->{$field} = $value;
            }

            if ($field == "name") $this->name = $value;

            if ($field == "value") {
                $this->setValue($value);
            }

            if ($field == "validation")
                $this->validation = $value;

            if ($field == 'collection' && is_array($value)) {

                foreach ($value as $subField) {

                    $id = array_key_exists("id", $subField) ? $subField['id'] : null;
                    $type = array_key_exists("type", $subField) ? $subField['type'] : null;

                    if (is_null($id) || is_null($type)) continue;
                    //if (!$this->form->fieldTypeExists($type)) continue;
                    if (!$this->collection->getFieldClass($type)) continue;

                    $this->collection->addField($type, $id, $subField);

                }

                $this->populateParentValue();
            }
        }
    }

    /**
     * Populates value of this element to all its children (eg. select => options)
     */
    public function populateParentValue() {
        $value = $this->getValue();

        foreach ($this->collection->all() as $item) {

            $item->parentValue = $value;

        }
    }

    /**
     * Quick access method to values stored in populator
     * @param $value
     */
    public function setValue($value) {
        $this->form->populator->setValue($this->name, $value);
    }

    /**
     * Quick access method to values stored in populator
     */
    public function getValue() {
        return $this->form->populator->getValue($this->name);
    }

    /**
     * Collects validation rules for this element
     *
     * @param $validationRules
     * @return mixed
     */
    public function getValidationRules($validationRules) {


        if ($this->validation != null || is_array($this->validation)) {
            $validationRules[$this->name] = $this->validation;
        }

        foreach($this->collection->all() as $item) {
            $validationRules = $item->getValidationRules($validationRules);
        }

        return $validationRules;
    }


    public function attributeName($attributeNames) {

        $attributeNames[$this->id] = $this->attributes->label;

        foreach($this->collection->all() as $item) {

            $attributeNames = $item->attributeName($attributeNames);

        }
        return $attributeNames;
    }


    public function attributeId($attributeIds) {

        $attributeIds[$this->name] = $this->id;

        foreach($this->collection->all() as $item) {

            $attributeIds = $item->attributeId($attributeIds);

        }
        return $attributeIds;

    }


    public function find($name) {

        $result = null;
        $result = $this->findByName($name);
        if (is_null($result)) $result = $this->findById($name);

        return $result;

    }

    public function findByName($name) {

        if ($name == $this->name) return $this;

        if ($this->collection->count()) {

            foreach($this->collection->all() as $item) {

                $temp = $item->findByName($name);
                if (!is_null($temp)) return $temp;

            }

        }

        return null;
    }

    public function findById($id) {

        if ($id == $this->id) return $this;

        if ($this->collection->count()) {

            foreach($this->collection->all() as $item) {

                $temp = $item->findById($id);
                if (!is_null($temp)) return $temp;

            }

        }

        return null;
    }


    public function after($which) {

        return $this->form->after($which, $this->name);

    }

    public function before($which) {

        return $this->form->before($which, $this->name);

    }

    /**
     * Metoda która powinna być overridowana przez dziedziczoną klasę
     * @return string 
     */
    public function render() {

        return $this->type . ' - ' . $this->id;

    }

    public function __toString() {

        return $this->render();
        
    }

    public function getId() {
        return $this->id;
    }

    public function __call($method, $parameters) {

        //Jeżeli wywołana metoda odności się do konkretnego typu pola (np text, select itp)
        if ($this->collection->getFieldClass($method)) {

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
        } else {
            //Możliwe że odwołujemy się do atrybutów kożystając z notacji setName, getName
            //Wysyłamy więc wywołanie do Attributes
            //return parent::__call($method, $parameters);
            return call_user_func_array(array($this->attributes, $method), $parameters);
        }

        //Collection method eg. after, before ...
        if (method_exists($this->collection, $method)) {

            return call_user_func_array(array($this->collection, $method), $parameters);

        }

    }

}