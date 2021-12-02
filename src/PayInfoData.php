<?php

namespace Persec\BinancePay;

class PayInfoData
{
    public $firstName;
    public $middleName;
    public $lastName;
    public $walletId;
    public $country;
    public $city;
    public $address;
    public $identityType;
    public $identityNumber;
    public $dateOfBirth;
    public $placeOfBirth;
    public $nationality;

    public function __construct(array $data)
    {
        $this->firstName = $data['firstName'] ?? null;
        $this->middleName = $data['middleName'] ?? null;
        $this->lastName = $data['lastName'] ?? null;
        $this->walletId = $data['walletId'] ?? null;
        $this->country = $data['country'] ?? null;
        $this->city = $data['city'] ?? null;
        $this->address = $data['address'] ?? null;
        $this->identityType = $data['identityType'] ?? null;
        $this->identityNumber = $data['identityNumber'] ?? null;
        $this->dateOfBirth = $data['dateOfBirth'] ?? null;
        $this->placeOfBirth = $data['placeOfBirth'] ?? null;
        $this->nationality = $data['nationality'] ?? null;
    }
}
