<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
        'client_id',
        'designer_id',
        'request_type',
        'cabinet_brand',
        'ceiling_height',
        'wall_cabinet_height',
        'expected_date',
        'additional_notes',
        'additional_info',
        'full_name',
        'email',
        'phone',
        'project_type',
        'scope',
        'door_style',
        'finish',
        'refrigerator',
        'range_cooktop',
        'ventilation',
        'dishwasher',
        'attachments',
        'is_prioritized',
    ];

    protected $casts = [
        'additional_info'  => 'array',
        'attachments'      => 'array',
        'expected_date'    => 'date',
        'is_prioritized'   => 'boolean',
    ];

    public function getRequestNumberAttribute(): string
    {
        $name  = $this->client->name ?? $this->full_name ?? 'UN';
        $words = preg_split('/\s+/', trim($name));
        $initials = strtoupper(implode('', array_map(fn($w) => substr($w, 0, 1), $words)));
        $initials = substr($initials, 0, 3);
        $year  = $this->created_at ? $this->created_at->format('Y') : date('Y');
        return $initials . '-' . $year . '-' . $this->id;
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function designer()
    {
        return $this->belongsTo(User::class, 'designer_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'asc');
    }
}
