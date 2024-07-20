<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoverallType extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    use HasFactory;

    public function getTypeReadableAttribute()
    {
        return match ($this->type) {
            'gloves' => 'перчатки',
            'boots' => 'ботинки',
            'helmet' => 'головной убор',
            'robe' => 'верхняя одежа',
            'other' => 'другое'
        };

    }

}
