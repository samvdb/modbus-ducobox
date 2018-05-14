<?php

namespace App\Controller;

use App\Models\Unit;
use App\Models\Valve;
use App\Provider\DucoboxProvider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
     * @Route("/{id}", name="show")
     */
    public function show()
    {
        $unit
    }

    /**
     * @Route("/", name="index")
     */
    public function index()
    {

        $valves = [];
        $unit = new Unit($this->provider, 1);
        $data = [];

        //$unit->setAction(2);
        $unit->setVentilationPosition(50);

        $data['unit'] = [
            'type' => $unit->getType(),
            'status' => $unit->getStatus(),
            'ventilation_position' => $unit->getVentilationPosition(),
            'location' => $unit->getLocation(),
        ];

        for ($i = 2; $i <= 6; $i++) {
            $valves[$i] = new Valve($this->provider, $i);
        }

        /** @var Valve $valve */
        foreach($valves as $valve) {
            //$valve->setAction(2);
            $valve->setVentilationPosition(-1);
        }


        /**
         * @var string $name
         * @var Valve $valve
         */
        foreach ($valves as $name => $valve) {
            $data[$name] = [
                'type' => $valve->getType(),
                'status' => $valve->getStatus(),
                'ventilation_position' => $valve->getVentilationPosition(),
                'indoor_temperature' => $valve->getIndoorTemperature(),
                'co2' => $valve->getCo2(),
                'humidity' => $valve->getHumidity(),
                'location' => $valve->getLocation(),
            ];

//            if ($valve->getVentilationPosition() == 100) {
//                $result = $valve->setVentilationPosition(15);
//                var_dump($result);
////                die;
//            }
        }

        return $this->json(
            $data
        );
    }
}
                              