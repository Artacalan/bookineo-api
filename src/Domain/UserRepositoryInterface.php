<?php
namespace App\Domain;
interface UserRepositoryInterface
{
    public function get();
    public function login_user($email, $password);
    public function create_user($first_name, $last_name, $email, \DateTime $birthday, $password);
    public function verify_user($first_name, $last_name, $email, \DateTime $birthday);
}
