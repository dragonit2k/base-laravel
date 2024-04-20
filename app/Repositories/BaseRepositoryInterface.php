<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function create(array $attributes): mixed;

    /**
     * Insert new record(s).
     */
    public function insert(array $input): bool;

    /**
     * Update model.
     *
     *
     * @return ?Model
     */
    public function update(Model $model, array $input): ?Model;

    /**
     * Update or create model
     */
    public function updateOrCreate(array $attributes, array $values): mixed;

    /**
     * @param  array  $columns
     * @return mixed
     */
    public function all($columns, $orderBy, $sortBy);

    /**
     * Get the model detail.
     *
     *
     * @return ?Model
     */
    public function getDetail(
        array $condition,
        array $columns = SELECT_ALL,
        array $relations = []
    ): ?Model;

    /**
     * Get the list with relationship
     *
     * @param  array  $other sort, relation, join, paginate
     */
    public function getList(
        array $columns = SELECT_ALL,
        array $condition = [],
        array $other = []
    ): mixed;

    /**
     * Find by id
     */
    public function find($id): mixed;

    /**
     * Delete with condition
     */
    public function deleteByAttr($attr, $value): mixed;

    /**
     * Delete record by id | list id
     *
     * @return ?int
     */
    public function delete(array|int $id): ?int;

    /**
     * Check the existent model.
     */
    public function exist($column, $condition): bool;

    /**
     * Find one or fail model
     *
     * @param  int  $id
     * @param  array  $columns
     * @param  array  $relations
     * @return Model|null
     */
    public function findOneOrFail($id, $columns = SELECT_ALL, $relations = []);
}
