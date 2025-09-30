<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
            //  Define the "create-user" Gate
            Gate::define('canCreateUser', function (User $user) {
                $roles = Role::where('id', $user->role)->first();

                    if(!$roles->can_create){    
                    return false;
                    }

                return true; 
            });

        

            // its cheack the use can be read the table or not 
            Gate::define('canReadTable',function(User $user){

                  $roles = Role::where('id', $user->role)->first();

                    if(!$roles->can_read){
                    return false;
                    }

                return true; 

            });

            
            // its can be cheack the user can be update the user or not 
            Gate::define('canUpdateUser',function(User $user){

                  $roles = Role::where('id', $user->role)->first();

                    if(!$roles->can_update){
                    return false;
                    }

                return true; 

            });
            

             // its can be cheack the user can be delete the user or not 
            Gate::define('canDeleteUser',function(User $user){

                  $roles = Role::where('id', $user->role)->first();

                    if(!$roles->can_delete){
                    return false;
                    }

                return true; 

            });


            // its can be cheack the they show the roles navbar or not 
                        Gate::define('canShowRoleOptions',function(User $user){

                  $roles = Role::where('id', $user->role)->first();

                    if(!$roles->canShowRoleOptions){
                    return false;
                    }

                return true; 

            });


                        // its allow the permision of the role is allow to role asigne or not 
                        Gate::define('allowRoleAssigne',function(User $user){

                  $roles = Role::where('id', $user->role)->first();

                    if(!$roles->allowRoleAssigne){
                    return false;
                    }

                return true; 

            });
    }
}
