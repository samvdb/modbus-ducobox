<?php

namespace App\Controller;

use App\Models\Type;
use App\Models\Unit;
use App\Models\Valve;
use App\Provider\DucoboxProvider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller
{
    /**
     * @var DucoboxProvider
     */
    private $provider;

    public function __construct(DucoboxProvider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @Route("/set/{id}/{parameter}/{value}", name="set")
     */
    public function set($id, $parameter, $value)
    {
        $type = new Type($this->provider, $id);
        $hardwareTypeClass = $this->provider->parseTypeClass($type->getType());
        if (!$type) {
            throw new HttpException("Hardware type not supported");
        }

        /** @var Type $object */
        $object = new $hardwareTypeClass($this->provider, $id);

        $method = str_replace(' ', '', ucwords(str_replace('_', ' ', $parameter)));

        $result = call_user_func_array([$object, 'set'. $method], [$value]);

        return $this->json(
            $object->data()
        );
    }


    /**
     * @Route("/all/{count}", name="index")
     */
    public function index($count)
    {

        $valves = [];
        $unit = new Unit($this->provider, 1);
        $data = [];
        $data['unit'] = $unit->data();

        for ($i = 2; $i <= $count; $i++) {
            $valves[$i] = new Valve($this->provider, $i);
        }

        /**
         * @var string $name
         * @var Valve $valve
         */
        foreach ($valves as $name => $valve) {
            $data[$name] = $valve->data();
        }

        return $this->json(
            $data
        );
    }

    /**
     * @Route("/{id}", name="show")
     */
    public function show($id)
    {
        $type = new Type($this->provider, $id);
        $hardwareTypeClass = $this->provider->parseTypeClass($type->getType());
        if (!$type) {
            throw new HttpException("Hardware type not supported");
        }

        /** @var Type $object */
        $object = new $hardwareTypeClass($this->provider, $id);

        return $this->json(
            $object->data()
        );
    }



}

                              