<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface extends BasicRepositoryInterface
{
	public function getByHighestReputation();
}