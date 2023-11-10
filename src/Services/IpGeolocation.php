<?php

namespace Cornatul\Weather\Services;

use Cornatul\Weather\Contracts\IpGeolocationContract;
use Cornatul\Weather\DTO\LocationDTO;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class IpGeolocation implements IpGeolocationContract
{
    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @method getLocation
     * @param string $ip
     * @return object
     * @throws GuzzleException
     */
    public final function getLocation(string $ip):LocationDTO
    {
        $response = $this->client->request('GET', 'http://ip-api.com/json/' . $ip);
        $data = json_decode($response->getBody()->getContents());
        return new LocationDTO($data);
    }

}
