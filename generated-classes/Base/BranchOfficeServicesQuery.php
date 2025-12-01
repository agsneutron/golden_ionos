<?php

namespace Base;

use \BranchOfficeServices as ChildBranchOfficeServices;
use \BranchOfficeServicesQuery as ChildBranchOfficeServicesQuery;
use \Exception;
use \PDO;
use Map\BranchOfficeServicesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'branch_office_services' table.
 *
 *
 *
 * @method     ChildBranchOfficeServicesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildBranchOfficeServicesQuery orderByIdBranchOffice($order = Criteria::ASC) Order by the id_branch_office column
 * @method     ChildBranchOfficeServicesQuery orderByIdService($order = Criteria::ASC) Order by the id_service column
 * @method     ChildBranchOfficeServicesQuery orderByNormalPrice($order = Criteria::ASC) Order by the normal_price column
 * @method     ChildBranchOfficeServicesQuery orderByUrgentPrice($order = Criteria::ASC) Order by the urgent_price column
 * @method     ChildBranchOfficeServicesQuery orderByExtraUrgentPrice($order = Criteria::ASC) Order by the extra_urgent_price column
 * @method     ChildBranchOfficeServicesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildBranchOfficeServicesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildBranchOfficeServicesQuery groupById() Group by the id column
 * @method     ChildBranchOfficeServicesQuery groupByIdBranchOffice() Group by the id_branch_office column
 * @method     ChildBranchOfficeServicesQuery groupByIdService() Group by the id_service column
 * @method     ChildBranchOfficeServicesQuery groupByNormalPrice() Group by the normal_price column
 * @method     ChildBranchOfficeServicesQuery groupByUrgentPrice() Group by the urgent_price column
 * @method     ChildBranchOfficeServicesQuery groupByExtraUrgentPrice() Group by the extra_urgent_price column
 * @method     ChildBranchOfficeServicesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildBranchOfficeServicesQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildBranchOfficeServicesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBranchOfficeServicesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBranchOfficeServicesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBranchOfficeServicesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBranchOfficeServicesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBranchOfficeServicesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBranchOfficeServicesQuery leftJoinBranchOffices($relationAlias = null) Adds a LEFT JOIN clause to the query using the BranchOffices relation
 * @method     ChildBranchOfficeServicesQuery rightJoinBranchOffices($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BranchOffices relation
 * @method     ChildBranchOfficeServicesQuery innerJoinBranchOffices($relationAlias = null) Adds a INNER JOIN clause to the query using the BranchOffices relation
 *
 * @method     ChildBranchOfficeServicesQuery joinWithBranchOffices($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BranchOffices relation
 *
 * @method     ChildBranchOfficeServicesQuery leftJoinWithBranchOffices() Adds a LEFT JOIN clause and with to the query using the BranchOffices relation
 * @method     ChildBranchOfficeServicesQuery rightJoinWithBranchOffices() Adds a RIGHT JOIN clause and with to the query using the BranchOffices relation
 * @method     ChildBranchOfficeServicesQuery innerJoinWithBranchOffices() Adds a INNER JOIN clause and with to the query using the BranchOffices relation
 *
 * @method     ChildBranchOfficeServicesQuery leftJoinServices($relationAlias = null) Adds a LEFT JOIN clause to the query using the Services relation
 * @method     ChildBranchOfficeServicesQuery rightJoinServices($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Services relation
 * @method     ChildBranchOfficeServicesQuery innerJoinServices($relationAlias = null) Adds a INNER JOIN clause to the query using the Services relation
 *
 * @method     ChildBranchOfficeServicesQuery joinWithServices($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Services relation
 *
 * @method     ChildBranchOfficeServicesQuery leftJoinWithServices() Adds a LEFT JOIN clause and with to the query using the Services relation
 * @method     ChildBranchOfficeServicesQuery rightJoinWithServices() Adds a RIGHT JOIN clause and with to the query using the Services relation
 * @method     ChildBranchOfficeServicesQuery innerJoinWithServices() Adds a INNER JOIN clause and with to the query using the Services relation
 *
 * @method     \BranchOfficesQuery|\ServicesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBranchOfficeServices|null findOne(ConnectionInterface $con = null) Return the first ChildBranchOfficeServices matching the query
 * @method     ChildBranchOfficeServices findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBranchOfficeServices matching the query, or a new ChildBranchOfficeServices object populated from the query conditions when no match is found
 *
 * @method     ChildBranchOfficeServices|null findOneById(int $id) Return the first ChildBranchOfficeServices filtered by the id column
 * @method     ChildBranchOfficeServices|null findOneByIdBranchOffice(int $id_branch_office) Return the first ChildBranchOfficeServices filtered by the id_branch_office column
 * @method     ChildBranchOfficeServices|null findOneByIdService(int $id_service) Return the first ChildBranchOfficeServices filtered by the id_service column
 * @method     ChildBranchOfficeServices|null findOneByNormalPrice(string $normal_price) Return the first ChildBranchOfficeServices filtered by the normal_price column
 * @method     ChildBranchOfficeServices|null findOneByUrgentPrice(string $urgent_price) Return the first ChildBranchOfficeServices filtered by the urgent_price column
 * @method     ChildBranchOfficeServices|null findOneByExtraUrgentPrice(string $extra_urgent_price) Return the first ChildBranchOfficeServices filtered by the extra_urgent_price column
 * @method     ChildBranchOfficeServices|null findOneByCreatedAt(string $created_at) Return the first ChildBranchOfficeServices filtered by the created_at column
 * @method     ChildBranchOfficeServices|null findOneByUpdatedAt(string $updated_at) Return the first ChildBranchOfficeServices filtered by the updated_at column *

 * @method     ChildBranchOfficeServices requirePk($key, ConnectionInterface $con = null) Return the ChildBranchOfficeServices by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBranchOfficeServices requireOne(ConnectionInterface $con = null) Return the first ChildBranchOfficeServices matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBranchOfficeServices requireOneById(int $id) Return the first ChildBranchOfficeServices filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBranchOfficeServices requireOneByIdBranchOffice(int $id_branch_office) Return the first ChildBranchOfficeServices filtered by the id_branch_office column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBranchOfficeServices requireOneByIdService(int $id_service) Return the first ChildBranchOfficeServices filtered by the id_service column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBranchOfficeServices requireOneByNormalPrice(string $normal_price) Return the first ChildBranchOfficeServices filtered by the normal_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBranchOfficeServices requireOneByUrgentPrice(string $urgent_price) Return the first ChildBranchOfficeServices filtered by the urgent_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBranchOfficeServices requireOneByExtraUrgentPrice(string $extra_urgent_price) Return the first ChildBranchOfficeServices filtered by the extra_urgent_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBranchOfficeServices requireOneByCreatedAt(string $created_at) Return the first ChildBranchOfficeServices filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBranchOfficeServices requireOneByUpdatedAt(string $updated_at) Return the first ChildBranchOfficeServices filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBranchOfficeServices[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBranchOfficeServices objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildBranchOfficeServices> find(ConnectionInterface $con = null) Return ChildBranchOfficeServices objects based on current ModelCriteria
 * @method     ChildBranchOfficeServices[]|ObjectCollection findById(int $id) Return ChildBranchOfficeServices objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildBranchOfficeServices> findById(int $id) Return ChildBranchOfficeServices objects filtered by the id column
 * @method     ChildBranchOfficeServices[]|ObjectCollection findByIdBranchOffice(int $id_branch_office) Return ChildBranchOfficeServices objects filtered by the id_branch_office column
 * @psalm-method ObjectCollection&\Traversable<ChildBranchOfficeServices> findByIdBranchOffice(int $id_branch_office) Return ChildBranchOfficeServices objects filtered by the id_branch_office column
 * @method     ChildBranchOfficeServices[]|ObjectCollection findByIdService(int $id_service) Return ChildBranchOfficeServices objects filtered by the id_service column
 * @psalm-method ObjectCollection&\Traversable<ChildBranchOfficeServices> findByIdService(int $id_service) Return ChildBranchOfficeServices objects filtered by the id_service column
 * @method     ChildBranchOfficeServices[]|ObjectCollection findByNormalPrice(string $normal_price) Return ChildBranchOfficeServices objects filtered by the normal_price column
 * @psalm-method ObjectCollection&\Traversable<ChildBranchOfficeServices> findByNormalPrice(string $normal_price) Return ChildBranchOfficeServices objects filtered by the normal_price column
 * @method     ChildBranchOfficeServices[]|ObjectCollection findByUrgentPrice(string $urgent_price) Return ChildBranchOfficeServices objects filtered by the urgent_price column
 * @psalm-method ObjectCollection&\Traversable<ChildBranchOfficeServices> findByUrgentPrice(string $urgent_price) Return ChildBranchOfficeServices objects filtered by the urgent_price column
 * @method     ChildBranchOfficeServices[]|ObjectCollection findByExtraUrgentPrice(string $extra_urgent_price) Return ChildBranchOfficeServices objects filtered by the extra_urgent_price column
 * @psalm-method ObjectCollection&\Traversable<ChildBranchOfficeServices> findByExtraUrgentPrice(string $extra_urgent_price) Return ChildBranchOfficeServices objects filtered by the extra_urgent_price column
 * @method     ChildBranchOfficeServices[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildBranchOfficeServices objects filtered by the created_at column
 * @psalm-method ObjectCollection&\Traversable<ChildBranchOfficeServices> findByCreatedAt(string $created_at) Return ChildBranchOfficeServices objects filtered by the created_at column
 * @method     ChildBranchOfficeServices[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildBranchOfficeServices objects filtered by the updated_at column
 * @psalm-method ObjectCollection&\Traversable<ChildBranchOfficeServices> findByUpdatedAt(string $updated_at) Return ChildBranchOfficeServices objects filtered by the updated_at column
 * @method     ChildBranchOfficeServices[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildBranchOfficeServices> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BranchOfficeServicesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\BranchOfficeServicesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'golden_clean', $modelName = '\\BranchOfficeServices', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBranchOfficeServicesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBranchOfficeServicesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBranchOfficeServicesQuery) {
            return $criteria;
        }
        $query = new ChildBranchOfficeServicesQuery();
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
     * @return ChildBranchOfficeServices|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BranchOfficeServicesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BranchOfficeServicesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBranchOfficeServices A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_branch_office, id_service, normal_price, urgent_price, extra_urgent_price, created_at, updated_at FROM branch_office_services WHERE id = :p0';
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
            /** @var ChildBranchOfficeServices $obj */
            $obj = new ChildBranchOfficeServices();
            $obj->hydrate($row);
            BranchOfficeServicesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBranchOfficeServices|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildBranchOfficeServicesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BranchOfficeServicesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBranchOfficeServicesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BranchOfficeServicesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildBranchOfficeServicesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(BranchOfficeServicesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(BranchOfficeServicesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchOfficeServicesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_branch_office column
     *
     * Example usage:
     * <code>
     * $query->filterByIdBranchOffice(1234); // WHERE id_branch_office = 1234
     * $query->filterByIdBranchOffice(array(12, 34)); // WHERE id_branch_office IN (12, 34)
     * $query->filterByIdBranchOffice(array('min' => 12)); // WHERE id_branch_office > 12
     * </code>
     *
     * @see       filterByBranchOffices()
     *
     * @param     mixed $idBranchOffice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBranchOfficeServicesQuery The current query, for fluid interface
     */
    public function filterByIdBranchOffice($idBranchOffice = null, $comparison = null)
    {
        if (is_array($idBranchOffice)) {
            $useMinMax = false;
            if (isset($idBranchOffice['min'])) {
                $this->addUsingAlias(BranchOfficeServicesTableMap::COL_ID_BRANCH_OFFICE, $idBranchOffice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idBranchOffice['max'])) {
                $this->addUsingAlias(BranchOfficeServicesTableMap::COL_ID_BRANCH_OFFICE, $idBranchOffice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchOfficeServicesTableMap::COL_ID_BRANCH_OFFICE, $idBranchOffice, $comparison);
    }

    /**
     * Filter the query on the id_service column
     *
     * Example usage:
     * <code>
     * $query->filterByIdService(1234); // WHERE id_service = 1234
     * $query->filterByIdService(array(12, 34)); // WHERE id_service IN (12, 34)
     * $query->filterByIdService(array('min' => 12)); // WHERE id_service > 12
     * </code>
     *
     * @see       filterByServices()
     *
     * @param     mixed $idService The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBranchOfficeServicesQuery The current query, for fluid interface
     */
    public function filterByIdService($idService = null, $comparison = null)
    {
        if (is_array($idService)) {
            $useMinMax = false;
            if (isset($idService['min'])) {
                $this->addUsingAlias(BranchOfficeServicesTableMap::COL_ID_SERVICE, $idService['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idService['max'])) {
                $this->addUsingAlias(BranchOfficeServicesTableMap::COL_ID_SERVICE, $idService['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchOfficeServicesTableMap::COL_ID_SERVICE, $idService, $comparison);
    }

    /**
     * Filter the query on the normal_price column
     *
     * Example usage:
     * <code>
     * $query->filterByNormalPrice(1234); // WHERE normal_price = 1234
     * $query->filterByNormalPrice(array(12, 34)); // WHERE normal_price IN (12, 34)
     * $query->filterByNormalPrice(array('min' => 12)); // WHERE normal_price > 12
     * </code>
     *
     * @param     mixed $normalPrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBranchOfficeServicesQuery The current query, for fluid interface
     */
    public function filterByNormalPrice($normalPrice = null, $comparison = null)
    {
        if (is_array($normalPrice)) {
            $useMinMax = false;
            if (isset($normalPrice['min'])) {
                $this->addUsingAlias(BranchOfficeServicesTableMap::COL_NORMAL_PRICE, $normalPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($normalPrice['max'])) {
                $this->addUsingAlias(BranchOfficeServicesTableMap::COL_NORMAL_PRICE, $normalPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchOfficeServicesTableMap::COL_NORMAL_PRICE, $normalPrice, $comparison);
    }

    /**
     * Filter the query on the urgent_price column
     *
     * Example usage:
     * <code>
     * $query->filterByUrgentPrice(1234); // WHERE urgent_price = 1234
     * $query->filterByUrgentPrice(array(12, 34)); // WHERE urgent_price IN (12, 34)
     * $query->filterByUrgentPrice(array('min' => 12)); // WHERE urgent_price > 12
     * </code>
     *
     * @param     mixed $urgentPrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBranchOfficeServicesQuery The current query, for fluid interface
     */
    public function filterByUrgentPrice($urgentPrice = null, $comparison = null)
    {
        if (is_array($urgentPrice)) {
            $useMinMax = false;
            if (isset($urgentPrice['min'])) {
                $this->addUsingAlias(BranchOfficeServicesTableMap::COL_URGENT_PRICE, $urgentPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($urgentPrice['max'])) {
                $this->addUsingAlias(BranchOfficeServicesTableMap::COL_URGENT_PRICE, $urgentPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchOfficeServicesTableMap::COL_URGENT_PRICE, $urgentPrice, $comparison);
    }

    /**
     * Filter the query on the extra_urgent_price column
     *
     * Example usage:
     * <code>
     * $query->filterByExtraUrgentPrice(1234); // WHERE extra_urgent_price = 1234
     * $query->filterByExtraUrgentPrice(array(12, 34)); // WHERE extra_urgent_price IN (12, 34)
     * $query->filterByExtraUrgentPrice(array('min' => 12)); // WHERE extra_urgent_price > 12
     * </code>
     *
     * @param     mixed $extraUrgentPrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBranchOfficeServicesQuery The current query, for fluid interface
     */
    public function filterByExtraUrgentPrice($extraUrgentPrice = null, $comparison = null)
    {
        if (is_array($extraUrgentPrice)) {
            $useMinMax = false;
            if (isset($extraUrgentPrice['min'])) {
                $this->addUsingAlias(BranchOfficeServicesTableMap::COL_EXTRA_URGENT_PRICE, $extraUrgentPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($extraUrgentPrice['max'])) {
                $this->addUsingAlias(BranchOfficeServicesTableMap::COL_EXTRA_URGENT_PRICE, $extraUrgentPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchOfficeServicesTableMap::COL_EXTRA_URGENT_PRICE, $extraUrgentPrice, $comparison);
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
     * @return $this|ChildBranchOfficeServicesQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(BranchOfficeServicesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(BranchOfficeServicesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchOfficeServicesTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildBranchOfficeServicesQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(BranchOfficeServicesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(BranchOfficeServicesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchOfficeServicesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \BranchOffices object
     *
     * @param \BranchOffices|ObjectCollection $branchOffices The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBranchOfficeServicesQuery The current query, for fluid interface
     */
    public function filterByBranchOffices($branchOffices, $comparison = null)
    {
        if ($branchOffices instanceof \BranchOffices) {
            return $this
                ->addUsingAlias(BranchOfficeServicesTableMap::COL_ID_BRANCH_OFFICE, $branchOffices->getId(), $comparison);
        } elseif ($branchOffices instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BranchOfficeServicesTableMap::COL_ID_BRANCH_OFFICE, $branchOffices->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByBranchOffices() only accepts arguments of type \BranchOffices or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BranchOffices relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBranchOfficeServicesQuery The current query, for fluid interface
     */
    public function joinBranchOffices($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BranchOffices');

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
            $this->addJoinObject($join, 'BranchOffices');
        }

        return $this;
    }

    /**
     * Use the BranchOffices relation BranchOffices object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \BranchOfficesQuery A secondary query class using the current class as primary query
     */
    public function useBranchOfficesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBranchOffices($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BranchOffices', '\BranchOfficesQuery');
    }

    /**
     * Use the BranchOffices relation BranchOffices object
     *
     * @param callable(\BranchOfficesQuery):\BranchOfficesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBranchOfficesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useBranchOfficesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to BranchOffices table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \BranchOfficesQuery The inner query object of the EXISTS statement
     */
    public function useBranchOfficesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('BranchOffices', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to BranchOffices table for a NOT EXISTS query.
     *
     * @see useBranchOfficesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \BranchOfficesQuery The inner query object of the NOT EXISTS statement
     */
    public function useBranchOfficesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('BranchOffices', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Services object
     *
     * @param \Services|ObjectCollection $services The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBranchOfficeServicesQuery The current query, for fluid interface
     */
    public function filterByServices($services, $comparison = null)
    {
        if ($services instanceof \Services) {
            return $this
                ->addUsingAlias(BranchOfficeServicesTableMap::COL_ID_SERVICE, $services->getId(), $comparison);
        } elseif ($services instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BranchOfficeServicesTableMap::COL_ID_SERVICE, $services->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildBranchOfficeServicesQuery The current query, for fluid interface
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
     * @param   ChildBranchOfficeServices $branchOfficeServices Object to remove from the list of results
     *
     * @return $this|ChildBranchOfficeServicesQuery The current query, for fluid interface
     */
    public function prune($branchOfficeServices = null)
    {
        if ($branchOfficeServices) {
            $this->addUsingAlias(BranchOfficeServicesTableMap::COL_ID, $branchOfficeServices->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the branch_office_services table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BranchOfficeServicesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BranchOfficeServicesTableMap::clearInstancePool();
            BranchOfficeServicesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BranchOfficeServicesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BranchOfficeServicesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BranchOfficeServicesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BranchOfficeServicesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BranchOfficeServicesQuery
