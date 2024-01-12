<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Requests extends Model
{
    use HasFactory;
    protected $table = 'requests';
    protected $fillable = ['title','content','received_at'];

    public function senders(): BelongsTo
    {
        return $this->belongsTo(senders::class);
    }

    public function files(): BelongsToMany
    {
        return $this->belongsToMany(files::class);
    }




}
