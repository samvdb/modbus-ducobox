<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 14/05/2018
 * Time: 17:27
 */

namespace App\Provider;


use App\Models\HardwareEnum;
use App\Models\Unit;
use App\Models\Valve;
use Exception;
use ModbusTcpClient\Network\BinaryStreamConnection;
use ModbusTcpClient\Packet\ModbusFunction\ReadHoldingRegistersRequest;
use ModbusTcpClient\Packet\ModbusFunction\ReadInputRegistersRequest;
use ModbusTcpClient\Packet\ModbusFunction\WriteSingleRegisterRequest;
use ModbusTcpClient\Packet\ModbusFunction\WriteSingleRegisterResponse;
use ModbusTcpClient\Packet\ModbusPacket;
use ModbusTcpClient\Packet\ResponseFactory;
use ModbusTcpClient\Utils\Endian;
use Psr\Log\LoggerInterface;

class DucoboxProvider
{
    /**
     * @var LoggerInterface
     */
    private $logger;
    private $host;
    private $port;
    private $unitId;

    public function __construct($host, $port, $unitId, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->host = $host;
        $this->port = $port;
        $this->unitId = $unitId;
    }

    /**
     * @return BinaryStreamConnection
     */
    public function getClient()
    {
        $connection = BinaryStreamConnection::getBuilder()
            ->setHost($this->host)
            ->setPort($this->port)
//            ->setLogger($this->logger)
            ->build();

        return $connection;
    }

    /**
     * @param $address
     * @return int
     */
    public function readInput($address)
    {
        $packet = new ReadInputRegistersRequest($address, 1, $this->unitId);

        $response = $this->read($packet);


        //same as 'foreach ($response->getWords() as $word) {'
        foreach ($response as $word) {
            return $word->getInt16();
        }

        return null;
    }

    /**
     * @param $address
     * @param $value
     * @return int
     */
    public function writeHolding($address, $value)
    {
        $packet = new WriteSingleRegisterRequest($address, $value, $this->unitId);

        /** @var WriteSingleRegisterResponse $response */
        $response = $this->write($packet);

        return $response->getValue();
    }

    /**
     * @param ModbusPacket $packet
     * @return ModbusPacket
     */
    private function read(ModbusPacket $packet)
    {
        $client = $this->getClient();
        try {
            $connect = $client->connect();
            $binaryData = $connect->sendAndReceive($packet);
//            var_dump($binaryData);die;

            $response = ResponseFactory::parseResponseOrThrow($binaryData);

            return $response;


        } catch (Exception $exception) {
            echo $exception->getMessage() . PHP_EOL;
            die;
        } finally {
            $client->close();
        }
    }

    private function write($packet)
    {
        $client = $this->getClient();
        try {
            $connect = $client->connect();
            $binaryData = $connect->sendAndReceive($packet);
//            var_dump($binaryData);die;

            $response = ResponseFactory::parseResponseOrThrow($binaryData);

            return $response;


        } catch (Exception $exception) {
            echo $exception->getMessage() . PHP_EOL;
            die;
        } finally {
            $client->close();
        }
    }

    /**
     * @param $type
     * @return string
     */
    public function parseTypeClass($type)
    {
        switch ($type) {
            case HardwareEnum::DUCOBOX:
                return Unit::class;
            case HardwareEnum::CO_VALVE:
                return Valve::class;
            case HardwareEnum::HUMIDITY_VALVE:
                return Valve::class;
            default:
                return null;
        }
    }
}