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
    protected $fillable = ['name','action_time','request_id','type_id'];


    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);

        //return $this->belongsToMany(request::class);
    }
    public function type(): BelongsTo
    {
        return $this->belongsTo(type::class);
    }




}
