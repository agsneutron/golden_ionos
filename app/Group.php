<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    /**
     * Get the modules for group.
     */
    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
