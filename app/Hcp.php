<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Hcp extends Authenticatable
{
    protected $table = 'hcps';
    protected $primaryKey = 'hcp_id';
    protected $guard = 'hcp';
    
 
    protected $fillable = [
        'hcp_name', 'hcp_email', 'hcp_password', 'hcp_pic'
    ];
    protected $hidden = [
        'hcp_password', 'remember_token',
    ];
    
    // for the auth guard column of admin_password to login 
    public function getAuthPassword () {
        return $this->hcp_password;
    }
}
