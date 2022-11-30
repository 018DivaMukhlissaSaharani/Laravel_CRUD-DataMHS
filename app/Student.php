<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['nim', 'name', 'email', 'address', 'images', 'course_id', 'major_id'];

    public function major()
    {
        return $this->belongsTo('App\Major', 'major_id');
    }
    public function course()
    {
        return $this->belongsTo('App\Course', 'course_id');
    }
}
