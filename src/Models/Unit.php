<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 14/05/2018
 * Time: 18:37
 */

namespace App\Models;


use App\Provider\DucoboxProvider;

class Unit
{
    /**
     * @var DucoboxProvider
     */
    protected $provider;
    /**
     * @var int
     */
    protected $node;

    public function __construct(DucoboxProvider $provider, $node)
    {
        $this->provider = $provider;
        $this->node = $node;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->get(0);
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->get(1);
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
     * @return int
     */
    public function getLocation()
    {
        return $this->get(9);
    }

    /**
     * @param $address
     * @return string
     */
    private function address($address)
    {
        return intval(sprintf('%d%d', $this->node, $address));
    }

    /**
     * @param $address
     *
     * @return int
     */
    protected function write($address, $value)
    {
        return $this->provider->writeHolding($this->address($address), $value);
    }

    /**
     * @param $address
     *
     * @return int
     */
    protected function get($address)
    {
        return $this->provider->readInput($this->address($address));
    }
}