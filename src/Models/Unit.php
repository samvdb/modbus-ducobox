<?php

namespace App\Models;

class Unit extends Type
{

    /**
     * @return int
     */
    public function getStatus()
    {
        switch ($this->get(1)) {
            case StatusEnum::AUTO:
                return 'auto';
            case StatusEnum::TEN_MIN_HIGH:
                return '10 minutes high';
            case StatusEnum::TWENTY_MIN_HIGH:
                return '20 minutes high';
            case StatusEnum::THIRTY_MIN_HIGH:
                return '30 minutes high';
            case StatusEnum::MANUAL_LOW:
                return 'manual low';
            case StatusEnum::MANUAL_MEDIUM:
                return 'manual medium';
            case StatusEnum::MANUAL_HIGH:
                return 'manual high';
            case StatusEnum::NOT_HOME:
                return 'not home';
            case StatusEnum::ERROR:
                return 'error';
        }
    }

    /**
     * @return int
     */
    public function getVentilationPosition()
    {
        return $this->get(2);
    }

    /**
     * @param $value
     * @return int
     */
    public function setVentilationPosition($value)
    {
        return $this->write(0, $value);

    }

    /**
     * @param $value
     * @return int
     */
    public function setAction($value)
    {
        return $this->write(9, $value);
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
            'location' => $this->getLocation(),
        ];
    }

    public function __toString()
    {
        return 'Ducobox Focus';
    }
}