<?php namespace Holamanola45\Www\Lib;

class GenericHttpError {
    public static function NotFoundError(Response $res, string $message = NULL) {
        if (!isset($message)) {
            $message = 'Not Found';
        }

        $res->toXML(array(
            'status' => 404,
            'message' => $message
        ));
    }

    public static function InternalServerError(Response $res, string $message = NULL) {
        if (!isset($message)) {
            $message = 'Internal Server Error';
        }

        $res->toXML(array(
            'status' => 500,
            'message' => $message
        ));
    }

    public static function UnauthorizedError(Response $res, string $message = NULL) {
        if (!isset($message)) {
            $message = 'Unauthorized';
        }

        $res->toXML(array(
            'status' => 401,
            'message' => $message
        ));
    }

    public static function ForbiddenError(Response $res, string $message = NULL) {
        if (!isset($message)) {
            $message = 'Forbidden';
        }

        $res->toXML(array(
            'status' => 403,
            'message' => $message
        ));
    }
}