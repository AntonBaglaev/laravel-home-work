<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyUser extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    public $timestamps = true;
    public $fillable = [
        'name',
        'surname',
        'email',
    ];

    public static function create(string $name, string $surname, string $email): MyUser
    {
        $user = new MyUser();
        $user->name=$name;
        $user->surname=$surname;
        $user->email=$email;
        $user->save();
        return $user;
    }
}
