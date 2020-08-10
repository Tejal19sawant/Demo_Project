<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kodeine\Acl\Traits\HasRole;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class user extends Authenticatable
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    use Notifiable,HasRole;

    protected $guard = 'website'; //added by me

    protected $table = 'users';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'lastname', 'email', 'address', 'state', 'city', 'country', 'pincode', 'mobile', 'email_verified_at', 'admin', 'password', 'confirmpassword', 'remember_token', 'status', 'role'];

    
}
