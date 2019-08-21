<?php


namespace App\Services;


use App\Repositories\PendingEditionRepository;
use App\Services\Traits\CrudMethods;
use Illuminate\Database\Eloquent\Model;

class PendingEditionService
{
    use CrudMethods;

    /**
     * @var PendingEditionRepository
     */
    protected $repository;

    /**
     * AddressService constructor.
     * @param PendingEditionRepository $repository
     */
    public function __construct(PendingEditionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function beforeSave(Model $model, array $fields, string $alias)
    {
        $create_occurrence = false;

        foreach ($fields as $field){
            if($model->isDirty($field) && !empty($model->{$field}) && !empty($model->getOriginal($field))){
                $data = [
                    'model' => $alias,
                    'primary_key' => $model->getAttribute('id'),
                    'field' => $field,
                    'value' => $model->{$field}
                ];

                $create_occurrence = true;

                if(!$id = $this->duplicity($data)){
                    $this->update($data, $id);
                }

                $model->isDirty([$field => false]);
            }else if(empty($model->{$field})){
                $model->isDirty([$field => false]);
            }
        }
        if($create_occurrence) $this->create_occurrence($data);
    }

    public function duplicity($data)
    {
        $duplicity = $this->repository->findWhere([
            'model' => $data['model'],
            'primary_key' => $data['primaky_key'],
            'field' => $data['field']
        ])->first();

        return $duplicity->id;
    }

    public function create_occurrence($data)
    {
        // TODO CREATE METHOD
    }
}
