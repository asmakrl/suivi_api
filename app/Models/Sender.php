<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sender extends Model
{
    use HasFactory;
    protected $table ='senders';
    protected $fillable = ['name'];

    public function request(): BelongsToMany
    {
        return $this->belongsToMany(Request::class);
    }

}
