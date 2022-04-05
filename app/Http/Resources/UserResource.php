<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $tasks = [];
        foreach ($this->tasks as $task) {
            $tasks[] = [
                    'id' => (string)$task->id,
                    'title' => $task->title,
                    'description' => $task->description,
                    'status' => $task->type_status,
                    'created_at' => $task->created_at,
            ];
        }

        return [
            'data' => [
                'id' => (string)$this->id,
                'type' => 'User',
                'user' => $this->name,
                'attribute' => [
                    'name' => $this->name,
                    'email' => $this->email,
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at,
                    'tasks' => $tasks
                ]
            ]
        ];
    }
}
