<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LivroResource extends JsonResource
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
            'posicao' => $this->posicao,
            'nome' => $this->nome,
            'abreviacao' => $this->abreviacao,
            'capa' => $this->capa,
            'testamento' => $this->whenLoaded('testamento'),
            'versiculos' => $this->whenLoaded('versiculos'),
            'links' => [
                [
                    'rel' => 'Informações de um livro',
                    'type' => 'GET',
                    'link' => route('livro.show', $this->id)
                ],
                [
                    'rel' => 'Atualizar um livro',
                    'type' => 'PUT',
                    'link' => route('livro.update', $this->id)
                ],
                [
                    'rel' => 'Atualizar a capa de um livro',
                    'type' => 'PATCH',
                    'link' => route('livro.upload', $this->id)
                ],
                [
                    'rel' => 'Remover um livro',
                    'type' => 'DELETE',
                    'link' => route('livro.destroy', $this->id)
                ]
            ]
        ];
    }
}
