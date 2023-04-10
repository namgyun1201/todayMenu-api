<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipie extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'introduction', 'type', 'type_code', 'time', 'calorie', 'capacity', 'difficulty', 'classification', 'price', 'image_link'
    ];

    protected $dates = ['deleted_at'];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->name = isset($attributes['name']) ? $attributes['name'] : null;
        $this->introduction = isset($attributes['introduction']) ? $attributes['introduction'] : null;
        $this->type_code = isset($attributes['type_code']) ? $attributes['type_code'] : null;
        $this->type = isset($attributes['type']) ? $attributes['type'] : null;
        $this->time = isset($attributes['time']) ? $attributes['time'] : null;
        $this->calorie = isset($attributes['calorie']) ? $attributes['calorie'] : null;
        $this->capacity = isset($attributes['capacity']) ? $attributes['capacity'] : null;
        $this->difficulty = isset($attributes['difficulty']) ? $attributes['difficulty'] : null;
        $this->price = isset($attributes['price']) ? $attributes['price'] : null;
        $this->image_link = isset($attributes['image_link']) ? $attributes['image_link'] : null;
    }
}
