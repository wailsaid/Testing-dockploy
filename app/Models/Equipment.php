<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    /** @use HasFactory<\Database\Factories\EquipmentFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'model',
        'serial_number',
        'category',
        'status',
        'purchase_date',
        'last_maintenance_date',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'purchase_date' => 'datetime',
            'last_maintenance_date' => 'datetime',
        ];
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
