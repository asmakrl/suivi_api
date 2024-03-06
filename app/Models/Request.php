<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Request extends Model
{
    use HasFactory;
    protected $table = 'requests';
    protected $fillable = ['title','description','received_at','status','sender_id','state_id'];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(Sender::class);
    }

    public function file(): HasMany
    {
        return $this->HasMany(File::class);
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function action(): HasMany
    {
        return $this->hasMany(Action::class);
        //return $this->belongsToMany(Action::class);
    }




}
