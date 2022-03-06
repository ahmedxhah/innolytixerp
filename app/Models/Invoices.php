<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class Invoices
 * @package App\Models
 * @version March 7, 2022, 4:05 am +07
 *
 * @property string $date
 * @property string $subject
 * @property integer $client_id
 * @property integer $officedetails_id
 * @property integer $sub_total
 * @property integer $discount
 * @property integer $tax
 * @property integer $grand_total
 * @property integer $bank_id
 * @property integer $created_by
 */
class Invoices extends Model
{
    use SoftDeletes;


    public $table = 'invoices';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'date',
        'subject',
        'client_id',
        'officedetails_id',
        'sub_total',
        'discount',
        'tax',
        'grand_total',
        'bank_id',
        'created_by'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date' => 'date',
        'subject' => 'string',
        'client_id' => 'integer',
        'officedetails_id' => 'integer',
        'sub_total' => 'integer',
        'discount' => 'integer',
        'tax' => 'integer',
        'grand_total' => 'integer',
        'bank_id' => 'integer',
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
