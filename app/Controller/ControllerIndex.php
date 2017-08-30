<?php

namespace Dykyi\Controller;

use Dykyi\AbstractController;
use Dykyi\Common\PusherClass;
use Dykyi\Common\PushFactory;
use Dykyi\Model\FriendsModel;
use Dykyi\Model\RequestModel;
use Dykyi\Model\UsersModel;

/**
 * Class ControllerLogin
 * @package Dykyi
 *
 * @property UsersModel $userModel
 * @property FriendsModel $friendModel
 * @property RequestModel $requestModel
 */
class ControllerIndex extends AbstractController
{
    protected $userModel;
    protected $friendModel;
    protected $requestModel;

    protected $user        = [];

    public function __construct()
    {
        parent::__construct();
        $this->userModel    = new UsersModel();
        $this->requestModel = new RequestModel();
        $this->friendModel  = new FriendsModel();
    }

    public function index()
    {
        if ($this->session->get('id')) {
            $usersList = $this->userModel->getAllWithoutMe();
        }
        else {
            $usersList = $this->userModel->getAll();
        }

        return $this->view('index', [
            'requestCount' => $this->requestModel->getUserRequestCount(),
            'user'         => $this->userModel->getUserInfo(),
            'usersList'    => $usersList,
            'friendsList'  => $this->friendModel->getUserFriends(),
        ]);
    }

    public function changeStatus()
    {
        $userStatus = $this->post->get('id');
        $status = $this->userModel->changeUserStatus($userStatus);
        return $this->json(['success'  => $status]);
    }

    public function removeFriend()
    {
        $userID = $this->post->get('id');
        $status = $this->friendModel->removeFriendByUserId($userID);
        return $this->json(['success'  => $status]);
    }

}
