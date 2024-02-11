<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends Repository
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }
}