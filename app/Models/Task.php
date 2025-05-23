<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function tags()
    {
        return $this->hasMany(Tag::class, 'task_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($task) {
            $task->tags()->delete();  // Hapus tag yang terkait
        });
    }

}
