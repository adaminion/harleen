<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;
use Crypt;
use DB;
use Excel;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:developer,administrator');
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
        set_time_limit(0);

        $data = [];
        $working_areas = DB::table('user')
            ->select('working_area_id')
            ->where('role', '=', 'contractor')
            ->get();

        foreach ($working_areas as $working_area) {
            $data[] = $this->createUserPass($working_area->working_area_id);
        }

        session()->flash('reset-all-user-pass', $data);

        return 'account/reset/all/export';
    }

    /**
     * Export username dan password yang baru saja dibuat oleh resetAllPass
     * sumber username diambil dari flash session, sehingga jika flash
     * session kosong, maka akan return false.
     *
     * @return Excel
     */
    public function exportNewUserPass()
    {
        if (session()->has('reset-all-user-pass')) {
            $data = session()->get('reset-all-user-pass');

            Excel::create('RPS User and Password', function ($excel) use ($data) {
                $excel->setTitle('RPS User and Password');
                $excel->setDescription('All RPS User and Password');

                $excel->sheet('Username and Password', function($sheet) use ($data) {
                    $sheet->fromArray($data);
                });
            })->download('xlsx');
        }

        return redirect('account');
    }

    /**
     * Reset username and password of Working Area.
     *
     * @param string $working_area_id
     * @return void
     */
    private function createUserPass($working_area_id)
    {
        $username = createRandomString();
        $password = createRandomString();
        $wkName = DB::table('working_area')
            ->select(['working_area_name'])
            ->where('id', '=', $working_area_id)
            ->first()->working_area_name;

        DB::table('user')
            ->where('working_area_id', $working_area_id)
            ->update([
                'username' => $username,
                'password' => Hash::make($password),
                'enc_password' => Crypt::encrypt($password)
            ]);

        return [
            'WKID' => $working_area_id,
            'Working Area Name' => $wkName,
            'Username' => $username,
            'Password' => $password,
        ];
    }
}
