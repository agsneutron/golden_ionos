<?php

namespace Base;

use \PaymentStatus as ChildPaymentStatus;
use \PaymentStatusQuery as ChildPaymentStatusQuery;
use \Exception;
use \PDO;
use Map\PaymentStatusTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'payment_status' table.
 *
 *
 *
 * @method     ChildPaymentStatusQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildPaymentStatusQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildPaymentStatusQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildPaymentStatusQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildPaymentStatusQuery groupById() Group by the id column
 * @method     ChildPaymentStatusQuery groupByDescription() Group by the description column
 * @method     ChildPaymentStatusQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildPaymentStatusQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildPaymentStatusQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPaymentStatusQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPaymentStatusQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPaymentStatusQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPaymentStatusQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPaymentStatusQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPaymentStatusQuery leftJoinOrderHistory($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderHistory relation
 * @method     ChildPaymentStatusQuery rightJoinOrderHistory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderHistory relation
 * @method     ChildPaymentStatusQuery innerJoinOrderHistory($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderHistory relation
 *
 * @method     ChildPaymentStatusQuery joinWithOrderHistory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderHistory relation
 *
 * @method     ChildPaymentStatusQuery leftJoinWithOrderHistory() Adds a LEFT JOIN clause and with to the query using the OrderHistory relation
 * @method     ChildPaymentStatusQuery rightJoinWithOrderHistory() Adds a RIGHT JOIN clause and with to the query using the OrderHistory relation
 * @method     ChildPaymentStatusQuery innerJoinWithOrderHistory() Adds a INNER JOIN clause and with to the query using the OrderHistory relation
 *
 * @method     \OrderHistoryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPaymentStatus|null findOne(ConnectionInterface $con = null) Return the first ChildPaymentStatus matching the query
 * @method     ChildPaymentStatus findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPaymentStatus matching the query, or a new ChildPaymentStatus object populated from the query conditions when no match is found
 *
 * @method     ChildPaymentStatus|null findOneById(int $id) Return the first ChildPaymentStatus filtered by the id column
 * @method     ChildPaymentStatus|null findOneByDescription(string $description) Return the first ChildPaymentStatus filtered by the description column
 * @method     ChildPaymentStatus|null findOneByCreatedAt(string $created_at) Return the first ChildPaymentStatus filtered by the created_at column
 * @method     ChildPaymentStatus|null findOneByUpdatedAt(string $updated_at) Return the first ChildPaymentStatus filtered by the updated_at column *

 * @method     ChildPaymentStatus requirePk($key, ConnectionInterface $con = null) Return the ChildPaymentStatus by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPaymentStatus requireOne(ConnectionInterface $con = null) Return the first ChildPaymentStatus matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPaymentStatus requireOneById(int $id) Return the first ChildPaymentStatus filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPaymentStatus requireOneByDescription(string $description) Return the first ChildPaymentStatus filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPaymentStatus requireOneByCreatedAt(string $created_at) Return the first ChildPaymentStatus filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPaymentStatus requireOneByUpdatedAt(string $updated_at) Return the first ChildPaymentStatus filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPaymentStatus[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPaymentStatus objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildPaymentStatus> find(ConnectionInterface $con = null) Return ChildPaymentStatus objects based on current ModelCriteria
 * @method     ChildPaymentStatus[]|ObjectCollection findById(int $id) Return ChildPaymentStatus objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildPaymentStatus> findById(int $id) Return ChildPaymentStatus objects filtered by the id column
 * @method     ChildPaymentStatus[]|ObjectCollection findByDescription(string $description) Return ChildPaymentStatus objects filtered by the description column
 * @psalm-method ObjectCollection&\Traversable<ChildPaymentStatus> findByDescription(string $description) Return ChildPaymentStatus objects filtered by the description column
 * @method     ChildPaymentStatus[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildPaymentStatus objects filtered by the created_at column
 * @psalm-method ObjectCollection&\Traversable<ChildPaymentStatus> findByCreatedAt(string $created_at) Return ChildPaymentStatus objects filtered by the created_at column
 * @method     ChildPaymentStatus[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildPaymentStatus objects filtered by the updated_at column
 * @psalm-method ObjectCollection&\Traversable<ChildPaymentStatus> findByUpdatedAt(string $updated_at) Return ChildPaymentStatus objects filtered by the updated_at column
 * @method     ChildPaymentStatus[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildPaymentStatus> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PaymentStatusQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PaymentStatusQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'golden_clean', $modelName = '\\PaymentStatus', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPaymentStatusQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPaymentStatusQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPaymentStatusQuery) {
            return $criteria;
        }
        $query = new ChildPaymentStatusQuery();
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
     * @return ChildPaymentStatus|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PaymentStatusTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PaymentStatusTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPaymentStatus A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, description, created_at, updated_at FROM payment_status WHERE id = :p0';
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
            /** @var ChildPaymentStatus $obj */
            $obj = new ChildPaymentStatus();
            $obj->hydrate($row);
            PaymentStatusTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPaymentStatus|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPaymentStatusQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PaymentStatusTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPaymentStatusQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PaymentStatusTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildPaymentStatusQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PaymentStatusTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PaymentStatusTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PaymentStatusTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildPaymentStatusQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PaymentStatusTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildPaymentStatusQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PaymentStatusTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PaymentStatusTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PaymentStatusTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildPaymentStatusQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PaymentStatusTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PaymentStatusTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PaymentStatusTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \OrderHistory object
     *
     * @param \OrderHistory|ObjectCollection $orderHistory the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPaymentStatusQuery The current query, for fluid interface
     */
    public function filterByOrderHistory($orderHistory, $comparison = null)
    {
        if ($orderHistory instanceof \OrderHistory) {
            return $this
                ->addUsingAlias(PaymentStatusTableMap::COL_ID, $orderHistory->getIdPaymentStatus(), $comparison);
        } elseif ($orderHistory instanceof ObjectCollection) {
            return $this
                ->useOrderHistoryQuery()
                ->filterByPrimaryKeys($orderHistory->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByOrderHistory() only accepts arguments of type \OrderHistory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrderHistory relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPaymentStatusQuery The current query, for fluid interface
     */
    public function joinOrderHistory($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrderHistory');

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
            $this->addJoinObject($join, 'OrderHistory');
        }

        return $this;
    }

    /**
     * Use the OrderHistory relation OrderHistory object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrderHistoryQuery A secondary query class using the current class as primary query
     */
    public function useOrderHistoryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOrderHistory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrderHistory', '\OrderHistoryQuery');
    }

    /**
     * Use the OrderHistory relation OrderHistory object
     *
     * @param callable(\OrderHistoryQuery):\OrderHistoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrderHistoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOrderHistoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to OrderHistory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \OrderHistoryQuery The inner query object of the EXISTS statement
     */
    public function useOrderHistoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('OrderHistory', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to OrderHistory table for a NOT EXISTS query.
     *
     * @see useOrderHistoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \OrderHistoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrderHistoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('OrderHistory', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildPaymentStatus $paymentStatus Object to remove from the list of results
     *
     * @return $this|ChildPaymentStatusQuery The current query, for fluid interface
     */
    public function prune($paymentStatus = null)
    {
        if ($paymentStatus) {
            $this->addUsingAlias(PaymentStatusTableMap::COL_ID, $paymentStatus->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the payment_status table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PaymentStatusTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PaymentStatusTableMap::clearInstancePool();
            PaymentStatusTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PaymentStatusTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PaymentStatusTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PaymentStatusTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PaymentStatusTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PaymentStatusQuery
