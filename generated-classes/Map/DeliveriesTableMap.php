<?php

namespace Map;

use \Deliveries;
use \DeliveriesQuery;
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
 * This class defines the structure of the 'deliveries' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class DeliveriesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.DeliveriesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'golden_clean';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'deliveries';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Deliveries';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Deliveries';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 15;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 15;

    /**
     * the column name for the id field
     */
    const COL_ID = 'deliveries.id';

    /**
     * the column name for the id_order field
     */
    const COL_ID_ORDER = 'deliveries.id_order';

    /**
     * the column name for the id_assigned_user field
     */
    const COL_ID_ASSIGNED_USER = 'deliveries.id_assigned_user';

    /**
     * the column name for the day_delivery field
     */
    const COL_DAY_DELIVERY = 'deliveries.day_delivery';

    /**
     * the column name for the time_delivery field
     */
    const COL_TIME_DELIVERY = 'deliveries.time_delivery';

    /**
     * the column name for the real_delivery_date field
     */
    const COL_REAL_DELIVERY_DATE = 'deliveries.real_delivery_date';

    /**
     * the column name for the real_delivery_time field
     */
    const COL_REAL_DELIVERY_TIME = 'deliveries.real_delivery_time';

    /**
     * the column name for the status field
     */
    const COL_STATUS = 'deliveries.status';

    /**
     * the column name for the comments field
     */
    const COL_COMMENTS = 'deliveries.comments';

    /**
     * the column name for the delivery_comments field
     */
    const COL_DELIVERY_COMMENTS = 'deliveries.delivery_comments';

    /**
     * the column name for the delivery_contact_name field
     */
    const COL_DELIVERY_CONTACT_NAME = 'deliveries.delivery_contact_name';

    /**
     * the column name for the delivery_contact_signature field
     */
    const COL_DELIVERY_CONTACT_SIGNATURE = 'deliveries.delivery_contact_signature';

    /**
     * the column name for the delivery_photo field
     */
    const COL_DELIVERY_PHOTO = 'deliveries.delivery_photo';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'deliveries.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'deliveries.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'IdOrder', 'IdAssignedUser', 'DayDelivery', 'TimeDelivery', 'RealDeliveryDate', 'RealDeliveryTime', 'Status', 'Comments', 'DeliveryComments', 'DeliveryContactName', 'DeliveryContactSignature', 'DeliveryPhoto', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'idOrder', 'idAssignedUser', 'dayDelivery', 'timeDelivery', 'realDeliveryDate', 'realDeliveryTime', 'status', 'comments', 'deliveryComments', 'deliveryContactName', 'deliveryContactSignature', 'deliveryPhoto', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(DeliveriesTableMap::COL_ID, DeliveriesTableMap::COL_ID_ORDER, DeliveriesTableMap::COL_ID_ASSIGNED_USER, DeliveriesTableMap::COL_DAY_DELIVERY, DeliveriesTableMap::COL_TIME_DELIVERY, DeliveriesTableMap::COL_REAL_DELIVERY_DATE, DeliveriesTableMap::COL_REAL_DELIVERY_TIME, DeliveriesTableMap::COL_STATUS, DeliveriesTableMap::COL_COMMENTS, DeliveriesTableMap::COL_DELIVERY_COMMENTS, DeliveriesTableMap::COL_DELIVERY_CONTACT_NAME, DeliveriesTableMap::COL_DELIVERY_CONTACT_SIGNATURE, DeliveriesTableMap::COL_DELIVERY_PHOTO, DeliveriesTableMap::COL_CREATED_AT, DeliveriesTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'id_order', 'id_assigned_user', 'day_delivery', 'time_delivery', 'real_delivery_date', 'real_delivery_time', 'status', 'comments', 'delivery_comments', 'delivery_contact_name', 'delivery_contact_signature', 'delivery_photo', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdOrder' => 1, 'IdAssignedUser' => 2, 'DayDelivery' => 3, 'TimeDelivery' => 4, 'RealDeliveryDate' => 5, 'RealDeliveryTime' => 6, 'Status' => 7, 'Comments' => 8, 'DeliveryComments' => 9, 'DeliveryContactName' => 10, 'DeliveryContactSignature' => 11, 'DeliveryPhoto' => 12, 'CreatedAt' => 13, 'UpdatedAt' => 14, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idOrder' => 1, 'idAssignedUser' => 2, 'dayDelivery' => 3, 'timeDelivery' => 4, 'realDeliveryDate' => 5, 'realDeliveryTime' => 6, 'status' => 7, 'comments' => 8, 'deliveryComments' => 9, 'deliveryContactName' => 10, 'deliveryContactSignature' => 11, 'deliveryPhoto' => 12, 'createdAt' => 13, 'updatedAt' => 14, ),
        self::TYPE_COLNAME       => array(DeliveriesTableMap::COL_ID => 0, DeliveriesTableMap::COL_ID_ORDER => 1, DeliveriesTableMap::COL_ID_ASSIGNED_USER => 2, DeliveriesTableMap::COL_DAY_DELIVERY => 3, DeliveriesTableMap::COL_TIME_DELIVERY => 4, DeliveriesTableMap::COL_REAL_DELIVERY_DATE => 5, DeliveriesTableMap::COL_REAL_DELIVERY_TIME => 6, DeliveriesTableMap::COL_STATUS => 7, DeliveriesTableMap::COL_COMMENTS => 8, DeliveriesTableMap::COL_DELIVERY_COMMENTS => 9, DeliveriesTableMap::COL_DELIVERY_CONTACT_NAME => 10, DeliveriesTableMap::COL_DELIVERY_CONTACT_SIGNATURE => 11, DeliveriesTableMap::COL_DELIVERY_PHOTO => 12, DeliveriesTableMap::COL_CREATED_AT => 13, DeliveriesTableMap::COL_UPDATED_AT => 14, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_order' => 1, 'id_assigned_user' => 2, 'day_delivery' => 3, 'time_delivery' => 4, 'real_delivery_date' => 5, 'real_delivery_time' => 6, 'status' => 7, 'comments' => 8, 'delivery_comments' => 9, 'delivery_contact_name' => 10, 'delivery_contact_signature' => 11, 'delivery_photo' => 12, 'created_at' => 13, 'updated_at' => 14, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Deliveries.Id' => 'ID',
        'id' => 'ID',
        'deliveries.id' => 'ID',
        'DeliveriesTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'IdOrder' => 'ID_ORDER',
        'Deliveries.IdOrder' => 'ID_ORDER',
        'idOrder' => 'ID_ORDER',
        'deliveries.idOrder' => 'ID_ORDER',
        'DeliveriesTableMap::COL_ID_ORDER' => 'ID_ORDER',
        'COL_ID_ORDER' => 'ID_ORDER',
        'id_order' => 'ID_ORDER',
        'deliveries.id_order' => 'ID_ORDER',
        'IdAssignedUser' => 'ID_ASSIGNED_USER',
        'Deliveries.IdAssignedUser' => 'ID_ASSIGNED_USER',
        'idAssignedUser' => 'ID_ASSIGNED_USER',
        'deliveries.idAssignedUser' => 'ID_ASSIGNED_USER',
        'DeliveriesTableMap::COL_ID_ASSIGNED_USER' => 'ID_ASSIGNED_USER',
        'COL_ID_ASSIGNED_USER' => 'ID_ASSIGNED_USER',
        'id_assigned_user' => 'ID_ASSIGNED_USER',
        'deliveries.id_assigned_user' => 'ID_ASSIGNED_USER',
        'DayDelivery' => 'DAY_DELIVERY',
        'Deliveries.DayDelivery' => 'DAY_DELIVERY',
        'dayDelivery' => 'DAY_DELIVERY',
        'deliveries.dayDelivery' => 'DAY_DELIVERY',
        'DeliveriesTableMap::COL_DAY_DELIVERY' => 'DAY_DELIVERY',
        'COL_DAY_DELIVERY' => 'DAY_DELIVERY',
        'day_delivery' => 'DAY_DELIVERY',
        'deliveries.day_delivery' => 'DAY_DELIVERY',
        'TimeDelivery' => 'TIME_DELIVERY',
        'Deliveries.TimeDelivery' => 'TIME_DELIVERY',
        'timeDelivery' => 'TIME_DELIVERY',
        'deliveries.timeDelivery' => 'TIME_DELIVERY',
        'DeliveriesTableMap::COL_TIME_DELIVERY' => 'TIME_DELIVERY',
        'COL_TIME_DELIVERY' => 'TIME_DELIVERY',
        'time_delivery' => 'TIME_DELIVERY',
        'deliveries.time_delivery' => 'TIME_DELIVERY',
        'RealDeliveryDate' => 'REAL_DELIVERY_DATE',
        'Deliveries.RealDeliveryDate' => 'REAL_DELIVERY_DATE',
        'realDeliveryDate' => 'REAL_DELIVERY_DATE',
        'deliveries.realDeliveryDate' => 'REAL_DELIVERY_DATE',
        'DeliveriesTableMap::COL_REAL_DELIVERY_DATE' => 'REAL_DELIVERY_DATE',
        'COL_REAL_DELIVERY_DATE' => 'REAL_DELIVERY_DATE',
        'real_delivery_date' => 'REAL_DELIVERY_DATE',
        'deliveries.real_delivery_date' => 'REAL_DELIVERY_DATE',
        'RealDeliveryTime' => 'REAL_DELIVERY_TIME',
        'Deliveries.RealDeliveryTime' => 'REAL_DELIVERY_TIME',
        'realDeliveryTime' => 'REAL_DELIVERY_TIME',
        'deliveries.realDeliveryTime' => 'REAL_DELIVERY_TIME',
        'DeliveriesTableMap::COL_REAL_DELIVERY_TIME' => 'REAL_DELIVERY_TIME',
        'COL_REAL_DELIVERY_TIME' => 'REAL_DELIVERY_TIME',
        'real_delivery_time' => 'REAL_DELIVERY_TIME',
        'deliveries.real_delivery_time' => 'REAL_DELIVERY_TIME',
        'Status' => 'STATUS',
        'Deliveries.Status' => 'STATUS',
        'status' => 'STATUS',
        'deliveries.status' => 'STATUS',
        'DeliveriesTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'Comments' => 'COMMENTS',
        'Deliveries.Comments' => 'COMMENTS',
        'comments' => 'COMMENTS',
        'deliveries.comments' => 'COMMENTS',
        'DeliveriesTableMap::COL_COMMENTS' => 'COMMENTS',
        'COL_COMMENTS' => 'COMMENTS',
        'DeliveryComments' => 'DELIVERY_COMMENTS',
        'Deliveries.DeliveryComments' => 'DELIVERY_COMMENTS',
        'deliveryComments' => 'DELIVERY_COMMENTS',
        'deliveries.deliveryComments' => 'DELIVERY_COMMENTS',
        'DeliveriesTableMap::COL_DELIVERY_COMMENTS' => 'DELIVERY_COMMENTS',
        'COL_DELIVERY_COMMENTS' => 'DELIVERY_COMMENTS',
        'delivery_comments' => 'DELIVERY_COMMENTS',
        'deliveries.delivery_comments' => 'DELIVERY_COMMENTS',
        'DeliveryContactName' => 'DELIVERY_CONTACT_NAME',
        'Deliveries.DeliveryContactName' => 'DELIVERY_CONTACT_NAME',
        'deliveryContactName' => 'DELIVERY_CONTACT_NAME',
        'deliveries.deliveryContactName' => 'DELIVERY_CONTACT_NAME',
        'DeliveriesTableMap::COL_DELIVERY_CONTACT_NAME' => 'DELIVERY_CONTACT_NAME',
        'COL_DELIVERY_CONTACT_NAME' => 'DELIVERY_CONTACT_NAME',
        'delivery_contact_name' => 'DELIVERY_CONTACT_NAME',
        'deliveries.delivery_contact_name' => 'DELIVERY_CONTACT_NAME',
        'DeliveryContactSignature' => 'DELIVERY_CONTACT_SIGNATURE',
        'Deliveries.DeliveryContactSignature' => 'DELIVERY_CONTACT_SIGNATURE',
        'deliveryContactSignature' => 'DELIVERY_CONTACT_SIGNATURE',
        'deliveries.deliveryContactSignature' => 'DELIVERY_CONTACT_SIGNATURE',
        'DeliveriesTableMap::COL_DELIVERY_CONTACT_SIGNATURE' => 'DELIVERY_CONTACT_SIGNATURE',
        'COL_DELIVERY_CONTACT_SIGNATURE' => 'DELIVERY_CONTACT_SIGNATURE',
        'delivery_contact_signature' => 'DELIVERY_CONTACT_SIGNATURE',
        'deliveries.delivery_contact_signature' => 'DELIVERY_CONTACT_SIGNATURE',
        'DeliveryPhoto' => 'DELIVERY_PHOTO',
        'Deliveries.DeliveryPhoto' => 'DELIVERY_PHOTO',
        'deliveryPhoto' => 'DELIVERY_PHOTO',
        'deliveries.deliveryPhoto' => 'DELIVERY_PHOTO',
        'DeliveriesTableMap::COL_DELIVERY_PHOTO' => 'DELIVERY_PHOTO',
        'COL_DELIVERY_PHOTO' => 'DELIVERY_PHOTO',
        'delivery_photo' => 'DELIVERY_PHOTO',
        'deliveries.delivery_photo' => 'DELIVERY_PHOTO',
        'CreatedAt' => 'CREATED_AT',
        'Deliveries.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'deliveries.createdAt' => 'CREATED_AT',
        'DeliveriesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'deliveries.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Deliveries.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'deliveries.updatedAt' => 'UPDATED_AT',
        'DeliveriesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'deliveries.updated_at' => 'UPDATED_AT',
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
        $this->setName('deliveries');
        $this->setPhpName('Deliveries');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Deliveries');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 10, null);
        $this->addForeignKey('id_order', 'IdOrder', 'INTEGER', 'orders', 'id', true, 10, null);
        $this->addForeignKey('id_assigned_user', 'IdAssignedUser', 'INTEGER', 'users', 'id', true, 10, null);
        $this->addForeignKey('day_delivery', 'DayDelivery', 'DATE', 'calendar', 'day', true, null, null);
        $this->addColumn('time_delivery', 'TimeDelivery', 'TIME', false, null, null);
        $this->addColumn('real_delivery_date', 'RealDeliveryDate', 'DATE', false, null, null);
        $this->addColumn('real_delivery_time', 'RealDeliveryTime', 'TIME', false, null, null);
        $this->addColumn('status', 'Status', 'INTEGER', true, 10, 0);
        $this->addColumn('comments', 'Comments', 'VARCHAR', true, 191, '');
        $this->addColumn('delivery_comments', 'DeliveryComments', 'VARCHAR', true, 1000, '');
        $this->addColumn('delivery_contact_name', 'DeliveryContactName', 'VARCHAR', true, 191, '');
        $this->addColumn('delivery_contact_signature', 'DeliveryContactSignature', 'LONGVARCHAR', true, null, null);
        $this->addColumn('delivery_photo', 'DeliveryPhoto', 'LONGVARCHAR', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Calendar', '\\Calendar', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':day_delivery',
    1 => ':day',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('Users', '\\Users', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_assigned_user',
    1 => ':id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('Orders', '\\Orders', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_order',
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
        return $withPrefix ? DeliveriesTableMap::CLASS_DEFAULT : DeliveriesTableMap::OM_CLASS;
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
     * @return array           (Deliveries object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = DeliveriesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DeliveriesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DeliveriesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DeliveriesTableMap::OM_CLASS;
            /** @var Deliveries $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DeliveriesTableMap::addInstanceToPool($obj, $key);
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
            $key = DeliveriesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DeliveriesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Deliveries $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DeliveriesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(DeliveriesTableMap::COL_ID);
            $criteria->addSelectColumn(DeliveriesTableMap::COL_ID_ORDER);
            $criteria->addSelectColumn(DeliveriesTableMap::COL_ID_ASSIGNED_USER);
            $criteria->addSelectColumn(DeliveriesTableMap::COL_DAY_DELIVERY);
            $criteria->addSelectColumn(DeliveriesTableMap::COL_TIME_DELIVERY);
            $criteria->addSelectColumn(DeliveriesTableMap::COL_REAL_DELIVERY_DATE);
            $criteria->addSelectColumn(DeliveriesTableMap::COL_REAL_DELIVERY_TIME);
            $criteria->addSelectColumn(DeliveriesTableMap::COL_STATUS);
            $criteria->addSelectColumn(DeliveriesTableMap::COL_COMMENTS);
            $criteria->addSelectColumn(DeliveriesTableMap::COL_DELIVERY_COMMENTS);
            $criteria->addSelectColumn(DeliveriesTableMap::COL_DELIVERY_CONTACT_NAME);
            $criteria->addSelectColumn(DeliveriesTableMap::COL_DELIVERY_CONTACT_SIGNATURE);
            $criteria->addSelectColumn(DeliveriesTableMap::COL_DELIVERY_PHOTO);
            $criteria->addSelectColumn(DeliveriesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(DeliveriesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_order');
            $criteria->addSelectColumn($alias . '.id_assigned_user');
            $criteria->addSelectColumn($alias . '.day_delivery');
            $criteria->addSelectColumn($alias . '.time_delivery');
            $criteria->addSelectColumn($alias . '.real_delivery_date');
            $criteria->addSelectColumn($alias . '.real_delivery_time');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.comments');
            $criteria->addSelectColumn($alias . '.delivery_comments');
            $criteria->addSelectColumn($alias . '.delivery_contact_name');
            $criteria->addSelectColumn($alias . '.delivery_contact_signature');
            $criteria->addSelectColumn($alias . '.delivery_photo');
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
            $criteria->removeSelectColumn(DeliveriesTableMap::COL_ID);
            $criteria->removeSelectColumn(DeliveriesTableMap::COL_ID_ORDER);
            $criteria->removeSelectColumn(DeliveriesTableMap::COL_ID_ASSIGNED_USER);
            $criteria->removeSelectColumn(DeliveriesTableMap::COL_DAY_DELIVERY);
            $criteria->removeSelectColumn(DeliveriesTableMap::COL_TIME_DELIVERY);
            $criteria->removeSelectColumn(DeliveriesTableMap::COL_REAL_DELIVERY_DATE);
            $criteria->removeSelectColumn(DeliveriesTableMap::COL_REAL_DELIVERY_TIME);
            $criteria->removeSelectColumn(DeliveriesTableMap::COL_STATUS);
            $criteria->removeSelectColumn(DeliveriesTableMap::COL_COMMENTS);
            $criteria->removeSelectColumn(DeliveriesTableMap::COL_DELIVERY_COMMENTS);
            $criteria->removeSelectColumn(DeliveriesTableMap::COL_DELIVERY_CONTACT_NAME);
            $criteria->removeSelectColumn(DeliveriesTableMap::COL_DELIVERY_CONTACT_SIGNATURE);
            $criteria->removeSelectColumn(DeliveriesTableMap::COL_DELIVERY_PHOTO);
            $criteria->removeSelectColumn(DeliveriesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(DeliveriesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.id_order');
            $criteria->removeSelectColumn($alias . '.id_assigned_user');
            $criteria->removeSelectColumn($alias . '.day_delivery');
            $criteria->removeSelectColumn($alias . '.time_delivery');
            $criteria->removeSelectColumn($alias . '.real_delivery_date');
            $criteria->removeSelectColumn($alias . '.real_delivery_time');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.comments');
            $criteria->removeSelectColumn($alias . '.delivery_comments');
            $criteria->removeSelectColumn($alias . '.delivery_contact_name');
            $criteria->removeSelectColumn($alias . '.delivery_contact_signature');
            $criteria->removeSelectColumn($alias . '.delivery_photo');
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
        return Propel::getServiceContainer()->getDatabaseMap(DeliveriesTableMap::DATABASE_NAME)->getTable(DeliveriesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Deliveries or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Deliveries object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveriesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Deliveries) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DeliveriesTableMap::DATABASE_NAME);
            $criteria->add(DeliveriesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = DeliveriesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DeliveriesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DeliveriesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the deliveries table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return DeliveriesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Deliveries or Criteria object.
     *
     * @param mixed               $criteria Criteria or Deliveries object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveriesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Deliveries object
        }

        if ($criteria->containsKey(DeliveriesTableMap::COL_ID) && $criteria->keyContainsValue(DeliveriesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DeliveriesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = DeliveriesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // DeliveriesTableMap
