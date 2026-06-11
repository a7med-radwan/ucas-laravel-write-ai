<?php

namespace App\Models;

use App\Enums\PostStatus;
use App\Models\Scopes\OwnerScope;
use App\Observers\PostObserver;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

#[ScopedBy(OwnerScope::class)]
#[ObservedBy(PostObserver::class)]
class Post extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'posts';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'category_id',
        'title',
        'content',
        'excerpt',
        'cover_image',
        'status',
        'views',
        'published_at',
        'meta',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'meta' => 'json',
            'status' => PostStatus::class,
        ];
    }

    protected static function booted()
    {
        //static::addGlobalScope('owner', new OwnerScope);

        // creating, created, updating, updated, deleting, deleted
        // restoring, restored, forceDeleting, forceDeleted
        // retrieved, saving, saved

        static::creating(function (Post $post) {});
        //static::observe(new PostObserver());
    }

    public function scopePublished(Builder $builder, string|\DateTime|null $time = null)
    {
        $builder
            //->withoutGlobalScope('owner')
            ->where('status', PostStatus::Published)
            ->where(function ($query) use ($time) {
                $query->whereNull('published_at')
                    ->orWhere('published_at', '<=', $time ?? now());
            });
    }

    public function scopeStatus(Builder $builder, string|PostStatus $status)
    {
        $builder->where('status', $status);
    }

    public function scopeSlug(Builder $builder, string $slug)
    {
        $builder->where('slug', $slug);
    }

    // protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')
            ->withDefault([
                'name' => 'Uncategorized',
                'slug' => 'uncategorized',
            ]);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    public function content(): Attribute
    {
        return new Attribute(
            set: fn($value) => strip_tags($value, '<h2><h3><h4><h5><h6><p><a><ul><ol><li><br><strong><em><img><video><audio>'),
        );
    }

    public function title(): Attribute
    {
        return new Attribute(
            get: fn($value) => ucwords($value),
            set: fn($value) => strip_tags($value),
        );
    }

    public function thumbnailUrl(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->cover_image
                    ? Storage::disk('public')->url($this->cover_image)
                    : asset('images/default-thumbnail.jpg');
            }
        );
    }

    public function publishTime(): Attribute
    {
        return new Attribute(
            get: fn() => $this->published_at ?? $this->created_at,
        );
    }

    public function readTime(): Attribute
    {
        return (new Attribute(
            get: fn() => \ceil($this->wordCount() / 200)
        ))->shouldCache();
    }

    public function wordCount(): int
    {
        return \str_word_count($this->content);
    }
}