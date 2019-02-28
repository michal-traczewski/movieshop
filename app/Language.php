<?php

namespace Movies;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'language';
    protected $primaryKey = 'language_id';
    protected $autoincrementing = false;
    protected $fillable = [
        'name',
        'created_at'
    ];
}
