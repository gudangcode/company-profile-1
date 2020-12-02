<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = ['id', 'name', 'email', 'phone', 'country', 'budget', 'skype_whatsapp', 'services', 'description', 'nda', 'created_at', 'updated_at'];
}
