<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kodeine\Acl\Traits\HasRole;

class productattributeassoc extends Model
{
   /**
     * The database table used by the model.
     *
     * @var string
     */
    use HasRole;
    protected $table = 'product_attributes_assoc';

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
    protected $fillable = ['product_id','sku', 'size', 'price','stock'];
}
