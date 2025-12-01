<?php

namespace Base;

use \OrderDetailStatus as ChildOrderDetailStatus;
use \OrderDetailStatusQuery as ChildOrderDetailStatusQuery;
use \Exception;
use \PDO;
use Map\OrderDetailStatusTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'order_detail_status' table.
 *
 *
 *
 * @method     ChildOrderDetailStatusQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildOrderDetailStatusQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildOrderDetailStatusQuery orderByColor($order = Criteria::ASC) Order by the color column
 * @method     ChildOrderDetailStatusQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOrderDetailStatusQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildOrderDetailStatusQuery groupById() Group by the id column
 * @method     ChildOrderDetailStatusQuery groupByDescription() Group by the description column
 * @method     ChildOrderDetailStatusQuery groupByColor() Group by the color column
 * @method     ChildOrderDetailStatusQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOrderDetailStatusQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildOrderDetailStatusQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOrderDetailStatusQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOrderDetailStatusQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOrderDetailStatusQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOrderDetailStatusQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOrderDetailStatusQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOrderDetailStatusQuery leftJoinOrderDetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderDetail relation
 * @method     ChildOrderDetailStatusQuery rightJoinOrderDetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderDetail relation
 * @method     ChildOrderDetailStatusQuery innerJoinOrderDetail($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderDetail relation
 *
 * @method     ChildOrderDetailStatusQuery joinWithOrderDetail($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderDetail relation
 *
 * @method     ChildOrderDetailStatusQuery leftJoinWithOrderDetail() Adds a LEFT JOIN clause and with to the query using the OrderDetail relation
 * @method     ChildOrderDetailStatusQuery rightJoinWithOrderDetail() Adds a RIGHT JOIN clause and with to the query using the OrderDetail relation
 * @method     ChildOrderDetailStatusQuery innerJoinWithOrderDetail() Adds a INNER JOIN clause and with to the query using the OrderDetail relation
 *
 * @method     ChildOrderDetailStatusQuery leftJoinOrderDetailHistory($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderDetailHistory relation
 * @method     ChildOrderDetailStatusQuery rightJoinOrderDetailHistory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderDetailHistory relation
 * @method     ChildOrderDetailStatusQuery innerJoinOrderDetailHistory($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderDetailHistory relation
 *
 * @method     ChildOrderDetailStatusQuery joinWithOrderDetailHistory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderDetailHistory relation
 *
 * @method     ChildOrderDetailStatusQuery leftJoinWithOrderDetailHistory() Adds a LEFT JOIN clause and with to the query using the OrderDetailHistory relation
 * @method     ChildOrderDetailStatusQuery rightJoinWithOrderDetailHistory() Adds a RIGHT JOIN clause and with to the query using the OrderDetailHistory relation
 * @method     ChildOrderDetailStatusQuery innerJoinWithOrderDetailHistory() Adds a INNER JOIN clause and with to the query using the OrderDetailHistory relation
 *
 * @method     \OrderDetailQuery|\OrderDetailHistoryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOrderDetailStatus|null findOne(ConnectionInterface $con = null) Return the first ChildOrderDetailStatus matching the query
 * @method     ChildOrderDetailStatus findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOrderDetailStatus matching the query, or a new ChildOrderDetailStatus object populated from the query conditions when no match is found
 *
 * @method     ChildOrderDetailStatus|null findOneById(int $id) Return the first ChildOrderDetailStatus filtered by the id column
 * @method     ChildOrderDetailStatus|null findOneByDescription(string $description) Return the first ChildOrderDetailStatus filtered by the description column
 * @method     ChildOrderDetailStatus|null findOneByColor(string $color) Return the first ChildOrderDetailStatus filtered by the color column
 * @method     ChildOrderDetailStatus|null findOneByCreatedAt(string $created_at) Return the first ChildOrderDetailStatus filtered by the created_at column
 * @method     ChildOrderDetailStatus|null findOneByUpdatedAt(string $updated_at) Return the first ChildOrderDetailStatus filtered by the updated_at column *

 * @method     ChildOrderDetailStatus requirePk($key, ConnectionInterface $con = null) Return the ChildOrderDetailStatus by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetailStatus requireOne(ConnectionInterface $con = null) Return the first ChildOrderDetailStatus matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrderDetailStatus requireOneById(int $id) Return the first ChildOrderDetailStatus filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetailStatus requireOneByDescription(string $description) Return the first ChildOrderDetailStatus filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetailStatus requireOneByColor(string $color) Return the first ChildOrderDetailStatus filtered by the color column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetailStatus requireOneByCreatedAt(string $created_at) Return the first ChildOrderDetailStatus filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetailStatus requireOneByUpdatedAt(string $updated_at) Return the first ChildOrderDetailStatus filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrderDetailStatus[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOrderDetailStatus objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetailStatus> find(ConnectionInterface $con = null) Return ChildOrderDetailStatus objects based on current ModelCriteria
 * @method     ChildOrderDetailStatus[]|ObjectCollection findById(int $id) Return ChildOrderDetailStatus objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetailStatus> findById(int $id) Return ChildOrderDetailStatus objects filtered by the id column
 * @method     ChildOrderDetailStatus[]|ObjectCollection findByDescription(string $description) Return ChildOrderDetailStatus objects filtered by the description column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetailStatus> findByDescription(string $description) Return ChildOrderDetailStatus objects filtered by the description column
 * @method     ChildOrderDetailStatus[]|ObjectCollection findByColor(string $color) Return ChildOrderDetailStatus objects filtered by the color column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetailStatus> findByColor(string $color) Return ChildOrderDetailStatus objects filtered by the color column
 * @method     ChildOrderDetailStatus[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildOrderDetailStatus objects filtered by the created_at column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetailStatus> findByCreatedAt(string $created_at) Return ChildOrderDetailStatus objects filtered by the created_at column
 * @method     ChildOrderDetailStatus[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildOrderDetailStatus objects filtered by the updated_at column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetailStatus> findByUpdatedAt(string $updated_at) Return ChildOrderDetailStatus objects filtered by the updated_at column
 * @method     ChildOrderDetailStatus[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOrderDetailStatus> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OrderDetailStatusQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\OrderDetailStatusQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'golden_clean', $modelName = '\\OrderDetailStatus', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOrderDetailStatusQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOrderDetailStatusQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOrderDetailStatusQuery) {
            return $criteria;
        }
        $query = new ChildOrderDetailStatusQuery();
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
     * @return ChildOrderDetailStatus|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OrderDetailStatusTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OrderDetailStatusTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOrderDetailStatus A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, description, color, created_at, updated_at FROM order_detail_status WHERE id = :p0';
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
            /** @var ChildOrderDetailStatus $obj */
            $obj = new ChildOrderDetailStatus();
            $obj->hydrate($row);
            OrderDetailStatusTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOrderDetailStatus|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildOrderDetailStatusQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(OrderDetailStatusTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOrderDetailStatusQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(OrderDetailStatusTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildOrderDetailStatusQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(OrderDetailStatusTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(OrderDetailStatusTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailStatusTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildOrderDetailStatusQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailStatusTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the color column
     *
     * Example usage:
     * <code>
     * $query->filterByColor('fooValue');   // WHERE color = 'fooValue'
     * $query->filterByColor('%fooValue%', Criteria::LIKE); // WHERE color LIKE '%fooValue%'
     * </code>
     *
     * @param     string $color The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderDetailStatusQuery The current query, for fluid interface
     */
    public function filterByColor($color = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($color)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailStatusTableMap::COL_COLOR, $color, $comparison);
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
     * @return $this|ChildOrderDetailStatusQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(OrderDetailStatusTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OrderDetailStatusTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailStatusTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildOrderDetailStatusQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(OrderDetailStatusTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(OrderDetailStatusTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailStatusTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \OrderDetail object
     *
     * @param \OrderDetail|ObjectCollection $orderDetail the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOrderDetailStatusQuery The current query, for fluid interface
     */
    public function filterByOrderDetail($orderDetail, $comparison = null)
    {
        if ($orderDetail instanceof \OrderDetail) {
            return $this
                ->addUsingAlias(OrderDetailStatusTableMap::COL_ID, $orderDetail->getIdOrderDetailStatus(), $comparison);
        } elseif ($orderDetail instanceof ObjectCollection) {
            return $this
                ->useOrderDetailQuery()
                ->filterByPrimaryKeys($orderDetail->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildOrderDetailStatusQuery The current query, for fluid interface
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
     * Filter the query by a related \OrderDetailHistory object
     *
     * @param \OrderDetailHistory|ObjectCollection $orderDetailHistory the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOrderDetailStatusQuery The current query, for fluid interface
     */
    public function filterByOrderDetailHistory($orderDetailHistory, $comparison = null)
    {
        if ($orderDetailHistory instanceof \OrderDetailHistory) {
            return $this
                ->addUsingAlias(OrderDetailStatusTableMap::COL_ID, $orderDetailHistory->getIdOrderDetailStatus(), $comparison);
        } elseif ($orderDetailHistory instanceof ObjectCollection) {
            return $this
                ->useOrderDetailHistoryQuery()
                ->filterByPrimaryKeys($orderDetailHistory->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByOrderDetailHistory() only accepts arguments of type \OrderDetailHistory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrderDetailHistory relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrderDetailStatusQuery The current query, for fluid interface
     */
    public function joinOrderDetailHistory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrderDetailHistory');

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
            $this->addJoinObject($join, 'OrderDetailHistory');
        }

        return $this;
    }

    /**
     * Use the OrderDetailHistory relation OrderDetailHistory object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrderDetailHistoryQuery A secondary query class using the current class as primary query
     */
    public function useOrderDetailHistoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderDetailHistory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrderDetailHistory', '\OrderDetailHistoryQuery');
    }

    /**
     * Use the OrderDetailHistory relation OrderDetailHistory object
     *
     * @param callable(\OrderDetailHistoryQuery):\OrderDetailHistoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrderDetailHistoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrderDetailHistoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to OrderDetailHistory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \OrderDetailHistoryQuery The inner query object of the EXISTS statement
     */
    public function useOrderDetailHistoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('OrderDetailHistory', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to OrderDetailHistory table for a NOT EXISTS query.
     *
     * @see useOrderDetailHistoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \OrderDetailHistoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrderDetailHistoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('OrderDetailHistory', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildOrderDetailStatus $orderDetailStatus Object to remove from the list of results
     *
     * @return $this|ChildOrderDetailStatusQuery The current query, for fluid interface
     */
    public function prune($orderDetailStatus = null)
    {
        if ($orderDetailStatus) {
            $this->addUsingAlias(OrderDetailStatusTableMap::COL_ID, $orderDetailStatus->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the order_detail_status table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderDetailStatusTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OrderDetailStatusTableMap::clearInstancePool();
            OrderDetailStatusTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OrderDetailStatusTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OrderDetailStatusTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OrderDetailStatusTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OrderDetailStatusTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // OrderDetailStatusQuery
