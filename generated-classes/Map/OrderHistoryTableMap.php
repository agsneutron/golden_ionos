<?php

namespace Map;

use \OrderHistory;
use \OrderHistoryQuery;
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
 * This class defines the structure of the 'order_history' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OrderHistoryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.OrderHistoryTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'golden_clean';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'order_history';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\OrderHistory';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'OrderHistory';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 14;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 14;

    /**
     * the column name for the id field
     */
    const COL_ID = 'order_history.id';

    /**
     * the column name for the id_order field
     */
    const COL_ID_ORDER = 'order_history.id_order';

    /**
     * the column name for the id_order_status field
     */
    const COL_ID_ORDER_STATUS = 'order_history.id_order_status';

    /**
     * the column name for the amount_paid field
     */
    const COL_AMOUNT_PAID = 'order_history.amount_paid';

    /**
     * the column name for the total_paid field
     */
    const COL_TOTAL_PAID = 'order_history.total_paid';

    /**
     * the column name for the id_payment_method field
     */
    const COL_ID_PAYMENT_METHOD = 'order_history.id_payment_method';

    /**
     * the column name for the id_payment_status field
     */
    const COL_ID_PAYMENT_STATUS = 'order_history.id_payment_status';

    /**
     * the column name for the uid field
     */
    const COL_UID = 'order_history.uid';

    /**
     * the column name for the payment_file field
     */
    const COL_PAYMENT_FILE = 'order_history.payment_file';

    /**
     * the column name for the voucher field
     */
    const COL_VOUCHER = 'order_history.voucher';

    /**
     * the column name for the deleted_payment field
     */
    const COL_DELETED_PAYMENT = 'order_history.deleted_payment';

    /**
     * the column name for the id_user field
     */
    const COL_ID_USER = 'order_history.id_user';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'order_history.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'order_history.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'IdOrder', 'IdOrderStatus', 'AmountPaid', 'TotalPaid', 'IdPaymentMethod', 'IdPaymentStatus', 'Uid', 'PaymentFile', 'Voucher', 'DeletedPayment', 'IdUser', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'idOrder', 'idOrderStatus', 'amountPaid', 'totalPaid', 'idPaymentMethod', 'idPaymentStatus', 'uid', 'paymentFile', 'voucher', 'deletedPayment', 'idUser', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(OrderHistoryTableMap::COL_ID, OrderHistoryTableMap::COL_ID_ORDER, OrderHistoryTableMap::COL_ID_ORDER_STATUS, OrderHistoryTableMap::COL_AMOUNT_PAID, OrderHistoryTableMap::COL_TOTAL_PAID, OrderHistoryTableMap::COL_ID_PAYMENT_METHOD, OrderHistoryTableMap::COL_ID_PAYMENT_STATUS, OrderHistoryTableMap::COL_UID, OrderHistoryTableMap::COL_PAYMENT_FILE, OrderHistoryTableMap::COL_VOUCHER, OrderHistoryTableMap::COL_DELETED_PAYMENT, OrderHistoryTableMap::COL_ID_USER, OrderHistoryTableMap::COL_CREATED_AT, OrderHistoryTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'id_order', 'id_order_status', 'amount_paid', 'total_paid', 'id_payment_method', 'id_payment_status', 'uid', 'payment_file', 'voucher', 'deleted_payment', 'id_user', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdOrder' => 1, 'IdOrderStatus' => 2, 'AmountPaid' => 3, 'TotalPaid' => 4, 'IdPaymentMethod' => 5, 'IdPaymentStatus' => 6, 'Uid' => 7, 'PaymentFile' => 8, 'Voucher' => 9, 'DeletedPayment' => 10, 'IdUser' => 11, 'CreatedAt' => 12, 'UpdatedAt' => 13, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idOrder' => 1, 'idOrderStatus' => 2, 'amountPaid' => 3, 'totalPaid' => 4, 'idPaymentMethod' => 5, 'idPaymentStatus' => 6, 'uid' => 7, 'paymentFile' => 8, 'voucher' => 9, 'deletedPayment' => 10, 'idUser' => 11, 'createdAt' => 12, 'updatedAt' => 13, ),
        self::TYPE_COLNAME       => array(OrderHistoryTableMap::COL_ID => 0, OrderHistoryTableMap::COL_ID_ORDER => 1, OrderHistoryTableMap::COL_ID_ORDER_STATUS => 2, OrderHistoryTableMap::COL_AMOUNT_PAID => 3, OrderHistoryTableMap::COL_TOTAL_PAID => 4, OrderHistoryTableMap::COL_ID_PAYMENT_METHOD => 5, OrderHistoryTableMap::COL_ID_PAYMENT_STATUS => 6, OrderHistoryTableMap::COL_UID => 7, OrderHistoryTableMap::COL_PAYMENT_FILE => 8, OrderHistoryTableMap::COL_VOUCHER => 9, OrderHistoryTableMap::COL_DELETED_PAYMENT => 10, OrderHistoryTableMap::COL_ID_USER => 11, OrderHistoryTableMap::COL_CREATED_AT => 12, OrderHistoryTableMap::COL_UPDATED_AT => 13, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_order' => 1, 'id_order_status' => 2, 'amount_paid' => 3, 'total_paid' => 4, 'id_payment_method' => 5, 'id_payment_status' => 6, 'uid' => 7, 'payment_file' => 8, 'voucher' => 9, 'deleted_payment' => 10, 'id_user' => 11, 'created_at' => 12, 'updated_at' => 13, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'OrderHistory.Id' => 'ID',
        'id' => 'ID',
        'orderHistory.id' => 'ID',
        'OrderHistoryTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'order_history.id' => 'ID',
        'IdOrder' => 'ID_ORDER',
        'OrderHistory.IdOrder' => 'ID_ORDER',
        'idOrder' => 'ID_ORDER',
        'orderHistory.idOrder' => 'ID_ORDER',
        'OrderHistoryTableMap::COL_ID_ORDER' => 'ID_ORDER',
        'COL_ID_ORDER' => 'ID_ORDER',
        'id_order' => 'ID_ORDER',
        'order_history.id_order' => 'ID_ORDER',
        'IdOrderStatus' => 'ID_ORDER_STATUS',
        'OrderHistory.IdOrderStatus' => 'ID_ORDER_STATUS',
        'idOrderStatus' => 'ID_ORDER_STATUS',
        'orderHistory.idOrderStatus' => 'ID_ORDER_STATUS',
        'OrderHistoryTableMap::COL_ID_ORDER_STATUS' => 'ID_ORDER_STATUS',
        'COL_ID_ORDER_STATUS' => 'ID_ORDER_STATUS',
        'id_order_status' => 'ID_ORDER_STATUS',
        'order_history.id_order_status' => 'ID_ORDER_STATUS',
        'AmountPaid' => 'AMOUNT_PAID',
        'OrderHistory.AmountPaid' => 'AMOUNT_PAID',
        'amountPaid' => 'AMOUNT_PAID',
        'orderHistory.amountPaid' => 'AMOUNT_PAID',
        'OrderHistoryTableMap::COL_AMOUNT_PAID' => 'AMOUNT_PAID',
        'COL_AMOUNT_PAID' => 'AMOUNT_PAID',
        'amount_paid' => 'AMOUNT_PAID',
        'order_history.amount_paid' => 'AMOUNT_PAID',
        'TotalPaid' => 'TOTAL_PAID',
        'OrderHistory.TotalPaid' => 'TOTAL_PAID',
        'totalPaid' => 'TOTAL_PAID',
        'orderHistory.totalPaid' => 'TOTAL_PAID',
        'OrderHistoryTableMap::COL_TOTAL_PAID' => 'TOTAL_PAID',
        'COL_TOTAL_PAID' => 'TOTAL_PAID',
        'total_paid' => 'TOTAL_PAID',
        'order_history.total_paid' => 'TOTAL_PAID',
        'IdPaymentMethod' => 'ID_PAYMENT_METHOD',
        'OrderHistory.IdPaymentMethod' => 'ID_PAYMENT_METHOD',
        'idPaymentMethod' => 'ID_PAYMENT_METHOD',
        'orderHistory.idPaymentMethod' => 'ID_PAYMENT_METHOD',
        'OrderHistoryTableMap::COL_ID_PAYMENT_METHOD' => 'ID_PAYMENT_METHOD',
        'COL_ID_PAYMENT_METHOD' => 'ID_PAYMENT_METHOD',
        'id_payment_method' => 'ID_PAYMENT_METHOD',
        'order_history.id_payment_method' => 'ID_PAYMENT_METHOD',
        'IdPaymentStatus' => 'ID_PAYMENT_STATUS',
        'OrderHistory.IdPaymentStatus' => 'ID_PAYMENT_STATUS',
        'idPaymentStatus' => 'ID_PAYMENT_STATUS',
        'orderHistory.idPaymentStatus' => 'ID_PAYMENT_STATUS',
        'OrderHistoryTableMap::COL_ID_PAYMENT_STATUS' => 'ID_PAYMENT_STATUS',
        'COL_ID_PAYMENT_STATUS' => 'ID_PAYMENT_STATUS',
        'id_payment_status' => 'ID_PAYMENT_STATUS',
        'order_history.id_payment_status' => 'ID_PAYMENT_STATUS',
        'Uid' => 'UID',
        'OrderHistory.Uid' => 'UID',
        'uid' => 'UID',
        'orderHistory.uid' => 'UID',
        'OrderHistoryTableMap::COL_UID' => 'UID',
        'COL_UID' => 'UID',
        'order_history.uid' => 'UID',
        'PaymentFile' => 'PAYMENT_FILE',
        'OrderHistory.PaymentFile' => 'PAYMENT_FILE',
        'paymentFile' => 'PAYMENT_FILE',
        'orderHistory.paymentFile' => 'PAYMENT_FILE',
        'OrderHistoryTableMap::COL_PAYMENT_FILE' => 'PAYMENT_FILE',
        'COL_PAYMENT_FILE' => 'PAYMENT_FILE',
        'payment_file' => 'PAYMENT_FILE',
        'order_history.payment_file' => 'PAYMENT_FILE',
        'Voucher' => 'VOUCHER',
        'OrderHistory.Voucher' => 'VOUCHER',
        'voucher' => 'VOUCHER',
        'orderHistory.voucher' => 'VOUCHER',
        'OrderHistoryTableMap::COL_VOUCHER' => 'VOUCHER',
        'COL_VOUCHER' => 'VOUCHER',
        'order_history.voucher' => 'VOUCHER',
        'DeletedPayment' => 'DELETED_PAYMENT',
        'OrderHistory.DeletedPayment' => 'DELETED_PAYMENT',
        'deletedPayment' => 'DELETED_PAYMENT',
        'orderHistory.deletedPayment' => 'DELETED_PAYMENT',
        'OrderHistoryTableMap::COL_DELETED_PAYMENT' => 'DELETED_PAYMENT',
        'COL_DELETED_PAYMENT' => 'DELETED_PAYMENT',
        'deleted_payment' => 'DELETED_PAYMENT',
        'order_history.deleted_payment' => 'DELETED_PAYMENT',
        'IdUser' => 'ID_USER',
        'OrderHistory.IdUser' => 'ID_USER',
        'idUser' => 'ID_USER',
        'orderHistory.idUser' => 'ID_USER',
        'OrderHistoryTableMap::COL_ID_USER' => 'ID_USER',
        'COL_ID_USER' => 'ID_USER',
        'id_user' => 'ID_USER',
        'order_history.id_user' => 'ID_USER',
        'CreatedAt' => 'CREATED_AT',
        'OrderHistory.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'orderHistory.createdAt' => 'CREATED_AT',
        'OrderHistoryTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'order_history.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'OrderHistory.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'orderHistory.updatedAt' => 'UPDATED_AT',
        'OrderHistoryTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'order_history.updated_at' => 'UPDATED_AT',
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
        $this->setName('order_history');
        $this->setPhpName('OrderHistory');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\OrderHistory');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 10, null);
        $this->addForeignKey('id_order', 'IdOrder', 'INTEGER', 'orders', 'id', true, 10, null);
        $this->addForeignKey('id_order_status', 'IdOrderStatus', 'INTEGER', 'order_status', 'id', true, 10, null);
        $this->addColumn('amount_paid', 'AmountPaid', 'DECIMAL', true, 8, null);
        $this->addColumn('total_paid', 'TotalPaid', 'DECIMAL', true, 8, null);
        $this->addForeignKey('id_payment_method', 'IdPaymentMethod', 'INTEGER', 'payment_methods', 'id', true, 10, null);
        $this->addForeignKey('id_payment_status', 'IdPaymentStatus', 'INTEGER', 'payment_status', 'id', false, 10, null);
        $this->addColumn('uid', 'Uid', 'VARCHAR', true, 191, '');
        $this->addColumn('payment_file', 'PaymentFile', 'VARCHAR', true, 191, '');
        $this->addColumn('voucher', 'Voucher', 'VARCHAR', true, 191, '');
        $this->addColumn('deleted_payment', 'DeletedPayment', 'INTEGER', true, 10, 0);
        $this->addForeignKey('id_user', 'IdUser', 'INTEGER', 'users', 'id', true, 10, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Orders', '\\Orders', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_order',
    1 => ':id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('OrderStatus', '\\OrderStatus', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_order_status',
    1 => ':id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('PaymentMethods', '\\PaymentMethods', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_payment_method',
    1 => ':id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('PaymentStatus', '\\PaymentStatus', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_payment_status',
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
        return $withPrefix ? OrderHistoryTableMap::CLASS_DEFAULT : OrderHistoryTableMap::OM_CLASS;
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
     * @return array           (OrderHistory object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = OrderHistoryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OrderHistoryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OrderHistoryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OrderHistoryTableMap::OM_CLASS;
            /** @var OrderHistory $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OrderHistoryTableMap::addInstanceToPool($obj, $key);
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
            $key = OrderHistoryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OrderHistoryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var OrderHistory $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OrderHistoryTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OrderHistoryTableMap::COL_ID);
            $criteria->addSelectColumn(OrderHistoryTableMap::COL_ID_ORDER);
            $criteria->addSelectColumn(OrderHistoryTableMap::COL_ID_ORDER_STATUS);
            $criteria->addSelectColumn(OrderHistoryTableMap::COL_AMOUNT_PAID);
            $criteria->addSelectColumn(OrderHistoryTableMap::COL_TOTAL_PAID);
            $criteria->addSelectColumn(OrderHistoryTableMap::COL_ID_PAYMENT_METHOD);
            $criteria->addSelectColumn(OrderHistoryTableMap::COL_ID_PAYMENT_STATUS);
            $criteria->addSelectColumn(OrderHistoryTableMap::COL_UID);
            $criteria->addSelectColumn(OrderHistoryTableMap::COL_PAYMENT_FILE);
            $criteria->addSelectColumn(OrderHistoryTableMap::COL_VOUCHER);
            $criteria->addSelectColumn(OrderHistoryTableMap::COL_DELETED_PAYMENT);
            $criteria->addSelectColumn(OrderHistoryTableMap::COL_ID_USER);
            $criteria->addSelectColumn(OrderHistoryTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OrderHistoryTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_order');
            $criteria->addSelectColumn($alias . '.id_order_status');
            $criteria->addSelectColumn($alias . '.amount_paid');
            $criteria->addSelectColumn($alias . '.total_paid');
            $criteria->addSelectColumn($alias . '.id_payment_method');
            $criteria->addSelectColumn($alias . '.id_payment_status');
            $criteria->addSelectColumn($alias . '.uid');
            $criteria->addSelectColumn($alias . '.payment_file');
            $criteria->addSelectColumn($alias . '.voucher');
            $criteria->addSelectColumn($alias . '.deleted_payment');
            $criteria->addSelectColumn($alias . '.id_user');
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
            $criteria->removeSelectColumn(OrderHistoryTableMap::COL_ID);
            $criteria->removeSelectColumn(OrderHistoryTableMap::COL_ID_ORDER);
            $criteria->removeSelectColumn(OrderHistoryTableMap::COL_ID_ORDER_STATUS);
            $criteria->removeSelectColumn(OrderHistoryTableMap::COL_AMOUNT_PAID);
            $criteria->removeSelectColumn(OrderHistoryTableMap::COL_TOTAL_PAID);
            $criteria->removeSelectColumn(OrderHistoryTableMap::COL_ID_PAYMENT_METHOD);
            $criteria->removeSelectColumn(OrderHistoryTableMap::COL_ID_PAYMENT_STATUS);
            $criteria->removeSelectColumn(OrderHistoryTableMap::COL_UID);
            $criteria->removeSelectColumn(OrderHistoryTableMap::COL_PAYMENT_FILE);
            $criteria->removeSelectColumn(OrderHistoryTableMap::COL_VOUCHER);
            $criteria->removeSelectColumn(OrderHistoryTableMap::COL_DELETED_PAYMENT);
            $criteria->removeSelectColumn(OrderHistoryTableMap::COL_ID_USER);
            $criteria->removeSelectColumn(OrderHistoryTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OrderHistoryTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.id_order');
            $criteria->removeSelectColumn($alias . '.id_order_status');
            $criteria->removeSelectColumn($alias . '.amount_paid');
            $criteria->removeSelectColumn($alias . '.total_paid');
            $criteria->removeSelectColumn($alias . '.id_payment_method');
            $criteria->removeSelectColumn($alias . '.id_payment_status');
            $criteria->removeSelectColumn($alias . '.uid');
            $criteria->removeSelectColumn($alias . '.payment_file');
            $criteria->removeSelectColumn($alias . '.voucher');
            $criteria->removeSelectColumn($alias . '.deleted_payment');
            $criteria->removeSelectColumn($alias . '.id_user');
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
        return Propel::getServiceContainer()->getDatabaseMap(OrderHistoryTableMap::DATABASE_NAME)->getTable(OrderHistoryTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a OrderHistory or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or OrderHistory object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OrderHistoryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \OrderHistory) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OrderHistoryTableMap::DATABASE_NAME);
            $criteria->add(OrderHistoryTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = OrderHistoryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OrderHistoryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OrderHistoryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the order_history table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return OrderHistoryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a OrderHistory or Criteria object.
     *
     * @param mixed               $criteria Criteria or OrderHistory object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderHistoryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from OrderHistory object
        }

        if ($criteria->containsKey(OrderHistoryTableMap::COL_ID) && $criteria->keyContainsValue(OrderHistoryTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OrderHistoryTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = OrderHistoryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // OrderHistoryTableMap
