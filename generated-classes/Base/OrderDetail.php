<?php

namespace Base;

use \Colors as ChildColors;
use \ColorsQuery as ChildColorsQuery;
use \Defects as ChildDefects;
use \DefectsQuery as ChildDefectsQuery;
use \OrderDetail as ChildOrderDetail;
use \OrderDetailHistory as ChildOrderDetailHistory;
use \OrderDetailHistoryQuery as ChildOrderDetailHistoryQuery;
use \OrderDetailQuery as ChildOrderDetailQuery;
use \OrderDetailStatus as ChildOrderDetailStatus;
use \OrderDetailStatusQuery as ChildOrderDetailStatusQuery;
use \Orders as ChildOrders;
use \OrdersQuery as ChildOrdersQuery;
use \Prints as ChildPrints;
use \PrintsQuery as ChildPrintsQuery;
use \Services as ChildServices;
use \ServicesQuery as ChildServicesQuery;
use \Users as ChildUsers;
use \UsersQuery as ChildUsersQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\OrderDetailHistoryTableMap;
use Map\OrderDetailTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'order_detail' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class OrderDetail implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\OrderDetailTableMap';


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
     * The value for the id_order_detail_status field.
     *
     * @var        int
     */
    protected $id_order_detail_status;

    /**
     * The value for the quantity field.
     *
     * @var        string
     */
    protected $quantity;

    /**
     * The value for the id_color field.
     *
     * @var        int
     */
    protected $id_color;

    /**
     * The value for the id_print field.
     *
     * @var        int
     */
    protected $id_print;

    /**
     * The value for the id_defect field.
     *
     * @var        int
     */
    protected $id_defect;

    /**
     * The value for the id_service field.
     *
     * @var        int
     */
    protected $id_service;

    /**
     * The value for the observations field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $observations;

    /**
     * The value for the location field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $location;

    /**
     * The value for the price field.
     *
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $price;

    /**
     * The value for the discount field.
     *
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $discount;

    /**
     * The value for the subtotal field.
     *
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $subtotal;

    /**
     * The value for the total field.
     *
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $total;

    /**
     * The value for the real_delivery_date field.
     *
     * @var        DateTime|null
     */
    protected $real_delivery_date;

    /**
     * The value for the real_delivery_time field.
     *
     * @var        DateTime|null
     */
    protected $real_delivery_time;

    /**
     * The value for the id_delivery_user field.
     *
     * @var        int|null
     */
    protected $id_delivery_user;

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
     * @var        ChildColors
     */
    protected $aColors;

    /**
     * @var        ChildDefects
     */
    protected $aDefects;

    /**
     * @var        ChildUsers
     */
    protected $aUsers;

    /**
     * @var        ChildOrderDetailStatus
     */
    protected $aOrderDetailStatus;

    /**
     * @var        ChildOrders
     */
    protected $aOrders;

    /**
     * @var        ChildPrints
     */
    protected $aPrints;

    /**
     * @var        ChildServices
     */
    protected $aServices;

    /**
     * @var        ObjectCollection|ChildOrderDetailHistory[] Collection to store aggregation of ChildOrderDetailHistory objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrderDetailHistory> Collection to store aggregation of ChildOrderDetailHistory objects.
     */
    protected $collOrderDetailHistories;
    protected $collOrderDetailHistoriesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrderDetailHistory[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrderDetailHistory>
     */
    protected $orderDetailHistoriesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->observations = '';
        $this->location = '';
        $this->price = '0.00';
        $this->discount = '0.00';
        $this->subtotal = '0.00';
        $this->total = '0.00';
    }

    /**
     * Initializes internal state of Base\OrderDetail object.
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
     * Compares this with another <code>OrderDetail</code> instance.  If
     * <code>obj</code> is an instance of <code>OrderDetail</code>, delegates to
     * <code>equals(OrderDetail)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_order_detail_status] column value.
     *
     * @return int
     */
    public function getIdOrderDetailStatus()
    {
        return $this->id_order_detail_status;
    }

    /**
     * Get the [quantity] column value.
     *
     * @return string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Get the [id_color] column value.
     *
     * @return int
     */
    public function getIdColor()
    {
        return $this->id_color;
    }

    /**
     * Get the [id_print] column value.
     *
     * @return int
     */
    public function getIdPrint()
    {
        return $this->id_print;
    }

    /**
     * Get the [id_defect] column value.
     *
     * @return int
     */
    public function getIdDefect()
    {
        return $this->id_defect;
    }

    /**
     * Get the [id_service] column value.
     *
     * @return int
     */
    public function getIdService()
    {
        return $this->id_service;
    }

    /**
     * Get the [observations] column value.
     *
     * @return string
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * Get the [location] column value.
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Get the [price] column value.
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Get the [discount] column value.
     *
     * @return string
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Get the [subtotal] column value.
     *
     * @return string
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * Get the [total] column value.
     *
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Get the [optionally formatted] temporal [real_delivery_date] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getRealDeliveryDate($format = 'Y-m-d')
    {
        if ($format === null) {
            return $this->real_delivery_date;
        } else {
            return $this->real_delivery_date instanceof \DateTimeInterface ? $this->real_delivery_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [real_delivery_time] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getRealDeliveryTime($format = 'H:i:s')
    {
        if ($format === null) {
            return $this->real_delivery_time;
        } else {
            return $this->real_delivery_time instanceof \DateTimeInterface ? $this->real_delivery_time->format($format) : null;
        }
    }

    /**
     * Get the [id_delivery_user] column value.
     *
     * @return int|null
     */
    public function getIdDeliveryUser()
    {
        return $this->id_delivery_user;
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
     * @return $this|\OrderDetail The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[OrderDetailTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [id_order] column.
     *
     * @param int $v New value
     * @return $this|\OrderDetail The current object (for fluent API support)
     */
    public function setIdOrder($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_order !== $v) {
            $this->id_order = $v;
            $this->modifiedColumns[OrderDetailTableMap::COL_ID_ORDER] = true;
        }

        if ($this->aOrders !== null && $this->aOrders->getId() !== $v) {
            $this->aOrders = null;
        }

        return $this;
    } // setIdOrder()

    /**
     * Set the value of [id_order_detail_status] column.
     *
     * @param int $v New value
     * @return $this|\OrderDetail The current object (for fluent API support)
     */
    public function setIdOrderDetailStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_order_detail_status !== $v) {
            $this->id_order_detail_status = $v;
            $this->modifiedColumns[OrderDetailTableMap::COL_ID_ORDER_DETAIL_STATUS] = true;
        }

        if ($this->aOrderDetailStatus !== null && $this->aOrderDetailStatus->getId() !== $v) {
            $this->aOrderDetailStatus = null;
        }

        return $this;
    } // setIdOrderDetailStatus()

    /**
     * Set the value of [quantity] column.
     *
     * @param string $v New value
     * @return $this|\OrderDetail The current object (for fluent API support)
     */
    public function setQuantity($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->quantity !== $v) {
            $this->quantity = $v;
            $this->modifiedColumns[OrderDetailTableMap::COL_QUANTITY] = true;
        }

        return $this;
    } // setQuantity()

    /**
     * Set the value of [id_color] column.
     *
     * @param int $v New value
     * @return $this|\OrderDetail The current object (for fluent API support)
     */
    public function setIdColor($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_color !== $v) {
            $this->id_color = $v;
            $this->modifiedColumns[OrderDetailTableMap::COL_ID_COLOR] = true;
        }

        if ($this->aColors !== null && $this->aColors->getId() !== $v) {
            $this->aColors = null;
        }

        return $this;
    } // setIdColor()

    /**
     * Set the value of [id_print] column.
     *
     * @param int $v New value
     * @return $this|\OrderDetail The current object (for fluent API support)
     */
    public function setIdPrint($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_print !== $v) {
            $this->id_print = $v;
            $this->modifiedColumns[OrderDetailTableMap::COL_ID_PRINT] = true;
        }

        if ($this->aPrints !== null && $this->aPrints->getId() !== $v) {
            $this->aPrints = null;
        }

        return $this;
    } // setIdPrint()

    /**
     * Set the value of [id_defect] column.
     *
     * @param int $v New value
     * @return $this|\OrderDetail The current object (for fluent API support)
     */
    public function setIdDefect($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_defect !== $v) {
            $this->id_defect = $v;
            $this->modifiedColumns[OrderDetailTableMap::COL_ID_DEFECT] = true;
        }

        if ($this->aDefects !== null && $this->aDefects->getId() !== $v) {
            $this->aDefects = null;
        }

        return $this;
    } // setIdDefect()

    /**
     * Set the value of [id_service] column.
     *
     * @param int $v New value
     * @return $this|\OrderDetail The current object (for fluent API support)
     */
    public function setIdService($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_service !== $v) {
            $this->id_service = $v;
            $this->modifiedColumns[OrderDetailTableMap::COL_ID_SERVICE] = true;
        }

        if ($this->aServices !== null && $this->aServices->getId() !== $v) {
            $this->aServices = null;
        }

        return $this;
    } // setIdService()

    /**
     * Set the value of [observations] column.
     *
     * @param string $v New value
     * @return $this|\OrderDetail The current object (for fluent API support)
     */
    public function setObservations($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->observations !== $v) {
            $this->observations = $v;
            $this->modifiedColumns[OrderDetailTableMap::COL_OBSERVATIONS] = true;
        }

        return $this;
    } // setObservations()

    /**
     * Set the value of [location] column.
     *
     * @param string $v New value
     * @return $this|\OrderDetail The current object (for fluent API support)
     */
    public function setLocation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->location !== $v) {
            $this->location = $v;
            $this->modifiedColumns[OrderDetailTableMap::COL_LOCATION] = true;
        }

        return $this;
    } // setLocation()

    /**
     * Set the value of [price] column.
     *
     * @param string $v New value
     * @return $this|\OrderDetail The current object (for fluent API support)
     */
    public function setPrice($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->price !== $v) {
            $this->price = $v;
            $this->modifiedColumns[OrderDetailTableMap::COL_PRICE] = true;
        }

        return $this;
    } // setPrice()

    /**
     * Set the value of [discount] column.
     *
     * @param string $v New value
     * @return $this|\OrderDetail The current object (for fluent API support)
     */
    public function setDiscount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->discount !== $v) {
            $this->discount = $v;
            $this->modifiedColumns[OrderDetailTableMap::COL_DISCOUNT] = true;
        }

        return $this;
    } // setDiscount()

    /**
     * Set the value of [subtotal] column.
     *
     * @param string $v New value
     * @return $this|\OrderDetail The current object (for fluent API support)
     */
    public function setSubtotal($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->subtotal !== $v) {
            $this->subtotal = $v;
            $this->modifiedColumns[OrderDetailTableMap::COL_SUBTOTAL] = true;
        }

        return $this;
    } // setSubtotal()

    /**
     * Set the value of [total] column.
     *
     * @param string $v New value
     * @return $this|\OrderDetail The current object (for fluent API support)
     */
    public function setTotal($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->total !== $v) {
            $this->total = $v;
            $this->modifiedColumns[OrderDetailTableMap::COL_TOTAL] = true;
        }

        return $this;
    } // setTotal()

    /**
     * Sets the value of [real_delivery_date] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\OrderDetail The current object (for fluent API support)
     */
    public function setRealDeliveryDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->real_delivery_date !== null || $dt !== null) {
            if ($this->real_delivery_date === null || $dt === null || $dt->format("Y-m-d") !== $this->real_delivery_date->format("Y-m-d")) {
                $this->real_delivery_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OrderDetailTableMap::COL_REAL_DELIVERY_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setRealDeliveryDate()

    /**
     * Sets the value of [real_delivery_time] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\OrderDetail The current object (for fluent API support)
     */
    public function setRealDeliveryTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->real_delivery_time !== null || $dt !== null) {
            if ($this->real_delivery_time === null || $dt === null || $dt->format("H:i:s.u") !== $this->real_delivery_time->format("H:i:s.u")) {
                $this->real_delivery_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OrderDetailTableMap::COL_REAL_DELIVERY_TIME] = true;
            }
        } // if either are not null

        return $this;
    } // setRealDeliveryTime()

    /**
     * Set the value of [id_delivery_user] column.
     *
     * @param int|null $v New value
     * @return $this|\OrderDetail The current object (for fluent API support)
     */
    public function setIdDeliveryUser($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_delivery_user !== $v) {
            $this->id_delivery_user = $v;
            $this->modifiedColumns[OrderDetailTableMap::COL_ID_DELIVERY_USER] = true;
        }

        if ($this->aUsers !== null && $this->aUsers->getId() !== $v) {
            $this->aUsers = null;
        }

        return $this;
    } // setIdDeliveryUser()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\OrderDetail The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OrderDetailTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\OrderDetail The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OrderDetailTableMap::COL_UPDATED_AT] = true;
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
            if ($this->observations !== '') {
                return false;
            }

            if ($this->location !== '') {
                return false;
            }

            if ($this->price !== '0.00') {
                return false;
            }

            if ($this->discount !== '0.00') {
                return false;
            }

            if ($this->subtotal !== '0.00') {
                return false;
            }

            if ($this->total !== '0.00') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : OrderDetailTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : OrderDetailTableMap::translateFieldName('IdOrder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_order = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : OrderDetailTableMap::translateFieldName('IdOrderDetailStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_order_detail_status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : OrderDetailTableMap::translateFieldName('Quantity', TableMap::TYPE_PHPNAME, $indexType)];
            $this->quantity = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : OrderDetailTableMap::translateFieldName('IdColor', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_color = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : OrderDetailTableMap::translateFieldName('IdPrint', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_print = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : OrderDetailTableMap::translateFieldName('IdDefect', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_defect = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : OrderDetailTableMap::translateFieldName('IdService', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_service = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : OrderDetailTableMap::translateFieldName('Observations', TableMap::TYPE_PHPNAME, $indexType)];
            $this->observations = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : OrderDetailTableMap::translateFieldName('Location', TableMap::TYPE_PHPNAME, $indexType)];
            $this->location = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : OrderDetailTableMap::translateFieldName('Price', TableMap::TYPE_PHPNAME, $indexType)];
            $this->price = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : OrderDetailTableMap::translateFieldName('Discount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->discount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : OrderDetailTableMap::translateFieldName('Subtotal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->subtotal = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : OrderDetailTableMap::translateFieldName('Total', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : OrderDetailTableMap::translateFieldName('RealDeliveryDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->real_delivery_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : OrderDetailTableMap::translateFieldName('RealDeliveryTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->real_delivery_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : OrderDetailTableMap::translateFieldName('IdDeliveryUser', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_delivery_user = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : OrderDetailTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : OrderDetailTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 19; // 19 = OrderDetailTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\OrderDetail'), 0, $e);
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
        if ($this->aOrderDetailStatus !== null && $this->id_order_detail_status !== $this->aOrderDetailStatus->getId()) {
            $this->aOrderDetailStatus = null;
        }
        if ($this->aColors !== null && $this->id_color !== $this->aColors->getId()) {
            $this->aColors = null;
        }
        if ($this->aPrints !== null && $this->id_print !== $this->aPrints->getId()) {
            $this->aPrints = null;
        }
        if ($this->aDefects !== null && $this->id_defect !== $this->aDefects->getId()) {
            $this->aDefects = null;
        }
        if ($this->aServices !== null && $this->id_service !== $this->aServices->getId()) {
            $this->aServices = null;
        }
        if ($this->aUsers !== null && $this->id_delivery_user !== $this->aUsers->getId()) {
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
            $con = Propel::getServiceContainer()->getReadConnection(OrderDetailTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildOrderDetailQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aColors = null;
            $this->aDefects = null;
            $this->aUsers = null;
            $this->aOrderDetailStatus = null;
            $this->aOrders = null;
            $this->aPrints = null;
            $this->aServices = null;
            $this->collOrderDetailHistories = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see OrderDetail::setDeleted()
     * @see OrderDetail::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrderDetailTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildOrderDetailQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(OrderDetailTableMap::DATABASE_NAME);
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
                OrderDetailTableMap::addInstanceToPool($this);
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

            if ($this->aColors !== null) {
                if ($this->aColors->isModified() || $this->aColors->isNew()) {
                    $affectedRows += $this->aColors->save($con);
                }
                $this->setColors($this->aColors);
            }

            if ($this->aDefects !== null) {
                if ($this->aDefects->isModified() || $this->aDefects->isNew()) {
                    $affectedRows += $this->aDefects->save($con);
                }
                $this->setDefects($this->aDefects);
            }

            if ($this->aUsers !== null) {
                if ($this->aUsers->isModified() || $this->aUsers->isNew()) {
                    $affectedRows += $this->aUsers->save($con);
                }
                $this->setUsers($this->aUsers);
            }

            if ($this->aOrderDetailStatus !== null) {
                if ($this->aOrderDetailStatus->isModified() || $this->aOrderDetailStatus->isNew()) {
                    $affectedRows += $this->aOrderDetailStatus->save($con);
                }
                $this->setOrderDetailStatus($this->aOrderDetailStatus);
            }

            if ($this->aOrders !== null) {
                if ($this->aOrders->isModified() || $this->aOrders->isNew()) {
                    $affectedRows += $this->aOrders->save($con);
                }
                $this->setOrders($this->aOrders);
            }

            if ($this->aPrints !== null) {
                if ($this->aPrints->isModified() || $this->aPrints->isNew()) {
                    $affectedRows += $this->aPrints->save($con);
                }
                $this->setPrints($this->aPrints);
            }

            if ($this->aServices !== null) {
                if ($this->aServices->isModified() || $this->aServices->isNew()) {
                    $affectedRows += $this->aServices->save($con);
                }
                $this->setServices($this->aServices);
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

            if ($this->orderDetailHistoriesScheduledForDeletion !== null) {
                if (!$this->orderDetailHistoriesScheduledForDeletion->isEmpty()) {
                    \OrderDetailHistoryQuery::create()
                        ->filterByPrimaryKeys($this->orderDetailHistoriesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->orderDetailHistoriesScheduledForDeletion = null;
                }
            }

            if ($this->collOrderDetailHistories !== null) {
                foreach ($this->collOrderDetailHistories as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

        $this->modifiedColumns[OrderDetailTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . OrderDetailTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(OrderDetailTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_ID_ORDER)) {
            $modifiedColumns[':p' . $index++]  = 'id_order';
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_ID_ORDER_DETAIL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'id_order_detail_status';
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_QUANTITY)) {
            $modifiedColumns[':p' . $index++]  = 'quantity';
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_ID_COLOR)) {
            $modifiedColumns[':p' . $index++]  = 'id_color';
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_ID_PRINT)) {
            $modifiedColumns[':p' . $index++]  = 'id_print';
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_ID_DEFECT)) {
            $modifiedColumns[':p' . $index++]  = 'id_defect';
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_ID_SERVICE)) {
            $modifiedColumns[':p' . $index++]  = 'id_service';
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_OBSERVATIONS)) {
            $modifiedColumns[':p' . $index++]  = 'observations';
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_LOCATION)) {
            $modifiedColumns[':p' . $index++]  = 'location';
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_PRICE)) {
            $modifiedColumns[':p' . $index++]  = 'price';
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_DISCOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'discount';
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_SUBTOTAL)) {
            $modifiedColumns[':p' . $index++]  = 'subtotal';
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_TOTAL)) {
            $modifiedColumns[':p' . $index++]  = 'total';
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_REAL_DELIVERY_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'real_delivery_date';
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_REAL_DELIVERY_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'real_delivery_time';
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_ID_DELIVERY_USER)) {
            $modifiedColumns[':p' . $index++]  = 'id_delivery_user';
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO order_detail (%s) VALUES (%s)',
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
                    case 'id_order_detail_status':
                        $stmt->bindValue($identifier, $this->id_order_detail_status, PDO::PARAM_INT);
                        break;
                    case 'quantity':
                        $stmt->bindValue($identifier, $this->quantity, PDO::PARAM_STR);
                        break;
                    case 'id_color':
                        $stmt->bindValue($identifier, $this->id_color, PDO::PARAM_INT);
                        break;
                    case 'id_print':
                        $stmt->bindValue($identifier, $this->id_print, PDO::PARAM_INT);
                        break;
                    case 'id_defect':
                        $stmt->bindValue($identifier, $this->id_defect, PDO::PARAM_INT);
                        break;
                    case 'id_service':
                        $stmt->bindValue($identifier, $this->id_service, PDO::PARAM_INT);
                        break;
                    case 'observations':
                        $stmt->bindValue($identifier, $this->observations, PDO::PARAM_STR);
                        break;
                    case 'location':
                        $stmt->bindValue($identifier, $this->location, PDO::PARAM_STR);
                        break;
                    case 'price':
                        $stmt->bindValue($identifier, $this->price, PDO::PARAM_STR);
                        break;
                    case 'discount':
                        $stmt->bindValue($identifier, $this->discount, PDO::PARAM_STR);
                        break;
                    case 'subtotal':
                        $stmt->bindValue($identifier, $this->subtotal, PDO::PARAM_STR);
                        break;
                    case 'total':
                        $stmt->bindValue($identifier, $this->total, PDO::PARAM_STR);
                        break;
                    case 'real_delivery_date':
                        $stmt->bindValue($identifier, $this->real_delivery_date ? $this->real_delivery_date->format("Y-m-d") : null, PDO::PARAM_STR);
                        break;
                    case 'real_delivery_time':
                        $stmt->bindValue($identifier, $this->real_delivery_time ? $this->real_delivery_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'id_delivery_user':
                        $stmt->bindValue($identifier, $this->id_delivery_user, PDO::PARAM_INT);
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
        $pos = OrderDetailTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdOrderDetailStatus();
                break;
            case 3:
                return $this->getQuantity();
                break;
            case 4:
                return $this->getIdColor();
                break;
            case 5:
                return $this->getIdPrint();
                break;
            case 6:
                return $this->getIdDefect();
                break;
            case 7:
                return $this->getIdService();
                break;
            case 8:
                return $this->getObservations();
                break;
            case 9:
                return $this->getLocation();
                break;
            case 10:
                return $this->getPrice();
                break;
            case 11:
                return $this->getDiscount();
                break;
            case 12:
                return $this->getSubtotal();
                break;
            case 13:
                return $this->getTotal();
                break;
            case 14:
                return $this->getRealDeliveryDate();
                break;
            case 15:
                return $this->getRealDeliveryTime();
                break;
            case 16:
                return $this->getIdDeliveryUser();
                break;
            case 17:
                return $this->getCreatedAt();
                break;
            case 18:
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

        if (isset($alreadyDumpedObjects['OrderDetail'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['OrderDetail'][$this->hashCode()] = true;
        $keys = OrderDetailTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getIdOrder(),
            $keys[2] => $this->getIdOrderDetailStatus(),
            $keys[3] => $this->getQuantity(),
            $keys[4] => $this->getIdColor(),
            $keys[5] => $this->getIdPrint(),
            $keys[6] => $this->getIdDefect(),
            $keys[7] => $this->getIdService(),
            $keys[8] => $this->getObservations(),
            $keys[9] => $this->getLocation(),
            $keys[10] => $this->getPrice(),
            $keys[11] => $this->getDiscount(),
            $keys[12] => $this->getSubtotal(),
            $keys[13] => $this->getTotal(),
            $keys[14] => $this->getRealDeliveryDate(),
            $keys[15] => $this->getRealDeliveryTime(),
            $keys[16] => $this->getIdDeliveryUser(),
            $keys[17] => $this->getCreatedAt(),
            $keys[18] => $this->getUpdatedAt(),
        );
        if ($result[$keys[14]] instanceof \DateTimeInterface) {
            $result[$keys[14]] = $result[$keys[14]]->format('Y-m-d');
        }

        if ($result[$keys[15]] instanceof \DateTimeInterface) {
            $result[$keys[15]] = $result[$keys[15]]->format('H:i:s.u');
        }

        if ($result[$keys[17]] instanceof \DateTimeInterface) {
            $result[$keys[17]] = $result[$keys[17]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[18]] instanceof \DateTimeInterface) {
            $result[$keys[18]] = $result[$keys[18]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aColors) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'colors';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'colors';
                        break;
                    default:
                        $key = 'Colors';
                }

                $result[$key] = $this->aColors->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aDefects) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'defects';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'defects';
                        break;
                    default:
                        $key = 'Defects';
                }

                $result[$key] = $this->aDefects->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->aOrderDetailStatus) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orderDetailStatus';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'order_detail_status';
                        break;
                    default:
                        $key = 'OrderDetailStatus';
                }

                $result[$key] = $this->aOrderDetailStatus->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
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
            if (null !== $this->aPrints) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'prints';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'prints';
                        break;
                    default:
                        $key = 'Prints';
                }

                $result[$key] = $this->aPrints->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aServices) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'services';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'services';
                        break;
                    default:
                        $key = 'Services';
                }

                $result[$key] = $this->aServices->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collOrderDetailHistories) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orderDetailHistories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'order_detail_histories';
                        break;
                    default:
                        $key = 'OrderDetailHistories';
                }

                $result[$key] = $this->collOrderDetailHistories->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\OrderDetail
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = OrderDetailTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\OrderDetail
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
                $this->setIdOrderDetailStatus($value);
                break;
            case 3:
                $this->setQuantity($value);
                break;
            case 4:
                $this->setIdColor($value);
                break;
            case 5:
                $this->setIdPrint($value);
                break;
            case 6:
                $this->setIdDefect($value);
                break;
            case 7:
                $this->setIdService($value);
                break;
            case 8:
                $this->setObservations($value);
                break;
            case 9:
                $this->setLocation($value);
                break;
            case 10:
                $this->setPrice($value);
                break;
            case 11:
                $this->setDiscount($value);
                break;
            case 12:
                $this->setSubtotal($value);
                break;
            case 13:
                $this->setTotal($value);
                break;
            case 14:
                $this->setRealDeliveryDate($value);
                break;
            case 15:
                $this->setRealDeliveryTime($value);
                break;
            case 16:
                $this->setIdDeliveryUser($value);
                break;
            case 17:
                $this->setCreatedAt($value);
                break;
            case 18:
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
     * @return     $this|\OrderDetail
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = OrderDetailTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdOrder($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIdOrderDetailStatus($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setQuantity($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setIdColor($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setIdPrint($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setIdDefect($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setIdService($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setObservations($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setLocation($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setPrice($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setDiscount($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setSubtotal($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setTotal($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setRealDeliveryDate($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setRealDeliveryTime($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setIdDeliveryUser($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setCreatedAt($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setUpdatedAt($arr[$keys[18]]);
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
     * @return $this|\OrderDetail The current object, for fluid interface
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
        $criteria = new Criteria(OrderDetailTableMap::DATABASE_NAME);

        if ($this->isColumnModified(OrderDetailTableMap::COL_ID)) {
            $criteria->add(OrderDetailTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_ID_ORDER)) {
            $criteria->add(OrderDetailTableMap::COL_ID_ORDER, $this->id_order);
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_ID_ORDER_DETAIL_STATUS)) {
            $criteria->add(OrderDetailTableMap::COL_ID_ORDER_DETAIL_STATUS, $this->id_order_detail_status);
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_QUANTITY)) {
            $criteria->add(OrderDetailTableMap::COL_QUANTITY, $this->quantity);
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_ID_COLOR)) {
            $criteria->add(OrderDetailTableMap::COL_ID_COLOR, $this->id_color);
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_ID_PRINT)) {
            $criteria->add(OrderDetailTableMap::COL_ID_PRINT, $this->id_print);
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_ID_DEFECT)) {
            $criteria->add(OrderDetailTableMap::COL_ID_DEFECT, $this->id_defect);
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_ID_SERVICE)) {
            $criteria->add(OrderDetailTableMap::COL_ID_SERVICE, $this->id_service);
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_OBSERVATIONS)) {
            $criteria->add(OrderDetailTableMap::COL_OBSERVATIONS, $this->observations);
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_LOCATION)) {
            $criteria->add(OrderDetailTableMap::COL_LOCATION, $this->location);
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_PRICE)) {
            $criteria->add(OrderDetailTableMap::COL_PRICE, $this->price);
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_DISCOUNT)) {
            $criteria->add(OrderDetailTableMap::COL_DISCOUNT, $this->discount);
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_SUBTOTAL)) {
            $criteria->add(OrderDetailTableMap::COL_SUBTOTAL, $this->subtotal);
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_TOTAL)) {
            $criteria->add(OrderDetailTableMap::COL_TOTAL, $this->total);
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_REAL_DELIVERY_DATE)) {
            $criteria->add(OrderDetailTableMap::COL_REAL_DELIVERY_DATE, $this->real_delivery_date);
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_REAL_DELIVERY_TIME)) {
            $criteria->add(OrderDetailTableMap::COL_REAL_DELIVERY_TIME, $this->real_delivery_time);
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_ID_DELIVERY_USER)) {
            $criteria->add(OrderDetailTableMap::COL_ID_DELIVERY_USER, $this->id_delivery_user);
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_CREATED_AT)) {
            $criteria->add(OrderDetailTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(OrderDetailTableMap::COL_UPDATED_AT)) {
            $criteria->add(OrderDetailTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildOrderDetailQuery::create();
        $criteria->add(OrderDetailTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \OrderDetail (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdOrder($this->getIdOrder());
        $copyObj->setIdOrderDetailStatus($this->getIdOrderDetailStatus());
        $copyObj->setQuantity($this->getQuantity());
        $copyObj->setIdColor($this->getIdColor());
        $copyObj->setIdPrint($this->getIdPrint());
        $copyObj->setIdDefect($this->getIdDefect());
        $copyObj->setIdService($this->getIdService());
        $copyObj->setObservations($this->getObservations());
        $copyObj->setLocation($this->getLocation());
        $copyObj->setPrice($this->getPrice());
        $copyObj->setDiscount($this->getDiscount());
        $copyObj->setSubtotal($this->getSubtotal());
        $copyObj->setTotal($this->getTotal());
        $copyObj->setRealDeliveryDate($this->getRealDeliveryDate());
        $copyObj->setRealDeliveryTime($this->getRealDeliveryTime());
        $copyObj->setIdDeliveryUser($this->getIdDeliveryUser());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getOrderDetailHistories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrderDetailHistory($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

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
     * @return \OrderDetail Clone of current object.
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
     * Declares an association between this object and a ChildColors object.
     *
     * @param  ChildColors $v
     * @return $this|\OrderDetail The current object (for fluent API support)
     * @throws PropelException
     */
    public function setColors(ChildColors $v = null)
    {
        if ($v === null) {
            $this->setIdColor(NULL);
        } else {
            $this->setIdColor($v->getId());
        }

        $this->aColors = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildColors object, it will not be re-added.
        if ($v !== null) {
            $v->addOrderDetail($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildColors object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildColors The associated ChildColors object.
     * @throws PropelException
     */
    public function getColors(ConnectionInterface $con = null)
    {
        if ($this->aColors === null && ($this->id_color != 0)) {
            $this->aColors = ChildColorsQuery::create()->findPk($this->id_color, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aColors->addOrderDetails($this);
             */
        }

        return $this->aColors;
    }

    /**
     * Declares an association between this object and a ChildDefects object.
     *
     * @param  ChildDefects $v
     * @return $this|\OrderDetail The current object (for fluent API support)
     * @throws PropelException
     */
    public function setDefects(ChildDefects $v = null)
    {
        if ($v === null) {
            $this->setIdDefect(NULL);
        } else {
            $this->setIdDefect($v->getId());
        }

        $this->aDefects = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildDefects object, it will not be re-added.
        if ($v !== null) {
            $v->addOrderDetail($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildDefects object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildDefects The associated ChildDefects object.
     * @throws PropelException
     */
    public function getDefects(ConnectionInterface $con = null)
    {
        if ($this->aDefects === null && ($this->id_defect != 0)) {
            $this->aDefects = ChildDefectsQuery::create()->findPk($this->id_defect, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aDefects->addOrderDetails($this);
             */
        }

        return $this->aDefects;
    }

    /**
     * Declares an association between this object and a ChildUsers object.
     *
     * @param  ChildUsers|null $v
     * @return $this|\OrderDetail The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUsers(ChildUsers $v = null)
    {
        if ($v === null) {
            $this->setIdDeliveryUser(NULL);
        } else {
            $this->setIdDeliveryUser($v->getId());
        }

        $this->aUsers = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUsers object, it will not be re-added.
        if ($v !== null) {
            $v->addOrderDetail($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUsers object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUsers|null The associated ChildUsers object.
     * @throws PropelException
     */
    public function getUsers(ConnectionInterface $con = null)
    {
        if ($this->aUsers === null && ($this->id_delivery_user != 0)) {
            $this->aUsers = ChildUsersQuery::create()->findPk($this->id_delivery_user, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUsers->addOrderDetails($this);
             */
        }

        return $this->aUsers;
    }

    /**
     * Declares an association between this object and a ChildOrderDetailStatus object.
     *
     * @param  ChildOrderDetailStatus $v
     * @return $this|\OrderDetail The current object (for fluent API support)
     * @throws PropelException
     */
    public function setOrderDetailStatus(ChildOrderDetailStatus $v = null)
    {
        if ($v === null) {
            $this->setIdOrderDetailStatus(NULL);
        } else {
            $this->setIdOrderDetailStatus($v->getId());
        }

        $this->aOrderDetailStatus = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildOrderDetailStatus object, it will not be re-added.
        if ($v !== null) {
            $v->addOrderDetail($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildOrderDetailStatus object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildOrderDetailStatus The associated ChildOrderDetailStatus object.
     * @throws PropelException
     */
    public function getOrderDetailStatus(ConnectionInterface $con = null)
    {
        if ($this->aOrderDetailStatus === null && ($this->id_order_detail_status != 0)) {
            $this->aOrderDetailStatus = ChildOrderDetailStatusQuery::create()->findPk($this->id_order_detail_status, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aOrderDetailStatus->addOrderDetails($this);
             */
        }

        return $this->aOrderDetailStatus;
    }

    /**
     * Declares an association between this object and a ChildOrders object.
     *
     * @param  ChildOrders $v
     * @return $this|\OrderDetail The current object (for fluent API support)
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
            $v->addOrderDetail($this);
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
                $this->aOrders->addOrderDetails($this);
             */
        }

        return $this->aOrders;
    }

    /**
     * Declares an association between this object and a ChildPrints object.
     *
     * @param  ChildPrints $v
     * @return $this|\OrderDetail The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPrints(ChildPrints $v = null)
    {
        if ($v === null) {
            $this->setIdPrint(NULL);
        } else {
            $this->setIdPrint($v->getId());
        }

        $this->aPrints = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPrints object, it will not be re-added.
        if ($v !== null) {
            $v->addOrderDetail($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPrints object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPrints The associated ChildPrints object.
     * @throws PropelException
     */
    public function getPrints(ConnectionInterface $con = null)
    {
        if ($this->aPrints === null && ($this->id_print != 0)) {
            $this->aPrints = ChildPrintsQuery::create()->findPk($this->id_print, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPrints->addOrderDetails($this);
             */
        }

        return $this->aPrints;
    }

    /**
     * Declares an association between this object and a ChildServices object.
     *
     * @param  ChildServices $v
     * @return $this|\OrderDetail The current object (for fluent API support)
     * @throws PropelException
     */
    public function setServices(ChildServices $v = null)
    {
        if ($v === null) {
            $this->setIdService(NULL);
        } else {
            $this->setIdService($v->getId());
        }

        $this->aServices = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildServices object, it will not be re-added.
        if ($v !== null) {
            $v->addOrderDetail($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildServices object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildServices The associated ChildServices object.
     * @throws PropelException
     */
    public function getServices(ConnectionInterface $con = null)
    {
        if ($this->aServices === null && ($this->id_service != 0)) {
            $this->aServices = ChildServicesQuery::create()->findPk($this->id_service, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aServices->addOrderDetails($this);
             */
        }

        return $this->aServices;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('OrderDetailHistory' === $relationName) {
            $this->initOrderDetailHistories();
            return;
        }
    }

    /**
     * Clears out the collOrderDetailHistories collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addOrderDetailHistories()
     */
    public function clearOrderDetailHistories()
    {
        $this->collOrderDetailHistories = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collOrderDetailHistories collection loaded partially.
     */
    public function resetPartialOrderDetailHistories($v = true)
    {
        $this->collOrderDetailHistoriesPartial = $v;
    }

    /**
     * Initializes the collOrderDetailHistories collection.
     *
     * By default this just sets the collOrderDetailHistories collection to an empty array (like clearcollOrderDetailHistories());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderDetailHistories($overrideExisting = true)
    {
        if (null !== $this->collOrderDetailHistories && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrderDetailHistoryTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderDetailHistories = new $collectionClassName;
        $this->collOrderDetailHistories->setModel('\OrderDetailHistory');
    }

    /**
     * Gets an array of ChildOrderDetailHistory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrderDetail is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrderDetailHistory[] List of ChildOrderDetailHistory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderDetailHistory> List of ChildOrderDetailHistory objects
     * @throws PropelException
     */
    public function getOrderDetailHistories(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collOrderDetailHistoriesPartial && !$this->isNew();
        if (null === $this->collOrderDetailHistories || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrderDetailHistories) {
                    $this->initOrderDetailHistories();
                } else {
                    $collectionClassName = OrderDetailHistoryTableMap::getTableMap()->getCollectionClassName();

                    $collOrderDetailHistories = new $collectionClassName;
                    $collOrderDetailHistories->setModel('\OrderDetailHistory');

                    return $collOrderDetailHistories;
                }
            } else {
                $collOrderDetailHistories = ChildOrderDetailHistoryQuery::create(null, $criteria)
                    ->filterByOrderDetail($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderDetailHistoriesPartial && count($collOrderDetailHistories)) {
                        $this->initOrderDetailHistories(false);

                        foreach ($collOrderDetailHistories as $obj) {
                            if (false == $this->collOrderDetailHistories->contains($obj)) {
                                $this->collOrderDetailHistories->append($obj);
                            }
                        }

                        $this->collOrderDetailHistoriesPartial = true;
                    }

                    return $collOrderDetailHistories;
                }

                if ($partial && $this->collOrderDetailHistories) {
                    foreach ($this->collOrderDetailHistories as $obj) {
                        if ($obj->isNew()) {
                            $collOrderDetailHistories[] = $obj;
                        }
                    }
                }

                $this->collOrderDetailHistories = $collOrderDetailHistories;
                $this->collOrderDetailHistoriesPartial = false;
            }
        }

        return $this->collOrderDetailHistories;
    }

    /**
     * Sets a collection of ChildOrderDetailHistory objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $orderDetailHistories A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOrderDetail The current object (for fluent API support)
     */
    public function setOrderDetailHistories(Collection $orderDetailHistories, ConnectionInterface $con = null)
    {
        /** @var ChildOrderDetailHistory[] $orderDetailHistoriesToDelete */
        $orderDetailHistoriesToDelete = $this->getOrderDetailHistories(new Criteria(), $con)->diff($orderDetailHistories);


        $this->orderDetailHistoriesScheduledForDeletion = $orderDetailHistoriesToDelete;

        foreach ($orderDetailHistoriesToDelete as $orderDetailHistoryRemoved) {
            $orderDetailHistoryRemoved->setOrderDetail(null);
        }

        $this->collOrderDetailHistories = null;
        foreach ($orderDetailHistories as $orderDetailHistory) {
            $this->addOrderDetailHistory($orderDetailHistory);
        }

        $this->collOrderDetailHistories = $orderDetailHistories;
        $this->collOrderDetailHistoriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OrderDetailHistory objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related OrderDetailHistory objects.
     * @throws PropelException
     */
    public function countOrderDetailHistories(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collOrderDetailHistoriesPartial && !$this->isNew();
        if (null === $this->collOrderDetailHistories || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderDetailHistories) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderDetailHistories());
            }

            $query = ChildOrderDetailHistoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrderDetail($this)
                ->count($con);
        }

        return count($this->collOrderDetailHistories);
    }

    /**
     * Method called to associate a ChildOrderDetailHistory object to this object
     * through the ChildOrderDetailHistory foreign key attribute.
     *
     * @param  ChildOrderDetailHistory $l ChildOrderDetailHistory
     * @return $this|\OrderDetail The current object (for fluent API support)
     */
    public function addOrderDetailHistory(ChildOrderDetailHistory $l)
    {
        if ($this->collOrderDetailHistories === null) {
            $this->initOrderDetailHistories();
            $this->collOrderDetailHistoriesPartial = true;
        }

        if (!$this->collOrderDetailHistories->contains($l)) {
            $this->doAddOrderDetailHistory($l);

            if ($this->orderDetailHistoriesScheduledForDeletion and $this->orderDetailHistoriesScheduledForDeletion->contains($l)) {
                $this->orderDetailHistoriesScheduledForDeletion->remove($this->orderDetailHistoriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrderDetailHistory $orderDetailHistory The ChildOrderDetailHistory object to add.
     */
    protected function doAddOrderDetailHistory(ChildOrderDetailHistory $orderDetailHistory)
    {
        $this->collOrderDetailHistories[]= $orderDetailHistory;
        $orderDetailHistory->setOrderDetail($this);
    }

    /**
     * @param  ChildOrderDetailHistory $orderDetailHistory The ChildOrderDetailHistory object to remove.
     * @return $this|ChildOrderDetail The current object (for fluent API support)
     */
    public function removeOrderDetailHistory(ChildOrderDetailHistory $orderDetailHistory)
    {
        if ($this->getOrderDetailHistories()->contains($orderDetailHistory)) {
            $pos = $this->collOrderDetailHistories->search($orderDetailHistory);
            $this->collOrderDetailHistories->remove($pos);
            if (null === $this->orderDetailHistoriesScheduledForDeletion) {
                $this->orderDetailHistoriesScheduledForDeletion = clone $this->collOrderDetailHistories;
                $this->orderDetailHistoriesScheduledForDeletion->clear();
            }
            $this->orderDetailHistoriesScheduledForDeletion[]= clone $orderDetailHistory;
            $orderDetailHistory->setOrderDetail(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrderDetail is new, it will return
     * an empty collection; or if this OrderDetail has previously
     * been saved, it will retrieve related OrderDetailHistories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrderDetail.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderDetailHistory[] List of ChildOrderDetailHistory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderDetailHistory}> List of ChildOrderDetailHistory objects
     */
    public function getOrderDetailHistoriesJoinOrderDetailStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderDetailHistoryQuery::create(null, $criteria);
        $query->joinWith('OrderDetailStatus', $joinBehavior);

        return $this->getOrderDetailHistories($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this OrderDetail is new, it will return
     * an empty collection; or if this OrderDetail has previously
     * been saved, it will retrieve related OrderDetailHistories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in OrderDetail.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderDetailHistory[] List of ChildOrderDetailHistory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderDetailHistory}> List of ChildOrderDetailHistory objects
     */
    public function getOrderDetailHistoriesJoinUsers(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderDetailHistoryQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getOrderDetailHistories($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aColors) {
            $this->aColors->removeOrderDetail($this);
        }
        if (null !== $this->aDefects) {
            $this->aDefects->removeOrderDetail($this);
        }
        if (null !== $this->aUsers) {
            $this->aUsers->removeOrderDetail($this);
        }
        if (null !== $this->aOrderDetailStatus) {
            $this->aOrderDetailStatus->removeOrderDetail($this);
        }
        if (null !== $this->aOrders) {
            $this->aOrders->removeOrderDetail($this);
        }
        if (null !== $this->aPrints) {
            $this->aPrints->removeOrderDetail($this);
        }
        if (null !== $this->aServices) {
            $this->aServices->removeOrderDetail($this);
        }
        $this->id = null;
        $this->id_order = null;
        $this->id_order_detail_status = null;
        $this->quantity = null;
        $this->id_color = null;
        $this->id_print = null;
        $this->id_defect = null;
        $this->id_service = null;
        $this->observations = null;
        $this->location = null;
        $this->price = null;
        $this->discount = null;
        $this->subtotal = null;
        $this->total = null;
        $this->real_delivery_date = null;
        $this->real_delivery_time = null;
        $this->id_delivery_user = null;
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
            if ($this->collOrderDetailHistories) {
                foreach ($this->collOrderDetailHistories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collOrderDetailHistories = null;
        $this->aColors = null;
        $this->aDefects = null;
        $this->aUsers = null;
        $this->aOrderDetailStatus = null;
        $this->aOrders = null;
        $this->aPrints = null;
        $this->aServices = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(OrderDetailTableMap::DEFAULT_STRING_FORMAT);
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
