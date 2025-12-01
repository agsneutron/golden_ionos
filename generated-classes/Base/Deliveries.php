<?php

namespace Base;

use \Calendar as ChildCalendar;
use \CalendarQuery as ChildCalendarQuery;
use \DeliveriesQuery as ChildDeliveriesQuery;
use \Orders as ChildOrders;
use \OrdersQuery as ChildOrdersQuery;
use \Users as ChildUsers;
use \UsersQuery as ChildUsersQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\DeliveriesTableMap;
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
 * Base class that represents a row from the 'deliveries' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Deliveries implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\DeliveriesTableMap';


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
     * The value for the id_assigned_user field.
     *
     * @var        int
     */
    protected $id_assigned_user;

    /**
     * The value for the day_delivery field.
     *
     * @var        DateTime
     */
    protected $day_delivery;

    /**
     * The value for the time_delivery field.
     *
     * @var        DateTime|null
     */
    protected $time_delivery;

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
     * The value for the status field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $status;

    /**
     * The value for the comments field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $comments;

    /**
     * The value for the delivery_comments field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $delivery_comments;

    /**
     * The value for the delivery_contact_name field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $delivery_contact_name;

    /**
     * The value for the delivery_contact_signature field.
     *
     * @var        string
     */
    protected $delivery_contact_signature;

    /**
     * The value for the delivery_photo field.
     *
     * @var        string
     */
    protected $delivery_photo;

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
     * @var        ChildCalendar
     */
    protected $aCalendar;

    /**
     * @var        ChildUsers
     */
    protected $aUsers;

    /**
     * @var        ChildOrders
     */
    protected $aOrders;

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
        $this->status = 0;
        $this->comments = '';
        $this->delivery_comments = '';
        $this->delivery_contact_name = '';
    }

    /**
     * Initializes internal state of Base\Deliveries object.
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
     * Compares this with another <code>Deliveries</code> instance.  If
     * <code>obj</code> is an instance of <code>Deliveries</code>, delegates to
     * <code>equals(Deliveries)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_assigned_user] column value.
     *
     * @return int
     */
    public function getIdAssignedUser()
    {
        return $this->id_assigned_user;
    }

    /**
     * Get the [optionally formatted] temporal [day_delivery] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime : string)
     */
    public function getDayDelivery($format = 'Y-m-d')
    {
        if ($format === null) {
            return $this->day_delivery;
        } else {
            return $this->day_delivery instanceof \DateTimeInterface ? $this->day_delivery->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [time_delivery] column value.
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
    public function getTimeDelivery($format = 'H:i:s')
    {
        if ($format === null) {
            return $this->time_delivery;
        } else {
            return $this->time_delivery instanceof \DateTimeInterface ? $this->time_delivery->format($format) : null;
        }
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
     * Get the [status] column value.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the [comments] column value.
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Get the [delivery_comments] column value.
     *
     * @return string
     */
    public function getDeliveryComments()
    {
        return $this->delivery_comments;
    }

    /**
     * Get the [delivery_contact_name] column value.
     *
     * @return string
     */
    public function getDeliveryContactName()
    {
        return $this->delivery_contact_name;
    }

    /**
     * Get the [delivery_contact_signature] column value.
     *
     * @return string
     */
    public function getDeliveryContactSignature()
    {
        return $this->delivery_contact_signature;
    }

    /**
     * Get the [delivery_photo] column value.
     *
     * @return string
     */
    public function getDeliveryPhoto()
    {
        return $this->delivery_photo;
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
     * @return $this|\Deliveries The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[DeliveriesTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [id_order] column.
     *
     * @param int $v New value
     * @return $this|\Deliveries The current object (for fluent API support)
     */
    public function setIdOrder($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_order !== $v) {
            $this->id_order = $v;
            $this->modifiedColumns[DeliveriesTableMap::COL_ID_ORDER] = true;
        }

        if ($this->aOrders !== null && $this->aOrders->getId() !== $v) {
            $this->aOrders = null;
        }

        return $this;
    } // setIdOrder()

    /**
     * Set the value of [id_assigned_user] column.
     *
     * @param int $v New value
     * @return $this|\Deliveries The current object (for fluent API support)
     */
    public function setIdAssignedUser($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_assigned_user !== $v) {
            $this->id_assigned_user = $v;
            $this->modifiedColumns[DeliveriesTableMap::COL_ID_ASSIGNED_USER] = true;
        }

        if ($this->aUsers !== null && $this->aUsers->getId() !== $v) {
            $this->aUsers = null;
        }

        return $this;
    } // setIdAssignedUser()

    /**
     * Sets the value of [day_delivery] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Deliveries The current object (for fluent API support)
     */
    public function setDayDelivery($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->day_delivery !== null || $dt !== null) {
            if ($this->day_delivery === null || $dt === null || $dt->format("Y-m-d") !== $this->day_delivery->format("Y-m-d")) {
                $this->day_delivery = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DeliveriesTableMap::COL_DAY_DELIVERY] = true;
            }
        } // if either are not null

        if ($this->aCalendar !== null && $this->aCalendar->getDay() !== $v) {
            $this->aCalendar = null;
        }

        return $this;
    } // setDayDelivery()

    /**
     * Sets the value of [time_delivery] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Deliveries The current object (for fluent API support)
     */
    public function setTimeDelivery($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->time_delivery !== null || $dt !== null) {
            if ($this->time_delivery === null || $dt === null || $dt->format("H:i:s.u") !== $this->time_delivery->format("H:i:s.u")) {
                $this->time_delivery = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DeliveriesTableMap::COL_TIME_DELIVERY] = true;
            }
        } // if either are not null

        return $this;
    } // setTimeDelivery()

    /**
     * Sets the value of [real_delivery_date] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Deliveries The current object (for fluent API support)
     */
    public function setRealDeliveryDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->real_delivery_date !== null || $dt !== null) {
            if ($this->real_delivery_date === null || $dt === null || $dt->format("Y-m-d") !== $this->real_delivery_date->format("Y-m-d")) {
                $this->real_delivery_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DeliveriesTableMap::COL_REAL_DELIVERY_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setRealDeliveryDate()

    /**
     * Sets the value of [real_delivery_time] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Deliveries The current object (for fluent API support)
     */
    public function setRealDeliveryTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->real_delivery_time !== null || $dt !== null) {
            if ($this->real_delivery_time === null || $dt === null || $dt->format("H:i:s.u") !== $this->real_delivery_time->format("H:i:s.u")) {
                $this->real_delivery_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DeliveriesTableMap::COL_REAL_DELIVERY_TIME] = true;
            }
        } // if either are not null

        return $this;
    } // setRealDeliveryTime()

    /**
     * Set the value of [status] column.
     *
     * @param int $v New value
     * @return $this|\Deliveries The current object (for fluent API support)
     */
    public function setStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->status !== $v) {
            $this->status = $v;
            $this->modifiedColumns[DeliveriesTableMap::COL_STATUS] = true;
        }

        return $this;
    } // setStatus()

    /**
     * Set the value of [comments] column.
     *
     * @param string $v New value
     * @return $this|\Deliveries The current object (for fluent API support)
     */
    public function setComments($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->comments !== $v) {
            $this->comments = $v;
            $this->modifiedColumns[DeliveriesTableMap::COL_COMMENTS] = true;
        }

        return $this;
    } // setComments()

    /**
     * Set the value of [delivery_comments] column.
     *
     * @param string $v New value
     * @return $this|\Deliveries The current object (for fluent API support)
     */
    public function setDeliveryComments($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->delivery_comments !== $v) {
            $this->delivery_comments = $v;
            $this->modifiedColumns[DeliveriesTableMap::COL_DELIVERY_COMMENTS] = true;
        }

        return $this;
    } // setDeliveryComments()

    /**
     * Set the value of [delivery_contact_name] column.
     *
     * @param string $v New value
     * @return $this|\Deliveries The current object (for fluent API support)
     */
    public function setDeliveryContactName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->delivery_contact_name !== $v) {
            $this->delivery_contact_name = $v;
            $this->modifiedColumns[DeliveriesTableMap::COL_DELIVERY_CONTACT_NAME] = true;
        }

        return $this;
    } // setDeliveryContactName()

    /**
     * Set the value of [delivery_contact_signature] column.
     *
     * @param string $v New value
     * @return $this|\Deliveries The current object (for fluent API support)
     */
    public function setDeliveryContactSignature($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->delivery_contact_signature !== $v) {
            $this->delivery_contact_signature = $v;
            $this->modifiedColumns[DeliveriesTableMap::COL_DELIVERY_CONTACT_SIGNATURE] = true;
        }

        return $this;
    } // setDeliveryContactSignature()

    /**
     * Set the value of [delivery_photo] column.
     *
     * @param string $v New value
     * @return $this|\Deliveries The current object (for fluent API support)
     */
    public function setDeliveryPhoto($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->delivery_photo !== $v) {
            $this->delivery_photo = $v;
            $this->modifiedColumns[DeliveriesTableMap::COL_DELIVERY_PHOTO] = true;
        }

        return $this;
    } // setDeliveryPhoto()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Deliveries The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DeliveriesTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Deliveries The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DeliveriesTableMap::COL_UPDATED_AT] = true;
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
            if ($this->status !== 0) {
                return false;
            }

            if ($this->comments !== '') {
                return false;
            }

            if ($this->delivery_comments !== '') {
                return false;
            }

            if ($this->delivery_contact_name !== '') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : DeliveriesTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : DeliveriesTableMap::translateFieldName('IdOrder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_order = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : DeliveriesTableMap::translateFieldName('IdAssignedUser', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_assigned_user = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : DeliveriesTableMap::translateFieldName('DayDelivery', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->day_delivery = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : DeliveriesTableMap::translateFieldName('TimeDelivery', TableMap::TYPE_PHPNAME, $indexType)];
            $this->time_delivery = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : DeliveriesTableMap::translateFieldName('RealDeliveryDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->real_delivery_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : DeliveriesTableMap::translateFieldName('RealDeliveryTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->real_delivery_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : DeliveriesTableMap::translateFieldName('Status', TableMap::TYPE_PHPNAME, $indexType)];
            $this->status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : DeliveriesTableMap::translateFieldName('Comments', TableMap::TYPE_PHPNAME, $indexType)];
            $this->comments = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : DeliveriesTableMap::translateFieldName('DeliveryComments', TableMap::TYPE_PHPNAME, $indexType)];
            $this->delivery_comments = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : DeliveriesTableMap::translateFieldName('DeliveryContactName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->delivery_contact_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : DeliveriesTableMap::translateFieldName('DeliveryContactSignature', TableMap::TYPE_PHPNAME, $indexType)];
            $this->delivery_contact_signature = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : DeliveriesTableMap::translateFieldName('DeliveryPhoto', TableMap::TYPE_PHPNAME, $indexType)];
            $this->delivery_photo = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : DeliveriesTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : DeliveriesTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 15; // 15 = DeliveriesTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Deliveries'), 0, $e);
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
        if ($this->aUsers !== null && $this->id_assigned_user !== $this->aUsers->getId()) {
            $this->aUsers = null;
        }
        if ($this->aCalendar !== null && $this->day_delivery !== $this->aCalendar->getDay()) {
            $this->aCalendar = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(DeliveriesTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildDeliveriesQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCalendar = null;
            $this->aUsers = null;
            $this->aOrders = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Deliveries::setDeleted()
     * @see Deliveries::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveriesTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildDeliveriesQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(DeliveriesTableMap::DATABASE_NAME);
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
                DeliveriesTableMap::addInstanceToPool($this);
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

            if ($this->aCalendar !== null) {
                if ($this->aCalendar->isModified() || $this->aCalendar->isNew()) {
                    $affectedRows += $this->aCalendar->save($con);
                }
                $this->setCalendar($this->aCalendar);
            }

            if ($this->aUsers !== null) {
                if ($this->aUsers->isModified() || $this->aUsers->isNew()) {
                    $affectedRows += $this->aUsers->save($con);
                }
                $this->setUsers($this->aUsers);
            }

            if ($this->aOrders !== null) {
                if ($this->aOrders->isModified() || $this->aOrders->isNew()) {
                    $affectedRows += $this->aOrders->save($con);
                }
                $this->setOrders($this->aOrders);
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

        $this->modifiedColumns[DeliveriesTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . DeliveriesTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(DeliveriesTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_ID_ORDER)) {
            $modifiedColumns[':p' . $index++]  = 'id_order';
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_ID_ASSIGNED_USER)) {
            $modifiedColumns[':p' . $index++]  = 'id_assigned_user';
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_DAY_DELIVERY)) {
            $modifiedColumns[':p' . $index++]  = 'day_delivery';
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_TIME_DELIVERY)) {
            $modifiedColumns[':p' . $index++]  = 'time_delivery';
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_REAL_DELIVERY_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'real_delivery_date';
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_REAL_DELIVERY_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'real_delivery_time';
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'status';
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_COMMENTS)) {
            $modifiedColumns[':p' . $index++]  = 'comments';
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_DELIVERY_COMMENTS)) {
            $modifiedColumns[':p' . $index++]  = 'delivery_comments';
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_DELIVERY_CONTACT_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'delivery_contact_name';
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_DELIVERY_CONTACT_SIGNATURE)) {
            $modifiedColumns[':p' . $index++]  = 'delivery_contact_signature';
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_DELIVERY_PHOTO)) {
            $modifiedColumns[':p' . $index++]  = 'delivery_photo';
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO deliveries (%s) VALUES (%s)',
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
                    case 'id_assigned_user':
                        $stmt->bindValue($identifier, $this->id_assigned_user, PDO::PARAM_INT);
                        break;
                    case 'day_delivery':
                        $stmt->bindValue($identifier, $this->day_delivery ? $this->day_delivery->format("Y-m-d") : null, PDO::PARAM_STR);
                        break;
                    case 'time_delivery':
                        $stmt->bindValue($identifier, $this->time_delivery ? $this->time_delivery->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'real_delivery_date':
                        $stmt->bindValue($identifier, $this->real_delivery_date ? $this->real_delivery_date->format("Y-m-d") : null, PDO::PARAM_STR);
                        break;
                    case 'real_delivery_time':
                        $stmt->bindValue($identifier, $this->real_delivery_time ? $this->real_delivery_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'status':
                        $stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
                        break;
                    case 'comments':
                        $stmt->bindValue($identifier, $this->comments, PDO::PARAM_STR);
                        break;
                    case 'delivery_comments':
                        $stmt->bindValue($identifier, $this->delivery_comments, PDO::PARAM_STR);
                        break;
                    case 'delivery_contact_name':
                        $stmt->bindValue($identifier, $this->delivery_contact_name, PDO::PARAM_STR);
                        break;
                    case 'delivery_contact_signature':
                        $stmt->bindValue($identifier, $this->delivery_contact_signature, PDO::PARAM_STR);
                        break;
                    case 'delivery_photo':
                        $stmt->bindValue($identifier, $this->delivery_photo, PDO::PARAM_STR);
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
        $pos = DeliveriesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdAssignedUser();
                break;
            case 3:
                return $this->getDayDelivery();
                break;
            case 4:
                return $this->getTimeDelivery();
                break;
            case 5:
                return $this->getRealDeliveryDate();
                break;
            case 6:
                return $this->getRealDeliveryTime();
                break;
            case 7:
                return $this->getStatus();
                break;
            case 8:
                return $this->getComments();
                break;
            case 9:
                return $this->getDeliveryComments();
                break;
            case 10:
                return $this->getDeliveryContactName();
                break;
            case 11:
                return $this->getDeliveryContactSignature();
                break;
            case 12:
                return $this->getDeliveryPhoto();
                break;
            case 13:
                return $this->getCreatedAt();
                break;
            case 14:
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

        if (isset($alreadyDumpedObjects['Deliveries'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Deliveries'][$this->hashCode()] = true;
        $keys = DeliveriesTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getIdOrder(),
            $keys[2] => $this->getIdAssignedUser(),
            $keys[3] => $this->getDayDelivery(),
            $keys[4] => $this->getTimeDelivery(),
            $keys[5] => $this->getRealDeliveryDate(),
            $keys[6] => $this->getRealDeliveryTime(),
            $keys[7] => $this->getStatus(),
            $keys[8] => $this->getComments(),
            $keys[9] => $this->getDeliveryComments(),
            $keys[10] => $this->getDeliveryContactName(),
            $keys[11] => $this->getDeliveryContactSignature(),
            $keys[12] => $this->getDeliveryPhoto(),
            $keys[13] => $this->getCreatedAt(),
            $keys[14] => $this->getUpdatedAt(),
        );
        if ($result[$keys[3]] instanceof \DateTimeInterface) {
            $result[$keys[3]] = $result[$keys[3]]->format('Y-m-d');
        }

        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('H:i:s.u');
        }

        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('Y-m-d');
        }

        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('H:i:s.u');
        }

        if ($result[$keys[13]] instanceof \DateTimeInterface) {
            $result[$keys[13]] = $result[$keys[13]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[14]] instanceof \DateTimeInterface) {
            $result[$keys[14]] = $result[$keys[14]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCalendar) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'calendar';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'calendar';
                        break;
                    default:
                        $key = 'Calendar';
                }

                $result[$key] = $this->aCalendar->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
     * @return $this|\Deliveries
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = DeliveriesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Deliveries
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
                $this->setIdAssignedUser($value);
                break;
            case 3:
                $this->setDayDelivery($value);
                break;
            case 4:
                $this->setTimeDelivery($value);
                break;
            case 5:
                $this->setRealDeliveryDate($value);
                break;
            case 6:
                $this->setRealDeliveryTime($value);
                break;
            case 7:
                $this->setStatus($value);
                break;
            case 8:
                $this->setComments($value);
                break;
            case 9:
                $this->setDeliveryComments($value);
                break;
            case 10:
                $this->setDeliveryContactName($value);
                break;
            case 11:
                $this->setDeliveryContactSignature($value);
                break;
            case 12:
                $this->setDeliveryPhoto($value);
                break;
            case 13:
                $this->setCreatedAt($value);
                break;
            case 14:
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
     * @return     $this|\Deliveries
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = DeliveriesTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdOrder($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setIdAssignedUser($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDayDelivery($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setTimeDelivery($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setRealDeliveryDate($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setRealDeliveryTime($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setStatus($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setComments($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setDeliveryComments($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setDeliveryContactName($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setDeliveryContactSignature($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setDeliveryPhoto($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setCreatedAt($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setUpdatedAt($arr[$keys[14]]);
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
     * @return $this|\Deliveries The current object, for fluid interface
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
        $criteria = new Criteria(DeliveriesTableMap::DATABASE_NAME);

        if ($this->isColumnModified(DeliveriesTableMap::COL_ID)) {
            $criteria->add(DeliveriesTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_ID_ORDER)) {
            $criteria->add(DeliveriesTableMap::COL_ID_ORDER, $this->id_order);
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_ID_ASSIGNED_USER)) {
            $criteria->add(DeliveriesTableMap::COL_ID_ASSIGNED_USER, $this->id_assigned_user);
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_DAY_DELIVERY)) {
            $criteria->add(DeliveriesTableMap::COL_DAY_DELIVERY, $this->day_delivery);
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_TIME_DELIVERY)) {
            $criteria->add(DeliveriesTableMap::COL_TIME_DELIVERY, $this->time_delivery);
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_REAL_DELIVERY_DATE)) {
            $criteria->add(DeliveriesTableMap::COL_REAL_DELIVERY_DATE, $this->real_delivery_date);
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_REAL_DELIVERY_TIME)) {
            $criteria->add(DeliveriesTableMap::COL_REAL_DELIVERY_TIME, $this->real_delivery_time);
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_STATUS)) {
            $criteria->add(DeliveriesTableMap::COL_STATUS, $this->status);
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_COMMENTS)) {
            $criteria->add(DeliveriesTableMap::COL_COMMENTS, $this->comments);
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_DELIVERY_COMMENTS)) {
            $criteria->add(DeliveriesTableMap::COL_DELIVERY_COMMENTS, $this->delivery_comments);
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_DELIVERY_CONTACT_NAME)) {
            $criteria->add(DeliveriesTableMap::COL_DELIVERY_CONTACT_NAME, $this->delivery_contact_name);
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_DELIVERY_CONTACT_SIGNATURE)) {
            $criteria->add(DeliveriesTableMap::COL_DELIVERY_CONTACT_SIGNATURE, $this->delivery_contact_signature);
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_DELIVERY_PHOTO)) {
            $criteria->add(DeliveriesTableMap::COL_DELIVERY_PHOTO, $this->delivery_photo);
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_CREATED_AT)) {
            $criteria->add(DeliveriesTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(DeliveriesTableMap::COL_UPDATED_AT)) {
            $criteria->add(DeliveriesTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildDeliveriesQuery::create();
        $criteria->add(DeliveriesTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \Deliveries (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdOrder($this->getIdOrder());
        $copyObj->setIdAssignedUser($this->getIdAssignedUser());
        $copyObj->setDayDelivery($this->getDayDelivery());
        $copyObj->setTimeDelivery($this->getTimeDelivery());
        $copyObj->setRealDeliveryDate($this->getRealDeliveryDate());
        $copyObj->setRealDeliveryTime($this->getRealDeliveryTime());
        $copyObj->setStatus($this->getStatus());
        $copyObj->setComments($this->getComments());
        $copyObj->setDeliveryComments($this->getDeliveryComments());
        $copyObj->setDeliveryContactName($this->getDeliveryContactName());
        $copyObj->setDeliveryContactSignature($this->getDeliveryContactSignature());
        $copyObj->setDeliveryPhoto($this->getDeliveryPhoto());
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
     * @return \Deliveries Clone of current object.
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
     * Declares an association between this object and a ChildCalendar object.
     *
     * @param  ChildCalendar $v
     * @return $this|\Deliveries The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCalendar(ChildCalendar $v = null)
    {
        if ($v === null) {
            $this->setDayDelivery(NULL);
        } else {
            $this->setDayDelivery($v->getDay());
        }

        $this->aCalendar = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCalendar object, it will not be re-added.
        if ($v !== null) {
            $v->addDeliveries($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCalendar object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildCalendar The associated ChildCalendar object.
     * @throws PropelException
     */
    public function getCalendar(ConnectionInterface $con = null)
    {
        if ($this->aCalendar === null && (($this->day_delivery !== "" && $this->day_delivery !== null))) {
            $this->aCalendar = ChildCalendarQuery::create()->findPk($this->day_delivery, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCalendar->addDeliveriess($this);
             */
        }

        return $this->aCalendar;
    }

    /**
     * Declares an association between this object and a ChildUsers object.
     *
     * @param  ChildUsers $v
     * @return $this|\Deliveries The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUsers(ChildUsers $v = null)
    {
        if ($v === null) {
            $this->setIdAssignedUser(NULL);
        } else {
            $this->setIdAssignedUser($v->getId());
        }

        $this->aUsers = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUsers object, it will not be re-added.
        if ($v !== null) {
            $v->addDeliveries($this);
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
        if ($this->aUsers === null && ($this->id_assigned_user != 0)) {
            $this->aUsers = ChildUsersQuery::create()->findPk($this->id_assigned_user, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUsers->addDeliveriess($this);
             */
        }

        return $this->aUsers;
    }

    /**
     * Declares an association between this object and a ChildOrders object.
     *
     * @param  ChildOrders $v
     * @return $this|\Deliveries The current object (for fluent API support)
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
            $v->addDeliveries($this);
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
                $this->aOrders->addDeliveriess($this);
             */
        }

        return $this->aOrders;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aCalendar) {
            $this->aCalendar->removeDeliveries($this);
        }
        if (null !== $this->aUsers) {
            $this->aUsers->removeDeliveries($this);
        }
        if (null !== $this->aOrders) {
            $this->aOrders->removeDeliveries($this);
        }
        $this->id = null;
        $this->id_order = null;
        $this->id_assigned_user = null;
        $this->day_delivery = null;
        $this->time_delivery = null;
        $this->real_delivery_date = null;
        $this->real_delivery_time = null;
        $this->status = null;
        $this->comments = null;
        $this->delivery_comments = null;
        $this->delivery_contact_name = null;
        $this->delivery_contact_signature = null;
        $this->delivery_photo = null;
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

        $this->aCalendar = null;
        $this->aUsers = null;
        $this->aOrders = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(DeliveriesTableMap::DEFAULT_STRING_FORMAT);
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
