<?php

namespace App\Http\Concerns;

use App\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait HasAddressFields
{
    protected function associateAddress(Model $model, Request $request)
    {
        $input = $this->validate($request, [
            'street_1' => 'required|string',
            'street_2' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
        ]);

        /** @var Address $address */
        $address = $model->address ?? Address::newModelInstance();

        $address->fill($input);
        $address->addressable()->associate($model);
        $address->save();

        return $address;
    }
}