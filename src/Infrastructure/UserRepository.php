<?php

namespace App\Infrastructure;

use App\Domain\Entity\User;
use App\Domain\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
    public function get ()
    {
        $sql = "SELECT * FROM users";

        $connection = $this->getEntityManager()->getConnection();
        $statement = $connection->prepare($sql);
//        $statement->bindValue('seriId', $seriId);


        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();
    }

    public function login_user ($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $connection = $this->getEntityManager()->getConnection();
        $statement = $connection->prepare($sql);
        $statement->bindValue('email', $email);
        $result = $statement->executeQuery();
        $user = $result->fetchAssociative();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return null;
    }

   public function create_user($first_name, $last_name, $email, $birthday, $password)
   {
       $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

       $sql = "INSERT INTO users (first_name, last_name, email, birthday, password)
               VALUES (:first_name, :last_name, :email, :birthday, :password)";

       $connection = $this->getEntityManager()->getConnection();
       $statement = $connection->prepare($sql);
       $statement->bindValue('first_name', $first_name);
       $statement->bindValue('last_name', $last_name);
       $statement->bindValue('email', $email);
       $statement->bindValue('birthday', $birthday->format('Y-m-d'));
       $statement->bindValue('password', $hashedPassword);

       try {
           $statement->executeStatement();
           return "created";
       } catch (\Exception $e) {
           return "error: " . $e->getMessage();
       }
   }

   public function verify_user($first_name, $last_name, $email, $birthday)
   {
       $sql = "SELECT * FROM users WHERE first_name = :first_name AND last_name = :last_name AND email = :email AND birthday = :birthday";

       $connection = $this->getEntityManager()->getConnection();
       $statement = $connection->prepare($sql);
       $statement->bindValue('first_name', $first_name);
       $statement->bindValue('last_name', $last_name);
       $statement->bindValue('email', $email);
       $statement->bindValue('birthday', $birthday->format('Y-m-d'));

       try {
           $result = $statement->executeQuery();
           $user = $result->fetchAssociative();

           return $user;
       } catch (\Exception $e) {
           return "error: " . $e->getMessage();
       }
   }

    public function change_password($email, $new_password)
    {
         $hashedPassword = password_hash($new_password, PASSWORD_BCRYPT);

         $sql = "UPDATE users SET password = :password WHERE email = :email";

         $connection = $this->getEntityManager()->getConnection();
         $statement = $connection->prepare($sql);
         $statement->bindValue('password', $hashedPassword);
         $statement->bindValue('email', $email);

         try {
              $statement->executeStatement();
              return "password changed";
         } catch (\Exception $e) {
              return "error: " . $e->getMessage();
         }
    }
}
