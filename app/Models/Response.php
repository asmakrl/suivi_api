<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Response extends Model
{
    use HasFactory;

    protected $table = 'responses';
    protected $fillable = ['response','response_time','action_id'];

    public function action(): BelongsTo
    {
        return $this->belongsTo(Action::class);
    }

   /** public function file(): HasMany
    {
        return $this->HasMany(File::class);
    }**/
    public function file(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
