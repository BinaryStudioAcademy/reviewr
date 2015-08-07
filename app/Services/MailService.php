<?php

namespace App\Services;

use App\Services\Interfaces\MailServiceInterface;
use App\Services\Interfaces\RequestServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\RequestRepositoryInterface;
use App\Events\OfferWasSent;
use App\Events\UserWasAccept;
use App\Events\UserWasDecline;
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

    public function sendNotification($req_id, $user_id, $action) {
        $user = $this->userRepository->OneById($user_id);
        $request = $this->requestRepository->OneById($req_id);
        switch ($action) {
            case 'accept':
                \Event::fire(new UserWasAccept($request, $user));
                break;

            case 'decline':
                \Event::fire(new UserWasDecline($request, $user));
                break;

            case 'sent_offer':
                \Event::fire(new OfferWasSent($request, $user));
                break;
        }
       
    }
}
