<?php

namespace App;

use App\Domain\AddressRepositoryInterface;
use App\Models\AddressModel;

class DbAddressRepository implements AddressRepositoryInterface
{
    public function getByUserId(int $id)
    {
        return AddressModel::where('user_id', '=', $id)->first();
    }

    public function create($request)
    {
        $request->user()->address()->create($request->all());
    }

    public function save($address)
    {
        $address->save();
    }
}
