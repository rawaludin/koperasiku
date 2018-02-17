<?php

namespace App\Policies;

use App\User;
use App\LoanRequest;
use Illuminate\Auth\Access\HandlesAuthorization;

class LoanRequestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the loanRequest.
     *
     * @param  \App\User  $user
     * @param  \App\LoanRequest  $loanRequest
     * @return mixed
     */
    public function view(User $user, LoanRequest $loanRequest)
    {
        return $user->id == $loanRequest->member_id;
    }

    /**
     * Determine whether the user can create loanRequests.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isMember();
    }

    /**
     * Determine whether the user can update the loanRequest.
     *
     * @param  \App\User  $user
     * @param  \App\LoanRequest  $loanRequest
     * @return mixed
     */
    public function update(User $user, LoanRequest $loanRequest)
    {
        return $user->id == $loanRequest->member_id
            && $loanRequest->status == 'Draft';
    }

    /**
     * Determine whether the user can delete the loanRequest.
     *
     * @param  \App\User  $user
     * @param  \App\LoanRequest  $loanRequest
     * @return mixed
     */
    public function delete(User $user, LoanRequest $loanRequest)
    {
        return $user->id == $loanRequest->member_id
            && $loanRequest->status == 'Draft';
    }
}
