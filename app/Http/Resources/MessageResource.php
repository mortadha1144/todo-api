<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    protected $message;
    protected $status;

    /**
     * Create a new resource instance.
     *
     * @param string $message
     * @param int $status
     * @return void
     */
    public function __construct(string $message, int $status = 200)
    {
        parent::__construct(null);
        $this->message = $message;
        $this->status = $status;
        $this->withoutWrapping();
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => $this->message,
        ];
    }

    public function withResponse(Request $request, JsonResponse $response): void
    {
        $response->setStatusCode($this->status);
    }
}
