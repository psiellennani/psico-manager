<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $fillable = ['paciente_id','sessao_id','profissional_id','tipo','conteudo','data_registro'];

    public static $tipos = ['evolucao','anotacao','feedback','interconsulta'];

    public function paciente() {
        return $this->belongsTo(Paciente::class);
    }

    public function sessao() {
        return $this->belongsTo(Sessao::class, 'sessao_id');
    }

    public function profissional() {
        return $this->belongsTo(User::class, 'profissional_id');
    }
}
