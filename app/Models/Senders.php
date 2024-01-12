<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Senders extends Model
{
    use HasFactory;
    protected $table ='senders';
    protected $fillable = ['name', 'sent_at'];

    public function requests(): BelongsToMany
    {
        return $this->belongsToMany(requests::class);
    }

}
