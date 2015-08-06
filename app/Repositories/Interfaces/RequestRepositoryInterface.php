<?php

namespace App\Repositories\Interfaces;

interface RequestRepositoryInterface extends BasicRepositoryInterface
{
	public function getOffersById($id);
}