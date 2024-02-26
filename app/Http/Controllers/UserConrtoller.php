<?php

namespace App\Http\Controllers;

use App\Contracts\IUserRepository;
use App\DTO\UserDTO;
use App\Exceptions\BusinessException;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Jobs\UserTestJob;
use App\Models\Organization;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Http\Services\CreateUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;


class UserConrtoller extends Controller
{
    private IUserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }
    public function index(): JsonResponse
    {
        $users = Cache::remember('users', 180, function (){
            return User::query()->get();
        });

        return response()->json(
            ['data' =>$users]
        );
    }

    /**
     * Store a newly created resource in storage.
     * @param UserRequest $request
     * @param CreateUserService $service
     * @return UserResource
     * @throws BusinessException
     */
    public function store(UserRequest $request, CreateUserService $service): UserResource
    {
        $validated = $request->validated();
        $user = $service->execute(UserDTO::fromArray($validated));
        UserTestJob::dispatch($user); //тест job
        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return UserResource|JsonResponse
     */
    public function show(int $id): UserResource|JsonResponse
    {
        $user = $this->userRepository->getUserById($id);
        if ($user === null) {
            return response()->json([
                'message' => 'Пользователь не найден'
            ], 400);
        }
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param User $user
     * @return UserResource
     */
    public function update(Request $request, User $user): UserResource
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'surname' => 'required|string|max:50',
            'email' => 'required|email',
            'birthday' => 'required|integer',
            'congratulated' => 'required|boolean'
        ]);

        $user->update($validated);

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json([
            'message' => 'Запись была успешна удалена.'
        ]);
    }

    /**
     * @param int $organization_id
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function getOrganizationUsers(
        int $organization_id
    ): JsonResponse|AnonymousResourceCollection
    {
        /** @var Organization|null $organization */
        $organization = Organization::query()->find($organization_id);

        if ($organization === null) {
            return response()->json([
                'message' => 'Организация не найдена'
            ], 400);
        }

        $users = $organization->users;

        return UserResource::collection($users);
    }

    /**
     * @param int $organization_id
     * @param int $user_id
     * @return UserResource|JsonResponse
     */
    public function getOrganizationUserById(
        int $organization_id,
        int $user_id,
    ): UserResource|JsonResponse
    {
        /** @var Organization|null $organization */
        $organization = Organization::query()->find($organization_id);

        if ($organization === null) {
            return response()->json([
                'message' => 'Организация не найдена'
            ], 400);
        }

        $user = $organization->users()->find($user_id);

        if ($user === null) {
            return response()->json([
                'message' => 'Пользователь не найден'
            ], 400);
        }

        return new UserResource($user);
    }


}
