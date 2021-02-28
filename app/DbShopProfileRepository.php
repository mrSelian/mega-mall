<?php

namespace App;

use App\Domain\ShopProfile;
use App\Domain\ShopProfileRepositoryInterface;
use App\Models\SellerInfoModel;

class DbShopProfileRepository implements ShopProfileRepositoryInterface
{

    public function getBySellerId(int $id): ?ShopProfile
    {
        $infoModel = SellerInfoModel::where('user_id', '=', $id)->first();

        return $infoModel == null ? null : new ShopProfile(
            $infoModel->user_id,
            $infoModel->name,
            $infoModel->email,
            $infoModel->delivery_terms,
            $infoModel->info,
            $infoModel->main_photo,
            $infoModel->phone,
            $infoModel->additional_contact);

    }

    public function save(ShopProfile $info)
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
