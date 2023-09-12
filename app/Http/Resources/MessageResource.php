<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'from' => $this->from->name,
            'to' => $this->to->name,
            'body' => $this->body,
            'from_id' => $this->from_id,
            'to_id' => $this->to_id,
            'date' => $this->updated_at->format('Y-m-d H:m:s'),
        ];
    }
}
