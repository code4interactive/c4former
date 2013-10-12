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

abstract class BaseElement extends BaseElementsAttributes implements RenderableInterface {

    protected $collection;

    protected $app;
    protected $form;

    public function __construct($app, $form, $id, $config=array()) {

        $this->collection = new Collection(array());
        $this->collection->setApp($app);
        $this->collection->setForm($form);

        $this->app = $app;
        $this->form = $form;
        $this->id = $this->name = $id;

        if (count($config)) $this->load($config);

        return $this;

    }

    public function load($config){

        foreach($config as $field => $value) {

            if (property_exists($this, $field)) {
                if ($field != "collection")
                $this->{$field} = $value;
            }

            if ($field == 'collection' && is_array($value)) {

                foreach ($value as $subField) {

                    $id = array_key_exists("id", $subField) ? $subField['id'] : null;
                    $type = array_key_exists("type", $subField) ? $subField['type'] : null;

                    if (is_null($id) || is_null($type)) continue;

                    if (!$this->form->fieldTypeExists($type)) continue;


                    $this->collection->addField($type, $id, $subField);

                    /*$fieldClass = C4Former::FIELDSPACE.$type;
                    $field = new $fieldClass(
                        $this->app,
                        $this->form,
                        $id,
                        $subField
                    );

                    $this->collection->add($field);*/


                }

            }

        }

    }

    public function repopulate() {



    }


    public function validate() {

    }


    public function label($element) {

        return '<label class="col-sm-3 control-label no-padding-right">'.$this->label.'</label>';

    }



    public function setLabel($label) {

        $this->label = new label($label);

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

    public function render() {
        return "<br/>Field type: ".$this->type." <br/>Field Name: ".$this->name."<br/>";
        /*foreach($this->collection->all() as $fields) {

            return $fields->render();

        }*/
    }

    public function __toString() {

        return $this->render();
        return "<br/>Field type: ".$this->type." <br/>Field Name: ".$this->name."<br/>";
        return $this->type." - ".$this->id."<br/>";

    }

    public function __call($method, $parameters) {


        if ($this->form->fieldTypeExists($method)) {

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

}