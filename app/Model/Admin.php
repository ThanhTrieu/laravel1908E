<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';

    private function convertToArrayData($data)
    {
        $result = [];
        if($data){
            $result = $data->toArray();
        }
        return $result;
    }

    public function checkAdminLogin($user, $pass)
    {
        $data = Admin::where([
            'username' => $user,
            'password' => $pass])->first();

        return $this->convertToArrayData($data);
    }

    public function updateLastLogin($id)
    {
        $admin = Admin::find($id);
        $admin->last_login = date('Y-m-d H:i:s');
        if($admin->save()){
            return true;
        }
        return false;
    }
}
