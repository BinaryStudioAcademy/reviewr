<?php

namespace App\Repositories;

use App\Notification;
use App\Repositories\Contracts\NotificationRepositoryInterface;
use Prettus\Repository\Criteria\RequestCriteria;

class NotificationRepository extends PrettusRepository implements NotificationRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Notification::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}