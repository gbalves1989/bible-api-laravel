<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VersiculoResource extends JsonResource
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
            'capitulo' => $this->nome,
            'versiculo' => $this->versiculo,
            'texto' => $this->texto,
            'livro' => $this->whenLoaded('livro'),
            'links' => [
                [
                    'rel' => 'Informações de um versículo',
                    'type' => 'GET',
                    'link' => route('versiculo.show', $this->id)
                ],
                [
                    'rel' => 'Atualizar um versículo',
                    'type' => 'PUT',
                    'link' => route('versiculo.update', $this->id)
                ],
                [
                    'rel' => 'Remover um versículo',
                    'type' => 'DELETE',
                    'link' => route('versiculo.destroy', $this->id)
                ]
            ]
        ];
    }
}
