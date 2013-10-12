<?php
namespace Code4\C4former;

use Illuminate\Config\FileLoader;
use Illuminate\Support\Facades\Config;

/**
 *
 *
 *
 */

class C4Former {

    protected $app;
    protected $collection;

    const FIELDSPACE = 'Code4\C4former\Elements\\';


    public function __construct($app) {
        $this->app = $app;
        $this->collection = new Collection(array());
        $this->collection->setApp($app);
        $this->collection->setForm($this);
    }

    public function getNewInstance() {

        return new C4Former($this->app);

    }

    public function instance() {
        return $this;
    }


    public function load($config=false) {

        //Test if config exists

        $config = \Config::get('form.form1');

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