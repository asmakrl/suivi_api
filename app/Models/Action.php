<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Action extends Model
{
    use HasFactory;
    protected $table = 'actions';
    protected $fillable = ['action_time'];

    public function type(): BelongsTo
    {
        return $this->belongsTo(type::class);
    }


}
