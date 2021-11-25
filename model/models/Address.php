<?php


class Address
{
    private $userId;
    private $country;
    private $state;
    private $city;
    private $streetName;
    private $building;
    private $entrance;
    private $floor;
    private $apartment;
    private $postalCode;

    /**
     * Address constructor.
     * @param $country
     * @param $state
     * @param $city
     * @param $streetName
     * @param $building
     * @param $entrance
     * @param $floor
     * @param $apartment
     * @param $postalCode
     * @param $userId
     */
    public function __construct($userId,$country, $state, $city, $streetName, $building, $entrance, $floor, $apartment, $postalCode )
    {
        $this->country = $country;
        $this->state = $state;
        $this->city = $city;
        $this->streetName = $streetName;
        $this->building = $building;
        $this->entrance = $entrance;
        $this->floor = $floor;
        $this->apartment = $apartment;
        $this->postalCode = $postalCode;
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country): void
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state): void
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getStreetName()
    {
        return $this->streetName;
    }

    /**
     * @param mixed $streetName
     */
    public function setStreetName($streetName): void
    {
        $this->streetName = $streetName;
    }

    /**
     * @return mixed
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * @param mixed $building
     */
    public function setBuilding($building): void
    {
        $this->building = $building;
    }

    /**
     * @return mixed
     */
    public function getEntrance()
    {
        return $this->entrance;
    }

    /**
     * @param mixed $entrance
     */
    public function setEntrance($entrance): void
    {
        $this->entrance = $entrance;
    }

    /**
     * @return mixed
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * @param mixed $floor
     */
    public function setFloor($floor): void
    {
        $this->floor = $floor;
    }

    /**
     * @return mixed
     */
    public function getApartment()
    {
        return $this->apartment;
    }

    /**
     * @param mixed $apartment
     */
    public function setApartment($apartment): void
    {
        $this->apartment = $apartment;
    }

    /**
     * @return mixed
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param mixed $postalCode
     */
    public function setPostalCode($postalCode): void
    {
        $this->postalCode = $postalCode;
    }

}