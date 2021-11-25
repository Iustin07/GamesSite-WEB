<?php
include_once '../../model/models/User.php';
include_once '../../model/repository/UserRepository.php';
include_once 'RequestResponse.php';

class UserController extends RequestResponse
{

    private $requestMethod;
    private $userId;
    private $userEmail;
    private $userRepository;

    /**
     * UserController constructor.
     * @param $requestMethod
     * @param $userId
     * @param $userEmail
     */
    public function __construct($requestMethod, $userId, $userEmail)
    {
        $this->requestMethod = $requestMethod;
        $this->userId = $userId;
        $this->userEmail = $userEmail;
        $this->userRepository = new UserRepository();
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->userId) {
                    $response = $this->getUser($this->userId);
                } else {
                    if($this->userEmail){
                        $response = $this->getUserByEmail($this->userEmail);
                    }
                    else{
                        $response = $this->getAllUsers();
                    }
                };
                break;
            case 'POST':
                $response = $this->createUserFromRequest();
                break;
            case 'PUT':
                if($this->userId){
                    $response = $this->updateUserFromRequest($this->userId);
                }
                else{
                    if($this->userEmail){
                        $response = $this->updateUserFromRequestByEmail($this->userEmail);
                    }
                    else{
                        $response = $this->notFoundResponse("Request not supported");
                    }
                }
                break;
            case 'PATCH':
                if($this->userEmail){
                    $response = $this->patchUserFromRequestByEmail($this->userEmail);
                }
                else{
                    if($this->userId){
                        $response = $this->patchUserFromRequestById($this->userId);
                    }
                    else{
                        $response = $this->notFoundResponse("Request not supported");
                    }
                }
                break;
            case 'DELETE':
                if($this->userId){
                    $response = $this->deleteUser($this->userId);
                }
                else{
                    if($this->userEmail){
                        $response = $this->deleteUserByEmail($this->userEmail);
                    }
                    else{
                        $response = $this->notFoundResponse("Request not supported");
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
        return $response['status_code'];
    }

    private function getAllUsers()
    {
        $result = $this->userRepository->getUsers();
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    private function getUser($id)
    {
        $result = $this->userRepository->findById($id);
        if (!$result) {
            return $this->notFoundResponse("User doesn't exist");
        }
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    private function getUserByEmail($email){
        $result = $this->userRepository->findByEmail($email);
        if (!$result) {
            return $this->notFoundResponse("User doesn't exist");
        }
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    private function createUserFromRequest()
    {
        $input = json_decode(file_get_contents('php://input'), TRUE);
        $fName = $input['FNAME'];
        $lName = $input['LNAME'];
        $email = $input['EMAIL'];
        $phone = $input['PHONE_NUMBER'];
        $pwd = $input['PASSWORD'];
        $user = new User($fName, $lName, $email, $phone, $pwd, 0);
        if (!$this->validateUser($input)) {
            return $this->unprocessableEntityResponse();
        }
        $answer = $this->userRepository->addUser($user);
        $response['status_code'] = 'HTTP/1.1 201 Created';
        if(!is_int($answer)){
            $response['body'] = array("Couldn't add user:" => $answer);
        }
        else{
            $response['body'] = 'User added successfully!';
        }

        return $response;
    }

    private function updateUserFromRequest($id)
    {
        $result = $this->userRepository->findById($id);
        if (!$result) {
            return $this->notFoundResponse("User doesn't exist");
        }
        $input = json_decode(file_get_contents('php://input'), TRUE);
        $fName = $input['FNAME'];
        $lName = $input['LNAME'];
        $email = $input['EMAIL'];
        $phone = $input['PHONE_NUMBER'];
        $pwd = $input['PASSWORD'];
        $moneySpent = $input['MONEY_SPENT'];
        $user = new User($fName, $lName, $email, $phone, $pwd, $moneySpent);
        if (!$this->validateUser($input)) {
            return $this->unprocessableEntityResponse();
        }
        $this->userRepository->updateUser($user);
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = 'User updated successfully';
        return $response;
    }
    private function updateUserFromRequestByEmail($EMAIL)
    {
        $result = $this->userRepository->findByEmail($EMAIL);
        if (!$result) {
            return $this->notFoundResponse("User doesn't exist");
        }
        $input = json_decode(file_get_contents('php://input'), TRUE);
        $fName = $input['FNAME'];
        $lName = $input['LNAME'];
        $email = $input['EMAIL'];
        $phone = $input['PHONE_NUMBER'];
        $pwd = $input['PASSWORD'];
        $moneySpent = $input['MONEY_SPENT'];
        $user = new User($fName, $lName, $email, $phone, $pwd, $moneySpent);
        if (!$this->validateUser($input)) {
            return $this->unprocessableEntityResponse();
        }
        $this->userRepository->updateUser($user);
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = 'User updated successfully';
        return $response;
    }

    private function patchUserFromRequestByEmail($EMAIL){
        $result = $this->userRepository->findByEmail($EMAIL);
        if(!$result){
            return $this->notFoundResponse("User doesn't exist");
        }
        $input = json_decode(file_get_contents('php://input'), TRUE);
        $fName = null;
        $lName = null;
        $email = null;
        $phone = null;
        $pwd = null;
        $moneySpent = null;
        if(isset($input['FNAME'])){
            $fName = $input['FNAME'];
        }
        if(isset($input['LNAME'])){
            $lName = $input['LNAME'];
        }
        if(isset($input['EMAIL'])){
            $email = $input['EMAIL'];
        }
        if(isset($input['PHONE_NUMBER'])){
            $phone = $input['PHONE_NUMBER'];
        }
        if(isset($input['PASSWORD'])){
            $pwd = $input['PASSWORD'];
        }
        if(isset($input['MONEY_SPENT'])){
            $moneySpent = $input['MONEY_SPENT'];
        }

        $user = new User($fName, $lName, $email, $phone, $pwd, $moneySpent);
        if(!isset($fName)){
            $user->setFirstName($result['FNAME']);
            echo $user->getFirstName();
        }
        if(!isset($lName)){
            $user->setLastName($result['LNAME']);
        }
        if(!isset($email)){
            $user->setEmail($result['EMAIL']);
        }
        if(!isset($moneySpent)){
            $user->setMoneySpent($result['MONEY_SPENT']);
        }
        if(!isset($pwd)){
            $user->setPassword($result['PASSWORD']);
        }
        if(!isset($phone)){
            $user->setPhoneNumber($result['PHONE_NUMBER']);
        }
        $this->userRepository->updateUser($user);
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = 'User updated successfully';
        return $response;
    }
    private function patchUserFromRequestById($ID){
        $result = $this->userRepository->findById($ID);
        if(!$result){
            return $this->notFoundResponse("User doesn't exist");
        }
        $input = json_decode(file_get_contents('php://input'), TRUE);
        $fName = null;
        $lName = null;
        $email = null;
        $phone = null;
        $pwd = null;
        $moneySpent = null;
        if(isset($input['FNAME'])){
            $fName = $input['FNAME'];
        }
        if(isset($input['LNAME'])){
            $lName = $input['LNAME'];
        }
        if(isset($input['EMAIL'])){
            $email = $input['EMAIL'];
        }
        if(isset($input['PHONE_NUMBER'])){
            $phone = $input['PHONE_NUMBER'];
        }
        if(isset($input['PASSWORD'])){
            $pwd = $input['PASSWORD'];
        }
        if(isset($input['MONEY_SPENT'])){
            $moneySpent = $input['MONEY_SPENT'];
        }

        $user = new User($fName, $lName, $email, $phone, $pwd, $moneySpent);
        if(!isset($fName)){
            $user->setFirstName($result['FNAME']);
        }
        if(!isset($lName)){
            $user->setLastName($result['LNAME']);
        }
        if(!isset($email)){
            $user->setEmail($result['EMAIL']);
        }
        if(!isset($moneySpent)){
            $user->setMoneySpent($result['MONEY_SPENT']);
        }
        if(!isset($pwd)){
            $user->setPassword($result['PASSWORD']);
        }
        if(!isset($phone)){
            $user->setPhoneNumber($result['PHONE_NUMBER']);
        }
        $this->userRepository->updateUser($user);
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = 'User updated successfully';
        return $response;
    }

    private function deleteUser($id)
    {
        $result = $this->userRepository->deleteUserByID($id);
        if (!$result) {
            return $this->notFoundResponse("User doesn't exist");
        }
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = 'User deleted successfully!';
        return $response;
    }

    private function deleteUserByEmail($email)
    {
        $result = $this->userRepository->deleteUserByEmail($email);
        if (!$result) {
            return $this->notFoundResponse("User doesn't exist");
        }
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = 'User deleted successfully!';
        return $response;
    }

    private function validateUser($input)
    {
        if (!isset($input['FNAME']) ||
            !isset($input['LNAME']) ||
            !isset($input['PASSWORD']) ||
            !isset($input['EMAIL']) ||
            !isset($input['PHONE_NUMBER'])) {
            return false;
        }
        return true;
    }
}