<?php

namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'books')]

final class Book //implements UserInterface, PasswordAuthenticatedUserInterface
{

}
