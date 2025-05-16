<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_no';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'order_no',
        'customer_name',
        'installation_date',
        'exchange',
        'work_activity',
        'id_slot_order',
        'team_leader',
        'team_member_1',
        'team_member_2',
        'team_member_3',
        'order_status',
    ];
}
