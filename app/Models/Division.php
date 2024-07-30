<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Division extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    use HasFactory;

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

}
