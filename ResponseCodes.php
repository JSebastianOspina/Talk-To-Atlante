<?php

abstract class ResponseCodes
{
    private $message;
    private $statusCode;

    /**
     * @return mixed
     */
    abstract public function getMessage();

    abstract public function getStatusCode();

}

class BadRequestError extends ResponseCodes
{
    private $message = 'Recibimos tu solicitud, pero aparentemente alguno de los parametros que enviaste no coincide.
    Por favor, revisa la documentación de la API';
    private $statusCode = 400;

    final public function getMessage()
    {
        return $this->message;
    }

    final public function getStatusCode()
    {
        return $this->statusCode;
    }
}

class UnauthorizedError extends ResponseCodes
{
    private $message = 'Los datos de autentificación son incorrectos';
    private $statusCode = 401;

    final public function getMessage()
    {
        return $this->message;
    }

    final public function getStatusCode()
    {
        return $this->statusCode;
    }
}

class ForbiddenError extends ResponseCodes
{
    private $message = 'La petición fue correcta. Sin embargo, no tienes acceso a el recurso solicitado.';
    private $statusCode = 403;

    final public function getMessage()
    {
        return $this->message;
    }

    final public function getStatusCode()
    {
        return $this->statusCode;
    }
}

class NotFoundError extends ResponseCodes
{
    private $message = 'No se ha encontrado el registro solicitado en la base de datos';
    private $statusCode = 404;

    final public function getMessage()
    {
        return $this->message;
    }

    final public function getStatusCode()
    {
        return $this->statusCode;
    }
}


class ServerError extends ResponseCodes
{
    private $message = 'Ha ocurrido un problema y no fuimos capaces de completar la solicitud.';
    private $statusCode = 500;

    final public function getMessage()
    {
        return $this->message;
    }

    final public function getStatusCode()
    {
        return $this->statusCode;
    }
}

class UnavailableError extends ResponseCodes
{
    private $message = 'El recurso solicitado no se encuentra disponible.';
    private $statusCode = 503;

    final public function getMessage()
    {
        return $this->message;
    }

    final public function getStatusCode()
    {
        return $this->statusCode;
    }
}


