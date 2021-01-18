<?php

namespace App\Repositories\UserRepository;

use App\Model\User;

class UserRepository implements UserRepositoryInterface
{

    /**
     * @var User
     */
    private $model;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }


    /**
     * @return mixed
     */
    public function getAllUsers()
    {
        //return $this->model->get();
        return $this->model->paginate(5);

    }

    /**
     * Create a new user node
     *
     * @param $data
     * @return mixed
     */
    public function createNewUserNode($data)
    {
        $user = new $this->model;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->age = $data['age'];
        $user->save();
        $user->uuid = $user->id;
        $user->save();
        return $user;
    }


    /**
     * Find User Node By ID
     *
     * @param $id
     * @return User
     */
    public function findUserNode($id)
    {
        return $this->model->with(['followers','following'])->find($id);
    }


    /**
     * Update User Node
     *
     * @param $data
     * @return mixed
     */
    public function updateUserNode($data)
    {
        $user = $this->model->find($data['id']);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->age = $data['age'];
        $user->save();
        return $user;
    }

    /**
     * Delete User Node
     *
     * @param $id
     * @return bool
     */
    public function deleteUserNode($id)
    {
        $user = $this->model->find($id);
        $user->delete();
        return true;
    }


    /**
     * Create edges between users
     *
     * @param $data
     * @return mixed
     */
    public function createUserEdges($data)
    {
        $request_follow = $this->model->find($data['request_follow']);
        //Create Edge Only if not exist
        if(!$request_follow->followers->find($data['user_id'])){
            $request_follow->followers()->attach($data['user_id']);
            return $request_follow;
        }
    }


    /**
     * UnFollow
     *
     * @param $data
     * @return mixed
     */
    public function deleteUserEdges($data)
    {
        return $this->model->unfollow($data['user_id'],$data['request_unfollow']);
    }

}
