<?php

namespace Map;

use \BranchOffices;
use \BranchOfficesQuery;
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
 * This class defines the structure of the 'branch_offices' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class BranchOfficesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.BranchOfficesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'golden_clean';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'branch_offices';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\BranchOffices';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'BranchOffices';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the id field
     */
    const COL_ID = 'branch_offices.id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'branch_offices.name';

    /**
     * the column name for the address field
     */
    const COL_ADDRESS = 'branch_offices.address';

    /**
     * the column name for the phone field
     */
    const COL_PHONE = 'branch_offices.phone';

    /**
     * the column name for the series field
     */
    const COL_SERIES = 'branch_offices.series';

    /**
     * the column name for the current_sheet field
     */
    const COL_CURRENT_SHEET = 'branch_offices.current_sheet';

    /**
     * the column name for the rfc field
     */
    const COL_RFC = 'branch_offices.rfc';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'branch_offices.email';

    /**
     * the column name for the legend field
     */
    const COL_LEGEND = 'branch_offices.legend';

    /**
     * the column name for the postal_code field
     */
    const COL_POSTAL_CODE = 'branch_offices.postal_code';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'branch_offices.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'branch_offices.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'Name', 'Address', 'Phone', 'Series', 'CurrentSheet', 'Rfc', 'Email', 'Legend', 'PostalCode', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'name', 'address', 'phone', 'series', 'currentSheet', 'rfc', 'email', 'legend', 'postalCode', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(BranchOfficesTableMap::COL_ID, BranchOfficesTableMap::COL_NAME, BranchOfficesTableMap::COL_ADDRESS, BranchOfficesTableMap::COL_PHONE, BranchOfficesTableMap::COL_SERIES, BranchOfficesTableMap::COL_CURRENT_SHEET, BranchOfficesTableMap::COL_RFC, BranchOfficesTableMap::COL_EMAIL, BranchOfficesTableMap::COL_LEGEND, BranchOfficesTableMap::COL_POSTAL_CODE, BranchOfficesTableMap::COL_CREATED_AT, BranchOfficesTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'name', 'address', 'phone', 'series', 'current_sheet', 'rfc', 'email', 'legend', 'postal_code', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Name' => 1, 'Address' => 2, 'Phone' => 3, 'Series' => 4, 'CurrentSheet' => 5, 'Rfc' => 6, 'Email' => 7, 'Legend' => 8, 'PostalCode' => 9, 'CreatedAt' => 10, 'UpdatedAt' => 11, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'name' => 1, 'address' => 2, 'phone' => 3, 'series' => 4, 'currentSheet' => 5, 'rfc' => 6, 'email' => 7, 'legend' => 8, 'postalCode' => 9, 'createdAt' => 10, 'updatedAt' => 11, ),
        self::TYPE_COLNAME       => array(BranchOfficesTableMap::COL_ID => 0, BranchOfficesTableMap::COL_NAME => 1, BranchOfficesTableMap::COL_ADDRESS => 2, BranchOfficesTableMap::COL_PHONE => 3, BranchOfficesTableMap::COL_SERIES => 4, BranchOfficesTableMap::COL_CURRENT_SHEET => 5, BranchOfficesTableMap::COL_RFC => 6, BranchOfficesTableMap::COL_EMAIL => 7, BranchOfficesTableMap::COL_LEGEND => 8, BranchOfficesTableMap::COL_POSTAL_CODE => 9, BranchOfficesTableMap::COL_CREATED_AT => 10, BranchOfficesTableMap::COL_UPDATED_AT => 11, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'name' => 1, 'address' => 2, 'phone' => 3, 'series' => 4, 'current_sheet' => 5, 'rfc' => 6, 'email' => 7, 'legend' => 8, 'postal_code' => 9, 'created_at' => 10, 'updated_at' => 11, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'BranchOffices.Id' => 'ID',
        'id' => 'ID',
        'branchOffices.id' => 'ID',
        'BranchOfficesTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'branch_offices.id' => 'ID',
        'Name' => 'NAME',
        'BranchOffices.Name' => 'NAME',
        'name' => 'NAME',
        'branchOffices.name' => 'NAME',
        'BranchOfficesTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'branch_offices.name' => 'NAME',
        'Address' => 'ADDRESS',
        'BranchOffices.Address' => 'ADDRESS',
        'address' => 'ADDRESS',
        'branchOffices.address' => 'ADDRESS',
        'BranchOfficesTableMap::COL_ADDRESS' => 'ADDRESS',
        'COL_ADDRESS' => 'ADDRESS',
        'branch_offices.address' => 'ADDRESS',
        'Phone' => 'PHONE',
        'BranchOffices.Phone' => 'PHONE',
        'phone' => 'PHONE',
        'branchOffices.phone' => 'PHONE',
        'BranchOfficesTableMap::COL_PHONE' => 'PHONE',
        'COL_PHONE' => 'PHONE',
        'branch_offices.phone' => 'PHONE',
        'Series' => 'SERIES',
        'BranchOffices.Series' => 'SERIES',
        'series' => 'SERIES',
        'branchOffices.series' => 'SERIES',
        'BranchOfficesTableMap::COL_SERIES' => 'SERIES',
        'COL_SERIES' => 'SERIES',
        'branch_offices.series' => 'SERIES',
        'CurrentSheet' => 'CURRENT_SHEET',
        'BranchOffices.CurrentSheet' => 'CURRENT_SHEET',
        'currentSheet' => 'CURRENT_SHEET',
        'branchOffices.currentSheet' => 'CURRENT_SHEET',
        'BranchOfficesTableMap::COL_CURRENT_SHEET' => 'CURRENT_SHEET',
        'COL_CURRENT_SHEET' => 'CURRENT_SHEET',
        'current_sheet' => 'CURRENT_SHEET',
        'branch_offices.current_sheet' => 'CURRENT_SHEET',
        'Rfc' => 'RFC',
        'BranchOffices.Rfc' => 'RFC',
        'rfc' => 'RFC',
        'branchOffices.rfc' => 'RFC',
        'BranchOfficesTableMap::COL_RFC' => 'RFC',
        'COL_RFC' => 'RFC',
        'branch_offices.rfc' => 'RFC',
        'Email' => 'EMAIL',
        'BranchOffices.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'branchOffices.email' => 'EMAIL',
        'BranchOfficesTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'branch_offices.email' => 'EMAIL',
        'Legend' => 'LEGEND',
        'BranchOffices.Legend' => 'LEGEND',
        'legend' => 'LEGEND',
        'branchOffices.legend' => 'LEGEND',
        'BranchOfficesTableMap::COL_LEGEND' => 'LEGEND',
        'COL_LEGEND' => 'LEGEND',
        'branch_offices.legend' => 'LEGEND',
        'PostalCode' => 'POSTAL_CODE',
        'BranchOffices.PostalCode' => 'POSTAL_CODE',
        'postalCode' => 'POSTAL_CODE',
        'branchOffices.postalCode' => 'POSTAL_CODE',
        'BranchOfficesTableMap::COL_POSTAL_CODE' => 'POSTAL_CODE',
        'COL_POSTAL_CODE' => 'POSTAL_CODE',
        'postal_code' => 'POSTAL_CODE',
        'branch_offices.postal_code' => 'POSTAL_CODE',
        'CreatedAt' => 'CREATED_AT',
        'BranchOffices.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'branchOffices.createdAt' => 'CREATED_AT',
        'BranchOfficesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'branch_offices.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'BranchOffices.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'branchOffices.updatedAt' => 'UPDATED_AT',
        'BranchOfficesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'branch_offices.updated_at' => 'UPDATED_AT',
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
        $this->setName('branch_offices');
        $this->setPhpName('BranchOffices');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\BranchOffices');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 10, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 191, null);
        $this->addColumn('address', 'Address', 'VARCHAR', true, 191, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', true, 191, null);
        $this->addColumn('series', 'Series', 'VARCHAR', true, 191, null);
        $this->addColumn('current_sheet', 'CurrentSheet', 'INTEGER', true, 10, null);
        $this->addColumn('rfc', 'Rfc', 'VARCHAR', true, 191, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 191, null);
        $this->addColumn('legend', 'Legend', 'VARCHAR', true, 191, null);
        $this->addColumn('postal_code', 'PostalCode', 'INTEGER', true, 10, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('BranchOfficeServices', '\\BranchOfficeServices', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_branch_office',
    1 => ':id',
  ),
), null, 'CASCADE', 'BranchOfficeServicess', false);
        $this->addRelation('ExpenseReports', '\\ExpenseReports', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_branch_office',
    1 => ':id',
  ),
), null, 'CASCADE', 'ExpenseReportss', false);
        $this->addRelation('Orders', '\\Orders', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_branch_office',
    1 => ':id',
  ),
), null, 'CASCADE', 'Orderss', false);
        $this->addRelation('Users', '\\Users', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_branch_office',
    1 => ':id',
  ),
), null, 'CASCADE', 'Userss', false);
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
        return $withPrefix ? BranchOfficesTableMap::CLASS_DEFAULT : BranchOfficesTableMap::OM_CLASS;
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
     * @return array           (BranchOffices object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = BranchOfficesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BranchOfficesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BranchOfficesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BranchOfficesTableMap::OM_CLASS;
            /** @var BranchOffices $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BranchOfficesTableMap::addInstanceToPool($obj, $key);
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
            $key = BranchOfficesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BranchOfficesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var BranchOffices $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BranchOfficesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BranchOfficesTableMap::COL_ID);
            $criteria->addSelectColumn(BranchOfficesTableMap::COL_NAME);
            $criteria->addSelectColumn(BranchOfficesTableMap::COL_ADDRESS);
            $criteria->addSelectColumn(BranchOfficesTableMap::COL_PHONE);
            $criteria->addSelectColumn(BranchOfficesTableMap::COL_SERIES);
            $criteria->addSelectColumn(BranchOfficesTableMap::COL_CURRENT_SHEET);
            $criteria->addSelectColumn(BranchOfficesTableMap::COL_RFC);
            $criteria->addSelectColumn(BranchOfficesTableMap::COL_EMAIL);
            $criteria->addSelectColumn(BranchOfficesTableMap::COL_LEGEND);
            $criteria->addSelectColumn(BranchOfficesTableMap::COL_POSTAL_CODE);
            $criteria->addSelectColumn(BranchOfficesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(BranchOfficesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.address');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.series');
            $criteria->addSelectColumn($alias . '.current_sheet');
            $criteria->addSelectColumn($alias . '.rfc');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.legend');
            $criteria->addSelectColumn($alias . '.postal_code');
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
            $criteria->removeSelectColumn(BranchOfficesTableMap::COL_ID);
            $criteria->removeSelectColumn(BranchOfficesTableMap::COL_NAME);
            $criteria->removeSelectColumn(BranchOfficesTableMap::COL_ADDRESS);
            $criteria->removeSelectColumn(BranchOfficesTableMap::COL_PHONE);
            $criteria->removeSelectColumn(BranchOfficesTableMap::COL_SERIES);
            $criteria->removeSelectColumn(BranchOfficesTableMap::COL_CURRENT_SHEET);
            $criteria->removeSelectColumn(BranchOfficesTableMap::COL_RFC);
            $criteria->removeSelectColumn(BranchOfficesTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(BranchOfficesTableMap::COL_LEGEND);
            $criteria->removeSelectColumn(BranchOfficesTableMap::COL_POSTAL_CODE);
            $criteria->removeSelectColumn(BranchOfficesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(BranchOfficesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.address');
            $criteria->removeSelectColumn($alias . '.phone');
            $criteria->removeSelectColumn($alias . '.series');
            $criteria->removeSelectColumn($alias . '.current_sheet');
            $criteria->removeSelectColumn($alias . '.rfc');
            $criteria->removeSelectColumn($alias . '.email');
            $criteria->removeSelectColumn($alias . '.legend');
            $criteria->removeSelectColumn($alias . '.postal_code');
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
        return Propel::getServiceContainer()->getDatabaseMap(BranchOfficesTableMap::DATABASE_NAME)->getTable(BranchOfficesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a BranchOffices or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or BranchOffices object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BranchOfficesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \BranchOffices) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BranchOfficesTableMap::DATABASE_NAME);
            $criteria->add(BranchOfficesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = BranchOfficesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BranchOfficesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BranchOfficesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the branch_offices table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return BranchOfficesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a BranchOffices or Criteria object.
     *
     * @param mixed               $criteria Criteria or BranchOffices object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BranchOfficesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from BranchOffices object
        }

        if ($criteria->containsKey(BranchOfficesTableMap::COL_ID) && $criteria->keyContainsValue(BranchOfficesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BranchOfficesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = BranchOfficesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // BranchOfficesTableMap
