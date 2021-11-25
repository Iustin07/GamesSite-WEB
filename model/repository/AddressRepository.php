<?php
include_once('../../model/connection/Connection.php');

class AddressRepository
{
    private static $selectQuery =
        "select a.id_user, a.country, a.state, a.city, a.street_name, a.building, a.entrance, a.floor,
                  a.apartment, a.postal_code  from addresses a";
    private static $selectWhereId =
        "select a.id_user, a.country, a.state, a.city, a.street_name, a.building, a.entrance, a.floor,
                  a.apartment, a.postal_code  from addresses a where a.id_address=:id";
    private static $selectWhereUserId =
        "select a.id_user, a.country, a.state, a.city, a.street_name, a.building, a.entrance, a.floor,
                  a.apartment, a.postal_code  from addresses a where a.id_user=:id";
    private static $insertQuery =
        "insert into addresses(id_user, country, state, city, street_name, building, entrance, floor, apartment, postal_code) 
         values(:idUserNew,:countryNew, :stateNew, :cityNew, :streetNew, :buildingNew, :entranceNew,
                :floorNew, :apartmentNew, :postalNew)";
    private static $deleteByUserId =
        "delete from addresses where id_user=:id";
    private static $updateByIdUser =
        "update addresses set country=:countryNew, state=:stateNew, city=:cityNew, street_name=:streetNew,
                 building=:buildingNew, entrance=:entranceNew, floor=:floorNew,
                      apartment=:apartmentNew, postal_code=:postalNew where id_user=:id";

    /**
     * UserRepository constructor.
     */
    public function __construct()
    {
    }


    /**
     * @return array|string
     */
    public function getAddresses()
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$selectQuery);
            $stmt->execute();
            $resultSet = $stmt->fetchAll();

            $arrayAddresses = array();
            foreach ($resultSet as $row) {
                array_push($arrayAddresses, $row);
            }
            return $arrayAddresses;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }


    /**
     * @param $ID
     * @return mixed
     */
    public function findById($ID)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$selectWhereId);
            $stmt->bindParam(':id', $ID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }


    /**
     * @param $ID
     * @return mixed
     */
    public function findByUserId($ID)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$selectWhereUserId);
            $stmt->bindParam(':id', $ID);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }


    /**
     * @param Address $address
     * @param $ID
     * @return int|string
     */
    public function updateAddress(Address $address, $ID)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$updateByIdUser);

            $country = $address->getCountry();
            $stmt->bindParam(':countryNew', $country);

            $state = $address->getState();
            $stmt->bindParam(':stateNew', $state);

            $city = $address->getCity();
            $stmt->bindParam(':cityNew', $city);

            $street = $address->getStreetName();
            $stmt->bindParam(':streetNew', $street);

            $building = $address->getBuilding();
            $stmt->bindParam(':buildingNew', $building);

            $entrance = $address->getEntrance();
            $stmt->bindParam(':entranceNew', $entrance);

            $floor = $address->getFloor();
            $stmt->bindParam(':floorNew', $floor, PDO::PARAM_INT);

            $apartment = $address->getApartment();
            $stmt->bindParam(':apartmentNew', $apartment, PDO::PARAM_INT);

            $postal = $address->getPostalCode();
            $stmt->bindParam(':postalNew', $postal);

            $stmt->bindParam(':id', $ID, PDO::PARAM_INT);

            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $ID
     * @return int|string
     */
    public function deleteByUserId($ID)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$deleteByUserId);
            $stmt->bindParam(':id', $ID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }


    /**
     * @param Address $address
     * @return int|string
     */
    public function addAddress(Address $address)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$insertQuery);

            $userId = $address->getUserId();
            $stmt->bindParam(':idUserNew', $userId, PDO::PARAM_INT);

            $country = $address->getCountry();
            $stmt->bindParam(':countryNew', $country);

            $state = $address->getState();
            $stmt->bindParam(':stateNew', $state);

            $city = $address->getCity();
            $stmt->bindParam(':cityNew', $city);

            $street = $address->getStreetName();
            $stmt->bindParam(':streetNew', $street);

            $building = $address->getBuilding();
            $stmt->bindParam(':buildingNew', $building);

            $entrance = $address->getEntrance();
            $stmt->bindParam(':entranceNew', $entrance);

            $floor = $address->getFloor();
            $stmt->bindParam(':floorNew', $floor, PDO::PARAM_INT);

            $apartment = $address->getApartment();
            $stmt->bindParam(':apartmentNew', $apartment, PDO::PARAM_INT);

            $postal = $address->getPostalCode();
            $stmt->bindParam(':postalNew', $postal);

            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}