<?php

namespace Base;

use \ProfilePermissions as ChildProfilePermissions;
use \ProfilePermissionsQuery as ChildProfilePermissionsQuery;
use \Exception;
use \PDO;
use Map\ProfilePermissionsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'profile_permissions' table.
 *
 *
 *
 * @method     ChildProfilePermissionsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildProfilePermissionsQuery orderByIdUserType($order = Criteria::ASC) Order by the id_user_type column
 * @method     ChildProfilePermissionsQuery orderByIdModule($order = Criteria::ASC) Order by the id_module column
 * @method     ChildProfilePermissionsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildProfilePermissionsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildProfilePermissionsQuery groupById() Group by the id column
 * @method     ChildProfilePermissionsQuery groupByIdUserType() Group by the id_user_type column
 * @method     ChildProfilePermissionsQuery groupByIdModule() Group by the id_module column
 * @method     ChildProfilePermissionsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildProfilePermissionsQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildProfilePermissionsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProfilePermissionsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProfilePermissionsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProfilePermissionsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildProfilePermissionsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildProfilePermissionsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildProfilePermissionsQuery leftJoinModules($relationAlias = null) Adds a LEFT JOIN clause to the query using the Modules relation
 * @method     ChildProfilePermissionsQuery rightJoinModules($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Modules relation
 * @method     ChildProfilePermissionsQuery innerJoinModules($relationAlias = null) Adds a INNER JOIN clause to the query using the Modules relation
 *
 * @method     ChildProfilePermissionsQuery joinWithModules($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Modules relation
 *
 * @method     ChildProfilePermissionsQuery leftJoinWithModules() Adds a LEFT JOIN clause and with to the query using the Modules relation
 * @method     ChildProfilePermissionsQuery rightJoinWithModules() Adds a RIGHT JOIN clause and with to the query using the Modules relation
 * @method     ChildProfilePermissionsQuery innerJoinWithModules() Adds a INNER JOIN clause and with to the query using the Modules relation
 *
 * @method     ChildProfilePermissionsQuery leftJoinUserTypes($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserTypes relation
 * @method     ChildProfilePermissionsQuery rightJoinUserTypes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserTypes relation
 * @method     ChildProfilePermissionsQuery innerJoinUserTypes($relationAlias = null) Adds a INNER JOIN clause to the query using the UserTypes relation
 *
 * @method     ChildProfilePermissionsQuery joinWithUserTypes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserTypes relation
 *
 * @method     ChildProfilePermissionsQuery leftJoinWithUserTypes() Adds a LEFT JOIN clause and with to the query using the UserTypes relation
 * @method     ChildProfilePermissionsQuery rightJoinWithUserTypes() Adds a RIGHT JOIN clause and with to the query using the UserTypes relation
 * @method     ChildProfilePermissionsQuery innerJoinWithUserTypes() Adds a INNER JOIN clause and with to the query using the UserTypes relation
 *
 * @method     \ModulesQuery|\UserTypesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProfilePermissions|null findOne(ConnectionInterface $con = null) Return the first ChildProfilePermissions matching the query
 * @method     ChildProfilePermissions findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProfilePermissions matching the query, or a new ChildProfilePermissions object populated from the query conditions when no match is found
 *
 * @method     ChildProfilePermissions|null findOneById(int $id) Return the first ChildProfilePermissions filtered by the id column
 * @method     ChildProfilePermissions|null findOneByIdUserType(int $id_user_type) Return the first ChildProfilePermissions filtered by the id_user_type column
 * @method     ChildProfilePermissions|null findOneByIdModule(int $id_module) Return the first ChildProfilePermissions filtered by the id_module column
 * @method     ChildProfilePermissions|null findOneByCreatedAt(string $created_at) Return the first ChildProfilePermissions filtered by the created_at column
 * @method     ChildProfilePermissions|null findOneByUpdatedAt(string $updated_at) Return the first ChildProfilePermissions filtered by the updated_at column *

 * @method     ChildProfilePermissions requirePk($key, ConnectionInterface $con = null) Return the ChildProfilePermissions by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProfilePermissions requireOne(ConnectionInterface $con = null) Return the first ChildProfilePermissions matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProfilePermissions requireOneById(int $id) Return the first ChildProfilePermissions filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProfilePermissions requireOneByIdUserType(int $id_user_type) Return the first ChildProfilePermissions filtered by the id_user_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProfilePermissions requireOneByIdModule(int $id_module) Return the first ChildProfilePermissions filtered by the id_module column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProfilePermissions requireOneByCreatedAt(string $created_at) Return the first ChildProfilePermissions filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProfilePermissions requireOneByUpdatedAt(string $updated_at) Return the first ChildProfilePermissions filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProfilePermissions[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProfilePermissions objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildProfilePermissions> find(ConnectionInterface $con = null) Return ChildProfilePermissions objects based on current ModelCriteria
 * @method     ChildProfilePermissions[]|ObjectCollection findById(int $id) Return ChildProfilePermissions objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildProfilePermissions> findById(int $id) Return ChildProfilePermissions objects filtered by the id column
 * @method     ChildProfilePermissions[]|ObjectCollection findByIdUserType(int $id_user_type) Return ChildProfilePermissions objects filtered by the id_user_type column
 * @psalm-method ObjectCollection&\Traversable<ChildProfilePermissions> findByIdUserType(int $id_user_type) Return ChildProfilePermissions objects filtered by the id_user_type column
 * @method     ChildProfilePermissions[]|ObjectCollection findByIdModule(int $id_module) Return ChildProfilePermissions objects filtered by the id_module column
 * @psalm-method ObjectCollection&\Traversable<ChildProfilePermissions> findByIdModule(int $id_module) Return ChildProfilePermissions objects filtered by the id_module column
 * @method     ChildProfilePermissions[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildProfilePermissions objects filtered by the created_at column
 * @psalm-method ObjectCollection&\Traversable<ChildProfilePermissions> findByCreatedAt(string $created_at) Return ChildProfilePermissions objects filtered by the created_at column
 * @method     ChildProfilePermissions[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildProfilePermissions objects filtered by the updated_at column
 * @psalm-method ObjectCollection&\Traversable<ChildProfilePermissions> findByUpdatedAt(string $updated_at) Return ChildProfilePermissions objects filtered by the updated_at column
 * @method     ChildProfilePermissions[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildProfilePermissions> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProfilePermissionsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ProfilePermissionsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'golden_clean', $modelName = '\\ProfilePermissions', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProfilePermissionsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProfilePermissionsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProfilePermissionsQuery) {
            return $criteria;
        }
        $query = new ChildProfilePermissionsQuery();
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
     * @return ChildProfilePermissions|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProfilePermissionsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ProfilePermissionsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildProfilePermissions A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_user_type, id_module, created_at, updated_at FROM profile_permissions WHERE id = :p0';
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
            /** @var ChildProfilePermissions $obj */
            $obj = new ChildProfilePermissions();
            $obj->hydrate($row);
            ProfilePermissionsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildProfilePermissions|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProfilePermissionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProfilePermissionsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProfilePermissionsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProfilePermissionsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildProfilePermissionsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProfilePermissionsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProfilePermissionsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProfilePermissionsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_user_type column
     *
     * Example usage:
     * <code>
     * $query->filterByIdUserType(1234); // WHERE id_user_type = 1234
     * $query->filterByIdUserType(array(12, 34)); // WHERE id_user_type IN (12, 34)
     * $query->filterByIdUserType(array('min' => 12)); // WHERE id_user_type > 12
     * </code>
     *
     * @see       filterByUserTypes()
     *
     * @param     mixed $idUserType The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProfilePermissionsQuery The current query, for fluid interface
     */
    public function filterByIdUserType($idUserType = null, $comparison = null)
    {
        if (is_array($idUserType)) {
            $useMinMax = false;
            if (isset($idUserType['min'])) {
                $this->addUsingAlias(ProfilePermissionsTableMap::COL_ID_USER_TYPE, $idUserType['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUserType['max'])) {
                $this->addUsingAlias(ProfilePermissionsTableMap::COL_ID_USER_TYPE, $idUserType['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProfilePermissionsTableMap::COL_ID_USER_TYPE, $idUserType, $comparison);
    }

    /**
     * Filter the query on the id_module column
     *
     * Example usage:
     * <code>
     * $query->filterByIdModule(1234); // WHERE id_module = 1234
     * $query->filterByIdModule(array(12, 34)); // WHERE id_module IN (12, 34)
     * $query->filterByIdModule(array('min' => 12)); // WHERE id_module > 12
     * </code>
     *
     * @see       filterByModules()
     *
     * @param     mixed $idModule The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProfilePermissionsQuery The current query, for fluid interface
     */
    public function filterByIdModule($idModule = null, $comparison = null)
    {
        if (is_array($idModule)) {
            $useMinMax = false;
            if (isset($idModule['min'])) {
                $this->addUsingAlias(ProfilePermissionsTableMap::COL_ID_MODULE, $idModule['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idModule['max'])) {
                $this->addUsingAlias(ProfilePermissionsTableMap::COL_ID_MODULE, $idModule['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProfilePermissionsTableMap::COL_ID_MODULE, $idModule, $comparison);
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
     * @return $this|ChildProfilePermissionsQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ProfilePermissionsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ProfilePermissionsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProfilePermissionsTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildProfilePermissionsQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ProfilePermissionsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ProfilePermissionsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProfilePermissionsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Modules object
     *
     * @param \Modules|ObjectCollection $modules The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProfilePermissionsQuery The current query, for fluid interface
     */
    public function filterByModules($modules, $comparison = null)
    {
        if ($modules instanceof \Modules) {
            return $this
                ->addUsingAlias(ProfilePermissionsTableMap::COL_ID_MODULE, $modules->getId(), $comparison);
        } elseif ($modules instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProfilePermissionsTableMap::COL_ID_MODULE, $modules->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByModules() only accepts arguments of type \Modules or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Modules relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProfilePermissionsQuery The current query, for fluid interface
     */
    public function joinModules($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Modules');

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
            $this->addJoinObject($join, 'Modules');
        }

        return $this;
    }

    /**
     * Use the Modules relation Modules object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ModulesQuery A secondary query class using the current class as primary query
     */
    public function useModulesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinModules($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Modules', '\ModulesQuery');
    }

    /**
     * Use the Modules relation Modules object
     *
     * @param callable(\ModulesQuery):\ModulesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withModulesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useModulesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Modules table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \ModulesQuery The inner query object of the EXISTS statement
     */
    public function useModulesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Modules', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Modules table for a NOT EXISTS query.
     *
     * @see useModulesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \ModulesQuery The inner query object of the NOT EXISTS statement
     */
    public function useModulesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Modules', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \UserTypes object
     *
     * @param \UserTypes|ObjectCollection $userTypes The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProfilePermissionsQuery The current query, for fluid interface
     */
    public function filterByUserTypes($userTypes, $comparison = null)
    {
        if ($userTypes instanceof \UserTypes) {
            return $this
                ->addUsingAlias(ProfilePermissionsTableMap::COL_ID_USER_TYPE, $userTypes->getId(), $comparison);
        } elseif ($userTypes instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ProfilePermissionsTableMap::COL_ID_USER_TYPE, $userTypes->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUserTypes() only accepts arguments of type \UserTypes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserTypes relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildProfilePermissionsQuery The current query, for fluid interface
     */
    public function joinUserTypes($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserTypes');

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
            $this->addJoinObject($join, 'UserTypes');
        }

        return $this;
    }

    /**
     * Use the UserTypes relation UserTypes object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserTypesQuery A secondary query class using the current class as primary query
     */
    public function useUserTypesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserTypes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserTypes', '\UserTypesQuery');
    }

    /**
     * Use the UserTypes relation UserTypes object
     *
     * @param callable(\UserTypesQuery):\UserTypesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUserTypesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUserTypesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to UserTypes table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \UserTypesQuery The inner query object of the EXISTS statement
     */
    public function useUserTypesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('UserTypes', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to UserTypes table for a NOT EXISTS query.
     *
     * @see useUserTypesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \UserTypesQuery The inner query object of the NOT EXISTS statement
     */
    public function useUserTypesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('UserTypes', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildProfilePermissions $profilePermissions Object to remove from the list of results
     *
     * @return $this|ChildProfilePermissionsQuery The current query, for fluid interface
     */
    public function prune($profilePermissions = null)
    {
        if ($profilePermissions) {
            $this->addUsingAlias(ProfilePermissionsTableMap::COL_ID, $profilePermissions->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the profile_permissions table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProfilePermissionsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProfilePermissionsTableMap::clearInstancePool();
            ProfilePermissionsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProfilePermissionsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProfilePermissionsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ProfilePermissionsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ProfilePermissionsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProfilePermissionsQuery
