<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Action extends Model
{
    use HasFactory;
    protected $table = 'actions';
    protected $fillable = ['name','action_time','type_id'];

    public function type(): BelongsTo
    {
        return $this->belongsTo(type::class);
    }

    public function request(): BelongsToMany
    {
        return $this->belongsToMany(Request::class, 'action_requests', 'action_id', 'request_id')
        ->withTimestamps();
        //return $this->belongsToMany(request::class);
    }



}
