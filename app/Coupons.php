<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kodeine\Acl\Traits\HasRole;

class Coupons extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    use HasRole;
    protected $table = 'coupons';

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
    protected $fillable = ['coupon_code','amount', 'amount_type', 'expiry_date', 'status'];
}
