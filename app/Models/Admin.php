<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Admin extends Model
{
    use HasFactory;

    public static function getLog($data){
        $email = $data['email'];
        $password = $data['password'];
        $status = $data['status'];
        $is_admin = $data['is_admin'];
        
        $result = DB::table('pro_registration_records')
        ->where('email', $email)
        ->where('password', $password)
        ->where('status', $status)
        ->where('is_admin', $is_admin)
        ->get()->first();

        return $result;
    }
}
