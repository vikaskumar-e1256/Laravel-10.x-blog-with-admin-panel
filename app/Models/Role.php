<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = ["name"];

    public function admins()
    {
        return $this->belongsToMany(Admin::class);
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermission($permissionName)
    {
        return $this->permissions->contains('name', $permissionName);
    }
}
