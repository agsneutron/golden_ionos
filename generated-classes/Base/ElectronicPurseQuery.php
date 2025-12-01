<?php

namespace Base;

use \ElectronicPurse as ChildElectronicPurse;
use \ElectronicPurseQuery as ChildElectronicPurseQuery;
use \Exception;
use \PDO;
use Map\ElectronicPurseTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'electronic_purse' table.
 *
 *
 *
 * @method     ChildElectronicPurseQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildElectronicPurseQuery orderByIdClientUser($order = Criteria::ASC) Order by the id_client_user column
 * @method     ChildElectronicPurseQuery orderByCode($order = Criteria::ASC) Order by the code column
 * @method     ChildElectronicPurseQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildElectronicPurseQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildElectronicPurseQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildElectronicPurseQuery groupById() Group by the id column
 * @method     ChildElectronicPurseQuery groupByIdClientUser() Group by the id_client_user column
 * @method     ChildElectronicPurseQuery groupByCode() Group by the code column
 * @method     ChildElectronicPurseQuery groupByAmount() Group by the amount column
 * @method     ChildElectronicPurseQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildElectronicPurseQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildElectronicPurseQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildElectronicPurseQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildElectronicPurseQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildElectronicPurseQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildElectronicPurseQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildElectronicPurseQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildElectronicPurseQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildElectronicPurseQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildElectronicPurseQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildElectronicPurseQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildElectronicPurseQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildElectronicPurseQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildElectronicPurseQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     ChildElectronicPurseQuery leftJoinElectronicPurseHistory($relationAlias = null) Adds a LEFT JOIN clause to the query using the ElectronicPurseHistory relation
 * @method     ChildElectronicPurseQuery rightJoinElectronicPurseHistory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ElectronicPurseHistory relation
 * @method     ChildElectronicPurseQuery innerJoinElectronicPurseHistory($relationAlias = null) Adds a INNER JOIN clause to the query using the ElectronicPurseHistory relation
 *
 * @method     ChildElectronicPurseQuery joinWithElectronicPurseHistory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ElectronicPurseHistory relation
 *
 * @method     ChildElectronicPurseQuery leftJoinWithElectronicPurseHistory() Adds a LEFT JOIN clause and with to the query using the ElectronicPurseHistory relation
 * @method     ChildElectronicPurseQuery rightJoinWithElectronicPurseHistory() Adds a RIGHT JOIN clause and with to the query using the ElectronicPurseHistory relation
 * @method     ChildElectronicPurseQuery innerJoinWithElectronicPurseHistory() Adds a INNER JOIN clause and with to the query using the ElectronicPurseHistory relation
 *
 * @method     \UsersQuery|\ElectronicPurseHistoryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildElectronicPurse|null findOne(ConnectionInterface $con = null) Return the first ChildElectronicPurse matching the query
 * @method     ChildElectronicPurse findOneOrCreate(ConnectionInterface $con = null) Return the first ChildElectronicPurse matching the query, or a new ChildElectronicPurse object populated from the query conditions when no match is found
 *
 * @method     ChildElectronicPurse|null findOneById(int $id) Return the first ChildElectronicPurse filtered by the id column
 * @method     ChildElectronicPurse|null findOneByIdClientUser(int $id_client_user) Return the first ChildElectronicPurse filtered by the id_client_user column
 * @method     ChildElectronicPurse|null findOneByCode(string $code) Return the first ChildElectronicPurse filtered by the code column
 * @method     ChildElectronicPurse|null findOneByAmount(string $amount) Return the first ChildElectronicPurse filtered by the amount column
 * @method     ChildElectronicPurse|null findOneByCreatedAt(string $created_at) Return the first ChildElectronicPurse filtered by the created_at column
 * @method     ChildElectronicPurse|null findOneByUpdatedAt(string $updated_at) Return the first ChildElectronicPurse filtered by the updated_at column *

 * @method     ChildElectronicPurse requirePk($key, ConnectionInterface $con = null) Return the ChildElectronicPurse by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectronicPurse requireOne(ConnectionInterface $con = null) Return the first ChildElectronicPurse matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildElectronicPurse requireOneById(int $id) Return the first ChildElectronicPurse filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectronicPurse requireOneByIdClientUser(int $id_client_user) Return the first ChildElectronicPurse filtered by the id_client_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectronicPurse requireOneByCode(string $code) Return the first ChildElectronicPurse filtered by the code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectronicPurse requireOneByAmount(string $amount) Return the first ChildElectronicPurse filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectronicPurse requireOneByCreatedAt(string $created_at) Return the first ChildElectronicPurse filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildElectronicPurse requireOneByUpdatedAt(string $updated_at) Return the first ChildElectronicPurse filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildElectronicPurse[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildElectronicPurse objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildElectronicPurse> find(ConnectionInterface $con = null) Return ChildElectronicPurse objects based on current ModelCriteria
 * @method     ChildElectronicPurse[]|ObjectCollection findById(int $id) Return ChildElectronicPurse objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildElectronicPurse> findById(int $id) Return ChildElectronicPurse objects filtered by the id column
 * @method     ChildElectronicPurse[]|ObjectCollection findByIdClientUser(int $id_client_user) Return ChildElectronicPurse objects filtered by the id_client_user column
 * @psalm-method ObjectCollection&\Traversable<ChildElectronicPurse> findByIdClientUser(int $id_client_user) Return ChildElectronicPurse objects filtered by the id_client_user column
 * @method     ChildElectronicPurse[]|ObjectCollection findByCode(string $code) Return ChildElectronicPurse objects filtered by the code column
 * @psalm-method ObjectCollection&\Traversable<ChildElectronicPurse> findByCode(string $code) Return ChildElectronicPurse objects filtered by the code column
 * @method     ChildElectronicPurse[]|ObjectCollection findByAmount(string $amount) Return ChildElectronicPurse objects filtered by the amount column
 * @psalm-method ObjectCollection&\Traversable<ChildElectronicPurse> findByAmount(string $amount) Return ChildElectronicPurse objects filtered by the amount column
 * @method     ChildElectronicPurse[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildElectronicPurse objects filtered by the created_at column
 * @psalm-method ObjectCollection&\Traversable<ChildElectronicPurse> findByCreatedAt(string $created_at) Return ChildElectronicPurse objects filtered by the created_at column
 * @method     ChildElectronicPurse[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildElectronicPurse objects filtered by the updated_at column
 * @psalm-method ObjectCollection&\Traversable<ChildElectronicPurse> findByUpdatedAt(string $updated_at) Return ChildElectronicPurse objects filtered by the updated_at column
 * @method     ChildElectronicPurse[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildElectronicPurse> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ElectronicPurseQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ElectronicPurseQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'golden_clean', $modelName = '\\ElectronicPurse', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildElectronicPurseQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildElectronicPurseQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildElectronicPurseQuery) {
            return $criteria;
        }
        $query = new ChildElectronicPurseQuery();
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
     * @return ChildElectronicPurse|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ElectronicPurseTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ElectronicPurseTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildElectronicPurse A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_client_user, code, amount, created_at, updated_at FROM electronic_purse WHERE id = :p0';
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
            /** @var ChildElectronicPurse $obj */
            $obj = new ChildElectronicPurse();
            $obj->hydrate($row);
            ElectronicPurseTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildElectronicPurse|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildElectronicPurseQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ElectronicPurseTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildElectronicPurseQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ElectronicPurseTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildElectronicPurseQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ElectronicPurseTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ElectronicPurseTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectronicPurseTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_client_user column
     *
     * Example usage:
     * <code>
     * $query->filterByIdClientUser(1234); // WHERE id_client_user = 1234
     * $query->filterByIdClientUser(array(12, 34)); // WHERE id_client_user IN (12, 34)
     * $query->filterByIdClientUser(array('min' => 12)); // WHERE id_client_user > 12
     * </code>
     *
     * @see       filterByUsers()
     *
     * @param     mixed $idClientUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElectronicPurseQuery The current query, for fluid interface
     */
    public function filterByIdClientUser($idClientUser = null, $comparison = null)
    {
        if (is_array($idClientUser)) {
            $useMinMax = false;
            if (isset($idClientUser['min'])) {
                $this->addUsingAlias(ElectronicPurseTableMap::COL_ID_CLIENT_USER, $idClientUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idClientUser['max'])) {
                $this->addUsingAlias(ElectronicPurseTableMap::COL_ID_CLIENT_USER, $idClientUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectronicPurseTableMap::COL_ID_CLIENT_USER, $idClientUser, $comparison);
    }

    /**
     * Filter the query on the code column
     *
     * Example usage:
     * <code>
     * $query->filterByCode('fooValue');   // WHERE code = 'fooValue'
     * $query->filterByCode('%fooValue%', Criteria::LIKE); // WHERE code LIKE '%fooValue%'
     * </code>
     *
     * @param     string $code The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildElectronicPurseQuery The current query, for fluid interface
     */
    public function filterByCode($code = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($code)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectronicPurseTableMap::COL_CODE, $code, $comparison);
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
     * @return $this|ChildElectronicPurseQuery The current query, for fluid interface
     */
    public function filterByAmount($amount = null, $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(ElectronicPurseTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(ElectronicPurseTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectronicPurseTableMap::COL_AMOUNT, $amount, $comparison);
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
     * @return $this|ChildElectronicPurseQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ElectronicPurseTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ElectronicPurseTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectronicPurseTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildElectronicPurseQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ElectronicPurseTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ElectronicPurseTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ElectronicPurseTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Users object
     *
     * @param \Users|ObjectCollection $users The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildElectronicPurseQuery The current query, for fluid interface
     */
    public function filterByUsers($users, $comparison = null)
    {
        if ($users instanceof \Users) {
            return $this
                ->addUsingAlias(ElectronicPurseTableMap::COL_ID_CLIENT_USER, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ElectronicPurseTableMap::COL_ID_CLIENT_USER, $users->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildElectronicPurseQuery The current query, for fluid interface
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
     * Filter the query by a related \ElectronicPurseHistory object
     *
     * @param \ElectronicPurseHistory|ObjectCollection $electronicPurseHistory the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildElectronicPurseQuery The current query, for fluid interface
     */
    public function filterByElectronicPurseHistory($electronicPurseHistory, $comparison = null)
    {
        if ($electronicPurseHistory instanceof \ElectronicPurseHistory) {
            return $this
                ->addUsingAlias(ElectronicPurseTableMap::COL_ID, $electronicPurseHistory->getIdElectronicPurse(), $comparison);
        } elseif ($electronicPurseHistory instanceof ObjectCollection) {
            return $this
                ->useElectronicPurseHistoryQuery()
                ->filterByPrimaryKeys($electronicPurseHistory->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByElectronicPurseHistory() only accepts arguments of type \ElectronicPurseHistory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ElectronicPurseHistory relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildElectronicPurseQuery The current query, for fluid interface
     */
    public function joinElectronicPurseHistory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ElectronicPurseHistory');

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
            $this->addJoinObject($join, 'ElectronicPurseHistory');
        }

        return $this;
    }

    /**
     * Use the ElectronicPurseHistory relation ElectronicPurseHistory object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ElectronicPurseHistoryQuery A secondary query class using the current class as primary query
     */
    public function useElectronicPurseHistoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinElectronicPurseHistory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ElectronicPurseHistory', '\ElectronicPurseHistoryQuery');
    }

    /**
     * Use the ElectronicPurseHistory relation ElectronicPurseHistory object
     *
     * @param callable(\ElectronicPurseHistoryQuery):\ElectronicPurseHistoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withElectronicPurseHistoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useElectronicPurseHistoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ElectronicPurseHistory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \ElectronicPurseHistoryQuery The inner query object of the EXISTS statement
     */
    public function useElectronicPurseHistoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ElectronicPurseHistory', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ElectronicPurseHistory table for a NOT EXISTS query.
     *
     * @see useElectronicPurseHistoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \ElectronicPurseHistoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useElectronicPurseHistoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ElectronicPurseHistory', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildElectronicPurse $electronicPurse Object to remove from the list of results
     *
     * @return $this|ChildElectronicPurseQuery The current query, for fluid interface
     */
    public function prune($electronicPurse = null)
    {
        if ($electronicPurse) {
            $this->addUsingAlias(ElectronicPurseTableMap::COL_ID, $electronicPurse->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the electronic_purse table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ElectronicPurseTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ElectronicPurseTableMap::clearInstancePool();
            ElectronicPurseTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ElectronicPurseTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ElectronicPurseTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ElectronicPurseTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ElectronicPurseTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ElectronicPurseQuery
