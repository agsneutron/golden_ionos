<?php

namespace Base;

use \Modules as ChildModules;
use \ModulesQuery as ChildModulesQuery;
use \Exception;
use \PDO;
use Map\ModulesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'modules' table.
 *
 *
 *
 * @method     ChildModulesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildModulesQuery orderByIdGroup($order = Criteria::ASC) Order by the id_group column
 * @method     ChildModulesQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildModulesQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method     ChildModulesQuery orderByIcon($order = Criteria::ASC) Order by the icon column
 * @method     ChildModulesQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildModulesQuery orderByOrder($order = Criteria::ASC) Order by the order column
 * @method     ChildModulesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildModulesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildModulesQuery groupById() Group by the id column
 * @method     ChildModulesQuery groupByIdGroup() Group by the id_group column
 * @method     ChildModulesQuery groupByName() Group by the name column
 * @method     ChildModulesQuery groupByUrl() Group by the url column
 * @method     ChildModulesQuery groupByIcon() Group by the icon column
 * @method     ChildModulesQuery groupByActive() Group by the active column
 * @method     ChildModulesQuery groupByOrder() Group by the order column
 * @method     ChildModulesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildModulesQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildModulesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildModulesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildModulesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildModulesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildModulesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildModulesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildModulesQuery leftJoinGroups($relationAlias = null) Adds a LEFT JOIN clause to the query using the Groups relation
 * @method     ChildModulesQuery rightJoinGroups($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Groups relation
 * @method     ChildModulesQuery innerJoinGroups($relationAlias = null) Adds a INNER JOIN clause to the query using the Groups relation
 *
 * @method     ChildModulesQuery joinWithGroups($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Groups relation
 *
 * @method     ChildModulesQuery leftJoinWithGroups() Adds a LEFT JOIN clause and with to the query using the Groups relation
 * @method     ChildModulesQuery rightJoinWithGroups() Adds a RIGHT JOIN clause and with to the query using the Groups relation
 * @method     ChildModulesQuery innerJoinWithGroups() Adds a INNER JOIN clause and with to the query using the Groups relation
 *
 * @method     ChildModulesQuery leftJoinProfilePermissions($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProfilePermissions relation
 * @method     ChildModulesQuery rightJoinProfilePermissions($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProfilePermissions relation
 * @method     ChildModulesQuery innerJoinProfilePermissions($relationAlias = null) Adds a INNER JOIN clause to the query using the ProfilePermissions relation
 *
 * @method     ChildModulesQuery joinWithProfilePermissions($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ProfilePermissions relation
 *
 * @method     ChildModulesQuery leftJoinWithProfilePermissions() Adds a LEFT JOIN clause and with to the query using the ProfilePermissions relation
 * @method     ChildModulesQuery rightJoinWithProfilePermissions() Adds a RIGHT JOIN clause and with to the query using the ProfilePermissions relation
 * @method     ChildModulesQuery innerJoinWithProfilePermissions() Adds a INNER JOIN clause and with to the query using the ProfilePermissions relation
 *
 * @method     \GroupsQuery|\ProfilePermissionsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildModules|null findOne(ConnectionInterface $con = null) Return the first ChildModules matching the query
 * @method     ChildModules findOneOrCreate(ConnectionInterface $con = null) Return the first ChildModules matching the query, or a new ChildModules object populated from the query conditions when no match is found
 *
 * @method     ChildModules|null findOneById(int $id) Return the first ChildModules filtered by the id column
 * @method     ChildModules|null findOneByIdGroup(int $id_group) Return the first ChildModules filtered by the id_group column
 * @method     ChildModules|null findOneByName(string $name) Return the first ChildModules filtered by the name column
 * @method     ChildModules|null findOneByUrl(string $url) Return the first ChildModules filtered by the url column
 * @method     ChildModules|null findOneByIcon(string $icon) Return the first ChildModules filtered by the icon column
 * @method     ChildModules|null findOneByActive(int $active) Return the first ChildModules filtered by the active column
 * @method     ChildModules|null findOneByOrder(int $order) Return the first ChildModules filtered by the order column
 * @method     ChildModules|null findOneByCreatedAt(string $created_at) Return the first ChildModules filtered by the created_at column
 * @method     ChildModules|null findOneByUpdatedAt(string $updated_at) Return the first ChildModules filtered by the updated_at column *

 * @method     ChildModules requirePk($key, ConnectionInterface $con = null) Return the ChildModules by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildModules requireOne(ConnectionInterface $con = null) Return the first ChildModules matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildModules requireOneById(int $id) Return the first ChildModules filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildModules requireOneByIdGroup(int $id_group) Return the first ChildModules filtered by the id_group column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildModules requireOneByName(string $name) Return the first ChildModules filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildModules requireOneByUrl(string $url) Return the first ChildModules filtered by the url column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildModules requireOneByIcon(string $icon) Return the first ChildModules filtered by the icon column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildModules requireOneByActive(int $active) Return the first ChildModules filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildModules requireOneByOrder(int $order) Return the first ChildModules filtered by the order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildModules requireOneByCreatedAt(string $created_at) Return the first ChildModules filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildModules requireOneByUpdatedAt(string $updated_at) Return the first ChildModules filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildModules[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildModules objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildModules> find(ConnectionInterface $con = null) Return ChildModules objects based on current ModelCriteria
 * @method     ChildModules[]|ObjectCollection findById(int $id) Return ChildModules objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildModules> findById(int $id) Return ChildModules objects filtered by the id column
 * @method     ChildModules[]|ObjectCollection findByIdGroup(int $id_group) Return ChildModules objects filtered by the id_group column
 * @psalm-method ObjectCollection&\Traversable<ChildModules> findByIdGroup(int $id_group) Return ChildModules objects filtered by the id_group column
 * @method     ChildModules[]|ObjectCollection findByName(string $name) Return ChildModules objects filtered by the name column
 * @psalm-method ObjectCollection&\Traversable<ChildModules> findByName(string $name) Return ChildModules objects filtered by the name column
 * @method     ChildModules[]|ObjectCollection findByUrl(string $url) Return ChildModules objects filtered by the url column
 * @psalm-method ObjectCollection&\Traversable<ChildModules> findByUrl(string $url) Return ChildModules objects filtered by the url column
 * @method     ChildModules[]|ObjectCollection findByIcon(string $icon) Return ChildModules objects filtered by the icon column
 * @psalm-method ObjectCollection&\Traversable<ChildModules> findByIcon(string $icon) Return ChildModules objects filtered by the icon column
 * @method     ChildModules[]|ObjectCollection findByActive(int $active) Return ChildModules objects filtered by the active column
 * @psalm-method ObjectCollection&\Traversable<ChildModules> findByActive(int $active) Return ChildModules objects filtered by the active column
 * @method     ChildModules[]|ObjectCollection findByOrder(int $order) Return ChildModules objects filtered by the order column
 * @psalm-method ObjectCollection&\Traversable<ChildModules> findByOrder(int $order) Return ChildModules objects filtered by the order column
 * @method     ChildModules[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildModules objects filtered by the created_at column
 * @psalm-method ObjectCollection&\Traversable<ChildModules> findByCreatedAt(string $created_at) Return ChildModules objects filtered by the created_at column
 * @method     ChildModules[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildModules objects filtered by the updated_at column
 * @psalm-method ObjectCollection&\Traversable<ChildModules> findByUpdatedAt(string $updated_at) Return ChildModules objects filtered by the updated_at column
 * @method     ChildModules[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildModules> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ModulesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ModulesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'golden_clean', $modelName = '\\Modules', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildModulesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildModulesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildModulesQuery) {
            return $criteria;
        }
        $query = new ChildModulesQuery();
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
     * @return ChildModules|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ModulesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ModulesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildModules A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_group, name, url, icon, active, order, created_at, updated_at FROM modules WHERE id = :p0';
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
            /** @var ChildModules $obj */
            $obj = new ChildModules();
            $obj->hydrate($row);
            ModulesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildModules|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildModulesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ModulesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildModulesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ModulesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildModulesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ModulesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ModulesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ModulesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_group column
     *
     * Example usage:
     * <code>
     * $query->filterByIdGroup(1234); // WHERE id_group = 1234
     * $query->filterByIdGroup(array(12, 34)); // WHERE id_group IN (12, 34)
     * $query->filterByIdGroup(array('min' => 12)); // WHERE id_group > 12
     * </code>
     *
     * @see       filterByGroups()
     *
     * @param     mixed $idGroup The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildModulesQuery The current query, for fluid interface
     */
    public function filterByIdGroup($idGroup = null, $comparison = null)
    {
        if (is_array($idGroup)) {
            $useMinMax = false;
            if (isset($idGroup['min'])) {
                $this->addUsingAlias(ModulesTableMap::COL_ID_GROUP, $idGroup['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idGroup['max'])) {
                $this->addUsingAlias(ModulesTableMap::COL_ID_GROUP, $idGroup['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ModulesTableMap::COL_ID_GROUP, $idGroup, $comparison);
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
     * @return $this|ChildModulesQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ModulesTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%', Criteria::LIKE); // WHERE url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $url The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildModulesQuery The current query, for fluid interface
     */
    public function filterByUrl($url = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($url)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ModulesTableMap::COL_URL, $url, $comparison);
    }

    /**
     * Filter the query on the icon column
     *
     * Example usage:
     * <code>
     * $query->filterByIcon('fooValue');   // WHERE icon = 'fooValue'
     * $query->filterByIcon('%fooValue%', Criteria::LIKE); // WHERE icon LIKE '%fooValue%'
     * </code>
     *
     * @param     string $icon The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildModulesQuery The current query, for fluid interface
     */
    public function filterByIcon($icon = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($icon)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ModulesTableMap::COL_ICON, $icon, $comparison);
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(1234); // WHERE active = 1234
     * $query->filterByActive(array(12, 34)); // WHERE active IN (12, 34)
     * $query->filterByActive(array('min' => 12)); // WHERE active > 12
     * </code>
     *
     * @param     mixed $active The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildModulesQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_array($active)) {
            $useMinMax = false;
            if (isset($active['min'])) {
                $this->addUsingAlias(ModulesTableMap::COL_ACTIVE, $active['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($active['max'])) {
                $this->addUsingAlias(ModulesTableMap::COL_ACTIVE, $active['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ModulesTableMap::COL_ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query on the order column
     *
     * Example usage:
     * <code>
     * $query->filterByOrder(1234); // WHERE order = 1234
     * $query->filterByOrder(array(12, 34)); // WHERE order IN (12, 34)
     * $query->filterByOrder(array('min' => 12)); // WHERE order > 12
     * </code>
     *
     * @param     mixed $order The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildModulesQuery The current query, for fluid interface
     */
    public function filterByOrder($order = null, $comparison = null)
    {
        if (is_array($order)) {
            $useMinMax = false;
            if (isset($order['min'])) {
                $this->addUsingAlias(ModulesTableMap::COL_ORDER, $order['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($order['max'])) {
                $this->addUsingAlias(ModulesTableMap::COL_ORDER, $order['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ModulesTableMap::COL_ORDER, $order, $comparison);
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
     * @return $this|ChildModulesQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ModulesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ModulesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ModulesTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildModulesQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ModulesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ModulesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ModulesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Groups object
     *
     * @param \Groups|ObjectCollection $groups The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildModulesQuery The current query, for fluid interface
     */
    public function filterByGroups($groups, $comparison = null)
    {
        if ($groups instanceof \Groups) {
            return $this
                ->addUsingAlias(ModulesTableMap::COL_ID_GROUP, $groups->getId(), $comparison);
        } elseif ($groups instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ModulesTableMap::COL_ID_GROUP, $groups->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByGroups() only accepts arguments of type \Groups or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Groups relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildModulesQuery The current query, for fluid interface
     */
    public function joinGroups($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Groups');

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
            $this->addJoinObject($join, 'Groups');
        }

        return $this;
    }

    /**
     * Use the Groups relation Groups object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \GroupsQuery A secondary query class using the current class as primary query
     */
    public function useGroupsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinGroups($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Groups', '\GroupsQuery');
    }

    /**
     * Use the Groups relation Groups object
     *
     * @param callable(\GroupsQuery):\GroupsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withGroupsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useGroupsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Groups table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \GroupsQuery The inner query object of the EXISTS statement
     */
    public function useGroupsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Groups', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Groups table for a NOT EXISTS query.
     *
     * @see useGroupsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \GroupsQuery The inner query object of the NOT EXISTS statement
     */
    public function useGroupsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Groups', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \ProfilePermissions object
     *
     * @param \ProfilePermissions|ObjectCollection $profilePermissions the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildModulesQuery The current query, for fluid interface
     */
    public function filterByProfilePermissions($profilePermissions, $comparison = null)
    {
        if ($profilePermissions instanceof \ProfilePermissions) {
            return $this
                ->addUsingAlias(ModulesTableMap::COL_ID, $profilePermissions->getIdModule(), $comparison);
        } elseif ($profilePermissions instanceof ObjectCollection) {
            return $this
                ->useProfilePermissionsQuery()
                ->filterByPrimaryKeys($profilePermissions->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProfilePermissions() only accepts arguments of type \ProfilePermissions or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProfilePermissions relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildModulesQuery The current query, for fluid interface
     */
    public function joinProfilePermissions($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProfilePermissions');

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
            $this->addJoinObject($join, 'ProfilePermissions');
        }

        return $this;
    }

    /**
     * Use the ProfilePermissions relation ProfilePermissions object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ProfilePermissionsQuery A secondary query class using the current class as primary query
     */
    public function useProfilePermissionsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProfilePermissions($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProfilePermissions', '\ProfilePermissionsQuery');
    }

    /**
     * Use the ProfilePermissions relation ProfilePermissions object
     *
     * @param callable(\ProfilePermissionsQuery):\ProfilePermissionsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withProfilePermissionsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useProfilePermissionsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ProfilePermissions table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \ProfilePermissionsQuery The inner query object of the EXISTS statement
     */
    public function useProfilePermissionsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ProfilePermissions', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ProfilePermissions table for a NOT EXISTS query.
     *
     * @see useProfilePermissionsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \ProfilePermissionsQuery The inner query object of the NOT EXISTS statement
     */
    public function useProfilePermissionsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ProfilePermissions', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildModules $modules Object to remove from the list of results
     *
     * @return $this|ChildModulesQuery The current query, for fluid interface
     */
    public function prune($modules = null)
    {
        if ($modules) {
            $this->addUsingAlias(ModulesTableMap::COL_ID, $modules->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the modules table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ModulesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ModulesTableMap::clearInstancePool();
            ModulesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ModulesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ModulesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ModulesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ModulesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ModulesQuery
