<?php

// Magic number
const MAGIC_NUMBER = 81;

// Type system
const WEB = 1;
const MOBILE = 2;

// Optional
const INPUT_PAGE = 'page';
const INPUT_PAGE_SIZE = 'page_size';
const INPUT_LIMIT = 'limit';
const DEFAULT_LIMIT_PAGE = 20;
const UNLIMITED_PAGE = 9999;
const PAGE_DEFAULT = 1;
const PAGE_MAX = 4;

// Query constant
const SELECT_ALL = ['*'];
const ORDER_ASC = 'asc';
const ORDER_DESC = 'desc';

// Operator
const OPERATOR_LIKE = 'like';
const OPERATOR_EQUAL = '=';
const OPERATOR_NOT_EQUAL = '!=';
const OPERATOR_THAN_EQUAL = '>=';
const OPERATOR_LESS_EQUAL = '<=';
const OPERATOR_LESS = '<';

// Field
const FIELD_ID = 'id';
const FIELD_CREATED_AT = 'created_at';
const FIELD_UPDATED_AT = 'updated_at';
const FIELD_DELETED_AT = 'deleted_at';

const FIELD_CREATED_BY = 'created_by';

const FIELD_UPDATED_BY = 'updated_by';

// Regex
const REGEX_CREDENTIAL_VALIDATION = '/^[a-zA-Z0-9\s!\'"#$%&(){}*+,-.:;<=>?@^_`~[^|\\][^\\/\\][^\\\\\]]+$/';
const REGEX_PHONE = '/^\d{0,4}-?\d{0,4}-?\d{0,8}$/';
const REGEX_DATE_BETWEEN = '/^\d{2}\/\d{2}\/\d{4}\s-\s\d{2}\/\d{2}\/\d{4}$/';

// Status
const INACTIVE = 0;
const ACTIVE = 1;

// Role
const SUPER_ADMIN = 0;
const ADMIN = 1;
const CARELOG = 2;

// Key condition
const KEYWORD = 'keyword';
const KEY_LIMIT = 'limit';
const KEY_JOIN = 'join';
const KEY_LEFT_JOIN = 'left';
const KEY_INNER_JOIN = 'inner';
const KEY_RIGHT_JOIN = 'right';
const KEY_TABLE = 'table_name';
const KEY_FOREIGN_KEY = 'foreign_key';
const KEY_PRIMARY_KEY = 'primary_key';
const KEY_SORT = 'sort';
const KEY_PAGINATE = 'paginates';
const KEY_RELATE = 'relate';
const KEY_FILTER = 'filter';
const KEY_RELATIONSHIP_NAME = 'relationship_name';
const KEY_RELATIONSHIP_SELECT = 'relationship_select';
const KEY_OPERATOR = 'operator';
const KEY_OR_WHERE_IN = 'or_where_in';
const KEY_VALUE = 'value';
const KEY_COLUMN = 'column';
const KEY_TYPE_JOIN = 'type';
const KEY_OR_WHERE_NOT_IN = 'or_where_not_in';
const KEY_OR_WHERE_BETWEEN = 'or_where_between';
const KEY_OR_WHERE_NOT_BETWEEN = 'or_where_not_between';
const KEY_OR_WHERE_NULL = 'or_where_null';
const KEY_OR_WHERE_NOT_NULL = 'or_where_not_null';
const KEY_OR_WHERE = 'or_where';
const KEY_WHERE_IN = 'where_in';
const KEY_WHERE_NOT_IN = 'where_not_in';
const KEY_WHERE_BETWEEN = 'where_between';
const KEY_WHERE_NOT_BETWEEN = 'where_not_between';
const KEY_WHERE_NULL = 'where_null';
const KEY_WHERE_NOT_NULL = 'where_not_null';
const KEY_WHERE_DATE = 'where_date';
const KEY_WHERE_DATE_LESS = 'where_date_less';
const KEY_WHERE_HAS = 'where_has';
const KEY_WHERE_IN_VALUE_AND_NULL = 'where_in_column_or_null';
const KEY_WHERE_IN_VALUE_AND_NOT_NULL = 'where_in_column_and_not_null';
const KEY_LIKE_OR_WHERE = 'where_like_or_where';
const KEY_WHERE_HAS_LIKE = 'where_has_like';
const KEY_LIKE_WHERE = 'where_like';
const KEY_WHERE_HAS_BETWEEN = 'where_has_like_between';
const KEY_WHERE_NULL_OR_THAN_EQUAL = 'where_null_or_than_equal';

