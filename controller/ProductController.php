<?php
include('../model/repository/ProductRepository.php');
include('../model/models/Product.php');

class ProductController
{
    private $db;
    private $requestMethod;
    private $productRepository;
    private $productId;
    private $productName;
    private $isColectional;

    /**
     * @return mixed
     */
    public function getIsColectional()
    {
        return $this->isColectional;
    }

    /**
     * @param mixed $isColectional
     */
    public function setIsColectional($isColectional): void
    {
        $this->isColectional = $isColectional;
    }

    /**
     * @param mixed $productName
     */
    public function setProductName($productName): void
    {
        $this->productName = $productName;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param mixed $productId
     */
    public function setProductId($productId): void
    {
        $this->productId = $productId;
    }

    /**
     * ProductController constructor.
     * @param $db
     * @param $requestMethod
     */
    public function __construct($db, $RequestMethod)
    {
        $this->db = $db;
        $this->requestMethod = $RequestMethod;
        $this->productRepository = new ProductRepository();

    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->productId) {
                    $response = $this->getProduct($this->productId);
                } else {
                    if ($this->isColectional == 1) {
                        $response = $this->getAllColectionalProducts();
                    } else {
                        if ($this->isColectional == 0) {
                            $response = $this->getAllGamesProducts();
                        } else {
                            if ($this->productName)
                                $response = $this->getProductByName($this->productName);

                            else {
                                $response = $this->getAllProducts();
                            }
                        }

                    }
                }

                break;
            case
            'POST':
                $response = $this->createProductFromRequest();
                break;
            case 'PUT':
                if ($this->productId) {
                    $response = $this->updateProductFromRequest($this->productId);
                } else {
                    if ($this->productName)
                        $response = $this->updateProductByName($this->productName);
                }

                break;
            case 'DELETE':

                if ($this->productId) {
                    $response = $this->deleteProduct($this->productId);
                } else {
                    if ($this->productName)
                        $response = $this->deleteProductByName($this->productName);
                }
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }


    private
    function getProduct($productId)
    {
        $result = $this->productRepository->findProductById($productId);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private
    function getProductByName($productName)
    {
        $result = $this->productRepository->findProductByName($productName);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private
    function getAllProducts()
    {
        $result = $this->productRepository->getProducts();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result, JSON_PRETTY_PRINT);
        return $response;
    }

    private
    function getAllColectionalProducts()
    {
        $result = $this->productRepository->getColectionalProducts();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result, JSON_PRETTY_PRINT);
        return $response;
    }

