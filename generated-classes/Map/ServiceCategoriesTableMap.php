<?php

namespace Map;

use \ServiceCategories;
use \ServiceCategoriesQuery;
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
 * This class defines the structure of the 'service_categories' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ServiceCategoriesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ServiceCategoriesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'golden_clean';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'service_categories';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\ServiceCategories';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'ServiceCategories';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the id field
     */
    const COL_ID = 'service_categories.id';

    /**
     * the column name for the id_service_group field
     */
    const COL_ID_SERVICE_GROUP = 'service_categories.id_service_group';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'service_categories.description';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'service_categories.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'service_categories.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'IdServiceGroup', 'Description', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'idServiceGroup', 'description', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(ServiceCategoriesTableMap::COL_ID, ServiceCategoriesTableMap::COL_ID_SERVICE_GROUP, ServiceCategoriesTableMap::COL_DESCRIPTION, ServiceCategoriesTableMap::COL_CREATED_AT, ServiceCategoriesTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'id_service_group', 'description', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdServiceGroup' => 1, 'Description' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idServiceGroup' => 1, 'description' => 2, 'createdAt' => 3, 'updatedAt' => 4, ),
        self::TYPE_COLNAME       => array(ServiceCategoriesTableMap::COL_ID => 0, ServiceCategoriesTableMap::COL_ID_SERVICE_GROUP => 1, ServiceCategoriesTableMap::COL_DESCRIPTION => 2, ServiceCategoriesTableMap::COL_CREATED_AT => 3, ServiceCategoriesTableMap::COL_UPDATED_AT => 4, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_service_group' => 1, 'description' => 2, 'created_at' => 3, 'updated_at' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'ServiceCategories.Id' => 'ID',
        'id' => 'ID',
        'serviceCategories.id' => 'ID',
        'ServiceCategoriesTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'service_categories.id' => 'ID',
        'IdServiceGroup' => 'ID_SERVICE_GROUP',
        'ServiceCategories.IdServiceGroup' => 'ID_SERVICE_GROUP',
        'idServiceGroup' => 'ID_SERVICE_GROUP',
        'serviceCategories.idServiceGroup' => 'ID_SERVICE_GROUP',
        'ServiceCategoriesTableMap::COL_ID_SERVICE_GROUP' => 'ID_SERVICE_GROUP',
        'COL_ID_SERVICE_GROUP' => 'ID_SERVICE_GROUP',
        'id_service_group' => 'ID_SERVICE_GROUP',
        'service_categories.id_service_group' => 'ID_SERVICE_GROUP',
        'Description' => 'DESCRIPTION',
        'ServiceCategories.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'serviceCategories.description' => 'DESCRIPTION',
        'ServiceCategoriesTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'service_categories.description' => 'DESCRIPTION',
        'CreatedAt' => 'CREATED_AT',
        'ServiceCategories.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'serviceCategories.createdAt' => 'CREATED_AT',
        'ServiceCategoriesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'service_categories.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'ServiceCategories.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'serviceCategories.updatedAt' => 'UPDATED_AT',
        'ServiceCategoriesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'service_categories.updated_at' => 'UPDATED_AT',
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
        $this->setName('service_categories');
        $this->setPhpName('ServiceCategories');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\ServiceCategories');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 10, null);
        $this->addForeignKey('id_service_group', 'IdServiceGroup', 'INTEGER', 'service_groups', 'id', false, 10, null);
        $this->addColumn('description', 'Description', 'VARCHAR', true, 191, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('ServiceGroups', '\\ServiceGroups', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_service_group',
    1 => ':id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('Services', '\\Services', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_service_category',
    1 => ':id',
  ),
), null, 'CASCADE', 'Servicess', false);
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
        return $withPrefix ? ServiceCategoriesTableMap::CLASS_DEFAULT : ServiceCategoriesTableMap::OM_CLASS;
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
     * @return array           (ServiceCategories object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ServiceCategoriesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ServiceCategoriesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ServiceCategoriesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ServiceCategoriesTableMap::OM_CLASS;
            /** @var ServiceCategories $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ServiceCategoriesTableMap::addInstanceToPool($obj, $key);
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
            $key = ServiceCategoriesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ServiceCategoriesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ServiceCategories $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ServiceCategoriesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ServiceCategoriesTableMap::COL_ID);
            $criteria->addSelectColumn(ServiceCategoriesTableMap::COL_ID_SERVICE_GROUP);
            $criteria->addSelectColumn(ServiceCategoriesTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(ServiceCategoriesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ServiceCategoriesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_service_group');
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
            $criteria->removeSelectColumn(ServiceCategoriesTableMap::COL_ID);
            $criteria->removeSelectColumn(ServiceCategoriesTableMap::COL_ID_SERVICE_GROUP);
            $criteria->removeSelectColumn(ServiceCategoriesTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(ServiceCategoriesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(ServiceCategoriesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.id_service_group');
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
        return Propel::getServiceContainer()->getDatabaseMap(ServiceCategoriesTableMap::DATABASE_NAME)->getTable(ServiceCategoriesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ServiceCategories or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ServiceCategories object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ServiceCategoriesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \ServiceCategories) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ServiceCategoriesTableMap::DATABASE_NAME);
            $criteria->add(ServiceCategoriesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ServiceCategoriesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ServiceCategoriesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ServiceCategoriesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the service_categories table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ServiceCategoriesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ServiceCategories or Criteria object.
     *
     * @param mixed               $criteria Criteria or ServiceCategories object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ServiceCategoriesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ServiceCategories object
        }

        if ($criteria->containsKey(ServiceCategoriesTableMap::COL_ID) && $criteria->keyContainsValue(ServiceCategoriesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ServiceCategoriesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ServiceCategoriesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ServiceCategoriesTableMap
