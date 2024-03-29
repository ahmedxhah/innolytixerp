<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Paymentvoucher
 * @package App\Models
 * @version April 6, 2022, 3:54 am +07
 *
 * @property integer $bank_account
 * @property integer $dabit_account
 * @property integer $description
 * @property integer $amount
 * @property integer $created_by
 */
class Paymentvoucher extends Model
{
    use SoftDeletes;


    public $table = 'payment_vouchers';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'bank_account',
        'dabit_account',
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
        'dabit_account' => 'integer',
        'description' => 'integer',
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
