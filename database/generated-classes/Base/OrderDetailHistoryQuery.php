<?php

namespace Base;

use \OrderDetailHistory as ChildOrderDetailHistory;
use \OrderDetailHistoryQuery as ChildOrderDetailHistoryQuery;
use \Exception;
use \PDO;
use Map\OrderDetailHistoryTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'order_detail_history' table.
 *
 *
 *
 * @method     ChildOrderDetailHistoryQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildOrderDetailHistoryQuery orderByIdOrderDetail($order = Criteria::ASC) Order by the id_order_detail column
 * @method     ChildOrderDetailHistoryQuery orderByIdOrderDetailStatus($order = Criteria::ASC) Order by the id_order_detail_status column
 * @method     ChildOrderDetailHistoryQuery orderByIdUser($order = Criteria::ASC) Order by the id_user column
 * @method     ChildOrderDetailHistoryQuery orderByImage($order = Criteria::ASC) Order by the image column
 * @method     ChildOrderDetailHistoryQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildOrderDetailHistoryQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOrderDetailHistoryQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildOrderDetailHistoryQuery groupById() Group by the id column
 * @method     ChildOrderDetailHistoryQuery groupByIdOrderDetail() Group by the id_order_detail column
 * @method     ChildOrderDetailHistoryQuery groupByIdOrderDetailStatus() Group by the id_order_detail_status column
 * @method     ChildOrderDetailHistoryQuery groupByIdUser() Group by the id_user column
 * @method     ChildOrderDetailHistoryQuery groupByImage() Group by the image column
 * @method     ChildOrderDetailHistoryQuery groupByDescription() Group by the description column
 * @method     ChildOrderDetailHistoryQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOrderDetailHistoryQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildOrderDetailHistoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOrderDetailHistoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOrderDetailHistoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOrderDetailHistoryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOrderDetailHistoryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOrderDetailHistoryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOrderDetailHistoryQuery leftJoinOrderDetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderDetail relation
 * @method     ChildOrderDetailHistoryQuery rightJoinOrderDetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderDetail relation
 * @method     ChildOrderDetailHistoryQuery innerJoinOrderDetail($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderDetail relation
 *
 * @method     ChildOrderDetailHistoryQuery joinWithOrderDetail($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderDetail relation
 *
 * @method     ChildOrderDetailHistoryQuery leftJoinWithOrderDetail() Adds a LEFT JOIN clause and with to the query using the OrderDetail relation
 * @method     ChildOrderDetailHistoryQuery rightJoinWithOrderDetail() Adds a RIGHT JOIN clause and with to the query using the OrderDetail relation
 * @method     ChildOrderDetailHistoryQuery innerJoinWithOrderDetail() Adds a INNER JOIN clause and with to the query using the OrderDetail relation
 *
 * @method     ChildOrderDetailHistoryQuery leftJoinOrderDetailStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderDetailStatus relation
 * @method     ChildOrderDetailHistoryQuery rightJoinOrderDetailStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderDetailStatus relation
 * @method     ChildOrderDetailHistoryQuery innerJoinOrderDetailStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderDetailStatus relation
 *
 * @method     ChildOrderDetailHistoryQuery joinWithOrderDetailStatus($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderDetailStatus relation
 *
 * @method     ChildOrderDetailHistoryQuery leftJoinWithOrderDetailStatus() Adds a LEFT JOIN clause and with to the query using the OrderDetailStatus relation
 * @method     ChildOrderDetailHistoryQuery rightJoinWithOrderDetailStatus() Adds a RIGHT JOIN clause and with to the query using the OrderDetailStatus relation
 * @method     ChildOrderDetailHistoryQuery innerJoinWithOrderDetailStatus() Adds a INNER JOIN clause and with to the query using the OrderDetailStatus relation
 *
 * @method     ChildOrderDetailHistoryQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildOrderDetailHistoryQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildOrderDetailHistoryQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildOrderDetailHistoryQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildOrderDetailHistoryQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildOrderDetailHistoryQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildOrderDetailHistoryQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     \OrderDetailQuery|\OrderDetailStatusQuery|\UsersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOrderDetailHistory|null findOne(ConnectionInterface $con = null) Return the first ChildOrderDetailHistory matching the query
 * @method     ChildOrderDetailHistory findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOrderDetailHistory matching the query, or a new ChildOrderDetailHistory object populated from the query conditions when no match is found
 *
 * @method     ChildOrderDetailHistory|null findOneById(int $id) Return the first ChildOrderDetailHistory filtered by the id column
 * @method     ChildOrderDetailHistory|null findOneByIdOrderDetail(int $id_order_detail) Return the first ChildOrderDetailHistory filtered by the id_order_detail column
 * @method     ChildOrderDetailHistory|null findOneByIdOrderDetailStatus(int $id_order_detail_status) Return the first ChildOrderDetailHistory filtered by the id_order_detail_status column
 * @method     ChildOrderDetailHistory|null findOneByIdUser(int $id_user) Return the first ChildOrderDetailHistory filtered by the id_user column
 * @method     ChildOrderDetailHistory|null findOneByImage(string $image) Return the first ChildOrderDetailHistory filtered by the image column
 * @method     ChildOrderDetailHistory|null findOneByDescription(string $description) Return the first ChildOrderDetailHistory filtered by the description column
 * @method     ChildOrderDetailHistory|null findOneByCreatedAt(string $created_at) Return the first ChildOrderDetailHistory filtered by the created_at column
 * @method     ChildOrderDetailHistory|null findOneByUpdatedAt(string $updated_at) Return the first ChildOrderDetailHistory filtered by the updated_at column *

 * @method     ChildOrderDetailHistory requirePk($key, ConnectionInterface $con = null) Return the ChildOrderDetailHistory by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetailHistory requireOne(ConnectionInterface $con = null) Return the first ChildOrderDetailHistory matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrderDetailHistory requireOneById(int $id) Return the first ChildOrderDetailHistory filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetailHistory requireOneByIdOrderDetail(int $id_order_detail) Return the first ChildOrderDetailHistory filtered by the id_order_detail column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetailHistory requireOneByIdOrderDetailStatus(int $id_order_detail_status) Return the first ChildOrderDetailHistory filtered by the id_order_detail_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetailHistory requireOneByIdUser(int $id_user) Return the first ChildOrderDetailHistory filtered by the id_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetailHistory requireOneByImage(string $image) Return the first ChildOrderDetailHistory filtered by the image column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetailHistory requireOneByDescription(string $description) Return the first ChildOrderDetailHistory filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetailHistory requireOneByCreatedAt(string $created_at) Return the first ChildOrderDetailHistory filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetailHistory requireOneByUpdatedAt(string $updated_at) Return the first ChildOrderDetailHistory filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrderDetailHistory[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOrderDetailHistory objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetailHistory> find(ConnectionInterface $con = null) Return ChildOrderDetailHistory objects based on current ModelCriteria
 * @method     ChildOrderDetailHistory[]|ObjectCollection findById(int $id) Return ChildOrderDetailHistory objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetailHistory> findById(int $id) Return ChildOrderDetailHistory objects filtered by the id column
 * @method     ChildOrderDetailHistory[]|ObjectCollection findByIdOrderDetail(int $id_order_detail) Return ChildOrderDetailHistory objects filtered by the id_order_detail column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetailHistory> findByIdOrderDetail(int $id_order_detail) Return ChildOrderDetailHistory objects filtered by the id_order_detail column
 * @method     ChildOrderDetailHistory[]|ObjectCollection findByIdOrderDetailStatus(int $id_order_detail_status) Return ChildOrderDetailHistory objects filtered by the id_order_detail_status column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetailHistory> findByIdOrderDetailStatus(int $id_order_detail_status) Return ChildOrderDetailHistory objects filtered by the id_order_detail_status column
 * @method     ChildOrderDetailHistory[]|ObjectCollection findByIdUser(int $id_user) Return ChildOrderDetailHistory objects filtered by the id_user column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetailHistory> findByIdUser(int $id_user) Return ChildOrderDetailHistory objects filtered by the id_user column
 * @method     ChildOrderDetailHistory[]|ObjectCollection findByImage(string $image) Return ChildOrderDetailHistory objects filtered by the image column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetailHistory> findByImage(string $image) Return ChildOrderDetailHistory objects filtered by the image column
 * @method     ChildOrderDetailHistory[]|ObjectCollection findByDescription(string $description) Return ChildOrderDetailHistory objects filtered by the description column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetailHistory> findByDescription(string $description) Return ChildOrderDetailHistory objects filtered by the description column
 * @method     ChildOrderDetailHistory[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildOrderDetailHistory objects filtered by the created_at column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetailHistory> findByCreatedAt(string $created_at) Return ChildOrderDetailHistory objects filtered by the created_at column
 * @method     ChildOrderDetailHistory[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildOrderDetailHistory objects filtered by the updated_at column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetailHistory> findByUpdatedAt(string $updated_at) Return ChildOrderDetailHistory objects filtered by the updated_at column
 * @method     ChildOrderDetailHistory[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOrderDetailHistory> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OrderDetailHistoryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\OrderDetailHistoryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'golden_clean', $modelName = '\\OrderDetailHistory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOrderDetailHistoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOrderDetailHistoryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOrderDetailHistoryQuery) {
            return $criteria;
        }
        $query = new ChildOrderDetailHistoryQuery();
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
     * @return ChildOrderDetailHistory|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OrderDetailHistoryTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OrderDetailHistoryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOrderDetailHistory A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_order_detail, id_order_detail_status, id_user, image, description, created_at, updated_at FROM order_detail_history WHERE id = :p0';
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
            /** @var ChildOrderDetailHistory $obj */
            $obj = new ChildOrderDetailHistory();
            $obj->hydrate($row);
            OrderDetailHistoryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOrderDetailHistory|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildOrderDetailHistoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(OrderDetailHistoryTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOrderDetailHistoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(OrderDetailHistoryTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildOrderDetailHistoryQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(OrderDetailHistoryTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(OrderDetailHistoryTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailHistoryTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_order_detail column
     *
     * Example usage:
     * <code>
     * $query->filterByIdOrderDetail(1234); // WHERE id_order_detail = 1234
     * $query->filterByIdOrderDetail(array(12, 34)); // WHERE id_order_detail IN (12, 34)
     * $query->filterByIdOrderDetail(array('min' => 12)); // WHERE id_order_detail > 12
     * </code>
     *
     * @see       filterByOrderDetail()
     *
     * @param     mixed $idOrderDetail The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderDetailHistoryQuery The current query, for fluid interface
     */
    public function filterByIdOrderDetail($idOrderDetail = null, $comparison = null)
    {
        if (is_array($idOrderDetail)) {
            $useMinMax = false;
            if (isset($idOrderDetail['min'])) {
                $this->addUsingAlias(OrderDetailHistoryTableMap::COL_ID_ORDER_DETAIL, $idOrderDetail['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idOrderDetail['max'])) {
                $this->addUsingAlias(OrderDetailHistoryTableMap::COL_ID_ORDER_DETAIL, $idOrderDetail['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailHistoryTableMap::COL_ID_ORDER_DETAIL, $idOrderDetail, $comparison);
    }

    /**
     * Filter the query on the id_order_detail_status column
     *
     * Example usage:
     * <code>
     * $query->filterByIdOrderDetailStatus(1234); // WHERE id_order_detail_status = 1234
     * $query->filterByIdOrderDetailStatus(array(12, 34)); // WHERE id_order_detail_status IN (12, 34)
     * $query->filterByIdOrderDetailStatus(array('min' => 12)); // WHERE id_order_detail_status > 12
     * </code>
     *
     * @see       filterByOrderDetailStatus()
     *
     * @param     mixed $idOrderDetailStatus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderDetailHistoryQuery The current query, for fluid interface
     */
    public function filterByIdOrderDetailStatus($idOrderDetailStatus = null, $comparison = null)
    {
        if (is_array($idOrderDetailStatus)) {
            $useMinMax = false;
            if (isset($idOrderDetailStatus['min'])) {
                $this->addUsingAlias(OrderDetailHistoryTableMap::COL_ID_ORDER_DETAIL_STATUS, $idOrderDetailStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idOrderDetailStatus['max'])) {
                $this->addUsingAlias(OrderDetailHistoryTableMap::COL_ID_ORDER_DETAIL_STATUS, $idOrderDetailStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailHistoryTableMap::COL_ID_ORDER_DETAIL_STATUS, $idOrderDetailStatus, $comparison);
    }

    /**
     * Filter the query on the id_user column
     *
     * Example usage:
     * <code>
     * $query->filterByIdUser(1234); // WHERE id_user = 1234
     * $query->filterByIdUser(array(12, 34)); // WHERE id_user IN (12, 34)
     * $query->filterByIdUser(array('min' => 12)); // WHERE id_user > 12
     * </code>
     *
     * @see       filterByUsers()
     *
     * @param     mixed $idUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderDetailHistoryQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(OrderDetailHistoryTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(OrderDetailHistoryTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailHistoryTableMap::COL_ID_USER, $idUser, $comparison);
    }

    /**
     * Filter the query on the image column
     *
     * Example usage:
     * <code>
     * $query->filterByImage('fooValue');   // WHERE image = 'fooValue'
     * $query->filterByImage('%fooValue%', Criteria::LIKE); // WHERE image LIKE '%fooValue%'
     * </code>
     *
     * @param     string $image The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderDetailHistoryQuery The current query, for fluid interface
     */
    public function filterByImage($image = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($image)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailHistoryTableMap::COL_IMAGE, $image, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderDetailHistoryQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailHistoryTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildOrderDetailHistoryQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(OrderDetailHistoryTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OrderDetailHistoryTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailHistoryTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildOrderDetailHistoryQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(OrderDetailHistoryTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(OrderDetailHistoryTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailHistoryTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \OrderDetail object
     *
     * @param \OrderDetail|ObjectCollection $orderDetail The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderDetailHistoryQuery The current query, for fluid interface
     */
    public function filterByOrderDetail($orderDetail, $comparison = null)
    {
        if ($orderDetail instanceof \OrderDetail) {
            return $this
                ->addUsingAlias(OrderDetailHistoryTableMap::COL_ID_ORDER_DETAIL, $orderDetail->getId(), $comparison);
        } elseif ($orderDetail instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderDetailHistoryTableMap::COL_ID_ORDER_DETAIL, $orderDetail->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByOrderDetail() only accepts arguments of type \OrderDetail or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrderDetail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrderDetailHistoryQuery The current query, for fluid interface
     */
    public function joinOrderDetail($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrderDetail');

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
            $this->addJoinObject($join, 'OrderDetail');
        }

        return $this;
    }

    /**
     * Use the OrderDetail relation OrderDetail object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrderDetailQuery A secondary query class using the current class as primary query
     */
    public function useOrderDetailQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderDetail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrderDetail', '\OrderDetailQuery');
    }

    /**
     * Use the OrderDetail relation OrderDetail object
     *
     * @param callable(\OrderDetailQuery):\OrderDetailQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrderDetailQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrderDetailQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to OrderDetail table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \OrderDetailQuery The inner query object of the EXISTS statement
     */
    public function useOrderDetailExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('OrderDetail', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to OrderDetail table for a NOT EXISTS query.
     *
     * @see useOrderDetailExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \OrderDetailQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrderDetailNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('OrderDetail', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \OrderDetailStatus object
     *
     * @param \OrderDetailStatus|ObjectCollection $orderDetailStatus The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderDetailHistoryQuery The current query, for fluid interface
     */
    public function filterByOrderDetailStatus($orderDetailStatus, $comparison = null)
    {
        if ($orderDetailStatus instanceof \OrderDetailStatus) {
            return $this
                ->addUsingAlias(OrderDetailHistoryTableMap::COL_ID_ORDER_DETAIL_STATUS, $orderDetailStatus->getId(), $comparison);
        } elseif ($orderDetailStatus instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderDetailHistoryTableMap::COL_ID_ORDER_DETAIL_STATUS, $orderDetailStatus->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByOrderDetailStatus() only accepts arguments of type \OrderDetailStatus or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrderDetailStatus relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrderDetailHistoryQuery The current query, for fluid interface
     */
    public function joinOrderDetailStatus($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrderDetailStatus');

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
            $this->addJoinObject($join, 'OrderDetailStatus');
        }

        return $this;
    }

    /**
     * Use the OrderDetailStatus relation OrderDetailStatus object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrderDetailStatusQuery A secondary query class using the current class as primary query
     */
    public function useOrderDetailStatusQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderDetailStatus($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrderDetailStatus', '\OrderDetailStatusQuery');
    }

    /**
     * Use the OrderDetailStatus relation OrderDetailStatus object
     *
     * @param callable(\OrderDetailStatusQuery):\OrderDetailStatusQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrderDetailStatusQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrderDetailStatusQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to OrderDetailStatus table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \OrderDetailStatusQuery The inner query object of the EXISTS statement
     */
    public function useOrderDetailStatusExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('OrderDetailStatus', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to OrderDetailStatus table for a NOT EXISTS query.
     *
     * @see useOrderDetailStatusExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \OrderDetailStatusQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrderDetailStatusNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('OrderDetailStatus', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Users object
     *
     * @param \Users|ObjectCollection $users The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderDetailHistoryQuery The current query, for fluid interface
     */
    public function filterByUsers($users, $comparison = null)
    {
        if ($users instanceof \Users) {
            return $this
                ->addUsingAlias(OrderDetailHistoryTableMap::COL_ID_USER, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderDetailHistoryTableMap::COL_ID_USER, $users->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildOrderDetailHistoryQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildOrderDetailHistory $orderDetailHistory Object to remove from the list of results
     *
     * @return $this|ChildOrderDetailHistoryQuery The current query, for fluid interface
     */
    public function prune($orderDetailHistory = null)
    {
        if ($orderDetailHistory) {
            $this->addUsingAlias(OrderDetailHistoryTableMap::COL_ID, $orderDetailHistory->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the order_detail_history table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderDetailHistoryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OrderDetailHistoryTableMap::clearInstancePool();
            OrderDetailHistoryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OrderDetailHistoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OrderDetailHistoryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OrderDetailHistoryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OrderDetailHistoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // OrderDetailHistoryQuery
