<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use App\Repositories\PermissionRepository;

class GeneratePermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate permissions based on registered routes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $routes = Route::getRoutes();
        foreach ($routes as $route) {
            $permissionName = $route->getName();
            if ($permissionName && app(PermissionRepository::class)->getAll(['permission' => $permissionName])->isEmpty() && !$this->isExcluded($permissionName)) {
                $permission = app(PermissionRepository::class)->create([
                    'permission' => $permissionName,
                ]);
                $this->info("Permission {$permission->permission} created");
            }
        }

        $this->assignPermissions();
        $this->info('Permissions generated successfully');
    }

    /**
     * List of routes to be excluded from permission generation
     *
     * @var array
     */
    public function isExcluded($permission)
    {
        $excludedPermissions = [
            'home',
            'showRegisterForm',
            'register',
            'showLoginForm',
            'login',
            'logout',
            'password.request',
            'password.email',
            'password.reset',
            'password.update',
            'verification.notice',
            'verification.verify',
            'verification.resend',
        ];

        $excludedPatterns = [
            'debugbar',
            'sanctum',
            'generated::',
            'ignition',
        ];

        if(in_array($permission, $excludedPermissions)){
            return true;
        }

        foreach($excludedPatterns as $pattern){
            if(\str_starts_with($permission, $pattern)){
                return true;
            }
        }

        return false;
    }

    public function assignPermissions()
    {
        $permissions = app(PermissionRepository::class)->getAll();
        foreach ($permissions as $permission) {
            if(\str_starts_with($permission->permission, 'clients')){
                $permission->roles()->attach(2);
            }
            if(\str_starts_with($permission->permission, 'categories')){
                $permission->roles()->attach(1);
            }
            if(\str_starts_with($permission->permission, 'products')){
                $permission->roles()->attach(2);
            }
            if(\str_starts_with($permission->permission, 'permissions')){
                $permission->roles()->attach(1);
            }
        }
    }
}
