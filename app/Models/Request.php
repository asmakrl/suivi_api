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

    public function sender(): BelongsTo
    {
        return $this->belongsTo(Sender::class);
    }

    public function file(): BelongsToMany
    {
        return $this->belongsToMany(File::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }




}
