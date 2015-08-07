<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface extends BasicRepositoryInterface
{
	public function acceptOfferOnReviewRequest($user_id, $request_id);

	public function declineOfferOnReviewRequest($user_id, $request_id);

	public function offerOnReviewRequest($user_id, $request_id);
}