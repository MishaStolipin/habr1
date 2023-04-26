<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class BlogCategory extends Model
{
    use SoftDeletes;

    protected $table  = 'blog_categories';

    protected $fillable = [
        'title',
        'slug',
        'parent_id',
        'description',
    ];


    public function children():HasMany{
        return $this->hasMany(self::class,'parent_id');
    }

    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function parent():BelongsTo{
        return $this->belongsTo(self::class,'parent_id');
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }


}
