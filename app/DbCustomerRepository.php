<?php

namespace App;

use App\Domain\Customer;
use App\Domain\CustomerRepositoryInterface;
use App\Models\CustomerInfoModel;

class DbCustomerRepository implements CustomerRepositoryInterface
{
    public function getByCustomerId(int $id): Customer
    {
        $infoModel = CustomerInfoModel::where('user_id', '=', $id)->first();

        return new Customer(
            $infoModel->email,
            $infoModel->user_id,
            $infoModel->phone,
            $infoModel->additional_contact);
    }


    public function save(Customer $info)
    {
        $infoModel = CustomerInfoModel::where('user_id', '=', $info->getId())->firstOrNew();

        $infoModel->email = $info->getEmail();
        $infoModel->user_id = $info->getId();
        $infoModel->phone = $info->getPhone();
        $infoModel->additional_contact = $info->getAdditionalContact();

        $infoModel->save();
    }
}
