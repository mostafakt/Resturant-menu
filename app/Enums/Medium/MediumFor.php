<?php

namespace App\Enums\Medium;

use App\Enums\Base\EnumToArray;

enum MediumFor: string
{
    use EnumToArray;

    case UserProfile = 'user-profile';
    case DiscountCode = 'discount-code';
    case CategoryImage = 'category-image';
    case CategoryMainImage = 'category-main-image';
    case ProductImage = 'product-image';
    case BannerImage = 'banner-image';
    case StoreImage = 'store-image';
    case StoreLogo = 'store-logo';
    case recipePhoto = 'recipe-photo';
    case homeHeader = 'home-header';
    case productPdf = 'product-pdf';
}
