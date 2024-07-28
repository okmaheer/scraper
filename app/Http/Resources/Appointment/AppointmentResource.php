<?php

namespace App\Http\Resources\Appointment;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title' => $this->patient->full_name,
            'start' => Carbon::parse($this->date_time)->format('Y-m-d') . 'T' . Carbon::parse($this->date_time)->format('h:i:s'), // Date only, without time
            'end' => Carbon::parse($this->date_time)->format('Y-m-d') . 'T' . Carbon::parse($this->date_time)->format('h:i:s'), // Date only, without time
            'color' => '#1e1e2d',
        ];
    }
}
