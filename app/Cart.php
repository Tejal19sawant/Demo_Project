<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
   /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cart';

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
    protected $fillable = ['product_id','product_name', 'product_code', 'product_colour','size','price','quantity','user_email','session_id'];


    
}
