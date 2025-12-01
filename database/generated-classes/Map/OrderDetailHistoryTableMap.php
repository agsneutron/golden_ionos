<?php

namespace Map;

use \OrderDetailHistory;
use \OrderDetailHistoryQuery;
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
 * This class defines the structure of the 'order_detail_history' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OrderDetailHistoryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.OrderDetailHistoryTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'golden_clean';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'order_detail_history';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\OrderDetailHistory';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'OrderDetailHistory';

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
    const COL_ID = 'order_detail_history.id';

    /**
     * the column name for the id_order_detail field
     */
    const COL_ID_ORDER_DETAIL = 'order_detail_history.id_order_detail';

    /**
     * the column name for the id_order_detail_status field
     */
    const COL_ID_ORDER_DETAIL_STATUS = 'order_detail_history.id_order_detail_status';

    /**
     * the column name for the id_user field
     */
    const COL_ID_USER = 'order_detail_history.id_user';

    /**
     * the column name for the image field
     */
    const COL_IMAGE = 'order_detail_history.image';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'order_detail_history.description';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'order_detail_history.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'order_detail_history.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'IdOrderDetail', 'IdOrderDetailStatus', 'IdUser', 'Image', 'Description', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'idOrderDetail', 'idOrderDetailStatus', 'idUser', 'image', 'description', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(OrderDetailHistoryTableMap::COL_ID, OrderDetailHistoryTableMap::COL_ID_ORDER_DETAIL, OrderDetailHistoryTableMap::COL_ID_ORDER_DETAIL_STATUS, OrderDetailHistoryTableMap::COL_ID_USER, OrderDetailHistoryTableMap::COL_IMAGE, OrderDetailHistoryTableMap::COL_DESCRIPTION, OrderDetailHistoryTableMap::COL_CREATED_AT, OrderDetailHistoryTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'id_order_detail', 'id_order_detail_status', 'id_user', 'image', 'description', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdOrderDetail' => 1, 'IdOrderDetailStatus' => 2, 'IdUser' => 3, 'Image' => 4, 'Description' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idOrderDetail' => 1, 'idOrderDetailStatus' => 2, 'idUser' => 3, 'image' => 4, 'description' => 5, 'createdAt' => 6, 'updatedAt' => 7, ),
        self::TYPE_COLNAME       => array(OrderDetailHistoryTableMap::COL_ID => 0, OrderDetailHistoryTableMap::COL_ID_ORDER_DETAIL => 1, OrderDetailHistoryTableMap::COL_ID_ORDER_DETAIL_STATUS => 2, OrderDetailHistoryTableMap::COL_ID_USER => 3, OrderDetailHistoryTableMap::COL_IMAGE => 4, OrderDetailHistoryTableMap::COL_DESCRIPTION => 5, OrderDetailHistoryTableMap::COL_CREATED_AT => 6, OrderDetailHistoryTableMap::COL_UPDATED_AT => 7, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_order_detail' => 1, 'id_order_detail_status' => 2, 'id_user' => 3, 'image' => 4, 'description' => 5, 'created_at' => 6, 'updated_at' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'OrderDetailHistory.Id' => 'ID',
        'id' => 'ID',
        'orderDetailHistory.id' => 'ID',
        'OrderDetailHistoryTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'order_detail_history.id' => 'ID',
        'IdOrderDetail' => 'ID_ORDER_DETAIL',
        'OrderDetailHistory.IdOrderDetail' => 'ID_ORDER_DETAIL',
        'idOrderDetail' => 'ID_ORDER_DETAIL',
        'orderDetailHistory.idOrderDetail' => 'ID_ORDER_DETAIL',
        'OrderDetailHistoryTableMap::COL_ID_ORDER_DETAIL' => 'ID_ORDER_DETAIL',
        'COL_ID_ORDER_DETAIL' => 'ID_ORDER_DETAIL',
        'id_order_detail' => 'ID_ORDER_DETAIL',
        'order_detail_history.id_order_detail' => 'ID_ORDER_DETAIL',
        'IdOrderDetailStatus' => 'ID_ORDER_DETAIL_STATUS',
        'OrderDetailHistory.IdOrderDetailStatus' => 'ID_ORDER_DETAIL_STATUS',
        'idOrderDetailStatus' => 'ID_ORDER_DETAIL_STATUS',
        'orderDetailHistory.idOrderDetailStatus' => 'ID_ORDER_DETAIL_STATUS',
        'OrderDetailHistoryTableMap::COL_ID_ORDER_DETAIL_STATUS' => 'ID_ORDER_DETAIL_STATUS',
        'COL_ID_ORDER_DETAIL_STATUS' => 'ID_ORDER_DETAIL_STATUS',
        'id_order_detail_status' => 'ID_ORDER_DETAIL_STATUS',
        'order_detail_history.id_order_detail_status' => 'ID_ORDER_DETAIL_STATUS',
        'IdUser' => 'ID_USER',
        'OrderDetailHistory.IdUser' => 'ID_USER',
        'idUser' => 'ID_USER',
        'orderDetailHistory.idUser' => 'ID_USER',
        'OrderDetailHistoryTableMap::COL_ID_USER' => 'ID_USER',
        'COL_ID_USER' => 'ID_USER',
        'id_user' => 'ID_USER',
        'order_detail_history.id_user' => 'ID_USER',
        'Image' => 'IMAGE',
        'OrderDetailHistory.Image' => 'IMAGE',
        'image' => 'IMAGE',
        'orderDetailHistory.image' => 'IMAGE',
        'OrderDetailHistoryTableMap::COL_IMAGE' => 'IMAGE',
        'COL_IMAGE' => 'IMAGE',
        'order_detail_history.image' => 'IMAGE',
        'Description' => 'DESCRIPTION',
        'OrderDetailHistory.Description' => 'DESCRIPTION',
        'description' => 'DESCRIPTION',
        'orderDetailHistory.description' => 'DESCRIPTION',
        'OrderDetailHistoryTableMap::COL_DESCRIPTION' => 'DESCRIPTION',
        'COL_DESCRIPTION' => 'DESCRIPTION',
        'order_detail_history.description' => 'DESCRIPTION',
        'CreatedAt' => 'CREATED_AT',
        'OrderDetailHistory.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'orderDetailHistory.createdAt' => 'CREATED_AT',
        'OrderDetailHistoryTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'order_detail_history.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OrderDetailHistory.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'orderDetailHistory.updatedAt' => 'UPDATED_AT',
        'OrderDetailHistoryTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'order_detail_history.updated_at' => 'UPDATED_AT',
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
        $this->setName('order_detail_history');
        $this->setPhpName('OrderDetailHistory');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\OrderDetailHistory');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 10, null);
        $this->addForeignKey('id_order_detail', 'IdOrderDetail', 'INTEGER', 'order_detail', 'id', true, 10, null);
        $this->addForeignKey('id_order_detail_status', 'IdOrderDetailStatus', 'INTEGER', 'order_detail_status', 'id', true, 10, null);
        $this->addForeignKey('id_user', 'IdUser', 'INTEGER', 'users', 'id', true, 10, null);
        $this->addColumn('image', 'Image', 'VARCHAR', true, 191, '');
        $this->addColumn('description', 'Description', 'VARCHAR', true, 191, '');
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('OrderDetail', '\\OrderDetail', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_order_detail',
    1 => ':id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('OrderDetailStatus', '\\OrderDetailStatus', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_order_detail_status',
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
        return $withPrefix ? OrderDetailHistoryTableMap::CLASS_DEFAULT : OrderDetailHistoryTableMap::OM_CLASS;
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
     * @return array           (OrderDetailHistory object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = OrderDetailHistoryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OrderDetailHistoryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OrderDetailHistoryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OrderDetailHistoryTableMap::OM_CLASS;
            /** @var OrderDetailHistory $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OrderDetailHistoryTableMap::addInstanceToPool($obj, $key);
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
            $key = OrderDetailHistoryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OrderDetailHistoryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OrderDetailHistory $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OrderDetailHistoryTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OrderDetailHistoryTableMap::COL_ID);
            $criteria->addSelectColumn(OrderDetailHistoryTableMap::COL_ID_ORDER_DETAIL);
            $criteria->addSelectColumn(OrderDetailHistoryTableMap::COL_ID_ORDER_DETAIL_STATUS);
            $criteria->addSelectColumn(OrderDetailHistoryTableMap::COL_ID_USER);
            $criteria->addSelectColumn(OrderDetailHistoryTableMap::COL_IMAGE);
            $criteria->addSelectColumn(OrderDetailHistoryTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(OrderDetailHistoryTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OrderDetailHistoryTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_order_detail');
            $criteria->addSelectColumn($alias . '.id_order_detail_status');
            $criteria->addSelectColumn($alias . '.id_user');
            $criteria->addSelectColumn($alias . '.image');
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
            $criteria->removeSelectColumn(OrderDetailHistoryTableMap::COL_ID);
            $criteria->removeSelectColumn(OrderDetailHistoryTableMap::COL_ID_ORDER_DETAIL);
            $criteria->removeSelectColumn(OrderDetailHistoryTableMap::COL_ID_ORDER_DETAIL_STATUS);
            $criteria->removeSelectColumn(OrderDetailHistoryTableMap::COL_ID_USER);
            $criteria->removeSelectColumn(OrderDetailHistoryTableMap::COL_IMAGE);
            $criteria->removeSelectColumn(OrderDetailHistoryTableMap::COL_DESCRIPTION);
            $criteria->removeSelectColumn(OrderDetailHistoryTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OrderDetailHistoryTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.id_order_detail');
            $criteria->removeSelectColumn($alias . '.id_order_detail_status');
            $criteria->removeSelectColumn($alias . '.id_user');
            $criteria->removeSelectColumn($alias . '.image');
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
        return Propel::getServiceContainer()->getDatabaseMap(OrderDetailHistoryTableMap::DATABASE_NAME)->getTable(OrderDetailHistoryTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OrderDetailHistory or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or OrderDetailHistory object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OrderDetailHistoryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \OrderDetailHistory) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OrderDetailHistoryTableMap::DATABASE_NAME);
            $criteria->add(OrderDetailHistoryTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = OrderDetailHistoryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OrderDetailHistoryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OrderDetailHistoryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the order_detail_history table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return OrderDetailHistoryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OrderDetailHistory or Criteria object.
     *
     * @param mixed               $criteria Criteria or OrderDetailHistory object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderDetailHistoryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OrderDetailHistory object
        }

        if ($criteria->containsKey(OrderDetailHistoryTableMap::COL_ID) && $criteria->keyContainsValue(OrderDetailHistoryTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OrderDetailHistoryTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = OrderDetailHistoryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // OrderDetailHistoryTableMap
