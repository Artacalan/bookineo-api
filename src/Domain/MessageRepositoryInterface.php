<?php
namespace App\Domain;

Interface MessageRepositoryInterface
{
    public function get($receiver_id);

    public function get_conversation($receiver_id, $sender_id);

    public function send($sender_id, $receiver_id, $content);

    public function seen($message_id);

}
