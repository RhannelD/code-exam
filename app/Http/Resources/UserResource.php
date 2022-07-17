<?php

namespace App\Http\Resources;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return Arr::only(parent::toArray($request), [
            'id',
            'role_id',
            'full_name',
            'email_address',
        ]) + [
            'role' => new RoleResource($this->whenLoaded('role')),
            'can_delete' => Gate::allows('delete', $this->resource),
            'can_update' => Gate::allows('update', $this->resource),
        ];
    }
}