    private function getAllGamesProducts()
    {
        $result = $this->productRepository->getGamesProducts();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result, JSON_PRETTY_PRINT);
        return $response;
    }

    private
    function deleteProduct($productId)
    {
        $result = $this->productRepository->findProductById($productId);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $this->productRepository->deleteProductByID($productId);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    }

    function deleteProductByName($productName)
    {
        $result = $this->productRepository->findProductByName($productName);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $this->productRepository->deleteProductByName($productName);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    }

    private
    function updateProductFromRequest($productId)
    {
        $result = $this->productRepository->findProductById($productId);
        if (!$result) {
            return $this->notFoundResponse();
        }

        // print_r($result);
        $prod = new Product($result['name'], $result['type'], $result['picture_path'], $result['price'],
            $result['category'], $result['age_target'], $result['number_of_players'], $result['rating'],
            $result['inStock'], $result['productYear']);
        $prod->setId($result['id']);
        $prod->setNumberSelles($result['numberSelles']);
        $prod->setNumViews($result['numViews']);
        $prod->setColectional($result['colectional']);
        //echo "$prod->getType()";
        $input = (array)json_decode(file_get_contents('php://input'), TRUE);

        if (!$this->validateProductUpdate($input)) {
            return $this->unprocessableEntityResponse();
        }
        //print_r($input);
//        if(isset($input['name'])){
//            $prod->setName($input['name']);
//        }
        if (isset($input['price'])) {
            $prod->setPrice($input['price']);
        }
        if (isset($input['category'])) {
            $prod->setCategory($input['category']);
        }
        if (isset($input['inStock'])) {
            $prod->setInStock($input['inStock']);
        }
        if (isset($input['numberSelles'])) {
            $prod->setNumberSelles($input['numberSelles']);
        }
        $this->productRepository->updateProduct($productId, $prod);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = 'product updated succesfully';
        return $response;
    }

    function updateProductByName($productName)
    {
        $result = $this->productRepository->findProductByName($productName);
        if (!$result) {
            return $this->notFoundResponse();
        }
        $productId = $result['id'];
        //print_r($result);
        // print_r($result);
        $prod = new Product($result['name'], $result['type'], $result['picture_path'], $result['price'],$result['category'], $result['age_target'], $result['number_of_players'], $result['rating'], $result['inStock'], $result['productYear']);
        $prod->setId($result['id']);
        $prod->setNumberSelles($result['numberSelles']);
        $prod->setNumViews($result['numViews']);
        $prod->setColectional($result['colectional']);
        //echo "$prod->getType()";
        $input = (array)json_decode(file_get_contents('php://input'), TRUE);

        if (!$this->validateProductUpdate($input)) {
            return $this->unprocessableEntityResponse();
        }
        // print_r($input);
//        if(isset($input['name'])){
//            $prod->setName($input['name']);
//        }
        if (isset($input['price'])) {
            $prod->setPrice($input['price']);
        }
        if (isset($input['category'])) {
            $prod->setCategory($input['category']);
        }
        if (isset($input['inStock'])) {
            $prod->setInStock($input['inStock']);
        }
        if (isset($input['numberSelles'])) {
            $prod->setNumberSelles($input['numberSelles']);
        }
        $this->productRepository->updateProduct($productId, $prod);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = 'product updated succesfully';
        return $response;
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }

    private
    function createProductFromRequest()
    {
        $input = (array)json_decode(file_get_contents('php://input'), TRUE);
        if (!$this->validateProduct($input)) {
            return $this->unprocessableEntityResponse();
        }
        //$input['picture_name']="../auction-images/".$input['picture_name'];
        // print_r($input);

        $name = $input['name'];;
        $type = $input['type'];
        $picture_path = "../product_images/" . $input['picture_name'];
        $price = $input['price'];
        $category = $input['category'];;
        $age_target = $input['age_target'];
        $number_of_players = $input['number_of_players'];
        $rating = $input['rating'];
        $inStock = $input['inStock'];
        $productYear = $input['productYear'];
        $newProduct = new Product($name, $type, $picture_path, $price, $category, $age_target, $number_of_players, $rating, $inStock, $productYear);
        if (isset($input['numViews'])) {
            $newProduct->setNumViews(($input['numViews']));
        }
        $newProduct->setColectional($input['colectional']);
        $this->productRepository->addProduct($newProduct);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = null;
        return $response;
    }

    private
    function validateProduct($input)
    {
        if (!isset($input['name'])) {
            return false;
        }
        if (!isset($input['type'])) {
            return false;
        }
        if (!isset($input['picture_name'])) {
            return false;
        }
        if (!isset($input['price'])) {
            return false;
        }
        if (!isset($input['category'])) {
            return false;
        }
        if (!isset($input['age_target'])) {
            return false;
        }
        if (!isset($input['rating'])) {
            return false;
        }
        if (!isset($input['inStock'])) {
            return false;
        }
        if (!isset($input['productYear'])) {
            return false;
        }
        return true;
    }

    private
    function validateProductUpdate($input)
    {
        if (empty($input)) {
            return false;
        }
        return true;
    }

    private
    function unprocessableEntityResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode([
            'error' => 'Invalid input'
        ]);
        return $response;
    }
}

?>
