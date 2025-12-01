<?php

namespace Map;

use \Services;
use \ServicesQuery;
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
 * This class defines the structure of the 'services' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ServicesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ServicesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'golden_clean';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'services';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Services';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Services';

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
    const COL_ID = 'services.id';

    /**
     * the column name for the id_service_category field
     */
    const COL_ID_SERVICE_CATEGORY = 'services.id_service_category';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'services.description';

    /**
     * the column name for the normal_price field
     */
    const COL_NORMAL_PRICE = 'services.normal_price';

    /**
     * the column name for the urgent_price field
     */
    const COL_URGENT_PRICE = 'services.urgent_price';

    /**
     * the column name for the extra_urgent_price field
     */
    const COL_EXTRA_URGENT_PRICE = 'services.extra_urgent_price';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'services.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'services.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'IdServiceCategory', 'Description', 'NormalPrice', 'UrgentPrice', 'ExtraUrgentPrice', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'idServiceCategory', 'description', 'normalPrice', 'urgentPrice', 'extraUrgentPrice', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(ServicesTableMap::COL_ID, ServicesTableMap::COL_ID_SERVICE_CATEGORY, ServicesTableMap::COL_DESCRIPTION, ServicesTableMap::COL_NORMAL_PRICE, ServicesTableMap::COL_URGENT_PRICE, ServicesTableMap::COL_EXTRA_URGENT_PRICE, ServicesTableMap::COL_CREATED_AT, ServicesTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'id_service_category', 'description', 'normal_price', 'urgent_price', 'extra_urgent_price', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdServiceCategory' => 1, 'Description' => 2, 'NormalPrice' => 3, 'UrgentPrice' => 4, 'ExtraUrgentPrice' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idServiceCategory' => 1, 'description' => 2, 'normalPrice' => 3, 'urgentPrice' => 4, 'extraUrgentPrice' => 5, 'createdAt' => 6, 'updatedAt' => 7, ),
        self::TYPE_COLNAME       => array(ServicesTableMap::COL_ID => 0, ServicesTableMap::COL_ID_SERVICE_CATEGORY => 1, ServicesTableMap::COL_DESCRIPTION => 2, ServicesTableMap::COL_NORMAL_PRICE => 3, ServicesTableMap::COL_URGENT_PRICE => 4, ServicesTableMap::COL_EXTRA_URGENT_PRICE => 5, ServicesTableMap::COL_CREATED_AT => 6, ServicesTableMap::COL_UPDATED_AT => 7, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_service_category' => 1, 'description' => 2, 'normal_price' => 3, 'urgent_price' => 4, 'extra_urgent_price' => 5, 'created_at' => 6, 'updated_at' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Services.Id' => 'ID',
        'id' => 'ID',
        'services.id' => 'ID',
        'ServicesTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'IdServiceCategory' => 'ID_SERVICE_CATEGORY',
        'Services.IdServiceCategory' => 'ID_SERVICE_CATEGORY',
        'idServiceCategory' => 'ID_SERVICE_CATEGORY',
        'services.idServiceCategory' => 'ID_SERVICE_CATEGORY',
        'ServicesTableMap::COL_ID_SERVICE_CATEGORY' => 'ID_SERVICE_CATEGORY',
        'COL_ID_SERVICE_CATEGORY' => 'ID_SERVICE_CATEGORY',
        'id_service_category' => 'ID_SERVICE_CATEGORY',
        'services.id_service_category' => 'ID_SERVICE_CATEGORY',
        'Description' => 'DESCRIPTION',
        'Services.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'services.description' => 'DESCRIPTION',
        'ServicesTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'NormalPrice' => 'NORMAL_PRICE',
        'Services.NormalPrice' => 'NORMAL_PRICE',
        'normalPrice' => 'NORMAL_PRICE',
        'services.normalPrice' => 'NORMAL_PRICE',
        'ServicesTableMap::COL_NORMAL_PRICE' => 'NORMAL_PRICE',
        'COL_NORMAL_PRICE' => 'NORMAL_PRICE',
        'normal_price' => 'NORMAL_PRICE',
        'services.normal_price' => 'NORMAL_PRICE',
        'UrgentPrice' => 'URGENT_PRICE',
        'Services.UrgentPrice' => 'URGENT_PRICE',
        'urgentPrice' => 'URGENT_PRICE',
        'services.urgentPrice' => 'URGENT_PRICE',
        'ServicesTableMap::COL_URGENT_PRICE' => 'URGENT_PRICE',
        'COL_URGENT_PRICE' => 'URGENT_PRICE',
        'urgent_price' => 'URGENT_PRICE',
        'services.urgent_price' => 'URGENT_PRICE',
        'ExtraUrgentPrice' => 'EXTRA_URGENT_PRICE',
        'Services.ExtraUrgentPrice' => 'EXTRA_URGENT_PRICE',
        'extraUrgentPrice' => 'EXTRA_URGENT_PRICE',
        'services.extraUrgentPrice' => 'EXTRA_URGENT_PRICE',
        'ServicesTableMap::COL_EXTRA_URGENT_PRICE' => 'EXTRA_URGENT_PRICE',
        'COL_EXTRA_URGENT_PRICE' => 'EXTRA_URGENT_PRICE',
        'extra_urgent_price' => 'EXTRA_URGENT_PRICE',
        'services.extra_urgent_price' => 'EXTRA_URGENT_PRICE',
        'CreatedAt' => 'CREATED_AT',
        'Services.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'services.createdAt' => 'CREATED_AT',
        'ServicesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'services.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Services.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'services.updatedAt' => 'UPDATED_AT',
        'ServicesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'services.updated_at' => 'UPDATED_AT',
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
        $this->setName('services');
        $this->setPhpName('Services');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Services');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 10, null);
        $this->addForeignKey('id_service_category', 'IdServiceCategory', 'INTEGER', 'service_categories', 'id', true, 10, null);
        $this->addColumn('description', 'Description', 'VARCHAR', true, 191, null);
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
        $this->addRelation('ServiceCategories', '\\ServiceCategories', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_service_category',
    1 => ':id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('BranchOfficeServices', '\\BranchOfficeServices', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_service',
    1 => ':id',
  ),
), null, 'CASCADE', 'BranchOfficeServicess', false);
        $this->addRelation('OrderDetail', '\\OrderDetail', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_service',
    1 => ':id',
  ),
), null, 'CASCADE', 'OrderDetails', false);
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
        return $withPrefix ? ServicesTableMap::CLASS_DEFAULT : ServicesTableMap::OM_CLASS;
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
     * @return array           (Services object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ServicesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ServicesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ServicesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ServicesTableMap::OM_CLASS;
            /** @var Services $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ServicesTableMap::addInstanceToPool($obj, $key);
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
            $key = ServicesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ServicesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Services $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ServicesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ServicesTableMap::COL_ID);
            $criteria->addSelectColumn(ServicesTableMap::COL_ID_SERVICE_CATEGORY);
            $criteria->addSelectColumn(ServicesTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(ServicesTableMap::COL_NORMAL_PRICE);
            $criteria->addSelectColumn(ServicesTableMap::COL_URGENT_PRICE);
            $criteria->addSelectColumn(ServicesTableMap::COL_EXTRA_URGENT_PRICE);
            $criteria->addSelectColumn(ServicesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ServicesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_service_category');
            $criteria->addSelectColumn($alias . '.description');
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
            $criteria->removeSelectColumn(ServicesTableMap::COL_ID);
            $criteria->removeSelectColumn(ServicesTableMap::COL_ID_SERVICE_CATEGORY);
            $criteria->removeSelectColumn(ServicesTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(ServicesTableMap::COL_NORMAL_PRICE);
            $criteria->removeSelectColumn(ServicesTableMap::COL_URGENT_PRICE);
            $criteria->removeSelectColumn(ServicesTableMap::COL_EXTRA_URGENT_PRICE);
            $criteria->removeSelectColumn(ServicesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(ServicesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.id_service_category');
            $criteria->removeSelectColumn($alias . '.description');
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
        return Propel::getServiceContainer()->getDatabaseMap(ServicesTableMap::DATABASE_NAME)->getTable(ServicesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Services or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Services object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ServicesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Services) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ServicesTableMap::DATABASE_NAME);
            $criteria->add(ServicesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ServicesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ServicesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ServicesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the services table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ServicesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Services or Criteria object.
     *
     * @param mixed               $criteria Criteria or Services object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ServicesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Services object
        }

        if ($criteria->containsKey(ServicesTableMap::COL_ID) && $criteria->keyContainsValue(ServicesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ServicesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ServicesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ServicesTableMap
