<?php

namespace Map;

use \ExpenseReports;
use \ExpenseReportsQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'expense_reports' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ExpenseReportsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ExpenseReportsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'golden_clean';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'expense_reports';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\ExpenseReports';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'ExpenseReports';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the id field
     */
    const COL_ID = 'expense_reports.id';

    /**
     * the column name for the id_branch_office field
     */
    const COL_ID_BRANCH_OFFICE = 'expense_reports.id_branch_office';

    /**
     * the column name for the id_expense_concept field
     */
    const COL_ID_EXPENSE_CONCEPT = 'expense_reports.id_expense_concept';

    /**
     * the column name for the id_user field
     */
    const COL_ID_USER = 'expense_reports.id_user';

    /**
     * the column name for the date_expense field
     */
    const COL_DATE_EXPENSE = 'expense_reports.date_expense';

    /**
     * the column name for the amount field
     */
    const COL_AMOUNT = 'expense_reports.amount';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'expense_reports.description';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'expense_reports.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'expense_reports.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'IdBranchOffice', 'IdExpenseConcept', 'IdUser', 'DateExpense', 'Amount', 'Description', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'idBranchOffice', 'idExpenseConcept', 'idUser', 'dateExpense', 'amount', 'description', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(ExpenseReportsTableMap::COL_ID, ExpenseReportsTableMap::COL_ID_BRANCH_OFFICE, ExpenseReportsTableMap::COL_ID_EXPENSE_CONCEPT, ExpenseReportsTableMap::COL_ID_USER, ExpenseReportsTableMap::COL_DATE_EXPENSE, ExpenseReportsTableMap::COL_AMOUNT, ExpenseReportsTableMap::COL_DESCRIPTION, ExpenseReportsTableMap::COL_CREATED_AT, ExpenseReportsTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'id_branch_office', 'id_expense_concept', 'id_user', 'date_expense', 'amount', 'description', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdBranchOffice' => 1, 'IdExpenseConcept' => 2, 'IdUser' => 3, 'DateExpense' => 4, 'Amount' => 5, 'Description' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idBranchOffice' => 1, 'idExpenseConcept' => 2, 'idUser' => 3, 'dateExpense' => 4, 'amount' => 5, 'description' => 6, 'createdAt' => 7, 'updatedAt' => 8, ),
        self::TYPE_COLNAME       => array(ExpenseReportsTableMap::COL_ID => 0, ExpenseReportsTableMap::COL_ID_BRANCH_OFFICE => 1, ExpenseReportsTableMap::COL_ID_EXPENSE_CONCEPT => 2, ExpenseReportsTableMap::COL_ID_USER => 3, ExpenseReportsTableMap::COL_DATE_EXPENSE => 4, ExpenseReportsTableMap::COL_AMOUNT => 5, ExpenseReportsTableMap::COL_DESCRIPTION => 6, ExpenseReportsTableMap::COL_CREATED_AT => 7, ExpenseReportsTableMap::COL_UPDATED_AT => 8, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_branch_office' => 1, 'id_expense_concept' => 2, 'id_user' => 3, 'date_expense' => 4, 'amount' => 5, 'description' => 6, 'created_at' => 7, 'updated_at' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'ExpenseReports.Id' => 'ID',
        'id' => 'ID',
        'expenseReports.id' => 'ID',
        'ExpenseReportsTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'expense_reports.id' => 'ID',
        'IdBranchOffice' => 'ID_BRANCH_OFFICE',
        'ExpenseReports.IdBranchOffice' => 'ID_BRANCH_OFFICE',
        'idBranchOffice' => 'ID_BRANCH_OFFICE',
        'expenseReports.idBranchOffice' => 'ID_BRANCH_OFFICE',
        'ExpenseReportsTableMap::COL_ID_BRANCH_OFFICE' => 'ID_BRANCH_OFFICE',
        'COL_ID_BRANCH_OFFICE' => 'ID_BRANCH_OFFICE',
        'id_branch_office' => 'ID_BRANCH_OFFICE',
        'expense_reports.id_branch_office' => 'ID_BRANCH_OFFICE',
        'IdExpenseConcept' => 'ID_EXPENSE_CONCEPT',
        'ExpenseReports.IdExpenseConcept' => 'ID_EXPENSE_CONCEPT',
        'idExpenseConcept' => 'ID_EXPENSE_CONCEPT',
        'expenseReports.idExpenseConcept' => 'ID_EXPENSE_CONCEPT',
        'ExpenseReportsTableMap::COL_ID_EXPENSE_CONCEPT' => 'ID_EXPENSE_CONCEPT',
        'COL_ID_EXPENSE_CONCEPT' => 'ID_EXPENSE_CONCEPT',
        'id_expense_concept' => 'ID_EXPENSE_CONCEPT',
        'expense_reports.id_expense_concept' => 'ID_EXPENSE_CONCEPT',
        'IdUser' => 'ID_USER',
        'ExpenseReports.IdUser' => 'ID_USER',
        'idUser' => 'ID_USER',
        'expenseReports.idUser' => 'ID_USER',
        'ExpenseReportsTableMap::COL_ID_USER' => 'ID_USER',
        'COL_ID_USER' => 'ID_USER',
        'id_user' => 'ID_USER',
        'expense_reports.id_user' => 'ID_USER',
        'DateExpense' => 'DATE_EXPENSE',
        'ExpenseReports.DateExpense' => 'DATE_EXPENSE',
        'dateExpense' => 'DATE_EXPENSE',
        'expenseReports.dateExpense' => 'DATE_EXPENSE',
        'ExpenseReportsTableMap::COL_DATE_EXPENSE' => 'DATE_EXPENSE',
        'COL_DATE_EXPENSE' => 'DATE_EXPENSE',
        'date_expense' => 'DATE_EXPENSE',
        'expense_reports.date_expense' => 'DATE_EXPENSE',
        'Amount' => 'AMOUNT',
        'ExpenseReports.Amount' => 'AMOUNT',
        'amount' => 'AMOUNT',
        'expenseReports.amount' => 'AMOUNT',
        'ExpenseReportsTableMap::COL_AMOUNT' => 'AMOUNT',
        'COL_AMOUNT' => 'AMOUNT',
        'expense_reports.amount' => 'AMOUNT',
        'Description' => 'DESCRIPTION',
        'ExpenseReports.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'expenseReports.description' => 'DESCRIPTION',
        'ExpenseReportsTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'expense_reports.description' => 'DESCRIPTION',
        'CreatedAt' => 'CREATED_AT',
        'ExpenseReports.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'expenseReports.createdAt' => 'CREATED_AT',
        'ExpenseReportsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'expense_reports.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'ExpenseReports.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'expenseReports.updatedAt' => 'UPDATED_AT',
        'ExpenseReportsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'expense_reports.updated_at' => 'UPDATED_AT',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('expense_reports');
        $this->setPhpName('ExpenseReports');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\ExpenseReports');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 10, null);
        $this->addForeignKey('id_branch_office', 'IdBranchOffice', 'INTEGER', 'branch_offices', 'id', true, 10, null);
        $this->addForeignKey('id_expense_concept', 'IdExpenseConcept', 'INTEGER', 'expense_concepts', 'id', true, 10, null);
        $this->addForeignKey('id_user', 'IdUser', 'INTEGER', 'users', 'id', true, 10, null);
        $this->addColumn('date_expense', 'DateExpense', 'DATE', true, null, null);
        $this->addColumn('amount', 'Amount', 'DECIMAL', true, 8, null);
        $this->addColumn('description', 'Description', 'VARCHAR', true, 191, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('BranchOffices', '\\BranchOffices', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_branch_office',
    1 => ':id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('ExpenseConcepts', '\\ExpenseConcepts', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_expense_concept',
    1 => ':id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('Users', '\\Users', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_user',
    1 => ':id',
  ),
), null, 'CASCADE', null, false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? ExpenseReportsTableMap::CLASS_DEFAULT : ExpenseReportsTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (ExpenseReports object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ExpenseReportsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ExpenseReportsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ExpenseReportsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ExpenseReportsTableMap::OM_CLASS;
            /** @var ExpenseReports $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ExpenseReportsTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = ExpenseReportsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ExpenseReportsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ExpenseReports $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ExpenseReportsTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(ExpenseReportsTableMap::COL_ID);
            $criteria->addSelectColumn(ExpenseReportsTableMap::COL_ID_BRANCH_OFFICE);
            $criteria->addSelectColumn(ExpenseReportsTableMap::COL_ID_EXPENSE_CONCEPT);
            $criteria->addSelectColumn(ExpenseReportsTableMap::COL_ID_USER);
            $criteria->addSelectColumn(ExpenseReportsTableMap::COL_DATE_EXPENSE);
            $criteria->addSelectColumn(ExpenseReportsTableMap::COL_AMOUNT);
            $criteria->addSelectColumn(ExpenseReportsTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(ExpenseReportsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ExpenseReportsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_branch_office');
            $criteria->addSelectColumn($alias . '.id_expense_concept');
            $criteria->addSelectColumn($alias . '.id_user');
            $criteria->addSelectColumn($alias . '.date_expense');
            $criteria->addSelectColumn($alias . '.amount');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria object containing the columns to remove.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function removeSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(ExpenseReportsTableMap::COL_ID);
            $criteria->removeSelectColumn(ExpenseReportsTableMap::COL_ID_BRANCH_OFFICE);
            $criteria->removeSelectColumn(ExpenseReportsTableMap::COL_ID_EXPENSE_CONCEPT);
            $criteria->removeSelectColumn(ExpenseReportsTableMap::COL_ID_USER);
            $criteria->removeSelectColumn(ExpenseReportsTableMap::COL_DATE_EXPENSE);
            $criteria->removeSelectColumn(ExpenseReportsTableMap::COL_AMOUNT);
            $criteria->removeSelectColumn(ExpenseReportsTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(ExpenseReportsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(ExpenseReportsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.id_branch_office');
            $criteria->removeSelectColumn($alias . '.id_expense_concept');
            $criteria->removeSelectColumn($alias . '.id_user');
            $criteria->removeSelectColumn($alias . '.date_expense');
            $criteria->removeSelectColumn($alias . '.amount');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.created_at');
            $criteria->removeSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(ExpenseReportsTableMap::DATABASE_NAME)->getTable(ExpenseReportsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ExpenseReports or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ExpenseReports object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseReportsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \ExpenseReports) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ExpenseReportsTableMap::DATABASE_NAME);
            $criteria->add(ExpenseReportsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ExpenseReportsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ExpenseReportsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ExpenseReportsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the expense_reports table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ExpenseReportsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ExpenseReports or Criteria object.
     *
     * @param mixed               $criteria Criteria or ExpenseReports object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ExpenseReportsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ExpenseReports object
        }

        if ($criteria->containsKey(ExpenseReportsTableMap::COL_ID) && $criteria->keyContainsValue(ExpenseReportsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ExpenseReportsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ExpenseReportsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ExpenseReportsTableMap
