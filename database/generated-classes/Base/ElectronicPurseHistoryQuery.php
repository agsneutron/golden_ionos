<?php

namespace Base;

use \ElectronicPurseHistory as ChildElectronicPurseHistory;
use \ElectronicPurseHistoryQuery as ChildElectronicPurseHistoryQuery;
use \Exception;
use \PDO;
use Map\ElectronicPurseHistoryTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'electronic_purse_history' table.
 *
 *
 *
 * @method     ChildElectronicPurseHistoryQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildElectronicPurseHistoryQuery orderByIdElectronicPurse($order = Criteria::ASC) Order by the id_electronic_purse column
 * @method     ChildElectronicPurseHistoryQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildElectronicPurseHistoryQuery orderByMovementType($order = Criteria::ASC) Order by the movement_type column
 * @method     ChildElectronicPurseHistoryQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildElectronicPurseHistoryQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildElectronicPurseHistoryQuery orderByIdOrder($order = Criteria::ASC) Order by the id_order column
 * @method     ChildElectronicPurseHistoryQuery orderByDescription($order = Criteria::ASC) Order by the description column
 *
 * @method     ChildElectronicPurseHistoryQuery groupById() Group by the id column
 * @method     ChildElectronicPurseHistoryQuery groupByIdElectronicPurse() Group by the id_electronic_purse column
 * @method     ChildElectronicPurseHistoryQuery groupByAmount() Group by the amount column
 * @method     ChildElectronicPurseHistoryQuery groupByMovementType() Group by the movement_type column
 * @method     ChildElectronicPurseHistoryQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildElectronicPurseHistoryQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildElectronicPurseHistoryQuery groupByIdOrder() Group by the id_order column
 * @method     ChildElectronicPurseHistoryQuery groupByDescription() Group by the description column
 *
 * @method     ChildElectronicPurseHistoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildElectronicPurseHistoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildElectronicPurseHistoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildElectronicPurseHistoryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildElectronicPurseHistoryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildElectronicPurseHistoryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildElectronicPurseHistoryQuery leftJoinElectronicPurse($relationAlias = null) Adds a LEFT JOIN clause to the query using the ElectronicPurse relation
 * @method     ChildElectronicPurseHistoryQuery rightJoinElectronicPurse($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ElectronicPurse relation
 * @method     ChildElectronicPurseHistoryQuery innerJoinElectronicPurse($relationAlias = null) Adds a INNER JOIN clause to the query using the ElectronicPurse relation
 *
 * @method     ChildElectronicPurseHistoryQuery joinWithElectronicPurse($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ElectronicPurse relation
 *
 * @method     ChildElectronicPurseHistoryQuery leftJoinWithElectronicPurse() Adds a LEFT JOIN clause and with to the query using the ElectronicPurse relation
 * @method     ChildElectronicPurseHistoryQuery rightJoinWithElectronicPurse() Adds a RIGHT JOIN clause and with to the query using the ElectronicPurse relation
 * @method     ChildElectronicPurseHistoryQuery innerJoinWithElectronicPurse() Adds a INNER JOIN clause and with to the query using the ElectronicPurse relation
 *
 * @method     ChildElectronicPurseHistoryQuery leftJoinOrders($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orders relation
 * @method     ChildElectronicPurseHistoryQuery rightJoinOrders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orders relation
 * @method     ChildElectronicPurseHistoryQuery innerJoinOrders($relationAlias = null) Adds a INNER JOIN clause to the query using the Orders relation
 *
 * @method     ChildElectronicPurseHistoryQuery joinWithOrders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orders relation
 *
 * @method     ChildElectronicPurseHistoryQuery leftJoinWithOrders() Adds a LEFT JOIN clause and with to the query using the Orders relation
 * @method     ChildElectronicPurseHistoryQuery rightJoinWithOrders() Adds a RIGHT JOIN clause and with to the query using the Orders relation
 * @method     ChildElectronicPurseHistoryQuery innerJoinWithOrders() Adds a INNER JOIN clause and with to the query using the Orders relation
 *
 * @method     \ElectronicPurseQuery|\OrdersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildElectronicPurseHistory|null findOne(ConnectionInterface $con = null) Return the first ChildElectronicPurseHistory matching the query
 * @method     ChildElectronicPurseHistory findOneOrCreate(ConnectionInterface $con = null) Return the first ChildElectronicPurseHistory matching the query, or a new ChildElectronicPurseHistory object populated from the query conditions when no match is found
 *
 * @method     ChildElectronicPurseHistory|null findOneById(int $id) Return the first ChildElectronicPurseHistory filtered by the id column
 * @method     ChildElectronicPurseHistory|null findOneByIdElectronicPurse(int $id_electronic_purse) Return the first ChildElectronicPurseHistory filtered by the id_electronic_purse column
 * @method     ChildElectronicPurseHistory|null findOneByAmount(string $amount) Return the first ChildElectronicPurseHistory filtered by the amount column
 * @method     ChildElectronicPurseHistory|null findOneByMovementType(int $movement_type) Return the first ChildElectronicPurseHistory filtered by the movement_type column
 * @method     ChildElectronicPurseHistory|null findOneByCreatedAt(string $created_at) Return the first ChildElectronicPurseHistory filtered by the created_at column
 * @method     ChildElectronicPurseHistory|null findOneByUpdatedAt(string $updated_at) Return the first ChildElectronicPurseHistory filtered by the updated_at column
 * @method     ChildElectronicPurseHistory|null findOneByIdOrder(int $id_order) Return the first ChildElectronicPurseHistory filtered by the id_order column
 * @method     ChildElectronicPurseHistory|null findOneByDescription(string $description) Return the first ChildElectronicPurseHistory filtered by the description column *

 * @method     ChildElectronicPurseHistory requirePk($key, ConnectionInterface $con = null) Return the ChildElectronicPurseHistory by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectronicPurseHistory requireOne(ConnectionInterface $con = null) Return the first ChildElectronicPurseHistory matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildElectronicPurseHistory requireOneById(int $id) Return the first ChildElectronicPurseHistory filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectronicPurseHistory requireOneByIdElectronicPurse(int $id_electronic_purse) Return the first ChildElectronicPurseHistory filtered by the id_electronic_purse column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectronicPurseHistory requireOneByAmount(string $amount) Return the first ChildElectronicPurseHistory filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectronicPurseHistory requireOneByMovementType(int $movement_type) Return the first ChildElectronicPurseHistory filtered by the movement_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectronicPurseHistory requireOneByCreatedAt(string $created_at) Return the first ChildElectronicPurseHistory filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectronicPurseHistory requireOneByUpdatedAt(string $updated_at) Return the first ChildElectronicPurseHistory filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectronicPurseHistory requireOneByIdOrder(int $id_order) Return the first ChildElectronicPurseHistory filtered by the id_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectronicPurseHistory requireOneByDescription(string $description) Return the first ChildElectronicPurseHistory filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildElectronicPurseHistory[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildElectronicPurseHistory objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildElectronicPurseHistory> find(ConnectionInterface $con = null) Return ChildElectronicPurseHistory objects based on current ModelCriteria
 * @method     ChildElectronicPurseHistory[]|ObjectCollection findById(int $id) Return ChildElectronicPurseHistory objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildElectronicPurseHistory> findById(int $id) Return ChildElectronicPurseHistory objects filtered by the id column
 * @method     ChildElectronicPurseHistory[]|ObjectCollection findByIdElectronicPurse(int $id_electronic_purse) Return ChildElectronicPurseHistory objects filtered by the id_electronic_purse column
 * @psalm-method ObjectCollection&\Traversable<ChildElectronicPurseHistory> findByIdElectronicPurse(int $id_electronic_purse) Return ChildElectronicPurseHistory objects filtered by the id_electronic_purse column
 * @method     ChildElectronicPurseHistory[]|ObjectCollection findByAmount(string $amount) Return ChildElectronicPurseHistory objects filtered by the amount column
 * @psalm-method ObjectCollection&\Traversable<ChildElectronicPurseHistory> findByAmount(string $amount) Return ChildElectronicPurseHistory objects filtered by the amount column
 * @method     ChildElectronicPurseHistory[]|ObjectCollection findByMovementType(int $movement_type) Return ChildElectronicPurseHistory objects filtered by the movement_type column
 * @psalm-method ObjectCollection&\Traversable<ChildElectronicPurseHistory> findByMovementType(int $movement_type) Return ChildElectronicPurseHistory objects filtered by the movement_type column
 * @method     ChildElectronicPurseHistory[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildElectronicPurseHistory objects filtered by the created_at column
 * @psalm-method ObjectCollection&\Traversable<ChildElectronicPurseHistory> findByCreatedAt(string $created_at) Return ChildElectronicPurseHistory objects filtered by the created_at column
 * @method     ChildElectronicPurseHistory[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildElectronicPurseHistory objects filtered by the updated_at column
 * @psalm-method ObjectCollection&\Traversable<ChildElectronicPurseHistory> findByUpdatedAt(string $updated_at) Return ChildElectronicPurseHistory objects filtered by the updated_at column
 * @method     ChildElectronicPurseHistory[]|ObjectCollection findByIdOrder(int $id_order) Return ChildElectronicPurseHistory objects filtered by the id_order column
 * @psalm-method ObjectCollection&\Traversable<ChildElectronicPurseHistory> findByIdOrder(int $id_order) Return ChildElectronicPurseHistory objects filtered by the id_order column
 * @method     ChildElectronicPurseHistory[]|ObjectCollection findByDescription(string $description) Return ChildElectronicPurseHistory objects filtered by the description column
 * @psalm-method ObjectCollection&\Traversable<ChildElectronicPurseHistory> findByDescription(string $description) Return ChildElectronicPurseHistory objects filtered by the description column
 * @method     ChildElectronicPurseHistory[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildElectronicPurseHistory> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ElectronicPurseHistoryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ElectronicPurseHistoryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'golden_clean', $modelName = '\\ElectronicPurseHistory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildElectronicPurseHistoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildElectronicPurseHistoryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildElectronicPurseHistoryQuery) {
            return $criteria;
        }
        $query = new ChildElectronicPurseHistoryQuery();
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
     * @return ChildElectronicPurseHistory|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ElectronicPurseHistoryTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ElectronicPurseHistoryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildElectronicPurseHistory A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_electronic_purse, amount, movement_type, created_at, updated_at, id_order, description FROM electronic_purse_history WHERE id = :p0';
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
            /** @var ChildElectronicPurseHistory $obj */
            $obj = new ChildElectronicPurseHistory();
            $obj->hydrate($row);
            ElectronicPurseHistoryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildElectronicPurseHistory|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildElectronicPurseHistoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildElectronicPurseHistoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildElectronicPurseHistoryQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_electronic_purse column
     *
     * Example usage:
     * <code>
     * $query->filterByIdElectronicPurse(1234); // WHERE id_electronic_purse = 1234
     * $query->filterByIdElectronicPurse(array(12, 34)); // WHERE id_electronic_purse IN (12, 34)
     * $query->filterByIdElectronicPurse(array('min' => 12)); // WHERE id_electronic_purse > 12
     * </code>
     *
     * @see       filterByElectronicPurse()
     *
     * @param     mixed $idElectronicPurse The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElectronicPurseHistoryQuery The current query, for fluid interface
     */
    public function filterByIdElectronicPurse($idElectronicPurse = null, $comparison = null)
    {
        if (is_array($idElectronicPurse)) {
            $useMinMax = false;
            if (isset($idElectronicPurse['min'])) {
                $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_ID_ELECTRONIC_PURSE, $idElectronicPurse['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idElectronicPurse['max'])) {
                $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_ID_ELECTRONIC_PURSE, $idElectronicPurse['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_ID_ELECTRONIC_PURSE, $idElectronicPurse, $comparison);
    }

    /**
     * Filter the query on the amount column
     *
     * Example usage:
     * <code>
     * $query->filterByAmount(1234); // WHERE amount = 1234
     * $query->filterByAmount(array(12, 34)); // WHERE amount IN (12, 34)
     * $query->filterByAmount(array('min' => 12)); // WHERE amount > 12
     * </code>
     *
     * @param     mixed $amount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElectronicPurseHistoryQuery The current query, for fluid interface
     */
    public function filterByAmount($amount = null, $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_AMOUNT, $amount, $comparison);
    }

    /**
     * Filter the query on the movement_type column
     *
     * Example usage:
     * <code>
     * $query->filterByMovementType(1234); // WHERE movement_type = 1234
     * $query->filterByMovementType(array(12, 34)); // WHERE movement_type IN (12, 34)
     * $query->filterByMovementType(array('min' => 12)); // WHERE movement_type > 12
     * </code>
     *
     * @param     mixed $movementType The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElectronicPurseHistoryQuery The current query, for fluid interface
     */
    public function filterByMovementType($movementType = null, $comparison = null)
    {
        if (is_array($movementType)) {
            $useMinMax = false;
            if (isset($movementType['min'])) {
                $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_MOVEMENT_TYPE, $movementType['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($movementType['max'])) {
                $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_MOVEMENT_TYPE, $movementType['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_MOVEMENT_TYPE, $movementType, $comparison);
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
     * @return $this|ChildElectronicPurseHistoryQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildElectronicPurseHistoryQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
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
     * @return $this|ChildElectronicPurseHistoryQuery The current query, for fluid interface
     */
    public function filterByIdOrder($idOrder = null, $comparison = null)
    {
        if (is_array($idOrder)) {
            $useMinMax = false;
            if (isset($idOrder['min'])) {
                $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_ID_ORDER, $idOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idOrder['max'])) {
                $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_ID_ORDER, $idOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_ID_ORDER, $idOrder, $comparison);
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
     * @return $this|ChildElectronicPurseHistoryQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query by a related \ElectronicPurse object
     *
     * @param \ElectronicPurse|ObjectCollection $electronicPurse The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildElectronicPurseHistoryQuery The current query, for fluid interface
     */
    public function filterByElectronicPurse($electronicPurse, $comparison = null)
    {
        if ($electronicPurse instanceof \ElectronicPurse) {
            return $this
                ->addUsingAlias(ElectronicPurseHistoryTableMap::COL_ID_ELECTRONIC_PURSE, $electronicPurse->getId(), $comparison);
        } elseif ($electronicPurse instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ElectronicPurseHistoryTableMap::COL_ID_ELECTRONIC_PURSE, $electronicPurse->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByElectronicPurse() only accepts arguments of type \ElectronicPurse or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ElectronicPurse relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildElectronicPurseHistoryQuery The current query, for fluid interface
     */
    public function joinElectronicPurse($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ElectronicPurse');

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
            $this->addJoinObject($join, 'ElectronicPurse');
        }

        return $this;
    }

    /**
     * Use the ElectronicPurse relation ElectronicPurse object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ElectronicPurseQuery A secondary query class using the current class as primary query
     */
    public function useElectronicPurseQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinElectronicPurse($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ElectronicPurse', '\ElectronicPurseQuery');
    }

    /**
     * Use the ElectronicPurse relation ElectronicPurse object
     *
     * @param callable(\ElectronicPurseQuery):\ElectronicPurseQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withElectronicPurseQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useElectronicPurseQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ElectronicPurse table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \ElectronicPurseQuery The inner query object of the EXISTS statement
     */
    public function useElectronicPurseExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ElectronicPurse', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ElectronicPurse table for a NOT EXISTS query.
     *
     * @see useElectronicPurseExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \ElectronicPurseQuery The inner query object of the NOT EXISTS statement
     */
    public function useElectronicPurseNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ElectronicPurse', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Orders object
     *
     * @param \Orders|ObjectCollection $orders The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildElectronicPurseHistoryQuery The current query, for fluid interface
     */
    public function filterByOrders($orders, $comparison = null)
    {
        if ($orders instanceof \Orders) {
            return $this
                ->addUsingAlias(ElectronicPurseHistoryTableMap::COL_ID_ORDER, $orders->getId(), $comparison);
        } elseif ($orders instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ElectronicPurseHistoryTableMap::COL_ID_ORDER, $orders->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildElectronicPurseHistoryQuery The current query, for fluid interface
     */
    public function joinOrders($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useOrdersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * @param   ChildElectronicPurseHistory $electronicPurseHistory Object to remove from the list of results
     *
     * @return $this|ChildElectronicPurseHistoryQuery The current query, for fluid interface
     */
    public function prune($electronicPurseHistory = null)
    {
        if ($electronicPurseHistory) {
            $this->addUsingAlias(ElectronicPurseHistoryTableMap::COL_ID, $electronicPurseHistory->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the electronic_purse_history table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ElectronicPurseHistoryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ElectronicPurseHistoryTableMap::clearInstancePool();
            ElectronicPurseHistoryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ElectronicPurseHistoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ElectronicPurseHistoryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ElectronicPurseHistoryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ElectronicPurseHistoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ElectronicPurseHistoryQuery