const KEY_SUCCESS = 'success';

const KEY_FAIL = 'fail';

const KEY_NOTIFICATION = 'notification';

// Format time
const YEAR_MONTH_DAY_NO_SLASH = 'Ymd';
const YEAR_MONTH_DAY_H_MIN_NO_SLASH = 'YmdHi';
const DAY_MONTH_YEAR = 'd/m/Y';
const YEAR_MONTH_DAY = 'Y-m-d';
const YEAR_MONTH_DATE = 'Y/m/d';
const JP_YEAR_MONTH_DATE = 'Y年m月d日';
const YEAR_MONTH_DAY_HIS = 'Y-m-d H:i:s';
const DAY_MONTH_YEAR_HIS = 'd/m/Y H:i';
const FIVE_YEAR = 5;
const YEAR = 'Y';
const TIME_FORMAT = 'H:i:s';
const HOUR_MINUTES_FORMAT = 'H:i';

const ZERO_PRICE = 0;
const BENEFIT_RATE = 100;
const BASE_SALARY = 500000;
const FULL_PERCENT = 100;
const FIFTEEN_PERCENT = 15;
const FIFTEEN_CHAR = 15;

// Regex
const REGEX_NUMBER = '/^[0-9]+$/';
const REGEX_NUMBER_INSURANCE_CADR = '/^[a-zA-Z0-9\+]+$/';
const REGEX_PATH_FILE_MEDICAL_TEST = '/storage\/medical_test\\\([^"]+\.(?:jpg|jpeg|png|gif))/i';
const REGEX_DELETE_FILE_MEDICAL_TEST = '/medical_test\\\([^"]+\.(?:jpg|jpeg|png|gif))/i';
const REGEX_DELETE_FILE_USER = '/users\\\([^"]+\.(?:jpg|jpeg|png|gif))/i';
const REGEX_DELETE_FILE_SETTING = '/settings\\\([^"]+\.(?:jpg|jpeg|png|gif))/i';
const REGEX_KANA_FULLWIDTH = '/^[\x{30A0}-\x{30FF}]+$/u';

//Type save
const SAVE_REAL = 'Lưu';
const SAVE_DRAFT = 'Lưu nháp';

const FIRST_TWO_RECORDS = 2;
// HeaLth insurance card code
const HEALTH_INSURANCE_CARD_CODE = [
    1, 2, 3, 4, 5,
];

const FIRST_KEY = 0;
const SECOND_KEY = 1;

const MSG = 'msg';

const MSG_ERROR = 'error';

const MSG_SUCCESS = 'success';

//Key params
const KEY_CONDITION = 'condition';

const KEY_OTHER = 'other';

const KEY_COLUMNS = 'columns';

// Value number
const ZERO = 0;
const MINIMUM = 1;
const LEAST = 10;
const MIN_FILE_SIZE = 2;

const IS_VALIDATE = 0;
const IS_IMPORT = 1;

// Limit table
const LIMIT_TABLE = [DEFAULT_LIMIT_PAGE, 50, 100];

const MAX_CHARACTER_DISPLAY = 255;
const MORE = '...';

// Days in month
const DAYS_IN_MONTH = 31;

// Thumbnail
const FOLDER_AVT = 'avatar';
const THUMBNAILS_APP_SIZE = 100;
const THUMBNAILS_WEB_SIZE = 150;
const THUMBNAILS_PREVIEW_SIZE = 972;

const THUMBNAILS = [
    THUMBNAILS_APP_SIZE,
    THUMBNAILS_WEB_SIZE,
    THUMBNAILS_PREVIEW_SIZE
];

const ONE_DAY = 24 * 60 * 60;

const FULL = '満';
