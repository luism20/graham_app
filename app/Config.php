<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model {

    protected $table = "configurations";
    protected $fillable = ['instructions', 'template'];
    protected $primaryKey = 'version';
    public $timestamps = false;

}
