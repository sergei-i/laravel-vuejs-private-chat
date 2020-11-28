<?php

namespace App\Http\Resources;

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'online' => false,
            'session' => $this->sessionDetails($this->id)
        ];
    }

    /**
     * @param int $id
     * @return SessionResource
     */
    private function sessionDetails(int $id)
    {
        $session = Session::whereIn('user1_id', [auth()->id(), $id])
            ->whereIn('user2_id', [auth()->id(), $id])
            ->first();
        return new SessionResource($session);
    }
}
