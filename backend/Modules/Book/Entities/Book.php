<?php

namespace Modules\Book\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Book extends Model
{
    use HasFactory, Searchable;

    public $table = "books";

    public $primaryKey = "id";

    public $timestamps = true;

    protected $fillable = [
        "title",
        "author",
        "genre",
        "description",
        "isbn",
        "image",
        "published",
        "publisher",
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published' => 'datetime',
    ];

    protected static function newFactory()
    {
        return \Modules\Book\Database\factories\BookFactory::new();
    }

    public function published(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? Carbon::parse($value)->format('Y-m-d') : null,
        );
    }

    public function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? url("storage/" . $value) : null,
        );
    }

    public function description(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? substr($value, 0, 100) . '...' : null,
        );
    }


    public function toSearchableArray()
    {
        return [
            "title" => $this->title,
            "author" => $this->author,
            "genre" => $this->genre,
            "isbn" => $this->isbn,
            "published" => $this->published,
        ];
    }
}
