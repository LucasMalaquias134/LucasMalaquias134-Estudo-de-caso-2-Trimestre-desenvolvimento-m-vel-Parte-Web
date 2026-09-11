<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['nome', 'sobrenome', 'telefone', 'empresa', 'descricao', 'imagem'])]
class Contato extends Model
{
    public function usuario()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
