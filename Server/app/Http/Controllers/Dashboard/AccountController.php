<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Concerns\WorksWithModels;
use App\Http\Requests\Dashboard\AccountSaveRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    use WorksWithModels;

    public function showAccountDetailsForm()
    {
        return view('dashboard.account');
    }

    public function saveAccountDetails(AccountSaveRequest $request)
    {
        $this->visitor->update($this->getInputForSave($request));

        return $this->redirect(false, 'Successfully updated your account.');
    }

    protected function getInputForSave(Request $request)
    {
        $input = $request->only([
            'name', 'email',
            'password',
        ]);

        if (empty($input['password'])) {
            unset ($input['password']);
        } else {
            $input['password'] = bcrypt($input['password']);
        }

        return $input;
    }
}
