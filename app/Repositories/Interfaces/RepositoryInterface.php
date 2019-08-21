<?php


namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    /**
     * Get all of the models from the database.
     *
     * @param  array|mixed  $columns
     * @return Collection|static[]
     */
    public function all($columns = ['*']);

    /**
     * Get an array with the values of a given column.
     *
     * @param  string  $column
     * @param  string|null  $key
     * @return Collection
     */
    public function pluck($column, $key = null);

    /**
     * Save the model to the database.
     *
     * @param $options
     * @return bool
     */
    public function save($options = []);

    /**
     * create a new record in the database
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * update record in the database
     *
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id);

    /**
     * remove record from the database
     *
     * @param $id
     * @return int
     */
    public function delete($id);

    /**
     * show the record with the given id
     *
     * @param $id
     * @return null|Model
     */
    public function show($id);

    /**
     * Get the associated model
     *
     * @return Model
     */
    public function getModel();

    /**
     * Set the associated model
     *
     * @param $model
     * @return $this
     */
    public function setModel($model);

    /**
     * Eager load database relationships
     *
     * @param $relations
     * @return Builder|static
     */
    public function with($relations);
}