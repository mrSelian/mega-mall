<?php

namespace App;

use App\Domain\SellerInfo;
use App\Domain\SellerInfoRepositoryInterface;
use App\Models\SellerInfoModel;

class DbSellerInfoRepository implements SellerInfoRepositoryInterface
{

    public function getBySellerId(int $id): SellerInfo
    {
        $infoModel = SellerInfoModel::where('user_id', '=', $id)->firstOrFail();

        return new SellerInfo(
            $infoModel->user_id,
            $infoModel->name,
            $infoModel->email,
            $infoModel->delivery_terms,
            $infoModel->info,
            $infoModel->main_photo,
            $infoModel->phone,
            $infoModel->additional_contact);
    }

    public function save(SellerInfo $info)
    {
        $infoModel = SellerInfoModel::where('user_id', '=', $info->getSellerId())->firstOrNew();

        $infoModel->user_id = $info->getSellerId();
        $infoModel->name = $info->getShopName();
        $infoModel->email = $info->getEmail();
        $infoModel->delivery_terms = $info->getDeliveryTerms();
        $infoModel->info = $info->getInfo();
        $infoModel->main_photo = $info->getMainPhoto();
        $infoModel->phone = $info->getPhone();
        $infoModel->additional_contact = $info->getAdditionalContact();

        $infoModel->save();
    }
}
