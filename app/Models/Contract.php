<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Contract extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    use HasFactory;


    public function coverallTypes(): BelongsToMany
    {
        return $this->belongsToMany(CoverallType::class)
            ->withPivot('size')
            ->withPivot('quantity_received')
            ->withPivot('quantity_planned');
    }
}
