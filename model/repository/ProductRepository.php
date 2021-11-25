<?php

include('../model/connection/Connection.php');

class ProductRepository
{
    private static $selectProductsQuery =
        "select * from PRODUCTS p";
    private static $selectProductsAuction = "select * from PRODUCTS p where p.COLECTIONAL=1";
    private static $selectProductsGames = "select * from PRODUCTS p where p.COLECTIONAL=0";
    private static $selectProductWhereId = "select * from PRODUCTS p where p.ID=:id";
    private static $selectWhereName = "select * from PRODUCTS p where trim(upper(p.NAME))=trim(upper(:name))"; //like name??
    private static $insertQuery =
        "insert into PRODUCTS(NAME, TYPE, PICTURE_PATH,PRICE,CATEGORY,AGE_TARGET,NUMBER_OF_PLAYERS,RATING,INSTOCK,PRODUCTYEAR,COLECTIONAL) 
         values( :name,:type,:picture_path,:price, :category, :age_target,:number_of_players,:rating,:inStock,:productYear,:colectional)";

    private static $insertQuerySecond="insert into PRODUCTS(NAME, TYPE, PICTURE_PATH,PRICE,CATEGORY,AGE_TARGET,NUMBER_OF_PLAYERS,RATING,NUMVIEWS,INSTOCK,PRODUCTYEAR,COLECTIONAL) 
         values( :name,:type,:picture_path,:price, :category, :age_target,:number_of_players,:rating,:numViews,:inStock,:productYear,:colectional)";

    private static $deleteByName=
        "delete from PRODUCTS where NAME=:name";
    private static $deleteById =
        "delete from PRODUCTS where ID=:id";
    private static $updateById =
        "update PRODUCTS set TYPE=:type, PICTURE_PATH=:picture_path, PRICE=:price, CATEGORY=:category, AGE_TARGET=:age_target,
                    NUMBER_OF_PLAYERS=:numberOfplayers,RATING=:rating,NUMVIEWS=:numViews, INSTOCK=:inStock,
                    NUMBERSELLES=:numberSelles,PRODUCTYEAR=:productYear,COLECTIONAL=:colectional where ID=:id";

    public function __constructor(){

    }

    public function getProducts()
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$selectProductsQuery);
            $stmt->execute();
            $resultSet = $stmt->fetchAll();
//            echo '<pre>'; print_r($resultSet); echo '</pre>';
           // $arrayProducts = array();
//            foreach ($resultSet as $row) {
//                array_push($arrayProducts, $row);
//            }
//            return $arrayProducts;
            return $resultSet;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getColectionalProducts()
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$selectProductsAuction);
            $stmt->execute();
            $resultSet = $stmt->fetchAll();
            return $resultSet;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function getGamesProducts()
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$selectProductsGames);
            $stmt->execute();
            $resultSet = $stmt->fetchAll();
            return $resultSet;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function findProductById($ID)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$selectProductWhereId);
            $stmt->bindParam(':id', $ID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function findProductByName($NAME){
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$selectWhereName);
            $stmt->bindParam(':name', $NAME);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function addProduct(Product $product){
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if($product->getNumberOfPlayers()!=null){
                $stmt=$conn->getConnection()->prepare(self::$insertQuerySecond);
            $numberOfPlayers=$product->getNumberOfPlayers();
            $stmt->bindParam(':number_of_players',$numberOfPlayers);
                $numViews=$product->getNumViews();
                $stmt->bindParam(':numViews',$numViews);
            }else{
            $stmt = $conn->getConnection()->prepare(self::$insertQuery);
            }
            $name = $product->getName();
                $stmt->bindParam(':name', $name);
            $type=$product->getType();
                $stmt->bindParam(':type', $type);
            $picture_path = $product->getPicturePath();
               $stmt->bindParam(':picture_path', $picture_path);
            $price = $product->getPrice();
                $stmt->bindParam(':price', $price);
            $category = $product->getCategory();
                $stmt->bindParam(':category', $category);
            $ageTarget =$product->getAgeTarget();
                $stmt->bindParam(':age_target', $ageTarget);
            $numberOfPlayers =$product->getNumberOfPlayers();
            $stmt->bindParam(':number_of_players', $numberOfPlayers);
            $rating=$product->getRating();
                $stmt->bindParam(':rating',$rating);
            $inStock = $product->getInStock();
                $stmt->bindParam(':inStock', $inStock);
            $productYear=$product->getProductYear();
                $stmt->bindParam(':productYear', $productYear);
            $colectional=$product->getColectional();
                 $stmt->bindParam(":colectional",$colectional);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "aici eroarea";
            echo "Error: " . $e->getMessage();
        }
    }
    /**
     * @param $ID
     */
    public function deleteProductByID($ID)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$deleteById);
            $stmt->bindParam(':id', $ID, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    /**
     * @param $NAME
     */
    public function deleteProductByName($NAME)
    {
        try {
            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$deleteByName);
            $stmt->bindParam(':name', $NAME);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    /**
     * @param Product $product
     */
    public function updateProduct($productId,Product $product)
    {
        try {

            $conn = new Connection();
            $conn->getConnection()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->getConnection()->prepare(self::$updateById);
            $type=$product->getType();
                $stmt->bindParam(':type',$type);
            $picture_path = $product->getPicturePath();
                $stmt->bindParam(':picture_path', $picture_path);
            $price = $product->getPrice();
                 $stmt->bindParam(':price', $price);
            $category=$product->getCategory();
                $stmt->bindParam(':category',$category);
            $age_target = $product->getAgeTarget();
                $stmt->bindParam(':age_target', $age_target);
            $number_of_players = $product->getNumberOfPlayers();
                $stmt->bindParam(':numberOfplayers', $number_of_players);
            $rating = $product->getRating();
                $stmt->bindParam(':rating', $rating);
            $numViews = $product->getNumViews();
                 $stmt->bindParam(':numViews', $numViews);
            $inStock = $product->getInStock();
                $stmt->bindParam(':inStock', $inStock);
            $numberSelles = $product->getNumberSelles();
                $stmt->bindParam(':numberSelles', $numberSelles);
            $productYear = $product->getProductYear();
                     $stmt->bindParam(':productYear', $productYear);
            $colectionalo=$product->getColectional();
                    $stmt->bindParam(":colectional",$colectionalo);
                    $var=2;
            $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
            $stmt->execute();

        } catch (PDOException $e) {
            echo 'eroare up \n';
            echo "Error: " . $e->getMessage();
        }
    }
}