<?php

namespace App;

use App\Domain\CustomerAddress;
use App\Domain\CustomerAddressRepositoryInterface;
use App\Models\AddressModel;

class DbCustomerAddressRepository implements CustomerAddressRepositoryInterface
{
    public function getByUserId(int $id): ?CustomerAddress
    {
        $addressModel = AddressModel::where('user_id', '=', $id)->first();

        return $addressModel == null ? null : new CustomerAddress(
            $addressModel->user_id,
            $addressModel->zip,
            $addressModel->country,
            $addressModel->region,
            $addressModel->city,
            $addressModel->street,
            $addressModel->house,
            $addressModel->apt,
            $addressModel->full_name
        );

    }

    public function save(CustomerAddress $address)
    {
        $addressModel = AddressModel::where('user_id', '=', $address->getUserId())->firstOrNew();

        $addressModel->user_id = $address->getUserId();
        $addressModel->zip = $address->getZip();
        $addressModel->country = $address->getCountry();
        $addressModel->region = $address->getRegion();
        $addressModel->city = $address->getCity();
        $addressModel->street = $address->getStreet();
        $addressModel->house = $address->getHouse();
        $addressModel->apt = $address->getApt();
        $addressModel->full_name = $address->getFullName();

        $addressModel->save();
    }
}
