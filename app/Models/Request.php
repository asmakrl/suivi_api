<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Request extends Model
{
    use HasFactory;
    protected $table = 'requests';
    protected $fillable = ['title','description','received_at'];

    public function senders(): BelongsTo
    {
        return $this->belongsTo(Sender::class);
    }

    public function files(): BelongsToMany
    {
        return $this->belongsToMany(Files::class);
    }




}
