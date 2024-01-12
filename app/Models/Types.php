<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Types extends Model
{
    use HasFactory;
    protected $table = 'types';
    protected $fillable = ['action_type'];

    public function actions(): BelongsToMany
    {
        return $this->belongsToMany(actions::class);
    }
}
