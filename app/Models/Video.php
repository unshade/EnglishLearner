<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'name',
        'path',
    ];

    public function completePath(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->path}{$this->name}"
        )->shouldCache();
    }

    public function url(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::disk('public')->url($this->complete_path)
        )->shouldCache();
    }
}
