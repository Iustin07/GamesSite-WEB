<?php
include_once('../../model/models/Order.php');
include_once('../../model/repository/OrderRepository.php');
include_once('../../controller/RequestResponse.php');

class OrderController extends RequestResponse
{
    private $requestMethod;
    private $userId;
    private $orderId;
    private $finalized;
    private $orderRepository;

    /**
     * UserController constructor.
     * @param $requestMethod
     * @param $orderId
     * @param $userId
     * @param $finalized
     */
    public function __construct($requestMethod, $orderId, $userId, $finalized)
    {
        $this->requestMethod = $requestMethod;
        $this->orderId = $orderId;
        $this->userId = $userId;
        $this->finalized = $finalized;
        $this->orderRepository = new OrderRepository();
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->orderId) {
                    $response = $this->getOrderByOrderId($this->orderId);
                } else {
                    if ($this->userId && $this->finalized === null) {
                        $response = $this->getOrderByUserId($this->userId);
                    } else {
                        if ($this->userId && $this->finalized) {
                            $response = $this->getOrderByUserIdAndFinalized($this->userId, $this->finalized);
                        } else {
                            $response = $this->getAllOrders();
                        }
                    }
                };
                break;
            case 'POST':
                $response = $this->createOrderFromRequest();
                break;
            case 'PATCH':
                if($this->userId){
                    $response = $this->patchWhereUserIdAndNotFinalized($this->userId);
                }
                else{
                    $response = $this->notFoundResponse("Request not supported");
                }
                break;
            case 'DELETE':
                if ($this->orderId) {
                    $response = $this->deleteOrderById($this->orderId);
                } else {
                    if($this->userId && $this->finalized == null){
                        $response = $this->deleteOrderByUserId($this->orderId);
                    }
                    else{
                        if($this->userId && $this->finalized){
                            $response = $this->deleteOrderWhereUserIdAndNotFinalized($this->userId);
                        }
                        else{
                            $response = $this->notFoundResponse("Request not supported");
                        }
                    }
                }
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

    public function getAllOrders()
    {
        $result = $this->orderRepository->findAllOrders();
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    private function getOrderByUserId($id)
    {
        $result = $this->orderRepository->findUserOrdersById($id);
        if (!$result) {
            return parent::notFoundResponse("Order doesn't exist");
        }
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    private function getOrderByUserIdAndFinalized($id, $finalized)
    {
        $result = $this->orderRepository->findOrdersWhereUserIdAndNotFinalized($id, $finalized);
        if (!$result) {
            return parent::notFoundResponse("Order doesn't exist");
        }
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    private function getOrderByOrderId($id)
    {
        $result = $this->orderRepository->findOrderById($id);
        if (!$result) {
            return parent::notFoundResponse("Order doesn't exist");
        }
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    public function patchWhereUserIdAndNotFinalized($id){
        $result = $this->orderRepository->updateWhereUserIdAndNotFinalized($id);
        if (!$result) {
            return parent::notFoundResponse("Order doesn't exist");
        }
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    private function createOrderFromRequest()
    {
        $input = json_decode(file_get_contents('php://input'), TRUE);
        $userId = $input['id_user'];
        $payment = $input['payment'];
        $order = new Order($userId, $payment);
        if (!$this->validateOrder($input)) {
            return parent::unprocessableEntityResponse();
        }
        $answer = $this->orderRepository->addOrder($order);
        $response['status_code'] = 'HTTP/1.1 201 Created';
        if (!is_int($answer)) {
            $response['body'] = array("Couldn't add order:" => $answer);
        } else {
            $response['body'] = 'Order added successfully!';
        }

        return $response;
    }

    private function deleteOrderById($id)
    {
        $result = $this->orderRepository->deleteOrderByOrderId($id);
        if (!$result) {
            return parent::notFoundResponse("Order doesn't exist");
        }
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = 'Order deleted successfully!';
        return $response;
    }

    private function deleteOrderByUserId($id)
    {
        $result = $this->orderRepository->deleteOrderByUserId($id);
        if (!$result) {
            return parent::notFoundResponse("Order doesn't exist");
        }
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = 'Order deleted successfully!';
        return $response;
    }
    private function deleteOrderWhereUserIdAndNotFinalized($id)
    {
        $result = $this->orderRepository->deleteOrdersWhereNotFinalized($id);
        if (!$result) {
            return parent::notFoundResponse("Order doesn't exist or was finalized");
        }
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = 'Order deleted successfully!';
        return $response;
    }

    private function validateOrder($input)
    {
        if (!isset($input['id_user']) ||
            !isset($input['payment'])) {
            return false;
        }
        return true;
    }
}