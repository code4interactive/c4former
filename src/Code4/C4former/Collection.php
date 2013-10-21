<?php
/**
 * Created by CODE4Interactive.
 * User: Artur Bartczak
 * Date: 19.09.13
 * Time: 22:35
 */

namespace Code4\C4former;

use Illuminate\Support\Collection as BaseCollection;

use Code4\Menu\MenuCollection;

class Collection extends BaseCollection {


    protected $app;
    protected $form;

    public function setApp($app)
    {
        $this->app = $app;
    }

    public function setForm($form)
    {
        $this->form = $form;
    }


    public function add($item) {

        $collection = $this->all();
        $collection[] = $item;
        $this->items = $collection;

    }




    public function addField($type, $id=null, $config=array()) {

        //Type = array -> only config used to generate field
        if (is_array($type)) {
            $config = $type;

            $type = (array_key_exists("type", $config)) ? $config['type'] : null;
            if (is_null($type)) { \Log::error("C4Former: Config array has no type field: ".implode("|", $config)); return null; }

            $id = (array_key_exists("id", $config)) ? $config['id'] : null;
            if (is_null($id)) { \Log::error("C4Former: Config array has no id field: ".implode("|", $config)); return null; }

        } else {

            $type = $type;
            $id = $id;

        }

        //if (!$this->form->fieldTypeExists($type)) return null;


        $fieldClass = $this->getFieldClass($type);
        if (!$fieldClass) return null;
        $field = new $fieldClass(
            $this->app,
            $this->form,
            $id,
            $config
        );

        $this->add($field);

        //echo $field;

        return $field;

    }



    /**
     * Check if there is a class for requested field type
     * @param $fieldType
     * @return bool
     */
    public function fieldTypeExists($fieldType) {

        return class_exists(C4Former::FIELDSPACE.$fieldType);

    }


    public function getFieldClass($fieldType) {

        if (class_exists(C4Former::APPSPACE.$fieldType)) {
           return C4Former::APPSPACE.$fieldType;
        }
        if (class_exists(C4Former::FIELDSPACE.$fieldType)) {
            return C4Former::FIELDSPACE.$fieldType;
        }
        return null;

    }




    public function find($name) {

        foreach($this->all() as $item) {

            $result = $item->find($name);
            if ($result) return $result;

        }

        return null;

    }

    /**
     * Preform search by ID and Name and return field
     * @param $fieldId
     * @return null
     */
    public function getField($fieldId) {
        foreach($this->all() as $item) {

            $temp = $item->find($fieldId);
            if (!is_null($temp)) return $temp;

        }
        return null;
    }

    /**
     * Preform search by ID and return field
     * @param $fieldId
     * @return null
     */
    public function getFieldById($fieldId) {
        foreach($this->all() as $item) {

            $temp = $item->findById($fieldId);
            if (!is_null($temp)) return $temp;

        }
        return null;
    }

    /**
     * Preform search by Name and return field
     * @param $fieldId
     * @return null
     */
    public function getFieldByName($fieldId) {
        foreach($this->all() as $item) {

            $temp = $item->findByName($fieldId);
            if (!is_null($temp)) return $temp;

        }
        return null;
    }


    public function findPosition($name) {


        foreach($this->all() as $key => $item) {

            $result = $item->find($name);
            if ($result) return $key;

        }

        return null;

    }


    /**
     * Puts element name2 after name1
     * @param $name1
     * @param $name2
     * @return null
     */
    public function after($name1, $name2) {

        $key1 = $this->findPosition($name1);
        $key2 = $this->findPosition($name2);

        if (is_null($key1) || is_null($key2)) return null;
        if ($key1 == $key2) return null;

        $original = $this->all();
        $replacement = $original[$key2];

        array_splice($original, $key2, 1);

        array_splice($original, $key1+1, 0, array($replacement));

        $this->items = $original;

    }

    /**
     * Puts element name2 before name1
     * @param $name1
     * @param $name2
     * @return null
     */
    public function before($name1, $name2) {

        $key1 = $this->findPosition($name1);
        $key2 = $this->findPosition($name2);

        if (is_null($key1) || is_null($key2)) return null;
        if ($key1 == $key2) return null;

        $original = $this->all();
        $replacement = $original[$key2];

        array_splice($original, $key2, 1);

        array_splice($original, $key1, 0, array($replacement));

        $this->items = $original;

    }


}