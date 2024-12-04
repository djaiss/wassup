<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
class Checkin extends Model
{
    use HasFactory;

    protected $table = 'checkins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cycle_id',
        'member_id',
        'content',
    ];

    /**
     * The cycle the goal belongs to.
     */
    public function cycle(): BelongsTo
    {
        return $this->belongsTo(Cycle::class);
    }

    /**
     * Get the member record associated with the goal.
     */
    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function getMarkdownDescription(): string
    {
        return Str::markdown($this->content);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
