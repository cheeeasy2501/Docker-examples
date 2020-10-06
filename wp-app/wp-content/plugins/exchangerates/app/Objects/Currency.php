<?php

namespace App\Objects;

class Currency {

    private $id;
    private $abbreviation;
    private $name;
    private $scale;
    private $officialRate;


    public function __construct($id, $abbreviation, $name, $scale, $officialRate){
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