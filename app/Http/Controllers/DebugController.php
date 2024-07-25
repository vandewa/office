<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Simpeg\Tb01;

class DebugController extends Controller
{
    // public function getPhone()
    // {
    //     // Get the logged-in user
    //     $user = Auth::user();

    //     if ($user) {
    //         // Check if user meets the conditions
    //         if ($user->idjenjab == 20 && $user->idjenkedudupeg == 1 && $user->idskpd == $user->kdunit && $user->idjabjbt == $user->kdunit) {
    //             // Retrieve the phone number from the tb01 table
    //             $phone = Tb01::where('kdunit', $user->kdunit)
    //                 ->where('idjenjab', 20)
    //                 ->where('idjenkedudupeg', 1)
    //                 ->whereColumn('idjabjbt', 'idskpd')
    //                 ->value('hp');

    //             return response()->json(['phone' => $phone]);
    //         } else {
    //             return response()->json(['error' => 'User does not meet the conditions.'], 400);
    //         }
    //     } else {
    //         return response()->json(['error' => 'User not authenticated.'], 401);
    //     }
    // }

    public function getPhone()
    {
        $user = Auth::user();
        $nip = $user->nip;
        $kepalaDinas = Tb01::where('idskpd', $user->kdunit)
            ->where('idjabjbt', $user->kdunit)
            ->where('idjenjab', 20)
            ->where('idjenkedudupeg', 1)
            ->first();
            return response()->json(['phone' => $kepalaDinas]);
    }
}
