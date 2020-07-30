<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kodeine\Acl\Traits\HasRole;

class product extends Model
{
   /**
     * The database table used by the model.
     *
     * @var string
     */
    use HasRole;
    protected $table = 'product';

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
    protected $fillable = ['category_id','name', 'code', 'colour', 'description', 'price', 'image', 'status'];

   
    public function attributes()
    {
      return $this->hasMany('App\productattributeassoc','product_id');
    }

    public function productimage()
    {
      return $this->hasMany('App\product_image','product_id');
    }

    
    

}
