<?php

namespace App\Repositories;

use App\Helpers\CommonHelper;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param  Model  $model
     */
    public function __construct()
    {
        $this->setModel();
    }

    public function setModel()
    {
        $this->model = app()->make($this->getModel());
    }

    abstract public function getModel();

    /**
     * Create new model.
     */
    public function create(array $input): mixed
    {
        try {
            $newModel = new $this->model($input);
            $newModel->save();
        } catch (\Exception $exception) {
            Log::error('[Create]: ' . $exception->getMessage());
            $newModel = null;
        }

        return $newModel;
    }

    /**
     * Insert new record(s).
     */
    public function insert(array $values): bool
    {
        return $this->model->newQuery()->insert($values);
    }

    /**
     * Update model.
     */
    public function update(Model $model, array $input): ?Model
    {
        try {
            foreach ($input as $attribute => $value) {
                $model->{$attribute} = $value;
            }
            if ($model->isDirty()) {
                $model->save();
            }
        } catch (\Exception $exception) {
            $model = null;
            Log::error('[Update]: ' . $exception->getMessage());
        }

        return $model;
    }

    /**
     * Create or update a record matching the attributes, and fill it with values.
     *
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values)
    {
        try {
            $updateOrCreate = $this->model->newQuery()->updateOrCreate($attributes, $values);
        } catch (\Exception $exception) {
            Log::error('[updateOrCreate]: ' . $exception->getMessage());
            $updateOrCreate = null;
        }

        return $updateOrCreate;
    }

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
    ): ?Model {
        $query = $this->getClause($this->model->newQuery(), $condition);
        if ($relations) {
            $query = $this->relate($query, $relations);
        }

        return $query->first($columns);
    }

    public function find($id): mixed
    {
        return $this->model->find($id);
    }

    /**
     * @return false
     */
    public function deleteByAttr($attr, $value)
    {
        return !is_null($attr) ? $this->model->where($attr, $value)->delete() : false;
    }

    /**
     * Delete record by id | list id
     */
    public function delete($id): ?int
    {
        try {
            $query = $this->model->destroy($id);
            // Count equal to 0
            if (empty($query)) {
                $query = null;
            }
        } catch (\Exception $exception) {
            $query = null;
            Log::error('[delete]: ' . $exception->getMessage());
        }

        return $query;
    }

    /**
     * Check the existent model.
     */
    public function exist($column, $condition): bool
    {
        return $this->model->where($column, $condition)->exists();
    }

    /**
     * @param array $columns
     * @return mixed
     */
    public function all(array $columns = SELECT_ALL, $orderBy = FIELD_ID, $sortBy = ORDER_ASC)
    {
        return $this->model->orderBy($orderBy, $sortBy)->get($columns);
    }

    /**
     * Get the list with relationship
     *
     * @param  array  $other  sort, relation, join, paginate, filter
     */
    public function getList(
        array $columns = SELECT_ALL,
        array $condition = [],
        array $other = []
    ) {
        $query = $this->getClause($this->model->newQuery(), $condition);
        $query->select($columns);
        $other = $this->moveItemToLast($other, KEY_PAGINATE);

        foreach ($other as $key => $value) {
            $query = $this->{$key}($query, $value);
        }

        return $query;
    }

    /**
     * Get clause And.
     */
    public function getClause(Builder $query, array $condition): Builder
    {
        foreach ($condition as $column => $value) {
            if (isset($value[KEY_VALUE])) {
                switch ($value[KEY_OPERATOR]) {
                    case KEY_OR_WHERE_IN:
                        $query->orWhereIn($column, $value[KEY_VALUE]);
                        break;
                    case KEY_OR_WHERE_NOT_IN:
                        $query->orWhereNotIn($column, $value[KEY_VALUE]);
                        break;
                    case KEY_OR_WHERE_BETWEEN:
                        $query->orWhereBetween($column, $value[KEY_VALUE]);
                        break;
                    case KEY_OR_WHERE_NOT_BETWEEN:
                        $query->orWhereNotBetween($column, $value[KEY_VALUE]);
                        break;
                    case KEY_OR_WHERE_NULL:
                        $query->orWhereNull($column);
                        break;
                    case KEY_OR_WHERE_NOT_NULL:
                        $query->orWhereNotNull($column);
                        break;
                    case KEY_OR_WHERE:
                        $query->orWhere($column, $value[KEY_VALUE][KEY_OPERATOR], $value[KEY_VALUE][KEY_VALUE]);
                        break;
                    case KEY_WHERE_IN:
                        $query->whereIn($column, $value[KEY_VALUE]);
                        break;
                    case KEY_WHERE_NOT_IN:
                        $query->whereNotIn($column, $value[KEY_VALUE]);
                        break;
                    case KEY_WHERE_BETWEEN:
                        $query->whereBetween($column, CommonHelper::dateBetween($value[KEY_VALUE]));
                        break;
                    case KEY_WHERE_NOT_BETWEEN:
                        $query->whereNotBetween($column, $value[KEY_VALUE]);
                        break;
                    case KEY_WHERE_NULL:
                        $query->whereNull($column);
                        break;
                    case KEY_WHERE_NOT_NULL:
                        $query->whereNotNull($column);
                        break;
                    case KEY_WHERE_DATE:
                        $query->whereDate($column, $value[KEY_VALUE][KEY_OPERATOR], $value[KEY_VALUE][KEY_VALUE]);
                        break;
                    case KEY_WHERE_DATE_LESS:
                        $query->whereDate($column, OPERATOR_LESS, $value[KEY_VALUE]);
                        break;
                    case KEY_WHERE_HAS:
                        $query->whereHas($value[KEY_RELATIONSHIP_NAME], function ($q) use ($value, $column) {
                            $q->where($column, $value[KEY_VALUE]);
                        });
                        break;
                    case KEY_WHERE_HAS_LIKE:
                        $query->whereHas($value[KEY_RELATIONSHIP_NAME], function ($q) use ($value, $column) {
                            $q->where($column, OPERATOR_LIKE, '%' . CommonHelper::escapeStr($value[KEY_VALUE]) . '%');
                        });
                        break;
                    case KEY_WHERE_IN_VALUE_AND_NULL:
                        $query->where(function ($q) use ($value, $column) {
                            $q->whereIn($column, $value[KEY_VALUE])
                                ->orWhereNull($column);
                        });
                        break;
                    case KEY_WHERE_IN_VALUE_AND_NOT_NULL:
                        $query->orWhere(function ($q) use ($value, $column) {
                            $q->orWhere($column, $value[KEY_VALUE])
                                ->whereNotNull($column);
                        });
                        break;
                    case KEY_LIKE_OR_WHERE:
                        $query->orWhere($column, OPERATOR_LIKE, '%' . CommonHelper::escapeStr($value[KEY_VALUE]) . '%');
                        break;
                    case KEY_LIKE_WHERE:
                        $query->where($column, OPERATOR_LIKE, '%' . CommonHelper::escapeStr($value[KEY_VALUE]) . '%');
                        break;
                    case KEY_WHERE_HAS_BETWEEN:
                        $query->whereHas($value[KEY_RELATIONSHIP_NAME], function ($q) use ($value, $column) {
                            $q->whereBetween($column, CommonHelper::dateBetween($value[KEY_VALUE]));
                        });
                        break;
                    case KEY_WHERE_NULL_OR_THAN_EQUAL:
                        $query->where(function ($q) use ($value, $column) {
                            $q->WhereDate($column, OPERATOR_THAN_EQUAL, $value[KEY_VALUE])
                                ->orWhereNull($column);
                        });
                        break;
                    default:
                        $query->where($column, $value[KEY_OPERATOR], $value[KEY_VALUE]);
                        break;
                }
            }
        }


        return $query;
    }

    /**
     * Move item to the last index of array.
     */
    public static function moveItemToLast(array $input, $key): array
    {
        if (count($input) > 1 && array_key_exists($key, $input)) {
            $valueOfKeyInArray = $input[$key];
            unset($input[$key]);
            $input += [
                $key => $valueOfKeyInArray,
            ];
        }

        return $input;
    }

    /**
     * Relate relationship.
     */
    protected function relate(Builder $query, array $relations): Builder
    {
        foreach ($relations as $relation) {
            $query->with([$relation[KEY_RELATIONSHIP_NAME] => function ($query) use ($relation) {
                $query->select($relation[KEY_RELATIONSHIP_SELECT]);
            }]);
        }

        return $query;
    }

    /**
     * Join other table.
     *
     * @param  null  $type
     * @return Builder
     */
    protected function join(Builder $query, array $join, $type = null)
    {
        foreach ($join as $value) {
            $query->join(
                $value[KEY_TABLE],
                $value[KEY_FOREIGN_KEY],
                OPERATOR_EQUAL,
                $value[KEY_PRIMARY_KEY],
                $type ?? $value[KEY_TYPE_JOIN]
            )
            ->whereNull($value[KEY_TABLE] . '.deleted_at');
        }

        return $query;
    }

    /**
     * Paginate records.
     *
     * @param  Builder  $query
     * @param  array  $pagination
     * @return LengthAwarePaginator
     */
    protected function paginates(Builder $query, array $pagination): LengthAwarePaginator
    {
        return $query->paginate(
            $pagination[INPUT_PAGE_SIZE],
            SELECT_ALL,
            INPUT_PAGE,
            $pagination[INPUT_PAGE]
        );
    }

    /**
     * Sort the list of models.
     *
     * @param  Builder  $query
     * @param  array  $sort
     * @return Builder
     */
    protected function sort(Builder $query, array $sort): Builder
    {
        foreach ($sort as $column => $value) {
            $query->orderBy($column, $value);
        }

        return $query;
    }

    /**
     * Find one or fail model
     *
     * @param  int  $id
     * @param  array  $condition,
     * @param  array  $columns
     * @param  array  $relations
     * @return Model|null
     */
    public function findOneOrFail($id, $columns = SELECT_ALL, $condition = [], $relations = [])
    {
        $query = $this->getClause($this->model->newQuery(), $condition);
        if ($relations) {
            return $this->relate($query, $relations)->findOrFail($id, $columns);
        }

        return $this->model->findOrFail($id, $columns);
    }

    /**
     * Get value last column of model
     *
     * @param string $column
     * @return Model
     */
    public function max(string $column = FIELD_ID)
    {
        return $this->model->withTrashed()->max($column);
    }

    /**
     * Get value last column of model with mutiple condition
     *
     * @param  array  $condition
     * @param string $column
     * @return Model
     */
    public function maxByCondition(array $condition = [], string $column = FIELD_ID)
    {
        return $this->getList([$column], $condition)->max($column);
    }

    /**
     * Upsert multiple models
     *
     * @param  array  $values
     * @param  array|string  $uniqueBy
     * @param  array|null  $update
     * @return Model
     */
    public function upsert($values, $uniqueBy, $update)
    {
        return $this->model->upsert($values, $uniqueBy, $update);
    }
}
