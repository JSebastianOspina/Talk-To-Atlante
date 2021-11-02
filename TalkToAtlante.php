<?php

class TalkToAtlante
{
    private $errors;
    private $response;
    private $data;
    private $statusCode;

    /**
     * @param array $errors The current error from the response.
     * @param array $response
     * @param array $data The data to be encoded and sent to the client.
     * @param int $statusCode The last status code sent to client. By default, this is 200
     */
    public function __construct(array $errors = [], $response = '', array $data = [], $statusCode = 200)
    {
        $this->errors = $errors;
        $this->response = $response;
        $this->data = $data;
        $this->statusCode = $statusCode;
    }

    public function setError(ResponseCodes $errorType = null, $message = 'An error ocurred, no details where specified', $statusCode = 400)
    {
        if ($errorType !== null) {
            $this->errors[] = [
                'message' => $errorType->getMessage(),
            ];
            header('X-PHP-Response-Code: ' . $errorType->getStatusCode(), true, $errorType->getStatusCode());
        } else {
            $this->errors[] = [
                'message' => $message,
            ];
            header('X-PHP-Response-Code: ' . $statusCode, true, $statusCode);
        }


    }

    public function sendResponse()
    {
        $this->enableCors();
        $this->setJsonResponseHeaders();

        if (count($this->errors) > 0) {
            echo json_encode($this->errors);
            die();
        }
        if ($this->data !== null) {
            echo json_encode($this->data);
            die();
        }
    }

    public function enableCors()
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

    private function formatResponseBody()
    {
        $this->response = json_encode($this->data, JSON_UNESCAPED_UNICODE);
    }


}