<?php

namespace App\Services\Auth;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\RoleLocalRepository;
use App\Services\RemoteDataGrabber\Contracts\DataGrabberInterface;
use App\Services\Auth\Contracts\UserUpdater;
use App\Services\Auth\Exceptions\UpdatingFailureException;
use App\User;
use App\Services\RemoteDataGrabber\Exceptions\RemoteDataGrabberException;
use App\Repositories\Contracts\RoleGlobalRepository;

/**
 * Class ProfileAPIUserUpdater
 * @package App\Services\Auth
 */
class ProfileAPIUserUpdater extends UserUpdater
{
    protected $roleLocalRepository;
    protected $roleGlobalRepository;
    protected $userRepository;
    protected $dataGrabber;

    public function __construct(
        UserRepositoryInterface $userRepository,
        DataGrabberInterface $dataGrabber
    ) {
        $this->userRepository = $userRepository;
        $this->dataGrabber = $dataGrabber;
    }

    /**
     * Updates a base user info from payload information
     *
     * @param $payload
     * @return User $user
     */
    public function updateBaseInfo($payload)
    {
        $userInfo = $payload->toArray();
        $preparedInfo = $this->prepareBaseInfo($userInfo);

        $user = $this->userRepository->updateFirstOrCreate(
            ['binary_id' => $preparedInfo['binary_id']],
            $preparedInfo
        );

        // 'global_role_id' property is not allowed to the mass assignment for
        // some security reasons
        $entitledUser = $this->userRepository->setProtectedProperty(
            $user,
            'global_role_id',
            $preparedInfo['global_role_id']
        );

        // Setting a default local role if it's absent
        if (!$entitledUser->local_role_id) {
            $role = $this->roleLocalRepository->firstWhere(['title' => 'USER']);
            $entitledUser = $this->userRepository->setProtectedProperty(
                $entitledUser,
                'local_role_id',
                $role->id
            );
        }

        return $entitledUser;
    }

    /**
     * Updates user info according to the new information from api
     *
     * @param $cookie
     * @param $user
     * @return User $user
     */
    public function updateAdditionalInfo($cookie, $user)
    {
        $url = url(env('AUTH_ME') . '/' . $user->binary_id);
        $curlOptions = [CURLOPT_COOKIE => 'x-access-token=' . $cookie];

        try {
            $remoteInfo = $this->dataGrabber->getFromJson(
                $url,
                $curlOptions
            );
        } catch (RemoteDataGrabberException $e) {
            $message = 'Cannot receive an additional user information. '
                     . $e->getMessage();
            throw new UpdatingFailureException($message, null, $e);
        }

        if (empty($remoteInfo)) {
            $message = 'An additional user information is empty.';
            throw new UpdatingFailureException($message);
        }

        $remoteInfoArray = (array)$remoteInfo[0];
        $preparedUserInfo = $this->prepareAdditionalInfo($remoteInfoArray);
        $user = $this->userRepository->update($preparedUserInfo, $user->id);

        return $user;
    }

    protected function prepareBaseInfo(array $arr)
    {
        $this->renameArrayKeys($arr, [
            'id'      => 'binary_id',
            'name'    => 'first_name',
            'surname' => 'last_name',
        ]);

        return $arr;
    }

    /**
     * Renames the keys pfom payload to accessible in our application
     * Attaches a role_id according to the role attribute in the array
     *
     * @param array $arr
     * @return array
     */
    protected function prepareAdditionalInfo(array $arr)
    {
        $this->renameArrayKeys($arr, [
            'name'    => 'first_name',
            'surname' => 'last_name',
        ]);

        $this->attachAvatarInfo($arr);
        return $arr;
    }

    protected function attachAvatarInfo(array &$arr)
    {
        if (array_key_exists('avatar', $arr)) {
            $avatarLinks = (array) $arr['avatar'];
            unset($arr['avatar']);

            $this->renameArrayKeys($avatarLinks, [
                'urlAva'       => 'avatar',
                'thumbnailUrlAva' => 'thumb_avatar',
            ]);

            $arr = array_merge($arr, $avatarLinks);
        }
    }
}