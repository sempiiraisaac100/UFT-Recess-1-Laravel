<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Treasury",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="amount",
 *          description="amount",
 *          type="float",
 *          format="float"
 *      ),
 *      @SWG\Property(
 *          property="well_wisher",
 *          description="well_wisher",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="received_on",
 *          description="received_on",
 *          type="string",
 *          format="date"
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
class Treasury extends Model
{
    use SoftDeletes;

    public $table = 'treasury';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'amount',
        'well_wisher',
        'received_on'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'amount' => 'float',
        'well_wisher' => 'string',
        'received_on' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'amount' => 'required',
        'well_wisher' => 'required',
        'received_on' => 'required'
    ];

    public function payment(){
        return $this->hasMany('App/Models/Payment');
    }
}
