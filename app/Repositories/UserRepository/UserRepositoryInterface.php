<?php
namespace App\Repositories\UserRepository;

interface UserRepositoryInterface {
    public function getAllUsers();
    public function createNewUserNode($data);
    public function findUserNode($id);
    public function updateUserNode($data);
    public function deleteUserNode($id);
    public function createUserEdges($data);
    public function deleteUserEdges($data);
}
