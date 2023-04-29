<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['recipie_id', 'name', 'capacity', 'type_code', 'type'];

    protected $dates = ['deleted_at'];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->recipie_id = isset($attributes['recipie_id']) ? $attributes['recipie_id'] : null;
        $this->name = isset($attributes['name']) ? $attributes['name'] : null;
        $this->capacity = isset($attributes['capacity']) ? $attributes['capacity'] : null;
        $this->type_code = isset($attributes['type_code']) ? $attributes['type_code'] : null;
        $this->type = isset($attributes['type']) ? $attributes['type'] : null;
    }

    public function recipie()
    {
        return $this->belongsTo(Recipie::class);
    }
}
