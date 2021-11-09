<?php
require_once 'ResponseCodes.php';

class TalkToAtlante
{
    private $errors;
    private $data;

    /**
     * @param array $data The data to be encoded and sent to the client.
     * @param array $errors The current error from the response.
     */
    public function __construct(array $data = [], array $errors = [])
    {
        $this->errors = $errors;
        $this->data = $data;
    }

    final public function setError(ResponseCodes $errorType = null, $message = 'An error ocurred, no details where specified', $statusCode = 400)
    {
        if ($errorType !== null) {
            $this->errors[] = [
                'message' => $errorType->getMessage(),
            ];
            $this->setResponseStatusCode($errorType->getStatusCode());
        } else {
            $this->errors[] = [
                'message' => $message,
            ];
            $this->setResponseStatusCode($statusCode);
        }

    }

    /**
     * @param $statusCode
     */
    private function setResponseStatusCode($statusCode)
    {
        header('X-PHP-Response-Code: ' . $statusCode, true, $statusCode);
    }

    final public function sendResponse(array $data = [], $statusCode = 200)
    {
        $this->enableCors();
        $this->setJsonResponseHeaders();

        if (count($this->errors) > 0) {
            echo json_encode(['errors' => $this->errors]);
            die();
        }
        $this->setData($data);
        if ($this->data !== null) {
            $this->setResponseStatusCode($statusCode);
            echo json_encode($this->data);
            die();
        }
    }

    final public function enableCors()
    {
        //First, check if it is an option request. In this case, the properly cors-headers should be added.
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET, OPTIONS');
            header('Access-Control-Allow-Headers: Content-Type');
        }
    }

    private function setJsonResponseHeaders()
    {
        header('Content-Type: application/json');
    }

    private function setData(array $data)
    {
        $this->data = $data;
    }

    private function formatResponseBody()
    {
        $this->response = json_encode($this->data, JSON_UNESCAPED_UNICODE);
    }


}