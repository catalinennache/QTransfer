<?php
    abstract class  Result implements ArrayAccess{

       public $assets_path = './Assets';

       public function getType(){
            return get_class($this);
        }


    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
           // $this->container[] = $value;
        } else {
            $this->$offset = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->$offset);
    }

    public function offsetUnset($offset) {
        unset($this->$offset);
    }

    public function offsetGet($offset) {
        return isset($this->$offset) ? $this->$offset : null;
    }

    }

    class ModelResult extends Result {


        public function __construct(){

        }

       
    }

    class JsonResult extends Result{
        public function __construct(){

        }

    }

?>