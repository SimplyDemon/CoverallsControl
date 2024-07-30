<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CoverallType extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    use HasFactory;

    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class)->withPivot('quantity');
    }

    public function contracts(): BelongsToMany
    {
        return $this->belongsToMany(Contract::class)->withPivot('quantity');
    }

    public function getTypeReadableAttribute(): string
    {
        return match ($this->type) {
            'gloves' => 'перчатки',
            'boots' => 'ботинки',
            'helmet' => 'головной убор',
            'robe' => 'верхняя одежа',
            'other' => 'другое'
        };
    }

    public function getEmployerBaseSizeNameAttribute(): string
    {
        return match ($this->type) {
            'gloves' => 'size_gloves',
            'boots' => 'size_foot',
            'helmet' => 'size_head',
            'robe' => 'size_body',
            'face' => 'size_face',
            default => null,
        };
    }

}
