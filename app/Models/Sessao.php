<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sessao extends Model
{
    protected $table = 'sessoes'; // importante, pois Laravel pluraliza errado
    protected $fillable = ['paciente_id','profissional_id','conteudo','data_sessao','consulta_id'];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function profissional()
    {
        return $this->belongsTo(User::class,'profissional_id');
    }

    public function registros()
    {
        return $this->hasMany(Registro::class,'sessao_id');
    }
}
