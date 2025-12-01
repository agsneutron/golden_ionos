<?php

namespace Base;

use \OrderHistory as ChildOrderHistory;
use \OrderHistoryQuery as ChildOrderHistoryQuery;
use \Exception;
use \PDO;
use Map\OrderHistoryTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'order_history' table.
 *
 *
 *
 * @method     ChildOrderHistoryQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildOrderHistoryQuery orderByIdOrder($order = Criteria::ASC) Order by the id_order column
 * @method     ChildOrderHistoryQuery orderByIdOrderStatus($order = Criteria::ASC) Order by the id_order_status column
 * @method     ChildOrderHistoryQuery orderByAmountPaid($order = Criteria::ASC) Order by the amount_paid column
 * @method     ChildOrderHistoryQuery orderByTotalPaid($order = Criteria::ASC) Order by the total_paid column
 * @method     ChildOrderHistoryQuery orderByIdPaymentMethod($order = Criteria::ASC) Order by the id_payment_method column
 * @method     ChildOrderHistoryQuery orderByIdPaymentStatus($order = Criteria::ASC) Order by the id_payment_status column
 * @method     ChildOrderHistoryQuery orderByUid($order = Criteria::ASC) Order by the uid column
 * @method     ChildOrderHistoryQuery orderByPaymentFile($order = Criteria::ASC) Order by the payment_file column
 * @method     ChildOrderHistoryQuery orderByVoucher($order = Criteria::ASC) Order by the voucher column
 * @method     ChildOrderHistoryQuery orderByDeletedPayment($order = Criteria::ASC) Order by the deleted_payment column
 * @method     ChildOrderHistoryQuery orderByIdUser($order = Criteria::ASC) Order by the id_user column
 * @method     ChildOrderHistoryQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOrderHistoryQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildOrderHistoryQuery groupById() Group by the id column
 * @method     ChildOrderHistoryQuery groupByIdOrder() Group by the id_order column
 * @method     ChildOrderHistoryQuery groupByIdOrderStatus() Group by the id_order_status column
 * @method     ChildOrderHistoryQuery groupByAmountPaid() Group by the amount_paid column
 * @method     ChildOrderHistoryQuery groupByTotalPaid() Group by the total_paid column
 * @method     ChildOrderHistoryQuery groupByIdPaymentMethod() Group by the id_payment_method column
 * @method     ChildOrderHistoryQuery groupByIdPaymentStatus() Group by the id_payment_status column
 * @method     ChildOrderHistoryQuery groupByUid() Group by the uid column
 * @method     ChildOrderHistoryQuery groupByPaymentFile() Group by the payment_file column
 * @method     ChildOrderHistoryQuery groupByVoucher() Group by the voucher column
 * @method     ChildOrderHistoryQuery groupByDeletedPayment() Group by the deleted_payment column
 * @method     ChildOrderHistoryQuery groupByIdUser() Group by the id_user column
 * @method     ChildOrderHistoryQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOrderHistoryQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildOrderHistoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOrderHistoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOrderHistoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOrderHistoryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOrderHistoryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOrderHistoryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOrderHistoryQuery leftJoinOrders($relationAlias = null) Adds a LEFT JOIN clause to the query using the Orders relation
 * @method     ChildOrderHistoryQuery rightJoinOrders($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Orders relation
 * @method     ChildOrderHistoryQuery innerJoinOrders($relationAlias = null) Adds a INNER JOIN clause to the query using the Orders relation
 *
 * @method     ChildOrderHistoryQuery joinWithOrders($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Orders relation
 *
 * @method     ChildOrderHistoryQuery leftJoinWithOrders() Adds a LEFT JOIN clause and with to the query using the Orders relation
 * @method     ChildOrderHistoryQuery rightJoinWithOrders() Adds a RIGHT JOIN clause and with to the query using the Orders relation
 * @method     ChildOrderHistoryQuery innerJoinWithOrders() Adds a INNER JOIN clause and with to the query using the Orders relation
 *
 * @method     ChildOrderHistoryQuery leftJoinOrderStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderStatus relation
 * @method     ChildOrderHistoryQuery rightJoinOrderStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderStatus relation
 * @method     ChildOrderHistoryQuery innerJoinOrderStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderStatus relation
 *
 * @method     ChildOrderHistoryQuery joinWithOrderStatus($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderStatus relation
 *
 * @method     ChildOrderHistoryQuery leftJoinWithOrderStatus() Adds a LEFT JOIN clause and with to the query using the OrderStatus relation
 * @method     ChildOrderHistoryQuery rightJoinWithOrderStatus() Adds a RIGHT JOIN clause and with to the query using the OrderStatus relation
 * @method     ChildOrderHistoryQuery innerJoinWithOrderStatus() Adds a INNER JOIN clause and with to the query using the OrderStatus relation
 *
 * @method     ChildOrderHistoryQuery leftJoinPaymentMethods($relationAlias = null) Adds a LEFT JOIN clause to the query using the PaymentMethods relation
 * @method     ChildOrderHistoryQuery rightJoinPaymentMethods($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PaymentMethods relation
 * @method     ChildOrderHistoryQuery innerJoinPaymentMethods($relationAlias = null) Adds a INNER JOIN clause to the query using the PaymentMethods relation
 *
 * @method     ChildOrderHistoryQuery joinWithPaymentMethods($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PaymentMethods relation
 *
 * @method     ChildOrderHistoryQuery leftJoinWithPaymentMethods() Adds a LEFT JOIN clause and with to the query using the PaymentMethods relation
 * @method     ChildOrderHistoryQuery rightJoinWithPaymentMethods() Adds a RIGHT JOIN clause and with to the query using the PaymentMethods relation
 * @method     ChildOrderHistoryQuery innerJoinWithPaymentMethods() Adds a INNER JOIN clause and with to the query using the PaymentMethods relation
 *
 * @method     ChildOrderHistoryQuery leftJoinPaymentStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the PaymentStatus relation
 * @method     ChildOrderHistoryQuery rightJoinPaymentStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PaymentStatus relation
 * @method     ChildOrderHistoryQuery innerJoinPaymentStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the PaymentStatus relation
 *
 * @method     ChildOrderHistoryQuery joinWithPaymentStatus($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PaymentStatus relation
 *
 * @method     ChildOrderHistoryQuery leftJoinWithPaymentStatus() Adds a LEFT JOIN clause and with to the query using the PaymentStatus relation
 * @method     ChildOrderHistoryQuery rightJoinWithPaymentStatus() Adds a RIGHT JOIN clause and with to the query using the PaymentStatus relation
 * @method     ChildOrderHistoryQuery innerJoinWithPaymentStatus() Adds a INNER JOIN clause and with to the query using the PaymentStatus relation
 *
 * @method     ChildOrderHistoryQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildOrderHistoryQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildOrderHistoryQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildOrderHistoryQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildOrderHistoryQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildOrderHistoryQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildOrderHistoryQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     \OrdersQuery|\OrderStatusQuery|\PaymentMethodsQuery|\PaymentStatusQuery|\UsersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOrderHistory|null findOne(ConnectionInterface $con = null) Return the first ChildOrderHistory matching the query
 * @method     ChildOrderHistory findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOrderHistory matching the query, or a new ChildOrderHistory object populated from the query conditions when no match is found
 *
 * @method     ChildOrderHistory|null findOneById(int $id) Return the first ChildOrderHistory filtered by the id column
 * @method     ChildOrderHistory|null findOneByIdOrder(int $id_order) Return the first ChildOrderHistory filtered by the id_order column
 * @method     ChildOrderHistory|null findOneByIdOrderStatus(int $id_order_status) Return the first ChildOrderHistory filtered by the id_order_status column
 * @method     ChildOrderHistory|null findOneByAmountPaid(string $amount_paid) Return the first ChildOrderHistory filtered by the amount_paid column
 * @method     ChildOrderHistory|null findOneByTotalPaid(string $total_paid) Return the first ChildOrderHistory filtered by the total_paid column
 * @method     ChildOrderHistory|null findOneByIdPaymentMethod(int $id_payment_method) Return the first ChildOrderHistory filtered by the id_payment_method column
 * @method     ChildOrderHistory|null findOneByIdPaymentStatus(int $id_payment_status) Return the first ChildOrderHistory filtered by the id_payment_status column
 * @method     ChildOrderHistory|null findOneByUid(string $uid) Return the first ChildOrderHistory filtered by the uid column
 * @method     ChildOrderHistory|null findOneByPaymentFile(string $payment_file) Return the first ChildOrderHistory filtered by the payment_file column
 * @method     ChildOrderHistory|null findOneByVoucher(string $voucher) Return the first ChildOrderHistory filtered by the voucher column
 * @method     ChildOrderHistory|null findOneByDeletedPayment(int $deleted_payment) Return the first ChildOrderHistory filtered by the deleted_payment column
 * @method     ChildOrderHistory|null findOneByIdUser(int $id_user) Return the first ChildOrderHistory filtered by the id_user column
 * @method     ChildOrderHistory|null findOneByCreatedAt(string $created_at) Return the first ChildOrderHistory filtered by the created_at column
 * @method     ChildOrderHistory|null findOneByUpdatedAt(string $updated_at) Return the first ChildOrderHistory filtered by the updated_at column *

 * @method     ChildOrderHistory requirePk($key, ConnectionInterface $con = null) Return the ChildOrderHistory by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderHistory requireOne(ConnectionInterface $con = null) Return the first ChildOrderHistory matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrderHistory requireOneById(int $id) Return the first ChildOrderHistory filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderHistory requireOneByIdOrder(int $id_order) Return the first ChildOrderHistory filtered by the id_order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderHistory requireOneByIdOrderStatus(int $id_order_status) Return the first ChildOrderHistory filtered by the id_order_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderHistory requireOneByAmountPaid(string $amount_paid) Return the first ChildOrderHistory filtered by the amount_paid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderHistory requireOneByTotalPaid(string $total_paid) Return the first ChildOrderHistory filtered by the total_paid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderHistory requireOneByIdPaymentMethod(int $id_payment_method) Return the first ChildOrderHistory filtered by the id_payment_method column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderHistory requireOneByIdPaymentStatus(int $id_payment_status) Return the first ChildOrderHistory filtered by the id_payment_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderHistory requireOneByUid(string $uid) Return the first ChildOrderHistory filtered by the uid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderHistory requireOneByPaymentFile(string $payment_file) Return the first ChildOrderHistory filtered by the payment_file column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderHistory requireOneByVoucher(string $voucher) Return the first ChildOrderHistory filtered by the voucher column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderHistory requireOneByDeletedPayment(int $deleted_payment) Return the first ChildOrderHistory filtered by the deleted_payment column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderHistory requireOneByIdUser(int $id_user) Return the first ChildOrderHistory filtered by the id_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderHistory requireOneByCreatedAt(string $created_at) Return the first ChildOrderHistory filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrderHistory requireOneByUpdatedAt(string $updated_at) Return the first ChildOrderHistory filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrderHistory[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOrderHistory objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildOrderHistory> find(ConnectionInterface $con = null) Return ChildOrderHistory objects based on current ModelCriteria
 * @method     ChildOrderHistory[]|ObjectCollection findById(int $id) Return ChildOrderHistory objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderHistory> findById(int $id) Return ChildOrderHistory objects filtered by the id column
 * @method     ChildOrderHistory[]|ObjectCollection findByIdOrder(int $id_order) Return ChildOrderHistory objects filtered by the id_order column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderHistory> findByIdOrder(int $id_order) Return ChildOrderHistory objects filtered by the id_order column
 * @method     ChildOrderHistory[]|ObjectCollection findByIdOrderStatus(int $id_order_status) Return ChildOrderHistory objects filtered by the id_order_status column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderHistory> findByIdOrderStatus(int $id_order_status) Return ChildOrderHistory objects filtered by the id_order_status column
 * @method     ChildOrderHistory[]|ObjectCollection findByAmountPaid(string $amount_paid) Return ChildOrderHistory objects filtered by the amount_paid column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderHistory> findByAmountPaid(string $amount_paid) Return ChildOrderHistory objects filtered by the amount_paid column
 * @method     ChildOrderHistory[]|ObjectCollection findByTotalPaid(string $total_paid) Return ChildOrderHistory objects filtered by the total_paid column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderHistory> findByTotalPaid(string $total_paid) Return ChildOrderHistory objects filtered by the total_paid column
 * @method     ChildOrderHistory[]|ObjectCollection findByIdPaymentMethod(int $id_payment_method) Return ChildOrderHistory objects filtered by the id_payment_method column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderHistory> findByIdPaymentMethod(int $id_payment_method) Return ChildOrderHistory objects filtered by the id_payment_method column
 * @method     ChildOrderHistory[]|ObjectCollection findByIdPaymentStatus(int $id_payment_status) Return ChildOrderHistory objects filtered by the id_payment_status column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderHistory> findByIdPaymentStatus(int $id_payment_status) Return ChildOrderHistory objects filtered by the id_payment_status column
 * @method     ChildOrderHistory[]|ObjectCollection findByUid(string $uid) Return ChildOrderHistory objects filtered by the uid column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderHistory> findByUid(string $uid) Return ChildOrderHistory objects filtered by the uid column
 * @method     ChildOrderHistory[]|ObjectCollection findByPaymentFile(string $payment_file) Return ChildOrderHistory objects filtered by the payment_file column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderHistory> findByPaymentFile(string $payment_file) Return ChildOrderHistory objects filtered by the payment_file column
 * @method     ChildOrderHistory[]|ObjectCollection findByVoucher(string $voucher) Return ChildOrderHistory objects filtered by the voucher column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderHistory> findByVoucher(string $voucher) Return ChildOrderHistory objects filtered by the voucher column
 * @method     ChildOrderHistory[]|ObjectCollection findByDeletedPayment(int $deleted_payment) Return ChildOrderHistory objects filtered by the deleted_payment column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderHistory> findByDeletedPayment(int $deleted_payment) Return ChildOrderHistory objects filtered by the deleted_payment column
 * @method     ChildOrderHistory[]|ObjectCollection findByIdUser(int $id_user) Return ChildOrderHistory objects filtered by the id_user column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderHistory> findByIdUser(int $id_user) Return ChildOrderHistory objects filtered by the id_user column
 * @method     ChildOrderHistory[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildOrderHistory objects filtered by the created_at column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderHistory> findByCreatedAt(string $created_at) Return ChildOrderHistory objects filtered by the created_at column
 * @method     ChildOrderHistory[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildOrderHistory objects filtered by the updated_at column
 * @psalm-method ObjectCollection&\Traversable<ChildOrderHistory> findByUpdatedAt(string $updated_at) Return ChildOrderHistory objects filtered by the updated_at column
 * @method     ChildOrderHistory[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOrderHistory> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OrderHistoryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\OrderHistoryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'golden_clean', $modelName = '\\OrderHistory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOrderHistoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOrderHistoryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOrderHistoryQuery) {
            return $criteria;
        }
        $query = new ChildOrderHistoryQuery();
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
     * @return ChildOrderHistory|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OrderHistoryTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OrderHistoryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOrderHistory A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_order, id_order_status, amount_paid, total_paid, id_payment_method, id_payment_status, uid, payment_file, voucher, deleted_payment, id_user, created_at, updated_at FROM order_history WHERE id = :p0';
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
            /** @var ChildOrderHistory $obj */
            $obj = new ChildOrderHistory();
            $obj->hydrate($row);
            OrderHistoryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOrderHistory|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(OrderHistoryTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(OrderHistoryTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(OrderHistoryTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(OrderHistoryTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderHistoryTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function filterByIdOrder($idOrder = null, $comparison = null)
    {
        if (is_array($idOrder)) {
            $useMinMax = false;
            if (isset($idOrder['min'])) {
                $this->addUsingAlias(OrderHistoryTableMap::COL_ID_ORDER, $idOrder['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idOrder['max'])) {
                $this->addUsingAlias(OrderHistoryTableMap::COL_ID_ORDER, $idOrder['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderHistoryTableMap::COL_ID_ORDER, $idOrder, $comparison);
    }

    /**
     * Filter the query on the id_order_status column
     *
     * Example usage:
     * <code>
     * $query->filterByIdOrderStatus(1234); // WHERE id_order_status = 1234
     * $query->filterByIdOrderStatus(array(12, 34)); // WHERE id_order_status IN (12, 34)
     * $query->filterByIdOrderStatus(array('min' => 12)); // WHERE id_order_status > 12
     * </code>
     *
     * @see       filterByOrderStatus()
     *
     * @param     mixed $idOrderStatus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function filterByIdOrderStatus($idOrderStatus = null, $comparison = null)
    {
        if (is_array($idOrderStatus)) {
            $useMinMax = false;
            if (isset($idOrderStatus['min'])) {
                $this->addUsingAlias(OrderHistoryTableMap::COL_ID_ORDER_STATUS, $idOrderStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idOrderStatus['max'])) {
                $this->addUsingAlias(OrderHistoryTableMap::COL_ID_ORDER_STATUS, $idOrderStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderHistoryTableMap::COL_ID_ORDER_STATUS, $idOrderStatus, $comparison);
    }

    /**
     * Filter the query on the amount_paid column
     *
     * Example usage:
     * <code>
     * $query->filterByAmountPaid(1234); // WHERE amount_paid = 1234
     * $query->filterByAmountPaid(array(12, 34)); // WHERE amount_paid IN (12, 34)
     * $query->filterByAmountPaid(array('min' => 12)); // WHERE amount_paid > 12
     * </code>
     *
     * @param     mixed $amountPaid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function filterByAmountPaid($amountPaid = null, $comparison = null)
    {
        if (is_array($amountPaid)) {
            $useMinMax = false;
            if (isset($amountPaid['min'])) {
                $this->addUsingAlias(OrderHistoryTableMap::COL_AMOUNT_PAID, $amountPaid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amountPaid['max'])) {
                $this->addUsingAlias(OrderHistoryTableMap::COL_AMOUNT_PAID, $amountPaid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderHistoryTableMap::COL_AMOUNT_PAID, $amountPaid, $comparison);
    }

    /**
     * Filter the query on the total_paid column
     *
     * Example usage:
     * <code>
     * $query->filterByTotalPaid(1234); // WHERE total_paid = 1234
     * $query->filterByTotalPaid(array(12, 34)); // WHERE total_paid IN (12, 34)
     * $query->filterByTotalPaid(array('min' => 12)); // WHERE total_paid > 12
     * </code>
     *
     * @param     mixed $totalPaid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function filterByTotalPaid($totalPaid = null, $comparison = null)
    {
        if (is_array($totalPaid)) {
            $useMinMax = false;
            if (isset($totalPaid['min'])) {
                $this->addUsingAlias(OrderHistoryTableMap::COL_TOTAL_PAID, $totalPaid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($totalPaid['max'])) {
                $this->addUsingAlias(OrderHistoryTableMap::COL_TOTAL_PAID, $totalPaid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderHistoryTableMap::COL_TOTAL_PAID, $totalPaid, $comparison);
    }

    /**
     * Filter the query on the id_payment_method column
     *
     * Example usage:
     * <code>
     * $query->filterByIdPaymentMethod(1234); // WHERE id_payment_method = 1234
     * $query->filterByIdPaymentMethod(array(12, 34)); // WHERE id_payment_method IN (12, 34)
     * $query->filterByIdPaymentMethod(array('min' => 12)); // WHERE id_payment_method > 12
     * </code>
     *
     * @see       filterByPaymentMethods()
     *
     * @param     mixed $idPaymentMethod The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function filterByIdPaymentMethod($idPaymentMethod = null, $comparison = null)
    {
        if (is_array($idPaymentMethod)) {
            $useMinMax = false;
            if (isset($idPaymentMethod['min'])) {
                $this->addUsingAlias(OrderHistoryTableMap::COL_ID_PAYMENT_METHOD, $idPaymentMethod['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idPaymentMethod['max'])) {
                $this->addUsingAlias(OrderHistoryTableMap::COL_ID_PAYMENT_METHOD, $idPaymentMethod['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderHistoryTableMap::COL_ID_PAYMENT_METHOD, $idPaymentMethod, $comparison);
    }

    /**
     * Filter the query on the id_payment_status column
     *
     * Example usage:
     * <code>
     * $query->filterByIdPaymentStatus(1234); // WHERE id_payment_status = 1234
     * $query->filterByIdPaymentStatus(array(12, 34)); // WHERE id_payment_status IN (12, 34)
     * $query->filterByIdPaymentStatus(array('min' => 12)); // WHERE id_payment_status > 12
     * </code>
     *
     * @see       filterByPaymentStatus()
     *
     * @param     mixed $idPaymentStatus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function filterByIdPaymentStatus($idPaymentStatus = null, $comparison = null)
    {
        if (is_array($idPaymentStatus)) {
            $useMinMax = false;
            if (isset($idPaymentStatus['min'])) {
                $this->addUsingAlias(OrderHistoryTableMap::COL_ID_PAYMENT_STATUS, $idPaymentStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idPaymentStatus['max'])) {
                $this->addUsingAlias(OrderHistoryTableMap::COL_ID_PAYMENT_STATUS, $idPaymentStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderHistoryTableMap::COL_ID_PAYMENT_STATUS, $idPaymentStatus, $comparison);
    }

    /**
     * Filter the query on the uid column
     *
     * Example usage:
     * <code>
     * $query->filterByUid('fooValue');   // WHERE uid = 'fooValue'
     * $query->filterByUid('%fooValue%', Criteria::LIKE); // WHERE uid LIKE '%fooValue%'
     * </code>
     *
     * @param     string $uid The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function filterByUid($uid = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uid)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderHistoryTableMap::COL_UID, $uid, $comparison);
    }

    /**
     * Filter the query on the payment_file column
     *
     * Example usage:
     * <code>
     * $query->filterByPaymentFile('fooValue');   // WHERE payment_file = 'fooValue'
     * $query->filterByPaymentFile('%fooValue%', Criteria::LIKE); // WHERE payment_file LIKE '%fooValue%'
     * </code>
     *
     * @param     string $paymentFile The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function filterByPaymentFile($paymentFile = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($paymentFile)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderHistoryTableMap::COL_PAYMENT_FILE, $paymentFile, $comparison);
    }

    /**
     * Filter the query on the voucher column
     *
     * Example usage:
     * <code>
     * $query->filterByVoucher('fooValue');   // WHERE voucher = 'fooValue'
     * $query->filterByVoucher('%fooValue%', Criteria::LIKE); // WHERE voucher LIKE '%fooValue%'
     * </code>
     *
     * @param     string $voucher The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function filterByVoucher($voucher = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($voucher)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderHistoryTableMap::COL_VOUCHER, $voucher, $comparison);
    }

    /**
     * Filter the query on the deleted_payment column
     *
     * Example usage:
     * <code>
     * $query->filterByDeletedPayment(1234); // WHERE deleted_payment = 1234
     * $query->filterByDeletedPayment(array(12, 34)); // WHERE deleted_payment IN (12, 34)
     * $query->filterByDeletedPayment(array('min' => 12)); // WHERE deleted_payment > 12
     * </code>
     *
     * @param     mixed $deletedPayment The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function filterByDeletedPayment($deletedPayment = null, $comparison = null)
    {
        if (is_array($deletedPayment)) {
            $useMinMax = false;
            if (isset($deletedPayment['min'])) {
                $this->addUsingAlias(OrderHistoryTableMap::COL_DELETED_PAYMENT, $deletedPayment['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deletedPayment['max'])) {
                $this->addUsingAlias(OrderHistoryTableMap::COL_DELETED_PAYMENT, $deletedPayment['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderHistoryTableMap::COL_DELETED_PAYMENT, $deletedPayment, $comparison);
    }

    /**
     * Filter the query on the id_user column
     *
     * Example usage:
     * <code>
     * $query->filterByIdUser(1234); // WHERE id_user = 1234
     * $query->filterByIdUser(array(12, 34)); // WHERE id_user IN (12, 34)
     * $query->filterByIdUser(array('min' => 12)); // WHERE id_user > 12
     * </code>
     *
     * @see       filterByUsers()
     *
     * @param     mixed $idUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(OrderHistoryTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(OrderHistoryTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderHistoryTableMap::COL_ID_USER, $idUser, $comparison);
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
     * @return $this|ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(OrderHistoryTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OrderHistoryTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderHistoryTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(OrderHistoryTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(OrderHistoryTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrderHistoryTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Orders object
     *
     * @param \Orders|ObjectCollection $orders The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function filterByOrders($orders, $comparison = null)
    {
        if ($orders instanceof \Orders) {
            return $this
                ->addUsingAlias(OrderHistoryTableMap::COL_ID_ORDER, $orders->getId(), $comparison);
        } elseif ($orders instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderHistoryTableMap::COL_ID_ORDER, $orders->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildOrderHistoryQuery The current query, for fluid interface
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
     * Filter the query by a related \OrderStatus object
     *
     * @param \OrderStatus|ObjectCollection $orderStatus The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function filterByOrderStatus($orderStatus, $comparison = null)
    {
        if ($orderStatus instanceof \OrderStatus) {
            return $this
                ->addUsingAlias(OrderHistoryTableMap::COL_ID_ORDER_STATUS, $orderStatus->getId(), $comparison);
        } elseif ($orderStatus instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderHistoryTableMap::COL_ID_ORDER_STATUS, $orderStatus->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByOrderStatus() only accepts arguments of type \OrderStatus or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrderStatus relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function joinOrderStatus($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrderStatus');

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
            $this->addJoinObject($join, 'OrderStatus');
        }

        return $this;
    }

    /**
     * Use the OrderStatus relation OrderStatus object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrderStatusQuery A secondary query class using the current class as primary query
     */
    public function useOrderStatusQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderStatus($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrderStatus', '\OrderStatusQuery');
    }

    /**
     * Use the OrderStatus relation OrderStatus object
     *
     * @param callable(\OrderStatusQuery):\OrderStatusQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrderStatusQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrderStatusQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to OrderStatus table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \OrderStatusQuery The inner query object of the EXISTS statement
     */
    public function useOrderStatusExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('OrderStatus', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to OrderStatus table for a NOT EXISTS query.
     *
     * @see useOrderStatusExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \OrderStatusQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrderStatusNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('OrderStatus', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \PaymentMethods object
     *
     * @param \PaymentMethods|ObjectCollection $paymentMethods The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function filterByPaymentMethods($paymentMethods, $comparison = null)
    {
        if ($paymentMethods instanceof \PaymentMethods) {
            return $this
                ->addUsingAlias(OrderHistoryTableMap::COL_ID_PAYMENT_METHOD, $paymentMethods->getId(), $comparison);
        } elseif ($paymentMethods instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderHistoryTableMap::COL_ID_PAYMENT_METHOD, $paymentMethods->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPaymentMethods() only accepts arguments of type \PaymentMethods or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PaymentMethods relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function joinPaymentMethods($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PaymentMethods');

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
            $this->addJoinObject($join, 'PaymentMethods');
        }

        return $this;
    }

    /**
     * Use the PaymentMethods relation PaymentMethods object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PaymentMethodsQuery A secondary query class using the current class as primary query
     */
    public function usePaymentMethodsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPaymentMethods($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PaymentMethods', '\PaymentMethodsQuery');
    }

    /**
     * Use the PaymentMethods relation PaymentMethods object
     *
     * @param callable(\PaymentMethodsQuery):\PaymentMethodsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPaymentMethodsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePaymentMethodsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to PaymentMethods table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \PaymentMethodsQuery The inner query object of the EXISTS statement
     */
    public function usePaymentMethodsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('PaymentMethods', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to PaymentMethods table for a NOT EXISTS query.
     *
     * @see usePaymentMethodsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \PaymentMethodsQuery The inner query object of the NOT EXISTS statement
     */
    public function usePaymentMethodsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('PaymentMethods', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \PaymentStatus object
     *
     * @param \PaymentStatus|ObjectCollection $paymentStatus The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function filterByPaymentStatus($paymentStatus, $comparison = null)
    {
        if ($paymentStatus instanceof \PaymentStatus) {
            return $this
                ->addUsingAlias(OrderHistoryTableMap::COL_ID_PAYMENT_STATUS, $paymentStatus->getId(), $comparison);
        } elseif ($paymentStatus instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderHistoryTableMap::COL_ID_PAYMENT_STATUS, $paymentStatus->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPaymentStatus() only accepts arguments of type \PaymentStatus or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PaymentStatus relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function joinPaymentStatus($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PaymentStatus');

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
            $this->addJoinObject($join, 'PaymentStatus');
        }

        return $this;
    }

    /**
     * Use the PaymentStatus relation PaymentStatus object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PaymentStatusQuery A secondary query class using the current class as primary query
     */
    public function usePaymentStatusQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPaymentStatus($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PaymentStatus', '\PaymentStatusQuery');
    }

    /**
     * Use the PaymentStatus relation PaymentStatus object
     *
     * @param callable(\PaymentStatusQuery):\PaymentStatusQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPaymentStatusQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePaymentStatusQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to PaymentStatus table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \PaymentStatusQuery The inner query object of the EXISTS statement
     */
    public function usePaymentStatusExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('PaymentStatus', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to PaymentStatus table for a NOT EXISTS query.
     *
     * @see usePaymentStatusExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \PaymentStatusQuery The inner query object of the NOT EXISTS statement
     */
    public function usePaymentStatusNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('PaymentStatus', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Users object
     *
     * @param \Users|ObjectCollection $users The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function filterByUsers($users, $comparison = null)
    {
        if ($users instanceof \Users) {
            return $this
                ->addUsingAlias(OrderHistoryTableMap::COL_ID_USER, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrderHistoryTableMap::COL_ID_USER, $users->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildOrderHistoryQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildOrderHistory $orderHistory Object to remove from the list of results
     *
     * @return $this|ChildOrderHistoryQuery The current query, for fluid interface
     */
    public function prune($orderHistory = null)
    {
        if ($orderHistory) {
            $this->addUsingAlias(OrderHistoryTableMap::COL_ID, $orderHistory->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the order_history table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderHistoryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OrderHistoryTableMap::clearInstancePool();
            OrderHistoryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OrderHistoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OrderHistoryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OrderHistoryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OrderHistoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // OrderHistoryQuery
