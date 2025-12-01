<?php

namespace Base;

use \Deliveries as ChildDeliveries;
use \DeliveriesQuery as ChildDeliveriesQuery;
use \Exception;
use \PDO;
use Map\DeliveriesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'deliveries' table.
 *
 *
 *
 * @method     ChildDeliveriesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildDeliveriesQuery orderByIdOrder($order = Criteria::ASC) Order by the id_order column
 * @method     ChildDeliveriesQuery orderByIdAssignedUser($order = Criteria::ASC) Order by the id_assigned_user column
 * @method     ChildDeliveriesQuery orderByDayDelivery($order = Criteria::ASC) Order by the day_delivery column
 * @method     ChildDeliveriesQuery orderByTimeDelivery($order = Criteria::ASC) Order by the time_delivery column
 * @method     ChildDeliveriesQuery orderByRealDeliveryDate($order = Criteria::ASC) Order by the real_delivery_date column
 * @method     ChildDeliveriesQuery orderByRealDeliveryTime($order = Criteria::ASC) Order by the real_delivery_time column
 * @method     ChildDeliveriesQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     ChildDeliveriesQuery orderByComments($order = Criteria::ASC) Order by the comments column
 * @method     ChildDeliveriesQuery orderByDeliveryComments($order = Criteria::ASC) Order by the delivery_comments column
 * @method     ChildDeliveriesQuery orderByDeliveryContactName($order = Criteria::ASC) Order by the delivery_contact_name column
 * @method     ChildDeliveriesQuery orderByDeliveryContactSignature($order = Criteria::ASC) Order by the delivery_contact_signature column
 * @method     ChildDeliveriesQuery orderByDeliveryPhoto($order = Criteria::ASC) Order by the delivery_photo column
 * @method     ChildDeliveriesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildDeliveriesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildDeliveriesQuery groupById() Group by the id column
 * @method     ChildDeliveriesQuery groupByIdOrder() Group by the id_order column
 * @method     ChildDeliveriesQuery groupByIdAssignedUser() Group by the id_assigned_user column
 * @method     ChildDeliveriesQuery groupByDayDelivery() Group by the day_delivery column
 * @method     ChildDeliveriesQuery groupByTimeDelivery() Group by the time_delivery column
 * @method     ChildDeliveriesQuery groupByRealDeliveryDate() Group by the real_delivery_date column
 * @method     ChildDeliveriesQuery groupByRealDeliveryTime() Group by the real_delivery_time column
 * @method     ChildDeliveriesQuery groupByStatus() Group by the status column
 * @method     ChildDeliveriesQuery groupByComments() Group by the comments column
 * @method     ChildDeliveriesQuery groupByDeliveryComments() Group by the delivery_comments column
 * @method     ChildDeliveriesQuery groupByDeliveryContactName() Group by the delivery_contact_name column
 * @method     ChildDeliveriesQuery groupByDeliveryContactSignature() Group by the delivery_contact_signature column
 * @method     ChildDeliveriesQuery groupByDeliveryPhoto() Group by the delivery_photo column
 * @method     ChildDeliveriesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildDeliveriesQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildDeliveriesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDeliveriesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDeliveriesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDeliveriesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDeliveriesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDeliveriesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDeliveriesQuery leftJoinCalendar($relationAlias = null) Adds a LEFT JOIN clause to the query using the Calendar relation
 * @method     ChildDeliveriesQuery rightJoinCalendar($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Calendar relation
 * @method     ChildDeliveriesQuery innerJoinCalendar($relationAlias = null) Adds a INNER JOIN clause to the query using the Calendar relation
 *
 * @method     ChildDeliveriesQuery joinWithCalendar($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Calendar relation
 *
 * @method     ChildDeliveriesQuery leftJoinWithCalendar() Adds a LEFT JOIN clause and with to the query using the Calendar relation
 * @method     ChildDeliveriesQuery rightJoinWithCalendar() Adds a RIGHT JOIN clause and with to the query using the Calendar relation
 * @method     ChildDeliveriesQuery innerJoinWithCalendar() Adds a INNER JOIN clause and with to the query using the Calendar relation
 *
 * @method     ChildDeliveriesQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildDeliveriesQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildDeliveriesQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildDeliveriesQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildDeliveriesQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildDeliveriesQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildDeliveriesQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     ChildDeliveriesQuery leftJoinOrders($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orders relation
 * @method     ChildDeliveriesQuery rightJoinOrders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orders relation
 * @method     ChildDeliveriesQuery innerJoinOrders($relationAlias = null) Adds a INNER JOIN clause to the query using the Orders relation
 *
 * @method     ChildDeliveriesQuery joinWithOrders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orders relation
 *
 * @method     ChildDeliveriesQuery leftJoinWithOrders() Adds a LEFT JOIN clause and with to the query using the Orders relation
 * @method     ChildDeliveriesQuery rightJoinWithOrders() Adds a RIGHT JOIN clause and with to the query using the Orders relation
 * @method     ChildDeliveriesQuery innerJoinWithOrders() Adds a INNER JOIN clause and with to the query using the Orders relation
 *
 * @method     \CalendarQuery|\UsersQuery|\OrdersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDeliveries|null findOne(ConnectionInterface $con = null) Return the first ChildDeliveries matching the query
 * @method     ChildDeliveries findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDeliveries matching the query, or a new ChildDeliveries object populated from the query conditions when no match is found
 *
 * @method     ChildDeliveries|null findOneById(int $id) Return the first ChildDeliveries filtered by the id column
 * @method     ChildDeliveries|null findOneByIdOrder(int $id_order) Return the first ChildDeliveries filtered by the id_order column
 * @method     ChildDeliveries|null findOneByIdAssignedUser(int $id_assigned_user) Return the first ChildDeliveries filtered by the id_assigned_user column
 * @method     ChildDeliveries|null findOneByDayDelivery(string $day_delivery) Return the first ChildDeliveries filtered by the day_delivery column
 * @method     ChildDeliveries|null findOneByTimeDelivery(string $time_delivery) Return the first ChildDeliveries filtered by the time_delivery column
 * @method     ChildDeliveries|null findOneByRealDeliveryDate(string $real_delivery_date) Return the first ChildDeliveries filtered by the real_delivery_date column
 * @method     ChildDeliveries|null findOneByRealDeliveryTime(string $real_delivery_time) Return the first ChildDeliveries filtered by the real_delivery_time column
 * @method     ChildDeliveries|null findOneByStatus(int $status) Return the first ChildDeliveries filtered by the status column
 * @method     ChildDeliveries|null findOneByComments(string $comments) Return the first ChildDeliveries filtered by the comments column
 * @method     ChildDeliveries|null findOneByDeliveryComments(string $delivery_comments) Return the first ChildDeliveries filtered by the delivery_comments column
 * @method     ChildDeliveries|null findOneByDeliveryContactName(string $delivery_contact_name) Return the first ChildDeliveries filtered by the delivery_contact_name column
 * @method     ChildDeliveries|null findOneByDeliveryContactSignature(string $delivery_contact_signature) Return the first ChildDeliveries filtered by the delivery_contact_signature column
 * @method     ChildDeliveries|null findOneByDeliveryPhoto(string $delivery_photo) Return the first ChildDeliveries filtered by the delivery_photo column
 * @method     ChildDeliveries|null findOneByCreatedAt(string $created_at) Return the first ChildDeliveries filtered by the created_at column
 * @method     ChildDeliveries|null findOneByUpdatedAt(string $updated_at) Return the first ChildDeliveries filtered by the updated_at column *

 * @method     ChildDeliveries requirePk($key, ConnectionInterface $con = null) Return the ChildDeliveries by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveries requireOne(ConnectionInterface $con = null) Return the first ChildDeliveries matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDeliveries requireOneById(int $id) Return the first ChildDeliveries filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveries requireOneByIdOrder(int $id_order) Return the first ChildDeliveries filtered by the id_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveries requireOneByIdAssignedUser(int $id_assigned_user) Return the first ChildDeliveries filtered by the id_assigned_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveries requireOneByDayDelivery(string $day_delivery) Return the first ChildDeliveries filtered by the day_delivery column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveries requireOneByTimeDelivery(string $time_delivery) Return the first ChildDeliveries filtered by the time_delivery column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveries requireOneByRealDeliveryDate(string $real_delivery_date) Return the first ChildDeliveries filtered by the real_delivery_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveries requireOneByRealDeliveryTime(string $real_delivery_time) Return the first ChildDeliveries filtered by the real_delivery_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveries requireOneByStatus(int $status) Return the first ChildDeliveries filtered by the status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveries requireOneByComments(string $comments) Return the first ChildDeliveries filtered by the comments column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveries requireOneByDeliveryComments(string $delivery_comments) Return the first ChildDeliveries filtered by the delivery_comments column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveries requireOneByDeliveryContactName(string $delivery_contact_name) Return the first ChildDeliveries filtered by the delivery_contact_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveries requireOneByDeliveryContactSignature(string $delivery_contact_signature) Return the first ChildDeliveries filtered by the delivery_contact_signature column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveries requireOneByDeliveryPhoto(string $delivery_photo) Return the first ChildDeliveries filtered by the delivery_photo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveries requireOneByCreatedAt(string $created_at) Return the first ChildDeliveries filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDeliveries requireOneByUpdatedAt(string $updated_at) Return the first ChildDeliveries filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDeliveries[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDeliveries objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildDeliveries> find(ConnectionInterface $con = null) Return ChildDeliveries objects based on current ModelCriteria
 * @method     ChildDeliveries[]|ObjectCollection findById(int $id) Return ChildDeliveries objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildDeliveries> findById(int $id) Return ChildDeliveries objects filtered by the id column
 * @method     ChildDeliveries[]|ObjectCollection findByIdOrder(int $id_order) Return ChildDeliveries objects filtered by the id_order column
 * @psalm-method ObjectCollection&\Traversable<ChildDeliveries> findByIdOrder(int $id_order) Return ChildDeliveries objects filtered by the id_order column
 * @method     ChildDeliveries[]|ObjectCollection findByIdAssignedUser(int $id_assigned_user) Return ChildDeliveries objects filtered by the id_assigned_user column
 * @psalm-method ObjectCollection&\Traversable<ChildDeliveries> findByIdAssignedUser(int $id_assigned_user) Return ChildDeliveries objects filtered by the id_assigned_user column
 * @method     ChildDeliveries[]|ObjectCollection findByDayDelivery(string $day_delivery) Return ChildDeliveries objects filtered by the day_delivery column
 * @psalm-method ObjectCollection&\Traversable<ChildDeliveries> findByDayDelivery(string $day_delivery) Return ChildDeliveries objects filtered by the day_delivery column
 * @method     ChildDeliveries[]|ObjectCollection findByTimeDelivery(string $time_delivery) Return ChildDeliveries objects filtered by the time_delivery column
 * @psalm-method ObjectCollection&\Traversable<ChildDeliveries> findByTimeDelivery(string $time_delivery) Return ChildDeliveries objects filtered by the time_delivery column
 * @method     ChildDeliveries[]|ObjectCollection findByRealDeliveryDate(string $real_delivery_date) Return ChildDeliveries objects filtered by the real_delivery_date column
 * @psalm-method ObjectCollection&\Traversable<ChildDeliveries> findByRealDeliveryDate(string $real_delivery_date) Return ChildDeliveries objects filtered by the real_delivery_date column
 * @method     ChildDeliveries[]|ObjectCollection findByRealDeliveryTime(string $real_delivery_time) Return ChildDeliveries objects filtered by the real_delivery_time column
 * @psalm-method ObjectCollection&\Traversable<ChildDeliveries> findByRealDeliveryTime(string $real_delivery_time) Return ChildDeliveries objects filtered by the real_delivery_time column
 * @method     ChildDeliveries[]|ObjectCollection findByStatus(int $status) Return ChildDeliveries objects filtered by the status column
 * @psalm-method ObjectCollection&\Traversable<ChildDeliveries> findByStatus(int $status) Return ChildDeliveries objects filtered by the status column
 * @method     ChildDeliveries[]|ObjectCollection findByComments(string $comments) Return ChildDeliveries objects filtered by the comments column
 * @psalm-method ObjectCollection&\Traversable<ChildDeliveries> findByComments(string $comments) Return ChildDeliveries objects filtered by the comments column
 * @method     ChildDeliveries[]|ObjectCollection findByDeliveryComments(string $delivery_comments) Return ChildDeliveries objects filtered by the delivery_comments column
 * @psalm-method ObjectCollection&\Traversable<ChildDeliveries> findByDeliveryComments(string $delivery_comments) Return ChildDeliveries objects filtered by the delivery_comments column
 * @method     ChildDeliveries[]|ObjectCollection findByDeliveryContactName(string $delivery_contact_name) Return ChildDeliveries objects filtered by the delivery_contact_name column
 * @psalm-method ObjectCollection&\Traversable<ChildDeliveries> findByDeliveryContactName(string $delivery_contact_name) Return ChildDeliveries objects filtered by the delivery_contact_name column
 * @method     ChildDeliveries[]|ObjectCollection findByDeliveryContactSignature(string $delivery_contact_signature) Return ChildDeliveries objects filtered by the delivery_contact_signature column
 * @psalm-method ObjectCollection&\Traversable<ChildDeliveries> findByDeliveryContactSignature(string $delivery_contact_signature) Return ChildDeliveries objects filtered by the delivery_contact_signature column
 * @method     ChildDeliveries[]|ObjectCollection findByDeliveryPhoto(string $delivery_photo) Return ChildDeliveries objects filtered by the delivery_photo column
 * @psalm-method ObjectCollection&\Traversable<ChildDeliveries> findByDeliveryPhoto(string $delivery_photo) Return ChildDeliveries objects filtered by the delivery_photo column
 * @method     ChildDeliveries[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildDeliveries objects filtered by the created_at column
 * @psalm-method ObjectCollection&\Traversable<ChildDeliveries> findByCreatedAt(string $created_at) Return ChildDeliveries objects filtered by the created_at column
 * @method     ChildDeliveries[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildDeliveries objects filtered by the updated_at column
 * @psalm-method ObjectCollection&\Traversable<ChildDeliveries> findByUpdatedAt(string $updated_at) Return ChildDeliveries objects filtered by the updated_at column
 * @method     ChildDeliveries[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildDeliveries> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DeliveriesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\DeliveriesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'golden_clean', $modelName = '\\Deliveries', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDeliveriesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDeliveriesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDeliveriesQuery) {
            return $criteria;
        }
        $query = new ChildDeliveriesQuery();
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
     * @return ChildDeliveries|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DeliveriesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DeliveriesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDeliveries A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_order, id_assigned_user, day_delivery, time_delivery, real_delivery_date, real_delivery_time, status, comments, delivery_comments, delivery_contact_name, delivery_contact_signature, delivery_photo, created_at, updated_at FROM deliveries WHERE id = :p0';
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
            /** @var ChildDeliveries $obj */
            $obj = new ChildDeliveries();
            $obj->hydrate($row);
            DeliveriesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDeliveries|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildDeliveriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DeliveriesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDeliveriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DeliveriesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildDeliveriesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(DeliveriesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(DeliveriesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveriesTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildDeliveriesQuery The current query, for fluid interface
     */
    public function filterByIdOrder($idOrder = null, $comparison = null)
    {
        if (is_array($idOrder)) {
            $useMinMax = false;
            if (isset($idOrder['min'])) {
                $this->addUsingAlias(DeliveriesTableMap::COL_ID_ORDER, $idOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idOrder['max'])) {
                $this->addUsingAlias(DeliveriesTableMap::COL_ID_ORDER, $idOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveriesTableMap::COL_ID_ORDER, $idOrder, $comparison);
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
     * @return $this|ChildDeliveriesQuery The current query, for fluid interface
     */
    public function filterByIdAssignedUser($idAssignedUser = null, $comparison = null)
    {
        if (is_array($idAssignedUser)) {
            $useMinMax = false;
            if (isset($idAssignedUser['min'])) {
                $this->addUsingAlias(DeliveriesTableMap::COL_ID_ASSIGNED_USER, $idAssignedUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idAssignedUser['max'])) {
                $this->addUsingAlias(DeliveriesTableMap::COL_ID_ASSIGNED_USER, $idAssignedUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveriesTableMap::COL_ID_ASSIGNED_USER, $idAssignedUser, $comparison);
    }

    /**
     * Filter the query on the day_delivery column
     *
     * Example usage:
     * <code>
     * $query->filterByDayDelivery('2011-03-14'); // WHERE day_delivery = '2011-03-14'
     * $query->filterByDayDelivery('now'); // WHERE day_delivery = '2011-03-14'
     * $query->filterByDayDelivery(array('max' => 'yesterday')); // WHERE day_delivery > '2011-03-13'
     * </code>
     *
     * @param     mixed $dayDelivery The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeliveriesQuery The current query, for fluid interface
     */
    public function filterByDayDelivery($dayDelivery = null, $comparison = null)
    {
        if (is_array($dayDelivery)) {
            $useMinMax = false;
            if (isset($dayDelivery['min'])) {
                $this->addUsingAlias(DeliveriesTableMap::COL_DAY_DELIVERY, $dayDelivery['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dayDelivery['max'])) {
                $this->addUsingAlias(DeliveriesTableMap::COL_DAY_DELIVERY, $dayDelivery['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveriesTableMap::COL_DAY_DELIVERY, $dayDelivery, $comparison);
    }

    /**
     * Filter the query on the time_delivery column
     *
     * Example usage:
     * <code>
     * $query->filterByTimeDelivery('2011-03-14'); // WHERE time_delivery = '2011-03-14'
     * $query->filterByTimeDelivery('now'); // WHERE time_delivery = '2011-03-14'
     * $query->filterByTimeDelivery(array('max' => 'yesterday')); // WHERE time_delivery > '2011-03-13'
     * </code>
     *
     * @param     mixed $timeDelivery The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeliveriesQuery The current query, for fluid interface
     */
    public function filterByTimeDelivery($timeDelivery = null, $comparison = null)
    {
        if (is_array($timeDelivery)) {
            $useMinMax = false;
            if (isset($timeDelivery['min'])) {
                $this->addUsingAlias(DeliveriesTableMap::COL_TIME_DELIVERY, $timeDelivery['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($timeDelivery['max'])) {
                $this->addUsingAlias(DeliveriesTableMap::COL_TIME_DELIVERY, $timeDelivery['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveriesTableMap::COL_TIME_DELIVERY, $timeDelivery, $comparison);
    }

    /**
     * Filter the query on the real_delivery_date column
     *
     * Example usage:
     * <code>
     * $query->filterByRealDeliveryDate('2011-03-14'); // WHERE real_delivery_date = '2011-03-14'
     * $query->filterByRealDeliveryDate('now'); // WHERE real_delivery_date = '2011-03-14'
     * $query->filterByRealDeliveryDate(array('max' => 'yesterday')); // WHERE real_delivery_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $realDeliveryDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeliveriesQuery The current query, for fluid interface
     */
    public function filterByRealDeliveryDate($realDeliveryDate = null, $comparison = null)
    {
        if (is_array($realDeliveryDate)) {
            $useMinMax = false;
            if (isset($realDeliveryDate['min'])) {
                $this->addUsingAlias(DeliveriesTableMap::COL_REAL_DELIVERY_DATE, $realDeliveryDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($realDeliveryDate['max'])) {
                $this->addUsingAlias(DeliveriesTableMap::COL_REAL_DELIVERY_DATE, $realDeliveryDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveriesTableMap::COL_REAL_DELIVERY_DATE, $realDeliveryDate, $comparison);
    }

    /**
     * Filter the query on the real_delivery_time column
     *
     * Example usage:
     * <code>
     * $query->filterByRealDeliveryTime('2011-03-14'); // WHERE real_delivery_time = '2011-03-14'
     * $query->filterByRealDeliveryTime('now'); // WHERE real_delivery_time = '2011-03-14'
     * $query->filterByRealDeliveryTime(array('max' => 'yesterday')); // WHERE real_delivery_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $realDeliveryTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeliveriesQuery The current query, for fluid interface
     */
    public function filterByRealDeliveryTime($realDeliveryTime = null, $comparison = null)
    {
        if (is_array($realDeliveryTime)) {
            $useMinMax = false;
            if (isset($realDeliveryTime['min'])) {
                $this->addUsingAlias(DeliveriesTableMap::COL_REAL_DELIVERY_TIME, $realDeliveryTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($realDeliveryTime['max'])) {
                $this->addUsingAlias(DeliveriesTableMap::COL_REAL_DELIVERY_TIME, $realDeliveryTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveriesTableMap::COL_REAL_DELIVERY_TIME, $realDeliveryTime, $comparison);
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
     * @return $this|ChildDeliveriesQuery The current query, for fluid interface
     */
    public function filterByStatus($status = null, $comparison = null)
    {
        if (is_array($status)) {
            $useMinMax = false;
            if (isset($status['min'])) {
                $this->addUsingAlias(DeliveriesTableMap::COL_STATUS, $status['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($status['max'])) {
                $this->addUsingAlias(DeliveriesTableMap::COL_STATUS, $status['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveriesTableMap::COL_STATUS, $status, $comparison);
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
     * @return $this|ChildDeliveriesQuery The current query, for fluid interface
     */
    public function filterByComments($comments = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($comments)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveriesTableMap::COL_COMMENTS, $comments, $comparison);
    }

    /**
     * Filter the query on the delivery_comments column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryComments('fooValue');   // WHERE delivery_comments = 'fooValue'
     * $query->filterByDeliveryComments('%fooValue%', Criteria::LIKE); // WHERE delivery_comments LIKE '%fooValue%'
     * </code>
     *
     * @param     string $deliveryComments The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeliveriesQuery The current query, for fluid interface
     */
    public function filterByDeliveryComments($deliveryComments = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deliveryComments)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveriesTableMap::COL_DELIVERY_COMMENTS, $deliveryComments, $comparison);
    }

    /**
     * Filter the query on the delivery_contact_name column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryContactName('fooValue');   // WHERE delivery_contact_name = 'fooValue'
     * $query->filterByDeliveryContactName('%fooValue%', Criteria::LIKE); // WHERE delivery_contact_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $deliveryContactName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeliveriesQuery The current query, for fluid interface
     */
    public function filterByDeliveryContactName($deliveryContactName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deliveryContactName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveriesTableMap::COL_DELIVERY_CONTACT_NAME, $deliveryContactName, $comparison);
    }

    /**
     * Filter the query on the delivery_contact_signature column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryContactSignature('fooValue');   // WHERE delivery_contact_signature = 'fooValue'
     * $query->filterByDeliveryContactSignature('%fooValue%', Criteria::LIKE); // WHERE delivery_contact_signature LIKE '%fooValue%'
     * </code>
     *
     * @param     string $deliveryContactSignature The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeliveriesQuery The current query, for fluid interface
     */
    public function filterByDeliveryContactSignature($deliveryContactSignature = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deliveryContactSignature)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveriesTableMap::COL_DELIVERY_CONTACT_SIGNATURE, $deliveryContactSignature, $comparison);
    }

    /**
     * Filter the query on the delivery_photo column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryPhoto('fooValue');   // WHERE delivery_photo = 'fooValue'
     * $query->filterByDeliveryPhoto('%fooValue%', Criteria::LIKE); // WHERE delivery_photo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $deliveryPhoto The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeliveriesQuery The current query, for fluid interface
     */
    public function filterByDeliveryPhoto($deliveryPhoto = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deliveryPhoto)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveriesTableMap::COL_DELIVERY_PHOTO, $deliveryPhoto, $comparison);
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
     * @return $this|ChildDeliveriesQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(DeliveriesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(DeliveriesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveriesTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildDeliveriesQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(DeliveriesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(DeliveriesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeliveriesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Calendar object
     *
     * @param \Calendar|ObjectCollection $calendar The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDeliveriesQuery The current query, for fluid interface
     */
    public function filterByCalendar($calendar, $comparison = null)
    {
        if ($calendar instanceof \Calendar) {
            return $this
                ->addUsingAlias(DeliveriesTableMap::COL_DAY_DELIVERY, $calendar->getDay(), $comparison);
        } elseif ($calendar instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DeliveriesTableMap::COL_DAY_DELIVERY, $calendar->toKeyValue('PrimaryKey', 'Day'), $comparison);
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
     * @return $this|ChildDeliveriesQuery The current query, for fluid interface
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
     * @return ChildDeliveriesQuery The current query, for fluid interface
     */
    public function filterByUsers($users, $comparison = null)
    {
        if ($users instanceof \Users) {
            return $this
                ->addUsingAlias(DeliveriesTableMap::COL_ID_ASSIGNED_USER, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DeliveriesTableMap::COL_ID_ASSIGNED_USER, $users->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildDeliveriesQuery The current query, for fluid interface
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
     * @return ChildDeliveriesQuery The current query, for fluid interface
     */
    public function filterByOrders($orders, $comparison = null)
    {
        if ($orders instanceof \Orders) {
            return $this
                ->addUsingAlias(DeliveriesTableMap::COL_ID_ORDER, $orders->getId(), $comparison);
        } elseif ($orders instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DeliveriesTableMap::COL_ID_ORDER, $orders->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildDeliveriesQuery The current query, for fluid interface
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
     * @param   ChildDeliveries $deliveries Object to remove from the list of results
     *
     * @return $this|ChildDeliveriesQuery The current query, for fluid interface
     */
    public function prune($deliveries = null)
    {
        if ($deliveries) {
            $this->addUsingAlias(DeliveriesTableMap::COL_ID, $deliveries->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the deliveries table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveriesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DeliveriesTableMap::clearInstancePool();
            DeliveriesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveriesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DeliveriesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DeliveriesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DeliveriesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // DeliveriesQuery
