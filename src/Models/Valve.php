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




    /**
     * @return int
     */
    public function getIndoorTemperature()
    {
        return $this->get(3);
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
        return $this->get(5);
    }




}