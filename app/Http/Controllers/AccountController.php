<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;
use Crypt;
use DB;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth.role:developer,administrator');
    }

    public function index()
    {
        return view('account.index');
    }

    /**
     * Using createUserPass() method, we will reset all KKKS
     * user and password, what we mean by KKKS area any user
     * with role of 'contractor'.
     *
     * TODO: Using carbon to update updated_at column.
     *
     * @return string
     */
    public function resetAllUserPass()
    {
        $working_areas = DB::table('user')->select('working_area_id')
            ->where('role', '=', 'contractor')
            ->get();

        foreach ($working_areas as $working_area) {
            $this->createUserPass($working_area->working_area_id);
        }

        return 'success';
    }

    /**
     * Reset username and password of Working Area.
     *
     * @param string $working_area_id
     * @return void
     */
    private function createUserPass($working_area_id)
    {
        $password = createRandomString();
        DB::table('user')->where('working_area_id', $working_area_id)->update([
            'username' => createRandomString(),
            'password' => Hash::make($password),
            'enc_password' => Crypt::encrypt($password)
        ]);
    }
}
