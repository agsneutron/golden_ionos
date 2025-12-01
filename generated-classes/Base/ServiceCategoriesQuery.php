<?php

namespace Base;

use \ServiceCategories as ChildServiceCategories;
use \ServiceCategoriesQuery as ChildServiceCategoriesQuery;
use \Exception;
use \PDO;
use Map\ServiceCategoriesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'service_categories' table.
 *
 *
 *
 * @method     ChildServiceCategoriesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildServiceCategoriesQuery orderByIdServiceGroup($order = Criteria::ASC) Order by the id_service_group column
 * @method     ChildServiceCategoriesQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildServiceCategoriesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildServiceCategoriesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildServiceCategoriesQuery groupById() Group by the id column
 * @method     ChildServiceCategoriesQuery groupByIdServiceGroup() Group by the id_service_group column
 * @method     ChildServiceCategoriesQuery groupByDescription() Group by the description column
 * @method     ChildServiceCategoriesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildServiceCategoriesQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildServiceCategoriesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildServiceCategoriesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildServiceCategoriesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildServiceCategoriesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildServiceCategoriesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildServiceCategoriesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildServiceCategoriesQuery leftJoinServiceGroups($relationAlias = null) Adds a LEFT JOIN clause to the query using the ServiceGroups relation
 * @method     ChildServiceCategoriesQuery rightJoinServiceGroups($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ServiceGroups relation
 * @method     ChildServiceCategoriesQuery innerJoinServiceGroups($relationAlias = null) Adds a INNER JOIN clause to the query using the ServiceGroups relation
 *
 * @method     ChildServiceCategoriesQuery joinWithServiceGroups($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ServiceGroups relation
 *
 * @method     ChildServiceCategoriesQuery leftJoinWithServiceGroups() Adds a LEFT JOIN clause and with to the query using the ServiceGroups relation
 * @method     ChildServiceCategoriesQuery rightJoinWithServiceGroups() Adds a RIGHT JOIN clause and with to the query using the ServiceGroups relation
 * @method     ChildServiceCategoriesQuery innerJoinWithServiceGroups() Adds a INNER JOIN clause and with to the query using the ServiceGroups relation
 *
 * @method     ChildServiceCategoriesQuery leftJoinServices($relationAlias = null) Adds a LEFT JOIN clause to the query using the Services relation
 * @method     ChildServiceCategoriesQuery rightJoinServices($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Services relation
 * @method     ChildServiceCategoriesQuery innerJoinServices($relationAlias = null) Adds a INNER JOIN clause to the query using the Services relation
 *
 * @method     ChildServiceCategoriesQuery joinWithServices($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Services relation
 *
 * @method     ChildServiceCategoriesQuery leftJoinWithServices() Adds a LEFT JOIN clause and with to the query using the Services relation
 * @method     ChildServiceCategoriesQuery rightJoinWithServices() Adds a RIGHT JOIN clause and with to the query using the Services relation
 * @method     ChildServiceCategoriesQuery innerJoinWithServices() Adds a INNER JOIN clause and with to the query using the Services relation
 *
 * @method     \ServiceGroupsQuery|\ServicesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildServiceCategories|null findOne(ConnectionInterface $con = null) Return the first ChildServiceCategories matching the query
 * @method     ChildServiceCategories findOneOrCreate(ConnectionInterface $con = null) Return the first ChildServiceCategories matching the query, or a new ChildServiceCategories object populated from the query conditions when no match is found
 *
 * @method     ChildServiceCategories|null findOneById(int $id) Return the first ChildServiceCategories filtered by the id column
 * @method     ChildServiceCategories|null findOneByIdServiceGroup(int $id_service_group) Return the first ChildServiceCategories filtered by the id_service_group column
 * @method     ChildServiceCategories|null findOneByDescription(string $description) Return the first ChildServiceCategories filtered by the description column
 * @method     ChildServiceCategories|null findOneByCreatedAt(string $created_at) Return the first ChildServiceCategories filtered by the created_at column
 * @method     ChildServiceCategories|null findOneByUpdatedAt(string $updated_at) Return the first ChildServiceCategories filtered by the updated_at column *

 * @method     ChildServiceCategories requirePk($key, ConnectionInterface $con = null) Return the ChildServiceCategories by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildServiceCategories requireOne(ConnectionInterface $con = null) Return the first ChildServiceCategories matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildServiceCategories requireOneById(int $id) Return the first ChildServiceCategories filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildServiceCategories requireOneByIdServiceGroup(int $id_service_group) Return the first ChildServiceCategories filtered by the id_service_group column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildServiceCategories requireOneByDescription(string $description) Return the first ChildServiceCategories filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildServiceCategories requireOneByCreatedAt(string $created_at) Return the first ChildServiceCategories filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildServiceCategories requireOneByUpdatedAt(string $updated_at) Return the first ChildServiceCategories filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildServiceCategories[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildServiceCategories objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildServiceCategories> find(ConnectionInterface $con = null) Return ChildServiceCategories objects based on current ModelCriteria
 * @method     ChildServiceCategories[]|ObjectCollection findById(int $id) Return ChildServiceCategories objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildServiceCategories> findById(int $id) Return ChildServiceCategories objects filtered by the id column
 * @method     ChildServiceCategories[]|ObjectCollection findByIdServiceGroup(int $id_service_group) Return ChildServiceCategories objects filtered by the id_service_group column
 * @psalm-method ObjectCollection&\Traversable<ChildServiceCategories> findByIdServiceGroup(int $id_service_group) Return ChildServiceCategories objects filtered by the id_service_group column
 * @method     ChildServiceCategories[]|ObjectCollection findByDescription(string $description) Return ChildServiceCategories objects filtered by the description column
 * @psalm-method ObjectCollection&\Traversable<ChildServiceCategories> findByDescription(string $description) Return ChildServiceCategories objects filtered by the description column
 * @method     ChildServiceCategories[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildServiceCategories objects filtered by the created_at column
 * @psalm-method ObjectCollection&\Traversable<ChildServiceCategories> findByCreatedAt(string $created_at) Return ChildServiceCategories objects filtered by the created_at column
 * @method     ChildServiceCategories[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildServiceCategories objects filtered by the updated_at column
 * @psalm-method ObjectCollection&\Traversable<ChildServiceCategories> findByUpdatedAt(string $updated_at) Return ChildServiceCategories objects filtered by the updated_at column
 * @method     ChildServiceCategories[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildServiceCategories> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ServiceCategoriesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ServiceCategoriesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'golden_clean', $modelName = '\\ServiceCategories', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildServiceCategoriesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildServiceCategoriesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildServiceCategoriesQuery) {
            return $criteria;
        }
        $query = new ChildServiceCategoriesQuery();
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
     * @return ChildServiceCategories|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ServiceCategoriesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ServiceCategoriesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildServiceCategories A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_service_group, description, created_at, updated_at FROM service_categories WHERE id = :p0';
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
            /** @var ChildServiceCategories $obj */
            $obj = new ChildServiceCategories();
            $obj->hydrate($row);
            ServiceCategoriesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildServiceCategories|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildServiceCategoriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ServiceCategoriesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildServiceCategoriesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ServiceCategoriesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildServiceCategoriesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ServiceCategoriesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ServiceCategoriesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServiceCategoriesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_service_group column
     *
     * Example usage:
     * <code>
     * $query->filterByIdServiceGroup(1234); // WHERE id_service_group = 1234
     * $query->filterByIdServiceGroup(array(12, 34)); // WHERE id_service_group IN (12, 34)
     * $query->filterByIdServiceGroup(array('min' => 12)); // WHERE id_service_group > 12
     * </code>
     *
     * @see       filterByServiceGroups()
     *
     * @param     mixed $idServiceGroup The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildServiceCategoriesQuery The current query, for fluid interface
     */
    public function filterByIdServiceGroup($idServiceGroup = null, $comparison = null)
    {
        if (is_array($idServiceGroup)) {
            $useMinMax = false;
            if (isset($idServiceGroup['min'])) {
                $this->addUsingAlias(ServiceCategoriesTableMap::COL_ID_SERVICE_GROUP, $idServiceGroup['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idServiceGroup['max'])) {
                $this->addUsingAlias(ServiceCategoriesTableMap::COL_ID_SERVICE_GROUP, $idServiceGroup['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServiceCategoriesTableMap::COL_ID_SERVICE_GROUP, $idServiceGroup, $comparison);
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
     * @return $this|ChildServiceCategoriesQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServiceCategoriesTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildServiceCategoriesQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ServiceCategoriesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ServiceCategoriesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServiceCategoriesTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildServiceCategoriesQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ServiceCategoriesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ServiceCategoriesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServiceCategoriesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \ServiceGroups object
     *
     * @param \ServiceGroups|ObjectCollection $serviceGroups The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildServiceCategoriesQuery The current query, for fluid interface
     */
    public function filterByServiceGroups($serviceGroups, $comparison = null)
    {
        if ($serviceGroups instanceof \ServiceGroups) {
            return $this
                ->addUsingAlias(ServiceCategoriesTableMap::COL_ID_SERVICE_GROUP, $serviceGroups->getId(), $comparison);
        } elseif ($serviceGroups instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ServiceCategoriesTableMap::COL_ID_SERVICE_GROUP, $serviceGroups->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByServiceGroups() only accepts arguments of type \ServiceGroups or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ServiceGroups relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildServiceCategoriesQuery The current query, for fluid interface
     */
    public function joinServiceGroups($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ServiceGroups');

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
            $this->addJoinObject($join, 'ServiceGroups');
        }

        return $this;
    }

    /**
     * Use the ServiceGroups relation ServiceGroups object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ServiceGroupsQuery A secondary query class using the current class as primary query
     */
    public function useServiceGroupsQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinServiceGroups($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ServiceGroups', '\ServiceGroupsQuery');
    }

    /**
     * Use the ServiceGroups relation ServiceGroups object
     *
     * @param callable(\ServiceGroupsQuery):\ServiceGroupsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withServiceGroupsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useServiceGroupsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ServiceGroups table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \ServiceGroupsQuery The inner query object of the EXISTS statement
     */
    public function useServiceGroupsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ServiceGroups', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ServiceGroups table for a NOT EXISTS query.
     *
     * @see useServiceGroupsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \ServiceGroupsQuery The inner query object of the NOT EXISTS statement
     */
    public function useServiceGroupsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ServiceGroups', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Services object
     *
     * @param \Services|ObjectCollection $services the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildServiceCategoriesQuery The current query, for fluid interface
     */
    public function filterByServices($services, $comparison = null)
    {
        if ($services instanceof \Services) {
            return $this
                ->addUsingAlias(ServiceCategoriesTableMap::COL_ID, $services->getIdServiceCategory(), $comparison);
        } elseif ($services instanceof ObjectCollection) {
            return $this
                ->useServicesQuery()
                ->filterByPrimaryKeys($services->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByServices() only accepts arguments of type \Services or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Services relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildServiceCategoriesQuery The current query, for fluid interface
     */
    public function joinServices($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Services');

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
            $this->addJoinObject($join, 'Services');
        }

        return $this;
    }

    /**
     * Use the Services relation Services object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ServicesQuery A secondary query class using the current class as primary query
     */
    public function useServicesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinServices($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Services', '\ServicesQuery');
    }

    /**
     * Use the Services relation Services object
     *
     * @param callable(\ServicesQuery):\ServicesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withServicesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useServicesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Services table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \ServicesQuery The inner query object of the EXISTS statement
     */
    public function useServicesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Services', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Services table for a NOT EXISTS query.
     *
     * @see useServicesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \ServicesQuery The inner query object of the NOT EXISTS statement
     */
    public function useServicesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Services', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildServiceCategories $serviceCategories Object to remove from the list of results
     *
     * @return $this|ChildServiceCategoriesQuery The current query, for fluid interface
     */
    public function prune($serviceCategories = null)
    {
        if ($serviceCategories) {
            $this->addUsingAlias(ServiceCategoriesTableMap::COL_ID, $serviceCategories->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the service_categories table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ServiceCategoriesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ServiceCategoriesTableMap::clearInstancePool();
            ServiceCategoriesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ServiceCategoriesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ServiceCategoriesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ServiceCategoriesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ServiceCategoriesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ServiceCategoriesQuery
