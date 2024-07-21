<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coverall extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    use HasFactory;

    public function getStatusReadableAttribute()
    {
        return match ($this->status) {
            'in_stock' => 'в наличии',
            'issued' => 'выдан',
            'defective' => 'брак',
            'returned' => 'возвращён',
            'ready_for_disposal' => 'готов к утилизации',
            'disposed' => 'утилизирован',
        };
    }
}
