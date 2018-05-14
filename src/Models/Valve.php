<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 14/05/2018
 * Time: 17:35
 */

namespace App\Models;


use App\Provider\DucoboxProvider;

class Valve extends Unit
{

    public function __toString()
    {
        return 'Valve';
    }


    /**
     * @return int
     */
    public function getIndoorTemperature()
    {
        return ($this->get(3) / 10);
    }

    /**
     * @return int
     */
    public function getCo2()
    {
        return $this->get(4);
    }

    /**
     * @return int
     */
    public function getHumidity()
    {
        return ($this->get(5) / 100);
    }

    /**
     * @return array
     */
    public function data()
    {
        return [
            'name' => $this->__toString(),
            'type' => $this->getType(),
            'status' => $this->getStatus(),
            'ventilation_position' => $this->getVentilationPosition(),
            'indoor_temperature' => $this->getIndoorTemperature(),
            'co2' => $this->getCo2(),
            'humidity' => $this->getHumidity(),
            'location' => $this->getLocation(),
        ];
    }


}