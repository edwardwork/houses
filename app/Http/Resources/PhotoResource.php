<?php

namespace App\Http\Resources;

use App\Enums\Admins\AdminMediaCollectionEnum;
use App\Enums\FileConversationEnum;
use App\Enums\Files\MediaConversionsEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * @mixin Media
 */
class PhotoResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'small_url' => $this->getFullUrl(FileConversationEnum::SMALL_CONVERSATION),
            'medium_url' => $this->getFullUrl(FileConversationEnum::MEDIUM_CONVERSATION),
            'large_url' => $this->getFullUrl(FileConversationEnum::LARGE_CONVERSATION),
            'order' => $this->order_column,
            'property' => $this->custom_properties,
        ];
    }
}