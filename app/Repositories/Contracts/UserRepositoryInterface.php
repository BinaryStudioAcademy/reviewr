<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface extends BasicRepositoryInterface
{
	public function getByHighestReputation();
}