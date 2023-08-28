<?php namespace Holamanola45\Www\Entity\User;

use Holamanola45\Www\Lib\Http\Request;
use Holamanola45\Www\Lib\Http\Response;

class UserController {

    private UserService $userService;

    function __construct() {
        $this->userService = new UserService();
    }

    public function getAllUsers(Request $req, Response $res) {
        $allUsers = $this->userService->findAll(array(
            'limit' => 10,
            'offset' => 0
        ));

        $res->status(200);
        $res->toXML(array(
            'users' => $allUsers
        ));
    }

    public function getUser(Request $req, Response $res) {
        $user = $this->userService->findByUsername($req->params[0]);

        $res->status(200);
        $res->toXML(array(
            'user' => $user
        ));
    }

    public function getById(Request $req, Response $res) {
        $user = $this->userService->findById($req->params[0], array(
            'attributes' => array('id', 'username')
        ));

        $res->status(200);
        $res->toXML(array(
            'user' => $user
        ));
    }
}