<?php

namespace Base;

use \Calendar as ChildCalendar;
use \CalendarQuery as ChildCalendarQuery;
use \Exception;
use \PDO;
use Map\CalendarTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'calendar' table.
 *
 *
 *
 * @method     ChildCalendarQuery orderByDay($order = Criteria::ASC) Order by the day column
 * @method     ChildCalendarQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildCalendarQuery orderByYear($order = Criteria::ASC) Order by the year column
 * @method     ChildCalendarQuery orderByMonth($order = Criteria::ASC) Order by the month column
 * @method     ChildCalendarQuery orderByMonthNumber($order = Criteria::ASC) Order by the month_number column
 * @method     ChildCalendarQuery orderByDayOfTheYear($order = Criteria::ASC) Order by the day_of_the_year column
 * @method     ChildCalendarQuery orderByWeekday($order = Criteria::ASC) Order by the weekday column
 * @method     ChildCalendarQuery orderByDayOfTheMonth($order = Criteria::ASC) Order by the day_of_the_month column
 * @method     ChildCalendarQuery orderByNameDay($order = Criteria::ASC) Order by the name_day column
 * @method     ChildCalendarQuery orderByShortName($order = Criteria::ASC) Order by the short_name column
 * @method     ChildCalendarQuery orderByWeek($order = Criteria::ASC) Order by the week column
 * @method     ChildCalendarQuery orderByBimester($order = Criteria::ASC) Order by the bimester column
 * @method     ChildCalendarQuery orderByTrimester($order = Criteria::ASC) Order by the trimester column
 * @method     ChildCalendarQuery orderBySemestre($order = Criteria::ASC) Order by the semestre column
 *
 * @method     ChildCalendarQuery groupByDay() Group by the day column
 * @method     ChildCalendarQuery groupByName() Group by the name column
 * @method     ChildCalendarQuery groupByYear() Group by the year column
 * @method     ChildCalendarQuery groupByMonth() Group by the month column
 * @method     ChildCalendarQuery groupByMonthNumber() Group by the month_number column
 * @method     ChildCalendarQuery groupByDayOfTheYear() Group by the day_of_the_year column
 * @method     ChildCalendarQuery groupByWeekday() Group by the weekday column
 * @method     ChildCalendarQuery groupByDayOfTheMonth() Group by the day_of_the_month column
 * @method     ChildCalendarQuery groupByNameDay() Group by the name_day column
 * @method     ChildCalendarQuery groupByShortName() Group by the short_name column
 * @method     ChildCalendarQuery groupByWeek() Group by the week column
 * @method     ChildCalendarQuery groupByBimester() Group by the bimester column
 * @method     ChildCalendarQuery groupByTrimester() Group by the trimester column
 * @method     ChildCalendarQuery groupBySemestre() Group by the semestre column
 *
 * @method     ChildCalendarQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCalendarQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCalendarQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCalendarQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCalendarQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCalendarQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCalendarQuery leftJoinDeliveries($relationAlias = null) Adds a LEFT JOIN clause to the query using the Deliveries relation
 * @method     ChildCalendarQuery rightJoinDeliveries($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Deliveries relation
 * @method     ChildCalendarQuery innerJoinDeliveries($relationAlias = null) Adds a INNER JOIN clause to the query using the Deliveries relation
 *
 * @method     ChildCalendarQuery joinWithDeliveries($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Deliveries relation
 *
 * @method     ChildCalendarQuery leftJoinWithDeliveries() Adds a LEFT JOIN clause and with to the query using the Deliveries relation
 * @method     ChildCalendarQuery rightJoinWithDeliveries() Adds a RIGHT JOIN clause and with to the query using the Deliveries relation
 * @method     ChildCalendarQuery innerJoinWithDeliveries() Adds a INNER JOIN clause and with to the query using the Deliveries relation
 *
 * @method     ChildCalendarQuery leftJoinPickups($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pickups relation
 * @method     ChildCalendarQuery rightJoinPickups($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pickups relation
 * @method     ChildCalendarQuery innerJoinPickups($relationAlias = null) Adds a INNER JOIN clause to the query using the Pickups relation
 *
 * @method     ChildCalendarQuery joinWithPickups($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Pickups relation
 *
 * @method     ChildCalendarQuery leftJoinWithPickups() Adds a LEFT JOIN clause and with to the query using the Pickups relation
 * @method     ChildCalendarQuery rightJoinWithPickups() Adds a RIGHT JOIN clause and with to the query using the Pickups relation
 * @method     ChildCalendarQuery innerJoinWithPickups() Adds a INNER JOIN clause and with to the query using the Pickups relation
 *
 * @method     \DeliveriesQuery|\PickupsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCalendar|null findOne(ConnectionInterface $con = null) Return the first ChildCalendar matching the query
 * @method     ChildCalendar findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCalendar matching the query, or a new ChildCalendar object populated from the query conditions when no match is found
 *
 * @method     ChildCalendar|null findOneByDay(string $day) Return the first ChildCalendar filtered by the day column
 * @method     ChildCalendar|null findOneByName(string $name) Return the first ChildCalendar filtered by the name column
 * @method     ChildCalendar|null findOneByYear(int $year) Return the first ChildCalendar filtered by the year column
 * @method     ChildCalendar|null findOneByMonth(string $month) Return the first ChildCalendar filtered by the month column
 * @method     ChildCalendar|null findOneByMonthNumber(int $month_number) Return the first ChildCalendar filtered by the month_number column
 * @method     ChildCalendar|null findOneByDayOfTheYear(int $day_of_the_year) Return the first ChildCalendar filtered by the day_of_the_year column
 * @method     ChildCalendar|null findOneByWeekday(int $weekday) Return the first ChildCalendar filtered by the weekday column
 * @method     ChildCalendar|null findOneByDayOfTheMonth(int $day_of_the_month) Return the first ChildCalendar filtered by the day_of_the_month column
 * @method     ChildCalendar|null findOneByNameDay(string $name_day) Return the first ChildCalendar filtered by the name_day column
 * @method     ChildCalendar|null findOneByShortName(string $short_name) Return the first ChildCalendar filtered by the short_name column
 * @method     ChildCalendar|null findOneByWeek(int $week) Return the first ChildCalendar filtered by the week column
 * @method     ChildCalendar|null findOneByBimester(int $bimester) Return the first ChildCalendar filtered by the bimester column
 * @method     ChildCalendar|null findOneByTrimester(int $trimester) Return the first ChildCalendar filtered by the trimester column
 * @method     ChildCalendar|null findOneBySemestre(int $semestre) Return the first ChildCalendar filtered by the semestre column *

 * @method     ChildCalendar requirePk($key, ConnectionInterface $con = null) Return the ChildCalendar by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendar requireOne(ConnectionInterface $con = null) Return the first ChildCalendar matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCalendar requireOneByDay(string $day) Return the first ChildCalendar filtered by the day column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendar requireOneByName(string $name) Return the first ChildCalendar filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendar requireOneByYear(int $year) Return the first ChildCalendar filtered by the year column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendar requireOneByMonth(string $month) Return the first ChildCalendar filtered by the month column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendar requireOneByMonthNumber(int $month_number) Return the first ChildCalendar filtered by the month_number column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendar requireOneByDayOfTheYear(int $day_of_the_year) Return the first ChildCalendar filtered by the day_of_the_year column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendar requireOneByWeekday(int $weekday) Return the first ChildCalendar filtered by the weekday column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendar requireOneByDayOfTheMonth(int $day_of_the_month) Return the first ChildCalendar filtered by the day_of_the_month column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendar requireOneByNameDay(string $name_day) Return the first ChildCalendar filtered by the name_day column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendar requireOneByShortName(string $short_name) Return the first ChildCalendar filtered by the short_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendar requireOneByWeek(int $week) Return the first ChildCalendar filtered by the week column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendar requireOneByBimester(int $bimester) Return the first ChildCalendar filtered by the bimester column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendar requireOneByTrimester(int $trimester) Return the first ChildCalendar filtered by the trimester column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCalendar requireOneBySemestre(int $semestre) Return the first ChildCalendar filtered by the semestre column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCalendar[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCalendar objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildCalendar> find(ConnectionInterface $con = null) Return ChildCalendar objects based on current ModelCriteria
 * @method     ChildCalendar[]|ObjectCollection findByDay(string $day) Return ChildCalendar objects filtered by the day column
 * @psalm-method ObjectCollection&\Traversable<ChildCalendar> findByDay(string $day) Return ChildCalendar objects filtered by the day column
 * @method     ChildCalendar[]|ObjectCollection findByName(string $name) Return ChildCalendar objects filtered by the name column
 * @psalm-method ObjectCollection&\Traversable<ChildCalendar> findByName(string $name) Return ChildCalendar objects filtered by the name column
 * @method     ChildCalendar[]|ObjectCollection findByYear(int $year) Return ChildCalendar objects filtered by the year column
 * @psalm-method ObjectCollection&\Traversable<ChildCalendar> findByYear(int $year) Return ChildCalendar objects filtered by the year column
 * @method     ChildCalendar[]|ObjectCollection findByMonth(string $month) Return ChildCalendar objects filtered by the month column
 * @psalm-method ObjectCollection&\Traversable<ChildCalendar> findByMonth(string $month) Return ChildCalendar objects filtered by the month column
 * @method     ChildCalendar[]|ObjectCollection findByMonthNumber(int $month_number) Return ChildCalendar objects filtered by the month_number column
 * @psalm-method ObjectCollection&\Traversable<ChildCalendar> findByMonthNumber(int $month_number) Return ChildCalendar objects filtered by the month_number column
 * @method     ChildCalendar[]|ObjectCollection findByDayOfTheYear(int $day_of_the_year) Return ChildCalendar objects filtered by the day_of_the_year column
 * @psalm-method ObjectCollection&\Traversable<ChildCalendar> findByDayOfTheYear(int $day_of_the_year) Return ChildCalendar objects filtered by the day_of_the_year column
 * @method     ChildCalendar[]|ObjectCollection findByWeekday(int $weekday) Return ChildCalendar objects filtered by the weekday column
 * @psalm-method ObjectCollection&\Traversable<ChildCalendar> findByWeekday(int $weekday) Return ChildCalendar objects filtered by the weekday column
 * @method     ChildCalendar[]|ObjectCollection findByDayOfTheMonth(int $day_of_the_month) Return ChildCalendar objects filtered by the day_of_the_month column
 * @psalm-method ObjectCollection&\Traversable<ChildCalendar> findByDayOfTheMonth(int $day_of_the_month) Return ChildCalendar objects filtered by the day_of_the_month column
 * @method     ChildCalendar[]|ObjectCollection findByNameDay(string $name_day) Return ChildCalendar objects filtered by the name_day column
 * @psalm-method ObjectCollection&\Traversable<ChildCalendar> findByNameDay(string $name_day) Return ChildCalendar objects filtered by the name_day column
 * @method     ChildCalendar[]|ObjectCollection findByShortName(string $short_name) Return ChildCalendar objects filtered by the short_name column
 * @psalm-method ObjectCollection&\Traversable<ChildCalendar> findByShortName(string $short_name) Return ChildCalendar objects filtered by the short_name column
 * @method     ChildCalendar[]|ObjectCollection findByWeek(int $week) Return ChildCalendar objects filtered by the week column
 * @psalm-method ObjectCollection&\Traversable<ChildCalendar> findByWeek(int $week) Return ChildCalendar objects filtered by the week column
 * @method     ChildCalendar[]|ObjectCollection findByBimester(int $bimester) Return ChildCalendar objects filtered by the bimester column
 * @psalm-method ObjectCollection&\Traversable<ChildCalendar> findByBimester(int $bimester) Return ChildCalendar objects filtered by the bimester column
 * @method     ChildCalendar[]|ObjectCollection findByTrimester(int $trimester) Return ChildCalendar objects filtered by the trimester column
 * @psalm-method ObjectCollection&\Traversable<ChildCalendar> findByTrimester(int $trimester) Return ChildCalendar objects filtered by the trimester column
 * @method     ChildCalendar[]|ObjectCollection findBySemestre(int $semestre) Return ChildCalendar objects filtered by the semestre column
 * @psalm-method ObjectCollection&\Traversable<ChildCalendar> findBySemestre(int $semestre) Return ChildCalendar objects filtered by the semestre column
 * @method     ChildCalendar[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildCalendar> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CalendarQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\CalendarQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'golden_clean', $modelName = '\\Calendar', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCalendarQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCalendarQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCalendarQuery) {
            return $criteria;
        }
        $query = new ChildCalendarQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildCalendar|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CalendarTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CalendarTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCalendar A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT day, name, year, month, month_number, day_of_the_year, weekday, day_of_the_month, name_day, short_name, week, bimester, trimester, semestre FROM calendar WHERE day = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key ? $key->format("Y-m-d") : null, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildCalendar $obj */
            $obj = new ChildCalendar();
            $obj->hydrate($row);
            CalendarTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildCalendar|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildCalendarQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CalendarTableMap::COL_DAY, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCalendarQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CalendarTableMap::COL_DAY, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the day column
     *
     * Example usage:
     * <code>
     * $query->filterByDay('2011-03-14'); // WHERE day = '2011-03-14'
     * $query->filterByDay('now'); // WHERE day = '2011-03-14'
     * $query->filterByDay(array('max' => 'yesterday')); // WHERE day > '2011-03-13'
     * </code>
     *
     * @param     mixed $day The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarQuery The current query, for fluid interface
     */
    public function filterByDay($day = null, $comparison = null)
    {
        if (is_array($day)) {
            $useMinMax = false;
            if (isset($day['min'])) {
                $this->addUsingAlias(CalendarTableMap::COL_DAY, $day['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($day['max'])) {
                $this->addUsingAlias(CalendarTableMap::COL_DAY, $day['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarTableMap::COL_DAY, $day, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the year column
     *
     * Example usage:
     * <code>
     * $query->filterByYear(1234); // WHERE year = 1234
     * $query->filterByYear(array(12, 34)); // WHERE year IN (12, 34)
     * $query->filterByYear(array('min' => 12)); // WHERE year > 12
     * </code>
     *
     * @param     mixed $year The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarQuery The current query, for fluid interface
     */
    public function filterByYear($year = null, $comparison = null)
    {
        if (is_array($year)) {
            $useMinMax = false;
            if (isset($year['min'])) {
                $this->addUsingAlias(CalendarTableMap::COL_YEAR, $year['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($year['max'])) {
                $this->addUsingAlias(CalendarTableMap::COL_YEAR, $year['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarTableMap::COL_YEAR, $year, $comparison);
    }

    /**
     * Filter the query on the month column
     *
     * Example usage:
     * <code>
     * $query->filterByMonth('fooValue');   // WHERE month = 'fooValue'
     * $query->filterByMonth('%fooValue%', Criteria::LIKE); // WHERE month LIKE '%fooValue%'
     * </code>
     *
     * @param     string $month The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarQuery The current query, for fluid interface
     */
    public function filterByMonth($month = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($month)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarTableMap::COL_MONTH, $month, $comparison);
    }

    /**
     * Filter the query on the month_number column
     *
     * Example usage:
     * <code>
     * $query->filterByMonthNumber(1234); // WHERE month_number = 1234
     * $query->filterByMonthNumber(array(12, 34)); // WHERE month_number IN (12, 34)
     * $query->filterByMonthNumber(array('min' => 12)); // WHERE month_number > 12
     * </code>
     *
     * @param     mixed $monthNumber The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarQuery The current query, for fluid interface
     */
    public function filterByMonthNumber($monthNumber = null, $comparison = null)
    {
        if (is_array($monthNumber)) {
            $useMinMax = false;
            if (isset($monthNumber['min'])) {
                $this->addUsingAlias(CalendarTableMap::COL_MONTH_NUMBER, $monthNumber['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($monthNumber['max'])) {
                $this->addUsingAlias(CalendarTableMap::COL_MONTH_NUMBER, $monthNumber['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarTableMap::COL_MONTH_NUMBER, $monthNumber, $comparison);
    }

    /**
     * Filter the query on the day_of_the_year column
     *
     * Example usage:
     * <code>
     * $query->filterByDayOfTheYear(1234); // WHERE day_of_the_year = 1234
     * $query->filterByDayOfTheYear(array(12, 34)); // WHERE day_of_the_year IN (12, 34)
     * $query->filterByDayOfTheYear(array('min' => 12)); // WHERE day_of_the_year > 12
     * </code>
     *
     * @param     mixed $dayOfTheYear The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarQuery The current query, for fluid interface
     */
    public function filterByDayOfTheYear($dayOfTheYear = null, $comparison = null)
    {
        if (is_array($dayOfTheYear)) {
            $useMinMax = false;
            if (isset($dayOfTheYear['min'])) {
                $this->addUsingAlias(CalendarTableMap::COL_DAY_OF_THE_YEAR, $dayOfTheYear['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dayOfTheYear['max'])) {
                $this->addUsingAlias(CalendarTableMap::COL_DAY_OF_THE_YEAR, $dayOfTheYear['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarTableMap::COL_DAY_OF_THE_YEAR, $dayOfTheYear, $comparison);
    }

    /**
     * Filter the query on the weekday column
     *
     * Example usage:
     * <code>
     * $query->filterByWeekday(1234); // WHERE weekday = 1234
     * $query->filterByWeekday(array(12, 34)); // WHERE weekday IN (12, 34)
     * $query->filterByWeekday(array('min' => 12)); // WHERE weekday > 12
     * </code>
     *
     * @param     mixed $weekday The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarQuery The current query, for fluid interface
     */
    public function filterByWeekday($weekday = null, $comparison = null)
    {
        if (is_array($weekday)) {
            $useMinMax = false;
            if (isset($weekday['min'])) {
                $this->addUsingAlias(CalendarTableMap::COL_WEEKDAY, $weekday['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($weekday['max'])) {
                $this->addUsingAlias(CalendarTableMap::COL_WEEKDAY, $weekday['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarTableMap::COL_WEEKDAY, $weekday, $comparison);
    }

    /**
     * Filter the query on the day_of_the_month column
     *
     * Example usage:
     * <code>
     * $query->filterByDayOfTheMonth(1234); // WHERE day_of_the_month = 1234
     * $query->filterByDayOfTheMonth(array(12, 34)); // WHERE day_of_the_month IN (12, 34)
     * $query->filterByDayOfTheMonth(array('min' => 12)); // WHERE day_of_the_month > 12
     * </code>
     *
     * @param     mixed $dayOfTheMonth The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarQuery The current query, for fluid interface
     */
    public function filterByDayOfTheMonth($dayOfTheMonth = null, $comparison = null)
    {
        if (is_array($dayOfTheMonth)) {
            $useMinMax = false;
            if (isset($dayOfTheMonth['min'])) {
                $this->addUsingAlias(CalendarTableMap::COL_DAY_OF_THE_MONTH, $dayOfTheMonth['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dayOfTheMonth['max'])) {
                $this->addUsingAlias(CalendarTableMap::COL_DAY_OF_THE_MONTH, $dayOfTheMonth['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarTableMap::COL_DAY_OF_THE_MONTH, $dayOfTheMonth, $comparison);
    }

    /**
     * Filter the query on the name_day column
     *
     * Example usage:
     * <code>
     * $query->filterByNameDay('fooValue');   // WHERE name_day = 'fooValue'
     * $query->filterByNameDay('%fooValue%', Criteria::LIKE); // WHERE name_day LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nameDay The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarQuery The current query, for fluid interface
     */
    public function filterByNameDay($nameDay = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nameDay)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarTableMap::COL_NAME_DAY, $nameDay, $comparison);
    }

    /**
     * Filter the query on the short_name column
     *
     * Example usage:
     * <code>
     * $query->filterByShortName('fooValue');   // WHERE short_name = 'fooValue'
     * $query->filterByShortName('%fooValue%', Criteria::LIKE); // WHERE short_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $shortName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarQuery The current query, for fluid interface
     */
    public function filterByShortName($shortName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($shortName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarTableMap::COL_SHORT_NAME, $shortName, $comparison);
    }

    /**
     * Filter the query on the week column
     *
     * Example usage:
     * <code>
     * $query->filterByWeek(1234); // WHERE week = 1234
     * $query->filterByWeek(array(12, 34)); // WHERE week IN (12, 34)
     * $query->filterByWeek(array('min' => 12)); // WHERE week > 12
     * </code>
     *
     * @param     mixed $week The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarQuery The current query, for fluid interface
     */
    public function filterByWeek($week = null, $comparison = null)
    {
        if (is_array($week)) {
            $useMinMax = false;
            if (isset($week['min'])) {
                $this->addUsingAlias(CalendarTableMap::COL_WEEK, $week['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($week['max'])) {
                $this->addUsingAlias(CalendarTableMap::COL_WEEK, $week['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarTableMap::COL_WEEK, $week, $comparison);
    }

    /**
     * Filter the query on the bimester column
     *
     * Example usage:
     * <code>
     * $query->filterByBimester(1234); // WHERE bimester = 1234
     * $query->filterByBimester(array(12, 34)); // WHERE bimester IN (12, 34)
     * $query->filterByBimester(array('min' => 12)); // WHERE bimester > 12
     * </code>
     *
     * @param     mixed $bimester The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarQuery The current query, for fluid interface
     */
    public function filterByBimester($bimester = null, $comparison = null)
    {
        if (is_array($bimester)) {
            $useMinMax = false;
            if (isset($bimester['min'])) {
                $this->addUsingAlias(CalendarTableMap::COL_BIMESTER, $bimester['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bimester['max'])) {
                $this->addUsingAlias(CalendarTableMap::COL_BIMESTER, $bimester['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarTableMap::COL_BIMESTER, $bimester, $comparison);
    }

    /**
     * Filter the query on the trimester column
     *
     * Example usage:
     * <code>
     * $query->filterByTrimester(1234); // WHERE trimester = 1234
     * $query->filterByTrimester(array(12, 34)); // WHERE trimester IN (12, 34)
     * $query->filterByTrimester(array('min' => 12)); // WHERE trimester > 12
     * </code>
     *
     * @param     mixed $trimester The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarQuery The current query, for fluid interface
     */
    public function filterByTrimester($trimester = null, $comparison = null)
    {
        if (is_array($trimester)) {
            $useMinMax = false;
            if (isset($trimester['min'])) {
                $this->addUsingAlias(CalendarTableMap::COL_TRIMESTER, $trimester['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($trimester['max'])) {
                $this->addUsingAlias(CalendarTableMap::COL_TRIMESTER, $trimester['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarTableMap::COL_TRIMESTER, $trimester, $comparison);
    }

    /**
     * Filter the query on the semestre column
     *
     * Example usage:
     * <code>
     * $query->filterBySemestre(1234); // WHERE semestre = 1234
     * $query->filterBySemestre(array(12, 34)); // WHERE semestre IN (12, 34)
     * $query->filterBySemestre(array('min' => 12)); // WHERE semestre > 12
     * </code>
     *
     * @param     mixed $semestre The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCalendarQuery The current query, for fluid interface
     */
    public function filterBySemestre($semestre = null, $comparison = null)
    {
        if (is_array($semestre)) {
            $useMinMax = false;
            if (isset($semestre['min'])) {
                $this->addUsingAlias(CalendarTableMap::COL_SEMESTRE, $semestre['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($semestre['max'])) {
                $this->addUsingAlias(CalendarTableMap::COL_SEMESTRE, $semestre['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CalendarTableMap::COL_SEMESTRE, $semestre, $comparison);
    }

    /**
     * Filter the query by a related \Deliveries object
     *
     * @param \Deliveries|ObjectCollection $deliveries the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCalendarQuery The current query, for fluid interface
     */
    public function filterByDeliveries($deliveries, $comparison = null)
    {
        if ($deliveries instanceof \Deliveries) {
            return $this
                ->addUsingAlias(CalendarTableMap::COL_DAY, $deliveries->getDayDelivery(), $comparison);
        } elseif ($deliveries instanceof ObjectCollection) {
            return $this
                ->useDeliveriesQuery()
                ->filterByPrimaryKeys($deliveries->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDeliveries() only accepts arguments of type \Deliveries or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Deliveries relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCalendarQuery The current query, for fluid interface
     */
    public function joinDeliveries($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Deliveries');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Deliveries');
        }

        return $this;
    }

    /**
     * Use the Deliveries relation Deliveries object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DeliveriesQuery A secondary query class using the current class as primary query
     */
    public function useDeliveriesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDeliveries($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Deliveries', '\DeliveriesQuery');
    }

    /**
     * Use the Deliveries relation Deliveries object
     *
     * @param callable(\DeliveriesQuery):\DeliveriesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDeliveriesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useDeliveriesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Deliveries table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DeliveriesQuery The inner query object of the EXISTS statement
     */
    public function useDeliveriesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Deliveries', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Deliveries table for a NOT EXISTS query.
     *
     * @see useDeliveriesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DeliveriesQuery The inner query object of the NOT EXISTS statement
     */
    public function useDeliveriesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Deliveries', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Pickups object
     *
     * @param \Pickups|ObjectCollection $pickups the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCalendarQuery The current query, for fluid interface
     */
    public function filterByPickups($pickups, $comparison = null)
    {
        if ($pickups instanceof \Pickups) {
            return $this
                ->addUsingAlias(CalendarTableMap::COL_DAY, $pickups->getDayPickup(), $comparison);
        } elseif ($pickups instanceof ObjectCollection) {
            return $this
                ->usePickupsQuery()
                ->filterByPrimaryKeys($pickups->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPickups() only accepts arguments of type \Pickups or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Pickups relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCalendarQuery The current query, for fluid interface
     */
    public function joinPickups($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Pickups');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Pickups');
        }

        return $this;
    }

    /**
     * Use the Pickups relation Pickups object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PickupsQuery A secondary query class using the current class as primary query
     */
    public function usePickupsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPickups($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Pickups', '\PickupsQuery');
    }

    /**
     * Use the Pickups relation Pickups object
     *
     * @param callable(\PickupsQuery):\PickupsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPickupsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePickupsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Pickups table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \PickupsQuery The inner query object of the EXISTS statement
     */
    public function usePickupsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Pickups', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Pickups table for a NOT EXISTS query.
     *
     * @see usePickupsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \PickupsQuery The inner query object of the NOT EXISTS statement
     */
    public function usePickupsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Pickups', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildCalendar $calendar Object to remove from the list of results
     *
     * @return $this|ChildCalendarQuery The current query, for fluid interface
     */
    public function prune($calendar = null)
    {
        if ($calendar) {
            $this->addUsingAlias(CalendarTableMap::COL_DAY, $calendar->getDay(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the calendar table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CalendarTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CalendarTableMap::clearInstancePool();
            CalendarTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CalendarTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CalendarTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CalendarTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CalendarTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CalendarQuery
