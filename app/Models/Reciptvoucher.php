<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Reciptvoucher
 * @package App\Models
 * @version April 6, 2022, 2:36 am +07
 *
 * @property integer $bank_account
 * @property integer $credit_account
 * @property string $description
 * @property integer $amount
 * @property integer $created_by
 */
class Reciptvoucher extends Model
{
    use SoftDeletes;


    public $table = 'recipt_voucher';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'bank_account',
        'credit_account',
        'description',
        'amount',
        'created_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'bank_account' => 'integer',
        'credit_account' => 'integer',
        'description' => 'string',
        'amount' => 'integer',
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
