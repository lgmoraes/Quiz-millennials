<?php

/**
 * Objet représentant un film
 */
class Movie
{
    protected $_id;
    protected $_name;
    protected $_nameId;
    protected $_falseResponses;


    public function __construct($data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $method = "set" . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function id()
    {
        return $this->_id;
    }
    public function name()
    {
        return $this->_name;
    }
    public function nameId()
    {
        return $this->_nameId;
    }
    public function falseResponses()
    {
        return $this->_falseResponses;
    }

    public function setId($id)
    {
        $this->_id = $id;
    }
    public function setName($name)
    {
        $this->_name = $name;
    }
    public function setNameId($nameId)
    {
        $this->_nameId = $nameId;
    }
    public function setFalseResponses($falseResponses)
    {
        $array = explode(';', $falseResponses);

        if (count($array) > 2) {
            $this->_falseResponses = $array;
        }
    }
}
