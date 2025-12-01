<?php

namespace Base;

use \OrderDetail as ChildOrderDetail;
use \OrderDetailQuery as ChildOrderDetailQuery;
use \Exception;
use \PDO;
use Map\OrderDetailTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'order_detail' table.
 *
 *
 *
 * @method     ChildOrderDetailQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildOrderDetailQuery orderByIdOrder($order = Criteria::ASC) Order by the id_order column
 * @method     ChildOrderDetailQuery orderByIdOrderDetailStatus($order = Criteria::ASC) Order by the id_order_detail_status column
 * @method     ChildOrderDetailQuery orderByQuantity($order = Criteria::ASC) Order by the quantity column
 * @method     ChildOrderDetailQuery orderByIdColor($order = Criteria::ASC) Order by the id_color column
 * @method     ChildOrderDetailQuery orderByIdPrint($order = Criteria::ASC) Order by the id_print column
 * @method     ChildOrderDetailQuery orderByIdDefect($order = Criteria::ASC) Order by the id_defect column
 * @method     ChildOrderDetailQuery orderByIdService($order = Criteria::ASC) Order by the id_service column
 * @method     ChildOrderDetailQuery orderByObservations($order = Criteria::ASC) Order by the observations column
 * @method     ChildOrderDetailQuery orderByLocation($order = Criteria::ASC) Order by the location column
 * @method     ChildOrderDetailQuery orderByPrice($order = Criteria::ASC) Order by the price column
 * @method     ChildOrderDetailQuery orderByDiscount($order = Criteria::ASC) Order by the discount column
 * @method     ChildOrderDetailQuery orderBySubtotal($order = Criteria::ASC) Order by the subtotal column
 * @method     ChildOrderDetailQuery orderByTotal($order = Criteria::ASC) Order by the total column
 * @method     ChildOrderDetailQuery orderByRealDeliveryDate($order = Criteria::ASC) Order by the real_delivery_date column
 * @method     ChildOrderDetailQuery orderByRealDeliveryTime($order = Criteria::ASC) Order by the real_delivery_time column
 * @method     ChildOrderDetailQuery orderByIdDeliveryUser($order = Criteria::ASC) Order by the id_delivery_user column
 * @method     ChildOrderDetailQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOrderDetailQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildOrderDetailQuery groupById() Group by the id column
 * @method     ChildOrderDetailQuery groupByIdOrder() Group by the id_order column
 * @method     ChildOrderDetailQuery groupByIdOrderDetailStatus() Group by the id_order_detail_status column
 * @method     ChildOrderDetailQuery groupByQuantity() Group by the quantity column
 * @method     ChildOrderDetailQuery groupByIdColor() Group by the id_color column
 * @method     ChildOrderDetailQuery groupByIdPrint() Group by the id_print column
 * @method     ChildOrderDetailQuery groupByIdDefect() Group by the id_defect column
 * @method     ChildOrderDetailQuery groupByIdService() Group by the id_service column
 * @method     ChildOrderDetailQuery groupByObservations() Group by the observations column
 * @method     ChildOrderDetailQuery groupByLocation() Group by the location column
 * @method     ChildOrderDetailQuery groupByPrice() Group by the price column
 * @method     ChildOrderDetailQuery groupByDiscount() Group by the discount column
 * @method     ChildOrderDetailQuery groupBySubtotal() Group by the subtotal column
 * @method     ChildOrderDetailQuery groupByTotal() Group by the total column
 * @method     ChildOrderDetailQuery groupByRealDeliveryDate() Group by the real_delivery_date column
 * @method     ChildOrderDetailQuery groupByRealDeliveryTime() Group by the real_delivery_time column
 * @method     ChildOrderDetailQuery groupByIdDeliveryUser() Group by the id_delivery_user column
 * @method     ChildOrderDetailQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOrderDetailQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildOrderDetailQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOrderDetailQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOrderDetailQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOrderDetailQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOrderDetailQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOrderDetailQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOrderDetailQuery leftJoinColors($relationAlias = null) Adds a LEFT JOIN clause to the query using the Colors relation
 * @method     ChildOrderDetailQuery rightJoinColors($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Colors relation
 * @method     ChildOrderDetailQuery innerJoinColors($relationAlias = null) Adds a INNER JOIN clause to the query using the Colors relation
 *
 * @method     ChildOrderDetailQuery joinWithColors($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Colors relation
 *
 * @method     ChildOrderDetailQuery leftJoinWithColors() Adds a LEFT JOIN clause and with to the query using the Colors relation
 * @method     ChildOrderDetailQuery rightJoinWithColors() Adds a RIGHT JOIN clause and with to the query using the Colors relation
 * @method     ChildOrderDetailQuery innerJoinWithColors() Adds a INNER JOIN clause and with to the query using the Colors relation
 *
 * @method     ChildOrderDetailQuery leftJoinDefects($relationAlias = null) Adds a LEFT JOIN clause to the query using the Defects relation
 * @method     ChildOrderDetailQuery rightJoinDefects($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Defects relation
 * @method     ChildOrderDetailQuery innerJoinDefects($relationAlias = null) Adds a INNER JOIN clause to the query using the Defects relation
 *
 * @method     ChildOrderDetailQuery joinWithDefects($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Defects relation
 *
 * @method     ChildOrderDetailQuery leftJoinWithDefects() Adds a LEFT JOIN clause and with to the query using the Defects relation
 * @method     ChildOrderDetailQuery rightJoinWithDefects() Adds a RIGHT JOIN clause and with to the query using the Defects relation
 * @method     ChildOrderDetailQuery innerJoinWithDefects() Adds a INNER JOIN clause and with to the query using the Defects relation
 *
 * @method     ChildOrderDetailQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildOrderDetailQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildOrderDetailQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildOrderDetailQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildOrderDetailQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildOrderDetailQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildOrderDetailQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     ChildOrderDetailQuery leftJoinOrderDetailStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderDetailStatus relation
 * @method     ChildOrderDetailQuery rightJoinOrderDetailStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderDetailStatus relation
 * @method     ChildOrderDetailQuery innerJoinOrderDetailStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderDetailStatus relation
 *
 * @method     ChildOrderDetailQuery joinWithOrderDetailStatus($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderDetailStatus relation
 *
 * @method     ChildOrderDetailQuery leftJoinWithOrderDetailStatus() Adds a LEFT JOIN clause and with to the query using the OrderDetailStatus relation
 * @method     ChildOrderDetailQuery rightJoinWithOrderDetailStatus() Adds a RIGHT JOIN clause and with to the query using the OrderDetailStatus relation
 * @method     ChildOrderDetailQuery innerJoinWithOrderDetailStatus() Adds a INNER JOIN clause and with to the query using the OrderDetailStatus relation
 *
 * @method     ChildOrderDetailQuery leftJoinOrders($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orders relation
 * @method     ChildOrderDetailQuery rightJoinOrders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orders relation
 * @method     ChildOrderDetailQuery innerJoinOrders($relationAlias = null) Adds a INNER JOIN clause to the query using the Orders relation
 *
 * @method     ChildOrderDetailQuery joinWithOrders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orders relation
 *
 * @method     ChildOrderDetailQuery leftJoinWithOrders() Adds a LEFT JOIN clause and with to the query using the Orders relation
 * @method     ChildOrderDetailQuery rightJoinWithOrders() Adds a RIGHT JOIN clause and with to the query using the Orders relation
 * @method     ChildOrderDetailQuery innerJoinWithOrders() Adds a INNER JOIN clause and with to the query using the Orders relation
 *
 * @method     ChildOrderDetailQuery leftJoinPrints($relationAlias = null) Adds a LEFT JOIN clause to the query using the Prints relation
 * @method     ChildOrderDetailQuery rightJoinPrints($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Prints relation
 * @method     ChildOrderDetailQuery innerJoinPrints($relationAlias = null) Adds a INNER JOIN clause to the query using the Prints relation
 *
 * @method     ChildOrderDetailQuery joinWithPrints($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Prints relation
 *
 * @method     ChildOrderDetailQuery leftJoinWithPrints() Adds a LEFT JOIN clause and with to the query using the Prints relation
 * @method     ChildOrderDetailQuery rightJoinWithPrints() Adds a RIGHT JOIN clause and with to the query using the Prints relation
 * @method     ChildOrderDetailQuery innerJoinWithPrints() Adds a INNER JOIN clause and with to the query using the Prints relation
 *
 * @method     ChildOrderDetailQuery leftJoinServices($relationAlias = null) Adds a LEFT JOIN clause to the query using the Services relation
 * @method     ChildOrderDetailQuery rightJoinServices($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Services relation
 * @method     ChildOrderDetailQuery innerJoinServices($relationAlias = null) Adds a INNER JOIN clause to the query using the Services relation
 *
 * @method     ChildOrderDetailQuery joinWithServices($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Services relation
 *
 * @method     ChildOrderDetailQuery leftJoinWithServices() Adds a LEFT JOIN clause and with to the query using the Services relation
 * @method     ChildOrderDetailQuery rightJoinWithServices() Adds a RIGHT JOIN clause and with to the query using the Services relation
 * @method     ChildOrderDetailQuery innerJoinWithServices() Adds a INNER JOIN clause and with to the query using the Services relation
 *
 * @method     ChildOrderDetailQuery leftJoinOrderDetailHistory($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderDetailHistory relation
 * @method     ChildOrderDetailQuery rightJoinOrderDetailHistory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderDetailHistory relation
 * @method     ChildOrderDetailQuery innerJoinOrderDetailHistory($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderDetailHistory relation
 *
 * @method     ChildOrderDetailQuery joinWithOrderDetailHistory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderDetailHistory relation
 *
 * @method     ChildOrderDetailQuery leftJoinWithOrderDetailHistory() Adds a LEFT JOIN clause and with to the query using the OrderDetailHistory relation
 * @method     ChildOrderDetailQuery rightJoinWithOrderDetailHistory() Adds a RIGHT JOIN clause and with to the query using the OrderDetailHistory relation
 * @method     ChildOrderDetailQuery innerJoinWithOrderDetailHistory() Adds a INNER JOIN clause and with to the query using the OrderDetailHistory relation
 *
 * @method     \ColorsQuery|\DefectsQuery|\UsersQuery|\OrderDetailStatusQuery|\OrdersQuery|\PrintsQuery|\ServicesQuery|\OrderDetailHistoryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOrderDetail|null findOne(ConnectionInterface $con = null) Return the first ChildOrderDetail matching the query
 * @method     ChildOrderDetail findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOrderDetail matching the query, or a new ChildOrderDetail object populated from the query conditions when no match is found
 *
 * @method     ChildOrderDetail|null findOneById(int $id) Return the first ChildOrderDetail filtered by the id column
 * @method     ChildOrderDetail|null findOneByIdOrder(int $id_order) Return the first ChildOrderDetail filtered by the id_order column
 * @method     ChildOrderDetail|null findOneByIdOrderDetailStatus(int $id_order_detail_status) Return the first ChildOrderDetail filtered by the id_order_detail_status column
 * @method     ChildOrderDetail|null findOneByQuantity(string $quantity) Return the first ChildOrderDetail filtered by the quantity column
 * @method     ChildOrderDetail|null findOneByIdColor(int $id_color) Return the first ChildOrderDetail filtered by the id_color column
 * @method     ChildOrderDetail|null findOneByIdPrint(int $id_print) Return the first ChildOrderDetail filtered by the id_print column
 * @method     ChildOrderDetail|null findOneByIdDefect(int $id_defect) Return the first ChildOrderDetail filtered by the id_defect column
 * @method     ChildOrderDetail|null findOneByIdService(int $id_service) Return the first ChildOrderDetail filtered by the id_service column
 * @method     ChildOrderDetail|null findOneByObservations(string $observations) Return the first ChildOrderDetail filtered by the observations column
 * @method     ChildOrderDetail|null findOneByLocation(string $location) Return the first ChildOrderDetail filtered by the location column
 * @method     ChildOrderDetail|null findOneByPrice(string $price) Return the first ChildOrderDetail filtered by the price column
 * @method     ChildOrderDetail|null findOneByDiscount(string $discount) Return the first ChildOrderDetail filtered by the discount column
 * @method     ChildOrderDetail|null findOneBySubtotal(string $subtotal) Return the first ChildOrderDetail filtered by the subtotal column
 * @method     ChildOrderDetail|null findOneByTotal(string $total) Return the first ChildOrderDetail filtered by the total column
 * @method     ChildOrderDetail|null findOneByRealDeliveryDate(string $real_delivery_date) Return the first ChildOrderDetail filtered by the real_delivery_date column
 * @method     ChildOrderDetail|null findOneByRealDeliveryTime(string $real_delivery_time) Return the first ChildOrderDetail filtered by the real_delivery_time column
 * @method     ChildOrderDetail|null findOneByIdDeliveryUser(int $id_delivery_user) Return the first ChildOrderDetail filtered by the id_delivery_user column
 * @method     ChildOrderDetail|null findOneByCreatedAt(string $created_at) Return the first ChildOrderDetail filtered by the created_at column
 * @method     ChildOrderDetail|null findOneByUpdatedAt(string $updated_at) Return the first ChildOrderDetail filtered by the updated_at column *

 * @method     ChildOrderDetail requirePk($key, ConnectionInterface $con = null) Return the ChildOrderDetail by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetail requireOne(ConnectionInterface $con = null) Return the first ChildOrderDetail matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrderDetail requireOneById(int $id) Return the first ChildOrderDetail filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetail requireOneByIdOrder(int $id_order) Return the first ChildOrderDetail filtered by the id_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetail requireOneByIdOrderDetailStatus(int $id_order_detail_status) Return the first ChildOrderDetail filtered by the id_order_detail_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetail requireOneByQuantity(string $quantity) Return the first ChildOrderDetail filtered by the quantity column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetail requireOneByIdColor(int $id_color) Return the first ChildOrderDetail filtered by the id_color column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetail requireOneByIdPrint(int $id_print) Return the first ChildOrderDetail filtered by the id_print column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetail requireOneByIdDefect(int $id_defect) Return the first ChildOrderDetail filtered by the id_defect column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetail requireOneByIdService(int $id_service) Return the first ChildOrderDetail filtered by the id_service column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetail requireOneByObservations(string $observations) Return the first ChildOrderDetail filtered by the observations column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetail requireOneByLocation(string $location) Return the first ChildOrderDetail filtered by the location column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetail requireOneByPrice(string $price) Return the first ChildOrderDetail filtered by the price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetail requireOneByDiscount(string $discount) Return the first ChildOrderDetail filtered by the discount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetail requireOneBySubtotal(string $subtotal) Return the first ChildOrderDetail filtered by the subtotal column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetail requireOneByTotal(string $total) Return the first ChildOrderDetail filtered by the total column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetail requireOneByRealDeliveryDate(string $real_delivery_date) Return the first ChildOrderDetail filtered by the real_delivery_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetail requireOneByRealDeliveryTime(string $real_delivery_time) Return the first ChildOrderDetail filtered by the real_delivery_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetail requireOneByIdDeliveryUser(int $id_delivery_user) Return the first ChildOrderDetail filtered by the id_delivery_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetail requireOneByCreatedAt(string $created_at) Return the first ChildOrderDetail filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderDetail requireOneByUpdatedAt(string $updated_at) Return the first ChildOrderDetail filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrderDetail[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOrderDetail objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetail> find(ConnectionInterface $con = null) Return ChildOrderDetail objects based on current ModelCriteria
 * @method     ChildOrderDetail[]|ObjectCollection findById(int $id) Return ChildOrderDetail objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetail> findById(int $id) Return ChildOrderDetail objects filtered by the id column
 * @method     ChildOrderDetail[]|ObjectCollection findByIdOrder(int $id_order) Return ChildOrderDetail objects filtered by the id_order column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetail> findByIdOrder(int $id_order) Return ChildOrderDetail objects filtered by the id_order column
 * @method     ChildOrderDetail[]|ObjectCollection findByIdOrderDetailStatus(int $id_order_detail_status) Return ChildOrderDetail objects filtered by the id_order_detail_status column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetail> findByIdOrderDetailStatus(int $id_order_detail_status) Return ChildOrderDetail objects filtered by the id_order_detail_status column
 * @method     ChildOrderDetail[]|ObjectCollection findByQuantity(string $quantity) Return ChildOrderDetail objects filtered by the quantity column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetail> findByQuantity(string $quantity) Return ChildOrderDetail objects filtered by the quantity column
 * @method     ChildOrderDetail[]|ObjectCollection findByIdColor(int $id_color) Return ChildOrderDetail objects filtered by the id_color column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetail> findByIdColor(int $id_color) Return ChildOrderDetail objects filtered by the id_color column
 * @method     ChildOrderDetail[]|ObjectCollection findByIdPrint(int $id_print) Return ChildOrderDetail objects filtered by the id_print column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetail> findByIdPrint(int $id_print) Return ChildOrderDetail objects filtered by the id_print column
 * @method     ChildOrderDetail[]|ObjectCollection findByIdDefect(int $id_defect) Return ChildOrderDetail objects filtered by the id_defect column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetail> findByIdDefect(int $id_defect) Return ChildOrderDetail objects filtered by the id_defect column
 * @method     ChildOrderDetail[]|ObjectCollection findByIdService(int $id_service) Return ChildOrderDetail objects filtered by the id_service column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetail> findByIdService(int $id_service) Return ChildOrderDetail objects filtered by the id_service column
 * @method     ChildOrderDetail[]|ObjectCollection findByObservations(string $observations) Return ChildOrderDetail objects filtered by the observations column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetail> findByObservations(string $observations) Return ChildOrderDetail objects filtered by the observations column
 * @method     ChildOrderDetail[]|ObjectCollection findByLocation(string $location) Return ChildOrderDetail objects filtered by the location column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetail> findByLocation(string $location) Return ChildOrderDetail objects filtered by the location column
 * @method     ChildOrderDetail[]|ObjectCollection findByPrice(string $price) Return ChildOrderDetail objects filtered by the price column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetail> findByPrice(string $price) Return ChildOrderDetail objects filtered by the price column
 * @method     ChildOrderDetail[]|ObjectCollection findByDiscount(string $discount) Return ChildOrderDetail objects filtered by the discount column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetail> findByDiscount(string $discount) Return ChildOrderDetail objects filtered by the discount column
 * @method     ChildOrderDetail[]|ObjectCollection findBySubtotal(string $subtotal) Return ChildOrderDetail objects filtered by the subtotal column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetail> findBySubtotal(string $subtotal) Return ChildOrderDetail objects filtered by the subtotal column
 * @method     ChildOrderDetail[]|ObjectCollection findByTotal(string $total) Return ChildOrderDetail objects filtered by the total column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetail> findByTotal(string $total) Return ChildOrderDetail objects filtered by the total column
 * @method     ChildOrderDetail[]|ObjectCollection findByRealDeliveryDate(string $real_delivery_date) Return ChildOrderDetail objects filtered by the real_delivery_date column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetail> findByRealDeliveryDate(string $real_delivery_date) Return ChildOrderDetail objects filtered by the real_delivery_date column
 * @method     ChildOrderDetail[]|ObjectCollection findByRealDeliveryTime(string $real_delivery_time) Return ChildOrderDetail objects filtered by the real_delivery_time column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetail> findByRealDeliveryTime(string $real_delivery_time) Return ChildOrderDetail objects filtered by the real_delivery_time column
 * @method     ChildOrderDetail[]|ObjectCollection findByIdDeliveryUser(int $id_delivery_user) Return ChildOrderDetail objects filtered by the id_delivery_user column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetail> findByIdDeliveryUser(int $id_delivery_user) Return ChildOrderDetail objects filtered by the id_delivery_user column
 * @method     ChildOrderDetail[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildOrderDetail objects filtered by the created_at column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetail> findByCreatedAt(string $created_at) Return ChildOrderDetail objects filtered by the created_at column
 * @method     ChildOrderDetail[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildOrderDetail objects filtered by the updated_at column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderDetail> findByUpdatedAt(string $updated_at) Return ChildOrderDetail objects filtered by the updated_at column
 * @method     ChildOrderDetail[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOrderDetail> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OrderDetailQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\OrderDetailQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'golden_clean', $modelName = '\\OrderDetail', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOrderDetailQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOrderDetailQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOrderDetailQuery) {
            return $criteria;
        }
        $query = new ChildOrderDetailQuery();
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
     * @return ChildOrderDetail|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OrderDetailTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OrderDetailTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOrderDetail A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_order, id_order_detail_status, quantity, id_color, id_print, id_defect, id_service, observations, location, price, discount, subtotal, total, real_delivery_date, real_delivery_time, id_delivery_user, created_at, updated_at FROM order_detail WHERE id = :p0';
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
            /** @var ChildOrderDetail $obj */
            $obj = new ChildOrderDetail();
            $obj->hydrate($row);
            OrderDetailTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOrderDetail|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(OrderDetailTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(OrderDetailTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_order column
     *
     * Example usage:
     * <code>
     * $query->filterByIdOrder(1234); // WHERE id_order = 1234
     * $query->filterByIdOrder(array(12, 34)); // WHERE id_order IN (12, 34)
     * $query->filterByIdOrder(array('min' => 12)); // WHERE id_order > 12
     * </code>
     *
     * @see       filterByOrders()
     *
     * @param     mixed $idOrder The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByIdOrder($idOrder = null, $comparison = null)
    {
        if (is_array($idOrder)) {
            $useMinMax = false;
            if (isset($idOrder['min'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_ID_ORDER, $idOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idOrder['max'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_ID_ORDER, $idOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailTableMap::COL_ID_ORDER, $idOrder, $comparison);
    }

    /**
     * Filter the query on the id_order_detail_status column
     *
     * Example usage:
     * <code>
     * $query->filterByIdOrderDetailStatus(1234); // WHERE id_order_detail_status = 1234
     * $query->filterByIdOrderDetailStatus(array(12, 34)); // WHERE id_order_detail_status IN (12, 34)
     * $query->filterByIdOrderDetailStatus(array('min' => 12)); // WHERE id_order_detail_status > 12
     * </code>
     *
     * @see       filterByOrderDetailStatus()
     *
     * @param     mixed $idOrderDetailStatus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByIdOrderDetailStatus($idOrderDetailStatus = null, $comparison = null)
    {
        if (is_array($idOrderDetailStatus)) {
            $useMinMax = false;
            if (isset($idOrderDetailStatus['min'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_ID_ORDER_DETAIL_STATUS, $idOrderDetailStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idOrderDetailStatus['max'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_ID_ORDER_DETAIL_STATUS, $idOrderDetailStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailTableMap::COL_ID_ORDER_DETAIL_STATUS, $idOrderDetailStatus, $comparison);
    }

    /**
     * Filter the query on the quantity column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantity(1234); // WHERE quantity = 1234
     * $query->filterByQuantity(array(12, 34)); // WHERE quantity IN (12, 34)
     * $query->filterByQuantity(array('min' => 12)); // WHERE quantity > 12
     * </code>
     *
     * @param     mixed $quantity The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByQuantity($quantity = null, $comparison = null)
    {
        if (is_array($quantity)) {
            $useMinMax = false;
            if (isset($quantity['min'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_QUANTITY, $quantity['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantity['max'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_QUANTITY, $quantity['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailTableMap::COL_QUANTITY, $quantity, $comparison);
    }

    /**
     * Filter the query on the id_color column
     *
     * Example usage:
     * <code>
     * $query->filterByIdColor(1234); // WHERE id_color = 1234
     * $query->filterByIdColor(array(12, 34)); // WHERE id_color IN (12, 34)
     * $query->filterByIdColor(array('min' => 12)); // WHERE id_color > 12
     * </code>
     *
     * @see       filterByColors()
     *
     * @param     mixed $idColor The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByIdColor($idColor = null, $comparison = null)
    {
        if (is_array($idColor)) {
            $useMinMax = false;
            if (isset($idColor['min'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_ID_COLOR, $idColor['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idColor['max'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_ID_COLOR, $idColor['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailTableMap::COL_ID_COLOR, $idColor, $comparison);
    }

    /**
     * Filter the query on the id_print column
     *
     * Example usage:
     * <code>
     * $query->filterByIdPrint(1234); // WHERE id_print = 1234
     * $query->filterByIdPrint(array(12, 34)); // WHERE id_print IN (12, 34)
     * $query->filterByIdPrint(array('min' => 12)); // WHERE id_print > 12
     * </code>
     *
     * @see       filterByPrints()
     *
     * @param     mixed $idPrint The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByIdPrint($idPrint = null, $comparison = null)
    {
        if (is_array($idPrint)) {
            $useMinMax = false;
            if (isset($idPrint['min'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_ID_PRINT, $idPrint['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idPrint['max'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_ID_PRINT, $idPrint['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailTableMap::COL_ID_PRINT, $idPrint, $comparison);
    }

    /**
     * Filter the query on the id_defect column
     *
     * Example usage:
     * <code>
     * $query->filterByIdDefect(1234); // WHERE id_defect = 1234
     * $query->filterByIdDefect(array(12, 34)); // WHERE id_defect IN (12, 34)
     * $query->filterByIdDefect(array('min' => 12)); // WHERE id_defect > 12
     * </code>
     *
     * @see       filterByDefects()
     *
     * @param     mixed $idDefect The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByIdDefect($idDefect = null, $comparison = null)
    {
        if (is_array($idDefect)) {
            $useMinMax = false;
            if (isset($idDefect['min'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_ID_DEFECT, $idDefect['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idDefect['max'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_ID_DEFECT, $idDefect['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailTableMap::COL_ID_DEFECT, $idDefect, $comparison);
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
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByIdService($idService = null, $comparison = null)
    {
        if (is_array($idService)) {
            $useMinMax = false;
            if (isset($idService['min'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_ID_SERVICE, $idService['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idService['max'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_ID_SERVICE, $idService['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailTableMap::COL_ID_SERVICE, $idService, $comparison);
    }

    /**
     * Filter the query on the observations column
     *
     * Example usage:
     * <code>
     * $query->filterByObservations('fooValue');   // WHERE observations = 'fooValue'
     * $query->filterByObservations('%fooValue%', Criteria::LIKE); // WHERE observations LIKE '%fooValue%'
     * </code>
     *
     * @param     string $observations The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByObservations($observations = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($observations)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailTableMap::COL_OBSERVATIONS, $observations, $comparison);
    }

    /**
     * Filter the query on the location column
     *
     * Example usage:
     * <code>
     * $query->filterByLocation('fooValue');   // WHERE location = 'fooValue'
     * $query->filterByLocation('%fooValue%', Criteria::LIKE); // WHERE location LIKE '%fooValue%'
     * </code>
     *
     * @param     string $location The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByLocation($location = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($location)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailTableMap::COL_LOCATION, $location, $comparison);
    }

    /**
     * Filter the query on the price column
     *
     * Example usage:
     * <code>
     * $query->filterByPrice(1234); // WHERE price = 1234
     * $query->filterByPrice(array(12, 34)); // WHERE price IN (12, 34)
     * $query->filterByPrice(array('min' => 12)); // WHERE price > 12
     * </code>
     *
     * @param     mixed $price The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByPrice($price = null, $comparison = null)
    {
        if (is_array($price)) {
            $useMinMax = false;
            if (isset($price['min'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_PRICE, $price['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($price['max'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_PRICE, $price['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailTableMap::COL_PRICE, $price, $comparison);
    }

    /**
     * Filter the query on the discount column
     *
     * Example usage:
     * <code>
     * $query->filterByDiscount(1234); // WHERE discount = 1234
     * $query->filterByDiscount(array(12, 34)); // WHERE discount IN (12, 34)
     * $query->filterByDiscount(array('min' => 12)); // WHERE discount > 12
     * </code>
     *
     * @param     mixed $discount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByDiscount($discount = null, $comparison = null)
    {
        if (is_array($discount)) {
            $useMinMax = false;
            if (isset($discount['min'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_DISCOUNT, $discount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($discount['max'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_DISCOUNT, $discount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailTableMap::COL_DISCOUNT, $discount, $comparison);
    }

    /**
     * Filter the query on the subtotal column
     *
     * Example usage:
     * <code>
     * $query->filterBySubtotal(1234); // WHERE subtotal = 1234
     * $query->filterBySubtotal(array(12, 34)); // WHERE subtotal IN (12, 34)
     * $query->filterBySubtotal(array('min' => 12)); // WHERE subtotal > 12
     * </code>
     *
     * @param     mixed $subtotal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterBySubtotal($subtotal = null, $comparison = null)
    {
        if (is_array($subtotal)) {
            $useMinMax = false;
            if (isset($subtotal['min'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_SUBTOTAL, $subtotal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($subtotal['max'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_SUBTOTAL, $subtotal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailTableMap::COL_SUBTOTAL, $subtotal, $comparison);
    }

    /**
     * Filter the query on the total column
     *
     * Example usage:
     * <code>
     * $query->filterByTotal(1234); // WHERE total = 1234
     * $query->filterByTotal(array(12, 34)); // WHERE total IN (12, 34)
     * $query->filterByTotal(array('min' => 12)); // WHERE total > 12
     * </code>
     *
     * @param     mixed $total The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByTotal($total = null, $comparison = null)
    {
        if (is_array($total)) {
            $useMinMax = false;
            if (isset($total['min'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_TOTAL, $total['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($total['max'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_TOTAL, $total['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailTableMap::COL_TOTAL, $total, $comparison);
    }

    /**
     * Filter the query on the real_delivery_date column
     *
     * Example usage:
     * <code>
     * $query->filterByRealDeliveryDate('2011-03-14'); // WHERE real_delivery_date = '2011-03-14'
     * $query->filterByRealDeliveryDate('now'); // WHERE real_delivery_date = '2011-03-14'
     * $query->filterByRealDeliveryDate(array('max' => 'yesterday')); // WHERE real_delivery_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $realDeliveryDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByRealDeliveryDate($realDeliveryDate = null, $comparison = null)
    {
        if (is_array($realDeliveryDate)) {
            $useMinMax = false;
            if (isset($realDeliveryDate['min'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_REAL_DELIVERY_DATE, $realDeliveryDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($realDeliveryDate['max'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_REAL_DELIVERY_DATE, $realDeliveryDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailTableMap::COL_REAL_DELIVERY_DATE, $realDeliveryDate, $comparison);
    }

    /**
     * Filter the query on the real_delivery_time column
     *
     * Example usage:
     * <code>
     * $query->filterByRealDeliveryTime('2011-03-14'); // WHERE real_delivery_time = '2011-03-14'
     * $query->filterByRealDeliveryTime('now'); // WHERE real_delivery_time = '2011-03-14'
     * $query->filterByRealDeliveryTime(array('max' => 'yesterday')); // WHERE real_delivery_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $realDeliveryTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByRealDeliveryTime($realDeliveryTime = null, $comparison = null)
    {
        if (is_array($realDeliveryTime)) {
            $useMinMax = false;
            if (isset($realDeliveryTime['min'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_REAL_DELIVERY_TIME, $realDeliveryTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($realDeliveryTime['max'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_REAL_DELIVERY_TIME, $realDeliveryTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailTableMap::COL_REAL_DELIVERY_TIME, $realDeliveryTime, $comparison);
    }

    /**
     * Filter the query on the id_delivery_user column
     *
     * Example usage:
     * <code>
     * $query->filterByIdDeliveryUser(1234); // WHERE id_delivery_user = 1234
     * $query->filterByIdDeliveryUser(array(12, 34)); // WHERE id_delivery_user IN (12, 34)
     * $query->filterByIdDeliveryUser(array('min' => 12)); // WHERE id_delivery_user > 12
     * </code>
     *
     * @see       filterByUsers()
     *
     * @param     mixed $idDeliveryUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByIdDeliveryUser($idDeliveryUser = null, $comparison = null)
    {
        if (is_array($idDeliveryUser)) {
            $useMinMax = false;
            if (isset($idDeliveryUser['min'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_ID_DELIVERY_USER, $idDeliveryUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idDeliveryUser['max'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_ID_DELIVERY_USER, $idDeliveryUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailTableMap::COL_ID_DELIVERY_USER, $idDeliveryUser, $comparison);
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
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(OrderDetailTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderDetailTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Colors object
     *
     * @param \Colors|ObjectCollection $colors The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByColors($colors, $comparison = null)
    {
        if ($colors instanceof \Colors) {
            return $this
                ->addUsingAlias(OrderDetailTableMap::COL_ID_COLOR, $colors->getId(), $comparison);
        } elseif ($colors instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderDetailTableMap::COL_ID_COLOR, $colors->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByColors() only accepts arguments of type \Colors or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Colors relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function joinColors($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Colors');

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
            $this->addJoinObject($join, 'Colors');
        }

        return $this;
    }

    /**
     * Use the Colors relation Colors object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ColorsQuery A secondary query class using the current class as primary query
     */
    public function useColorsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinColors($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Colors', '\ColorsQuery');
    }

    /**
     * Use the Colors relation Colors object
     *
     * @param callable(\ColorsQuery):\ColorsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withColorsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useColorsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Colors table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \ColorsQuery The inner query object of the EXISTS statement
     */
    public function useColorsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Colors', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Colors table for a NOT EXISTS query.
     *
     * @see useColorsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \ColorsQuery The inner query object of the NOT EXISTS statement
     */
    public function useColorsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Colors', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Defects object
     *
     * @param \Defects|ObjectCollection $defects The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByDefects($defects, $comparison = null)
    {
        if ($defects instanceof \Defects) {
            return $this
                ->addUsingAlias(OrderDetailTableMap::COL_ID_DEFECT, $defects->getId(), $comparison);
        } elseif ($defects instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderDetailTableMap::COL_ID_DEFECT, $defects->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByDefects() only accepts arguments of type \Defects or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Defects relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function joinDefects($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Defects');

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
            $this->addJoinObject($join, 'Defects');
        }

        return $this;
    }

    /**
     * Use the Defects relation Defects object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DefectsQuery A secondary query class using the current class as primary query
     */
    public function useDefectsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDefects($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Defects', '\DefectsQuery');
    }

    /**
     * Use the Defects relation Defects object
     *
     * @param callable(\DefectsQuery):\DefectsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDefectsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useDefectsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Defects table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DefectsQuery The inner query object of the EXISTS statement
     */
    public function useDefectsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Defects', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Defects table for a NOT EXISTS query.
     *
     * @see useDefectsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DefectsQuery The inner query object of the NOT EXISTS statement
     */
    public function useDefectsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Defects', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Users object
     *
     * @param \Users|ObjectCollection $users The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByUsers($users, $comparison = null)
    {
        if ($users instanceof \Users) {
            return $this
                ->addUsingAlias(OrderDetailTableMap::COL_ID_DELIVERY_USER, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderDetailTableMap::COL_ID_DELIVERY_USER, $users->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
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
     * Filter the query by a related \OrderDetailStatus object
     *
     * @param \OrderDetailStatus|ObjectCollection $orderDetailStatus The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByOrderDetailStatus($orderDetailStatus, $comparison = null)
    {
        if ($orderDetailStatus instanceof \OrderDetailStatus) {
            return $this
                ->addUsingAlias(OrderDetailTableMap::COL_ID_ORDER_DETAIL_STATUS, $orderDetailStatus->getId(), $comparison);
        } elseif ($orderDetailStatus instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderDetailTableMap::COL_ID_ORDER_DETAIL_STATUS, $orderDetailStatus->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByOrderDetailStatus() only accepts arguments of type \OrderDetailStatus or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrderDetailStatus relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function joinOrderDetailStatus($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrderDetailStatus');

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
            $this->addJoinObject($join, 'OrderDetailStatus');
        }

        return $this;
    }

    /**
     * Use the OrderDetailStatus relation OrderDetailStatus object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrderDetailStatusQuery A secondary query class using the current class as primary query
     */
    public function useOrderDetailStatusQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderDetailStatus($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrderDetailStatus', '\OrderDetailStatusQuery');
    }

    /**
     * Use the OrderDetailStatus relation OrderDetailStatus object
     *
     * @param callable(\OrderDetailStatusQuery):\OrderDetailStatusQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrderDetailStatusQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrderDetailStatusQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to OrderDetailStatus table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \OrderDetailStatusQuery The inner query object of the EXISTS statement
     */
    public function useOrderDetailStatusExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('OrderDetailStatus', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to OrderDetailStatus table for a NOT EXISTS query.
     *
     * @see useOrderDetailStatusExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \OrderDetailStatusQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrderDetailStatusNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('OrderDetailStatus', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Orders object
     *
     * @param \Orders|ObjectCollection $orders The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByOrders($orders, $comparison = null)
    {
        if ($orders instanceof \Orders) {
            return $this
                ->addUsingAlias(OrderDetailTableMap::COL_ID_ORDER, $orders->getId(), $comparison);
        } elseif ($orders instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderDetailTableMap::COL_ID_ORDER, $orders->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
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
     * Filter the query by a related \Prints object
     *
     * @param \Prints|ObjectCollection $prints The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByPrints($prints, $comparison = null)
    {
        if ($prints instanceof \Prints) {
            return $this
                ->addUsingAlias(OrderDetailTableMap::COL_ID_PRINT, $prints->getId(), $comparison);
        } elseif ($prints instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderDetailTableMap::COL_ID_PRINT, $prints->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPrints() only accepts arguments of type \Prints or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Prints relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function joinPrints($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Prints');

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
            $this->addJoinObject($join, 'Prints');
        }

        return $this;
    }

    /**
     * Use the Prints relation Prints object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PrintsQuery A secondary query class using the current class as primary query
     */
    public function usePrintsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPrints($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Prints', '\PrintsQuery');
    }

    /**
     * Use the Prints relation Prints object
     *
     * @param callable(\PrintsQuery):\PrintsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPrintsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePrintsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Prints table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \PrintsQuery The inner query object of the EXISTS statement
     */
    public function usePrintsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Prints', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Prints table for a NOT EXISTS query.
     *
     * @see usePrintsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \PrintsQuery The inner query object of the NOT EXISTS statement
     */
    public function usePrintsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Prints', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Services object
     *
     * @param \Services|ObjectCollection $services The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByServices($services, $comparison = null)
    {
        if ($services instanceof \Services) {
            return $this
                ->addUsingAlias(OrderDetailTableMap::COL_ID_SERVICE, $services->getId(), $comparison);
        } elseif ($services instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderDetailTableMap::COL_ID_SERVICE, $services->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
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
     * Filter the query by a related \OrderDetailHistory object
     *
     * @param \OrderDetailHistory|ObjectCollection $orderDetailHistory the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOrderDetailQuery The current query, for fluid interface
     */
    public function filterByOrderDetailHistory($orderDetailHistory, $comparison = null)
    {
        if ($orderDetailHistory instanceof \OrderDetailHistory) {
            return $this
                ->addUsingAlias(OrderDetailTableMap::COL_ID, $orderDetailHistory->getIdOrderDetail(), $comparison);
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
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
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
     * @param   ChildOrderDetail $orderDetail Object to remove from the list of results
     *
     * @return $this|ChildOrderDetailQuery The current query, for fluid interface
     */
    public function prune($orderDetail = null)
    {
        if ($orderDetail) {
            $this->addUsingAlias(OrderDetailTableMap::COL_ID, $orderDetail->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the order_detail table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderDetailTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OrderDetailTableMap::clearInstancePool();
            OrderDetailTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OrderDetailTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OrderDetailTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OrderDetailTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OrderDetailTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // OrderDetailQuery
