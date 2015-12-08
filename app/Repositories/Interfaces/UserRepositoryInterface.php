<?php

namespace App\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryInterface;

interface UserRepositoryInterface extends BasicRepositoryInterface
{
	public function getByHighestReputation();
}