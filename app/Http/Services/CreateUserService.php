<?php

namespace App\Http\Services;

use App\Contracts\IUserRepository;
use App\DTO\UserDTO;
use App\Exceptions\BusinessException;
use App\Models\User;

class CreateUserService
{
    public function __construct(private readonly IUserRepository $userRepository)
    {

    }

    public function execute(UserDTO $userDTO): User
    {
        $userWithEmail = $this->userRepository->getUserByEmail($userDTO->getEmail());
        if ($userWithEmail !== null) {
            throw new BusinessException(__('messages.email_already_exists') ,400);
        }

        return $this->userRepository->createUser($userDTO);
    }
}
