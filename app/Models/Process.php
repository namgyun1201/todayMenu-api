<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Process extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['recipie_id', 'position', 'description', 'image_link', 'tip'];

    protected $dates = ['deleted_at'];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->recipie_id = isset($attributes['recipie_id']) ? $attributes['recipie_id'] : null;
        $this->position = isset($attributes['position']) ? $attributes['position'] : null;
        $this->description = isset($attributes['description']) ? $attributes['description'] : null;
        $this->image_link = isset($attributes['image_link']) ? $attributes['image_link'] : null;
        $this->tip = isset($attributes['tip']) ? $attributes['tip'] : null;
    }
}
