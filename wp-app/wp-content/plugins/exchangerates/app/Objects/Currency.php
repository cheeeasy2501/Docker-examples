<?php

namespace App\Objects;

class Currency {

    public $id;
    public $abbreviation;
    public $name;
    public $scale;
    public $officialRate;


    public function __construct($id, $abbreviation, $scale, $name, $officialRate){
        $this->id = $id;
        $this->abbreviation = $abbreviation;
        $this->scale = $scale;
        $this->name = $name;
        $this->officialRate = $officialRate;
    }

    /**
     * @return mixed
     */
    public function getAbbreviation(){
        return $this->abbreviation;
    }

    /**
     * @return mixed
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getScale(){
        return $this->scale;
    }

    /**
     * @return mixed
     */
    public function getOfficialRate(){
        return $this->officialRate;
    }
}