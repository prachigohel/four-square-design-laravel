<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MadlogicmediaEnquiry extends Model
{
    use HasFactory;

    protected $table = 'madlogicmedia_enquiry';

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'service_required',
        'message',
    ];
}
