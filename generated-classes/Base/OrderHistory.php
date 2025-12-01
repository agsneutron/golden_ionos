<?php

namespace Base;

use \OrderHistoryQuery as ChildOrderHistoryQuery;
use \OrderStatus as ChildOrderStatus;
use \OrderStatusQuery as ChildOrderStatusQuery;
use \Orders as ChildOrders;
use \OrdersQuery as ChildOrdersQuery;
use \PaymentMethods as ChildPaymentMethods;
use \PaymentMethodsQuery as ChildPaymentMethodsQuery;
use \PaymentStatus as ChildPaymentStatus;
use \PaymentStatusQuery as ChildPaymentStatusQuery;
use \Users as ChildUsers;
use \UsersQuery as ChildUsersQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\OrderHistoryTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'order_history' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class OrderHistory implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\OrderHistoryTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        int
     */
    protected $id;

    /**
     * The value for the id_order field.
     *
     * @var        int
     */
    protected $id_order;

    /**
     * The value for the id_order_status field.
     *
     * @var        int
     */
    protected $id_order_status;

    /**
     * The value for the amount_paid field.
     *
     * @var        string
     */
    protected $amount_paid;

    /**
     * The value for the total_paid field.
     *
     * @var        string
     */
    protected $total_paid;

    /**
     * The value for the id_payment_method field.
     *
     * @var        int
     */
    protected $id_payment_method;

    /**
     * The value for the id_payment_status field.
     *
     * @var        int|null
     */
    protected $id_payment_status;

    /**
     * The value for the uid field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $uid;

    /**
     * The value for the payment_file field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $payment_file;

    /**
     * The value for the voucher field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $voucher;

    /**
     * The value for the deleted_payment field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $deleted_payment;

    /**
     * The value for the id_user field.
     *
     * @var        int
     */
    protected $id_user;

    /**
     * The value for the created_at field.
     *
     * @var        DateTime|null
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     *
     * @var        DateTime|null
     */
    protected $updated_at;

    /**
     * @var        ChildOrders
     */
    protected $aOrders;

    /**
     * @var        ChildOrderStatus
     */
    protected $aOrderStatus;

    /**
     * @var        ChildPaymentMethods
     */
    protected $aPaymentMethods;

    /**
     * @var        ChildPaymentStatus
     */
    protected $aPaymentStatus;

    /**
     * @var        ChildUsers
     */
    protected $aUsers;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->uid = '';
        $this->payment_file = '';
        $this->voucher = '';
        $this->deleted_payment = 0;
    }

    /**
     * Initializes internal state of Base\OrderHistory object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            unset($this->modifiedColumns[$col]);
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>OrderHistory</code> instance.  If
     * <code>obj</code> is an instance of <code>OrderHistory</code>, delegates to
     * <code>equals(OrderHistory)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param  string  $keyType                (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [id_order] column value.
     *
     * @return int
     */
    public function getIdOrder()
    {
        return $this->id_order;
    }

    /**
     * Get the [id_order_status] column value.
     *
     * @return int
     */
    public function getIdOrderStatus()
    {
        return $this->id_order_status;
    }

    /**
     * Get the [amount_paid] column value.
     *
     * @return string
     */
    public function getAmountPaid()
    {
        return $this->amount_paid;
    }

    /**
     * Get the [total_paid] column value.
     *
     * @return string
     */
    public function getTotalPaid()
    {
        return $this->total_paid;
    }

    /**
     * Get the [id_payment_method] column value.
     *
     * @return int
     */
    public function getIdPaymentMethod()
    {
        return $this->id_payment_method;
    }

    /**
     * Get the [id_payment_status] column value.
     *
     * @return int|null
     */
    public function getIdPaymentStatus()
    {
        return $this->id_payment_status;
    }

    /**
     * Get the [uid] column value.
     *
     * @return string
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Get the [payment_file] column value.
     *
     * @return string
     */
    public function getPaymentFile()
    {
        return $this->payment_file;
    }

    /**
     * Get the [voucher] column value.
     *
     * @return string
     */
    public function getVoucher()
    {
        return $this->voucher;
    }

    /**
     * Get the [deleted_payment] column value.
     *
     * @return int
     */
    public function getDeletedPayment()
    {
        return $this->deleted_payment;
    }

    /**
     * Get the [id_user] column value.
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getCreatedAt($format = 'Y-m-d H:i:s')
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTimeInterface ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getUpdatedAt($format = 'Y-m-d H:i:s')
    {
        if ($format === null) {
            return $this->updated_at;
        } else {
            return $this->updated_at instanceof \DateTimeInterface ? $this->updated_at->format($format) : null;
        }
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v New value
     * @return $this|\OrderHistory The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[OrderHistoryTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [id_order] column.
     *
     * @param int $v New value
     * @return $this|\OrderHistory The current object (for fluent API support)
     */
    public function setIdOrder($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_order !== $v) {
            $this->id_order = $v;
            $this->modifiedColumns[OrderHistoryTableMap::COL_ID_ORDER] = true;
        }

        if ($this->aOrders !== null && $this->aOrders->getId() !== $v) {
            $this->aOrders = null;
        }

        return $this;
    } // setIdOrder()

    /**
     * Set the value of [id_order_status] column.
     *
     * @param int $v New value
     * @return $this|\OrderHistory The current object (for fluent API support)
     */
    public function setIdOrderStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_order_status !== $v) {
            $this->id_order_status = $v;
            $this->modifiedColumns[OrderHistoryTableMap::COL_ID_ORDER_STATUS] = true;
        }

        if ($this->aOrderStatus !== null && $this->aOrderStatus->getId() !== $v) {
            $this->aOrderStatus = null;
        }

        return $this;
    } // setIdOrderStatus()

    /**
     * Set the value of [amount_paid] column.
     *
     * @param string $v New value
     * @return $this|\OrderHistory The current object (for fluent API support)
     */
    public function setAmountPaid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->amount_paid !== $v) {
            $this->amount_paid = $v;
            $this->modifiedColumns[OrderHistoryTableMap::COL_AMOUNT_PAID] = true;
        }

        return $this;
    } // setAmountPaid()

    /**
     * Set the value of [total_paid] column.
     *
     * @param string $v New value
     * @return $this|\OrderHistory The current object (for fluent API support)
     */
    public function setTotalPaid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->total_paid !== $v) {
            $this->total_paid = $v;
            $this->modifiedColumns[OrderHistoryTableMap::COL_TOTAL_PAID] = true;
        }

        return $this;
    } // setTotalPaid()

    /**
     * Set the value of [id_payment_method] column.
     *
     * @param int $v New value
     * @return $this|\OrderHistory The current object (for fluent API support)
     */
    public function setIdPaymentMethod($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_payment_method !== $v) {
            $this->id_payment_method = $v;
            $this->modifiedColumns[OrderHistoryTableMap::COL_ID_PAYMENT_METHOD] = true;
        }

        if ($this->aPaymentMethods !== null && $this->aPaymentMethods->getId() !== $v) {
            $this->aPaymentMethods = null;
        }

        return $this;
    } // setIdPaymentMethod()

    /**
     * Set the value of [id_payment_status] column.
     *
     * @param int|null $v New value
     * @return $this|\OrderHistory The current object (for fluent API support)
     */
    public function setIdPaymentStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_payment_status !== $v) {
            $this->id_payment_status = $v;
            $this->modifiedColumns[OrderHistoryTableMap::COL_ID_PAYMENT_STATUS] = true;
        }

        if ($this->aPaymentStatus !== null && $this->aPaymentStatus->getId() !== $v) {
            $this->aPaymentStatus = null;
        }

        return $this;
    } // setIdPaymentStatus()

    /**
     * Set the value of [uid] column.
     *
     * @param string $v New value
     * @return $this|\OrderHistory The current object (for fluent API support)
     */
    public function setUid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->uid !== $v) {
            $this->uid = $v;
            $this->modifiedColumns[OrderHistoryTableMap::COL_UID] = true;
        }

        return $this;
    } // setUid()

    /**
     * Set the value of [payment_file] column.
     *
     * @param string $v New value
     * @return $this|\OrderHistory The current object (for fluent API support)
     */
    public function setPaymentFile($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->payment_file !== $v) {
            $this->payment_file = $v;
            $this->modifiedColumns[OrderHistoryTableMap::COL_PAYMENT_FILE] = true;
        }

        return $this;
    } // setPaymentFile()

    /**
     * Set the value of [voucher] column.
     *
     * @param string $v New value
     * @return $this|\OrderHistory The current object (for fluent API support)
     */
    public function setVoucher($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->voucher !== $v) {
            $this->voucher = $v;
            $this->modifiedColumns[OrderHistoryTableMap::COL_VOUCHER] = true;
        }

        return $this;
    } // setVoucher()

    /**
     * Set the value of [deleted_payment] column.
     *
     * @param int $v New value
     * @return $this|\OrderHistory The current object (for fluent API support)
     */
    public function setDeletedPayment($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->deleted_payment !== $v) {
            $this->deleted_payment = $v;
            $this->modifiedColumns[OrderHistoryTableMap::COL_DELETED_PAYMENT] = true;
        }

        return $this;
    } // setDeletedPayment()

    /**
     * Set the value of [id_user] column.
     *
     * @param int $v New value
     * @return $this|\OrderHistory The current object (for fluent API support)
     */
    public function setIdUser($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_user !== $v) {
            $this->id_user = $v;
            $this->modifiedColumns[OrderHistoryTableMap::COL_ID_USER] = true;
        }

        if ($this->aUsers !== null && $this->aUsers->getId() !== $v) {
            $this->aUsers = null;
        }

        return $this;
    } // setIdUser()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\OrderHistory The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OrderHistoryTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\OrderHistory The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OrderHistoryTableMap::COL_UPDATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setUpdatedAt()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->uid !== '') {
                return false;
            }

            if ($this->payment_file !== '') {
                return false;
            }

            if ($this->voucher !== '') {
                return false;
            }

            if ($this->deleted_payment !== 0) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : OrderHistoryTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : OrderHistoryTableMap::translateFieldName('IdOrder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_order = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : OrderHistoryTableMap::translateFieldName('IdOrderStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_order_status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : OrderHistoryTableMap::translateFieldName('AmountPaid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->amount_paid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : OrderHistoryTableMap::translateFieldName('TotalPaid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total_paid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : OrderHistoryTableMap::translateFieldName('IdPaymentMethod', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_payment_method = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : OrderHistoryTableMap::translateFieldName('IdPaymentStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_payment_status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : OrderHistoryTableMap::translateFieldName('Uid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->uid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : OrderHistoryTableMap::translateFieldName('PaymentFile', TableMap::TYPE_PHPNAME, $indexType)];
            $this->payment_file = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : OrderHistoryTableMap::translateFieldName('Voucher', TableMap::TYPE_PHPNAME, $indexType)];
            $this->voucher = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : OrderHistoryTableMap::translateFieldName('DeletedPayment', TableMap::TYPE_PHPNAME, $indexType)];
            $this->deleted_payment = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : OrderHistoryTableMap::translateFieldName('IdUser', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_user = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : OrderHistoryTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : OrderHistoryTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = OrderHistoryTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\OrderHistory'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aOrders !== null && $this->id_order !== $this->aOrders->getId()) {
            $this->aOrders = null;
        }
        if ($this->aOrderStatus !== null && $this->id_order_status !== $this->aOrderStatus->getId()) {
            $this->aOrderStatus = null;
        }
        if ($this->aPaymentMethods !== null && $this->id_payment_method !== $this->aPaymentMethods->getId()) {
            $this->aPaymentMethods = null;
        }
        if ($this->aPaymentStatus !== null && $this->id_payment_status !== $this->aPaymentStatus->getId()) {
            $this->aPaymentStatus = null;
        }
        if ($this->aUsers !== null && $this->id_user !== $this->aUsers->getId()) {
            $this->aUsers = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OrderHistoryTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildOrderHistoryQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aOrders = null;
            $this->aOrderStatus = null;
            $this->aPaymentMethods = null;
            $this->aPaymentStatus = null;
            $this->aUsers = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see OrderHistory::setDeleted()
     * @see OrderHistory::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderHistoryTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildOrderHistoryQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderHistoryTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                OrderHistoryTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aOrders !== null) {
                if ($this->aOrders->isModified() || $this->aOrders->isNew()) {
                    $affectedRows += $this->aOrders->save($con);
                }
                $this->setOrders($this->aOrders);
            }

            if ($this->aOrderStatus !== null) {
                if ($this->aOrderStatus->isModified() || $this->aOrderStatus->isNew()) {
                    $affectedRows += $this->aOrderStatus->save($con);
                }
                $this->setOrderStatus($this->aOrderStatus);
            }

            if ($this->aPaymentMethods !== null) {
                if ($this->aPaymentMethods->isModified() || $this->aPaymentMethods->isNew()) {
                    $affectedRows += $this->aPaymentMethods->save($con);
                }
                $this->setPaymentMethods($this->aPaymentMethods);
            }

            if ($this->aPaymentStatus !== null) {
                if ($this->aPaymentStatus->isModified() || $this->aPaymentStatus->isNew()) {
                    $affectedRows += $this->aPaymentStatus->save($con);
                }
                $this->setPaymentStatus($this->aPaymentStatus);
            }

            if ($this->aUsers !== null) {
                if ($this->aUsers->isModified() || $this->aUsers->isNew()) {
                    $affectedRows += $this->aUsers->save($con);
                }
                $this->setUsers($this->aUsers);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[OrderHistoryTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . OrderHistoryTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(OrderHistoryTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_ID_ORDER)) {
            $modifiedColumns[':p' . $index++]  = 'id_order';
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_ID_ORDER_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'id_order_status';
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_AMOUNT_PAID)) {
            $modifiedColumns[':p' . $index++]  = 'amount_paid';
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_TOTAL_PAID)) {
            $modifiedColumns[':p' . $index++]  = 'total_paid';
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_ID_PAYMENT_METHOD)) {
            $modifiedColumns[':p' . $index++]  = 'id_payment_method';
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_ID_PAYMENT_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'id_payment_status';
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_UID)) {
            $modifiedColumns[':p' . $index++]  = 'uid';
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_PAYMENT_FILE)) {
            $modifiedColumns[':p' . $index++]  = 'payment_file';
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_VOUCHER)) {
            $modifiedColumns[':p' . $index++]  = 'voucher';
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_DELETED_PAYMENT)) {
            $modifiedColumns[':p' . $index++]  = 'deleted_payment';
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_ID_USER)) {
            $modifiedColumns[':p' . $index++]  = 'id_user';
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO order_history (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'id_order':
                        $stmt->bindValue($identifier, $this->id_order, PDO::PARAM_INT);
                        break;
                    case 'id_order_status':
                        $stmt->bindValue($identifier, $this->id_order_status, PDO::PARAM_INT);
                        break;
                    case 'amount_paid':
                        $stmt->bindValue($identifier, $this->amount_paid, PDO::PARAM_STR);
                        break;
                    case 'total_paid':
                        $stmt->bindValue($identifier, $this->total_paid, PDO::PARAM_STR);
                        break;
                    case 'id_payment_method':
                        $stmt->bindValue($identifier, $this->id_payment_method, PDO::PARAM_INT);
                        break;
                    case 'id_payment_status':
                        $stmt->bindValue($identifier, $this->id_payment_status, PDO::PARAM_INT);
                        break;
                    case 'uid':
                        $stmt->bindValue($identifier, $this->uid, PDO::PARAM_STR);
                        break;
                    case 'payment_file':
                        $stmt->bindValue($identifier, $this->payment_file, PDO::PARAM_STR);
                        break;
                    case 'voucher':
                        $stmt->bindValue($identifier, $this->voucher, PDO::PARAM_STR);
                        break;
                    case 'deleted_payment':
                        $stmt->bindValue($identifier, $this->deleted_payment, PDO::PARAM_INT);
                        break;
                    case 'id_user':
                        $stmt->bindValue($identifier, $this->id_user, PDO::PARAM_INT);
                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at ? $this->updated_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = OrderHistoryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getIdOrder();
                break;
            case 2:
                return $this->getIdOrderStatus();
                break;
            case 3:
                return $this->getAmountPaid();
                break;
            case 4:
                return $this->getTotalPaid();
                break;
            case 5:
                return $this->getIdPaymentMethod();
                break;
            case 6:
                return $this->getIdPaymentStatus();
                break;
            case 7:
                return $this->getUid();
                break;
            case 8:
                return $this->getPaymentFile();
                break;
            case 9:
                return $this->getVoucher();
                break;
            case 10:
                return $this->getDeletedPayment();
                break;
            case 11:
                return $this->getIdUser();
                break;
            case 12:
                return $this->getCreatedAt();
                break;
            case 13:
                return $this->getUpdatedAt();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['OrderHistory'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['OrderHistory'][$this->hashCode()] = true;
        $keys = OrderHistoryTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getIdOrder(),
            $keys[2] => $this->getIdOrderStatus(),
            $keys[3] => $this->getAmountPaid(),
            $keys[4] => $this->getTotalPaid(),
            $keys[5] => $this->getIdPaymentMethod(),
            $keys[6] => $this->getIdPaymentStatus(),
            $keys[7] => $this->getUid(),
            $keys[8] => $this->getPaymentFile(),
            $keys[9] => $this->getVoucher(),
            $keys[10] => $this->getDeletedPayment(),
            $keys[11] => $this->getIdUser(),
            $keys[12] => $this->getCreatedAt(),
            $keys[13] => $this->getUpdatedAt(),
        );
        if ($result[$keys[12]] instanceof \DateTimeInterface) {
            $result[$keys[12]] = $result[$keys[12]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[13]] instanceof \DateTimeInterface) {
            $result[$keys[13]] = $result[$keys[13]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aOrders) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orders';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'orders';
                        break;
                    default:
                        $key = 'Orders';
                }

                $result[$key] = $this->aOrders->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aOrderStatus) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orderStatus';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'order_status';
                        break;
                    default:
                        $key = 'OrderStatus';
                }

                $result[$key] = $this->aOrderStatus->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPaymentMethods) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'paymentMethods';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'payment_methods';
                        break;
                    default:
                        $key = 'PaymentMethods';
                }

                $result[$key] = $this->aPaymentMethods->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aPaymentStatus) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'paymentStatus';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'payment_status';
                        break;
                    default:
                        $key = 'PaymentStatus';
                }

                $result[$key] = $this->aPaymentStatus->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'users';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'users';
                        break;
                    default:
                        $key = 'Users';
                }

                $result[$key] = $this->aUsers->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\OrderHistory
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = OrderHistoryTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\OrderHistory
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setIdOrder($value);
                break;
            case 2:
                $this->setIdOrderStatus($value);
                break;
            case 3:
                $this->setAmountPaid($value);
                break;
            case 4:
                $this->setTotalPaid($value);
                break;
            case 5:
                $this->setIdPaymentMethod($value);
                break;
            case 6:
                $this->setIdPaymentStatus($value);
                break;
            case 7:
                $this->setUid($value);
                break;
            case 8:
                $this->setPaymentFile($value);
                break;
            case 9:
                $this->setVoucher($value);
                break;
            case 10:
                $this->setDeletedPayment($value);
                break;
            case 11:
                $this->setIdUser($value);
                break;
            case 12:
                $this->setCreatedAt($value);
                break;
            case 13:
                $this->setUpdatedAt($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return     $this|\OrderHistory
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = OrderHistoryTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdOrder($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIdOrderStatus($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setAmountPaid($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setTotalPaid($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setIdPaymentMethod($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setIdPaymentStatus($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setUid($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setPaymentFile($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setVoucher($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setDeletedPayment($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setIdUser($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setCreatedAt($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setUpdatedAt($arr[$keys[13]]);
        }

        return $this;
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\OrderHistory The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(OrderHistoryTableMap::DATABASE_NAME);

        if ($this->isColumnModified(OrderHistoryTableMap::COL_ID)) {
            $criteria->add(OrderHistoryTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_ID_ORDER)) {
            $criteria->add(OrderHistoryTableMap::COL_ID_ORDER, $this->id_order);
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_ID_ORDER_STATUS)) {
            $criteria->add(OrderHistoryTableMap::COL_ID_ORDER_STATUS, $this->id_order_status);
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_AMOUNT_PAID)) {
            $criteria->add(OrderHistoryTableMap::COL_AMOUNT_PAID, $this->amount_paid);
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_TOTAL_PAID)) {
            $criteria->add(OrderHistoryTableMap::COL_TOTAL_PAID, $this->total_paid);
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_ID_PAYMENT_METHOD)) {
            $criteria->add(OrderHistoryTableMap::COL_ID_PAYMENT_METHOD, $this->id_payment_method);
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_ID_PAYMENT_STATUS)) {
            $criteria->add(OrderHistoryTableMap::COL_ID_PAYMENT_STATUS, $this->id_payment_status);
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_UID)) {
            $criteria->add(OrderHistoryTableMap::COL_UID, $this->uid);
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_PAYMENT_FILE)) {
            $criteria->add(OrderHistoryTableMap::COL_PAYMENT_FILE, $this->payment_file);
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_VOUCHER)) {
            $criteria->add(OrderHistoryTableMap::COL_VOUCHER, $this->voucher);
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_DELETED_PAYMENT)) {
            $criteria->add(OrderHistoryTableMap::COL_DELETED_PAYMENT, $this->deleted_payment);
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_ID_USER)) {
            $criteria->add(OrderHistoryTableMap::COL_ID_USER, $this->id_user);
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_CREATED_AT)) {
            $criteria->add(OrderHistoryTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(OrderHistoryTableMap::COL_UPDATED_AT)) {
            $criteria->add(OrderHistoryTableMap::COL_UPDATED_AT, $this->updated_at);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildOrderHistoryQuery::create();
        $criteria->add(OrderHistoryTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \OrderHistory (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdOrder($this->getIdOrder());
        $copyObj->setIdOrderStatus($this->getIdOrderStatus());
        $copyObj->setAmountPaid($this->getAmountPaid());
        $copyObj->setTotalPaid($this->getTotalPaid());
        $copyObj->setIdPaymentMethod($this->getIdPaymentMethod());
        $copyObj->setIdPaymentStatus($this->getIdPaymentStatus());
        $copyObj->setUid($this->getUid());
        $copyObj->setPaymentFile($this->getPaymentFile());
        $copyObj->setVoucher($this->getVoucher());
        $copyObj->setDeletedPayment($this->getDeletedPayment());
        $copyObj->setIdUser($this->getIdUser());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \OrderHistory Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildOrders object.
     *
     * @param  ChildOrders $v
     * @return $this|\OrderHistory The current object (for fluent API support)
     * @throws PropelException
     */
    public function setOrders(ChildOrders $v = null)
    {
        if ($v === null) {
            $this->setIdOrder(NULL);
        } else {
            $this->setIdOrder($v->getId());
        }

        $this->aOrders = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOrders object, it will not be re-added.
        if ($v !== null) {
            $v->addOrderHistory($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOrders object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildOrders The associated ChildOrders object.
     * @throws PropelException
     */
    public function getOrders(ConnectionInterface $con = null)
    {
        if ($this->aOrders === null && ($this->id_order != 0)) {
            $this->aOrders = ChildOrdersQuery::create()->findPk($this->id_order, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOrders->addOrderHistories($this);
             */
        }

        return $this->aOrders;
    }

    /**
     * Declares an association between this object and a ChildOrderStatus object.
     *
     * @param  ChildOrderStatus $v
     * @return $this|\OrderHistory The current object (for fluent API support)
     * @throws PropelException
     */
    public function setOrderStatus(ChildOrderStatus $v = null)
    {
        if ($v === null) {
            $this->setIdOrderStatus(NULL);
        } else {
            $this->setIdOrderStatus($v->getId());
        }

        $this->aOrderStatus = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOrderStatus object, it will not be re-added.
        if ($v !== null) {
            $v->addOrderHistory($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOrderStatus object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildOrderStatus The associated ChildOrderStatus object.
     * @throws PropelException
     */
    public function getOrderStatus(ConnectionInterface $con = null)
    {
        if ($this->aOrderStatus === null && ($this->id_order_status != 0)) {
            $this->aOrderStatus = ChildOrderStatusQuery::create()->findPk($this->id_order_status, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOrderStatus->addOrderHistories($this);
             */
        }

        return $this->aOrderStatus;
    }

    /**
     * Declares an association between this object and a ChildPaymentMethods object.
     *
     * @param  ChildPaymentMethods $v
     * @return $this|\OrderHistory The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPaymentMethods(ChildPaymentMethods $v = null)
    {
        if ($v === null) {
            $this->setIdPaymentMethod(NULL);
        } else {
            $this->setIdPaymentMethod($v->getId());
        }

        $this->aPaymentMethods = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPaymentMethods object, it will not be re-added.
        if ($v !== null) {
            $v->addOrderHistory($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPaymentMethods object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPaymentMethods The associated ChildPaymentMethods object.
     * @throws PropelException
     */
    public function getPaymentMethods(ConnectionInterface $con = null)
    {
        if ($this->aPaymentMethods === null && ($this->id_payment_method != 0)) {
            $this->aPaymentMethods = ChildPaymentMethodsQuery::create()->findPk($this->id_payment_method, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPaymentMethods->addOrderHistories($this);
             */
        }

        return $this->aPaymentMethods;
    }

    /**
     * Declares an association between this object and a ChildPaymentStatus object.
     *
     * @param  ChildPaymentStatus|null $v
     * @return $this|\OrderHistory The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPaymentStatus(ChildPaymentStatus $v = null)
    {
        if ($v === null) {
            $this->setIdPaymentStatus(NULL);
        } else {
            $this->setIdPaymentStatus($v->getId());
        }

        $this->aPaymentStatus = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPaymentStatus object, it will not be re-added.
        if ($v !== null) {
            $v->addOrderHistory($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPaymentStatus object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPaymentStatus|null The associated ChildPaymentStatus object.
     * @throws PropelException
     */
    public function getPaymentStatus(ConnectionInterface $con = null)
    {
        if ($this->aPaymentStatus === null && ($this->id_payment_status != 0)) {
            $this->aPaymentStatus = ChildPaymentStatusQuery::create()->findPk($this->id_payment_status, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPaymentStatus->addOrderHistories($this);
             */
        }

        return $this->aPaymentStatus;
    }

    /**
     * Declares an association between this object and a ChildUsers object.
     *
     * @param  ChildUsers $v
     * @return $this|\OrderHistory The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUsers(ChildUsers $v = null)
    {
        if ($v === null) {
            $this->setIdUser(NULL);
        } else {
            $this->setIdUser($v->getId());
        }

        $this->aUsers = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUsers object, it will not be re-added.
        if ($v !== null) {
            $v->addOrderHistory($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUsers object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUsers The associated ChildUsers object.
     * @throws PropelException
     */
    public function getUsers(ConnectionInterface $con = null)
    {
        if ($this->aUsers === null && ($this->id_user != 0)) {
            $this->aUsers = ChildUsersQuery::create()->findPk($this->id_user, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUsers->addOrderHistories($this);
             */
        }

        return $this->aUsers;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aOrders) {
            $this->aOrders->removeOrderHistory($this);
        }
        if (null !== $this->aOrderStatus) {
            $this->aOrderStatus->removeOrderHistory($this);
        }
        if (null !== $this->aPaymentMethods) {
            $this->aPaymentMethods->removeOrderHistory($this);
        }
        if (null !== $this->aPaymentStatus) {
            $this->aPaymentStatus->removeOrderHistory($this);
        }
        if (null !== $this->aUsers) {
            $this->aUsers->removeOrderHistory($this);
        }
        $this->id = null;
        $this->id_order = null;
        $this->id_order_status = null;
        $this->amount_paid = null;
        $this->total_paid = null;
        $this->id_payment_method = null;
        $this->id_payment_status = null;
        $this->uid = null;
        $this->payment_file = null;
        $this->voucher = null;
        $this->deleted_payment = null;
        $this->id_user = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

        $this->aOrders = null;
        $this->aOrderStatus = null;
        $this->aPaymentMethods = null;
        $this->aPaymentStatus = null;
        $this->aUsers = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(OrderHistoryTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
