<?php

namespace App\Domain\User;

use Ecotone\Modelling\Attribute\EventSourcingAggregate;

#[EventSourcingAggregate]
class User
{
    const CREATE_USER = "user.create";
}