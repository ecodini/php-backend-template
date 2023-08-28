<?php namespace Holamanola45\Www\Lib\Utils;
      use Holamanola45\Www\Lib\Http\Response;

class GenericHttpError {
    public static function NotFoundError(Response $res, string $message = NULL) {
        $res->status(404);

        if (!isset($message)) {
            $message = 'Not Found';
        }

        $res->toXML(array(
            'message' => $message
        ));
    }

    public static function BadRequestError(Response $res, string $message = NULL) {
        $res->status(400);

        if (!isset($message)) {
            $message = 'Bad Request';
        }

        $res->toXML(array(
            'message' => $message
        ));
    }

    public static function InternalServerError(Response $res, string $message = NULL) {
        $res->status(500);

        if (!isset($message)) {
            $message = 'Internal Server Error';
        }

        $res->toXML(array(
            'message' => $message
        ));
    }

    public static function UnauthorizedError(Response $res, string $message = NULL) {
        $res->status(401);

        if (!isset($message)) {
            $message = 'Unauthorized';
        }

        $res->toXML(array(
            'message' => $message
        ));
    }

    public static function ForbiddenError(Response $res, string $message = NULL) {
        $res->status(403);

        if (!isset($message)) {
            $message = 'Forbidden';
        }

        $res->toXML(array(
            'message' => $message
        ));
    }
}