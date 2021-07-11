<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $url
 * @property string $shorter
 * @property User $user
 */
class UrlResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'owner' => $this->user->name ?? 'Anonymous',
            'url' => $this->url,
            'short_code' => url($this->shorter)
        ];
    }
}
