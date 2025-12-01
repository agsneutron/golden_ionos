<?php

namespace Base;

use \ExpenseReports as ChildExpenseReports;
use \ExpenseReportsQuery as ChildExpenseReportsQuery;
use \Exception;
use \PDO;
use Map\ExpenseReportsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'expense_reports' table.
 *
 *
 *
 * @method     ChildExpenseReportsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildExpenseReportsQuery orderByIdBranchOffice($order = Criteria::ASC) Order by the id_branch_office column
 * @method     ChildExpenseReportsQuery orderByIdExpenseConcept($order = Criteria::ASC) Order by the id_expense_concept column
 * @method     ChildExpenseReportsQuery orderByIdUser($order = Criteria::ASC) Order by the id_user column
 * @method     ChildExpenseReportsQuery orderByDateExpense($order = Criteria::ASC) Order by the date_expense column
 * @method     ChildExpenseReportsQuery orderByAmount($order = Criteria::ASC) Order by the amount column
 * @method     ChildExpenseReportsQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildExpenseReportsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildExpenseReportsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildExpenseReportsQuery groupById() Group by the id column
 * @method     ChildExpenseReportsQuery groupByIdBranchOffice() Group by the id_branch_office column
 * @method     ChildExpenseReportsQuery groupByIdExpenseConcept() Group by the id_expense_concept column
 * @method     ChildExpenseReportsQuery groupByIdUser() Group by the id_user column
 * @method     ChildExpenseReportsQuery groupByDateExpense() Group by the date_expense column
 * @method     ChildExpenseReportsQuery groupByAmount() Group by the amount column
 * @method     ChildExpenseReportsQuery groupByDescription() Group by the description column
 * @method     ChildExpenseReportsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildExpenseReportsQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildExpenseReportsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildExpenseReportsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildExpenseReportsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildExpenseReportsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildExpenseReportsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildExpenseReportsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildExpenseReportsQuery leftJoinBranchOffices($relationAlias = null) Adds a LEFT JOIN clause to the query using the BranchOffices relation
 * @method     ChildExpenseReportsQuery rightJoinBranchOffices($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BranchOffices relation
 * @method     ChildExpenseReportsQuery innerJoinBranchOffices($relationAlias = null) Adds a INNER JOIN clause to the query using the BranchOffices relation
 *
 * @method     ChildExpenseReportsQuery joinWithBranchOffices($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BranchOffices relation
 *
 * @method     ChildExpenseReportsQuery leftJoinWithBranchOffices() Adds a LEFT JOIN clause and with to the query using the BranchOffices relation
 * @method     ChildExpenseReportsQuery rightJoinWithBranchOffices() Adds a RIGHT JOIN clause and with to the query using the BranchOffices relation
 * @method     ChildExpenseReportsQuery innerJoinWithBranchOffices() Adds a INNER JOIN clause and with to the query using the BranchOffices relation
 *
 * @method     ChildExpenseReportsQuery leftJoinExpenseConcepts($relationAlias = null) Adds a LEFT JOIN clause to the query using the ExpenseConcepts relation
 * @method     ChildExpenseReportsQuery rightJoinExpenseConcepts($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ExpenseConcepts relation
 * @method     ChildExpenseReportsQuery innerJoinExpenseConcepts($relationAlias = null) Adds a INNER JOIN clause to the query using the ExpenseConcepts relation
 *
 * @method     ChildExpenseReportsQuery joinWithExpenseConcepts($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ExpenseConcepts relation
 *
 * @method     ChildExpenseReportsQuery leftJoinWithExpenseConcepts() Adds a LEFT JOIN clause and with to the query using the ExpenseConcepts relation
 * @method     ChildExpenseReportsQuery rightJoinWithExpenseConcepts() Adds a RIGHT JOIN clause and with to the query using the ExpenseConcepts relation
 * @method     ChildExpenseReportsQuery innerJoinWithExpenseConcepts() Adds a INNER JOIN clause and with to the query using the ExpenseConcepts relation
 *
 * @method     ChildExpenseReportsQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildExpenseReportsQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildExpenseReportsQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildExpenseReportsQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildExpenseReportsQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildExpenseReportsQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildExpenseReportsQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     \BranchOfficesQuery|\ExpenseConceptsQuery|\UsersQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildExpenseReports|null findOne(ConnectionInterface $con = null) Return the first ChildExpenseReports matching the query
 * @method     ChildExpenseReports findOneOrCreate(ConnectionInterface $con = null) Return the first ChildExpenseReports matching the query, or a new ChildExpenseReports object populated from the query conditions when no match is found
 *
 * @method     ChildExpenseReports|null findOneById(int $id) Return the first ChildExpenseReports filtered by the id column
 * @method     ChildExpenseReports|null findOneByIdBranchOffice(int $id_branch_office) Return the first ChildExpenseReports filtered by the id_branch_office column
 * @method     ChildExpenseReports|null findOneByIdExpenseConcept(int $id_expense_concept) Return the first ChildExpenseReports filtered by the id_expense_concept column
 * @method     ChildExpenseReports|null findOneByIdUser(int $id_user) Return the first ChildExpenseReports filtered by the id_user column
 * @method     ChildExpenseReports|null findOneByDateExpense(string $date_expense) Return the first ChildExpenseReports filtered by the date_expense column
 * @method     ChildExpenseReports|null findOneByAmount(string $amount) Return the first ChildExpenseReports filtered by the amount column
 * @method     ChildExpenseReports|null findOneByDescription(string $description) Return the first ChildExpenseReports filtered by the description column
 * @method     ChildExpenseReports|null findOneByCreatedAt(string $created_at) Return the first ChildExpenseReports filtered by the created_at column
 * @method     ChildExpenseReports|null findOneByUpdatedAt(string $updated_at) Return the first ChildExpenseReports filtered by the updated_at column *

 * @method     ChildExpenseReports requirePk($key, ConnectionInterface $con = null) Return the ChildExpenseReports by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseReports requireOne(ConnectionInterface $con = null) Return the first ChildExpenseReports matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpenseReports requireOneById(int $id) Return the first ChildExpenseReports filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseReports requireOneByIdBranchOffice(int $id_branch_office) Return the first ChildExpenseReports filtered by the id_branch_office column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseReports requireOneByIdExpenseConcept(int $id_expense_concept) Return the first ChildExpenseReports filtered by the id_expense_concept column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseReports requireOneByIdUser(int $id_user) Return the first ChildExpenseReports filtered by the id_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseReports requireOneByDateExpense(string $date_expense) Return the first ChildExpenseReports filtered by the date_expense column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseReports requireOneByAmount(string $amount) Return the first ChildExpenseReports filtered by the amount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseReports requireOneByDescription(string $description) Return the first ChildExpenseReports filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseReports requireOneByCreatedAt(string $created_at) Return the first ChildExpenseReports filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildExpenseReports requireOneByUpdatedAt(string $updated_at) Return the first ChildExpenseReports filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildExpenseReports[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildExpenseReports objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildExpenseReports> find(ConnectionInterface $con = null) Return ChildExpenseReports objects based on current ModelCriteria
 * @method     ChildExpenseReports[]|ObjectCollection findById(int $id) Return ChildExpenseReports objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildExpenseReports> findById(int $id) Return ChildExpenseReports objects filtered by the id column
 * @method     ChildExpenseReports[]|ObjectCollection findByIdBranchOffice(int $id_branch_office) Return ChildExpenseReports objects filtered by the id_branch_office column
 * @psalm-method ObjectCollection&\Traversable<ChildExpenseReports> findByIdBranchOffice(int $id_branch_office) Return ChildExpenseReports objects filtered by the id_branch_office column
 * @method     ChildExpenseReports[]|ObjectCollection findByIdExpenseConcept(int $id_expense_concept) Return ChildExpenseReports objects filtered by the id_expense_concept column
 * @psalm-method ObjectCollection&\Traversable<ChildExpenseReports> findByIdExpenseConcept(int $id_expense_concept) Return ChildExpenseReports objects filtered by the id_expense_concept column
 * @method     ChildExpenseReports[]|ObjectCollection findByIdUser(int $id_user) Return ChildExpenseReports objects filtered by the id_user column
 * @psalm-method ObjectCollection&\Traversable<ChildExpenseReports> findByIdUser(int $id_user) Return ChildExpenseReports objects filtered by the id_user column
 * @method     ChildExpenseReports[]|ObjectCollection findByDateExpense(string $date_expense) Return ChildExpenseReports objects filtered by the date_expense column
 * @psalm-method ObjectCollection&\Traversable<ChildExpenseReports> findByDateExpense(string $date_expense) Return ChildExpenseReports objects filtered by the date_expense column
 * @method     ChildExpenseReports[]|ObjectCollection findByAmount(string $amount) Return ChildExpenseReports objects filtered by the amount column
 * @psalm-method ObjectCollection&\Traversable<ChildExpenseReports> findByAmount(string $amount) Return ChildExpenseReports objects filtered by the amount column
 * @method     ChildExpenseReports[]|ObjectCollection findByDescription(string $description) Return ChildExpenseReports objects filtered by the description column
 * @psalm-method ObjectCollection&\Traversable<ChildExpenseReports> findByDescription(string $description) Return ChildExpenseReports objects filtered by the description column
 * @method     ChildExpenseReports[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildExpenseReports objects filtered by the created_at column
 * @psalm-method ObjectCollection&\Traversable<ChildExpenseReports> findByCreatedAt(string $created_at) Return ChildExpenseReports objects filtered by the created_at column
 * @method     ChildExpenseReports[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildExpenseReports objects filtered by the updated_at column
 * @psalm-method ObjectCollection&\Traversable<ChildExpenseReports> findByUpdatedAt(string $updated_at) Return ChildExpenseReports objects filtered by the updated_at column
 * @method     ChildExpenseReports[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildExpenseReports> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ExpenseReportsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ExpenseReportsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'golden_clean', $modelName = '\\ExpenseReports', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildExpenseReportsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildExpenseReportsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildExpenseReportsQuery) {
            return $criteria;
        }
        $query = new ChildExpenseReportsQuery();
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
     * @return ChildExpenseReports|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ExpenseReportsTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ExpenseReportsTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildExpenseReports A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_branch_office, id_expense_concept, id_user, date_expense, amount, description, created_at, updated_at FROM expense_reports WHERE id = :p0';
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
            /** @var ChildExpenseReports $obj */
            $obj = new ChildExpenseReports();
            $obj->hydrate($row);
            ExpenseReportsTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildExpenseReports|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildExpenseReportsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ExpenseReportsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildExpenseReportsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ExpenseReportsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildExpenseReportsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ExpenseReportsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ExpenseReportsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpenseReportsTableMap::COL_ID, $id, $comparison);
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
     * @return $this|ChildExpenseReportsQuery The current query, for fluid interface
     */
    public function filterByIdBranchOffice($idBranchOffice = null, $comparison = null)
    {
        if (is_array($idBranchOffice)) {
            $useMinMax = false;
            if (isset($idBranchOffice['min'])) {
                $this->addUsingAlias(ExpenseReportsTableMap::COL_ID_BRANCH_OFFICE, $idBranchOffice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idBranchOffice['max'])) {
                $this->addUsingAlias(ExpenseReportsTableMap::COL_ID_BRANCH_OFFICE, $idBranchOffice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpenseReportsTableMap::COL_ID_BRANCH_OFFICE, $idBranchOffice, $comparison);
    }

    /**
     * Filter the query on the id_expense_concept column
     *
     * Example usage:
     * <code>
     * $query->filterByIdExpenseConcept(1234); // WHERE id_expense_concept = 1234
     * $query->filterByIdExpenseConcept(array(12, 34)); // WHERE id_expense_concept IN (12, 34)
     * $query->filterByIdExpenseConcept(array('min' => 12)); // WHERE id_expense_concept > 12
     * </code>
     *
     * @see       filterByExpenseConcepts()
     *
     * @param     mixed $idExpenseConcept The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildExpenseReportsQuery The current query, for fluid interface
     */
    public function filterByIdExpenseConcept($idExpenseConcept = null, $comparison = null)
    {
        if (is_array($idExpenseConcept)) {
            $useMinMax = false;
            if (isset($idExpenseConcept['min'])) {
                $this->addUsingAlias(ExpenseReportsTableMap::COL_ID_EXPENSE_CONCEPT, $idExpenseConcept['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idExpenseConcept['max'])) {
                $this->addUsingAlias(ExpenseReportsTableMap::COL_ID_EXPENSE_CONCEPT, $idExpenseConcept['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpenseReportsTableMap::COL_ID_EXPENSE_CONCEPT, $idExpenseConcept, $comparison);
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
     * @return $this|ChildExpenseReportsQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(ExpenseReportsTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(ExpenseReportsTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpenseReportsTableMap::COL_ID_USER, $idUser, $comparison);
    }

    /**
     * Filter the query on the date_expense column
     *
     * Example usage:
     * <code>
     * $query->filterByDateExpense('2011-03-14'); // WHERE date_expense = '2011-03-14'
     * $query->filterByDateExpense('now'); // WHERE date_expense = '2011-03-14'
     * $query->filterByDateExpense(array('max' => 'yesterday')); // WHERE date_expense > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateExpense The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildExpenseReportsQuery The current query, for fluid interface
     */
    public function filterByDateExpense($dateExpense = null, $comparison = null)
    {
        if (is_array($dateExpense)) {
            $useMinMax = false;
            if (isset($dateExpense['min'])) {
                $this->addUsingAlias(ExpenseReportsTableMap::COL_DATE_EXPENSE, $dateExpense['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateExpense['max'])) {
                $this->addUsingAlias(ExpenseReportsTableMap::COL_DATE_EXPENSE, $dateExpense['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpenseReportsTableMap::COL_DATE_EXPENSE, $dateExpense, $comparison);
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
     * @return $this|ChildExpenseReportsQuery The current query, for fluid interface
     */
    public function filterByAmount($amount = null, $comparison = null)
    {
        if (is_array($amount)) {
            $useMinMax = false;
            if (isset($amount['min'])) {
                $this->addUsingAlias(ExpenseReportsTableMap::COL_AMOUNT, $amount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amount['max'])) {
                $this->addUsingAlias(ExpenseReportsTableMap::COL_AMOUNT, $amount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpenseReportsTableMap::COL_AMOUNT, $amount, $comparison);
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
     * @return $this|ChildExpenseReportsQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpenseReportsTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildExpenseReportsQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ExpenseReportsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ExpenseReportsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpenseReportsTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildExpenseReportsQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ExpenseReportsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ExpenseReportsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ExpenseReportsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \BranchOffices object
     *
     * @param \BranchOffices|ObjectCollection $branchOffices The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildExpenseReportsQuery The current query, for fluid interface
     */
    public function filterByBranchOffices($branchOffices, $comparison = null)
    {
        if ($branchOffices instanceof \BranchOffices) {
            return $this
                ->addUsingAlias(ExpenseReportsTableMap::COL_ID_BRANCH_OFFICE, $branchOffices->getId(), $comparison);
        } elseif ($branchOffices instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ExpenseReportsTableMap::COL_ID_BRANCH_OFFICE, $branchOffices->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildExpenseReportsQuery The current query, for fluid interface
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
     * Filter the query by a related \ExpenseConcepts object
     *
     * @param \ExpenseConcepts|ObjectCollection $expenseConcepts The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildExpenseReportsQuery The current query, for fluid interface
     */
    public function filterByExpenseConcepts($expenseConcepts, $comparison = null)
    {
        if ($expenseConcepts instanceof \ExpenseConcepts) {
            return $this
                ->addUsingAlias(ExpenseReportsTableMap::COL_ID_EXPENSE_CONCEPT, $expenseConcepts->getId(), $comparison);
        } elseif ($expenseConcepts instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ExpenseReportsTableMap::COL_ID_EXPENSE_CONCEPT, $expenseConcepts->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByExpenseConcepts() only accepts arguments of type \ExpenseConcepts or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ExpenseConcepts relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildExpenseReportsQuery The current query, for fluid interface
     */
    public function joinExpenseConcepts($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ExpenseConcepts');

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
            $this->addJoinObject($join, 'ExpenseConcepts');
        }

        return $this;
    }

    /**
     * Use the ExpenseConcepts relation ExpenseConcepts object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ExpenseConceptsQuery A secondary query class using the current class as primary query
     */
    public function useExpenseConceptsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinExpenseConcepts($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ExpenseConcepts', '\ExpenseConceptsQuery');
    }

    /**
     * Use the ExpenseConcepts relation ExpenseConcepts object
     *
     * @param callable(\ExpenseConceptsQuery):\ExpenseConceptsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withExpenseConceptsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useExpenseConceptsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ExpenseConcepts table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \ExpenseConceptsQuery The inner query object of the EXISTS statement
     */
    public function useExpenseConceptsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ExpenseConcepts', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ExpenseConcepts table for a NOT EXISTS query.
     *
     * @see useExpenseConceptsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \ExpenseConceptsQuery The inner query object of the NOT EXISTS statement
     */
    public function useExpenseConceptsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ExpenseConcepts', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Users object
     *
     * @param \Users|ObjectCollection $users The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildExpenseReportsQuery The current query, for fluid interface
     */
    public function filterByUsers($users, $comparison = null)
    {
        if ($users instanceof \Users) {
            return $this
                ->addUsingAlias(ExpenseReportsTableMap::COL_ID_USER, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ExpenseReportsTableMap::COL_ID_USER, $users->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return $this|ChildExpenseReportsQuery The current query, for fluid interface
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
     * @param   ChildExpenseReports $expenseReports Object to remove from the list of results
     *
     * @return $this|ChildExpenseReportsQuery The current query, for fluid interface
     */
    public function prune($expenseReports = null)
    {
        if ($expenseReports) {
            $this->addUsingAlias(ExpenseReportsTableMap::COL_ID, $expenseReports->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the expense_reports table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseReportsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ExpenseReportsTableMap::clearInstancePool();
            ExpenseReportsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseReportsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ExpenseReportsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ExpenseReportsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ExpenseReportsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ExpenseReportsQuery
