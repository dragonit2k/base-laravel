<?php

namespace App\Services;

use App\Helpers\QueryHelper;
use App\Repositories\User\UserRepoInterface;

class UserService
{
    /**
     * @var UserRepoInterface
     */
    protected $userRepo;

    /**
     * @param UserRepoInterface $userRepo
     */
    public function __construct(
        UserRepoInterface $userRepo
    ) {
        $this->userRepo = $userRepo;
    }

    /**
     * Get list user by conditions
     *
     * @param $conditions
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getUser($conditions)
    {
        $conditionHandle = [];
        if (isset($conditions['name'])) {
            $conditionHandle['name'] = QueryHelper::setQueryInput('%' . $conditions['name'] . '%', OPERATOR_LIKE);
        }

        return $this->userRepo->getList(
            [
                'id',
                'name',
                'email',
                'phone',
                'address'
            ],
            $conditionHandle,
            [
                KEY_SORT => QueryHelper::setQueryOrder(FIELD_ID),
            ]
        )->get();
    }
}
