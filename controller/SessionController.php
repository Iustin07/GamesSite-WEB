<?php
include_once '../../model/models/Session.php';
include_once '../../model/repository/SessionRepository.php';
include_once 'RequestResponse.php';

class SessionController extends RequestResponse
{
    private $requestMethod;
    private $userId;
    private $token;
    private $serial;
    private $id;
    private $sessionRepository;

    /**
     * UserController constructor.
     * @param $requestMethod
     * @param $userId
     */
    public function __construct($requestMethod, $userId, $token, $serial)
    {
        $this->requestMethod = $requestMethod;
        $this->userId = $userId;
        $this->token = $token;
        $this->serial = $serial;
        $this->sessionRepository = new SessionRepository();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                if ($this->token) {
                    $response = $this->getSessionByToken($this->token);
                } else {
                    if ($this->id) {
                        $response = $this->getSession($this->id);
                    } else {
                        if ($this->userId) {
                            $response = $this->getSessionByUserId($this->userId);
                        } else {
                            $response = $this->getSessions();
                        }
                    }
                };
                break;
            case 'POST':
                $response = $this->createSessionFromRequest();
                break;
            case 'PUT':
                $response = $this->updateSessionFromRequest($this->id);
                break;
            case 'DELETE':
                if ($this->id) {
                    $response = $this->deleteSessionById($this->id);
                } else {
                    if ($this->userId) {
                        $response = $this->deleteSessionByUserId($this->userId);
                    } else {
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

    private function getSessions()
    {
        $result = $this->sessionRepository->findAll();
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    private function getSession($ID)
    {
        $result = $this->sessionRepository->findById($ID);
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    private function getSessionByToken($TOKEN)
    {
        $result = $this->sessionRepository->findByToken($TOKEN);
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    private function getSessionByUserId($ID)
    {
        $result = $this->sessionRepository->findByUserId($ID);
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = $result;
        return $response;
    }

    private function createSessionFromRequest()
    {
        $input = json_decode(file_get_contents('php://input'), TRUE);
        $userId = null;
        $token = null;
        $serial = null;
        if ($input) {
            if ($input['ID_USER']) {
                $userId = $input['ID_USER'];
            }
            if ($input['TOKEN']) {
                $token = $input['TOKEN'];
            }
            if ($input['SERIAL']) {
                $serial = $input['SERIAL'];
            }
        }
        if ($this->userId) {
            $userId = $this->userId;
        }
        if ($this->token) {
            $token = $this->token;
        }
        if ($this->serial) {
            $serial = $this->serial;
        }
        $session = new Session($userId, $token, $serial);
        if($input){
            if (!$this->validateSession($input)) {
                return $this->unprocessableEntityResponse();
            }
        }
        else{
            if (!$this->validateSessionFromInnerReq()) {
                return $this->unprocessableEntityResponse();
            }
        }
        $answer = $this->sessionRepository->addSession($session);
        $response['status_code'] = 'HTTP/1.1 201 Created';
        if (!is_int($answer)) {
            $response['body'] = array("Couldn't create session:" => $answer);
        } else {
            $response['body'] = 'Session created successfully!';
        }
        return $response;
    }

    private function updateSessionFromRequest($id)
    {
        $result = $this->sessionRepository->findByUserId($id);
        if (!$result) {
            return $this->notFoundResponse("Session doesn't exist");
        }
        $input = json_decode(file_get_contents('php://input'), TRUE);
        $token = $input['TOKEN'];
        $serial = $input['SERIAL'];
        $session = new Session($id, $token, $serial);
        if (!$this->validateSession($input)) {
            return $this->unprocessableEntityResponse();
        }
        $this->sessionRepository->updateSession($session);
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = 'Session updated successfully';
        return $response;
    }

    private function deleteSessionByUserId($id)
    {
        $result = $this->sessionRepository->deleteSessionByUserId($id);
        if (!$result) {
            return $this->notFoundResponse("Session doesn't exist");
        }
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = 'Session deleted successfully!';
        return $response;
    }

    private function deleteSessionById($id)
    {
        $result = $this->sessionRepository->deleteSessionByID($id);
        if (!$result) {
            return $this->notFoundResponse("Session doesn't exist");
        }
        $response['status_code'] = 'HTTP/1.1 200 OK';
        $response['body'] = 'Session deleted successfully!';
        return $response;
    }

    private function validateSession($input)
    {
        if (!isset($input['TOKEN']) ||
            !isset($input['SERIAL'])) {
            return false;
        }
        return true;
    }

    private function validateSessionFromInnerReq(){
        if(!isset($this->token) ||
            !isset($this->serial)){
            return false;
        }
        return true;
    }
}