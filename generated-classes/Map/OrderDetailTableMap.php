<?php

namespace Map;

use \OrderDetail;
use \OrderDetailQuery;
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
 * This class defines the structure of the 'order_detail' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OrderDetailTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.OrderDetailTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'golden_clean';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'order_detail';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\OrderDetail';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'OrderDetail';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 19;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 19;

    /**
     * the column name for the id field
     */
    const COL_ID = 'order_detail.id';

    /**
     * the column name for the id_order field
     */
    const COL_ID_ORDER = 'order_detail.id_order';

    /**
     * the column name for the id_order_detail_status field
     */
    const COL_ID_ORDER_DETAIL_STATUS = 'order_detail.id_order_detail_status';

    /**
     * the column name for the quantity field
     */
    const COL_QUANTITY = 'order_detail.quantity';

    /**
     * the column name for the id_color field
     */
    const COL_ID_COLOR = 'order_detail.id_color';

    /**
     * the column name for the id_print field
     */
    const COL_ID_PRINT = 'order_detail.id_print';

    /**
     * the column name for the id_defect field
     */
    const COL_ID_DEFECT = 'order_detail.id_defect';

    /**
     * the column name for the id_service field
     */
    const COL_ID_SERVICE = 'order_detail.id_service';

    /**
     * the column name for the observations field
     */
    const COL_OBSERVATIONS = 'order_detail.observations';

    /**
     * the column name for the location field
     */
    const COL_LOCATION = 'order_detail.location';

    /**
     * the column name for the price field
     */
    const COL_PRICE = 'order_detail.price';

    /**
     * the column name for the discount field
     */
    const COL_DISCOUNT = 'order_detail.discount';

    /**
     * the column name for the subtotal field
     */
    const COL_SUBTOTAL = 'order_detail.subtotal';

    /**
     * the column name for the total field
     */
    const COL_TOTAL = 'order_detail.total';

    /**
     * the column name for the real_delivery_date field
     */
    const COL_REAL_DELIVERY_DATE = 'order_detail.real_delivery_date';

    /**
     * the column name for the real_delivery_time field
     */
    const COL_REAL_DELIVERY_TIME = 'order_detail.real_delivery_time';

    /**
     * the column name for the id_delivery_user field
     */
    const COL_ID_DELIVERY_USER = 'order_detail.id_delivery_user';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'order_detail.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'order_detail.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'IdOrder', 'IdOrderDetailStatus', 'Quantity', 'IdColor', 'IdPrint', 'IdDefect', 'IdService', 'Observations', 'Location', 'Price', 'Discount', 'Subtotal', 'Total', 'RealDeliveryDate', 'RealDeliveryTime', 'IdDeliveryUser', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'idOrder', 'idOrderDetailStatus', 'quantity', 'idColor', 'idPrint', 'idDefect', 'idService', 'observations', 'location', 'price', 'discount', 'subtotal', 'total', 'realDeliveryDate', 'realDeliveryTime', 'idDeliveryUser', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(OrderDetailTableMap::COL_ID, OrderDetailTableMap::COL_ID_ORDER, OrderDetailTableMap::COL_ID_ORDER_DETAIL_STATUS, OrderDetailTableMap::COL_QUANTITY, OrderDetailTableMap::COL_ID_COLOR, OrderDetailTableMap::COL_ID_PRINT, OrderDetailTableMap::COL_ID_DEFECT, OrderDetailTableMap::COL_ID_SERVICE, OrderDetailTableMap::COL_OBSERVATIONS, OrderDetailTableMap::COL_LOCATION, OrderDetailTableMap::COL_PRICE, OrderDetailTableMap::COL_DISCOUNT, OrderDetailTableMap::COL_SUBTOTAL, OrderDetailTableMap::COL_TOTAL, OrderDetailTableMap::COL_REAL_DELIVERY_DATE, OrderDetailTableMap::COL_REAL_DELIVERY_TIME, OrderDetailTableMap::COL_ID_DELIVERY_USER, OrderDetailTableMap::COL_CREATED_AT, OrderDetailTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'id_order', 'id_order_detail_status', 'quantity', 'id_color', 'id_print', 'id_defect', 'id_service', 'observations', 'location', 'price', 'discount', 'subtotal', 'total', 'real_delivery_date', 'real_delivery_time', 'id_delivery_user', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdOrder' => 1, 'IdOrderDetailStatus' => 2, 'Quantity' => 3, 'IdColor' => 4, 'IdPrint' => 5, 'IdDefect' => 6, 'IdService' => 7, 'Observations' => 8, 'Location' => 9, 'Price' => 10, 'Discount' => 11, 'Subtotal' => 12, 'Total' => 13, 'RealDeliveryDate' => 14, 'RealDeliveryTime' => 15, 'IdDeliveryUser' => 16, 'CreatedAt' => 17, 'UpdatedAt' => 18, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idOrder' => 1, 'idOrderDetailStatus' => 2, 'quantity' => 3, 'idColor' => 4, 'idPrint' => 5, 'idDefect' => 6, 'idService' => 7, 'observations' => 8, 'location' => 9, 'price' => 10, 'discount' => 11, 'subtotal' => 12, 'total' => 13, 'realDeliveryDate' => 14, 'realDeliveryTime' => 15, 'idDeliveryUser' => 16, 'createdAt' => 17, 'updatedAt' => 18, ),
        self::TYPE_COLNAME       => array(OrderDetailTableMap::COL_ID => 0, OrderDetailTableMap::COL_ID_ORDER => 1, OrderDetailTableMap::COL_ID_ORDER_DETAIL_STATUS => 2, OrderDetailTableMap::COL_QUANTITY => 3, OrderDetailTableMap::COL_ID_COLOR => 4, OrderDetailTableMap::COL_ID_PRINT => 5, OrderDetailTableMap::COL_ID_DEFECT => 6, OrderDetailTableMap::COL_ID_SERVICE => 7, OrderDetailTableMap::COL_OBSERVATIONS => 8, OrderDetailTableMap::COL_LOCATION => 9, OrderDetailTableMap::COL_PRICE => 10, OrderDetailTableMap::COL_DISCOUNT => 11, OrderDetailTableMap::COL_SUBTOTAL => 12, OrderDetailTableMap::COL_TOTAL => 13, OrderDetailTableMap::COL_REAL_DELIVERY_DATE => 14, OrderDetailTableMap::COL_REAL_DELIVERY_TIME => 15, OrderDetailTableMap::COL_ID_DELIVERY_USER => 16, OrderDetailTableMap::COL_CREATED_AT => 17, OrderDetailTableMap::COL_UPDATED_AT => 18, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_order' => 1, 'id_order_detail_status' => 2, 'quantity' => 3, 'id_color' => 4, 'id_print' => 5, 'id_defect' => 6, 'id_service' => 7, 'observations' => 8, 'location' => 9, 'price' => 10, 'discount' => 11, 'subtotal' => 12, 'total' => 13, 'real_delivery_date' => 14, 'real_delivery_time' => 15, 'id_delivery_user' => 16, 'created_at' => 17, 'updated_at' => 18, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'OrderDetail.Id' => 'ID',
        'id' => 'ID',
        'orderDetail.id' => 'ID',
        'OrderDetailTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'order_detail.id' => 'ID',
        'IdOrder' => 'ID_ORDER',
        'OrderDetail.IdOrder' => 'ID_ORDER',
        'idOrder' => 'ID_ORDER',
        'orderDetail.idOrder' => 'ID_ORDER',
        'OrderDetailTableMap::COL_ID_ORDER' => 'ID_ORDER',
        'COL_ID_ORDER' => 'ID_ORDER',
        'id_order' => 'ID_ORDER',
        'order_detail.id_order' => 'ID_ORDER',
        'IdOrderDetailStatus' => 'ID_ORDER_DETAIL_STATUS',
        'OrderDetail.IdOrderDetailStatus' => 'ID_ORDER_DETAIL_STATUS',
        'idOrderDetailStatus' => 'ID_ORDER_DETAIL_STATUS',
        'orderDetail.idOrderDetailStatus' => 'ID_ORDER_DETAIL_STATUS',
        'OrderDetailTableMap::COL_ID_ORDER_DETAIL_STATUS' => 'ID_ORDER_DETAIL_STATUS',
        'COL_ID_ORDER_DETAIL_STATUS' => 'ID_ORDER_DETAIL_STATUS',
        'id_order_detail_status' => 'ID_ORDER_DETAIL_STATUS',
        'order_detail.id_order_detail_status' => 'ID_ORDER_DETAIL_STATUS',
        'Quantity' => 'QUANTITY',
        'OrderDetail.Quantity' => 'QUANTITY',
        'quantity' => 'QUANTITY',
        'orderDetail.quantity' => 'QUANTITY',
        'OrderDetailTableMap::COL_QUANTITY' => 'QUANTITY',
        'COL_QUANTITY' => 'QUANTITY',
        'order_detail.quantity' => 'QUANTITY',
        'IdColor' => 'ID_COLOR',
        'OrderDetail.IdColor' => 'ID_COLOR',
        'idColor' => 'ID_COLOR',
        'orderDetail.idColor' => 'ID_COLOR',
        'OrderDetailTableMap::COL_ID_COLOR' => 'ID_COLOR',
        'COL_ID_COLOR' => 'ID_COLOR',
        'id_color' => 'ID_COLOR',
        'order_detail.id_color' => 'ID_COLOR',
        'IdPrint' => 'ID_PRINT',
        'OrderDetail.IdPrint' => 'ID_PRINT',
        'idPrint' => 'ID_PRINT',
        'orderDetail.idPrint' => 'ID_PRINT',
        'OrderDetailTableMap::COL_ID_PRINT' => 'ID_PRINT',
        'COL_ID_PRINT' => 'ID_PRINT',
        'id_print' => 'ID_PRINT',
        'order_detail.id_print' => 'ID_PRINT',
        'IdDefect' => 'ID_DEFECT',
        'OrderDetail.IdDefect' => 'ID_DEFECT',
        'idDefect' => 'ID_DEFECT',
        'orderDetail.idDefect' => 'ID_DEFECT',
        'OrderDetailTableMap::COL_ID_DEFECT' => 'ID_DEFECT',
        'COL_ID_DEFECT' => 'ID_DEFECT',
        'id_defect' => 'ID_DEFECT',
        'order_detail.id_defect' => 'ID_DEFECT',
        'IdService' => 'ID_SERVICE',
        'OrderDetail.IdService' => 'ID_SERVICE',
        'idService' => 'ID_SERVICE',
        'orderDetail.idService' => 'ID_SERVICE',
        'OrderDetailTableMap::COL_ID_SERVICE' => 'ID_SERVICE',
        'COL_ID_SERVICE' => 'ID_SERVICE',
        'id_service' => 'ID_SERVICE',
        'order_detail.id_service' => 'ID_SERVICE',
        'Observations' => 'OBSERVATIONS',
        'OrderDetail.Observations' => 'OBSERVATIONS',
        'observations' => 'OBSERVATIONS',
        'orderDetail.observations' => 'OBSERVATIONS',
        'OrderDetailTableMap::COL_OBSERVATIONS' => 'OBSERVATIONS',
        'COL_OBSERVATIONS' => 'OBSERVATIONS',
        'order_detail.observations' => 'OBSERVATIONS',
        'Location' => 'LOCATION',
        'OrderDetail.Location' => 'LOCATION',
        'location' => 'LOCATION',
        'orderDetail.location' => 'LOCATION',
        'OrderDetailTableMap::COL_LOCATION' => 'LOCATION',
        'COL_LOCATION' => 'LOCATION',
        'order_detail.location' => 'LOCATION',
        'Price' => 'PRICE',
        'OrderDetail.Price' => 'PRICE',
        'price' => 'PRICE',
        'orderDetail.price' => 'PRICE',
        'OrderDetailTableMap::COL_PRICE' => 'PRICE',
        'COL_PRICE' => 'PRICE',
        'order_detail.price' => 'PRICE',
        'Discount' => 'DISCOUNT',
        'OrderDetail.Discount' => 'DISCOUNT',
        'discount' => 'DISCOUNT',
        'orderDetail.discount' => 'DISCOUNT',
        'OrderDetailTableMap::COL_DISCOUNT' => 'DISCOUNT',
        'COL_DISCOUNT' => 'DISCOUNT',
        'order_detail.discount' => 'DISCOUNT',
        'Subtotal' => 'SUBTOTAL',
        'OrderDetail.Subtotal' => 'SUBTOTAL',
        'subtotal' => 'SUBTOTAL',
        'orderDetail.subtotal' => 'SUBTOTAL',
        'OrderDetailTableMap::COL_SUBTOTAL' => 'SUBTOTAL',
        'COL_SUBTOTAL' => 'SUBTOTAL',
        'order_detail.subtotal' => 'SUBTOTAL',
        'Total' => 'TOTAL',
        'OrderDetail.Total' => 'TOTAL',
        'total' => 'TOTAL',
        'orderDetail.total' => 'TOTAL',
        'OrderDetailTableMap::COL_TOTAL' => 'TOTAL',
        'COL_TOTAL' => 'TOTAL',
        'order_detail.total' => 'TOTAL',
        'RealDeliveryDate' => 'REAL_DELIVERY_DATE',
        'OrderDetail.RealDeliveryDate' => 'REAL_DELIVERY_DATE',
        'realDeliveryDate' => 'REAL_DELIVERY_DATE',
        'orderDetail.realDeliveryDate' => 'REAL_DELIVERY_DATE',
        'OrderDetailTableMap::COL_REAL_DELIVERY_DATE' => 'REAL_DELIVERY_DATE',
        'COL_REAL_DELIVERY_DATE' => 'REAL_DELIVERY_DATE',
        'real_delivery_date' => 'REAL_DELIVERY_DATE',
        'order_detail.real_delivery_date' => 'REAL_DELIVERY_DATE',
        'RealDeliveryTime' => 'REAL_DELIVERY_TIME',
        'OrderDetail.RealDeliveryTime' => 'REAL_DELIVERY_TIME',
        'realDeliveryTime' => 'REAL_DELIVERY_TIME',
        'orderDetail.realDeliveryTime' => 'REAL_DELIVERY_TIME',
        'OrderDetailTableMap::COL_REAL_DELIVERY_TIME' => 'REAL_DELIVERY_TIME',
        'COL_REAL_DELIVERY_TIME' => 'REAL_DELIVERY_TIME',
        'real_delivery_time' => 'REAL_DELIVERY_TIME',
        'order_detail.real_delivery_time' => 'REAL_DELIVERY_TIME',
        'IdDeliveryUser' => 'ID_DELIVERY_USER',
        'OrderDetail.IdDeliveryUser' => 'ID_DELIVERY_USER',
        'idDeliveryUser' => 'ID_DELIVERY_USER',
        'orderDetail.idDeliveryUser' => 'ID_DELIVERY_USER',
        'OrderDetailTableMap::COL_ID_DELIVERY_USER' => 'ID_DELIVERY_USER',
        'COL_ID_DELIVERY_USER' => 'ID_DELIVERY_USER',
        'id_delivery_user' => 'ID_DELIVERY_USER',
        'order_detail.id_delivery_user' => 'ID_DELIVERY_USER',
        'CreatedAt' => 'CREATED_AT',
        'OrderDetail.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'orderDetail.createdAt' => 'CREATED_AT',
        'OrderDetailTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'order_detail.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OrderDetail.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'orderDetail.updatedAt' => 'UPDATED_AT',
        'OrderDetailTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'order_detail.updated_at' => 'UPDATED_AT',
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
        $this->setName('order_detail');
        $this->setPhpName('OrderDetail');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\OrderDetail');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 10, null);
        $this->addForeignKey('id_order', 'IdOrder', 'INTEGER', 'orders', 'id', true, 10, null);
        $this->addForeignKey('id_order_detail_status', 'IdOrderDetailStatus', 'INTEGER', 'order_detail_status', 'id', true, 10, null);
        $this->addColumn('quantity', 'Quantity', 'DECIMAL', true, 8, null);
        $this->addForeignKey('id_color', 'IdColor', 'INTEGER', 'colors', 'id', true, 10, null);
        $this->addForeignKey('id_print', 'IdPrint', 'INTEGER', 'prints', 'id', true, 10, null);
        $this->addForeignKey('id_defect', 'IdDefect', 'INTEGER', 'defects', 'id', true, 10, null);
        $this->addForeignKey('id_service', 'IdService', 'INTEGER', 'services', 'id', true, 10, null);
        $this->addColumn('observations', 'Observations', 'VARCHAR', true, 191, '');
        $this->addColumn('location', 'Location', 'VARCHAR', true, 191, '');
        $this->addColumn('price', 'Price', 'DECIMAL', true, 8, 0.00);
        $this->addColumn('discount', 'Discount', 'DECIMAL', true, 8, 0.00);
        $this->addColumn('subtotal', 'Subtotal', 'DECIMAL', true, 8, 0.00);
        $this->addColumn('total', 'Total', 'DECIMAL', true, 8, 0.00);
        $this->addColumn('real_delivery_date', 'RealDeliveryDate', 'DATE', false, null, null);
        $this->addColumn('real_delivery_time', 'RealDeliveryTime', 'TIME', false, null, null);
        $this->addForeignKey('id_delivery_user', 'IdDeliveryUser', 'INTEGER', 'users', 'id', false, 10, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Colors', '\\Colors', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_color',
    1 => ':id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('Defects', '\\Defects', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_defect',
    1 => ':id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('Users', '\\Users', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_delivery_user',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('OrderDetailStatus', '\\OrderDetailStatus', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_order_detail_status',
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
        $this->addRelation('Prints', '\\Prints', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_print',
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
        $this->addRelation('OrderDetailHistory', '\\OrderDetailHistory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_order_detail',
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
        return $withPrefix ? OrderDetailTableMap::CLASS_DEFAULT : OrderDetailTableMap::OM_CLASS;
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
     * @return array           (OrderDetail object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = OrderDetailTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OrderDetailTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OrderDetailTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OrderDetailTableMap::OM_CLASS;
            /** @var OrderDetail $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OrderDetailTableMap::addInstanceToPool($obj, $key);
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
            $key = OrderDetailTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OrderDetailTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OrderDetail $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OrderDetailTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OrderDetailTableMap::COL_ID);
            $criteria->addSelectColumn(OrderDetailTableMap::COL_ID_ORDER);
            $criteria->addSelectColumn(OrderDetailTableMap::COL_ID_ORDER_DETAIL_STATUS);
            $criteria->addSelectColumn(OrderDetailTableMap::COL_QUANTITY);
            $criteria->addSelectColumn(OrderDetailTableMap::COL_ID_COLOR);
            $criteria->addSelectColumn(OrderDetailTableMap::COL_ID_PRINT);
            $criteria->addSelectColumn(OrderDetailTableMap::COL_ID_DEFECT);
            $criteria->addSelectColumn(OrderDetailTableMap::COL_ID_SERVICE);
            $criteria->addSelectColumn(OrderDetailTableMap::COL_OBSERVATIONS);
            $criteria->addSelectColumn(OrderDetailTableMap::COL_LOCATION);
            $criteria->addSelectColumn(OrderDetailTableMap::COL_PRICE);
            $criteria->addSelectColumn(OrderDetailTableMap::COL_DISCOUNT);
            $criteria->addSelectColumn(OrderDetailTableMap::COL_SUBTOTAL);
            $criteria->addSelectColumn(OrderDetailTableMap::COL_TOTAL);
            $criteria->addSelectColumn(OrderDetailTableMap::COL_REAL_DELIVERY_DATE);
            $criteria->addSelectColumn(OrderDetailTableMap::COL_REAL_DELIVERY_TIME);
            $criteria->addSelectColumn(OrderDetailTableMap::COL_ID_DELIVERY_USER);
            $criteria->addSelectColumn(OrderDetailTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OrderDetailTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_order');
            $criteria->addSelectColumn($alias . '.id_order_detail_status');
            $criteria->addSelectColumn($alias . '.quantity');
            $criteria->addSelectColumn($alias . '.id_color');
            $criteria->addSelectColumn($alias . '.id_print');
            $criteria->addSelectColumn($alias . '.id_defect');
            $criteria->addSelectColumn($alias . '.id_service');
            $criteria->addSelectColumn($alias . '.observations');
            $criteria->addSelectColumn($alias . '.location');
            $criteria->addSelectColumn($alias . '.price');
            $criteria->addSelectColumn($alias . '.discount');
            $criteria->addSelectColumn($alias . '.subtotal');
            $criteria->addSelectColumn($alias . '.total');
            $criteria->addSelectColumn($alias . '.real_delivery_date');
            $criteria->addSelectColumn($alias . '.real_delivery_time');
            $criteria->addSelectColumn($alias . '.id_delivery_user');
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
            $criteria->removeSelectColumn(OrderDetailTableMap::COL_ID);
            $criteria->removeSelectColumn(OrderDetailTableMap::COL_ID_ORDER);
            $criteria->removeSelectColumn(OrderDetailTableMap::COL_ID_ORDER_DETAIL_STATUS);
            $criteria->removeSelectColumn(OrderDetailTableMap::COL_QUANTITY);
            $criteria->removeSelectColumn(OrderDetailTableMap::COL_ID_COLOR);
            $criteria->removeSelectColumn(OrderDetailTableMap::COL_ID_PRINT);
            $criteria->removeSelectColumn(OrderDetailTableMap::COL_ID_DEFECT);
            $criteria->removeSelectColumn(OrderDetailTableMap::COL_ID_SERVICE);
            $criteria->removeSelectColumn(OrderDetailTableMap::COL_OBSERVATIONS);
            $criteria->removeSelectColumn(OrderDetailTableMap::COL_LOCATION);
            $criteria->removeSelectColumn(OrderDetailTableMap::COL_PRICE);
            $criteria->removeSelectColumn(OrderDetailTableMap::COL_DISCOUNT);
            $criteria->removeSelectColumn(OrderDetailTableMap::COL_SUBTOTAL);
            $criteria->removeSelectColumn(OrderDetailTableMap::COL_TOTAL);
            $criteria->removeSelectColumn(OrderDetailTableMap::COL_REAL_DELIVERY_DATE);
            $criteria->removeSelectColumn(OrderDetailTableMap::COL_REAL_DELIVERY_TIME);
            $criteria->removeSelectColumn(OrderDetailTableMap::COL_ID_DELIVERY_USER);
            $criteria->removeSelectColumn(OrderDetailTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OrderDetailTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.id_order');
            $criteria->removeSelectColumn($alias . '.id_order_detail_status');
            $criteria->removeSelectColumn($alias . '.quantity');
            $criteria->removeSelectColumn($alias . '.id_color');
            $criteria->removeSelectColumn($alias . '.id_print');
            $criteria->removeSelectColumn($alias . '.id_defect');
            $criteria->removeSelectColumn($alias . '.id_service');
            $criteria->removeSelectColumn($alias . '.observations');
            $criteria->removeSelectColumn($alias . '.location');
            $criteria->removeSelectColumn($alias . '.price');
            $criteria->removeSelectColumn($alias . '.discount');
            $criteria->removeSelectColumn($alias . '.subtotal');
            $criteria->removeSelectColumn($alias . '.total');
            $criteria->removeSelectColumn($alias . '.real_delivery_date');
            $criteria->removeSelectColumn($alias . '.real_delivery_time');
            $criteria->removeSelectColumn($alias . '.id_delivery_user');
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
        return Propel::getServiceContainer()->getDatabaseMap(OrderDetailTableMap::DATABASE_NAME)->getTable(OrderDetailTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OrderDetail or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or OrderDetail object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OrderDetailTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \OrderDetail) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OrderDetailTableMap::DATABASE_NAME);
            $criteria->add(OrderDetailTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = OrderDetailQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OrderDetailTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OrderDetailTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the order_detail table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return OrderDetailQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OrderDetail or Criteria object.
     *
     * @param mixed               $criteria Criteria or OrderDetail object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderDetailTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OrderDetail object
        }

        if ($criteria->containsKey(OrderDetailTableMap::COL_ID) && $criteria->keyContainsValue(OrderDetailTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OrderDetailTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = OrderDetailQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // OrderDetailTableMap
