<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Contact;

class ContactPolicy
{
    public function __construct()
    {
        info('in policy constructor');
    }

    public function index(User $user){
        info('in ContactPolicy::index');
        if($user->isAdmin('contacts')){
            info('returning true');
            return true;
        }
        return false;
    }

    public function update(User $user, Contact $contact){
        info('in ContactPolicy::edit ' . $contact->madeBy_id . "=" . $user->id);
        if($user->isAdmin('contacts') || $contact->madeBy_id == $user->id){
            return true;
        }
        return false;
    }
}
