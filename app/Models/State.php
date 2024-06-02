<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class State extends Model
{
    use HasFactory;

    protected $table = 'states';
    protected $fillable = ['code','nomAr','nomFr'];

    public function request(): BelongsToMany
    {
        return $this->belongsToMany(Request::class);
    }
    public function sender(): BelongsToMany
    {
        return $this->belongsToMany(Sender::class);
    }
}
