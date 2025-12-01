<?php

namespace Base;

use \BranchOffices as ChildBranchOffices;
use \BranchOfficesQuery as ChildBranchOfficesQuery;
use \Exception;
use \PDO;
use Map\BranchOfficesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'branch_offices' table.
 *
 *
 *
 * @method     ChildBranchOfficesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildBranchOfficesQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildBranchOfficesQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildBranchOfficesQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildBranchOfficesQuery orderBySeries($order = Criteria::ASC) Order by the series column
 * @method     ChildBranchOfficesQuery orderByCurrentSheet($order = Criteria::ASC) Order by the current_sheet column
 * @method     ChildBranchOfficesQuery orderByRfc($order = Criteria::ASC) Order by the rfc column
 * @method     ChildBranchOfficesQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildBranchOfficesQuery orderByLegend($order = Criteria::ASC) Order by the legend column
 * @method     ChildBranchOfficesQuery orderByPostalCode($order = Criteria::ASC) Order by the postal_code column
 * @method     ChildBranchOfficesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildBranchOfficesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildBranchOfficesQuery groupById() Group by the id column
 * @method     ChildBranchOfficesQuery groupByName() Group by the name column
 * @method     ChildBranchOfficesQuery groupByAddress() Group by the address column
 * @method     ChildBranchOfficesQuery groupByPhone() Group by the phone column
 * @method     ChildBranchOfficesQuery groupBySeries() Group by the series column
 * @method     ChildBranchOfficesQuery groupByCurrentSheet() Group by the current_sheet column
 * @method     ChildBranchOfficesQuery groupByRfc() Group by the rfc column
 * @method     ChildBranchOfficesQuery groupByEmail() Group by the email column
 * @method     ChildBranchOfficesQuery groupByLegend() Group by the legend column
 * @method     ChildBranchOfficesQuery groupByPostalCode() Group by the postal_code column
 * @method     ChildBranchOfficesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildBranchOfficesQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildBranchOfficesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBranchOfficesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBranchOfficesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBranchOfficesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBranchOfficesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBranchOfficesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBranchOfficesQuery leftJoinBranchOfficeServices($relationAlias = null) Adds a LEFT JOIN clause to the query using the BranchOfficeServices relation
 * @method     ChildBranchOfficesQuery rightJoinBranchOfficeServices($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BranchOfficeServices relation
 * @method     ChildBranchOfficesQuery innerJoinBranchOfficeServices($relationAlias = null) Adds a INNER JOIN clause to the query using the BranchOfficeServices relation
 *
 * @method     ChildBranchOfficesQuery joinWithBranchOfficeServices($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BranchOfficeServices relation
 *
 * @method     ChildBranchOfficesQuery leftJoinWithBranchOfficeServices() Adds a LEFT JOIN clause and with to the query using the BranchOfficeServices relation
 * @method     ChildBranchOfficesQuery rightJoinWithBranchOfficeServices() Adds a RIGHT JOIN clause and with to the query using the BranchOfficeServices relation
 * @method     ChildBranchOfficesQuery innerJoinWithBranchOfficeServices() Adds a INNER JOIN clause and with to the query using the BranchOfficeServices relation
 *
 * @method     ChildBranchOfficesQuery leftJoinExpenseReports($relationAlias = null) Adds a LEFT JOIN clause to the query using the ExpenseReports relation
 * @method     ChildBranchOfficesQuery rightJoinExpenseReports($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ExpenseReports relation
 * @method     ChildBranchOfficesQuery innerJoinExpenseReports($relationAlias = null) Adds a INNER JOIN clause to the query using the ExpenseReports relation
 *
 * @method     ChildBranchOfficesQuery joinWithExpenseReports($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ExpenseReports relation
 *
 * @method     ChildBranchOfficesQuery leftJoinWithExpenseReports() Adds a LEFT JOIN clause and with to the query using the ExpenseReports relation
 * @method     ChildBranchOfficesQuery rightJoinWithExpenseReports() Adds a RIGHT JOIN clause and with to the query using the ExpenseReports relation
 * @method     ChildBranchOfficesQuery innerJoinWithExpenseReports() Adds a INNER JOIN clause and with to the query using the ExpenseReports relation
 *
 * @method     ChildBranchOfficesQuery leftJoinOrders($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orders relation
 * @method     ChildBranchOfficesQuery rightJoinOrders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orders relation
 * @method     ChildBranchOfficesQuery innerJoinOrders($relationAlias = null) Adds a INNER JOIN clause to the query using the Orders relation
 *
 * @method     ChildBranchOfficesQuery joinWithOrders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orders relation
 *
 * @method     ChildBranchOfficesQuery leftJoinWithOrders() Adds a LEFT JOIN clause and with to the query using the Orders relation
 * @method     ChildBranchOfficesQuery rightJoinWithOrders() Adds a RIGHT JOIN clause and with to the query using the Orders relation
 * @method     ChildBranchOfficesQuery innerJoinWithOrders() Adds a INNER JOIN clause and with to the query using the Orders relation
 *
 * @method     ChildBranchOfficesQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildBranchOfficesQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildBranchOfficesQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildBranchOfficesQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildBranchOfficesQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildBranchOfficesQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildBranchOfficesQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     \BranchOfficeServicesQuery|\ExpenseReportsQuery|\OrdersQuery|\UsersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBranchOffices|null findOne(ConnectionInterface $con = null) Return the first ChildBranchOffices matching the query
 * @method     ChildBranchOffices findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBranchOffices matching the query, or a new ChildBranchOffices object populated from the query conditions when no match is found
 *
 * @method     ChildBranchOffices|null findOneById(int $id) Return the first ChildBranchOffices filtered by the id column
 * @method     ChildBranchOffices|null findOneByName(string $name) Return the first ChildBranchOffices filtered by the name column
 * @method     ChildBranchOffices|null findOneByAddress(string $address) Return the first ChildBranchOffices filtered by the address column
 * @method     ChildBranchOffices|null findOneByPhone(string $phone) Return the first ChildBranchOffices filtered by the phone column
 * @method     ChildBranchOffices|null findOneBySeries(string $series) Return the first ChildBranchOffices filtered by the series column
 * @method     ChildBranchOffices|null findOneByCurrentSheet(int $current_sheet) Return the first ChildBranchOffices filtered by the current_sheet column
 * @method     ChildBranchOffices|null findOneByRfc(string $rfc) Return the first ChildBranchOffices filtered by the rfc column
 * @method     ChildBranchOffices|null findOneByEmail(string $email) Return the first ChildBranchOffices filtered by the email column
 * @method     ChildBranchOffices|null findOneByLegend(string $legend) Return the first ChildBranchOffices filtered by the legend column
 * @method     ChildBranchOffices|null findOneByPostalCode(int $postal_code) Return the first ChildBranchOffices filtered by the postal_code column
 * @method     ChildBranchOffices|null findOneByCreatedAt(string $created_at) Return the first ChildBranchOffices filtered by the created_at column
 * @method     ChildBranchOffices|null findOneByUpdatedAt(string $updated_at) Return the first ChildBranchOffices filtered by the updated_at column *

 * @method     ChildBranchOffices requirePk($key, ConnectionInterface $con = null) Return the ChildBranchOffices by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBranchOffices requireOne(ConnectionInterface $con = null) Return the first ChildBranchOffices matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBranchOffices requireOneById(int $id) Return the first ChildBranchOffices filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBranchOffices requireOneByName(string $name) Return the first ChildBranchOffices filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBranchOffices requireOneByAddress(string $address) Return the first ChildBranchOffices filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBranchOffices requireOneByPhone(string $phone) Return the first ChildBranchOffices filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBranchOffices requireOneBySeries(string $series) Return the first ChildBranchOffices filtered by the series column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBranchOffices requireOneByCurrentSheet(int $current_sheet) Return the first ChildBranchOffices filtered by the current_sheet column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBranchOffices requireOneByRfc(string $rfc) Return the first ChildBranchOffices filtered by the rfc column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBranchOffices requireOneByEmail(string $email) Return the first ChildBranchOffices filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBranchOffices requireOneByLegend(string $legend) Return the first ChildBranchOffices filtered by the legend column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBranchOffices requireOneByPostalCode(int $postal_code) Return the first ChildBranchOffices filtered by the postal_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBranchOffices requireOneByCreatedAt(string $created_at) Return the first ChildBranchOffices filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBranchOffices requireOneByUpdatedAt(string $updated_at) Return the first ChildBranchOffices filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBranchOffices[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBranchOffices objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildBranchOffices> find(ConnectionInterface $con = null) Return ChildBranchOffices objects based on current ModelCriteria
 * @method     ChildBranchOffices[]|ObjectCollection findById(int $id) Return ChildBranchOffices objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildBranchOffices> findById(int $id) Return ChildBranchOffices objects filtered by the id column
 * @method     ChildBranchOffices[]|ObjectCollection findByName(string $name) Return ChildBranchOffices objects filtered by the name column
 * @psalm-method ObjectCollection&\Traversable<ChildBranchOffices> findByName(string $name) Return ChildBranchOffices objects filtered by the name column
 * @method     ChildBranchOffices[]|ObjectCollection findByAddress(string $address) Return ChildBranchOffices objects filtered by the address column
 * @psalm-method ObjectCollection&\Traversable<ChildBranchOffices> findByAddress(string $address) Return ChildBranchOffices objects filtered by the address column
 * @method     ChildBranchOffices[]|ObjectCollection findByPhone(string $phone) Return ChildBranchOffices objects filtered by the phone column
 * @psalm-method ObjectCollection&\Traversable<ChildBranchOffices> findByPhone(string $phone) Return ChildBranchOffices objects filtered by the phone column
 * @method     ChildBranchOffices[]|ObjectCollection findBySeries(string $series) Return ChildBranchOffices objects filtered by the series column
 * @psalm-method ObjectCollection&\Traversable<ChildBranchOffices> findBySeries(string $series) Return ChildBranchOffices objects filtered by the series column
 * @method     ChildBranchOffices[]|ObjectCollection findByCurrentSheet(int $current_sheet) Return ChildBranchOffices objects filtered by the current_sheet column
 * @psalm-method ObjectCollection&\Traversable<ChildBranchOffices> findByCurrentSheet(int $current_sheet) Return ChildBranchOffices objects filtered by the current_sheet column
 * @method     ChildBranchOffices[]|ObjectCollection findByRfc(string $rfc) Return ChildBranchOffices objects filtered by the rfc column
 * @psalm-method ObjectCollection&\Traversable<ChildBranchOffices> findByRfc(string $rfc) Return ChildBranchOffices objects filtered by the rfc column
 * @method     ChildBranchOffices[]|ObjectCollection findByEmail(string $email) Return ChildBranchOffices objects filtered by the email column
 * @psalm-method ObjectCollection&\Traversable<ChildBranchOffices> findByEmail(string $email) Return ChildBranchOffices objects filtered by the email column
 * @method     ChildBranchOffices[]|ObjectCollection findByLegend(string $legend) Return ChildBranchOffices objects filtered by the legend column
 * @psalm-method ObjectCollection&\Traversable<ChildBranchOffices> findByLegend(string $legend) Return ChildBranchOffices objects filtered by the legend column
 * @method     ChildBranchOffices[]|ObjectCollection findByPostalCode(int $postal_code) Return ChildBranchOffices objects filtered by the postal_code column
 * @psalm-method ObjectCollection&\Traversable<ChildBranchOffices> findByPostalCode(int $postal_code) Return ChildBranchOffices objects filtered by the postal_code column
 * @method     ChildBranchOffices[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildBranchOffices objects filtered by the created_at column
 * @psalm-method ObjectCollection&\Traversable<ChildBranchOffices> findByCreatedAt(string $created_at) Return ChildBranchOffices objects filtered by the created_at column
 * @method     ChildBranchOffices[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildBranchOffices objects filtered by the updated_at column
 * @psalm-method ObjectCollection&\Traversable<ChildBranchOffices> findByUpdatedAt(string $updated_at) Return ChildBranchOffices objects filtered by the updated_at column
 * @method     ChildBranchOffices[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildBranchOffices> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BranchOfficesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\BranchOfficesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'golden_clean', $modelName = '\\BranchOffices', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBranchOfficesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBranchOfficesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBranchOfficesQuery) {
            return $criteria;
        }
        $query = new ChildBranchOfficesQuery();
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
     * @return ChildBranchOffices|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BranchOfficesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BranchOfficesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBranchOffices A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, address, phone, series, current_sheet, rfc, email, legend, postal_code, created_at, updated_at FROM branch_offices WHERE id = :p0';
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
            /** @var ChildBranchOffices $obj */
            $obj = new ChildBranchOffices();
            $obj->hydrate($row);
            BranchOfficesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBranchOffices|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BranchOfficesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BranchOfficesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildBranchOfficesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(BranchOfficesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(BranchOfficesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchOfficesTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchOfficesTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the address column
     *
     * Example usage:
     * <code>
     * $query->filterByAddress('fooValue');   // WHERE address = 'fooValue'
     * $query->filterByAddress('%fooValue%', Criteria::LIKE); // WHERE address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $address The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchOfficesTableMap::COL_ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query on the phone column
     *
     * Example usage:
     * <code>
     * $query->filterByPhone('fooValue');   // WHERE phone = 'fooValue'
     * $query->filterByPhone('%fooValue%', Criteria::LIKE); // WHERE phone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $phone The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchOfficesTableMap::COL_PHONE, $phone, $comparison);
    }

    /**
     * Filter the query on the series column
     *
     * Example usage:
     * <code>
     * $query->filterBySeries('fooValue');   // WHERE series = 'fooValue'
     * $query->filterBySeries('%fooValue%', Criteria::LIKE); // WHERE series LIKE '%fooValue%'
     * </code>
     *
     * @param     string $series The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBranchOfficesQuery The current query, for fluid interface
     */
    public function filterBySeries($series = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($series)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchOfficesTableMap::COL_SERIES, $series, $comparison);
    }

    /**
     * Filter the query on the current_sheet column
     *
     * Example usage:
     * <code>
     * $query->filterByCurrentSheet(1234); // WHERE current_sheet = 1234
     * $query->filterByCurrentSheet(array(12, 34)); // WHERE current_sheet IN (12, 34)
     * $query->filterByCurrentSheet(array('min' => 12)); // WHERE current_sheet > 12
     * </code>
     *
     * @param     mixed $currentSheet The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByCurrentSheet($currentSheet = null, $comparison = null)
    {
        if (is_array($currentSheet)) {
            $useMinMax = false;
            if (isset($currentSheet['min'])) {
                $this->addUsingAlias(BranchOfficesTableMap::COL_CURRENT_SHEET, $currentSheet['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($currentSheet['max'])) {
                $this->addUsingAlias(BranchOfficesTableMap::COL_CURRENT_SHEET, $currentSheet['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchOfficesTableMap::COL_CURRENT_SHEET, $currentSheet, $comparison);
    }

    /**
     * Filter the query on the rfc column
     *
     * Example usage:
     * <code>
     * $query->filterByRfc('fooValue');   // WHERE rfc = 'fooValue'
     * $query->filterByRfc('%fooValue%', Criteria::LIKE); // WHERE rfc LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rfc The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByRfc($rfc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rfc)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchOfficesTableMap::COL_RFC, $rfc, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchOfficesTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the legend column
     *
     * Example usage:
     * <code>
     * $query->filterByLegend('fooValue');   // WHERE legend = 'fooValue'
     * $query->filterByLegend('%fooValue%', Criteria::LIKE); // WHERE legend LIKE '%fooValue%'
     * </code>
     *
     * @param     string $legend The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByLegend($legend = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($legend)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchOfficesTableMap::COL_LEGEND, $legend, $comparison);
    }

    /**
     * Filter the query on the postal_code column
     *
     * Example usage:
     * <code>
     * $query->filterByPostalCode(1234); // WHERE postal_code = 1234
     * $query->filterByPostalCode(array(12, 34)); // WHERE postal_code IN (12, 34)
     * $query->filterByPostalCode(array('min' => 12)); // WHERE postal_code > 12
     * </code>
     *
     * @param     mixed $postalCode The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByPostalCode($postalCode = null, $comparison = null)
    {
        if (is_array($postalCode)) {
            $useMinMax = false;
            if (isset($postalCode['min'])) {
                $this->addUsingAlias(BranchOfficesTableMap::COL_POSTAL_CODE, $postalCode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($postalCode['max'])) {
                $this->addUsingAlias(BranchOfficesTableMap::COL_POSTAL_CODE, $postalCode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchOfficesTableMap::COL_POSTAL_CODE, $postalCode, $comparison);
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
     * @return $this|ChildBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(BranchOfficesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(BranchOfficesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchOfficesTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(BranchOfficesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(BranchOfficesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchOfficesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \BranchOfficeServices object
     *
     * @param \BranchOfficeServices|ObjectCollection $branchOfficeServices the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByBranchOfficeServices($branchOfficeServices, $comparison = null)
    {
        if ($branchOfficeServices instanceof \BranchOfficeServices) {
            return $this
                ->addUsingAlias(BranchOfficesTableMap::COL_ID, $branchOfficeServices->getIdBranchOffice(), $comparison);
        } elseif ($branchOfficeServices instanceof ObjectCollection) {
            return $this
                ->useBranchOfficeServicesQuery()
                ->filterByPrimaryKeys($branchOfficeServices->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBranchOfficeServices() only accepts arguments of type \BranchOfficeServices or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BranchOfficeServices relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBranchOfficesQuery The current query, for fluid interface
     */
    public function joinBranchOfficeServices($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BranchOfficeServices');

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
            $this->addJoinObject($join, 'BranchOfficeServices');
        }

        return $this;
    }

    /**
     * Use the BranchOfficeServices relation BranchOfficeServices object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \BranchOfficeServicesQuery A secondary query class using the current class as primary query
     */
    public function useBranchOfficeServicesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBranchOfficeServices($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BranchOfficeServices', '\BranchOfficeServicesQuery');
    }

    /**
     * Use the BranchOfficeServices relation BranchOfficeServices object
     *
     * @param callable(\BranchOfficeServicesQuery):\BranchOfficeServicesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBranchOfficeServicesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useBranchOfficeServicesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to BranchOfficeServices table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \BranchOfficeServicesQuery The inner query object of the EXISTS statement
     */
    public function useBranchOfficeServicesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('BranchOfficeServices', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to BranchOfficeServices table for a NOT EXISTS query.
     *
     * @see useBranchOfficeServicesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \BranchOfficeServicesQuery The inner query object of the NOT EXISTS statement
     */
    public function useBranchOfficeServicesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('BranchOfficeServices', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \ExpenseReports object
     *
     * @param \ExpenseReports|ObjectCollection $expenseReports the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByExpenseReports($expenseReports, $comparison = null)
    {
        if ($expenseReports instanceof \ExpenseReports) {
            return $this
                ->addUsingAlias(BranchOfficesTableMap::COL_ID, $expenseReports->getIdBranchOffice(), $comparison);
        } elseif ($expenseReports instanceof ObjectCollection) {
            return $this
                ->useExpenseReportsQuery()
                ->filterByPrimaryKeys($expenseReports->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByExpenseReports() only accepts arguments of type \ExpenseReports or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ExpenseReports relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBranchOfficesQuery The current query, for fluid interface
     */
    public function joinExpenseReports($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ExpenseReports');

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
            $this->addJoinObject($join, 'ExpenseReports');
        }

        return $this;
    }

    /**
     * Use the ExpenseReports relation ExpenseReports object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ExpenseReportsQuery A secondary query class using the current class as primary query
     */
    public function useExpenseReportsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinExpenseReports($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ExpenseReports', '\ExpenseReportsQuery');
    }

    /**
     * Use the ExpenseReports relation ExpenseReports object
     *
     * @param callable(\ExpenseReportsQuery):\ExpenseReportsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withExpenseReportsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useExpenseReportsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ExpenseReports table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \ExpenseReportsQuery The inner query object of the EXISTS statement
     */
    public function useExpenseReportsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ExpenseReports', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ExpenseReports table for a NOT EXISTS query.
     *
     * @see useExpenseReportsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \ExpenseReportsQuery The inner query object of the NOT EXISTS statement
     */
    public function useExpenseReportsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ExpenseReports', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Orders object
     *
     * @param \Orders|ObjectCollection $orders the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByOrders($orders, $comparison = null)
    {
        if ($orders instanceof \Orders) {
            return $this
                ->addUsingAlias(BranchOfficesTableMap::COL_ID, $orders->getIdBranchOffice(), $comparison);
        } elseif ($orders instanceof ObjectCollection) {
            return $this
                ->useOrdersQuery()
                ->filterByPrimaryKeys($orders->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildBranchOfficesQuery The current query, for fluid interface
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
     * Filter the query by a related \Users object
     *
     * @param \Users|ObjectCollection $users the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBranchOfficesQuery The current query, for fluid interface
     */
    public function filterByUsers($users, $comparison = null)
    {
        if ($users instanceof \Users) {
            return $this
                ->addUsingAlias(BranchOfficesTableMap::COL_ID, $users->getIdBranchOffice(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            return $this
                ->useUsersQuery()
                ->filterByPrimaryKeys($users->getPrimaryKeys())
                ->endUse();
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
     * @return $this|ChildBranchOfficesQuery The current query, for fluid interface
     */
    public function joinUsers($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useUsersQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * @param   ChildBranchOffices $branchOffices Object to remove from the list of results
     *
     * @return $this|ChildBranchOfficesQuery The current query, for fluid interface
     */
    public function prune($branchOffices = null)
    {
        if ($branchOffices) {
            $this->addUsingAlias(BranchOfficesTableMap::COL_ID, $branchOffices->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the branch_offices table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BranchOfficesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BranchOfficesTableMap::clearInstancePool();
            BranchOfficesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BranchOfficesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BranchOfficesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BranchOfficesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BranchOfficesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BranchOfficesQuery
