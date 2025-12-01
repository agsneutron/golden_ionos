<?php

namespace Base;

use \Services as ChildServices;
use \ServicesQuery as ChildServicesQuery;
use \Exception;
use \PDO;
use Map\ServicesTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'services' table.
 *
 *
 *
 * @method     ChildServicesQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildServicesQuery orderByIdServiceCategory($order = Criteria::ASC) Order by the id_service_category column
 * @method     ChildServicesQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildServicesQuery orderByNormalPrice($order = Criteria::ASC) Order by the normal_price column
 * @method     ChildServicesQuery orderByUrgentPrice($order = Criteria::ASC) Order by the urgent_price column
 * @method     ChildServicesQuery orderByExtraUrgentPrice($order = Criteria::ASC) Order by the extra_urgent_price column
 * @method     ChildServicesQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildServicesQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildServicesQuery groupById() Group by the id column
 * @method     ChildServicesQuery groupByIdServiceCategory() Group by the id_service_category column
 * @method     ChildServicesQuery groupByDescription() Group by the description column
 * @method     ChildServicesQuery groupByNormalPrice() Group by the normal_price column
 * @method     ChildServicesQuery groupByUrgentPrice() Group by the urgent_price column
 * @method     ChildServicesQuery groupByExtraUrgentPrice() Group by the extra_urgent_price column
 * @method     ChildServicesQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildServicesQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildServicesQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildServicesQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildServicesQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildServicesQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildServicesQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildServicesQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildServicesQuery leftJoinServiceCategories($relationAlias = null) Adds a LEFT JOIN clause to the query using the ServiceCategories relation
 * @method     ChildServicesQuery rightJoinServiceCategories($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ServiceCategories relation
 * @method     ChildServicesQuery innerJoinServiceCategories($relationAlias = null) Adds a INNER JOIN clause to the query using the ServiceCategories relation
 *
 * @method     ChildServicesQuery joinWithServiceCategories($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ServiceCategories relation
 *
 * @method     ChildServicesQuery leftJoinWithServiceCategories() Adds a LEFT JOIN clause and with to the query using the ServiceCategories relation
 * @method     ChildServicesQuery rightJoinWithServiceCategories() Adds a RIGHT JOIN clause and with to the query using the ServiceCategories relation
 * @method     ChildServicesQuery innerJoinWithServiceCategories() Adds a INNER JOIN clause and with to the query using the ServiceCategories relation
 *
 * @method     ChildServicesQuery leftJoinBranchOfficeServices($relationAlias = null) Adds a LEFT JOIN clause to the query using the BranchOfficeServices relation
 * @method     ChildServicesQuery rightJoinBranchOfficeServices($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BranchOfficeServices relation
 * @method     ChildServicesQuery innerJoinBranchOfficeServices($relationAlias = null) Adds a INNER JOIN clause to the query using the BranchOfficeServices relation
 *
 * @method     ChildServicesQuery joinWithBranchOfficeServices($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BranchOfficeServices relation
 *
 * @method     ChildServicesQuery leftJoinWithBranchOfficeServices() Adds a LEFT JOIN clause and with to the query using the BranchOfficeServices relation
 * @method     ChildServicesQuery rightJoinWithBranchOfficeServices() Adds a RIGHT JOIN clause and with to the query using the BranchOfficeServices relation
 * @method     ChildServicesQuery innerJoinWithBranchOfficeServices() Adds a INNER JOIN clause and with to the query using the BranchOfficeServices relation
 *
 * @method     ChildServicesQuery leftJoinOrderDetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderDetail relation
 * @method     ChildServicesQuery rightJoinOrderDetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderDetail relation
 * @method     ChildServicesQuery innerJoinOrderDetail($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderDetail relation
 *
 * @method     ChildServicesQuery joinWithOrderDetail($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderDetail relation
 *
 * @method     ChildServicesQuery leftJoinWithOrderDetail() Adds a LEFT JOIN clause and with to the query using the OrderDetail relation
 * @method     ChildServicesQuery rightJoinWithOrderDetail() Adds a RIGHT JOIN clause and with to the query using the OrderDetail relation
 * @method     ChildServicesQuery innerJoinWithOrderDetail() Adds a INNER JOIN clause and with to the query using the OrderDetail relation
 *
 * @method     \ServiceCategoriesQuery|\BranchOfficeServicesQuery|\OrderDetailQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildServices|null findOne(ConnectionInterface $con = null) Return the first ChildServices matching the query
 * @method     ChildServices findOneOrCreate(ConnectionInterface $con = null) Return the first ChildServices matching the query, or a new ChildServices object populated from the query conditions when no match is found
 *
 * @method     ChildServices|null findOneById(int $id) Return the first ChildServices filtered by the id column
 * @method     ChildServices|null findOneByIdServiceCategory(int $id_service_category) Return the first ChildServices filtered by the id_service_category column
 * @method     ChildServices|null findOneByDescription(string $description) Return the first ChildServices filtered by the description column
 * @method     ChildServices|null findOneByNormalPrice(string $normal_price) Return the first ChildServices filtered by the normal_price column
 * @method     ChildServices|null findOneByUrgentPrice(string $urgent_price) Return the first ChildServices filtered by the urgent_price column
 * @method     ChildServices|null findOneByExtraUrgentPrice(string $extra_urgent_price) Return the first ChildServices filtered by the extra_urgent_price column
 * @method     ChildServices|null findOneByCreatedAt(string $created_at) Return the first ChildServices filtered by the created_at column
 * @method     ChildServices|null findOneByUpdatedAt(string $updated_at) Return the first ChildServices filtered by the updated_at column *

 * @method     ChildServices requirePk($key, ConnectionInterface $con = null) Return the ChildServices by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildServices requireOne(ConnectionInterface $con = null) Return the first ChildServices matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildServices requireOneById(int $id) Return the first ChildServices filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildServices requireOneByIdServiceCategory(int $id_service_category) Return the first ChildServices filtered by the id_service_category column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildServices requireOneByDescription(string $description) Return the first ChildServices filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildServices requireOneByNormalPrice(string $normal_price) Return the first ChildServices filtered by the normal_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildServices requireOneByUrgentPrice(string $urgent_price) Return the first ChildServices filtered by the urgent_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildServices requireOneByExtraUrgentPrice(string $extra_urgent_price) Return the first ChildServices filtered by the extra_urgent_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildServices requireOneByCreatedAt(string $created_at) Return the first ChildServices filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildServices requireOneByUpdatedAt(string $updated_at) Return the first ChildServices filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildServices[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildServices objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildServices> find(ConnectionInterface $con = null) Return ChildServices objects based on current ModelCriteria
 * @method     ChildServices[]|ObjectCollection findById(int $id) Return ChildServices objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildServices> findById(int $id) Return ChildServices objects filtered by the id column
 * @method     ChildServices[]|ObjectCollection findByIdServiceCategory(int $id_service_category) Return ChildServices objects filtered by the id_service_category column
 * @psalm-method ObjectCollection&\Traversable<ChildServices> findByIdServiceCategory(int $id_service_category) Return ChildServices objects filtered by the id_service_category column
 * @method     ChildServices[]|ObjectCollection findByDescription(string $description) Return ChildServices objects filtered by the description column
 * @psalm-method ObjectCollection&\Traversable<ChildServices> findByDescription(string $description) Return ChildServices objects filtered by the description column
 * @method     ChildServices[]|ObjectCollection findByNormalPrice(string $normal_price) Return ChildServices objects filtered by the normal_price column
 * @psalm-method ObjectCollection&\Traversable<ChildServices> findByNormalPrice(string $normal_price) Return ChildServices objects filtered by the normal_price column
 * @method     ChildServices[]|ObjectCollection findByUrgentPrice(string $urgent_price) Return ChildServices objects filtered by the urgent_price column
 * @psalm-method ObjectCollection&\Traversable<ChildServices> findByUrgentPrice(string $urgent_price) Return ChildServices objects filtered by the urgent_price column
 * @method     ChildServices[]|ObjectCollection findByExtraUrgentPrice(string $extra_urgent_price) Return ChildServices objects filtered by the extra_urgent_price column
 * @psalm-method ObjectCollection&\Traversable<ChildServices> findByExtraUrgentPrice(string $extra_urgent_price) Return ChildServices objects filtered by the extra_urgent_price column
 * @method     ChildServices[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildServices objects filtered by the created_at column
 * @psalm-method ObjectCollection&\Traversable<ChildServices> findByCreatedAt(string $created_at) Return ChildServices objects filtered by the created_at column
 * @method     ChildServices[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildServices objects filtered by the updated_at column
 * @psalm-method ObjectCollection&\Traversable<ChildServices> findByUpdatedAt(string $updated_at) Return ChildServices objects filtered by the updated_at column
 * @method     ChildServices[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildServices> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ServicesQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ServicesQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'golden_clean', $modelName = '\\Services', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildServicesQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildServicesQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildServicesQuery) {
            return $criteria;
        }
        $query = new ChildServicesQuery();
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
     * @return ChildServices|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ServicesTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ServicesTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildServices A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_service_category, description, normal_price, urgent_price, extra_urgent_price, created_at, updated_at FROM services WHERE id = :p0';
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
            /** @var ChildServices $obj */
            $obj = new ChildServices();
            $obj->hydrate($row);
            ServicesTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildServices|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildServicesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ServicesTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildServicesQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ServicesTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildServicesQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ServicesTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ServicesTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServicesTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_service_category column
     *
     * Example usage:
     * <code>
     * $query->filterByIdServiceCategory(1234); // WHERE id_service_category = 1234
     * $query->filterByIdServiceCategory(array(12, 34)); // WHERE id_service_category IN (12, 34)
     * $query->filterByIdServiceCategory(array('min' => 12)); // WHERE id_service_category > 12
     * </code>
     *
     * @see       filterByServiceCategories()
     *
     * @param     mixed $idServiceCategory The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildServicesQuery The current query, for fluid interface
     */
    public function filterByIdServiceCategory($idServiceCategory = null, $comparison = null)
    {
        if (is_array($idServiceCategory)) {
            $useMinMax = false;
            if (isset($idServiceCategory['min'])) {
                $this->addUsingAlias(ServicesTableMap::COL_ID_SERVICE_CATEGORY, $idServiceCategory['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idServiceCategory['max'])) {
                $this->addUsingAlias(ServicesTableMap::COL_ID_SERVICE_CATEGORY, $idServiceCategory['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServicesTableMap::COL_ID_SERVICE_CATEGORY, $idServiceCategory, $comparison);
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
     * @return $this|ChildServicesQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServicesTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildServicesQuery The current query, for fluid interface
     */
    public function filterByNormalPrice($normalPrice = null, $comparison = null)
    {
        if (is_array($normalPrice)) {
            $useMinMax = false;
            if (isset($normalPrice['min'])) {
                $this->addUsingAlias(ServicesTableMap::COL_NORMAL_PRICE, $normalPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($normalPrice['max'])) {
                $this->addUsingAlias(ServicesTableMap::COL_NORMAL_PRICE, $normalPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServicesTableMap::COL_NORMAL_PRICE, $normalPrice, $comparison);
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
     * @return $this|ChildServicesQuery The current query, for fluid interface
     */
    public function filterByUrgentPrice($urgentPrice = null, $comparison = null)
    {
        if (is_array($urgentPrice)) {
            $useMinMax = false;
            if (isset($urgentPrice['min'])) {
                $this->addUsingAlias(ServicesTableMap::COL_URGENT_PRICE, $urgentPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($urgentPrice['max'])) {
                $this->addUsingAlias(ServicesTableMap::COL_URGENT_PRICE, $urgentPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServicesTableMap::COL_URGENT_PRICE, $urgentPrice, $comparison);
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
     * @return $this|ChildServicesQuery The current query, for fluid interface
     */
    public function filterByExtraUrgentPrice($extraUrgentPrice = null, $comparison = null)
    {
        if (is_array($extraUrgentPrice)) {
            $useMinMax = false;
            if (isset($extraUrgentPrice['min'])) {
                $this->addUsingAlias(ServicesTableMap::COL_EXTRA_URGENT_PRICE, $extraUrgentPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($extraUrgentPrice['max'])) {
                $this->addUsingAlias(ServicesTableMap::COL_EXTRA_URGENT_PRICE, $extraUrgentPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServicesTableMap::COL_EXTRA_URGENT_PRICE, $extraUrgentPrice, $comparison);
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
     * @return $this|ChildServicesQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ServicesTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ServicesTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServicesTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildServicesQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ServicesTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ServicesTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServicesTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \ServiceCategories object
     *
     * @param \ServiceCategories|ObjectCollection $serviceCategories The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildServicesQuery The current query, for fluid interface
     */
    public function filterByServiceCategories($serviceCategories, $comparison = null)
    {
        if ($serviceCategories instanceof \ServiceCategories) {
            return $this
                ->addUsingAlias(ServicesTableMap::COL_ID_SERVICE_CATEGORY, $serviceCategories->getId(), $comparison);
        } elseif ($serviceCategories instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ServicesTableMap::COL_ID_SERVICE_CATEGORY, $serviceCategories->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByServiceCategories() only accepts arguments of type \ServiceCategories or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ServiceCategories relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildServicesQuery The current query, for fluid interface
     */
    public function joinServiceCategories($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ServiceCategories');

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
            $this->addJoinObject($join, 'ServiceCategories');
        }

        return $this;
    }

    /**
     * Use the ServiceCategories relation ServiceCategories object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ServiceCategoriesQuery A secondary query class using the current class as primary query
     */
    public function useServiceCategoriesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinServiceCategories($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ServiceCategories', '\ServiceCategoriesQuery');
    }

    /**
     * Use the ServiceCategories relation ServiceCategories object
     *
     * @param callable(\ServiceCategoriesQuery):\ServiceCategoriesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withServiceCategoriesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useServiceCategoriesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ServiceCategories table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \ServiceCategoriesQuery The inner query object of the EXISTS statement
     */
    public function useServiceCategoriesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ServiceCategories', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ServiceCategories table for a NOT EXISTS query.
     *
     * @see useServiceCategoriesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \ServiceCategoriesQuery The inner query object of the NOT EXISTS statement
     */
    public function useServiceCategoriesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ServiceCategories', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \BranchOfficeServices object
     *
     * @param \BranchOfficeServices|ObjectCollection $branchOfficeServices the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildServicesQuery The current query, for fluid interface
     */
    public function filterByBranchOfficeServices($branchOfficeServices, $comparison = null)
    {
        if ($branchOfficeServices instanceof \BranchOfficeServices) {
            return $this
                ->addUsingAlias(ServicesTableMap::COL_ID, $branchOfficeServices->getIdService(), $comparison);
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
     * @return $this|ChildServicesQuery The current query, for fluid interface
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
     * Filter the query by a related \OrderDetail object
     *
     * @param \OrderDetail|ObjectCollection $orderDetail the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildServicesQuery The current query, for fluid interface
     */
    public function filterByOrderDetail($orderDetail, $comparison = null)
    {
        if ($orderDetail instanceof \OrderDetail) {
            return $this
                ->addUsingAlias(ServicesTableMap::COL_ID, $orderDetail->getIdService(), $comparison);
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
     * @return $this|ChildServicesQuery The current query, for fluid interface
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
     * @param   ChildServices $services Object to remove from the list of results
     *
     * @return $this|ChildServicesQuery The current query, for fluid interface
     */
    public function prune($services = null)
    {
        if ($services) {
            $this->addUsingAlias(ServicesTableMap::COL_ID, $services->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the services table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ServicesTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ServicesTableMap::clearInstancePool();
            ServicesTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ServicesTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ServicesTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ServicesTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ServicesTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ServicesQuery
