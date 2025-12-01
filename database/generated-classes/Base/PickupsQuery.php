<?php

namespace Base;

use \Pickups as ChildPickups;
use \PickupsQuery as ChildPickupsQuery;
use \Exception;
use \PDO;
use Map\PickupsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'pickups' table.
 *
 *
 *
 * @method     ChildPickupsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPickupsQuery orderByIdOrder($order = Criteria::ASC) Order by the id_order column
 * @method     ChildPickupsQuery orderByIdAssignedUser($order = Criteria::ASC) Order by the id_assigned_user column
 * @method     ChildPickupsQuery orderByDayPickup($order = Criteria::ASC) Order by the day_pickup column
 * @method     ChildPickupsQuery orderByTimePickup($order = Criteria::ASC) Order by the time_pickup column
 * @method     ChildPickupsQuery orderByRealPickupDate($order = Criteria::ASC) Order by the real_pickup_date column
 * @method     ChildPickupsQuery orderByRealPickupTime($order = Criteria::ASC) Order by the real_pickup_time column
 * @method     ChildPickupsQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildPickupsQuery orderByComments($order = Criteria::ASC) Order by the comments column
 * @method     ChildPickupsQuery orderByHarvestComments($order = Criteria::ASC) Order by the harvest_comments column
 * @method     ChildPickupsQuery orderByHarvestContactName($order = Criteria::ASC) Order by the harvest_contact_name column
 * @method     ChildPickupsQuery orderByHarvestContactSignature($order = Criteria::ASC) Order by the harvest_contact_signature column
 * @method     ChildPickupsQuery orderByHarvestPhoto($order = Criteria::ASC) Order by the harvest_photo column
 * @method     ChildPickupsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildPickupsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildPickupsQuery groupById() Group by the id column
 * @method     ChildPickupsQuery groupByIdOrder() Group by the id_order column
 * @method     ChildPickupsQuery groupByIdAssignedUser() Group by the id_assigned_user column
 * @method     ChildPickupsQuery groupByDayPickup() Group by the day_pickup column
 * @method     ChildPickupsQuery groupByTimePickup() Group by the time_pickup column
 * @method     ChildPickupsQuery groupByRealPickupDate() Group by the real_pickup_date column
 * @method     ChildPickupsQuery groupByRealPickupTime() Group by the real_pickup_time column
 * @method     ChildPickupsQuery groupByStatus() Group by the status column
 * @method     ChildPickupsQuery groupByComments() Group by the comments column
 * @method     ChildPickupsQuery groupByHarvestComments() Group by the harvest_comments column
 * @method     ChildPickupsQuery groupByHarvestContactName() Group by the harvest_contact_name column
 * @method     ChildPickupsQuery groupByHarvestContactSignature() Group by the harvest_contact_signature column
 * @method     ChildPickupsQuery groupByHarvestPhoto() Group by the harvest_photo column
 * @method     ChildPickupsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildPickupsQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildPickupsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPickupsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPickupsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPickupsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPickupsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPickupsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPickupsQuery leftJoinCalendar($relationAlias = null) Adds a LEFT JOIN clause to the query using the Calendar relation
 * @method     ChildPickupsQuery rightJoinCalendar($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Calendar relation
 * @method     ChildPickupsQuery innerJoinCalendar($relationAlias = null) Adds a INNER JOIN clause to the query using the Calendar relation
 *
 * @method     ChildPickupsQuery joinWithCalendar($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Calendar relation
 *
 * @method     ChildPickupsQuery leftJoinWithCalendar() Adds a LEFT JOIN clause and with to the query using the Calendar relation
 * @method     ChildPickupsQuery rightJoinWithCalendar() Adds a RIGHT JOIN clause and with to the query using the Calendar relation
 * @method     ChildPickupsQuery innerJoinWithCalendar() Adds a INNER JOIN clause and with to the query using the Calendar relation
 *
 * @method     ChildPickupsQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildPickupsQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildPickupsQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildPickupsQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildPickupsQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildPickupsQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildPickupsQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     ChildPickupsQuery leftJoinOrders($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orders relation
 * @method     ChildPickupsQuery rightJoinOrders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orders relation
 * @method     ChildPickupsQuery innerJoinOrders($relationAlias = null) Adds a INNER JOIN clause to the query using the Orders relation
 *
 * @method     ChildPickupsQuery joinWithOrders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orders relation
 *
 * @method     ChildPickupsQuery leftJoinWithOrders() Adds a LEFT JOIN clause and with to the query using the Orders relation
 * @method     ChildPickupsQuery rightJoinWithOrders() Adds a RIGHT JOIN clause and with to the query using the Orders relation
 * @method     ChildPickupsQuery innerJoinWithOrders() Adds a INNER JOIN clause and with to the query using the Orders relation
 *
 * @method     \CalendarQuery|\UsersQuery|\OrdersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPickups|null findOne(ConnectionInterface $con = null) Return the first ChildPickups matching the query
 * @method     ChildPickups findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPickups matching the query, or a new ChildPickups object populated from the query conditions when no match is found
 *
 * @method     ChildPickups|null findOneById(int $id) Return the first ChildPickups filtered by the id column
 * @method     ChildPickups|null findOneByIdOrder(int $id_order) Return the first ChildPickups filtered by the id_order column
 * @method     ChildPickups|null findOneByIdAssignedUser(int $id_assigned_user) Return the first ChildPickups filtered by the id_assigned_user column
 * @method     ChildPickups|null findOneByDayPickup(string $day_pickup) Return the first ChildPickups filtered by the day_pickup column
 * @method     ChildPickups|null findOneByTimePickup(string $time_pickup) Return the first ChildPickups filtered by the time_pickup column
 * @method     ChildPickups|null findOneByRealPickupDate(string $real_pickup_date) Return the first ChildPickups filtered by the real_pickup_date column
 * @method     ChildPickups|null findOneByRealPickupTime(string $real_pickup_time) Return the first ChildPickups filtered by the real_pickup_time column
 * @method     ChildPickups|null findOneByStatus(int $status) Return the first ChildPickups filtered by the status column
 * @method     ChildPickups|null findOneByComments(string $comments) Return the first ChildPickups filtered by the comments column
 * @method     ChildPickups|null findOneByHarvestComments(string $harvest_comments) Return the first ChildPickups filtered by the harvest_comments column
 * @method     ChildPickups|null findOneByHarvestContactName(string $harvest_contact_name) Return the first ChildPickups filtered by the harvest_contact_name column
 * @method     ChildPickups|null findOneByHarvestContactSignature(string $harvest_contact_signature) Return the first ChildPickups filtered by the harvest_contact_signature column
 * @method     ChildPickups|null findOneByHarvestPhoto(string $harvest_photo) Return the first ChildPickups filtered by the harvest_photo column
 * @method     ChildPickups|null findOneByCreatedAt(string $created_at) Return the first ChildPickups filtered by the created_at column
 * @method     ChildPickups|null findOneByUpdatedAt(string $updated_at) Return the first ChildPickups filtered by the updated_at column *

 * @method     ChildPickups requirePk($key, ConnectionInterface $con = null) Return the ChildPickups by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPickups requireOne(ConnectionInterface $con = null) Return the first ChildPickups matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPickups requireOneById(int $id) Return the first ChildPickups filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPickups requireOneByIdOrder(int $id_order) Return the first ChildPickups filtered by the id_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPickups requireOneByIdAssignedUser(int $id_assigned_user) Return the first ChildPickups filtered by the id_assigned_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPickups requireOneByDayPickup(string $day_pickup) Return the first ChildPickups filtered by the day_pickup column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPickups requireOneByTimePickup(string $time_pickup) Return the first ChildPickups filtered by the time_pickup column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPickups requireOneByRealPickupDate(string $real_pickup_date) Return the first ChildPickups filtered by the real_pickup_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPickups requireOneByRealPickupTime(string $real_pickup_time) Return the first ChildPickups filtered by the real_pickup_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPickups requireOneByStatus(int $status) Return the first ChildPickups filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPickups requireOneByComments(string $comments) Return the first ChildPickups filtered by the comments column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPickups requireOneByHarvestComments(string $harvest_comments) Return the first ChildPickups filtered by the harvest_comments column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPickups requireOneByHarvestContactName(string $harvest_contact_name) Return the first ChildPickups filtered by the harvest_contact_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPickups requireOneByHarvestContactSignature(string $harvest_contact_signature) Return the first ChildPickups filtered by the harvest_contact_signature column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPickups requireOneByHarvestPhoto(string $harvest_photo) Return the first ChildPickups filtered by the harvest_photo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPickups requireOneByCreatedAt(string $created_at) Return the first ChildPickups filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPickups requireOneByUpdatedAt(string $updated_at) Return the first ChildPickups filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPickups[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPickups objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildPickups> find(ConnectionInterface $con = null) Return ChildPickups objects based on current ModelCriteria
 * @method     ChildPickups[]|ObjectCollection findById(int $id) Return ChildPickups objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildPickups> findById(int $id) Return ChildPickups objects filtered by the id column
 * @method     ChildPickups[]|ObjectCollection findByIdOrder(int $id_order) Return ChildPickups objects filtered by the id_order column
 * @psalm-method ObjectCollection&\Traversable<ChildPickups> findByIdOrder(int $id_order) Return ChildPickups objects filtered by the id_order column
 * @method     ChildPickups[]|ObjectCollection findByIdAssignedUser(int $id_assigned_user) Return ChildPickups objects filtered by the id_assigned_user column
 * @psalm-method ObjectCollection&\Traversable<ChildPickups> findByIdAssignedUser(int $id_assigned_user) Return ChildPickups objects filtered by the id_assigned_user column
 * @method     ChildPickups[]|ObjectCollection findByDayPickup(string $day_pickup) Return ChildPickups objects filtered by the day_pickup column
 * @psalm-method ObjectCollection&\Traversable<ChildPickups> findByDayPickup(string $day_pickup) Return ChildPickups objects filtered by the day_pickup column
 * @method     ChildPickups[]|ObjectCollection findByTimePickup(string $time_pickup) Return ChildPickups objects filtered by the time_pickup column
 * @psalm-method ObjectCollection&\Traversable<ChildPickups> findByTimePickup(string $time_pickup) Return ChildPickups objects filtered by the time_pickup column
 * @method     ChildPickups[]|ObjectCollection findByRealPickupDate(string $real_pickup_date) Return ChildPickups objects filtered by the real_pickup_date column
 * @psalm-method ObjectCollection&\Traversable<ChildPickups> findByRealPickupDate(string $real_pickup_date) Return ChildPickups objects filtered by the real_pickup_date column
 * @method     ChildPickups[]|ObjectCollection findByRealPickupTime(string $real_pickup_time) Return ChildPickups objects filtered by the real_pickup_time column
 * @psalm-method ObjectCollection&\Traversable<ChildPickups> findByRealPickupTime(string $real_pickup_time) Return ChildPickups objects filtered by the real_pickup_time column
 * @method     ChildPickups[]|ObjectCollection findByStatus(int $status) Return ChildPickups objects filtered by the status column
 * @psalm-method ObjectCollection&\Traversable<ChildPickups> findByStatus(int $status) Return ChildPickups objects filtered by the status column
 * @method     ChildPickups[]|ObjectCollection findByComments(string $comments) Return ChildPickups objects filtered by the comments column
 * @psalm-method ObjectCollection&\Traversable<ChildPickups> findByComments(string $comments) Return ChildPickups objects filtered by the comments column
 * @method     ChildPickups[]|ObjectCollection findByHarvestComments(string $harvest_comments) Return ChildPickups objects filtered by the harvest_comments column
 * @psalm-method ObjectCollection&\Traversable<ChildPickups> findByHarvestComments(string $harvest_comments) Return ChildPickups objects filtered by the harvest_comments column
 * @method     ChildPickups[]|ObjectCollection findByHarvestContactName(string $harvest_contact_name) Return ChildPickups objects filtered by the harvest_contact_name column
 * @psalm-method ObjectCollection&\Traversable<ChildPickups> findByHarvestContactName(string $harvest_contact_name) Return ChildPickups objects filtered by the harvest_contact_name column
 * @method     ChildPickups[]|ObjectCollection findByHarvestContactSignature(string $harvest_contact_signature) Return ChildPickups objects filtered by the harvest_contact_signature column
 * @psalm-method ObjectCollection&\Traversable<ChildPickups> findByHarvestContactSignature(string $harvest_contact_signature) Return ChildPickups objects filtered by the harvest_contact_signature column
 * @method     ChildPickups[]|ObjectCollection findByHarvestPhoto(string $harvest_photo) Return ChildPickups objects filtered by the harvest_photo column
 * @psalm-method ObjectCollection&\Traversable<ChildPickups> findByHarvestPhoto(string $harvest_photo) Return ChildPickups objects filtered by the harvest_photo column
 * @method     ChildPickups[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildPickups objects filtered by the created_at column
 * @psalm-method ObjectCollection&\Traversable<ChildPickups> findByCreatedAt(string $created_at) Return ChildPickups objects filtered by the created_at column
 * @method     ChildPickups[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildPickups objects filtered by the updated_at column
 * @psalm-method ObjectCollection&\Traversable<ChildPickups> findByUpdatedAt(string $updated_at) Return ChildPickups objects filtered by the updated_at column
 * @method     ChildPickups[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildPickups> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PickupsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PickupsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'golden_clean', $modelName = '\\Pickups', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPickupsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPickupsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPickupsQuery) {
            return $criteria;
        }
        $query = new ChildPickupsQuery();
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
     * @return ChildPickups|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PickupsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PickupsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPickups A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_order, id_assigned_user, day_pickup, time_pickup, real_pickup_date, real_pickup_time, status, comments, harvest_comments, harvest_contact_name, harvest_contact_signature, harvest_photo, created_at, updated_at FROM pickups WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildPickups $obj */
            $obj = new ChildPickups();
            $obj->hydrate($row);
            PickupsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPickups|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPickupsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PickupsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPickupsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PickupsTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPickupsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PickupsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PickupsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PickupsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_order column
     *
     * Example usage:
     * <code>
     * $query->filterByIdOrder(1234); // WHERE id_order = 1234
     * $query->filterByIdOrder(array(12, 34)); // WHERE id_order IN (12, 34)
     * $query->filterByIdOrder(array('min' => 12)); // WHERE id_order > 12
     * </code>
     *
     * @see       filterByOrders()
     *
     * @param     mixed $idOrder The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPickupsQuery The current query, for fluid interface
     */
    public function filterByIdOrder($idOrder = null, $comparison = null)
    {
        if (is_array($idOrder)) {
            $useMinMax = false;
            if (isset($idOrder['min'])) {
                $this->addUsingAlias(PickupsTableMap::COL_ID_ORDER, $idOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idOrder['max'])) {
                $this->addUsingAlias(PickupsTableMap::COL_ID_ORDER, $idOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PickupsTableMap::COL_ID_ORDER, $idOrder, $comparison);
    }

    /**
     * Filter the query on the id_assigned_user column
     *
     * Example usage:
     * <code>
     * $query->filterByIdAssignedUser(1234); // WHERE id_assigned_user = 1234
     * $query->filterByIdAssignedUser(array(12, 34)); // WHERE id_assigned_user IN (12, 34)
     * $query->filterByIdAssignedUser(array('min' => 12)); // WHERE id_assigned_user > 12
     * </code>
     *
     * @see       filterByUsers()
     *
     * @param     mixed $idAssignedUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPickupsQuery The current query, for fluid interface
     */
    public function filterByIdAssignedUser($idAssignedUser = null, $comparison = null)
    {
        if (is_array($idAssignedUser)) {
            $useMinMax = false;
            if (isset($idAssignedUser['min'])) {
                $this->addUsingAlias(PickupsTableMap::COL_ID_ASSIGNED_USER, $idAssignedUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idAssignedUser['max'])) {
                $this->addUsingAlias(PickupsTableMap::COL_ID_ASSIGNED_USER, $idAssignedUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PickupsTableMap::COL_ID_ASSIGNED_USER, $idAssignedUser, $comparison);
    }

    /**
     * Filter the query on the day_pickup column
     *
     * Example usage:
     * <code>
     * $query->filterByDayPickup('2011-03-14'); // WHERE day_pickup = '2011-03-14'
     * $query->filterByDayPickup('now'); // WHERE day_pickup = '2011-03-14'
     * $query->filterByDayPickup(array('max' => 'yesterday')); // WHERE day_pickup > '2011-03-13'
     * </code>
     *
     * @param     mixed $dayPickup The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPickupsQuery The current query, for fluid interface
     */
    public function filterByDayPickup($dayPickup = null, $comparison = null)
    {
        if (is_array($dayPickup)) {
            $useMinMax = false;
            if (isset($dayPickup['min'])) {
                $this->addUsingAlias(PickupsTableMap::COL_DAY_PICKUP, $dayPickup['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dayPickup['max'])) {
                $this->addUsingAlias(PickupsTableMap::COL_DAY_PICKUP, $dayPickup['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PickupsTableMap::COL_DAY_PICKUP, $dayPickup, $comparison);
    }

    /**
     * Filter the query on the time_pickup column
     *
     * Example usage:
     * <code>
     * $query->filterByTimePickup('2011-03-14'); // WHERE time_pickup = '2011-03-14'
     * $query->filterByTimePickup('now'); // WHERE time_pickup = '2011-03-14'
     * $query->filterByTimePickup(array('max' => 'yesterday')); // WHERE time_pickup > '2011-03-13'
     * </code>
     *
     * @param     mixed $timePickup The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPickupsQuery The current query, for fluid interface
     */
    public function filterByTimePickup($timePickup = null, $comparison = null)
    {
        if (is_array($timePickup)) {
            $useMinMax = false;
            if (isset($timePickup['min'])) {
                $this->addUsingAlias(PickupsTableMap::COL_TIME_PICKUP, $timePickup['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($timePickup['max'])) {
                $this->addUsingAlias(PickupsTableMap::COL_TIME_PICKUP, $timePickup['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PickupsTableMap::COL_TIME_PICKUP, $timePickup, $comparison);
    }

    /**
     * Filter the query on the real_pickup_date column
     *
     * Example usage:
     * <code>
     * $query->filterByRealPickupDate('2011-03-14'); // WHERE real_pickup_date = '2011-03-14'
     * $query->filterByRealPickupDate('now'); // WHERE real_pickup_date = '2011-03-14'
     * $query->filterByRealPickupDate(array('max' => 'yesterday')); // WHERE real_pickup_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $realPickupDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPickupsQuery The current query, for fluid interface
     */
    public function filterByRealPickupDate($realPickupDate = null, $comparison = null)
    {
        if (is_array($realPickupDate)) {
            $useMinMax = false;
            if (isset($realPickupDate['min'])) {
                $this->addUsingAlias(PickupsTableMap::COL_REAL_PICKUP_DATE, $realPickupDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($realPickupDate['max'])) {
                $this->addUsingAlias(PickupsTableMap::COL_REAL_PICKUP_DATE, $realPickupDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PickupsTableMap::COL_REAL_PICKUP_DATE, $realPickupDate, $comparison);
    }

    /**
     * Filter the query on the real_pickup_time column
     *
     * Example usage:
     * <code>
     * $query->filterByRealPickupTime('2011-03-14'); // WHERE real_pickup_time = '2011-03-14'
     * $query->filterByRealPickupTime('now'); // WHERE real_pickup_time = '2011-03-14'
     * $query->filterByRealPickupTime(array('max' => 'yesterday')); // WHERE real_pickup_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $realPickupTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPickupsQuery The current query, for fluid interface
     */
    public function filterByRealPickupTime($realPickupTime = null, $comparison = null)
    {
        if (is_array($realPickupTime)) {
            $useMinMax = false;
            if (isset($realPickupTime['min'])) {
                $this->addUsingAlias(PickupsTableMap::COL_REAL_PICKUP_TIME, $realPickupTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($realPickupTime['max'])) {
                $this->addUsingAlias(PickupsTableMap::COL_REAL_PICKUP_TIME, $realPickupTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PickupsTableMap::COL_REAL_PICKUP_TIME, $realPickupTime, $comparison);
    }

    /**
     * Filter the query on the status column
     *
     * Example usage:
     * <code>
     * $query->filterByStatus(1234); // WHERE status = 1234
     * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
     * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
     * </code>
     *
     * @param     mixed $status The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPickupsQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(PickupsTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(PickupsTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PickupsTableMap::COL_STATUS, $status, $comparison);
    }

    /**
     * Filter the query on the comments column
     *
     * Example usage:
     * <code>
     * $query->filterByComments('fooValue');   // WHERE comments = 'fooValue'
     * $query->filterByComments('%fooValue%', Criteria::LIKE); // WHERE comments LIKE '%fooValue%'
     * </code>
     *
     * @param     string $comments The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPickupsQuery The current query, for fluid interface
     */
    public function filterByComments($comments = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($comments)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PickupsTableMap::COL_COMMENTS, $comments, $comparison);
    }

    /**
     * Filter the query on the harvest_comments column
     *
     * Example usage:
     * <code>
     * $query->filterByHarvestComments('fooValue');   // WHERE harvest_comments = 'fooValue'
     * $query->filterByHarvestComments('%fooValue%', Criteria::LIKE); // WHERE harvest_comments LIKE '%fooValue%'
     * </code>
     *
     * @param     string $harvestComments The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPickupsQuery The current query, for fluid interface
     */
    public function filterByHarvestComments($harvestComments = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($harvestComments)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PickupsTableMap::COL_HARVEST_COMMENTS, $harvestComments, $comparison);
    }

    /**
     * Filter the query on the harvest_contact_name column
     *
     * Example usage:
     * <code>
     * $query->filterByHarvestContactName('fooValue');   // WHERE harvest_contact_name = 'fooValue'
     * $query->filterByHarvestContactName('%fooValue%', Criteria::LIKE); // WHERE harvest_contact_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $harvestContactName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPickupsQuery The current query, for fluid interface
     */
    public function filterByHarvestContactName($harvestContactName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($harvestContactName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PickupsTableMap::COL_HARVEST_CONTACT_NAME, $harvestContactName, $comparison);
    }

    /**
     * Filter the query on the harvest_contact_signature column
     *
     * Example usage:
     * <code>
     * $query->filterByHarvestContactSignature('fooValue');   // WHERE harvest_contact_signature = 'fooValue'
     * $query->filterByHarvestContactSignature('%fooValue%', Criteria::LIKE); // WHERE harvest_contact_signature LIKE '%fooValue%'
     * </code>
     *
     * @param     string $harvestContactSignature The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPickupsQuery The current query, for fluid interface
     */
    public function filterByHarvestContactSignature($harvestContactSignature = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($harvestContactSignature)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PickupsTableMap::COL_HARVEST_CONTACT_SIGNATURE, $harvestContactSignature, $comparison);
    }

    /**
     * Filter the query on the harvest_photo column
     *
     * Example usage:
     * <code>
     * $query->filterByHarvestPhoto('fooValue');   // WHERE harvest_photo = 'fooValue'
     * $query->filterByHarvestPhoto('%fooValue%', Criteria::LIKE); // WHERE harvest_photo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $harvestPhoto The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPickupsQuery The current query, for fluid interface
     */
    public function filterByHarvestPhoto($harvestPhoto = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($harvestPhoto)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PickupsTableMap::COL_HARVEST_PHOTO, $harvestPhoto, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPickupsQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PickupsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PickupsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PickupsTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPickupsQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PickupsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PickupsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PickupsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Calendar object
     *
     * @param \Calendar|ObjectCollection $calendar The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPickupsQuery The current query, for fluid interface
     */
    public function filterByCalendar($calendar, $comparison = null)
    {
        if ($calendar instanceof \Calendar) {
            return $this
                ->addUsingAlias(PickupsTableMap::COL_DAY_PICKUP, $calendar->getDay(), $comparison);
        } elseif ($calendar instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PickupsTableMap::COL_DAY_PICKUP, $calendar->toKeyValue('PrimaryKey', 'Day'), $comparison);
        } else {
            throw new PropelException('filterByCalendar() only accepts arguments of type \Calendar or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Calendar relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPickupsQuery The current query, for fluid interface
     */
    public function joinCalendar($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Calendar');

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
            $this->addJoinObject($join, 'Calendar');
        }

        return $this;
    }

    /**
     * Use the Calendar relation Calendar object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \CalendarQuery A secondary query class using the current class as primary query
     */
    public function useCalendarQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCalendar($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Calendar', '\CalendarQuery');
    }

    /**
     * Use the Calendar relation Calendar object
     *
     * @param callable(\CalendarQuery):\CalendarQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withCalendarQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useCalendarQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Calendar table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \CalendarQuery The inner query object of the EXISTS statement
     */
    public function useCalendarExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Calendar', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Calendar table for a NOT EXISTS query.
     *
     * @see useCalendarExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \CalendarQuery The inner query object of the NOT EXISTS statement
     */
    public function useCalendarNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Calendar', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Users object
     *
     * @param \Users|ObjectCollection $users The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPickupsQuery The current query, for fluid interface
     */
    public function filterByUsers($users, $comparison = null)
    {
        if ($users instanceof \Users) {
            return $this
                ->addUsingAlias(PickupsTableMap::COL_ID_ASSIGNED_USER, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PickupsTableMap::COL_ID_ASSIGNED_USER, $users->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUsers() only accepts arguments of type \Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Users relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPickupsQuery The current query, for fluid interface
     */
    public function joinUsers($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Users');

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
            $this->addJoinObject($join, 'Users');
        }

        return $this;
    }

    /**
     * Use the Users relation Users object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UsersQuery A secondary query class using the current class as primary query
     */
    public function useUsersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Users', '\UsersQuery');
    }

    /**
     * Use the Users relation Users object
     *
     * @param callable(\UsersQuery):\UsersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUsersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUsersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Users table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \UsersQuery The inner query object of the EXISTS statement
     */
    public function useUsersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Users', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Users table for a NOT EXISTS query.
     *
     * @see useUsersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \UsersQuery The inner query object of the NOT EXISTS statement
     */
    public function useUsersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Users', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Orders object
     *
     * @param \Orders|ObjectCollection $orders The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPickupsQuery The current query, for fluid interface
     */
    public function filterByOrders($orders, $comparison = null)
    {
        if ($orders instanceof \Orders) {
            return $this
                ->addUsingAlias(PickupsTableMap::COL_ID_ORDER, $orders->getId(), $comparison);
        } elseif ($orders instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PickupsTableMap::COL_ID_ORDER, $orders->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByOrders() only accepts arguments of type \Orders or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Orders relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPickupsQuery The current query, for fluid interface
     */
    public function joinOrders($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Orders');

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
            $this->addJoinObject($join, 'Orders');
        }

        return $this;
    }

    /**
     * Use the Orders relation Orders object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrdersQuery A secondary query class using the current class as primary query
     */
    public function useOrdersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrders($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Orders', '\OrdersQuery');
    }

    /**
     * Use the Orders relation Orders object
     *
     * @param callable(\OrdersQuery):\OrdersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrdersQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrdersQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Orders table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \OrdersQuery The inner query object of the EXISTS statement
     */
    public function useOrdersExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Orders', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Orders table for a NOT EXISTS query.
     *
     * @see useOrdersExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \OrdersQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrdersNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Orders', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildPickups $pickups Object to remove from the list of results
     *
     * @return $this|ChildPickupsQuery The current query, for fluid interface
     */
    public function prune($pickups = null)
    {
        if ($pickups) {
            $this->addUsingAlias(PickupsTableMap::COL_ID, $pickups->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the pickups table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PickupsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PickupsTableMap::clearInstancePool();
            PickupsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PickupsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PickupsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PickupsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PickupsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PickupsQuery
