<?php

namespace App\Services\Auth\Contracts;

use App\User;

interface AuthServiceInterface
{
    public function logout();

    public function getUser();

    /**
     * @param string $cookie
     * @return mixed
     */
    public function loginByCookie($cookie);

    /**
     * @param array $data
     * @param int $id
     * @return mixed
     */
    public function updateUser(array $data, $id);

    /**
     * @param int $pageSize
     * @return mixed
     */
    public function getAllUsers($pageSize = null);
}