<?php

namespace App\Repositories;

use App\Models\User;

class ClientRepository extends Repository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getAllClients()
    {
        return $this->getAll(['role_id' => 3]);
    }

    public function create(array $attributes)
    {
        $attributes['role_id'] = 3;
        return parent::create($attributes);
    }

    public function uploadAvatar($request, $attributes)
    {
        if ($request->hasFile('avatar')) {
            $attributes['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }
        return $attributes;
    }
}
