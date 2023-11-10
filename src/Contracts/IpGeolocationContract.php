<?php

namespace Cornatul\Weather\Contracts;

interface IpGeolocationContract
{
    public function getLocation(string $ip): object;
}
