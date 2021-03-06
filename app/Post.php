<?php
declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

/**
 * Class Post
 *
 * @package App
 */
class Post extends Model
{
    use \Conner\Likeable\LikeableTrait;

    protected $appends = [
        'commentsCount'
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function (Post $post) {
            $post->comments()->delete();
        });
    }

    /**
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return int
     */
    public function getCommentsCountAttribute(): int
    {
        return $this->comments()->count();
    }

    public function getPhotoAttribute($value)
    {
        return $value ? Storage::url($value) : null;
    }
}
