<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $conditions = $request->only('name');
        $users = $this->userService->getUser($conditions);

        return view('user.index', compact('users', 'conditions'));
    }
}
