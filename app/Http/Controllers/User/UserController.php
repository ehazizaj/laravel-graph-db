<?php

namespace App\Http\Controllers\User;


use App\Repositories\UserRepository\UserRepositoryInterface;
use App\Requests\Users\DeleteUserRequest;
use App\Requests\Users\ShowUserRequest;
use App\Requests\Users\StoreNewUserRequest;
use App\Requests\Users\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * @var $repository
     */
    private $repository;

    /**
     * UserRepositoryInterface constructor.
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of all users
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        /*
         * In case pagination metas are not required
         * return successDataWithoutPaginationMeta($this->repository->getAllUsers(), 'List of users');
        */
        return successData($this->repository->getAllUsers(), 'List of users');


    }


    /**
     * Store a newly created node.
     *
     * @param StoreNewUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreNewUserRequest $request)
    {
        $data = $request->all();
        return successData($this->repository->createNewUserNode($data), 'User Node created successfully');
    }


    /**
     * Show User
     *
     * @param ShowUserRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ShowUserRequest $request, $id)
    {

        return successData($this->repository->findUserNode($id), 'User details');
    }

    /**
     * Update User Node Request.
     *
     * @param UpdateUserRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request, $id)
    {

        $data = $request->all();
        $data['id'] = $id;
        return successData($this->repository->updateUserNode($data), 'User updated with success');
    }


    /**
     * Delete User Node
     *
     * @param DeleteUserRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(DeleteUserRequest $request, $id)
    {
        $this->repository->deleteUserNode($id);
        return success("Deleted");
    }


    /**
     * Create User Edges
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function follow(Request $request)
    {

        $requestData = $request->all();
        $this->repository->createUserEdges($requestData);
        return success("User Followed");
    }


    /**
     * UnFollow One Node To Another
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function unfollow(Request $request)
    {
        $requestData = $request->all();
        $this->repository->deleteUserEdges($requestData);
        return success("User Unfollowed");
    }


}
