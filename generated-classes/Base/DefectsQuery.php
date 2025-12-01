<?php

namespace Base;

use \Defects as ChildDefects;
use \DefectsQuery as ChildDefectsQuery;
use \Exception;
use \PDO;
use Map\DefectsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'defects' table.
 *
 *
 *
 * @method     ChildDefectsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildDefectsQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildDefectsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildDefectsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildDefectsQuery groupById() Group by the id column
 * @method     ChildDefectsQuery groupByDescription() Group by the description column
 * @method     ChildDefectsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildDefectsQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildDefectsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDefectsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDefectsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDefectsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDefectsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDefectsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDefectsQuery leftJoinOrderDetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderDetail relation
 * @method     ChildDefectsQuery rightJoinOrderDetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderDetail relation
 * @method     ChildDefectsQuery innerJoinOrderDetail($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderDetail relation
 *
 * @method     ChildDefectsQuery joinWithOrderDetail($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderDetail relation
 *
 * @method     ChildDefectsQuery leftJoinWithOrderDetail() Adds a LEFT JOIN clause and with to the query using the OrderDetail relation
 * @method     ChildDefectsQuery rightJoinWithOrderDetail() Adds a RIGHT JOIN clause and with to the query using the OrderDetail relation
 * @method     ChildDefectsQuery innerJoinWithOrderDetail() Adds a INNER JOIN clause and with to the query using the OrderDetail relation
 *
 * @method     \OrderDetailQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDefects|null findOne(ConnectionInterface $con = null) Return the first ChildDefects matching the query
 * @method     ChildDefects findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDefects matching the query, or a new ChildDefects object populated from the query conditions when no match is found
 *
 * @method     ChildDefects|null findOneById(int $id) Return the first ChildDefects filtered by the id column
 * @method     ChildDefects|null findOneByDescription(string $description) Return the first ChildDefects filtered by the description column
 * @method     ChildDefects|null findOneByCreatedAt(string $created_at) Return the first ChildDefects filtered by the created_at column
 * @method     ChildDefects|null findOneByUpdatedAt(string $updated_at) Return the first ChildDefects filtered by the updated_at column *

 * @method     ChildDefects requirePk($key, ConnectionInterface $con = null) Return the ChildDefects by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDefects requireOne(ConnectionInterface $con = null) Return the first ChildDefects matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDefects requireOneById(int $id) Return the first ChildDefects filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDefects requireOneByDescription(string $description) Return the first ChildDefects filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDefects requireOneByCreatedAt(string $created_at) Return the first ChildDefects filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDefects requireOneByUpdatedAt(string $updated_at) Return the first ChildDefects filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDefects[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDefects objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildDefects> find(ConnectionInterface $con = null) Return ChildDefects objects based on current ModelCriteria
 * @method     ChildDefects[]|ObjectCollection findById(int $id) Return ChildDefects objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildDefects> findById(int $id) Return ChildDefects objects filtered by the id column
 * @method     ChildDefects[]|ObjectCollection findByDescription(string $description) Return ChildDefects objects filtered by the description column
 * @psalm-method ObjectCollection&\Traversable<ChildDefects> findByDescription(string $description) Return ChildDefects objects filtered by the description column
 * @method     ChildDefects[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildDefects objects filtered by the created_at column
 * @psalm-method ObjectCollection&\Traversable<ChildDefects> findByCreatedAt(string $created_at) Return ChildDefects objects filtered by the created_at column
 * @method     ChildDefects[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildDefects objects filtered by the updated_at column
 * @psalm-method ObjectCollection&\Traversable<ChildDefects> findByUpdatedAt(string $updated_at) Return ChildDefects objects filtered by the updated_at column
 * @method     ChildDefects[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildDefects> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DefectsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\DefectsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'golden_clean', $modelName = '\\Defects', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDefectsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDefectsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDefectsQuery) {
            return $criteria;
        }
        $query = new ChildDefectsQuery();
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
     * @return ChildDefects|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DefectsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DefectsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDefects A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, description, created_at, updated_at FROM defects WHERE id = :p0';
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
            /** @var ChildDefects $obj */
            $obj = new ChildDefects();
            $obj->hydrate($row);
            DefectsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDefects|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildDefectsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DefectsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDefectsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DefectsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildDefectsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(DefectsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(DefectsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DefectsTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildDefectsQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DefectsTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildDefectsQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(DefectsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(DefectsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DefectsTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildDefectsQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(DefectsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(DefectsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DefectsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \OrderDetail object
     *
     * @param \OrderDetail|ObjectCollection $orderDetail the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDefectsQuery The current query, for fluid interface
     */
    public function filterByOrderDetail($orderDetail, $comparison = null)
    {
        if ($orderDetail instanceof \OrderDetail) {
            return $this
                ->addUsingAlias(DefectsTableMap::COL_ID, $orderDetail->getIdDefect(), $comparison);
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
     * @return $this|ChildDefectsQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildDefects $defects Object to remove from the list of results
     *
     * @return $this|ChildDefectsQuery The current query, for fluid interface
     */
    public function prune($defects = null)
    {
        if ($defects) {
            $this->addUsingAlias(DefectsTableMap::COL_ID, $defects->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the defects table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DefectsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DefectsTableMap::clearInstancePool();
            DefectsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DefectsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DefectsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DefectsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DefectsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // DefectsQuery
