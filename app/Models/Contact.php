<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @property string $name
 * @property string $email
 * @property string $phone
 *
 */
class Contact extends Model
{
    protected $table = 'contact';
    protected $fillable = ['id', 'name', 'email', 'phone'];

    public $timestamps = false;

    use HasFactory;
}
