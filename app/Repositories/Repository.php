<?php


namespace App\Repositories;


use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    /**
     * @var Model|Builder $model
     */
    protected $model;

    /**
     * Get all of the models from the database.
     *
     * @param array|mixed $columns
     * @return Collection|static[]
     */
    public function all($columns = ['*'])
    {
        return $this->model->all($columns);
    }

    /**
     * Get an array with the values of a given column.
     *
     * @param string $column
     * @param string|null $key
     * @return Collection
     */
    public function pluck($column, $key = null)
    {
        return $this->model->pluck($column, $key);
    }

    /**
     * Save the model to the database.
     *
     * @param $options
     * @return bool
     */
    public function save($options = [])
    {
        return $this->model->save($options);
    }

    /**
     * create a new record in the database
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * update record in the database
     *
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id)
    {
        $record = $this->model->find($id);

        return $record->update($data);
    }

    /**
     * remove record from the database
     *
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * show the record with the given id
     *
     * @param mixed $id
     * @param array $columns
     * @return Model|Collection|static|static[]
     * @return null|Model
     */
    public function show($id, $columns = ['*'])
    {
        return $this->setModel($this->model->findOrFail($id))->getModel();
    }

    /**
     * Get the associated model
     *
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the associated model
     *
     * @param $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Eager load database relationships
     *
     * @param $relations
     * @return Builder|static
     */
    public function with($relations)
    {
        return $this->model->with($relations);
    }
}