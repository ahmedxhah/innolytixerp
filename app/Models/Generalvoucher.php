<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Generalvoucher
 * @package App\Models
 * @version April 6, 2022, 11:00 am +07
 *
 * @property integer $credit_account
 * @property integer $dabit_account
 * @property integer $amount
 * @property string $description
 * @property integer $created_by
 */
class Generalvoucher extends Model
{
    use SoftDeletes;


    public $table = 'general_voucher';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'credit_account',
        'dabit_account',
        'amount',
        'description',
        'created_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'credit_account' => 'integer',
        'dabit_account' => 'integer',
        'amount' => 'integer',
        'description' => 'string',
        'created_by' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
