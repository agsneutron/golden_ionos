<?php

namespace Base;

use \Users as ChildUsers;
use \UsersQuery as ChildUsersQuery;
use \Exception;
use \PDO;
use Map\UsersTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'users' table.
 *
 *
 *
 * @method     ChildUsersQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildUsersQuery orderByIdUserType($order = Criteria::ASC) Order by the id_user_type column
 * @method     ChildUsersQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildUsersQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildUsersQuery orderByPassword($order = Criteria::ASC) Order by the password column
 * @method     ChildUsersQuery orderByAddress($order = Criteria::ASC) Order by the address column
 * @method     ChildUsersQuery orderBySuburb($order = Criteria::ASC) Order by the suburb column
 * @method     ChildUsersQuery orderByPhone($order = Criteria::ASC) Order by the phone column
 * @method     ChildUsersQuery orderByNotes($order = Criteria::ASC) Order by the notes column
 * @method     ChildUsersQuery orderByPostalCode($order = Criteria::ASC) Order by the postal_code column
 * @method     ChildUsersQuery orderByIdBranchOffice($order = Criteria::ASC) Order by the id_branch_office column
 * @method     ChildUsersQuery orderByRememberToken($order = Criteria::ASC) Order by the remember_token column
 * @method     ChildUsersQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildUsersQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildUsersQuery groupById() Group by the id column
 * @method     ChildUsersQuery groupByIdUserType() Group by the id_user_type column
 * @method     ChildUsersQuery groupByName() Group by the name column
 * @method     ChildUsersQuery groupByEmail() Group by the email column
 * @method     ChildUsersQuery groupByPassword() Group by the password column
 * @method     ChildUsersQuery groupByAddress() Group by the address column
 * @method     ChildUsersQuery groupBySuburb() Group by the suburb column
 * @method     ChildUsersQuery groupByPhone() Group by the phone column
 * @method     ChildUsersQuery groupByNotes() Group by the notes column
 * @method     ChildUsersQuery groupByPostalCode() Group by the postal_code column
 * @method     ChildUsersQuery groupByIdBranchOffice() Group by the id_branch_office column
 * @method     ChildUsersQuery groupByRememberToken() Group by the remember_token column
 * @method     ChildUsersQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildUsersQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildUsersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUsersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUsersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUsersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUsersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUsersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUsersQuery leftJoinBranchOffices($relationAlias = null) Adds a LEFT JOIN clause to the query using the BranchOffices relation
 * @method     ChildUsersQuery rightJoinBranchOffices($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BranchOffices relation
 * @method     ChildUsersQuery innerJoinBranchOffices($relationAlias = null) Adds a INNER JOIN clause to the query using the BranchOffices relation
 *
 * @method     ChildUsersQuery joinWithBranchOffices($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BranchOffices relation
 *
 * @method     ChildUsersQuery leftJoinWithBranchOffices() Adds a LEFT JOIN clause and with to the query using the BranchOffices relation
 * @method     ChildUsersQuery rightJoinWithBranchOffices() Adds a RIGHT JOIN clause and with to the query using the BranchOffices relation
 * @method     ChildUsersQuery innerJoinWithBranchOffices() Adds a INNER JOIN clause and with to the query using the BranchOffices relation
 *
 * @method     ChildUsersQuery leftJoinUserTypes($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserTypes relation
 * @method     ChildUsersQuery rightJoinUserTypes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserTypes relation
 * @method     ChildUsersQuery innerJoinUserTypes($relationAlias = null) Adds a INNER JOIN clause to the query using the UserTypes relation
 *
 * @method     ChildUsersQuery joinWithUserTypes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserTypes relation
 *
 * @method     ChildUsersQuery leftJoinWithUserTypes() Adds a LEFT JOIN clause and with to the query using the UserTypes relation
 * @method     ChildUsersQuery rightJoinWithUserTypes() Adds a RIGHT JOIN clause and with to the query using the UserTypes relation
 * @method     ChildUsersQuery innerJoinWithUserTypes() Adds a INNER JOIN clause and with to the query using the UserTypes relation
 *
 * @method     ChildUsersQuery leftJoinDeliveries($relationAlias = null) Adds a LEFT JOIN clause to the query using the Deliveries relation
 * @method     ChildUsersQuery rightJoinDeliveries($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Deliveries relation
 * @method     ChildUsersQuery innerJoinDeliveries($relationAlias = null) Adds a INNER JOIN clause to the query using the Deliveries relation
 *
 * @method     ChildUsersQuery joinWithDeliveries($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Deliveries relation
 *
 * @method     ChildUsersQuery leftJoinWithDeliveries() Adds a LEFT JOIN clause and with to the query using the Deliveries relation
 * @method     ChildUsersQuery rightJoinWithDeliveries() Adds a RIGHT JOIN clause and with to the query using the Deliveries relation
 * @method     ChildUsersQuery innerJoinWithDeliveries() Adds a INNER JOIN clause and with to the query using the Deliveries relation
 *
 * @method     ChildUsersQuery leftJoinElectronicPurse($relationAlias = null) Adds a LEFT JOIN clause to the query using the ElectronicPurse relation
 * @method     ChildUsersQuery rightJoinElectronicPurse($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ElectronicPurse relation
 * @method     ChildUsersQuery innerJoinElectronicPurse($relationAlias = null) Adds a INNER JOIN clause to the query using the ElectronicPurse relation
 *
 * @method     ChildUsersQuery joinWithElectronicPurse($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ElectronicPurse relation
 *
 * @method     ChildUsersQuery leftJoinWithElectronicPurse() Adds a LEFT JOIN clause and with to the query using the ElectronicPurse relation
 * @method     ChildUsersQuery rightJoinWithElectronicPurse() Adds a RIGHT JOIN clause and with to the query using the ElectronicPurse relation
 * @method     ChildUsersQuery innerJoinWithElectronicPurse() Adds a INNER JOIN clause and with to the query using the ElectronicPurse relation
 *
 * @method     ChildUsersQuery leftJoinExpenseReports($relationAlias = null) Adds a LEFT JOIN clause to the query using the ExpenseReports relation
 * @method     ChildUsersQuery rightJoinExpenseReports($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ExpenseReports relation
 * @method     ChildUsersQuery innerJoinExpenseReports($relationAlias = null) Adds a INNER JOIN clause to the query using the ExpenseReports relation
 *
 * @method     ChildUsersQuery joinWithExpenseReports($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ExpenseReports relation
 *
 * @method     ChildUsersQuery leftJoinWithExpenseReports() Adds a LEFT JOIN clause and with to the query using the ExpenseReports relation
 * @method     ChildUsersQuery rightJoinWithExpenseReports() Adds a RIGHT JOIN clause and with to the query using the ExpenseReports relation
 * @method     ChildUsersQuery innerJoinWithExpenseReports() Adds a INNER JOIN clause and with to the query using the ExpenseReports relation
 *
 * @method     ChildUsersQuery leftJoinOrderDetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderDetail relation
 * @method     ChildUsersQuery rightJoinOrderDetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderDetail relation
 * @method     ChildUsersQuery innerJoinOrderDetail($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderDetail relation
 *
 * @method     ChildUsersQuery joinWithOrderDetail($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderDetail relation
 *
 * @method     ChildUsersQuery leftJoinWithOrderDetail() Adds a LEFT JOIN clause and with to the query using the OrderDetail relation
 * @method     ChildUsersQuery rightJoinWithOrderDetail() Adds a RIGHT JOIN clause and with to the query using the OrderDetail relation
 * @method     ChildUsersQuery innerJoinWithOrderDetail() Adds a INNER JOIN clause and with to the query using the OrderDetail relation
 *
 * @method     ChildUsersQuery leftJoinOrderDetailHistory($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderDetailHistory relation
 * @method     ChildUsersQuery rightJoinOrderDetailHistory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderDetailHistory relation
 * @method     ChildUsersQuery innerJoinOrderDetailHistory($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderDetailHistory relation
 *
 * @method     ChildUsersQuery joinWithOrderDetailHistory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderDetailHistory relation
 *
 * @method     ChildUsersQuery leftJoinWithOrderDetailHistory() Adds a LEFT JOIN clause and with to the query using the OrderDetailHistory relation
 * @method     ChildUsersQuery rightJoinWithOrderDetailHistory() Adds a RIGHT JOIN clause and with to the query using the OrderDetailHistory relation
 * @method     ChildUsersQuery innerJoinWithOrderDetailHistory() Adds a INNER JOIN clause and with to the query using the OrderDetailHistory relation
 *
 * @method     ChildUsersQuery leftJoinOrderHistory($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderHistory relation
 * @method     ChildUsersQuery rightJoinOrderHistory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderHistory relation
 * @method     ChildUsersQuery innerJoinOrderHistory($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderHistory relation
 *
 * @method     ChildUsersQuery joinWithOrderHistory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderHistory relation
 *
 * @method     ChildUsersQuery leftJoinWithOrderHistory() Adds a LEFT JOIN clause and with to the query using the OrderHistory relation
 * @method     ChildUsersQuery rightJoinWithOrderHistory() Adds a RIGHT JOIN clause and with to the query using the OrderHistory relation
 * @method     ChildUsersQuery innerJoinWithOrderHistory() Adds a INNER JOIN clause and with to the query using the OrderHistory relation
 *
 * @method     ChildUsersQuery leftJoinOrdersRelatedByIdClientUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrdersRelatedByIdClientUser relation
 * @method     ChildUsersQuery rightJoinOrdersRelatedByIdClientUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrdersRelatedByIdClientUser relation
 * @method     ChildUsersQuery innerJoinOrdersRelatedByIdClientUser($relationAlias = null) Adds a INNER JOIN clause to the query using the OrdersRelatedByIdClientUser relation
 *
 * @method     ChildUsersQuery joinWithOrdersRelatedByIdClientUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrdersRelatedByIdClientUser relation
 *
 * @method     ChildUsersQuery leftJoinWithOrdersRelatedByIdClientUser() Adds a LEFT JOIN clause and with to the query using the OrdersRelatedByIdClientUser relation
 * @method     ChildUsersQuery rightJoinWithOrdersRelatedByIdClientUser() Adds a RIGHT JOIN clause and with to the query using the OrdersRelatedByIdClientUser relation
 * @method     ChildUsersQuery innerJoinWithOrdersRelatedByIdClientUser() Adds a INNER JOIN clause and with to the query using the OrdersRelatedByIdClientUser relation
 *
 * @method     ChildUsersQuery leftJoinOrdersRelatedByIdDeliveryUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrdersRelatedByIdDeliveryUser relation
 * @method     ChildUsersQuery rightJoinOrdersRelatedByIdDeliveryUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrdersRelatedByIdDeliveryUser relation
 * @method     ChildUsersQuery innerJoinOrdersRelatedByIdDeliveryUser($relationAlias = null) Adds a INNER JOIN clause to the query using the OrdersRelatedByIdDeliveryUser relation
 *
 * @method     ChildUsersQuery joinWithOrdersRelatedByIdDeliveryUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrdersRelatedByIdDeliveryUser relation
 *
 * @method     ChildUsersQuery leftJoinWithOrdersRelatedByIdDeliveryUser() Adds a LEFT JOIN clause and with to the query using the OrdersRelatedByIdDeliveryUser relation
 * @method     ChildUsersQuery rightJoinWithOrdersRelatedByIdDeliveryUser() Adds a RIGHT JOIN clause and with to the query using the OrdersRelatedByIdDeliveryUser relation
 * @method     ChildUsersQuery innerJoinWithOrdersRelatedByIdDeliveryUser() Adds a INNER JOIN clause and with to the query using the OrdersRelatedByIdDeliveryUser relation
 *
 * @method     ChildUsersQuery leftJoinOrdersRelatedByIdUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrdersRelatedByIdUser relation
 * @method     ChildUsersQuery rightJoinOrdersRelatedByIdUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrdersRelatedByIdUser relation
 * @method     ChildUsersQuery innerJoinOrdersRelatedByIdUser($relationAlias = null) Adds a INNER JOIN clause to the query using the OrdersRelatedByIdUser relation
 *
 * @method     ChildUsersQuery joinWithOrdersRelatedByIdUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrdersRelatedByIdUser relation
 *
 * @method     ChildUsersQuery leftJoinWithOrdersRelatedByIdUser() Adds a LEFT JOIN clause and with to the query using the OrdersRelatedByIdUser relation
 * @method     ChildUsersQuery rightJoinWithOrdersRelatedByIdUser() Adds a RIGHT JOIN clause and with to the query using the OrdersRelatedByIdUser relation
 * @method     ChildUsersQuery innerJoinWithOrdersRelatedByIdUser() Adds a INNER JOIN clause and with to the query using the OrdersRelatedByIdUser relation
 *
 * @method     ChildUsersQuery leftJoinPickups($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pickups relation
 * @method     ChildUsersQuery rightJoinPickups($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pickups relation
 * @method     ChildUsersQuery innerJoinPickups($relationAlias = null) Adds a INNER JOIN clause to the query using the Pickups relation
 *
 * @method     ChildUsersQuery joinWithPickups($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Pickups relation
 *
 * @method     ChildUsersQuery leftJoinWithPickups() Adds a LEFT JOIN clause and with to the query using the Pickups relation
 * @method     ChildUsersQuery rightJoinWithPickups() Adds a RIGHT JOIN clause and with to the query using the Pickups relation
 * @method     ChildUsersQuery innerJoinWithPickups() Adds a INNER JOIN clause and with to the query using the Pickups relation
 *
 * @method     \BranchOfficesQuery|\UserTypesQuery|\DeliveriesQuery|\ElectronicPurseQuery|\ExpenseReportsQuery|\OrderDetailQuery|\OrderDetailHistoryQuery|\OrderHistoryQuery|\OrdersQuery|\PickupsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUsers|null findOne(ConnectionInterface $con = null) Return the first ChildUsers matching the query
 * @method     ChildUsers findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUsers matching the query, or a new ChildUsers object populated from the query conditions when no match is found
 *
 * @method     ChildUsers|null findOneById(int $id) Return the first ChildUsers filtered by the id column
 * @method     ChildUsers|null findOneByIdUserType(int $id_user_type) Return the first ChildUsers filtered by the id_user_type column
 * @method     ChildUsers|null findOneByName(string $name) Return the first ChildUsers filtered by the name column
 * @method     ChildUsers|null findOneByEmail(string $email) Return the first ChildUsers filtered by the email column
 * @method     ChildUsers|null findOneByPassword(string $password) Return the first ChildUsers filtered by the password column
 * @method     ChildUsers|null findOneByAddress(string $address) Return the first ChildUsers filtered by the address column
 * @method     ChildUsers|null findOneBySuburb(string $suburb) Return the first ChildUsers filtered by the suburb column
 * @method     ChildUsers|null findOneByPhone(string $phone) Return the first ChildUsers filtered by the phone column
 * @method     ChildUsers|null findOneByNotes(string $notes) Return the first ChildUsers filtered by the notes column
 * @method     ChildUsers|null findOneByPostalCode(int $postal_code) Return the first ChildUsers filtered by the postal_code column
 * @method     ChildUsers|null findOneByIdBranchOffice(int $id_branch_office) Return the first ChildUsers filtered by the id_branch_office column
 * @method     ChildUsers|null findOneByRememberToken(string $remember_token) Return the first ChildUsers filtered by the remember_token column
 * @method     ChildUsers|null findOneByCreatedAt(string $created_at) Return the first ChildUsers filtered by the created_at column
 * @method     ChildUsers|null findOneByUpdatedAt(string $updated_at) Return the first ChildUsers filtered by the updated_at column *

 * @method     ChildUsers requirePk($key, ConnectionInterface $con = null) Return the ChildUsers by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOne(ConnectionInterface $con = null) Return the first ChildUsers matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsers requireOneById(int $id) Return the first ChildUsers filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByIdUserType(int $id_user_type) Return the first ChildUsers filtered by the id_user_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByName(string $name) Return the first ChildUsers filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByEmail(string $email) Return the first ChildUsers filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPassword(string $password) Return the first ChildUsers filtered by the password column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByAddress(string $address) Return the first ChildUsers filtered by the address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneBySuburb(string $suburb) Return the first ChildUsers filtered by the suburb column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPhone(string $phone) Return the first ChildUsers filtered by the phone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByNotes(string $notes) Return the first ChildUsers filtered by the notes column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByPostalCode(int $postal_code) Return the first ChildUsers filtered by the postal_code column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByIdBranchOffice(int $id_branch_office) Return the first ChildUsers filtered by the id_branch_office column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByRememberToken(string $remember_token) Return the first ChildUsers filtered by the remember_token column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByCreatedAt(string $created_at) Return the first ChildUsers filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUsers requireOneByUpdatedAt(string $updated_at) Return the first ChildUsers filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUsers[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUsers objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildUsers> find(ConnectionInterface $con = null) Return ChildUsers objects based on current ModelCriteria
 * @method     ChildUsers[]|ObjectCollection findById(int $id) Return ChildUsers objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildUsers> findById(int $id) Return ChildUsers objects filtered by the id column
 * @method     ChildUsers[]|ObjectCollection findByIdUserType(int $id_user_type) Return ChildUsers objects filtered by the id_user_type column
 * @psalm-method ObjectCollection&\Traversable<ChildUsers> findByIdUserType(int $id_user_type) Return ChildUsers objects filtered by the id_user_type column
 * @method     ChildUsers[]|ObjectCollection findByName(string $name) Return ChildUsers objects filtered by the name column
 * @psalm-method ObjectCollection&\Traversable<ChildUsers> findByName(string $name) Return ChildUsers objects filtered by the name column
 * @method     ChildUsers[]|ObjectCollection findByEmail(string $email) Return ChildUsers objects filtered by the email column
 * @psalm-method ObjectCollection&\Traversable<ChildUsers> findByEmail(string $email) Return ChildUsers objects filtered by the email column
 * @method     ChildUsers[]|ObjectCollection findByPassword(string $password) Return ChildUsers objects filtered by the password column
 * @psalm-method ObjectCollection&\Traversable<ChildUsers> findByPassword(string $password) Return ChildUsers objects filtered by the password column
 * @method     ChildUsers[]|ObjectCollection findByAddress(string $address) Return ChildUsers objects filtered by the address column
 * @psalm-method ObjectCollection&\Traversable<ChildUsers> findByAddress(string $address) Return ChildUsers objects filtered by the address column
 * @method     ChildUsers[]|ObjectCollection findBySuburb(string $suburb) Return ChildUsers objects filtered by the suburb column
 * @psalm-method ObjectCollection&\Traversable<ChildUsers> findBySuburb(string $suburb) Return ChildUsers objects filtered by the suburb column
 * @method     ChildUsers[]|ObjectCollection findByPhone(string $phone) Return ChildUsers objects filtered by the phone column
 * @psalm-method ObjectCollection&\Traversable<ChildUsers> findByPhone(string $phone) Return ChildUsers objects filtered by the phone column
 * @method     ChildUsers[]|ObjectCollection findByNotes(string $notes) Return ChildUsers objects filtered by the notes column
 * @psalm-method ObjectCollection&\Traversable<ChildUsers> findByNotes(string $notes) Return ChildUsers objects filtered by the notes column
 * @method     ChildUsers[]|ObjectCollection findByPostalCode(int $postal_code) Return ChildUsers objects filtered by the postal_code column
 * @psalm-method ObjectCollection&\Traversable<ChildUsers> findByPostalCode(int $postal_code) Return ChildUsers objects filtered by the postal_code column
 * @method     ChildUsers[]|ObjectCollection findByIdBranchOffice(int $id_branch_office) Return ChildUsers objects filtered by the id_branch_office column
 * @psalm-method ObjectCollection&\Traversable<ChildUsers> findByIdBranchOffice(int $id_branch_office) Return ChildUsers objects filtered by the id_branch_office column
 * @method     ChildUsers[]|ObjectCollection findByRememberToken(string $remember_token) Return ChildUsers objects filtered by the remember_token column
 * @psalm-method ObjectCollection&\Traversable<ChildUsers> findByRememberToken(string $remember_token) Return ChildUsers objects filtered by the remember_token column
 * @method     ChildUsers[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildUsers objects filtered by the created_at column
 * @psalm-method ObjectCollection&\Traversable<ChildUsers> findByCreatedAt(string $created_at) Return ChildUsers objects filtered by the created_at column
 * @method     ChildUsers[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildUsers objects filtered by the updated_at column
 * @psalm-method ObjectCollection&\Traversable<ChildUsers> findByUpdatedAt(string $updated_at) Return ChildUsers objects filtered by the updated_at column
 * @method     ChildUsers[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildUsers> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UsersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UsersQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'golden_clean', $modelName = '\\Users', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUsersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUsersQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUsersQuery) {
            return $criteria;
        }
        $query = new ChildUsersQuery();
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
     * @return ChildUsers|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UsersTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UsersTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUsers A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_user_type, name, email, password, address, suburb, phone, notes, postal_code, id_branch_office, remember_token, created_at, updated_at FROM users WHERE id = :p0';
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
            /** @var ChildUsers $obj */
            $obj = new ChildUsers();
            $obj->hydrate($row);
            UsersTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUsers|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsersTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsersTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByIdUserType($idUserType = null, $comparison = null)
    {
        if (is_array($idUserType)) {
            $useMinMax = false;
            if (isset($idUserType['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_ID_USER_TYPE, $idUserType['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUserType['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_ID_USER_TYPE, $idUserType['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_ID_USER_TYPE, $idUserType, $comparison);
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_NAME, $name, $comparison);
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the password column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE password = 'fooValue'
     * $query->filterByPassword('%fooValue%', Criteria::LIKE); // WHERE password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_PASSWORD, $password, $comparison);
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByAddress($address = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($address)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_ADDRESS, $address, $comparison);
    }

    /**
     * Filter the query on the suburb column
     *
     * Example usage:
     * <code>
     * $query->filterBySuburb('fooValue');   // WHERE suburb = 'fooValue'
     * $query->filterBySuburb('%fooValue%', Criteria::LIKE); // WHERE suburb LIKE '%fooValue%'
     * </code>
     *
     * @param     string $suburb The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterBySuburb($suburb = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($suburb)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_SUBURB, $suburb, $comparison);
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPhone($phone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($phone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_PHONE, $phone, $comparison);
    }

    /**
     * Filter the query on the notes column
     *
     * Example usage:
     * <code>
     * $query->filterByNotes('fooValue');   // WHERE notes = 'fooValue'
     * $query->filterByNotes('%fooValue%', Criteria::LIKE); // WHERE notes LIKE '%fooValue%'
     * </code>
     *
     * @param     string $notes The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByNotes($notes = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($notes)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_NOTES, $notes, $comparison);
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPostalCode($postalCode = null, $comparison = null)
    {
        if (is_array($postalCode)) {
            $useMinMax = false;
            if (isset($postalCode['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_POSTAL_CODE, $postalCode['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($postalCode['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_POSTAL_CODE, $postalCode['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_POSTAL_CODE, $postalCode, $comparison);
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByIdBranchOffice($idBranchOffice = null, $comparison = null)
    {
        if (is_array($idBranchOffice)) {
            $useMinMax = false;
            if (isset($idBranchOffice['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_ID_BRANCH_OFFICE, $idBranchOffice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idBranchOffice['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_ID_BRANCH_OFFICE, $idBranchOffice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_ID_BRANCH_OFFICE, $idBranchOffice, $comparison);
    }

    /**
     * Filter the query on the remember_token column
     *
     * Example usage:
     * <code>
     * $query->filterByRememberToken('fooValue');   // WHERE remember_token = 'fooValue'
     * $query->filterByRememberToken('%fooValue%', Criteria::LIKE); // WHERE remember_token LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rememberToken The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByRememberToken($rememberToken = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rememberToken)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_REMEMBER_TOKEN, $rememberToken, $comparison);
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(UsersTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(UsersTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsersTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \BranchOffices object
     *
     * @param \BranchOffices|ObjectCollection $branchOffices The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUsersQuery The current query, for fluid interface
     */
    public function filterByBranchOffices($branchOffices, $comparison = null)
    {
        if ($branchOffices instanceof \BranchOffices) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_ID_BRANCH_OFFICE, $branchOffices->getId(), $comparison);
        } elseif ($branchOffices instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UsersTableMap::COL_ID_BRANCH_OFFICE, $branchOffices->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function joinBranchOffices($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useBranchOfficesQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \UserTypes object
     *
     * @param \UserTypes|ObjectCollection $userTypes The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUsersQuery The current query, for fluid interface
     */
    public function filterByUserTypes($userTypes, $comparison = null)
    {
        if ($userTypes instanceof \UserTypes) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_ID_USER_TYPE, $userTypes->getId(), $comparison);
        } elseif ($userTypes instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UsersTableMap::COL_ID_USER_TYPE, $userTypes->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
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
     * Filter the query by a related \Deliveries object
     *
     * @param \Deliveries|ObjectCollection $deliveries the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsersQuery The current query, for fluid interface
     */
    public function filterByDeliveries($deliveries, $comparison = null)
    {
        if ($deliveries instanceof \Deliveries) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_ID, $deliveries->getIdAssignedUser(), $comparison);
        } elseif ($deliveries instanceof ObjectCollection) {
            return $this
                ->useDeliveriesQuery()
                ->filterByPrimaryKeys($deliveries->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDeliveries() only accepts arguments of type \Deliveries or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Deliveries relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function joinDeliveries($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Deliveries');

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
            $this->addJoinObject($join, 'Deliveries');
        }

        return $this;
    }

    /**
     * Use the Deliveries relation Deliveries object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DeliveriesQuery A secondary query class using the current class as primary query
     */
    public function useDeliveriesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDeliveries($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Deliveries', '\DeliveriesQuery');
    }

    /**
     * Use the Deliveries relation Deliveries object
     *
     * @param callable(\DeliveriesQuery):\DeliveriesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDeliveriesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useDeliveriesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Deliveries table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DeliveriesQuery The inner query object of the EXISTS statement
     */
    public function useDeliveriesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Deliveries', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Deliveries table for a NOT EXISTS query.
     *
     * @see useDeliveriesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DeliveriesQuery The inner query object of the NOT EXISTS statement
     */
    public function useDeliveriesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Deliveries', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \ElectronicPurse object
     *
     * @param \ElectronicPurse|ObjectCollection $electronicPurse the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsersQuery The current query, for fluid interface
     */
    public function filterByElectronicPurse($electronicPurse, $comparison = null)
    {
        if ($electronicPurse instanceof \ElectronicPurse) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_ID, $electronicPurse->getIdClientUser(), $comparison);
        } elseif ($electronicPurse instanceof ObjectCollection) {
            return $this
                ->useElectronicPurseQuery()
                ->filterByPrimaryKeys($electronicPurse->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByElectronicPurse() only accepts arguments of type \ElectronicPurse or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ElectronicPurse relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function joinElectronicPurse($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ElectronicPurse');

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
            $this->addJoinObject($join, 'ElectronicPurse');
        }

        return $this;
    }

    /**
     * Use the ElectronicPurse relation ElectronicPurse object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ElectronicPurseQuery A secondary query class using the current class as primary query
     */
    public function useElectronicPurseQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinElectronicPurse($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ElectronicPurse', '\ElectronicPurseQuery');
    }

    /**
     * Use the ElectronicPurse relation ElectronicPurse object
     *
     * @param callable(\ElectronicPurseQuery):\ElectronicPurseQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withElectronicPurseQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useElectronicPurseQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ElectronicPurse table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \ElectronicPurseQuery The inner query object of the EXISTS statement
     */
    public function useElectronicPurseExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ElectronicPurse', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ElectronicPurse table for a NOT EXISTS query.
     *
     * @see useElectronicPurseExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \ElectronicPurseQuery The inner query object of the NOT EXISTS statement
     */
    public function useElectronicPurseNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ElectronicPurse', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \ExpenseReports object
     *
     * @param \ExpenseReports|ObjectCollection $expenseReports the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsersQuery The current query, for fluid interface
     */
    public function filterByExpenseReports($expenseReports, $comparison = null)
    {
        if ($expenseReports instanceof \ExpenseReports) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_ID, $expenseReports->getIdUser(), $comparison);
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
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
     * Filter the query by a related \OrderDetail object
     *
     * @param \OrderDetail|ObjectCollection $orderDetail the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsersQuery The current query, for fluid interface
     */
    public function filterByOrderDetail($orderDetail, $comparison = null)
    {
        if ($orderDetail instanceof \OrderDetail) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_ID, $orderDetail->getIdDeliveryUser(), $comparison);
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function joinOrderDetail($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
    public function useOrderDetailQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
        ?string $joinType = Criteria::LEFT_JOIN
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
     * Filter the query by a related \OrderDetailHistory object
     *
     * @param \OrderDetailHistory|ObjectCollection $orderDetailHistory the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsersQuery The current query, for fluid interface
     */
    public function filterByOrderDetailHistory($orderDetailHistory, $comparison = null)
    {
        if ($orderDetailHistory instanceof \OrderDetailHistory) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_ID, $orderDetailHistory->getIdUser(), $comparison);
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
     * @return $this|ChildUsersQuery The current query, for fluid interface
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
     * Filter the query by a related \OrderHistory object
     *
     * @param \OrderHistory|ObjectCollection $orderHistory the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsersQuery The current query, for fluid interface
     */
    public function filterByOrderHistory($orderHistory, $comparison = null)
    {
        if ($orderHistory instanceof \OrderHistory) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_ID, $orderHistory->getIdUser(), $comparison);
        } elseif ($orderHistory instanceof ObjectCollection) {
            return $this
                ->useOrderHistoryQuery()
                ->filterByPrimaryKeys($orderHistory->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByOrderHistory() only accepts arguments of type \OrderHistory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrderHistory relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function joinOrderHistory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrderHistory');

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
            $this->addJoinObject($join, 'OrderHistory');
        }

        return $this;
    }

    /**
     * Use the OrderHistory relation OrderHistory object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrderHistoryQuery A secondary query class using the current class as primary query
     */
    public function useOrderHistoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderHistory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrderHistory', '\OrderHistoryQuery');
    }

    /**
     * Use the OrderHistory relation OrderHistory object
     *
     * @param callable(\OrderHistoryQuery):\OrderHistoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrderHistoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrderHistoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to OrderHistory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \OrderHistoryQuery The inner query object of the EXISTS statement
     */
    public function useOrderHistoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('OrderHistory', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to OrderHistory table for a NOT EXISTS query.
     *
     * @see useOrderHistoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \OrderHistoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrderHistoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('OrderHistory', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Orders object
     *
     * @param \Orders|ObjectCollection $orders the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsersQuery The current query, for fluid interface
     */
    public function filterByOrdersRelatedByIdClientUser($orders, $comparison = null)
    {
        if ($orders instanceof \Orders) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_ID, $orders->getIdClientUser(), $comparison);
        } elseif ($orders instanceof ObjectCollection) {
            return $this
                ->useOrdersRelatedByIdClientUserQuery()
                ->filterByPrimaryKeys($orders->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByOrdersRelatedByIdClientUser() only accepts arguments of type \Orders or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrdersRelatedByIdClientUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function joinOrdersRelatedByIdClientUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrdersRelatedByIdClientUser');

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
            $this->addJoinObject($join, 'OrdersRelatedByIdClientUser');
        }

        return $this;
    }

    /**
     * Use the OrdersRelatedByIdClientUser relation Orders object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrdersQuery A secondary query class using the current class as primary query
     */
    public function useOrdersRelatedByIdClientUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrdersRelatedByIdClientUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrdersRelatedByIdClientUser', '\OrdersQuery');
    }

    /**
     * Use the OrdersRelatedByIdClientUser relation Orders object
     *
     * @param callable(\OrdersQuery):\OrdersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrdersRelatedByIdClientUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrdersRelatedByIdClientUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the OrdersRelatedByIdClientUser relation to the Orders table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \OrdersQuery The inner query object of the EXISTS statement
     */
    public function useOrdersRelatedByIdClientUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('OrdersRelatedByIdClientUser', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the OrdersRelatedByIdClientUser relation to the Orders table for a NOT EXISTS query.
     *
     * @see useOrdersRelatedByIdClientUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \OrdersQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrdersRelatedByIdClientUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('OrdersRelatedByIdClientUser', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Orders object
     *
     * @param \Orders|ObjectCollection $orders the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsersQuery The current query, for fluid interface
     */
    public function filterByOrdersRelatedByIdDeliveryUser($orders, $comparison = null)
    {
        if ($orders instanceof \Orders) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_ID, $orders->getIdDeliveryUser(), $comparison);
        } elseif ($orders instanceof ObjectCollection) {
            return $this
                ->useOrdersRelatedByIdDeliveryUserQuery()
                ->filterByPrimaryKeys($orders->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByOrdersRelatedByIdDeliveryUser() only accepts arguments of type \Orders or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrdersRelatedByIdDeliveryUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function joinOrdersRelatedByIdDeliveryUser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrdersRelatedByIdDeliveryUser');

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
            $this->addJoinObject($join, 'OrdersRelatedByIdDeliveryUser');
        }

        return $this;
    }

    /**
     * Use the OrdersRelatedByIdDeliveryUser relation Orders object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrdersQuery A secondary query class using the current class as primary query
     */
    public function useOrdersRelatedByIdDeliveryUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinOrdersRelatedByIdDeliveryUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrdersRelatedByIdDeliveryUser', '\OrdersQuery');
    }

    /**
     * Use the OrdersRelatedByIdDeliveryUser relation Orders object
     *
     * @param callable(\OrdersQuery):\OrdersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrdersRelatedByIdDeliveryUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useOrdersRelatedByIdDeliveryUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the OrdersRelatedByIdDeliveryUser relation to the Orders table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \OrdersQuery The inner query object of the EXISTS statement
     */
    public function useOrdersRelatedByIdDeliveryUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('OrdersRelatedByIdDeliveryUser', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the OrdersRelatedByIdDeliveryUser relation to the Orders table for a NOT EXISTS query.
     *
     * @see useOrdersRelatedByIdDeliveryUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \OrdersQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrdersRelatedByIdDeliveryUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('OrdersRelatedByIdDeliveryUser', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Orders object
     *
     * @param \Orders|ObjectCollection $orders the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsersQuery The current query, for fluid interface
     */
    public function filterByOrdersRelatedByIdUser($orders, $comparison = null)
    {
        if ($orders instanceof \Orders) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_ID, $orders->getIdUser(), $comparison);
        } elseif ($orders instanceof ObjectCollection) {
            return $this
                ->useOrdersRelatedByIdUserQuery()
                ->filterByPrimaryKeys($orders->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByOrdersRelatedByIdUser() only accepts arguments of type \Orders or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrdersRelatedByIdUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function joinOrdersRelatedByIdUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrdersRelatedByIdUser');

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
            $this->addJoinObject($join, 'OrdersRelatedByIdUser');
        }

        return $this;
    }

    /**
     * Use the OrdersRelatedByIdUser relation Orders object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrdersQuery A secondary query class using the current class as primary query
     */
    public function useOrdersRelatedByIdUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrdersRelatedByIdUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrdersRelatedByIdUser', '\OrdersQuery');
    }

    /**
     * Use the OrdersRelatedByIdUser relation Orders object
     *
     * @param callable(\OrdersQuery):\OrdersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrdersRelatedByIdUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrdersRelatedByIdUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the OrdersRelatedByIdUser relation to the Orders table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \OrdersQuery The inner query object of the EXISTS statement
     */
    public function useOrdersRelatedByIdUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('OrdersRelatedByIdUser', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the OrdersRelatedByIdUser relation to the Orders table for a NOT EXISTS query.
     *
     * @see useOrdersRelatedByIdUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \OrdersQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrdersRelatedByIdUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('OrdersRelatedByIdUser', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Pickups object
     *
     * @param \Pickups|ObjectCollection $pickups the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUsersQuery The current query, for fluid interface
     */
    public function filterByPickups($pickups, $comparison = null)
    {
        if ($pickups instanceof \Pickups) {
            return $this
                ->addUsingAlias(UsersTableMap::COL_ID, $pickups->getIdAssignedUser(), $comparison);
        } elseif ($pickups instanceof ObjectCollection) {
            return $this
                ->usePickupsQuery()
                ->filterByPrimaryKeys($pickups->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPickups() only accepts arguments of type \Pickups or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Pickups relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function joinPickups($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Pickups');

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
            $this->addJoinObject($join, 'Pickups');
        }

        return $this;
    }

    /**
     * Use the Pickups relation Pickups object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PickupsQuery A secondary query class using the current class as primary query
     */
    public function usePickupsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPickups($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Pickups', '\PickupsQuery');
    }

    /**
     * Use the Pickups relation Pickups object
     *
     * @param callable(\PickupsQuery):\PickupsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPickupsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePickupsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Pickups table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \PickupsQuery The inner query object of the EXISTS statement
     */
    public function usePickupsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Pickups', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Pickups table for a NOT EXISTS query.
     *
     * @see usePickupsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \PickupsQuery The inner query object of the NOT EXISTS statement
     */
    public function usePickupsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Pickups', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildUsers $users Object to remove from the list of results
     *
     * @return $this|ChildUsersQuery The current query, for fluid interface
     */
    public function prune($users = null)
    {
        if ($users) {
            $this->addUsingAlias(UsersTableMap::COL_ID, $users->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UsersTableMap::clearInstancePool();
            UsersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UsersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UsersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UsersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UsersQuery
