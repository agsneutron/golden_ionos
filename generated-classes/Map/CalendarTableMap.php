<?php

namespace Map;

use \Calendar;
use \CalendarQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'calendar' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class CalendarTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.CalendarTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'golden_clean';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'calendar';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Calendar';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Calendar';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 14;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 14;

    /**
     * the column name for the day field
     */
    const COL_DAY = 'calendar.day';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'calendar.name';

    /**
     * the column name for the year field
     */
    const COL_YEAR = 'calendar.year';

    /**
     * the column name for the month field
     */
    const COL_MONTH = 'calendar.month';

    /**
     * the column name for the month_number field
     */
    const COL_MONTH_NUMBER = 'calendar.month_number';

    /**
     * the column name for the day_of_the_year field
     */
    const COL_DAY_OF_THE_YEAR = 'calendar.day_of_the_year';

    /**
     * the column name for the weekday field
     */
    const COL_WEEKDAY = 'calendar.weekday';

    /**
     * the column name for the day_of_the_month field
     */
    const COL_DAY_OF_THE_MONTH = 'calendar.day_of_the_month';

    /**
     * the column name for the name_day field
     */
    const COL_NAME_DAY = 'calendar.name_day';

    /**
     * the column name for the short_name field
     */
    const COL_SHORT_NAME = 'calendar.short_name';

    /**
     * the column name for the week field
     */
    const COL_WEEK = 'calendar.week';

    /**
     * the column name for the bimester field
     */
    const COL_BIMESTER = 'calendar.bimester';

    /**
     * the column name for the trimester field
     */
    const COL_TRIMESTER = 'calendar.trimester';

    /**
     * the column name for the semestre field
     */
    const COL_SEMESTRE = 'calendar.semestre';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Day', 'Name', 'Year', 'Month', 'MonthNumber', 'DayOfTheYear', 'Weekday', 'DayOfTheMonth', 'NameDay', 'ShortName', 'Week', 'Bimester', 'Trimester', 'Semestre', ),
        self::TYPE_CAMELNAME     => array('day', 'name', 'year', 'month', 'monthNumber', 'dayOfTheYear', 'weekday', 'dayOfTheMonth', 'nameDay', 'shortName', 'week', 'bimester', 'trimester', 'semestre', ),
        self::TYPE_COLNAME       => array(CalendarTableMap::COL_DAY, CalendarTableMap::COL_NAME, CalendarTableMap::COL_YEAR, CalendarTableMap::COL_MONTH, CalendarTableMap::COL_MONTH_NUMBER, CalendarTableMap::COL_DAY_OF_THE_YEAR, CalendarTableMap::COL_WEEKDAY, CalendarTableMap::COL_DAY_OF_THE_MONTH, CalendarTableMap::COL_NAME_DAY, CalendarTableMap::COL_SHORT_NAME, CalendarTableMap::COL_WEEK, CalendarTableMap::COL_BIMESTER, CalendarTableMap::COL_TRIMESTER, CalendarTableMap::COL_SEMESTRE, ),
        self::TYPE_FIELDNAME     => array('day', 'name', 'year', 'month', 'month_number', 'day_of_the_year', 'weekday', 'day_of_the_month', 'name_day', 'short_name', 'week', 'bimester', 'trimester', 'semestre', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Day' => 0, 'Name' => 1, 'Year' => 2, 'Month' => 3, 'MonthNumber' => 4, 'DayOfTheYear' => 5, 'Weekday' => 6, 'DayOfTheMonth' => 7, 'NameDay' => 8, 'ShortName' => 9, 'Week' => 10, 'Bimester' => 11, 'Trimester' => 12, 'Semestre' => 13, ),
        self::TYPE_CAMELNAME     => array('day' => 0, 'name' => 1, 'year' => 2, 'month' => 3, 'monthNumber' => 4, 'dayOfTheYear' => 5, 'weekday' => 6, 'dayOfTheMonth' => 7, 'nameDay' => 8, 'shortName' => 9, 'week' => 10, 'bimester' => 11, 'trimester' => 12, 'semestre' => 13, ),
        self::TYPE_COLNAME       => array(CalendarTableMap::COL_DAY => 0, CalendarTableMap::COL_NAME => 1, CalendarTableMap::COL_YEAR => 2, CalendarTableMap::COL_MONTH => 3, CalendarTableMap::COL_MONTH_NUMBER => 4, CalendarTableMap::COL_DAY_OF_THE_YEAR => 5, CalendarTableMap::COL_WEEKDAY => 6, CalendarTableMap::COL_DAY_OF_THE_MONTH => 7, CalendarTableMap::COL_NAME_DAY => 8, CalendarTableMap::COL_SHORT_NAME => 9, CalendarTableMap::COL_WEEK => 10, CalendarTableMap::COL_BIMESTER => 11, CalendarTableMap::COL_TRIMESTER => 12, CalendarTableMap::COL_SEMESTRE => 13, ),
        self::TYPE_FIELDNAME     => array('day' => 0, 'name' => 1, 'year' => 2, 'month' => 3, 'month_number' => 4, 'day_of_the_year' => 5, 'weekday' => 6, 'day_of_the_month' => 7, 'name_day' => 8, 'short_name' => 9, 'week' => 10, 'bimester' => 11, 'trimester' => 12, 'semestre' => 13, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Day' => 'DAY',
        'Calendar.Day' => 'DAY',
        'day' => 'DAY',
        'calendar.day' => 'DAY',
        'CalendarTableMap::COL_DAY' => 'DAY',
        'COL_DAY' => 'DAY',
        'Name' => 'NAME',
        'Calendar.Name' => 'NAME',
        'name' => 'NAME',
        'calendar.name' => 'NAME',
        'CalendarTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'Year' => 'YEAR',
        'Calendar.Year' => 'YEAR',
        'year' => 'YEAR',
        'calendar.year' => 'YEAR',
        'CalendarTableMap::COL_YEAR' => 'YEAR',
        'COL_YEAR' => 'YEAR',
        'Month' => 'MONTH',
        'Calendar.Month' => 'MONTH',
        'month' => 'MONTH',
        'calendar.month' => 'MONTH',
        'CalendarTableMap::COL_MONTH' => 'MONTH',
        'COL_MONTH' => 'MONTH',
        'MonthNumber' => 'MONTH_NUMBER',
        'Calendar.MonthNumber' => 'MONTH_NUMBER',
        'monthNumber' => 'MONTH_NUMBER',
        'calendar.monthNumber' => 'MONTH_NUMBER',
        'CalendarTableMap::COL_MONTH_NUMBER' => 'MONTH_NUMBER',
        'COL_MONTH_NUMBER' => 'MONTH_NUMBER',
        'month_number' => 'MONTH_NUMBER',
        'calendar.month_number' => 'MONTH_NUMBER',
        'DayOfTheYear' => 'DAY_OF_THE_YEAR',
        'Calendar.DayOfTheYear' => 'DAY_OF_THE_YEAR',
        'dayOfTheYear' => 'DAY_OF_THE_YEAR',
        'calendar.dayOfTheYear' => 'DAY_OF_THE_YEAR',
        'CalendarTableMap::COL_DAY_OF_THE_YEAR' => 'DAY_OF_THE_YEAR',
        'COL_DAY_OF_THE_YEAR' => 'DAY_OF_THE_YEAR',
        'day_of_the_year' => 'DAY_OF_THE_YEAR',
        'calendar.day_of_the_year' => 'DAY_OF_THE_YEAR',
        'Weekday' => 'WEEKDAY',
        'Calendar.Weekday' => 'WEEKDAY',
        'weekday' => 'WEEKDAY',
        'calendar.weekday' => 'WEEKDAY',
        'CalendarTableMap::COL_WEEKDAY' => 'WEEKDAY',
        'COL_WEEKDAY' => 'WEEKDAY',
        'DayOfTheMonth' => 'DAY_OF_THE_MONTH',
        'Calendar.DayOfTheMonth' => 'DAY_OF_THE_MONTH',
        'dayOfTheMonth' => 'DAY_OF_THE_MONTH',
        'calendar.dayOfTheMonth' => 'DAY_OF_THE_MONTH',
        'CalendarTableMap::COL_DAY_OF_THE_MONTH' => 'DAY_OF_THE_MONTH',
        'COL_DAY_OF_THE_MONTH' => 'DAY_OF_THE_MONTH',
        'day_of_the_month' => 'DAY_OF_THE_MONTH',
        'calendar.day_of_the_month' => 'DAY_OF_THE_MONTH',
        'NameDay' => 'NAME_DAY',
        'Calendar.NameDay' => 'NAME_DAY',
        'nameDay' => 'NAME_DAY',
        'calendar.nameDay' => 'NAME_DAY',
        'CalendarTableMap::COL_NAME_DAY' => 'NAME_DAY',
        'COL_NAME_DAY' => 'NAME_DAY',
        'name_day' => 'NAME_DAY',
        'calendar.name_day' => 'NAME_DAY',
        'ShortName' => 'SHORT_NAME',
        'Calendar.ShortName' => 'SHORT_NAME',
        'shortName' => 'SHORT_NAME',
        'calendar.shortName' => 'SHORT_NAME',
        'CalendarTableMap::COL_SHORT_NAME' => 'SHORT_NAME',
        'COL_SHORT_NAME' => 'SHORT_NAME',
        'short_name' => 'SHORT_NAME',
        'calendar.short_name' => 'SHORT_NAME',
        'Week' => 'WEEK',
        'Calendar.Week' => 'WEEK',
        'week' => 'WEEK',
        'calendar.week' => 'WEEK',
        'CalendarTableMap::COL_WEEK' => 'WEEK',
        'COL_WEEK' => 'WEEK',
        'Bimester' => 'BIMESTER',
        'Calendar.Bimester' => 'BIMESTER',
        'bimester' => 'BIMESTER',
        'calendar.bimester' => 'BIMESTER',
        'CalendarTableMap::COL_BIMESTER' => 'BIMESTER',
        'COL_BIMESTER' => 'BIMESTER',
        'Trimester' => 'TRIMESTER',
        'Calendar.Trimester' => 'TRIMESTER',
        'trimester' => 'TRIMESTER',
        'calendar.trimester' => 'TRIMESTER',
        'CalendarTableMap::COL_TRIMESTER' => 'TRIMESTER',
        'COL_TRIMESTER' => 'TRIMESTER',
        'Semestre' => 'SEMESTRE',
        'Calendar.Semestre' => 'SEMESTRE',
        'semestre' => 'SEMESTRE',
        'calendar.semestre' => 'SEMESTRE',
        'CalendarTableMap::COL_SEMESTRE' => 'SEMESTRE',
        'COL_SEMESTRE' => 'SEMESTRE',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('calendar');
        $this->setPhpName('Calendar');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Calendar');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('day', 'Day', 'DATE', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 70, null);
        $this->addColumn('year', 'Year', 'INTEGER', true, 10, null);
        $this->addColumn('month', 'Month', 'VARCHAR', true, 15, null);
        $this->addColumn('month_number', 'MonthNumber', 'INTEGER', true, 10, null);
        $this->addColumn('day_of_the_year', 'DayOfTheYear', 'INTEGER', true, 10, null);
        $this->addColumn('weekday', 'Weekday', 'INTEGER', true, 10, null);
        $this->addColumn('day_of_the_month', 'DayOfTheMonth', 'INTEGER', true, 10, null);
        $this->addColumn('name_day', 'NameDay', 'VARCHAR', true, 15, null);
        $this->addColumn('short_name', 'ShortName', 'VARCHAR', true, 15, null);
        $this->addColumn('week', 'Week', 'INTEGER', true, 10, null);
        $this->addColumn('bimester', 'Bimester', 'INTEGER', true, 10, null);
        $this->addColumn('trimester', 'Trimester', 'INTEGER', true, 10, null);
        $this->addColumn('semestre', 'Semestre', 'INTEGER', true, 10, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Deliveries', '\\Deliveries', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':day_delivery',
    1 => ':day',
  ),
), null, 'CASCADE', 'Deliveriess', false);
        $this->addRelation('Pickups', '\\Pickups', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':day_pickup',
    1 => ':day',
  ),
), null, 'CASCADE', 'Pickupss', false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Day', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Day', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Day', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Day', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Day', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Day', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Day', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? CalendarTableMap::CLASS_DEFAULT : CalendarTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Calendar object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CalendarTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CalendarTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CalendarTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CalendarTableMap::OM_CLASS;
            /** @var Calendar $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CalendarTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = CalendarTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CalendarTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Calendar $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CalendarTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(CalendarTableMap::COL_DAY);
            $criteria->addSelectColumn(CalendarTableMap::COL_NAME);
            $criteria->addSelectColumn(CalendarTableMap::COL_YEAR);
            $criteria->addSelectColumn(CalendarTableMap::COL_MONTH);
            $criteria->addSelectColumn(CalendarTableMap::COL_MONTH_NUMBER);
            $criteria->addSelectColumn(CalendarTableMap::COL_DAY_OF_THE_YEAR);
            $criteria->addSelectColumn(CalendarTableMap::COL_WEEKDAY);
            $criteria->addSelectColumn(CalendarTableMap::COL_DAY_OF_THE_MONTH);
            $criteria->addSelectColumn(CalendarTableMap::COL_NAME_DAY);
            $criteria->addSelectColumn(CalendarTableMap::COL_SHORT_NAME);
            $criteria->addSelectColumn(CalendarTableMap::COL_WEEK);
            $criteria->addSelectColumn(CalendarTableMap::COL_BIMESTER);
            $criteria->addSelectColumn(CalendarTableMap::COL_TRIMESTER);
            $criteria->addSelectColumn(CalendarTableMap::COL_SEMESTRE);
        } else {
            $criteria->addSelectColumn($alias . '.day');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.year');
            $criteria->addSelectColumn($alias . '.month');
            $criteria->addSelectColumn($alias . '.month_number');
            $criteria->addSelectColumn($alias . '.day_of_the_year');
            $criteria->addSelectColumn($alias . '.weekday');
            $criteria->addSelectColumn($alias . '.day_of_the_month');
            $criteria->addSelectColumn($alias . '.name_day');
            $criteria->addSelectColumn($alias . '.short_name');
            $criteria->addSelectColumn($alias . '.week');
            $criteria->addSelectColumn($alias . '.bimester');
            $criteria->addSelectColumn($alias . '.trimester');
            $criteria->addSelectColumn($alias . '.semestre');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria object containing the columns to remove.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function removeSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(CalendarTableMap::COL_DAY);
            $criteria->removeSelectColumn(CalendarTableMap::COL_NAME);
            $criteria->removeSelectColumn(CalendarTableMap::COL_YEAR);
            $criteria->removeSelectColumn(CalendarTableMap::COL_MONTH);
            $criteria->removeSelectColumn(CalendarTableMap::COL_MONTH_NUMBER);
            $criteria->removeSelectColumn(CalendarTableMap::COL_DAY_OF_THE_YEAR);
            $criteria->removeSelectColumn(CalendarTableMap::COL_WEEKDAY);
            $criteria->removeSelectColumn(CalendarTableMap::COL_DAY_OF_THE_MONTH);
            $criteria->removeSelectColumn(CalendarTableMap::COL_NAME_DAY);
            $criteria->removeSelectColumn(CalendarTableMap::COL_SHORT_NAME);
            $criteria->removeSelectColumn(CalendarTableMap::COL_WEEK);
            $criteria->removeSelectColumn(CalendarTableMap::COL_BIMESTER);
            $criteria->removeSelectColumn(CalendarTableMap::COL_TRIMESTER);
            $criteria->removeSelectColumn(CalendarTableMap::COL_SEMESTRE);
        } else {
            $criteria->removeSelectColumn($alias . '.day');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.year');
            $criteria->removeSelectColumn($alias . '.month');
            $criteria->removeSelectColumn($alias . '.month_number');
            $criteria->removeSelectColumn($alias . '.day_of_the_year');
            $criteria->removeSelectColumn($alias . '.weekday');
            $criteria->removeSelectColumn($alias . '.day_of_the_month');
            $criteria->removeSelectColumn($alias . '.name_day');
            $criteria->removeSelectColumn($alias . '.short_name');
            $criteria->removeSelectColumn($alias . '.week');
            $criteria->removeSelectColumn($alias . '.bimester');
            $criteria->removeSelectColumn($alias . '.trimester');
            $criteria->removeSelectColumn($alias . '.semestre');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(CalendarTableMap::DATABASE_NAME)->getTable(CalendarTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Calendar or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Calendar object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CalendarTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Calendar) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CalendarTableMap::DATABASE_NAME);
            $criteria->add(CalendarTableMap::COL_DAY, (array) $values, Criteria::IN);
        }

        $query = CalendarQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CalendarTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CalendarTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the calendar table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CalendarQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Calendar or Criteria object.
     *
     * @param mixed               $criteria Criteria or Calendar object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CalendarTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Calendar object
        }


        // Set the correct dbName
        $query = CalendarQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CalendarTableMap
