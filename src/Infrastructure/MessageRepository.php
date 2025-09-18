<?php

namespace App\Infrastructure;

use App\Domain\Entity\Message;
use App\Domain\MessageRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class MessageRepository extends ServiceEntityRepository implements MessageRepositoryInterface
{
    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Message::class);
    }

    public function get($receiver_id) {
        // recuperer les messages du receveur, a'abord les non lu puis ensuite le reste le plus recent, et faire une jointure avec les users pour recuperer uniquement le nom et le prenom du sender
        $sql = "SELECT m.*, u.first_name AS sender_first_name, u.last_name AS sender_last_name
                FROM messages m
                JOIN users u ON m.sender_id = u.id
                WHERE m.receiver_id = :receiver_id
                ORDER BY m.seen ASC, m.send_at DESC";
        $connection = $this->getEntityManager()->getConnection();
        $statement = $connection->prepare($sql);
        $statement->bindValue('receiver_id', $receiver_id);
        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();
    }

    public function get_conversation($receiver_id, $sender_id) {
        $sql = "SELECT * FROM messages WHERE ((receiver_id = :receiver_id AND sender_id = :sender_id) OR (receiver_id = :sender_id AND sender_id = :receiver_id)) ORDER BY send_at DESC";
        $connection = $this->getEntityManager()->getConnection();
        $statement = $connection->prepare($sql);
        $statement->bindValue('receiver_id', $receiver_id);
        $statement->bindValue('sender_id', $sender_id);
        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();
    }

    public function send($sender_id, $receiver_id, $content) {
        $sql = "INSERT INTO messages (sender_id, receiver_id, message)
                VALUES (:sender_id, :receiver_id, :content)";
        $connection = $this->getEntityManager()->getConnection();
        $statement = $connection->prepare($sql);
        $statement->bindValue('sender_id', $sender_id);
        $statement->bindValue('receiver_id', $receiver_id);
        $statement->bindValue('content', $content);
        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();
    }

    public function seen($message_id) {
        $sql = "UPDATE messages SET seen = :seen WHERE id = :message_id";
        $connection = $this->getEntityManager()->getConnection();
        $statement = $connection->prepare($sql);
        $statement->bindValue('seen', true);
        $statement->bindValue('message_id', $message_id);
        $result = $statement->executeQuery();
        return $result->fetchAllAssociative();
    }
}
