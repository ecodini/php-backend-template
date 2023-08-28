<?php namespace Holamanola45\Www\Entity\User;

use Holamanola45\Www\Lib\Auth\PasswordCrypt;
use Holamanola45\Www\Lib\Auth\SessionManager;
use Holamanola45\Www\Lib\Error\BadRequestException;
use Holamanola45\Www\Lib\Error\UnauthorizedException;
use Holamanola45\Www\Lib\Http\Request;
use Holamanola45\Www\Lib\Http\Response;

class UserController {

    private UserService $userService;

    function __construct() {
        $this->userService = new UserService();
    }

    public function getAllUsers(Request $req, Response $res) {
        $allUsers = $this->userService->findAll(array(
            'attributes' => array('id', 'username', 'created_at'),
            'limit' => 10,
            'offset' => 0
        ));

        return array(
            'users' => $allUsers
        );
    }

    public function getUser(Request $req, Response $res) {
        // @TODO: ver attributes
        $user = $this->userService->findByUsername($req->params[0]);

        return array(
            'user' => $user
        );
    }

    public function getById(Request $req, Response $res) {
        $user = $this->userService->findById($req->params[0], array(
            'attributes' => array('id', 'username', 'created_at'),
        ));

        return array(
            'user' => $user
        );
    }

    public function login(Request $req, Response $res) {
        $body = $req->getXML();

        $username = $body->username;
        $password = $body->password;

        if (!count($username) || !count($password)) {
            throw new BadRequestException('Username and password are required.');
        }

        $user = $this->userService->findByUsername($username);

        $passwordValid = PasswordCrypt::verify($password, $user['password']);

        if (!$passwordValid) {
            throw new UnauthorizedException('The username or password provided are incorrect.');
        }

        SessionManager::setUser($user['id'], $user['username']);

        return array(
            'sessionId' => SessionManager::getSessionId()
        );
    }

    public function logout(Request $req, Response $res) {
        SessionManager::destroy();

        return;
    }
}