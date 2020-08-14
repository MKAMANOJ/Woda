<?php

namespace App\EBP\Accessors\User;

use App\EBP\Entities\{
    Company, User, UserDetail
};

/**
 * Trait UserAccessor
 * @package App\EBP\Accessors\User
 */
trait UserAccessor
{
    /**
     * Return user's company name.
     * @return mixed
     */
    public function getCompanyNameAttribute()
    {
        /** @var User $this */
        return $this->company->company_name ?? '';
    }

    /**
     * Returns formatted user name with the position and contact number.
     * @return string
     */
    public function getUserNameWithPositionAttribute()
    {
        /** @var User $this */
        $userDetail = $this->userDetail;

        return sprintf('%s <br> %s <br> <br> %s <br/>',
            $this->name, $userDetail->job_position ?? '', $userDetail->contact_number1 ?? '');
    }

    /**
     * Returns the formatted company address of the specific user.
     * @return string
     */
    public function getFormattedCompanyAddressAttribute()
    {
        /** @var Company $this */
        $company = $this->company;

        return sprintf('%s <br>  %s <br> %s, Australia',
                $company->address_line1, $company->suburb, $company->post_code) ;
    }

    /**
     * Returns the role name of the user
     *
     * @return string
     */
    public function getRoleNameAttribute()
    {
        /** @var User $this */
        return $this->roles->first()->name;
    }
}
