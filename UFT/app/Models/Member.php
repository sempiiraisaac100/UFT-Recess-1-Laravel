<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Member",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="district",
 *          description="district",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="recommender",
 *          description="recommender",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="DateOfEnroll",
 *          description="DateOfEnroll",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="gender",
 *          description="gender",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="agent",
 *          description="agent",
 *          type="string"
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
class Member extends Model
{
    use SoftDeletes;

    public $table = 'members';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'id',
        'name',
        'district',
        'recommender',
        'DateOfEnroll',
        'gender',
        'agent'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'district' => 'string',
        'recommender' => 'string',
        'DateOfEnroll' => 'date',
        'gender' => 'string',
        'agent' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'district' => 'required',
        'DateOfEnroll' => 'required',
        'gender' => 'required',
        'agent' => 'required'
    ];

    public function agent(){
        $this->belongsTo('App/Models/Agent');
    }

    public function district(){
        $this->belongsTo('App/Models/District');
    }


}
