<?php

use Cornatul\Weather\Services\IpGeolocation;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

use GuzzleHttp\Psr7\Utils;

class IpGeolocationTest extends TestCase
{
    protected $ipGeolocation;
    protected $mockClient;

    protected function setUp(): void
    {
        $this->mockClient = $this->createMock(ClientInterface::class);
        $this->ipGeolocation = new IpGeolocation($this->mockClient);
    }

    public function testGetLocation()
    {
        // Define a sample IP and a sample response JSON
        $sampleIp = '8.8.8.8';
        $sampleResponseJson = '{"ip":"8.8.8.8","country":"United States","city":"Mountain View","region":"California"}';

        // Create a mock response for the Guzzle client
        $mockResponse = $this->createMock(ResponseInterface::class);
        $mockStream = Utils::streamFor($sampleResponseJson);

        $mockResponse->method('getBody')->willReturn($mockStream);

        // Configure the mock client to return the mock response
        $this->mockClient->method('request')->willReturn($mockResponse);

        // Call the getLocation method
        $location = $this->ipGeolocation->getLocation($sampleIp);

        // Check if the returned object has the expected properties
        $this->assertInstanceOf(stdClass::class, $location);
        $this->assertEquals('8.8.8.8', $location->ip);
        $this->assertEquals('United States', $location->country);
        $this->assertEquals('Mountain View', $location->city);
        $this->assertEquals('California', $location->region);
    }
}
