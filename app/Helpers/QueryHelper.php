<?php

namespace App\Helpers;

class QueryHelper
{
    /**
     * Set array of the query input.
     *
     * @param $value
     * @param  string  $operator
     * @param  null  $relation
     * @return array
     */
    public static function setQueryInput($value, string $operator = '=', $relation = null): array
    {
        return [
            KEY_VALUE => $value,
            KEY_OPERATOR => $operator,
            KEY_RELATIONSHIP_NAME => $relation,
        ];
    }

    /**
     * Set array of the query paginate.
     *
     * @param  int  $pageSize
     * @param  int  $pageDefault
     * @return array
     */
    public static function setQueryPaginate(int $pageDefault, int $pageSize = DEFAULT_LIMIT_PAGE): array
    {
        return [
            INPUT_PAGE_SIZE => $pageSize,
            INPUT_PAGE => $pageDefault,
        ];
    }

    /**
     * Set array of query order.
     *
     * @param $column
     * @param  string  $direction
     * @return array
     */
    public static function setQueryOrder($column, string $direction = ORDER_DESC): array
    {
        return [$column => $direction];
    }

    /**
     * Set array of relationship query input.
     *
     * @param  string  $name
     * @param  array  $select
     * @return array
     */
    public static function setRelationshipQueryInput(string $name, array $select = SELECT_ALL): array
    {
        return [
            KEY_RELATIONSHIP_NAME => $name,
            KEY_RELATIONSHIP_SELECT => $select,
        ];
    }

    /**
     * Set array of join query input.
     *
     * @param $table
     * @param $foreignKey
     * @param $primaryKey
     * @param  string  $type
     * @return array
     */
    public static function setJoinQueryInput($table, $foreignKey, $primaryKey, string $type = KEY_INNER_JOIN): array
    {
        return [
            KEY_TABLE => $table,
            KEY_FOREIGN_KEY => $foreignKey,
            KEY_PRIMARY_KEY => $primaryKey,
            KEY_TYPE_JOIN => $type,
        ];
    }

    /**
     * Set array of query filter.
     *
     * @param  array  $filter
     * @return array
     */
    public static function setQueryFilter($filter): array
    {
        return $filter;
    }
}
