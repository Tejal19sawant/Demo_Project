<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kodeine\Acl\Traits\HasRole;

class DeliveryAddress extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    use HasRole;
    protected $table = 'delivery_address';

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
    protected $fillable = ['user_id','user_email', 'name', 'address', 'city', 'state', 'country', 'pincode', 'mobile'];

   
    

}
