<?php namespace Holamanola45\Www\Entity\User;

use Holamanola45\Www\Lib\Request;
use Holamanola45\Www\Lib\Response;

class UserController {

    private UserService $userService;

    function __construct() {
        $this->userService = new UserService();
    }

    public function getAllUsers(Request $req, Response $res) {
        $allUsers = $this->userService->findAll(10, 1);

        $res->status(200);
        $res->toXML(array(
            'users' => $allUsers
        ));
    }
}