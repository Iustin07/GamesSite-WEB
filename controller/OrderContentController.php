<?php
include_once '../../../model/models/OrderContent.php';
include_once '../../../model/repository/OrderContentRepository.php';
include_once '../../../controller/RequestResponse.php';

class OrderContentController extends RequestResponse
{
    private $requestMethod;
    private $productId;
    private $orderId;
    private $orderContentRepository;

    /**
     * UserController constructor.
     * @param $requestMethod
     * @param $orderId
     */
    public function __construct($requestMethod, $orderId, $productId)
    {
        $this->requestMethod = $requestMethod;
        $this->orderId = $orderId;
        $this->productId = $productId;
        $this->orderContentRepository = new OrderContentRepository();
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->orderId) {
                    $response = $this->getOrderByOrderId($this->orderId);
                } else {
                    $response = $this->getOrderByProductId($this->productId);
                };
                break;
            case 'POST':
                $response = $this->createOrderContentFromRequest();
                break;
            default:
                $response = $this->notFoundResponse("Request not supported");
                break;
        }
        header($response['status_code']);
        if ($response['body']) {
            echo json_encode($response['body']);
        }
    }

    private function getOrderByProductId($id)
    {
        $result = $this->orderContentRepository->findProductFromOrders($id);
        if (!$result) {
            return parent::notFoundResponse("Order content doesn't exist");
        }
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    private function getOrderByOrderId($id)
    {
        $result = $this->orderContentRepository->findOrderProducts($id);
        if (!$result) {
            return parent::notFoundResponse("Order content doesn't exist");
        }
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    private function createOrderContentFromRequest()
    {
        $input = json_decode(file_get_contents('php://input'), TRUE);
        $productId = $input['id_product'];
        $orderId = $input['id_order'];
        $orderContent = new OrderContent($orderId, $productId);
        if (!$this->validateOrderContent($input)) {
            return parent::unprocessableEntityResponse();
        }
        $answer = $this->orderContentRepository->addOrderContent($orderContent);
        $response['status_code'] = 'HTTP/1.1 201 Created';
        if (!is_int($answer)) {
            $response['body'] = array("Couldn't add order content:" => $answer);
        } else {
            $response['body'] = 'Order content added successfully!';
        }
        return $response;
    }

    private function validateOrderContent($input)
    {
        if (!isset($input['id_order']) ||
            !isset($input['id_product'])) {
            return false;
        }
        return true;
    }
}