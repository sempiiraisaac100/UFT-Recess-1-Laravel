<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Payment",
 *      required={""},
 *      @SWG\Property(
 *          property="Role",
 *          description="Role",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="Salary",
 *          description="Salary",
 *          type="float",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="Number",
 *          description="Number",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="Total",
 *          description="Total",
 *          type="float",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="deleted_at",
 *          description="deleted_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class Payment extends Model
{
    use SoftDeletes;

    public $table = 'payments';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'Role',
        'amount'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'Role' => 'string',
        'amount' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'Role' => 'required'
    ];

    public function agent(){
        return $this->belongsTo('App/Models/Agent');
    }

    public function treasury(){
        return $this->belongsTo('App/Models/Treasury');
    }
}
