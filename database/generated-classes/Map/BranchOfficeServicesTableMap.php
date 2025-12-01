<?php

namespace Map;

use \BranchOfficeServices;
use \BranchOfficeServicesQuery;
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
 * This class defines the structure of the 'branch_office_services' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class BranchOfficeServicesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.BranchOfficeServicesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'golden_clean';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'branch_office_services';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\BranchOfficeServices';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'BranchOfficeServices';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id field
     */
    const COL_ID = 'branch_office_services.id';

    /**
     * the column name for the id_branch_office field
     */
    const COL_ID_BRANCH_OFFICE = 'branch_office_services.id_branch_office';

    /**
     * the column name for the id_service field
     */
    const COL_ID_SERVICE = 'branch_office_services.id_service';

    /**
     * the column name for the normal_price field
     */
    const COL_NORMAL_PRICE = 'branch_office_services.normal_price';

    /**
     * the column name for the urgent_price field
     */
    const COL_URGENT_PRICE = 'branch_office_services.urgent_price';

    /**
     * the column name for the extra_urgent_price field
     */
    const COL_EXTRA_URGENT_PRICE = 'branch_office_services.extra_urgent_price';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'branch_office_services.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'branch_office_services.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'IdBranchOffice', 'IdService', 'NormalPrice', 'UrgentPrice', 'ExtraUrgentPrice', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'idBranchOffice', 'idService', 'normalPrice', 'urgentPrice', 'extraUrgentPrice', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(BranchOfficeServicesTableMap::COL_ID, BranchOfficeServicesTableMap::COL_ID_BRANCH_OFFICE, BranchOfficeServicesTableMap::COL_ID_SERVICE, BranchOfficeServicesTableMap::COL_NORMAL_PRICE, BranchOfficeServicesTableMap::COL_URGENT_PRICE, BranchOfficeServicesTableMap::COL_EXTRA_URGENT_PRICE, BranchOfficeServicesTableMap::COL_CREATED_AT, BranchOfficeServicesTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'id_branch_office', 'id_service', 'normal_price', 'urgent_price', 'extra_urgent_price', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdBranchOffice' => 1, 'IdService' => 2, 'NormalPrice' => 3, 'UrgentPrice' => 4, 'ExtraUrgentPrice' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idBranchOffice' => 1, 'idService' => 2, 'normalPrice' => 3, 'urgentPrice' => 4, 'extraUrgentPrice' => 5, 'createdAt' => 6, 'updatedAt' => 7, ),
        self::TYPE_COLNAME       => array(BranchOfficeServicesTableMap::COL_ID => 0, BranchOfficeServicesTableMap::COL_ID_BRANCH_OFFICE => 1, BranchOfficeServicesTableMap::COL_ID_SERVICE => 2, BranchOfficeServicesTableMap::COL_NORMAL_PRICE => 3, BranchOfficeServicesTableMap::COL_URGENT_PRICE => 4, BranchOfficeServicesTableMap::COL_EXTRA_URGENT_PRICE => 5, BranchOfficeServicesTableMap::COL_CREATED_AT => 6, BranchOfficeServicesTableMap::COL_UPDATED_AT => 7, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_branch_office' => 1, 'id_service' => 2, 'normal_price' => 3, 'urgent_price' => 4, 'extra_urgent_price' => 5, 'created_at' => 6, 'updated_at' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'BranchOfficeServices.Id' => 'ID',
        'id' => 'ID',
        'branchOfficeServices.id' => 'ID',
        'BranchOfficeServicesTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'branch_office_services.id' => 'ID',
        'IdBranchOffice' => 'ID_BRANCH_OFFICE',
        'BranchOfficeServices.IdBranchOffice' => 'ID_BRANCH_OFFICE',
        'idBranchOffice' => 'ID_BRANCH_OFFICE',
        'branchOfficeServices.idBranchOffice' => 'ID_BRANCH_OFFICE',
        'BranchOfficeServicesTableMap::COL_ID_BRANCH_OFFICE' => 'ID_BRANCH_OFFICE',
        'COL_ID_BRANCH_OFFICE' => 'ID_BRANCH_OFFICE',
        'id_branch_office' => 'ID_BRANCH_OFFICE',
        'branch_office_services.id_branch_office' => 'ID_BRANCH_OFFICE',
        'IdService' => 'ID_SERVICE',
        'BranchOfficeServices.IdService' => 'ID_SERVICE',
        'idService' => 'ID_SERVICE',
        'branchOfficeServices.idService' => 'ID_SERVICE',
        'BranchOfficeServicesTableMap::COL_ID_SERVICE' => 'ID_SERVICE',
        'COL_ID_SERVICE' => 'ID_SERVICE',
        'id_service' => 'ID_SERVICE',
        'branch_office_services.id_service' => 'ID_SERVICE',
        'NormalPrice' => 'NORMAL_PRICE',
        'BranchOfficeServices.NormalPrice' => 'NORMAL_PRICE',
        'normalPrice' => 'NORMAL_PRICE',
        'branchOfficeServices.normalPrice' => 'NORMAL_PRICE',
        'BranchOfficeServicesTableMap::COL_NORMAL_PRICE' => 'NORMAL_PRICE',
        'COL_NORMAL_PRICE' => 'NORMAL_PRICE',
        'normal_price' => 'NORMAL_PRICE',
        'branch_office_services.normal_price' => 'NORMAL_PRICE',
        'UrgentPrice' => 'URGENT_PRICE',
        'BranchOfficeServices.UrgentPrice' => 'URGENT_PRICE',
        'urgentPrice' => 'URGENT_PRICE',
        'branchOfficeServices.urgentPrice' => 'URGENT_PRICE',
        'BranchOfficeServicesTableMap::COL_URGENT_PRICE' => 'URGENT_PRICE',
        'COL_URGENT_PRICE' => 'URGENT_PRICE',
        'urgent_price' => 'URGENT_PRICE',
        'branch_office_services.urgent_price' => 'URGENT_PRICE',
        'ExtraUrgentPrice' => 'EXTRA_URGENT_PRICE',
        'BranchOfficeServices.ExtraUrgentPrice' => 'EXTRA_URGENT_PRICE',
        'extraUrgentPrice' => 'EXTRA_URGENT_PRICE',
        'branchOfficeServices.extraUrgentPrice' => 'EXTRA_URGENT_PRICE',
        'BranchOfficeServicesTableMap::COL_EXTRA_URGENT_PRICE' => 'EXTRA_URGENT_PRICE',
        'COL_EXTRA_URGENT_PRICE' => 'EXTRA_URGENT_PRICE',
        'extra_urgent_price' => 'EXTRA_URGENT_PRICE',
        'branch_office_services.extra_urgent_price' => 'EXTRA_URGENT_PRICE',
        'CreatedAt' => 'CREATED_AT',
        'BranchOfficeServices.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'branchOfficeServices.createdAt' => 'CREATED_AT',
        'BranchOfficeServicesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'branch_office_services.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'BranchOfficeServices.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'branchOfficeServices.updatedAt' => 'UPDATED_AT',
        'BranchOfficeServicesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'branch_office_services.updated_at' => 'UPDATED_AT',
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
        $this->setName('branch_office_services');
        $this->setPhpName('BranchOfficeServices');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\BranchOfficeServices');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 10, null);
        $this->addForeignKey('id_branch_office', 'IdBranchOffice', 'INTEGER', 'branch_offices', 'id', true, 10, null);
        $this->addForeignKey('id_service', 'IdService', 'INTEGER', 'services', 'id', true, 10, null);
        $this->addColumn('normal_price', 'NormalPrice', 'DECIMAL', true, 8, 0.00);
        $this->addColumn('urgent_price', 'UrgentPrice', 'DECIMAL', true, 8, 0.00);
        $this->addColumn('extra_urgent_price', 'ExtraUrgentPrice', 'DECIMAL', true, 8, 0.00);
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
        $this->addRelation('Services', '\\Services', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_service',
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
        return $withPrefix ? BranchOfficeServicesTableMap::CLASS_DEFAULT : BranchOfficeServicesTableMap::OM_CLASS;
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
     * @return array           (BranchOfficeServices object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = BranchOfficeServicesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = BranchOfficeServicesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + BranchOfficeServicesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = BranchOfficeServicesTableMap::OM_CLASS;
            /** @var BranchOfficeServices $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            BranchOfficeServicesTableMap::addInstanceToPool($obj, $key);
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
            $key = BranchOfficeServicesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = BranchOfficeServicesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var BranchOfficeServices $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                BranchOfficeServicesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(BranchOfficeServicesTableMap::COL_ID);
            $criteria->addSelectColumn(BranchOfficeServicesTableMap::COL_ID_BRANCH_OFFICE);
            $criteria->addSelectColumn(BranchOfficeServicesTableMap::COL_ID_SERVICE);
            $criteria->addSelectColumn(BranchOfficeServicesTableMap::COL_NORMAL_PRICE);
            $criteria->addSelectColumn(BranchOfficeServicesTableMap::COL_URGENT_PRICE);
            $criteria->addSelectColumn(BranchOfficeServicesTableMap::COL_EXTRA_URGENT_PRICE);
            $criteria->addSelectColumn(BranchOfficeServicesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(BranchOfficeServicesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_branch_office');
            $criteria->addSelectColumn($alias . '.id_service');
            $criteria->addSelectColumn($alias . '.normal_price');
            $criteria->addSelectColumn($alias . '.urgent_price');
            $criteria->addSelectColumn($alias . '.extra_urgent_price');
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
            $criteria->removeSelectColumn(BranchOfficeServicesTableMap::COL_ID);
            $criteria->removeSelectColumn(BranchOfficeServicesTableMap::COL_ID_BRANCH_OFFICE);
            $criteria->removeSelectColumn(BranchOfficeServicesTableMap::COL_ID_SERVICE);
            $criteria->removeSelectColumn(BranchOfficeServicesTableMap::COL_NORMAL_PRICE);
            $criteria->removeSelectColumn(BranchOfficeServicesTableMap::COL_URGENT_PRICE);
            $criteria->removeSelectColumn(BranchOfficeServicesTableMap::COL_EXTRA_URGENT_PRICE);
            $criteria->removeSelectColumn(BranchOfficeServicesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(BranchOfficeServicesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.id_branch_office');
            $criteria->removeSelectColumn($alias . '.id_service');
            $criteria->removeSelectColumn($alias . '.normal_price');
            $criteria->removeSelectColumn($alias . '.urgent_price');
            $criteria->removeSelectColumn($alias . '.extra_urgent_price');
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
        return Propel::getServiceContainer()->getDatabaseMap(BranchOfficeServicesTableMap::DATABASE_NAME)->getTable(BranchOfficeServicesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a BranchOfficeServices or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or BranchOfficeServices object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(BranchOfficeServicesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \BranchOfficeServices) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(BranchOfficeServicesTableMap::DATABASE_NAME);
            $criteria->add(BranchOfficeServicesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = BranchOfficeServicesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            BranchOfficeServicesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                BranchOfficeServicesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the branch_office_services table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return BranchOfficeServicesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a BranchOfficeServices or Criteria object.
     *
     * @param mixed               $criteria Criteria or BranchOfficeServices object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BranchOfficeServicesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from BranchOfficeServices object
        }

        if ($criteria->containsKey(BranchOfficeServicesTableMap::COL_ID) && $criteria->keyContainsValue(BranchOfficeServicesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.BranchOfficeServicesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = BranchOfficeServicesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // BranchOfficeServicesTableMap
