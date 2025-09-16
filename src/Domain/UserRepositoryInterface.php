<?php
namespace App\Domain;
interface UserRepositoryInterface
{
    public function get();
    public function login_user($email, $password);
}
