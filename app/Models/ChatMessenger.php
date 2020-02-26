<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class ChatMessenger extends Model
{
    public function getUserName($user_id) {

        return User::find($user_id);
    }
}
