<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sender extends Model
{
    use HasFactory;
    protected $table ='senders';
    protected $fillable = ['name', 'category_id'];

    public function request(): BelongsToMany
    {
        return $this->belongsToMany(Request::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

}
