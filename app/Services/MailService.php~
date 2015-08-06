<?php

namespace App\Services;

use App\Services\Interfaces\MailServiceInterface;
use App\Services\Interfaces\RequestServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\RequestRepositoryInterface;
use App\Events\OfferWasSent;
use App\ReviewRequest; 

class MailService implements MailServiceInterface
{
    private $userRepository;
    private $requestRepository;
    
    public function __construct(UserRepositoryInterface $userRepository,
        RequestRepositoryInterface $requestRepository
    ) {
        $this->userRepository = $userRepository;
        $this->requestRepository = $requestRepository;
      }

    public function sendNotificationForOffer($request, $offer) {
        Event::fire(new OfferWasSent($request, $offer));
    }
}
