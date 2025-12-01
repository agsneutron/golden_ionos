<?php

namespace Map;

use \OrderDetailStatus;
use \OrderDetailStatusQuery;
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
 * This class defines the structure of the 'order_detail_status' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OrderDetailStatusTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.OrderDetailStatusTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'golden_clean';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'order_detail_status';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\OrderDetailStatus';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'OrderDetailStatus';

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
    const COL_ID = 'order_detail_status.id';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'order_detail_status.description';

    /**
     * the column name for the color field
     */
    const COL_COLOR = 'order_detail_status.color';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'order_detail_status.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'order_detail_status.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'Description', 'Color', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'description', 'color', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(OrderDetailStatusTableMap::COL_ID, OrderDetailStatusTableMap::COL_DESCRIPTION, OrderDetailStatusTableMap::COL_COLOR, OrderDetailStatusTableMap::COL_CREATED_AT, OrderDetailStatusTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'description', 'color', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Description' => 1, 'Color' => 2, 'CreatedAt' => 3, 'UpdatedAt' => 4, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'description' => 1, 'color' => 2, 'createdAt' => 3, 'updatedAt' => 4, ),
        self::TYPE_COLNAME       => array(OrderDetailStatusTableMap::COL_ID => 0, OrderDetailStatusTableMap::COL_DESCRIPTION => 1, OrderDetailStatusTableMap::COL_COLOR => 2, OrderDetailStatusTableMap::COL_CREATED_AT => 3, OrderDetailStatusTableMap::COL_UPDATED_AT => 4, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'description' => 1, 'color' => 2, 'created_at' => 3, 'updated_at' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'OrderDetailStatus.Id' => 'ID',
        'id' => 'ID',
        'orderDetailStatus.id' => 'ID',
        'OrderDetailStatusTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'order_detail_status.id' => 'ID',
        'Description' => 'DESCRIPTION',
        'OrderDetailStatus.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'orderDetailStatus.description' => 'DESCRIPTION',
        'OrderDetailStatusTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'order_detail_status.description' => 'DESCRIPTION',
        'Color' => 'COLOR',
        'OrderDetailStatus.Color' => 'COLOR',
        'color' => 'COLOR',
        'orderDetailStatus.color' => 'COLOR',
        'OrderDetailStatusTableMap::COL_COLOR' => 'COLOR',
        'COL_COLOR' => 'COLOR',
        'order_detail_status.color' => 'COLOR',
        'CreatedAt' => 'CREATED_AT',
        'OrderDetailStatus.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'orderDetailStatus.createdAt' => 'CREATED_AT',
        'OrderDetailStatusTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'order_detail_status.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OrderDetailStatus.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'orderDetailStatus.updatedAt' => 'UPDATED_AT',
        'OrderDetailStatusTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'order_detail_status.updated_at' => 'UPDATED_AT',
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
        $this->setName('order_detail_status');
        $this->setPhpName('OrderDetailStatus');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\OrderDetailStatus');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 10, null);
        $this->addColumn('description', 'Description', 'VARCHAR', true, 191, null);
        $this->addColumn('color', 'Color', 'VARCHAR', true, 191, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('OrderDetail', '\\OrderDetail', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_order_detail_status',
    1 => ':id',
  ),
), null, 'CASCADE', 'OrderDetails', false);
        $this->addRelation('OrderDetailHistory', '\\OrderDetailHistory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_order_detail_status',
    1 => ':id',
  ),
), null, 'CASCADE', 'OrderDetailHistories', false);
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
        return $withPrefix ? OrderDetailStatusTableMap::CLASS_DEFAULT : OrderDetailStatusTableMap::OM_CLASS;
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
     * @return array           (OrderDetailStatus object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = OrderDetailStatusTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OrderDetailStatusTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OrderDetailStatusTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OrderDetailStatusTableMap::OM_CLASS;
            /** @var OrderDetailStatus $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OrderDetailStatusTableMap::addInstanceToPool($obj, $key);
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
            $key = OrderDetailStatusTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OrderDetailStatusTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OrderDetailStatus $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OrderDetailStatusTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OrderDetailStatusTableMap::COL_ID);
            $criteria->addSelectColumn(OrderDetailStatusTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(OrderDetailStatusTableMap::COL_COLOR);
            $criteria->addSelectColumn(OrderDetailStatusTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OrderDetailStatusTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.color');
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
            $criteria->removeSelectColumn(OrderDetailStatusTableMap::COL_ID);
            $criteria->removeSelectColumn(OrderDetailStatusTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(OrderDetailStatusTableMap::COL_COLOR);
            $criteria->removeSelectColumn(OrderDetailStatusTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OrderDetailStatusTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.description');
            $criteria->removeSelectColumn($alias . '.color');
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
        return Propel::getServiceContainer()->getDatabaseMap(OrderDetailStatusTableMap::DATABASE_NAME)->getTable(OrderDetailStatusTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OrderDetailStatus or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or OrderDetailStatus object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OrderDetailStatusTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \OrderDetailStatus) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OrderDetailStatusTableMap::DATABASE_NAME);
            $criteria->add(OrderDetailStatusTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = OrderDetailStatusQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OrderDetailStatusTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OrderDetailStatusTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the order_detail_status table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return OrderDetailStatusQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OrderDetailStatus or Criteria object.
     *
     * @param mixed               $criteria Criteria or OrderDetailStatus object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderDetailStatusTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OrderDetailStatus object
        }

        if ($criteria->containsKey(OrderDetailStatusTableMap::COL_ID) && $criteria->keyContainsValue(OrderDetailStatusTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OrderDetailStatusTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = OrderDetailStatusQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // OrderDetailStatusTableMap
