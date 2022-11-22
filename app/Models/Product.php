<?php

namespace App\Models;

use App\Events\ProductCreated;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];

    protected $appends = array('splitDescription');

    protected $dispatchesEvents = [
        'created' => ProductCreated::class,
    ];

    /**
     * Get the product's multiline description split by newlines
     *
     * @return array   description split by newlines
     */
    public function getSplitDescriptionAttribute()
    {
        return explode("\r\n", $this->description);
    }

    /**
     * Set the product's description.
     * Replace description with only empty newlines by NULL
     *
     * @param  string  $value
     * @return void
     */
    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = empty($value) ? NULL : $value;
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
