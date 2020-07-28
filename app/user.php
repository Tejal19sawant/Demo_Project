<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kodeine\Acl\Traits\HasRole;

class user extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    use Notifiable,HasRole;
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
    protected $fillable = ['name', 'lastname', 'email', 'password', 'confirmpassword', 'status', 'role'];

    
}
