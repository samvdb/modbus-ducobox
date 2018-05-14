<?php
namespace App\Models;


use App\Provider\DucoboxProvider;

class Type
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
    public function getNode()
    {
        return $this->node;
    }

    /**
     * @return DucoboxProvider
     */
    public function getProvider()
    {
        return $this->provider;
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
    public function getLocation()
    {
        return $this->get(9);
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

    /**
     * @param $address
     * @return string
     */
    private function address($address)
    {
        return intval(sprintf('%d%d', $this->node, $address));
    }

    /**
     * @return array
     */
    public function data()
    {
        return [
            'type' => $this->getType(),
        ];
    }
}