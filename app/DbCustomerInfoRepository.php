<?php

namespace App;

use App\Domain\CustomerInfo;
use App\Domain\CustomerInfoRepositoryInterface;
use App\Models\CustomerInfoModel;

class DbCustomerInfoRepository implements CustomerInfoRepositoryInterface
{
    public function getByCustomerId(int $id): CustomerInfo
    {
        $infoModel = CustomerInfoModel::where('user_id', '=', $id)->first();

        return new CustomerInfo(
            $infoModel->email,
            $infoModel->user_id,
            $infoModel->phone,
            $infoModel->additional_contact);
    }


    public function save(CustomerInfo $info)
    {
        $infoModel = CustomerInfoModel::where('user_id', '=', $info->getUserId())->firstOrNew();

        $infoModel->email = $info->getEmail();
        $infoModel->user_id = $info->getUserId();
        $infoModel->phone = $info->getPhone();
        $infoModel->additional_contact = $info->getAdditionalContact();

        $infoModel->save();
    }
}
