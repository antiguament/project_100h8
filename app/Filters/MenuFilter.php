<?php

namespace App\Filters;

use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Illuminate\Support\Facades\Auth;

class MenuFilter implements FilterInterface
{
    public function transform($item)
    {
        if (isset($item['role']) && !$this->userHasRole($item['role'])) {
            return false;
        }
        return $item;
    }

    protected function userHasRole($roles)
    {
        $user = Auth::user();
        
        if (!$user) {
            return false;
        }

        if (is_array($roles)) {
            return $user->hasAnyRole($roles);
        }

        return $user->hasRole($roles);
    }
}
