<?php

namespace Map;

use \Pickups;
use \PickupsQuery;
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
 * This class defines the structure of the 'pickups' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PickupsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.PickupsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'golden_clean';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'pickups';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Pickups';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Pickups';

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
    const COL_ID = 'pickups.id';

    /**
     * the column name for the id_order field
     */
    const COL_ID_ORDER = 'pickups.id_order';

    /**
     * the column name for the id_assigned_user field
     */
    const COL_ID_ASSIGNED_USER = 'pickups.id_assigned_user';

    /**
     * the column name for the day_pickup field
     */
    const COL_DAY_PICKUP = 'pickups.day_pickup';

    /**
     * the column name for the time_pickup field
     */
    const COL_TIME_PICKUP = 'pickups.time_pickup';

    /**
     * the column name for the real_pickup_date field
     */
    const COL_REAL_PICKUP_DATE = 'pickups.real_pickup_date';

    /**
     * the column name for the real_pickup_time field
     */
    const COL_REAL_PICKUP_TIME = 'pickups.real_pickup_time';

    /**
     * the column name for the status field
     */
    const COL_STATUS = 'pickups.status';

    /**
     * the column name for the comments field
     */
    const COL_COMMENTS = 'pickups.comments';

    /**
     * the column name for the harvest_comments field
     */
    const COL_HARVEST_COMMENTS = 'pickups.harvest_comments';

    /**
     * the column name for the harvest_contact_name field
     */
    const COL_HARVEST_CONTACT_NAME = 'pickups.harvest_contact_name';

    /**
     * the column name for the harvest_contact_signature field
     */
    const COL_HARVEST_CONTACT_SIGNATURE = 'pickups.harvest_contact_signature';

    /**
     * the column name for the harvest_photo field
     */
    const COL_HARVEST_PHOTO = 'pickups.harvest_photo';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'pickups.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'pickups.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'IdOrder', 'IdAssignedUser', 'DayPickup', 'TimePickup', 'RealPickupDate', 'RealPickupTime', 'Status', 'Comments', 'HarvestComments', 'HarvestContactName', 'HarvestContactSignature', 'HarvestPhoto', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'idOrder', 'idAssignedUser', 'dayPickup', 'timePickup', 'realPickupDate', 'realPickupTime', 'status', 'comments', 'harvestComments', 'harvestContactName', 'harvestContactSignature', 'harvestPhoto', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(PickupsTableMap::COL_ID, PickupsTableMap::COL_ID_ORDER, PickupsTableMap::COL_ID_ASSIGNED_USER, PickupsTableMap::COL_DAY_PICKUP, PickupsTableMap::COL_TIME_PICKUP, PickupsTableMap::COL_REAL_PICKUP_DATE, PickupsTableMap::COL_REAL_PICKUP_TIME, PickupsTableMap::COL_STATUS, PickupsTableMap::COL_COMMENTS, PickupsTableMap::COL_HARVEST_COMMENTS, PickupsTableMap::COL_HARVEST_CONTACT_NAME, PickupsTableMap::COL_HARVEST_CONTACT_SIGNATURE, PickupsTableMap::COL_HARVEST_PHOTO, PickupsTableMap::COL_CREATED_AT, PickupsTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'id_order', 'id_assigned_user', 'day_pickup', 'time_pickup', 'real_pickup_date', 'real_pickup_time', 'status', 'comments', 'harvest_comments', 'harvest_contact_name', 'harvest_contact_signature', 'harvest_photo', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdOrder' => 1, 'IdAssignedUser' => 2, 'DayPickup' => 3, 'TimePickup' => 4, 'RealPickupDate' => 5, 'RealPickupTime' => 6, 'Status' => 7, 'Comments' => 8, 'HarvestComments' => 9, 'HarvestContactName' => 10, 'HarvestContactSignature' => 11, 'HarvestPhoto' => 12, 'CreatedAt' => 13, 'UpdatedAt' => 14, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idOrder' => 1, 'idAssignedUser' => 2, 'dayPickup' => 3, 'timePickup' => 4, 'realPickupDate' => 5, 'realPickupTime' => 6, 'status' => 7, 'comments' => 8, 'harvestComments' => 9, 'harvestContactName' => 10, 'harvestContactSignature' => 11, 'harvestPhoto' => 12, 'createdAt' => 13, 'updatedAt' => 14, ),
        self::TYPE_COLNAME       => array(PickupsTableMap::COL_ID => 0, PickupsTableMap::COL_ID_ORDER => 1, PickupsTableMap::COL_ID_ASSIGNED_USER => 2, PickupsTableMap::COL_DAY_PICKUP => 3, PickupsTableMap::COL_TIME_PICKUP => 4, PickupsTableMap::COL_REAL_PICKUP_DATE => 5, PickupsTableMap::COL_REAL_PICKUP_TIME => 6, PickupsTableMap::COL_STATUS => 7, PickupsTableMap::COL_COMMENTS => 8, PickupsTableMap::COL_HARVEST_COMMENTS => 9, PickupsTableMap::COL_HARVEST_CONTACT_NAME => 10, PickupsTableMap::COL_HARVEST_CONTACT_SIGNATURE => 11, PickupsTableMap::COL_HARVEST_PHOTO => 12, PickupsTableMap::COL_CREATED_AT => 13, PickupsTableMap::COL_UPDATED_AT => 14, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_order' => 1, 'id_assigned_user' => 2, 'day_pickup' => 3, 'time_pickup' => 4, 'real_pickup_date' => 5, 'real_pickup_time' => 6, 'status' => 7, 'comments' => 8, 'harvest_comments' => 9, 'harvest_contact_name' => 10, 'harvest_contact_signature' => 11, 'harvest_photo' => 12, 'created_at' => 13, 'updated_at' => 14, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Pickups.Id' => 'ID',
        'id' => 'ID',
        'pickups.id' => 'ID',
        'PickupsTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'IdOrder' => 'ID_ORDER',
        'Pickups.IdOrder' => 'ID_ORDER',
        'idOrder' => 'ID_ORDER',
        'pickups.idOrder' => 'ID_ORDER',
        'PickupsTableMap::COL_ID_ORDER' => 'ID_ORDER',
        'COL_ID_ORDER' => 'ID_ORDER',
        'id_order' => 'ID_ORDER',
        'pickups.id_order' => 'ID_ORDER',
        'IdAssignedUser' => 'ID_ASSIGNED_USER',
        'Pickups.IdAssignedUser' => 'ID_ASSIGNED_USER',
        'idAssignedUser' => 'ID_ASSIGNED_USER',
        'pickups.idAssignedUser' => 'ID_ASSIGNED_USER',
        'PickupsTableMap::COL_ID_ASSIGNED_USER' => 'ID_ASSIGNED_USER',
        'COL_ID_ASSIGNED_USER' => 'ID_ASSIGNED_USER',
        'id_assigned_user' => 'ID_ASSIGNED_USER',
        'pickups.id_assigned_user' => 'ID_ASSIGNED_USER',
        'DayPickup' => 'DAY_PICKUP',
        'Pickups.DayPickup' => 'DAY_PICKUP',
        'dayPickup' => 'DAY_PICKUP',
        'pickups.dayPickup' => 'DAY_PICKUP',
        'PickupsTableMap::COL_DAY_PICKUP' => 'DAY_PICKUP',
        'COL_DAY_PICKUP' => 'DAY_PICKUP',
        'day_pickup' => 'DAY_PICKUP',
        'pickups.day_pickup' => 'DAY_PICKUP',
        'TimePickup' => 'TIME_PICKUP',
        'Pickups.TimePickup' => 'TIME_PICKUP',
        'timePickup' => 'TIME_PICKUP',
        'pickups.timePickup' => 'TIME_PICKUP',
        'PickupsTableMap::COL_TIME_PICKUP' => 'TIME_PICKUP',
        'COL_TIME_PICKUP' => 'TIME_PICKUP',
        'time_pickup' => 'TIME_PICKUP',
        'pickups.time_pickup' => 'TIME_PICKUP',
        'RealPickupDate' => 'REAL_PICKUP_DATE',
        'Pickups.RealPickupDate' => 'REAL_PICKUP_DATE',
        'realPickupDate' => 'REAL_PICKUP_DATE',
        'pickups.realPickupDate' => 'REAL_PICKUP_DATE',
        'PickupsTableMap::COL_REAL_PICKUP_DATE' => 'REAL_PICKUP_DATE',
        'COL_REAL_PICKUP_DATE' => 'REAL_PICKUP_DATE',
        'real_pickup_date' => 'REAL_PICKUP_DATE',
        'pickups.real_pickup_date' => 'REAL_PICKUP_DATE',
        'RealPickupTime' => 'REAL_PICKUP_TIME',
        'Pickups.RealPickupTime' => 'REAL_PICKUP_TIME',
        'realPickupTime' => 'REAL_PICKUP_TIME',
        'pickups.realPickupTime' => 'REAL_PICKUP_TIME',
        'PickupsTableMap::COL_REAL_PICKUP_TIME' => 'REAL_PICKUP_TIME',
        'COL_REAL_PICKUP_TIME' => 'REAL_PICKUP_TIME',
        'real_pickup_time' => 'REAL_PICKUP_TIME',
        'pickups.real_pickup_time' => 'REAL_PICKUP_TIME',
        'Status' => 'STATUS',
        'Pickups.Status' => 'STATUS',
        'status' => 'STATUS',
        'pickups.status' => 'STATUS',
        'PickupsTableMap::COL_STATUS' => 'STATUS',
        'COL_STATUS' => 'STATUS',
        'Comments' => 'COMMENTS',
        'Pickups.Comments' => 'COMMENTS',
        'comments' => 'COMMENTS',
        'pickups.comments' => 'COMMENTS',
        'PickupsTableMap::COL_COMMENTS' => 'COMMENTS',
        'COL_COMMENTS' => 'COMMENTS',
        'HarvestComments' => 'HARVEST_COMMENTS',
        'Pickups.HarvestComments' => 'HARVEST_COMMENTS',
        'harvestComments' => 'HARVEST_COMMENTS',
        'pickups.harvestComments' => 'HARVEST_COMMENTS',
        'PickupsTableMap::COL_HARVEST_COMMENTS' => 'HARVEST_COMMENTS',
        'COL_HARVEST_COMMENTS' => 'HARVEST_COMMENTS',
        'harvest_comments' => 'HARVEST_COMMENTS',
        'pickups.harvest_comments' => 'HARVEST_COMMENTS',
        'HarvestContactName' => 'HARVEST_CONTACT_NAME',
        'Pickups.HarvestContactName' => 'HARVEST_CONTACT_NAME',
        'harvestContactName' => 'HARVEST_CONTACT_NAME',
        'pickups.harvestContactName' => 'HARVEST_CONTACT_NAME',
        'PickupsTableMap::COL_HARVEST_CONTACT_NAME' => 'HARVEST_CONTACT_NAME',
        'COL_HARVEST_CONTACT_NAME' => 'HARVEST_CONTACT_NAME',
        'harvest_contact_name' => 'HARVEST_CONTACT_NAME',
        'pickups.harvest_contact_name' => 'HARVEST_CONTACT_NAME',
        'HarvestContactSignature' => 'HARVEST_CONTACT_SIGNATURE',
        'Pickups.HarvestContactSignature' => 'HARVEST_CONTACT_SIGNATURE',
        'harvestContactSignature' => 'HARVEST_CONTACT_SIGNATURE',
        'pickups.harvestContactSignature' => 'HARVEST_CONTACT_SIGNATURE',
        'PickupsTableMap::COL_HARVEST_CONTACT_SIGNATURE' => 'HARVEST_CONTACT_SIGNATURE',
        'COL_HARVEST_CONTACT_SIGNATURE' => 'HARVEST_CONTACT_SIGNATURE',
        'harvest_contact_signature' => 'HARVEST_CONTACT_SIGNATURE',
        'pickups.harvest_contact_signature' => 'HARVEST_CONTACT_SIGNATURE',
        'HarvestPhoto' => 'HARVEST_PHOTO',
        'Pickups.HarvestPhoto' => 'HARVEST_PHOTO',
        'harvestPhoto' => 'HARVEST_PHOTO',
        'pickups.harvestPhoto' => 'HARVEST_PHOTO',
        'PickupsTableMap::COL_HARVEST_PHOTO' => 'HARVEST_PHOTO',
        'COL_HARVEST_PHOTO' => 'HARVEST_PHOTO',
        'harvest_photo' => 'HARVEST_PHOTO',
        'pickups.harvest_photo' => 'HARVEST_PHOTO',
        'CreatedAt' => 'CREATED_AT',
        'Pickups.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'pickups.createdAt' => 'CREATED_AT',
        'PickupsTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'pickups.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Pickups.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'pickups.updatedAt' => 'UPDATED_AT',
        'PickupsTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'pickups.updated_at' => 'UPDATED_AT',
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
        $this->setName('pickups');
        $this->setPhpName('Pickups');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Pickups');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 10, null);
        $this->addForeignKey('id_order', 'IdOrder', 'INTEGER', 'orders', 'id', true, 10, null);
        $this->addForeignKey('id_assigned_user', 'IdAssignedUser', 'INTEGER', 'users', 'id', true, 10, null);
        $this->addForeignKey('day_pickup', 'DayPickup', 'DATE', 'calendar', 'day', true, null, null);
        $this->addColumn('time_pickup', 'TimePickup', 'TIME', false, null, null);
        $this->addColumn('real_pickup_date', 'RealPickupDate', 'DATE', false, null, null);
        $this->addColumn('real_pickup_time', 'RealPickupTime', 'DATE', false, null, null);
        $this->addColumn('status', 'Status', 'INTEGER', true, 10, null);
        $this->addColumn('comments', 'Comments', 'VARCHAR', true, 191, '');
        $this->addColumn('harvest_comments', 'HarvestComments', 'VARCHAR', true, 1000, '');
        $this->addColumn('harvest_contact_name', 'HarvestContactName', 'VARCHAR', true, 191, '');
        $this->addColumn('harvest_contact_signature', 'HarvestContactSignature', 'LONGVARCHAR', true, null, null);
        $this->addColumn('harvest_photo', 'HarvestPhoto', 'LONGVARCHAR', true, null, null);
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
    0 => ':day_pickup',
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
        return $withPrefix ? PickupsTableMap::CLASS_DEFAULT : PickupsTableMap::OM_CLASS;
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
     * @return array           (Pickups object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PickupsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PickupsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PickupsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PickupsTableMap::OM_CLASS;
            /** @var Pickups $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PickupsTableMap::addInstanceToPool($obj, $key);
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
            $key = PickupsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PickupsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Pickups $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PickupsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PickupsTableMap::COL_ID);
            $criteria->addSelectColumn(PickupsTableMap::COL_ID_ORDER);
            $criteria->addSelectColumn(PickupsTableMap::COL_ID_ASSIGNED_USER);
            $criteria->addSelectColumn(PickupsTableMap::COL_DAY_PICKUP);
            $criteria->addSelectColumn(PickupsTableMap::COL_TIME_PICKUP);
            $criteria->addSelectColumn(PickupsTableMap::COL_REAL_PICKUP_DATE);
            $criteria->addSelectColumn(PickupsTableMap::COL_REAL_PICKUP_TIME);
            $criteria->addSelectColumn(PickupsTableMap::COL_STATUS);
            $criteria->addSelectColumn(PickupsTableMap::COL_COMMENTS);
            $criteria->addSelectColumn(PickupsTableMap::COL_HARVEST_COMMENTS);
            $criteria->addSelectColumn(PickupsTableMap::COL_HARVEST_CONTACT_NAME);
            $criteria->addSelectColumn(PickupsTableMap::COL_HARVEST_CONTACT_SIGNATURE);
            $criteria->addSelectColumn(PickupsTableMap::COL_HARVEST_PHOTO);
            $criteria->addSelectColumn(PickupsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(PickupsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_order');
            $criteria->addSelectColumn($alias . '.id_assigned_user');
            $criteria->addSelectColumn($alias . '.day_pickup');
            $criteria->addSelectColumn($alias . '.time_pickup');
            $criteria->addSelectColumn($alias . '.real_pickup_date');
            $criteria->addSelectColumn($alias . '.real_pickup_time');
            $criteria->addSelectColumn($alias . '.status');
            $criteria->addSelectColumn($alias . '.comments');
            $criteria->addSelectColumn($alias . '.harvest_comments');
            $criteria->addSelectColumn($alias . '.harvest_contact_name');
            $criteria->addSelectColumn($alias . '.harvest_contact_signature');
            $criteria->addSelectColumn($alias . '.harvest_photo');
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
            $criteria->removeSelectColumn(PickupsTableMap::COL_ID);
            $criteria->removeSelectColumn(PickupsTableMap::COL_ID_ORDER);
            $criteria->removeSelectColumn(PickupsTableMap::COL_ID_ASSIGNED_USER);
            $criteria->removeSelectColumn(PickupsTableMap::COL_DAY_PICKUP);
            $criteria->removeSelectColumn(PickupsTableMap::COL_TIME_PICKUP);
            $criteria->removeSelectColumn(PickupsTableMap::COL_REAL_PICKUP_DATE);
            $criteria->removeSelectColumn(PickupsTableMap::COL_REAL_PICKUP_TIME);
            $criteria->removeSelectColumn(PickupsTableMap::COL_STATUS);
            $criteria->removeSelectColumn(PickupsTableMap::COL_COMMENTS);
            $criteria->removeSelectColumn(PickupsTableMap::COL_HARVEST_COMMENTS);
            $criteria->removeSelectColumn(PickupsTableMap::COL_HARVEST_CONTACT_NAME);
            $criteria->removeSelectColumn(PickupsTableMap::COL_HARVEST_CONTACT_SIGNATURE);
            $criteria->removeSelectColumn(PickupsTableMap::COL_HARVEST_PHOTO);
            $criteria->removeSelectColumn(PickupsTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(PickupsTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.id_order');
            $criteria->removeSelectColumn($alias . '.id_assigned_user');
            $criteria->removeSelectColumn($alias . '.day_pickup');
            $criteria->removeSelectColumn($alias . '.time_pickup');
            $criteria->removeSelectColumn($alias . '.real_pickup_date');
            $criteria->removeSelectColumn($alias . '.real_pickup_time');
            $criteria->removeSelectColumn($alias . '.status');
            $criteria->removeSelectColumn($alias . '.comments');
            $criteria->removeSelectColumn($alias . '.harvest_comments');
            $criteria->removeSelectColumn($alias . '.harvest_contact_name');
            $criteria->removeSelectColumn($alias . '.harvest_contact_signature');
            $criteria->removeSelectColumn($alias . '.harvest_photo');
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
        return Propel::getServiceContainer()->getDatabaseMap(PickupsTableMap::DATABASE_NAME)->getTable(PickupsTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Pickups or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Pickups object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PickupsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Pickups) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PickupsTableMap::DATABASE_NAME);
            $criteria->add(PickupsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = PickupsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PickupsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PickupsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the pickups table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PickupsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Pickups or Criteria object.
     *
     * @param mixed               $criteria Criteria or Pickups object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PickupsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Pickups object
        }

        if ($criteria->containsKey(PickupsTableMap::COL_ID) && $criteria->keyContainsValue(PickupsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PickupsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = PickupsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PickupsTableMap
