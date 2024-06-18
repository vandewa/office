<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Simpeg\Tb01;

class SuratMasukPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function viewStatus(Tb01 $user)
    {
        return $user->hasRole('sekretariat') || $user->hasRole('kepala_dinas') || $user->hasRole('kepala_bidang');
    }
}
