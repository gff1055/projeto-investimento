<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\InstitutionRepository;
use App\Entities\Institution;
use App\Validators\InstitutionValidator;


class InstitutionRepositoryEloquent extends BaseRepository implements InstitutionRepository
{

    // Metodo para retornar todos as instituicoes
    public function selectBoxList(string $descricao = 'name', string $chave = 'id')
    {
        return $this->model->pluck($descricao, $chave)->all();
    }

    public function model()
    {
        return Institution::class;
    }
    

    public function validator()
    {
        return InstitutionValidator::class;
    }


    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }    
}
