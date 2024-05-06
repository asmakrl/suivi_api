<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sender extends Model
{
    use HasFactory;
    protected $table ='senders';
    protected $fillable = ['name','category_id'];

    public function request(): BelongsToMany
    {
        return $this->belongsToMany(Request::class);
    }
    public function action(): HasMany
    {
        return $this->hasMany(Action::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

}
