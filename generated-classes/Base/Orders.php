<?php

namespace Base;

use \BranchOffices as ChildBranchOffices;
use \BranchOfficesQuery as ChildBranchOfficesQuery;
use \Deliveries as ChildDeliveries;
use \DeliveriesQuery as ChildDeliveriesQuery;
use \ElectronicPurseHistory as ChildElectronicPurseHistory;
use \ElectronicPurseHistoryQuery as ChildElectronicPurseHistoryQuery;
use \OrderDetail as ChildOrderDetail;
use \OrderDetailQuery as ChildOrderDetailQuery;
use \OrderHistory as ChildOrderHistory;
use \OrderHistoryQuery as ChildOrderHistoryQuery;
use \OrderStatus as ChildOrderStatus;
use \OrderStatusQuery as ChildOrderStatusQuery;
use \Orders as ChildOrders;
use \OrdersQuery as ChildOrdersQuery;
use \PaymentMethods as ChildPaymentMethods;
use \PaymentMethodsQuery as ChildPaymentMethodsQuery;
use \Pickups as ChildPickups;
use \PickupsQuery as ChildPickupsQuery;
use \Priorities as ChildPriorities;
use \PrioritiesQuery as ChildPrioritiesQuery;
use \Users as ChildUsers;
use \UsersQuery as ChildUsersQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\DeliveriesTableMap;
use Map\ElectronicPurseHistoryTableMap;
use Map\OrderDetailTableMap;
use Map\OrderHistoryTableMap;
use Map\OrdersTableMap;
use Map\PickupsTableMap;
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
 * Base class that represents a row from the 'orders' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Orders implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\OrdersTableMap';


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
     * The value for the id_branch_office field.
     *
     * @var        int
     */
    protected $id_branch_office;

    /**
     * The value for the folio field.
     *
     * @var        int
     */
    protected $folio;

    /**
     * The value for the harvest_date field.
     *
     * @var        string|null
     */
    protected $harvest_date;

    /**
     * The value for the harvest_time field.
     *
     * @var        string|null
     */
    protected $harvest_time;

    /**
     * The value for the reception_date field.
     *
     * @var        DateTime
     */
    protected $reception_date;

    /**
     * The value for the reception_time field.
     *
     * @var        DateTime
     */
    protected $reception_time;

    /**
     * The value for the delivery_date field.
     *
     * @var        DateTime|null
     */
    protected $delivery_date;

    /**
     * The value for the home_delivery field.
     *
     * @var        DateTime|null
     */
    protected $home_delivery;

    /**
     * The value for the delivery_time field.
     *
     * @var        DateTime|null
     */
    protected $delivery_time;

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
     * The value for the id_priority field.
     *
     * @var        int
     */
    protected $id_priority;

    /**
     * The value for the pieces field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $pieces;

    /**
     * The value for the kilograms field.
     *
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $kilograms;

    /**
     * The value for the observations field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $observations;

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
     * The value for the discount field.
     *
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $discount;

    /**
     * The value for the amount_paid field.
     *
     * Note: this column has a database default value of: '0.00'
     * @var        string
     */
    protected $amount_paid;

    /**
     * The value for the printed_note field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $printed_note;

    /**
     * The value for the payment_status field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $payment_status;

    /**
     * The value for the id_order_status field.
     *
     * @var        int
     */
    protected $id_order_status;

    /**
     * The value for the flag_home_service field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $flag_home_service;

    /**
     * The value for the id_payment_method field.
     *
     * @var        int
     */
    protected $id_payment_method;

    /**
     * The value for the id_user field.
     *
     * @var        int
     */
    protected $id_user;

    /**
     * The value for the id_client_user field.
     *
     * @var        int
     */
    protected $id_client_user;

    /**
     * The value for the harvest_comments field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $harvest_comments;

    /**
     * The value for the harvest_contact_name field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $harvest_contact_name;

    /**
     * The value for the harvest_contact_signature field.
     *
     * @var        string
     */
    protected $harvest_contact_signature;

    /**
     * The value for the harvest_photo field.
     *
     * @var        string
     */
    protected $harvest_photo;

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
     * The value for the rank field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $rank;

    /**
     * The value for the qualified field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $qualified;

    /**
     * The value for the client_comments field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $client_comments;

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
     * @var        ChildBranchOffices
     */
    protected $aBranchOffices;

    /**
     * @var        ChildUsers
     */
    protected $aUsersRelatedByIdClientUser;

    /**
     * @var        ChildUsers
     */
    protected $aUsersRelatedByIdDeliveryUser;

    /**
     * @var        ChildOrderStatus
     */
    protected $aOrderStatus;

    /**
     * @var        ChildPaymentMethods
     */
    protected $aPaymentMethods;

    /**
     * @var        ChildPriorities
     */
    protected $aPriorities;

    /**
     * @var        ChildUsers
     */
    protected $aUsersRelatedByIdUser;

    /**
     * @var        ObjectCollection|ChildDeliveries[] Collection to store aggregation of ChildDeliveries objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDeliveries> Collection to store aggregation of ChildDeliveries objects.
     */
    protected $collDeliveriess;
    protected $collDeliveriessPartial;

    /**
     * @var        ObjectCollection|ChildElectronicPurseHistory[] Collection to store aggregation of ChildElectronicPurseHistory objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildElectronicPurseHistory> Collection to store aggregation of ChildElectronicPurseHistory objects.
     */
    protected $collElectronicPurseHistories;
    protected $collElectronicPurseHistoriesPartial;

    /**
     * @var        ObjectCollection|ChildOrderDetail[] Collection to store aggregation of ChildOrderDetail objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrderDetail> Collection to store aggregation of ChildOrderDetail objects.
     */
    protected $collOrderDetails;
    protected $collOrderDetailsPartial;

    /**
     * @var        ObjectCollection|ChildOrderHistory[] Collection to store aggregation of ChildOrderHistory objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrderHistory> Collection to store aggregation of ChildOrderHistory objects.
     */
    protected $collOrderHistories;
    protected $collOrderHistoriesPartial;

    /**
     * @var        ObjectCollection|ChildPickups[] Collection to store aggregation of ChildPickups objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildPickups> Collection to store aggregation of ChildPickups objects.
     */
    protected $collPickupss;
    protected $collPickupssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildDeliveries[]
     * @phpstan-var ObjectCollection&\Traversable<ChildDeliveries>
     */
    protected $deliveriessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildElectronicPurseHistory[]
     * @phpstan-var ObjectCollection&\Traversable<ChildElectronicPurseHistory>
     */
    protected $electronicPurseHistoriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrderDetail[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrderDetail>
     */
    protected $orderDetailsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrderHistory[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrderHistory>
     */
    protected $orderHistoriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPickups[]
     * @phpstan-var ObjectCollection&\Traversable<ChildPickups>
     */
    protected $pickupssScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->pieces = 0;
        $this->kilograms = '0.00';
        $this->observations = '';
        $this->subtotal = '0.00';
        $this->total = '0.00';
        $this->discount = '0.00';
        $this->amount_paid = '0.00';
        $this->printed_note = 0;
        $this->payment_status = 0;
        $this->flag_home_service = 0;
        $this->harvest_comments = '';
        $this->harvest_contact_name = '';
        $this->delivery_comments = '';
        $this->delivery_contact_name = '';
        $this->rank = 0;
        $this->qualified = 0;
        $this->client_comments = '';
    }

    /**
     * Initializes internal state of Base\Orders object.
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
     * Compares this with another <code>Orders</code> instance.  If
     * <code>obj</code> is an instance of <code>Orders</code>, delegates to
     * <code>equals(Orders)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_branch_office] column value.
     *
     * @return int
     */
    public function getIdBranchOffice()
    {
        return $this->id_branch_office;
    }

    /**
     * Get the [folio] column value.
     *
     * @return int
     */
    public function getFolio()
    {
        return $this->folio;
    }

    /**
     * Get the [harvest_date] column value.
     *
     * @return string|null
     */
    public function getHarvestDate()
    {
        return $this->harvest_date;
    }

    /**
     * Get the [harvest_time] column value.
     *
     * @return string|null
     */
    public function getHarvestTime()
    {
        return $this->harvest_time;
    }

    /**
     * Get the [optionally formatted] temporal [reception_date] column value.
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
    public function getReceptionDate($format = 'Y-m-d')
    {
        if ($format === null) {
            return $this->reception_date;
        } else {
            return $this->reception_date instanceof \DateTimeInterface ? $this->reception_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [reception_time] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime : string)
     */
    public function getReceptionTime($format = 'H:i:s')
    {
        if ($format === null) {
            return $this->reception_time;
        } else {
            return $this->reception_time instanceof \DateTimeInterface ? $this->reception_time->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [delivery_date] column value.
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
    public function getDeliveryDate($format = 'Y-m-d')
    {
        if ($format === null) {
            return $this->delivery_date;
        } else {
            return $this->delivery_date instanceof \DateTimeInterface ? $this->delivery_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [home_delivery] column value.
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
    public function getHomeDelivery($format = 'Y-m-d')
    {
        if ($format === null) {
            return $this->home_delivery;
        } else {
            return $this->home_delivery instanceof \DateTimeInterface ? $this->home_delivery->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [delivery_time] column value.
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
    public function getDeliveryTime($format = 'H:i:s')
    {
        if ($format === null) {
            return $this->delivery_time;
        } else {
            return $this->delivery_time instanceof \DateTimeInterface ? $this->delivery_time->format($format) : null;
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
     * Get the [id_delivery_user] column value.
     *
     * @return int|null
     */
    public function getIdDeliveryUser()
    {
        return $this->id_delivery_user;
    }

    /**
     * Get the [id_priority] column value.
     *
     * @return int
     */
    public function getIdPriority()
    {
        return $this->id_priority;
    }

    /**
     * Get the [pieces] column value.
     *
     * @return int
     */
    public function getPieces()
    {
        return $this->pieces;
    }

    /**
     * Get the [kilograms] column value.
     *
     * @return string
     */
    public function getKilograms()
    {
        return $this->kilograms;
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
     * Get the [discount] column value.
     *
     * @return string
     */
    public function getDiscount()
    {
        return $this->discount;
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
     * Get the [printed_note] column value.
     *
     * @return int
     */
    public function getPrintedNote()
    {
        return $this->printed_note;
    }

    /**
     * Get the [payment_status] column value.
     *
     * @return int
     */
    public function getPaymentStatus()
    {
        return $this->payment_status;
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
     * Get the [flag_home_service] column value.
     *
     * @return int
     */
    public function getFlagHomeService()
    {
        return $this->flag_home_service;
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
     * Get the [id_user] column value.
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * Get the [id_client_user] column value.
     *
     * @return int
     */
    public function getIdClientUser()
    {
        return $this->id_client_user;
    }

    /**
     * Get the [harvest_comments] column value.
     *
     * @return string
     */
    public function getHarvestComments()
    {
        return $this->harvest_comments;
    }

    /**
     * Get the [harvest_contact_name] column value.
     *
     * @return string
     */
    public function getHarvestContactName()
    {
        return $this->harvest_contact_name;
    }

    /**
     * Get the [harvest_contact_signature] column value.
     *
     * @return string
     */
    public function getHarvestContactSignature()
    {
        return $this->harvest_contact_signature;
    }

    /**
     * Get the [harvest_photo] column value.
     *
     * @return string
     */
    public function getHarvestPhoto()
    {
        return $this->harvest_photo;
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
     * Get the [rank] column value.
     *
     * @return int
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Get the [qualified] column value.
     *
     * @return int
     */
    public function getQualified()
    {
        return $this->qualified;
    }

    /**
     * Get the [client_comments] column value.
     *
     * @return string
     */
    public function getClientComments()
    {
        return $this->client_comments;
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
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[OrdersTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [id_branch_office] column.
     *
     * @param int $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setIdBranchOffice($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_branch_office !== $v) {
            $this->id_branch_office = $v;
            $this->modifiedColumns[OrdersTableMap::COL_ID_BRANCH_OFFICE] = true;
        }

        if ($this->aBranchOffices !== null && $this->aBranchOffices->getId() !== $v) {
            $this->aBranchOffices = null;
        }

        return $this;
    } // setIdBranchOffice()

    /**
     * Set the value of [folio] column.
     *
     * @param int $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setFolio($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->folio !== $v) {
            $this->folio = $v;
            $this->modifiedColumns[OrdersTableMap::COL_FOLIO] = true;
        }

        return $this;
    } // setFolio()

    /**
     * Set the value of [harvest_date] column.
     *
     * @param string|null $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setHarvestDate($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->harvest_date !== $v) {
            $this->harvest_date = $v;
            $this->modifiedColumns[OrdersTableMap::COL_HARVEST_DATE] = true;
        }

        return $this;
    } // setHarvestDate()

    /**
     * Set the value of [harvest_time] column.
     *
     * @param string|null $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setHarvestTime($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->harvest_time !== $v) {
            $this->harvest_time = $v;
            $this->modifiedColumns[OrdersTableMap::COL_HARVEST_TIME] = true;
        }

        return $this;
    } // setHarvestTime()

    /**
     * Sets the value of [reception_date] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setReceptionDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->reception_date !== null || $dt !== null) {
            if ($this->reception_date === null || $dt === null || $dt->format("Y-m-d") !== $this->reception_date->format("Y-m-d")) {
                $this->reception_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OrdersTableMap::COL_RECEPTION_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setReceptionDate()

    /**
     * Sets the value of [reception_time] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setReceptionTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->reception_time !== null || $dt !== null) {
            if ($this->reception_time === null || $dt === null || $dt->format("H:i:s.u") !== $this->reception_time->format("H:i:s.u")) {
                $this->reception_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OrdersTableMap::COL_RECEPTION_TIME] = true;
            }
        } // if either are not null

        return $this;
    } // setReceptionTime()

    /**
     * Sets the value of [delivery_date] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setDeliveryDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->delivery_date !== null || $dt !== null) {
            if ($this->delivery_date === null || $dt === null || $dt->format("Y-m-d") !== $this->delivery_date->format("Y-m-d")) {
                $this->delivery_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OrdersTableMap::COL_DELIVERY_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setDeliveryDate()

    /**
     * Sets the value of [home_delivery] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setHomeDelivery($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->home_delivery !== null || $dt !== null) {
            if ($this->home_delivery === null || $dt === null || $dt->format("Y-m-d") !== $this->home_delivery->format("Y-m-d")) {
                $this->home_delivery = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OrdersTableMap::COL_HOME_DELIVERY] = true;
            }
        } // if either are not null

        return $this;
    } // setHomeDelivery()

    /**
     * Sets the value of [delivery_time] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setDeliveryTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->delivery_time !== null || $dt !== null) {
            if ($this->delivery_time === null || $dt === null || $dt->format("H:i:s.u") !== $this->delivery_time->format("H:i:s.u")) {
                $this->delivery_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OrdersTableMap::COL_DELIVERY_TIME] = true;
            }
        } // if either are not null

        return $this;
    } // setDeliveryTime()

    /**
     * Sets the value of [real_delivery_date] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setRealDeliveryDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->real_delivery_date !== null || $dt !== null) {
            if ($this->real_delivery_date === null || $dt === null || $dt->format("Y-m-d") !== $this->real_delivery_date->format("Y-m-d")) {
                $this->real_delivery_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OrdersTableMap::COL_REAL_DELIVERY_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setRealDeliveryDate()

    /**
     * Sets the value of [real_delivery_time] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setRealDeliveryTime($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->real_delivery_time !== null || $dt !== null) {
            if ($this->real_delivery_time === null || $dt === null || $dt->format("H:i:s.u") !== $this->real_delivery_time->format("H:i:s.u")) {
                $this->real_delivery_time = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OrdersTableMap::COL_REAL_DELIVERY_TIME] = true;
            }
        } // if either are not null

        return $this;
    } // setRealDeliveryTime()

    /**
     * Set the value of [id_delivery_user] column.
     *
     * @param int|null $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setIdDeliveryUser($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_delivery_user !== $v) {
            $this->id_delivery_user = $v;
            $this->modifiedColumns[OrdersTableMap::COL_ID_DELIVERY_USER] = true;
        }

        if ($this->aUsersRelatedByIdDeliveryUser !== null && $this->aUsersRelatedByIdDeliveryUser->getId() !== $v) {
            $this->aUsersRelatedByIdDeliveryUser = null;
        }

        return $this;
    } // setIdDeliveryUser()

    /**
     * Set the value of [id_priority] column.
     *
     * @param int $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setIdPriority($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_priority !== $v) {
            $this->id_priority = $v;
            $this->modifiedColumns[OrdersTableMap::COL_ID_PRIORITY] = true;
        }

        if ($this->aPriorities !== null && $this->aPriorities->getId() !== $v) {
            $this->aPriorities = null;
        }

        return $this;
    } // setIdPriority()

    /**
     * Set the value of [pieces] column.
     *
     * @param int $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setPieces($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->pieces !== $v) {
            $this->pieces = $v;
            $this->modifiedColumns[OrdersTableMap::COL_PIECES] = true;
        }

        return $this;
    } // setPieces()

    /**
     * Set the value of [kilograms] column.
     *
     * @param string $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setKilograms($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->kilograms !== $v) {
            $this->kilograms = $v;
            $this->modifiedColumns[OrdersTableMap::COL_KILOGRAMS] = true;
        }

        return $this;
    } // setKilograms()

    /**
     * Set the value of [observations] column.
     *
     * @param string $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setObservations($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->observations !== $v) {
            $this->observations = $v;
            $this->modifiedColumns[OrdersTableMap::COL_OBSERVATIONS] = true;
        }

        return $this;
    } // setObservations()

    /**
     * Set the value of [subtotal] column.
     *
     * @param string $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setSubtotal($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->subtotal !== $v) {
            $this->subtotal = $v;
            $this->modifiedColumns[OrdersTableMap::COL_SUBTOTAL] = true;
        }

        return $this;
    } // setSubtotal()

    /**
     * Set the value of [total] column.
     *
     * @param string $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setTotal($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->total !== $v) {
            $this->total = $v;
            $this->modifiedColumns[OrdersTableMap::COL_TOTAL] = true;
        }

        return $this;
    } // setTotal()

    /**
     * Set the value of [discount] column.
     *
     * @param string $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setDiscount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->discount !== $v) {
            $this->discount = $v;
            $this->modifiedColumns[OrdersTableMap::COL_DISCOUNT] = true;
        }

        return $this;
    } // setDiscount()

    /**
     * Set the value of [amount_paid] column.
     *
     * @param string $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setAmountPaid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->amount_paid !== $v) {
            $this->amount_paid = $v;
            $this->modifiedColumns[OrdersTableMap::COL_AMOUNT_PAID] = true;
        }

        return $this;
    } // setAmountPaid()

    /**
     * Set the value of [printed_note] column.
     *
     * @param int $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setPrintedNote($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->printed_note !== $v) {
            $this->printed_note = $v;
            $this->modifiedColumns[OrdersTableMap::COL_PRINTED_NOTE] = true;
        }

        return $this;
    } // setPrintedNote()

    /**
     * Set the value of [payment_status] column.
     *
     * @param int $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setPaymentStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->payment_status !== $v) {
            $this->payment_status = $v;
            $this->modifiedColumns[OrdersTableMap::COL_PAYMENT_STATUS] = true;
        }

        return $this;
    } // setPaymentStatus()

    /**
     * Set the value of [id_order_status] column.
     *
     * @param int $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setIdOrderStatus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_order_status !== $v) {
            $this->id_order_status = $v;
            $this->modifiedColumns[OrdersTableMap::COL_ID_ORDER_STATUS] = true;
        }

        if ($this->aOrderStatus !== null && $this->aOrderStatus->getId() !== $v) {
            $this->aOrderStatus = null;
        }

        return $this;
    } // setIdOrderStatus()

    /**
     * Set the value of [flag_home_service] column.
     *
     * @param int $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setFlagHomeService($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->flag_home_service !== $v) {
            $this->flag_home_service = $v;
            $this->modifiedColumns[OrdersTableMap::COL_FLAG_HOME_SERVICE] = true;
        }

        return $this;
    } // setFlagHomeService()

    /**
     * Set the value of [id_payment_method] column.
     *
     * @param int $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setIdPaymentMethod($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_payment_method !== $v) {
            $this->id_payment_method = $v;
            $this->modifiedColumns[OrdersTableMap::COL_ID_PAYMENT_METHOD] = true;
        }

        if ($this->aPaymentMethods !== null && $this->aPaymentMethods->getId() !== $v) {
            $this->aPaymentMethods = null;
        }

        return $this;
    } // setIdPaymentMethod()

    /**
     * Set the value of [id_user] column.
     *
     * @param int $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setIdUser($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_user !== $v) {
            $this->id_user = $v;
            $this->modifiedColumns[OrdersTableMap::COL_ID_USER] = true;
        }

        if ($this->aUsersRelatedByIdUser !== null && $this->aUsersRelatedByIdUser->getId() !== $v) {
            $this->aUsersRelatedByIdUser = null;
        }

        return $this;
    } // setIdUser()

    /**
     * Set the value of [id_client_user] column.
     *
     * @param int $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setIdClientUser($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_client_user !== $v) {
            $this->id_client_user = $v;
            $this->modifiedColumns[OrdersTableMap::COL_ID_CLIENT_USER] = true;
        }

        if ($this->aUsersRelatedByIdClientUser !== null && $this->aUsersRelatedByIdClientUser->getId() !== $v) {
            $this->aUsersRelatedByIdClientUser = null;
        }

        return $this;
    } // setIdClientUser()

    /**
     * Set the value of [harvest_comments] column.
     *
     * @param string $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setHarvestComments($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->harvest_comments !== $v) {
            $this->harvest_comments = $v;
            $this->modifiedColumns[OrdersTableMap::COL_HARVEST_COMMENTS] = true;
        }

        return $this;
    } // setHarvestComments()

    /**
     * Set the value of [harvest_contact_name] column.
     *
     * @param string $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setHarvestContactName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->harvest_contact_name !== $v) {
            $this->harvest_contact_name = $v;
            $this->modifiedColumns[OrdersTableMap::COL_HARVEST_CONTACT_NAME] = true;
        }

        return $this;
    } // setHarvestContactName()

    /**
     * Set the value of [harvest_contact_signature] column.
     *
     * @param string $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setHarvestContactSignature($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->harvest_contact_signature !== $v) {
            $this->harvest_contact_signature = $v;
            $this->modifiedColumns[OrdersTableMap::COL_HARVEST_CONTACT_SIGNATURE] = true;
        }

        return $this;
    } // setHarvestContactSignature()

    /**
     * Set the value of [harvest_photo] column.
     *
     * @param string $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setHarvestPhoto($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->harvest_photo !== $v) {
            $this->harvest_photo = $v;
            $this->modifiedColumns[OrdersTableMap::COL_HARVEST_PHOTO] = true;
        }

        return $this;
    } // setHarvestPhoto()

    /**
     * Set the value of [delivery_comments] column.
     *
     * @param string $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setDeliveryComments($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->delivery_comments !== $v) {
            $this->delivery_comments = $v;
            $this->modifiedColumns[OrdersTableMap::COL_DELIVERY_COMMENTS] = true;
        }

        return $this;
    } // setDeliveryComments()

    /**
     * Set the value of [delivery_contact_name] column.
     *
     * @param string $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setDeliveryContactName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->delivery_contact_name !== $v) {
            $this->delivery_contact_name = $v;
            $this->modifiedColumns[OrdersTableMap::COL_DELIVERY_CONTACT_NAME] = true;
        }

        return $this;
    } // setDeliveryContactName()

    /**
     * Set the value of [delivery_contact_signature] column.
     *
     * @param string $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setDeliveryContactSignature($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->delivery_contact_signature !== $v) {
            $this->delivery_contact_signature = $v;
            $this->modifiedColumns[OrdersTableMap::COL_DELIVERY_CONTACT_SIGNATURE] = true;
        }

        return $this;
    } // setDeliveryContactSignature()

    /**
     * Set the value of [delivery_photo] column.
     *
     * @param string $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setDeliveryPhoto($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->delivery_photo !== $v) {
            $this->delivery_photo = $v;
            $this->modifiedColumns[OrdersTableMap::COL_DELIVERY_PHOTO] = true;
        }

        return $this;
    } // setDeliveryPhoto()

    /**
     * Set the value of [rank] column.
     *
     * @param int $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setRank($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->rank !== $v) {
            $this->rank = $v;
            $this->modifiedColumns[OrdersTableMap::COL_RANK] = true;
        }

        return $this;
    } // setRank()

    /**
     * Set the value of [qualified] column.
     *
     * @param int $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setQualified($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->qualified !== $v) {
            $this->qualified = $v;
            $this->modifiedColumns[OrdersTableMap::COL_QUALIFIED] = true;
        }

        return $this;
    } // setQualified()

    /**
     * Set the value of [client_comments] column.
     *
     * @param string $v New value
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setClientComments($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->client_comments !== $v) {
            $this->client_comments = $v;
            $this->modifiedColumns[OrdersTableMap::COL_CLIENT_COMMENTS] = true;
        }

        return $this;
    } // setClientComments()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OrdersTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[OrdersTableMap::COL_UPDATED_AT] = true;
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
            if ($this->pieces !== 0) {
                return false;
            }

            if ($this->kilograms !== '0.00') {
                return false;
            }

            if ($this->observations !== '') {
                return false;
            }

            if ($this->subtotal !== '0.00') {
                return false;
            }

            if ($this->total !== '0.00') {
                return false;
            }

            if ($this->discount !== '0.00') {
                return false;
            }

            if ($this->amount_paid !== '0.00') {
                return false;
            }

            if ($this->printed_note !== 0) {
                return false;
            }

            if ($this->payment_status !== 0) {
                return false;
            }

            if ($this->flag_home_service !== 0) {
                return false;
            }

            if ($this->harvest_comments !== '') {
                return false;
            }

            if ($this->harvest_contact_name !== '') {
                return false;
            }

            if ($this->delivery_comments !== '') {
                return false;
            }

            if ($this->delivery_contact_name !== '') {
                return false;
            }

            if ($this->rank !== 0) {
                return false;
            }

            if ($this->qualified !== 0) {
                return false;
            }

            if ($this->client_comments !== '') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : OrdersTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : OrdersTableMap::translateFieldName('IdBranchOffice', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_branch_office = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : OrdersTableMap::translateFieldName('Folio', TableMap::TYPE_PHPNAME, $indexType)];
            $this->folio = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : OrdersTableMap::translateFieldName('HarvestDate', TableMap::TYPE_PHPNAME, $indexType)];
            $this->harvest_date = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : OrdersTableMap::translateFieldName('HarvestTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->harvest_time = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : OrdersTableMap::translateFieldName('ReceptionDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->reception_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : OrdersTableMap::translateFieldName('ReceptionTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->reception_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : OrdersTableMap::translateFieldName('DeliveryDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->delivery_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : OrdersTableMap::translateFieldName('HomeDelivery', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->home_delivery = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : OrdersTableMap::translateFieldName('DeliveryTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->delivery_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : OrdersTableMap::translateFieldName('RealDeliveryDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->real_delivery_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : OrdersTableMap::translateFieldName('RealDeliveryTime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->real_delivery_time = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : OrdersTableMap::translateFieldName('IdDeliveryUser', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_delivery_user = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : OrdersTableMap::translateFieldName('IdPriority', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_priority = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : OrdersTableMap::translateFieldName('Pieces', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pieces = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : OrdersTableMap::translateFieldName('Kilograms', TableMap::TYPE_PHPNAME, $indexType)];
            $this->kilograms = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : OrdersTableMap::translateFieldName('Observations', TableMap::TYPE_PHPNAME, $indexType)];
            $this->observations = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : OrdersTableMap::translateFieldName('Subtotal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->subtotal = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : OrdersTableMap::translateFieldName('Total', TableMap::TYPE_PHPNAME, $indexType)];
            $this->total = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : OrdersTableMap::translateFieldName('Discount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->discount = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : OrdersTableMap::translateFieldName('AmountPaid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->amount_paid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : OrdersTableMap::translateFieldName('PrintedNote', TableMap::TYPE_PHPNAME, $indexType)];
            $this->printed_note = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : OrdersTableMap::translateFieldName('PaymentStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->payment_status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 23 + $startcol : OrdersTableMap::translateFieldName('IdOrderStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_order_status = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 24 + $startcol : OrdersTableMap::translateFieldName('FlagHomeService', TableMap::TYPE_PHPNAME, $indexType)];
            $this->flag_home_service = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 25 + $startcol : OrdersTableMap::translateFieldName('IdPaymentMethod', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_payment_method = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 26 + $startcol : OrdersTableMap::translateFieldName('IdUser', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_user = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 27 + $startcol : OrdersTableMap::translateFieldName('IdClientUser', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_client_user = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 28 + $startcol : OrdersTableMap::translateFieldName('HarvestComments', TableMap::TYPE_PHPNAME, $indexType)];
            $this->harvest_comments = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 29 + $startcol : OrdersTableMap::translateFieldName('HarvestContactName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->harvest_contact_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 30 + $startcol : OrdersTableMap::translateFieldName('HarvestContactSignature', TableMap::TYPE_PHPNAME, $indexType)];
            $this->harvest_contact_signature = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 31 + $startcol : OrdersTableMap::translateFieldName('HarvestPhoto', TableMap::TYPE_PHPNAME, $indexType)];
            $this->harvest_photo = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 32 + $startcol : OrdersTableMap::translateFieldName('DeliveryComments', TableMap::TYPE_PHPNAME, $indexType)];
            $this->delivery_comments = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 33 + $startcol : OrdersTableMap::translateFieldName('DeliveryContactName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->delivery_contact_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 34 + $startcol : OrdersTableMap::translateFieldName('DeliveryContactSignature', TableMap::TYPE_PHPNAME, $indexType)];
            $this->delivery_contact_signature = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 35 + $startcol : OrdersTableMap::translateFieldName('DeliveryPhoto', TableMap::TYPE_PHPNAME, $indexType)];
            $this->delivery_photo = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 36 + $startcol : OrdersTableMap::translateFieldName('Rank', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rank = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 37 + $startcol : OrdersTableMap::translateFieldName('Qualified', TableMap::TYPE_PHPNAME, $indexType)];
            $this->qualified = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 38 + $startcol : OrdersTableMap::translateFieldName('ClientComments', TableMap::TYPE_PHPNAME, $indexType)];
            $this->client_comments = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 39 + $startcol : OrdersTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 40 + $startcol : OrdersTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 41; // 41 = OrdersTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Orders'), 0, $e);
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
        if ($this->aBranchOffices !== null && $this->id_branch_office !== $this->aBranchOffices->getId()) {
            $this->aBranchOffices = null;
        }
        if ($this->aUsersRelatedByIdDeliveryUser !== null && $this->id_delivery_user !== $this->aUsersRelatedByIdDeliveryUser->getId()) {
            $this->aUsersRelatedByIdDeliveryUser = null;
        }
        if ($this->aPriorities !== null && $this->id_priority !== $this->aPriorities->getId()) {
            $this->aPriorities = null;
        }
        if ($this->aOrderStatus !== null && $this->id_order_status !== $this->aOrderStatus->getId()) {
            $this->aOrderStatus = null;
        }
        if ($this->aPaymentMethods !== null && $this->id_payment_method !== $this->aPaymentMethods->getId()) {
            $this->aPaymentMethods = null;
        }
        if ($this->aUsersRelatedByIdUser !== null && $this->id_user !== $this->aUsersRelatedByIdUser->getId()) {
            $this->aUsersRelatedByIdUser = null;
        }
        if ($this->aUsersRelatedByIdClientUser !== null && $this->id_client_user !== $this->aUsersRelatedByIdClientUser->getId()) {
            $this->aUsersRelatedByIdClientUser = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(OrdersTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildOrdersQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aBranchOffices = null;
            $this->aUsersRelatedByIdClientUser = null;
            $this->aUsersRelatedByIdDeliveryUser = null;
            $this->aOrderStatus = null;
            $this->aPaymentMethods = null;
            $this->aPriorities = null;
            $this->aUsersRelatedByIdUser = null;
            $this->collDeliveriess = null;

            $this->collElectronicPurseHistories = null;

            $this->collOrderDetails = null;

            $this->collOrderHistories = null;

            $this->collPickupss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Orders::setDeleted()
     * @see Orders::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrdersTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildOrdersQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(OrdersTableMap::DATABASE_NAME);
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
                OrdersTableMap::addInstanceToPool($this);
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

            if ($this->aBranchOffices !== null) {
                if ($this->aBranchOffices->isModified() || $this->aBranchOffices->isNew()) {
                    $affectedRows += $this->aBranchOffices->save($con);
                }
                $this->setBranchOffices($this->aBranchOffices);
            }

            if ($this->aUsersRelatedByIdClientUser !== null) {
                if ($this->aUsersRelatedByIdClientUser->isModified() || $this->aUsersRelatedByIdClientUser->isNew()) {
                    $affectedRows += $this->aUsersRelatedByIdClientUser->save($con);
                }
                $this->setUsersRelatedByIdClientUser($this->aUsersRelatedByIdClientUser);
            }

            if ($this->aUsersRelatedByIdDeliveryUser !== null) {
                if ($this->aUsersRelatedByIdDeliveryUser->isModified() || $this->aUsersRelatedByIdDeliveryUser->isNew()) {
                    $affectedRows += $this->aUsersRelatedByIdDeliveryUser->save($con);
                }
                $this->setUsersRelatedByIdDeliveryUser($this->aUsersRelatedByIdDeliveryUser);
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

            if ($this->aPriorities !== null) {
                if ($this->aPriorities->isModified() || $this->aPriorities->isNew()) {
                    $affectedRows += $this->aPriorities->save($con);
                }
                $this->setPriorities($this->aPriorities);
            }

            if ($this->aUsersRelatedByIdUser !== null) {
                if ($this->aUsersRelatedByIdUser->isModified() || $this->aUsersRelatedByIdUser->isNew()) {
                    $affectedRows += $this->aUsersRelatedByIdUser->save($con);
                }
                $this->setUsersRelatedByIdUser($this->aUsersRelatedByIdUser);
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

            if ($this->deliveriessScheduledForDeletion !== null) {
                if (!$this->deliveriessScheduledForDeletion->isEmpty()) {
                    \DeliveriesQuery::create()
                        ->filterByPrimaryKeys($this->deliveriessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->deliveriessScheduledForDeletion = null;
                }
            }

            if ($this->collDeliveriess !== null) {
                foreach ($this->collDeliveriess as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->electronicPurseHistoriesScheduledForDeletion !== null) {
                if (!$this->electronicPurseHistoriesScheduledForDeletion->isEmpty()) {
                    foreach ($this->electronicPurseHistoriesScheduledForDeletion as $electronicPurseHistory) {
                        // need to save related object because we set the relation to null
                        $electronicPurseHistory->save($con);
                    }
                    $this->electronicPurseHistoriesScheduledForDeletion = null;
                }
            }

            if ($this->collElectronicPurseHistories !== null) {
                foreach ($this->collElectronicPurseHistories as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->orderDetailsScheduledForDeletion !== null) {
                if (!$this->orderDetailsScheduledForDeletion->isEmpty()) {
                    \OrderDetailQuery::create()
                        ->filterByPrimaryKeys($this->orderDetailsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->orderDetailsScheduledForDeletion = null;
                }
            }

            if ($this->collOrderDetails !== null) {
                foreach ($this->collOrderDetails as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->orderHistoriesScheduledForDeletion !== null) {
                if (!$this->orderHistoriesScheduledForDeletion->isEmpty()) {
                    \OrderHistoryQuery::create()
                        ->filterByPrimaryKeys($this->orderHistoriesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->orderHistoriesScheduledForDeletion = null;
                }
            }

            if ($this->collOrderHistories !== null) {
                foreach ($this->collOrderHistories as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->pickupssScheduledForDeletion !== null) {
                if (!$this->pickupssScheduledForDeletion->isEmpty()) {
                    \PickupsQuery::create()
                        ->filterByPrimaryKeys($this->pickupssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->pickupssScheduledForDeletion = null;
                }
            }

            if ($this->collPickupss !== null) {
                foreach ($this->collPickupss as $referrerFK) {
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

        $this->modifiedColumns[OrdersTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . OrdersTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(OrdersTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ID_BRANCH_OFFICE)) {
            $modifiedColumns[':p' . $index++]  = 'id_branch_office';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_FOLIO)) {
            $modifiedColumns[':p' . $index++]  = 'folio';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_HARVEST_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'harvest_date';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_HARVEST_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'harvest_time';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_RECEPTION_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'reception_date';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_RECEPTION_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'reception_time';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_DELIVERY_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'delivery_date';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_HOME_DELIVERY)) {
            $modifiedColumns[':p' . $index++]  = 'home_delivery';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_DELIVERY_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'delivery_time';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_REAL_DELIVERY_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'real_delivery_date';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_REAL_DELIVERY_TIME)) {
            $modifiedColumns[':p' . $index++]  = 'real_delivery_time';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ID_DELIVERY_USER)) {
            $modifiedColumns[':p' . $index++]  = 'id_delivery_user';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ID_PRIORITY)) {
            $modifiedColumns[':p' . $index++]  = 'id_priority';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_PIECES)) {
            $modifiedColumns[':p' . $index++]  = 'pieces';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_KILOGRAMS)) {
            $modifiedColumns[':p' . $index++]  = 'kilograms';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_OBSERVATIONS)) {
            $modifiedColumns[':p' . $index++]  = 'observations';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_SUBTOTAL)) {
            $modifiedColumns[':p' . $index++]  = 'subtotal';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_TOTAL)) {
            $modifiedColumns[':p' . $index++]  = 'total';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_DISCOUNT)) {
            $modifiedColumns[':p' . $index++]  = 'discount';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_AMOUNT_PAID)) {
            $modifiedColumns[':p' . $index++]  = 'amount_paid';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_PRINTED_NOTE)) {
            $modifiedColumns[':p' . $index++]  = 'printed_note';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_PAYMENT_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'payment_status';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ID_ORDER_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'id_order_status';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_FLAG_HOME_SERVICE)) {
            $modifiedColumns[':p' . $index++]  = 'flag_home_service';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ID_PAYMENT_METHOD)) {
            $modifiedColumns[':p' . $index++]  = 'id_payment_method';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ID_USER)) {
            $modifiedColumns[':p' . $index++]  = 'id_user';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ID_CLIENT_USER)) {
            $modifiedColumns[':p' . $index++]  = 'id_client_user';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_HARVEST_COMMENTS)) {
            $modifiedColumns[':p' . $index++]  = 'harvest_comments';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_HARVEST_CONTACT_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'harvest_contact_name';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_HARVEST_CONTACT_SIGNATURE)) {
            $modifiedColumns[':p' . $index++]  = 'harvest_contact_signature';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_HARVEST_PHOTO)) {
            $modifiedColumns[':p' . $index++]  = 'harvest_photo';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_DELIVERY_COMMENTS)) {
            $modifiedColumns[':p' . $index++]  = 'delivery_comments';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_DELIVERY_CONTACT_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'delivery_contact_name';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_DELIVERY_CONTACT_SIGNATURE)) {
            $modifiedColumns[':p' . $index++]  = 'delivery_contact_signature';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_DELIVERY_PHOTO)) {
            $modifiedColumns[':p' . $index++]  = 'delivery_photo';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_RANK)) {
            $modifiedColumns[':p' . $index++]  = 'rank';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_QUALIFIED)) {
            $modifiedColumns[':p' . $index++]  = 'qualified';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_CLIENT_COMMENTS)) {
            $modifiedColumns[':p' . $index++]  = 'client_comments';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(OrdersTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO orders (%s) VALUES (%s)',
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
                    case 'id_branch_office':
                        $stmt->bindValue($identifier, $this->id_branch_office, PDO::PARAM_INT);
                        break;
                    case 'folio':
                        $stmt->bindValue($identifier, $this->folio, PDO::PARAM_INT);
                        break;
                    case 'harvest_date':
                        $stmt->bindValue($identifier, $this->harvest_date, PDO::PARAM_STR);
                        break;
                    case 'harvest_time':
                        $stmt->bindValue($identifier, $this->harvest_time, PDO::PARAM_STR);
                        break;
                    case 'reception_date':
                        $stmt->bindValue($identifier, $this->reception_date ? $this->reception_date->format("Y-m-d") : null, PDO::PARAM_STR);
                        break;
                    case 'reception_time':
                        $stmt->bindValue($identifier, $this->reception_time ? $this->reception_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'delivery_date':
                        $stmt->bindValue($identifier, $this->delivery_date ? $this->delivery_date->format("Y-m-d") : null, PDO::PARAM_STR);
                        break;
                    case 'home_delivery':
                        $stmt->bindValue($identifier, $this->home_delivery ? $this->home_delivery->format("Y-m-d") : null, PDO::PARAM_STR);
                        break;
                    case 'delivery_time':
                        $stmt->bindValue($identifier, $this->delivery_time ? $this->delivery_time->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
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
                    case 'id_priority':
                        $stmt->bindValue($identifier, $this->id_priority, PDO::PARAM_INT);
                        break;
                    case 'pieces':
                        $stmt->bindValue($identifier, $this->pieces, PDO::PARAM_INT);
                        break;
                    case 'kilograms':
                        $stmt->bindValue($identifier, $this->kilograms, PDO::PARAM_STR);
                        break;
                    case 'observations':
                        $stmt->bindValue($identifier, $this->observations, PDO::PARAM_STR);
                        break;
                    case 'subtotal':
                        $stmt->bindValue($identifier, $this->subtotal, PDO::PARAM_STR);
                        break;
                    case 'total':
                        $stmt->bindValue($identifier, $this->total, PDO::PARAM_STR);
                        break;
                    case 'discount':
                        $stmt->bindValue($identifier, $this->discount, PDO::PARAM_STR);
                        break;
                    case 'amount_paid':
                        $stmt->bindValue($identifier, $this->amount_paid, PDO::PARAM_STR);
                        break;
                    case 'printed_note':
                        $stmt->bindValue($identifier, $this->printed_note, PDO::PARAM_INT);
                        break;
                    case 'payment_status':
                        $stmt->bindValue($identifier, $this->payment_status, PDO::PARAM_INT);
                        break;
                    case 'id_order_status':
                        $stmt->bindValue($identifier, $this->id_order_status, PDO::PARAM_INT);
                        break;
                    case 'flag_home_service':
                        $stmt->bindValue($identifier, $this->flag_home_service, PDO::PARAM_INT);
                        break;
                    case 'id_payment_method':
                        $stmt->bindValue($identifier, $this->id_payment_method, PDO::PARAM_INT);
                        break;
                    case 'id_user':
                        $stmt->bindValue($identifier, $this->id_user, PDO::PARAM_INT);
                        break;
                    case 'id_client_user':
                        $stmt->bindValue($identifier, $this->id_client_user, PDO::PARAM_INT);
                        break;
                    case 'harvest_comments':
                        $stmt->bindValue($identifier, $this->harvest_comments, PDO::PARAM_STR);
                        break;
                    case 'harvest_contact_name':
                        $stmt->bindValue($identifier, $this->harvest_contact_name, PDO::PARAM_STR);
                        break;
                    case 'harvest_contact_signature':
                        $stmt->bindValue($identifier, $this->harvest_contact_signature, PDO::PARAM_STR);
                        break;
                    case 'harvest_photo':
                        $stmt->bindValue($identifier, $this->harvest_photo, PDO::PARAM_STR);
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
                    case 'rank':
                        $stmt->bindValue($identifier, $this->rank, PDO::PARAM_INT);
                        break;
                    case 'qualified':
                        $stmt->bindValue($identifier, $this->qualified, PDO::PARAM_INT);
                        break;
                    case 'client_comments':
                        $stmt->bindValue($identifier, $this->client_comments, PDO::PARAM_STR);
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
        $pos = OrdersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdBranchOffice();
                break;
            case 2:
                return $this->getFolio();
                break;
            case 3:
                return $this->getHarvestDate();
                break;
            case 4:
                return $this->getHarvestTime();
                break;
            case 5:
                return $this->getReceptionDate();
                break;
            case 6:
                return $this->getReceptionTime();
                break;
            case 7:
                return $this->getDeliveryDate();
                break;
            case 8:
                return $this->getHomeDelivery();
                break;
            case 9:
                return $this->getDeliveryTime();
                break;
            case 10:
                return $this->getRealDeliveryDate();
                break;
            case 11:
                return $this->getRealDeliveryTime();
                break;
            case 12:
                return $this->getIdDeliveryUser();
                break;
            case 13:
                return $this->getIdPriority();
                break;
            case 14:
                return $this->getPieces();
                break;
            case 15:
                return $this->getKilograms();
                break;
            case 16:
                return $this->getObservations();
                break;
            case 17:
                return $this->getSubtotal();
                break;
            case 18:
                return $this->getTotal();
                break;
            case 19:
                return $this->getDiscount();
                break;
            case 20:
                return $this->getAmountPaid();
                break;
            case 21:
                return $this->getPrintedNote();
                break;
            case 22:
                return $this->getPaymentStatus();
                break;
            case 23:
                return $this->getIdOrderStatus();
                break;
            case 24:
                return $this->getFlagHomeService();
                break;
            case 25:
                return $this->getIdPaymentMethod();
                break;
            case 26:
                return $this->getIdUser();
                break;
            case 27:
                return $this->getIdClientUser();
                break;
            case 28:
                return $this->getHarvestComments();
                break;
            case 29:
                return $this->getHarvestContactName();
                break;
            case 30:
                return $this->getHarvestContactSignature();
                break;
            case 31:
                return $this->getHarvestPhoto();
                break;
            case 32:
                return $this->getDeliveryComments();
                break;
            case 33:
                return $this->getDeliveryContactName();
                break;
            case 34:
                return $this->getDeliveryContactSignature();
                break;
            case 35:
                return $this->getDeliveryPhoto();
                break;
            case 36:
                return $this->getRank();
                break;
            case 37:
                return $this->getQualified();
                break;
            case 38:
                return $this->getClientComments();
                break;
            case 39:
                return $this->getCreatedAt();
                break;
            case 40:
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

        if (isset($alreadyDumpedObjects['Orders'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Orders'][$this->hashCode()] = true;
        $keys = OrdersTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getIdBranchOffice(),
            $keys[2] => $this->getFolio(),
            $keys[3] => $this->getHarvestDate(),
            $keys[4] => $this->getHarvestTime(),
            $keys[5] => $this->getReceptionDate(),
            $keys[6] => $this->getReceptionTime(),
            $keys[7] => $this->getDeliveryDate(),
            $keys[8] => $this->getHomeDelivery(),
            $keys[9] => $this->getDeliveryTime(),
            $keys[10] => $this->getRealDeliveryDate(),
            $keys[11] => $this->getRealDeliveryTime(),
            $keys[12] => $this->getIdDeliveryUser(),
            $keys[13] => $this->getIdPriority(),
            $keys[14] => $this->getPieces(),
            $keys[15] => $this->getKilograms(),
            $keys[16] => $this->getObservations(),
            $keys[17] => $this->getSubtotal(),
            $keys[18] => $this->getTotal(),
            $keys[19] => $this->getDiscount(),
            $keys[20] => $this->getAmountPaid(),
            $keys[21] => $this->getPrintedNote(),
            $keys[22] => $this->getPaymentStatus(),
            $keys[23] => $this->getIdOrderStatus(),
            $keys[24] => $this->getFlagHomeService(),
            $keys[25] => $this->getIdPaymentMethod(),
            $keys[26] => $this->getIdUser(),
            $keys[27] => $this->getIdClientUser(),
            $keys[28] => $this->getHarvestComments(),
            $keys[29] => $this->getHarvestContactName(),
            $keys[30] => $this->getHarvestContactSignature(),
            $keys[31] => $this->getHarvestPhoto(),
            $keys[32] => $this->getDeliveryComments(),
            $keys[33] => $this->getDeliveryContactName(),
            $keys[34] => $this->getDeliveryContactSignature(),
            $keys[35] => $this->getDeliveryPhoto(),
            $keys[36] => $this->getRank(),
            $keys[37] => $this->getQualified(),
            $keys[38] => $this->getClientComments(),
            $keys[39] => $this->getCreatedAt(),
            $keys[40] => $this->getUpdatedAt(),
        );
        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('Y-m-d');
        }

        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('H:i:s.u');
        }

        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d');
        }

        if ($result[$keys[8]] instanceof \DateTimeInterface) {
            $result[$keys[8]] = $result[$keys[8]]->format('Y-m-d');
        }

        if ($result[$keys[9]] instanceof \DateTimeInterface) {
            $result[$keys[9]] = $result[$keys[9]]->format('H:i:s.u');
        }

        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('Y-m-d');
        }

        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('H:i:s.u');
        }

        if ($result[$keys[39]] instanceof \DateTimeInterface) {
            $result[$keys[39]] = $result[$keys[39]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[40]] instanceof \DateTimeInterface) {
            $result[$keys[40]] = $result[$keys[40]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aBranchOffices) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'branchOffices';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'branch_offices';
                        break;
                    default:
                        $key = 'BranchOffices';
                }

                $result[$key] = $this->aBranchOffices->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUsersRelatedByIdClientUser) {

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

                $result[$key] = $this->aUsersRelatedByIdClientUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUsersRelatedByIdDeliveryUser) {

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

                $result[$key] = $this->aUsersRelatedByIdDeliveryUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->aPriorities) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'priorities';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'priorities';
                        break;
                    default:
                        $key = 'Priorities';
                }

                $result[$key] = $this->aPriorities->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUsersRelatedByIdUser) {

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

                $result[$key] = $this->aUsersRelatedByIdUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collDeliveriess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'deliveriess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'deliveriess';
                        break;
                    default:
                        $key = 'Deliveriess';
                }

                $result[$key] = $this->collDeliveriess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collElectronicPurseHistories) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'electronicPurseHistories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'electronic_purse_histories';
                        break;
                    default:
                        $key = 'ElectronicPurseHistories';
                }

                $result[$key] = $this->collElectronicPurseHistories->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOrderDetails) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orderDetails';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'order_details';
                        break;
                    default:
                        $key = 'OrderDetails';
                }

                $result[$key] = $this->collOrderDetails->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOrderHistories) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orderHistories';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'order_histories';
                        break;
                    default:
                        $key = 'OrderHistories';
                }

                $result[$key] = $this->collOrderHistories->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPickupss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'pickupss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'pickupss';
                        break;
                    default:
                        $key = 'Pickupss';
                }

                $result[$key] = $this->collPickupss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Orders
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = OrdersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Orders
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setIdBranchOffice($value);
                break;
            case 2:
                $this->setFolio($value);
                break;
            case 3:
                $this->setHarvestDate($value);
                break;
            case 4:
                $this->setHarvestTime($value);
                break;
            case 5:
                $this->setReceptionDate($value);
                break;
            case 6:
                $this->setReceptionTime($value);
                break;
            case 7:
                $this->setDeliveryDate($value);
                break;
            case 8:
                $this->setHomeDelivery($value);
                break;
            case 9:
                $this->setDeliveryTime($value);
                break;
            case 10:
                $this->setRealDeliveryDate($value);
                break;
            case 11:
                $this->setRealDeliveryTime($value);
                break;
            case 12:
                $this->setIdDeliveryUser($value);
                break;
            case 13:
                $this->setIdPriority($value);
                break;
            case 14:
                $this->setPieces($value);
                break;
            case 15:
                $this->setKilograms($value);
                break;
            case 16:
                $this->setObservations($value);
                break;
            case 17:
                $this->setSubtotal($value);
                break;
            case 18:
                $this->setTotal($value);
                break;
            case 19:
                $this->setDiscount($value);
                break;
            case 20:
                $this->setAmountPaid($value);
                break;
            case 21:
                $this->setPrintedNote($value);
                break;
            case 22:
                $this->setPaymentStatus($value);
                break;
            case 23:
                $this->setIdOrderStatus($value);
                break;
            case 24:
                $this->setFlagHomeService($value);
                break;
            case 25:
                $this->setIdPaymentMethod($value);
                break;
            case 26:
                $this->setIdUser($value);
                break;
            case 27:
                $this->setIdClientUser($value);
                break;
            case 28:
                $this->setHarvestComments($value);
                break;
            case 29:
                $this->setHarvestContactName($value);
                break;
            case 30:
                $this->setHarvestContactSignature($value);
                break;
            case 31:
                $this->setHarvestPhoto($value);
                break;
            case 32:
                $this->setDeliveryComments($value);
                break;
            case 33:
                $this->setDeliveryContactName($value);
                break;
            case 34:
                $this->setDeliveryContactSignature($value);
                break;
            case 35:
                $this->setDeliveryPhoto($value);
                break;
            case 36:
                $this->setRank($value);
                break;
            case 37:
                $this->setQualified($value);
                break;
            case 38:
                $this->setClientComments($value);
                break;
            case 39:
                $this->setCreatedAt($value);
                break;
            case 40:
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
     * @return     $this|\Orders
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = OrdersTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdBranchOffice($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setFolio($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setHarvestDate($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setHarvestTime($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setReceptionDate($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setReceptionTime($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setDeliveryDate($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setHomeDelivery($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setDeliveryTime($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setRealDeliveryDate($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setRealDeliveryTime($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setIdDeliveryUser($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setIdPriority($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setPieces($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setKilograms($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setObservations($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setSubtotal($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setTotal($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setDiscount($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setAmountPaid($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setPrintedNote($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setPaymentStatus($arr[$keys[22]]);
        }
        if (array_key_exists($keys[23], $arr)) {
            $this->setIdOrderStatus($arr[$keys[23]]);
        }
        if (array_key_exists($keys[24], $arr)) {
            $this->setFlagHomeService($arr[$keys[24]]);
        }
        if (array_key_exists($keys[25], $arr)) {
            $this->setIdPaymentMethod($arr[$keys[25]]);
        }
        if (array_key_exists($keys[26], $arr)) {
            $this->setIdUser($arr[$keys[26]]);
        }
        if (array_key_exists($keys[27], $arr)) {
            $this->setIdClientUser($arr[$keys[27]]);
        }
        if (array_key_exists($keys[28], $arr)) {
            $this->setHarvestComments($arr[$keys[28]]);
        }
        if (array_key_exists($keys[29], $arr)) {
            $this->setHarvestContactName($arr[$keys[29]]);
        }
        if (array_key_exists($keys[30], $arr)) {
            $this->setHarvestContactSignature($arr[$keys[30]]);
        }
        if (array_key_exists($keys[31], $arr)) {
            $this->setHarvestPhoto($arr[$keys[31]]);
        }
        if (array_key_exists($keys[32], $arr)) {
            $this->setDeliveryComments($arr[$keys[32]]);
        }
        if (array_key_exists($keys[33], $arr)) {
            $this->setDeliveryContactName($arr[$keys[33]]);
        }
        if (array_key_exists($keys[34], $arr)) {
            $this->setDeliveryContactSignature($arr[$keys[34]]);
        }
        if (array_key_exists($keys[35], $arr)) {
            $this->setDeliveryPhoto($arr[$keys[35]]);
        }
        if (array_key_exists($keys[36], $arr)) {
            $this->setRank($arr[$keys[36]]);
        }
        if (array_key_exists($keys[37], $arr)) {
            $this->setQualified($arr[$keys[37]]);
        }
        if (array_key_exists($keys[38], $arr)) {
            $this->setClientComments($arr[$keys[38]]);
        }
        if (array_key_exists($keys[39], $arr)) {
            $this->setCreatedAt($arr[$keys[39]]);
        }
        if (array_key_exists($keys[40], $arr)) {
            $this->setUpdatedAt($arr[$keys[40]]);
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
     * @return $this|\Orders The current object, for fluid interface
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
        $criteria = new Criteria(OrdersTableMap::DATABASE_NAME);

        if ($this->isColumnModified(OrdersTableMap::COL_ID)) {
            $criteria->add(OrdersTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ID_BRANCH_OFFICE)) {
            $criteria->add(OrdersTableMap::COL_ID_BRANCH_OFFICE, $this->id_branch_office);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_FOLIO)) {
            $criteria->add(OrdersTableMap::COL_FOLIO, $this->folio);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_HARVEST_DATE)) {
            $criteria->add(OrdersTableMap::COL_HARVEST_DATE, $this->harvest_date);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_HARVEST_TIME)) {
            $criteria->add(OrdersTableMap::COL_HARVEST_TIME, $this->harvest_time);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_RECEPTION_DATE)) {
            $criteria->add(OrdersTableMap::COL_RECEPTION_DATE, $this->reception_date);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_RECEPTION_TIME)) {
            $criteria->add(OrdersTableMap::COL_RECEPTION_TIME, $this->reception_time);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_DELIVERY_DATE)) {
            $criteria->add(OrdersTableMap::COL_DELIVERY_DATE, $this->delivery_date);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_HOME_DELIVERY)) {
            $criteria->add(OrdersTableMap::COL_HOME_DELIVERY, $this->home_delivery);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_DELIVERY_TIME)) {
            $criteria->add(OrdersTableMap::COL_DELIVERY_TIME, $this->delivery_time);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_REAL_DELIVERY_DATE)) {
            $criteria->add(OrdersTableMap::COL_REAL_DELIVERY_DATE, $this->real_delivery_date);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_REAL_DELIVERY_TIME)) {
            $criteria->add(OrdersTableMap::COL_REAL_DELIVERY_TIME, $this->real_delivery_time);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ID_DELIVERY_USER)) {
            $criteria->add(OrdersTableMap::COL_ID_DELIVERY_USER, $this->id_delivery_user);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ID_PRIORITY)) {
            $criteria->add(OrdersTableMap::COL_ID_PRIORITY, $this->id_priority);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_PIECES)) {
            $criteria->add(OrdersTableMap::COL_PIECES, $this->pieces);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_KILOGRAMS)) {
            $criteria->add(OrdersTableMap::COL_KILOGRAMS, $this->kilograms);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_OBSERVATIONS)) {
            $criteria->add(OrdersTableMap::COL_OBSERVATIONS, $this->observations);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_SUBTOTAL)) {
            $criteria->add(OrdersTableMap::COL_SUBTOTAL, $this->subtotal);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_TOTAL)) {
            $criteria->add(OrdersTableMap::COL_TOTAL, $this->total);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_DISCOUNT)) {
            $criteria->add(OrdersTableMap::COL_DISCOUNT, $this->discount);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_AMOUNT_PAID)) {
            $criteria->add(OrdersTableMap::COL_AMOUNT_PAID, $this->amount_paid);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_PRINTED_NOTE)) {
            $criteria->add(OrdersTableMap::COL_PRINTED_NOTE, $this->printed_note);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_PAYMENT_STATUS)) {
            $criteria->add(OrdersTableMap::COL_PAYMENT_STATUS, $this->payment_status);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ID_ORDER_STATUS)) {
            $criteria->add(OrdersTableMap::COL_ID_ORDER_STATUS, $this->id_order_status);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_FLAG_HOME_SERVICE)) {
            $criteria->add(OrdersTableMap::COL_FLAG_HOME_SERVICE, $this->flag_home_service);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ID_PAYMENT_METHOD)) {
            $criteria->add(OrdersTableMap::COL_ID_PAYMENT_METHOD, $this->id_payment_method);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ID_USER)) {
            $criteria->add(OrdersTableMap::COL_ID_USER, $this->id_user);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_ID_CLIENT_USER)) {
            $criteria->add(OrdersTableMap::COL_ID_CLIENT_USER, $this->id_client_user);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_HARVEST_COMMENTS)) {
            $criteria->add(OrdersTableMap::COL_HARVEST_COMMENTS, $this->harvest_comments);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_HARVEST_CONTACT_NAME)) {
            $criteria->add(OrdersTableMap::COL_HARVEST_CONTACT_NAME, $this->harvest_contact_name);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_HARVEST_CONTACT_SIGNATURE)) {
            $criteria->add(OrdersTableMap::COL_HARVEST_CONTACT_SIGNATURE, $this->harvest_contact_signature);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_HARVEST_PHOTO)) {
            $criteria->add(OrdersTableMap::COL_HARVEST_PHOTO, $this->harvest_photo);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_DELIVERY_COMMENTS)) {
            $criteria->add(OrdersTableMap::COL_DELIVERY_COMMENTS, $this->delivery_comments);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_DELIVERY_CONTACT_NAME)) {
            $criteria->add(OrdersTableMap::COL_DELIVERY_CONTACT_NAME, $this->delivery_contact_name);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_DELIVERY_CONTACT_SIGNATURE)) {
            $criteria->add(OrdersTableMap::COL_DELIVERY_CONTACT_SIGNATURE, $this->delivery_contact_signature);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_DELIVERY_PHOTO)) {
            $criteria->add(OrdersTableMap::COL_DELIVERY_PHOTO, $this->delivery_photo);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_RANK)) {
            $criteria->add(OrdersTableMap::COL_RANK, $this->rank);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_QUALIFIED)) {
            $criteria->add(OrdersTableMap::COL_QUALIFIED, $this->qualified);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_CLIENT_COMMENTS)) {
            $criteria->add(OrdersTableMap::COL_CLIENT_COMMENTS, $this->client_comments);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_CREATED_AT)) {
            $criteria->add(OrdersTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(OrdersTableMap::COL_UPDATED_AT)) {
            $criteria->add(OrdersTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildOrdersQuery::create();
        $criteria->add(OrdersTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \Orders (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdBranchOffice($this->getIdBranchOffice());
        $copyObj->setFolio($this->getFolio());
        $copyObj->setHarvestDate($this->getHarvestDate());
        $copyObj->setHarvestTime($this->getHarvestTime());
        $copyObj->setReceptionDate($this->getReceptionDate());
        $copyObj->setReceptionTime($this->getReceptionTime());
        $copyObj->setDeliveryDate($this->getDeliveryDate());
        $copyObj->setHomeDelivery($this->getHomeDelivery());
        $copyObj->setDeliveryTime($this->getDeliveryTime());
        $copyObj->setRealDeliveryDate($this->getRealDeliveryDate());
        $copyObj->setRealDeliveryTime($this->getRealDeliveryTime());
        $copyObj->setIdDeliveryUser($this->getIdDeliveryUser());
        $copyObj->setIdPriority($this->getIdPriority());
        $copyObj->setPieces($this->getPieces());
        $copyObj->setKilograms($this->getKilograms());
        $copyObj->setObservations($this->getObservations());
        $copyObj->setSubtotal($this->getSubtotal());
        $copyObj->setTotal($this->getTotal());
        $copyObj->setDiscount($this->getDiscount());
        $copyObj->setAmountPaid($this->getAmountPaid());
        $copyObj->setPrintedNote($this->getPrintedNote());
        $copyObj->setPaymentStatus($this->getPaymentStatus());
        $copyObj->setIdOrderStatus($this->getIdOrderStatus());
        $copyObj->setFlagHomeService($this->getFlagHomeService());
        $copyObj->setIdPaymentMethod($this->getIdPaymentMethod());
        $copyObj->setIdUser($this->getIdUser());
        $copyObj->setIdClientUser($this->getIdClientUser());
        $copyObj->setHarvestComments($this->getHarvestComments());
        $copyObj->setHarvestContactName($this->getHarvestContactName());
        $copyObj->setHarvestContactSignature($this->getHarvestContactSignature());
        $copyObj->setHarvestPhoto($this->getHarvestPhoto());
        $copyObj->setDeliveryComments($this->getDeliveryComments());
        $copyObj->setDeliveryContactName($this->getDeliveryContactName());
        $copyObj->setDeliveryContactSignature($this->getDeliveryContactSignature());
        $copyObj->setDeliveryPhoto($this->getDeliveryPhoto());
        $copyObj->setRank($this->getRank());
        $copyObj->setQualified($this->getQualified());
        $copyObj->setClientComments($this->getClientComments());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getDeliveriess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDeliveries($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getElectronicPurseHistories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addElectronicPurseHistory($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderDetails() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrderDetail($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderHistories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrderHistory($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPickupss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPickups($relObj->copy($deepCopy));
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
     * @return \Orders Clone of current object.
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
     * Declares an association between this object and a ChildBranchOffices object.
     *
     * @param  ChildBranchOffices $v
     * @return $this|\Orders The current object (for fluent API support)
     * @throws PropelException
     */
    public function setBranchOffices(ChildBranchOffices $v = null)
    {
        if ($v === null) {
            $this->setIdBranchOffice(NULL);
        } else {
            $this->setIdBranchOffice($v->getId());
        }

        $this->aBranchOffices = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildBranchOffices object, it will not be re-added.
        if ($v !== null) {
            $v->addOrders($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildBranchOffices object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildBranchOffices The associated ChildBranchOffices object.
     * @throws PropelException
     */
    public function getBranchOffices(ConnectionInterface $con = null)
    {
        if ($this->aBranchOffices === null && ($this->id_branch_office != 0)) {
            $this->aBranchOffices = ChildBranchOfficesQuery::create()->findPk($this->id_branch_office, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBranchOffices->addOrderss($this);
             */
        }

        return $this->aBranchOffices;
    }

    /**
     * Declares an association between this object and a ChildUsers object.
     *
     * @param  ChildUsers $v
     * @return $this|\Orders The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUsersRelatedByIdClientUser(ChildUsers $v = null)
    {
        if ($v === null) {
            $this->setIdClientUser(NULL);
        } else {
            $this->setIdClientUser($v->getId());
        }

        $this->aUsersRelatedByIdClientUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUsers object, it will not be re-added.
        if ($v !== null) {
            $v->addOrdersRelatedByIdClientUser($this);
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
    public function getUsersRelatedByIdClientUser(ConnectionInterface $con = null)
    {
        if ($this->aUsersRelatedByIdClientUser === null && ($this->id_client_user != 0)) {
            $this->aUsersRelatedByIdClientUser = ChildUsersQuery::create()->findPk($this->id_client_user, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUsersRelatedByIdClientUser->addOrderssRelatedByIdClientUser($this);
             */
        }

        return $this->aUsersRelatedByIdClientUser;
    }

    /**
     * Declares an association between this object and a ChildUsers object.
     *
     * @param  ChildUsers|null $v
     * @return $this|\Orders The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUsersRelatedByIdDeliveryUser(ChildUsers $v = null)
    {
        if ($v === null) {
            $this->setIdDeliveryUser(NULL);
        } else {
            $this->setIdDeliveryUser($v->getId());
        }

        $this->aUsersRelatedByIdDeliveryUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUsers object, it will not be re-added.
        if ($v !== null) {
            $v->addOrdersRelatedByIdDeliveryUser($this);
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
    public function getUsersRelatedByIdDeliveryUser(ConnectionInterface $con = null)
    {
        if ($this->aUsersRelatedByIdDeliveryUser === null && ($this->id_delivery_user != 0)) {
            $this->aUsersRelatedByIdDeliveryUser = ChildUsersQuery::create()->findPk($this->id_delivery_user, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUsersRelatedByIdDeliveryUser->addOrderssRelatedByIdDeliveryUser($this);
             */
        }

        return $this->aUsersRelatedByIdDeliveryUser;
    }

    /**
     * Declares an association between this object and a ChildOrderStatus object.
     *
     * @param  ChildOrderStatus $v
     * @return $this|\Orders The current object (for fluent API support)
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
            $v->addOrders($this);
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
                $this->aOrderStatus->addOrderss($this);
             */
        }

        return $this->aOrderStatus;
    }

    /**
     * Declares an association between this object and a ChildPaymentMethods object.
     *
     * @param  ChildPaymentMethods $v
     * @return $this|\Orders The current object (for fluent API support)
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
            $v->addOrders($this);
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
                $this->aPaymentMethods->addOrderss($this);
             */
        }

        return $this->aPaymentMethods;
    }

    /**
     * Declares an association between this object and a ChildPriorities object.
     *
     * @param  ChildPriorities $v
     * @return $this|\Orders The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPriorities(ChildPriorities $v = null)
    {
        if ($v === null) {
            $this->setIdPriority(NULL);
        } else {
            $this->setIdPriority($v->getId());
        }

        $this->aPriorities = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPriorities object, it will not be re-added.
        if ($v !== null) {
            $v->addOrders($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPriorities object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPriorities The associated ChildPriorities object.
     * @throws PropelException
     */
    public function getPriorities(ConnectionInterface $con = null)
    {
        if ($this->aPriorities === null && ($this->id_priority != 0)) {
            $this->aPriorities = ChildPrioritiesQuery::create()->findPk($this->id_priority, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPriorities->addOrderss($this);
             */
        }

        return $this->aPriorities;
    }

    /**
     * Declares an association between this object and a ChildUsers object.
     *
     * @param  ChildUsers $v
     * @return $this|\Orders The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUsersRelatedByIdUser(ChildUsers $v = null)
    {
        if ($v === null) {
            $this->setIdUser(NULL);
        } else {
            $this->setIdUser($v->getId());
        }

        $this->aUsersRelatedByIdUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUsers object, it will not be re-added.
        if ($v !== null) {
            $v->addOrdersRelatedByIdUser($this);
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
    public function getUsersRelatedByIdUser(ConnectionInterface $con = null)
    {
        if ($this->aUsersRelatedByIdUser === null && ($this->id_user != 0)) {
            $this->aUsersRelatedByIdUser = ChildUsersQuery::create()->findPk($this->id_user, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUsersRelatedByIdUser->addOrderssRelatedByIdUser($this);
             */
        }

        return $this->aUsersRelatedByIdUser;
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
        if ('Deliveries' === $relationName) {
            $this->initDeliveriess();
            return;
        }
        if ('ElectronicPurseHistory' === $relationName) {
            $this->initElectronicPurseHistories();
            return;
        }
        if ('OrderDetail' === $relationName) {
            $this->initOrderDetails();
            return;
        }
        if ('OrderHistory' === $relationName) {
            $this->initOrderHistories();
            return;
        }
        if ('Pickups' === $relationName) {
            $this->initPickupss();
            return;
        }
    }

    /**
     * Clears out the collDeliveriess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addDeliveriess()
     */
    public function clearDeliveriess()
    {
        $this->collDeliveriess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collDeliveriess collection loaded partially.
     */
    public function resetPartialDeliveriess($v = true)
    {
        $this->collDeliveriessPartial = $v;
    }

    /**
     * Initializes the collDeliveriess collection.
     *
     * By default this just sets the collDeliveriess collection to an empty array (like clearcollDeliveriess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initDeliveriess($overrideExisting = true)
    {
        if (null !== $this->collDeliveriess && !$overrideExisting) {
            return;
        }

        $collectionClassName = DeliveriesTableMap::getTableMap()->getCollectionClassName();

        $this->collDeliveriess = new $collectionClassName;
        $this->collDeliveriess->setModel('\Deliveries');
    }

    /**
     * Gets an array of ChildDeliveries objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrders is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildDeliveries[] List of ChildDeliveries objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDeliveries> List of ChildDeliveries objects
     * @throws PropelException
     */
    public function getDeliveriess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collDeliveriessPartial && !$this->isNew();
        if (null === $this->collDeliveriess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collDeliveriess) {
                    $this->initDeliveriess();
                } else {
                    $collectionClassName = DeliveriesTableMap::getTableMap()->getCollectionClassName();

                    $collDeliveriess = new $collectionClassName;
                    $collDeliveriess->setModel('\Deliveries');

                    return $collDeliveriess;
                }
            } else {
                $collDeliveriess = ChildDeliveriesQuery::create(null, $criteria)
                    ->filterByOrders($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collDeliveriessPartial && count($collDeliveriess)) {
                        $this->initDeliveriess(false);

                        foreach ($collDeliveriess as $obj) {
                            if (false == $this->collDeliveriess->contains($obj)) {
                                $this->collDeliveriess->append($obj);
                            }
                        }

                        $this->collDeliveriessPartial = true;
                    }

                    return $collDeliveriess;
                }

                if ($partial && $this->collDeliveriess) {
                    foreach ($this->collDeliveriess as $obj) {
                        if ($obj->isNew()) {
                            $collDeliveriess[] = $obj;
                        }
                    }
                }

                $this->collDeliveriess = $collDeliveriess;
                $this->collDeliveriessPartial = false;
            }
        }

        return $this->collDeliveriess;
    }

    /**
     * Sets a collection of ChildDeliveries objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $deliveriess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOrders The current object (for fluent API support)
     */
    public function setDeliveriess(Collection $deliveriess, ConnectionInterface $con = null)
    {
        /** @var ChildDeliveries[] $deliveriessToDelete */
        $deliveriessToDelete = $this->getDeliveriess(new Criteria(), $con)->diff($deliveriess);


        $this->deliveriessScheduledForDeletion = $deliveriessToDelete;

        foreach ($deliveriessToDelete as $deliveriesRemoved) {
            $deliveriesRemoved->setOrders(null);
        }

        $this->collDeliveriess = null;
        foreach ($deliveriess as $deliveries) {
            $this->addDeliveries($deliveries);
        }

        $this->collDeliveriess = $deliveriess;
        $this->collDeliveriessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Deliveries objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Deliveries objects.
     * @throws PropelException
     */
    public function countDeliveriess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collDeliveriessPartial && !$this->isNew();
        if (null === $this->collDeliveriess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collDeliveriess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getDeliveriess());
            }

            $query = ChildDeliveriesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrders($this)
                ->count($con);
        }

        return count($this->collDeliveriess);
    }

    /**
     * Method called to associate a ChildDeliveries object to this object
     * through the ChildDeliveries foreign key attribute.
     *
     * @param  ChildDeliveries $l ChildDeliveries
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function addDeliveries(ChildDeliveries $l)
    {
        if ($this->collDeliveriess === null) {
            $this->initDeliveriess();
            $this->collDeliveriessPartial = true;
        }

        if (!$this->collDeliveriess->contains($l)) {
            $this->doAddDeliveries($l);

            if ($this->deliveriessScheduledForDeletion and $this->deliveriessScheduledForDeletion->contains($l)) {
                $this->deliveriessScheduledForDeletion->remove($this->deliveriessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildDeliveries $deliveries The ChildDeliveries object to add.
     */
    protected function doAddDeliveries(ChildDeliveries $deliveries)
    {
        $this->collDeliveriess[]= $deliveries;
        $deliveries->setOrders($this);
    }

    /**
     * @param  ChildDeliveries $deliveries The ChildDeliveries object to remove.
     * @return $this|ChildOrders The current object (for fluent API support)
     */
    public function removeDeliveries(ChildDeliveries $deliveries)
    {
        if ($this->getDeliveriess()->contains($deliveries)) {
            $pos = $this->collDeliveriess->search($deliveries);
            $this->collDeliveriess->remove($pos);
            if (null === $this->deliveriessScheduledForDeletion) {
                $this->deliveriessScheduledForDeletion = clone $this->collDeliveriess;
                $this->deliveriessScheduledForDeletion->clear();
            }
            $this->deliveriessScheduledForDeletion[]= clone $deliveries;
            $deliveries->setOrders(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related Deliveriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDeliveries[] List of ChildDeliveries objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDeliveries}> List of ChildDeliveries objects
     */
    public function getDeliveriessJoinCalendar(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDeliveriesQuery::create(null, $criteria);
        $query->joinWith('Calendar', $joinBehavior);

        return $this->getDeliveriess($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related Deliveriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDeliveries[] List of ChildDeliveries objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDeliveries}> List of ChildDeliveries objects
     */
    public function getDeliveriessJoinUsers(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDeliveriesQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getDeliveriess($query, $con);
    }

    /**
     * Clears out the collElectronicPurseHistories collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addElectronicPurseHistories()
     */
    public function clearElectronicPurseHistories()
    {
        $this->collElectronicPurseHistories = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collElectronicPurseHistories collection loaded partially.
     */
    public function resetPartialElectronicPurseHistories($v = true)
    {
        $this->collElectronicPurseHistoriesPartial = $v;
    }

    /**
     * Initializes the collElectronicPurseHistories collection.
     *
     * By default this just sets the collElectronicPurseHistories collection to an empty array (like clearcollElectronicPurseHistories());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initElectronicPurseHistories($overrideExisting = true)
    {
        if (null !== $this->collElectronicPurseHistories && !$overrideExisting) {
            return;
        }

        $collectionClassName = ElectronicPurseHistoryTableMap::getTableMap()->getCollectionClassName();

        $this->collElectronicPurseHistories = new $collectionClassName;
        $this->collElectronicPurseHistories->setModel('\ElectronicPurseHistory');
    }

    /**
     * Gets an array of ChildElectronicPurseHistory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrders is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildElectronicPurseHistory[] List of ChildElectronicPurseHistory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildElectronicPurseHistory> List of ChildElectronicPurseHistory objects
     * @throws PropelException
     */
    public function getElectronicPurseHistories(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collElectronicPurseHistoriesPartial && !$this->isNew();
        if (null === $this->collElectronicPurseHistories || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collElectronicPurseHistories) {
                    $this->initElectronicPurseHistories();
                } else {
                    $collectionClassName = ElectronicPurseHistoryTableMap::getTableMap()->getCollectionClassName();

                    $collElectronicPurseHistories = new $collectionClassName;
                    $collElectronicPurseHistories->setModel('\ElectronicPurseHistory');

                    return $collElectronicPurseHistories;
                }
            } else {
                $collElectronicPurseHistories = ChildElectronicPurseHistoryQuery::create(null, $criteria)
                    ->filterByOrders($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collElectronicPurseHistoriesPartial && count($collElectronicPurseHistories)) {
                        $this->initElectronicPurseHistories(false);

                        foreach ($collElectronicPurseHistories as $obj) {
                            if (false == $this->collElectronicPurseHistories->contains($obj)) {
                                $this->collElectronicPurseHistories->append($obj);
                            }
                        }

                        $this->collElectronicPurseHistoriesPartial = true;
                    }

                    return $collElectronicPurseHistories;
                }

                if ($partial && $this->collElectronicPurseHistories) {
                    foreach ($this->collElectronicPurseHistories as $obj) {
                        if ($obj->isNew()) {
                            $collElectronicPurseHistories[] = $obj;
                        }
                    }
                }

                $this->collElectronicPurseHistories = $collElectronicPurseHistories;
                $this->collElectronicPurseHistoriesPartial = false;
            }
        }

        return $this->collElectronicPurseHistories;
    }

    /**
     * Sets a collection of ChildElectronicPurseHistory objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $electronicPurseHistories A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOrders The current object (for fluent API support)
     */
    public function setElectronicPurseHistories(Collection $electronicPurseHistories, ConnectionInterface $con = null)
    {
        /** @var ChildElectronicPurseHistory[] $electronicPurseHistoriesToDelete */
        $electronicPurseHistoriesToDelete = $this->getElectronicPurseHistories(new Criteria(), $con)->diff($electronicPurseHistories);


        $this->electronicPurseHistoriesScheduledForDeletion = $electronicPurseHistoriesToDelete;

        foreach ($electronicPurseHistoriesToDelete as $electronicPurseHistoryRemoved) {
            $electronicPurseHistoryRemoved->setOrders(null);
        }

        $this->collElectronicPurseHistories = null;
        foreach ($electronicPurseHistories as $electronicPurseHistory) {
            $this->addElectronicPurseHistory($electronicPurseHistory);
        }

        $this->collElectronicPurseHistories = $electronicPurseHistories;
        $this->collElectronicPurseHistoriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ElectronicPurseHistory objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ElectronicPurseHistory objects.
     * @throws PropelException
     */
    public function countElectronicPurseHistories(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collElectronicPurseHistoriesPartial && !$this->isNew();
        if (null === $this->collElectronicPurseHistories || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collElectronicPurseHistories) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getElectronicPurseHistories());
            }

            $query = ChildElectronicPurseHistoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrders($this)
                ->count($con);
        }

        return count($this->collElectronicPurseHistories);
    }

    /**
     * Method called to associate a ChildElectronicPurseHistory object to this object
     * through the ChildElectronicPurseHistory foreign key attribute.
     *
     * @param  ChildElectronicPurseHistory $l ChildElectronicPurseHistory
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function addElectronicPurseHistory(ChildElectronicPurseHistory $l)
    {
        if ($this->collElectronicPurseHistories === null) {
            $this->initElectronicPurseHistories();
            $this->collElectronicPurseHistoriesPartial = true;
        }

        if (!$this->collElectronicPurseHistories->contains($l)) {
            $this->doAddElectronicPurseHistory($l);

            if ($this->electronicPurseHistoriesScheduledForDeletion and $this->electronicPurseHistoriesScheduledForDeletion->contains($l)) {
                $this->electronicPurseHistoriesScheduledForDeletion->remove($this->electronicPurseHistoriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildElectronicPurseHistory $electronicPurseHistory The ChildElectronicPurseHistory object to add.
     */
    protected function doAddElectronicPurseHistory(ChildElectronicPurseHistory $electronicPurseHistory)
    {
        $this->collElectronicPurseHistories[]= $electronicPurseHistory;
        $electronicPurseHistory->setOrders($this);
    }

    /**
     * @param  ChildElectronicPurseHistory $electronicPurseHistory The ChildElectronicPurseHistory object to remove.
     * @return $this|ChildOrders The current object (for fluent API support)
     */
    public function removeElectronicPurseHistory(ChildElectronicPurseHistory $electronicPurseHistory)
    {
        if ($this->getElectronicPurseHistories()->contains($electronicPurseHistory)) {
            $pos = $this->collElectronicPurseHistories->search($electronicPurseHistory);
            $this->collElectronicPurseHistories->remove($pos);
            if (null === $this->electronicPurseHistoriesScheduledForDeletion) {
                $this->electronicPurseHistoriesScheduledForDeletion = clone $this->collElectronicPurseHistories;
                $this->electronicPurseHistoriesScheduledForDeletion->clear();
            }
            $this->electronicPurseHistoriesScheduledForDeletion[]= $electronicPurseHistory;
            $electronicPurseHistory->setOrders(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related ElectronicPurseHistories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildElectronicPurseHistory[] List of ChildElectronicPurseHistory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildElectronicPurseHistory}> List of ChildElectronicPurseHistory objects
     */
    public function getElectronicPurseHistoriesJoinElectronicPurse(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildElectronicPurseHistoryQuery::create(null, $criteria);
        $query->joinWith('ElectronicPurse', $joinBehavior);

        return $this->getElectronicPurseHistories($query, $con);
    }

    /**
     * Clears out the collOrderDetails collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addOrderDetails()
     */
    public function clearOrderDetails()
    {
        $this->collOrderDetails = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collOrderDetails collection loaded partially.
     */
    public function resetPartialOrderDetails($v = true)
    {
        $this->collOrderDetailsPartial = $v;
    }

    /**
     * Initializes the collOrderDetails collection.
     *
     * By default this just sets the collOrderDetails collection to an empty array (like clearcollOrderDetails());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderDetails($overrideExisting = true)
    {
        if (null !== $this->collOrderDetails && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrderDetailTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderDetails = new $collectionClassName;
        $this->collOrderDetails->setModel('\OrderDetail');
    }

    /**
     * Gets an array of ChildOrderDetail objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrders is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrderDetail[] List of ChildOrderDetail objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderDetail> List of ChildOrderDetail objects
     * @throws PropelException
     */
    public function getOrderDetails(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collOrderDetailsPartial && !$this->isNew();
        if (null === $this->collOrderDetails || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrderDetails) {
                    $this->initOrderDetails();
                } else {
                    $collectionClassName = OrderDetailTableMap::getTableMap()->getCollectionClassName();

                    $collOrderDetails = new $collectionClassName;
                    $collOrderDetails->setModel('\OrderDetail');

                    return $collOrderDetails;
                }
            } else {
                $collOrderDetails = ChildOrderDetailQuery::create(null, $criteria)
                    ->filterByOrders($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderDetailsPartial && count($collOrderDetails)) {
                        $this->initOrderDetails(false);

                        foreach ($collOrderDetails as $obj) {
                            if (false == $this->collOrderDetails->contains($obj)) {
                                $this->collOrderDetails->append($obj);
                            }
                        }

                        $this->collOrderDetailsPartial = true;
                    }

                    return $collOrderDetails;
                }

                if ($partial && $this->collOrderDetails) {
                    foreach ($this->collOrderDetails as $obj) {
                        if ($obj->isNew()) {
                            $collOrderDetails[] = $obj;
                        }
                    }
                }

                $this->collOrderDetails = $collOrderDetails;
                $this->collOrderDetailsPartial = false;
            }
        }

        return $this->collOrderDetails;
    }

    /**
     * Sets a collection of ChildOrderDetail objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $orderDetails A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOrders The current object (for fluent API support)
     */
    public function setOrderDetails(Collection $orderDetails, ConnectionInterface $con = null)
    {
        /** @var ChildOrderDetail[] $orderDetailsToDelete */
        $orderDetailsToDelete = $this->getOrderDetails(new Criteria(), $con)->diff($orderDetails);


        $this->orderDetailsScheduledForDeletion = $orderDetailsToDelete;

        foreach ($orderDetailsToDelete as $orderDetailRemoved) {
            $orderDetailRemoved->setOrders(null);
        }

        $this->collOrderDetails = null;
        foreach ($orderDetails as $orderDetail) {
            $this->addOrderDetail($orderDetail);
        }

        $this->collOrderDetails = $orderDetails;
        $this->collOrderDetailsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OrderDetail objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related OrderDetail objects.
     * @throws PropelException
     */
    public function countOrderDetails(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collOrderDetailsPartial && !$this->isNew();
        if (null === $this->collOrderDetails || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderDetails) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderDetails());
            }

            $query = ChildOrderDetailQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrders($this)
                ->count($con);
        }

        return count($this->collOrderDetails);
    }

    /**
     * Method called to associate a ChildOrderDetail object to this object
     * through the ChildOrderDetail foreign key attribute.
     *
     * @param  ChildOrderDetail $l ChildOrderDetail
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function addOrderDetail(ChildOrderDetail $l)
    {
        if ($this->collOrderDetails === null) {
            $this->initOrderDetails();
            $this->collOrderDetailsPartial = true;
        }

        if (!$this->collOrderDetails->contains($l)) {
            $this->doAddOrderDetail($l);

            if ($this->orderDetailsScheduledForDeletion and $this->orderDetailsScheduledForDeletion->contains($l)) {
                $this->orderDetailsScheduledForDeletion->remove($this->orderDetailsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrderDetail $orderDetail The ChildOrderDetail object to add.
     */
    protected function doAddOrderDetail(ChildOrderDetail $orderDetail)
    {
        $this->collOrderDetails[]= $orderDetail;
        $orderDetail->setOrders($this);
    }

    /**
     * @param  ChildOrderDetail $orderDetail The ChildOrderDetail object to remove.
     * @return $this|ChildOrders The current object (for fluent API support)
     */
    public function removeOrderDetail(ChildOrderDetail $orderDetail)
    {
        if ($this->getOrderDetails()->contains($orderDetail)) {
            $pos = $this->collOrderDetails->search($orderDetail);
            $this->collOrderDetails->remove($pos);
            if (null === $this->orderDetailsScheduledForDeletion) {
                $this->orderDetailsScheduledForDeletion = clone $this->collOrderDetails;
                $this->orderDetailsScheduledForDeletion->clear();
            }
            $this->orderDetailsScheduledForDeletion[]= clone $orderDetail;
            $orderDetail->setOrders(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related OrderDetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderDetail[] List of ChildOrderDetail objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderDetail}> List of ChildOrderDetail objects
     */
    public function getOrderDetailsJoinColors(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderDetailQuery::create(null, $criteria);
        $query->joinWith('Colors', $joinBehavior);

        return $this->getOrderDetails($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related OrderDetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderDetail[] List of ChildOrderDetail objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderDetail}> List of ChildOrderDetail objects
     */
    public function getOrderDetailsJoinDefects(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderDetailQuery::create(null, $criteria);
        $query->joinWith('Defects', $joinBehavior);

        return $this->getOrderDetails($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related OrderDetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderDetail[] List of ChildOrderDetail objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderDetail}> List of ChildOrderDetail objects
     */
    public function getOrderDetailsJoinUsers(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderDetailQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getOrderDetails($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related OrderDetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderDetail[] List of ChildOrderDetail objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderDetail}> List of ChildOrderDetail objects
     */
    public function getOrderDetailsJoinOrderDetailStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderDetailQuery::create(null, $criteria);
        $query->joinWith('OrderDetailStatus', $joinBehavior);

        return $this->getOrderDetails($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related OrderDetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderDetail[] List of ChildOrderDetail objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderDetail}> List of ChildOrderDetail objects
     */
    public function getOrderDetailsJoinPrints(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderDetailQuery::create(null, $criteria);
        $query->joinWith('Prints', $joinBehavior);

        return $this->getOrderDetails($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related OrderDetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderDetail[] List of ChildOrderDetail objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderDetail}> List of ChildOrderDetail objects
     */
    public function getOrderDetailsJoinServices(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderDetailQuery::create(null, $criteria);
        $query->joinWith('Services', $joinBehavior);

        return $this->getOrderDetails($query, $con);
    }

    /**
     * Clears out the collOrderHistories collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addOrderHistories()
     */
    public function clearOrderHistories()
    {
        $this->collOrderHistories = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collOrderHistories collection loaded partially.
     */
    public function resetPartialOrderHistories($v = true)
    {
        $this->collOrderHistoriesPartial = $v;
    }

    /**
     * Initializes the collOrderHistories collection.
     *
     * By default this just sets the collOrderHistories collection to an empty array (like clearcollOrderHistories());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderHistories($overrideExisting = true)
    {
        if (null !== $this->collOrderHistories && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrderHistoryTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderHistories = new $collectionClassName;
        $this->collOrderHistories->setModel('\OrderHistory');
    }

    /**
     * Gets an array of ChildOrderHistory objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrders is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrderHistory[] List of ChildOrderHistory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderHistory> List of ChildOrderHistory objects
     * @throws PropelException
     */
    public function getOrderHistories(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collOrderHistoriesPartial && !$this->isNew();
        if (null === $this->collOrderHistories || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrderHistories) {
                    $this->initOrderHistories();
                } else {
                    $collectionClassName = OrderHistoryTableMap::getTableMap()->getCollectionClassName();

                    $collOrderHistories = new $collectionClassName;
                    $collOrderHistories->setModel('\OrderHistory');

                    return $collOrderHistories;
                }
            } else {
                $collOrderHistories = ChildOrderHistoryQuery::create(null, $criteria)
                    ->filterByOrders($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderHistoriesPartial && count($collOrderHistories)) {
                        $this->initOrderHistories(false);

                        foreach ($collOrderHistories as $obj) {
                            if (false == $this->collOrderHistories->contains($obj)) {
                                $this->collOrderHistories->append($obj);
                            }
                        }

                        $this->collOrderHistoriesPartial = true;
                    }

                    return $collOrderHistories;
                }

                if ($partial && $this->collOrderHistories) {
                    foreach ($this->collOrderHistories as $obj) {
                        if ($obj->isNew()) {
                            $collOrderHistories[] = $obj;
                        }
                    }
                }

                $this->collOrderHistories = $collOrderHistories;
                $this->collOrderHistoriesPartial = false;
            }
        }

        return $this->collOrderHistories;
    }

    /**
     * Sets a collection of ChildOrderHistory objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $orderHistories A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOrders The current object (for fluent API support)
     */
    public function setOrderHistories(Collection $orderHistories, ConnectionInterface $con = null)
    {
        /** @var ChildOrderHistory[] $orderHistoriesToDelete */
        $orderHistoriesToDelete = $this->getOrderHistories(new Criteria(), $con)->diff($orderHistories);


        $this->orderHistoriesScheduledForDeletion = $orderHistoriesToDelete;

        foreach ($orderHistoriesToDelete as $orderHistoryRemoved) {
            $orderHistoryRemoved->setOrders(null);
        }

        $this->collOrderHistories = null;
        foreach ($orderHistories as $orderHistory) {
            $this->addOrderHistory($orderHistory);
        }

        $this->collOrderHistories = $orderHistories;
        $this->collOrderHistoriesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related OrderHistory objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related OrderHistory objects.
     * @throws PropelException
     */
    public function countOrderHistories(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collOrderHistoriesPartial && !$this->isNew();
        if (null === $this->collOrderHistories || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderHistories) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderHistories());
            }

            $query = ChildOrderHistoryQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrders($this)
                ->count($con);
        }

        return count($this->collOrderHistories);
    }

    /**
     * Method called to associate a ChildOrderHistory object to this object
     * through the ChildOrderHistory foreign key attribute.
     *
     * @param  ChildOrderHistory $l ChildOrderHistory
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function addOrderHistory(ChildOrderHistory $l)
    {
        if ($this->collOrderHistories === null) {
            $this->initOrderHistories();
            $this->collOrderHistoriesPartial = true;
        }

        if (!$this->collOrderHistories->contains($l)) {
            $this->doAddOrderHistory($l);

            if ($this->orderHistoriesScheduledForDeletion and $this->orderHistoriesScheduledForDeletion->contains($l)) {
                $this->orderHistoriesScheduledForDeletion->remove($this->orderHistoriesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrderHistory $orderHistory The ChildOrderHistory object to add.
     */
    protected function doAddOrderHistory(ChildOrderHistory $orderHistory)
    {
        $this->collOrderHistories[]= $orderHistory;
        $orderHistory->setOrders($this);
    }

    /**
     * @param  ChildOrderHistory $orderHistory The ChildOrderHistory object to remove.
     * @return $this|ChildOrders The current object (for fluent API support)
     */
    public function removeOrderHistory(ChildOrderHistory $orderHistory)
    {
        if ($this->getOrderHistories()->contains($orderHistory)) {
            $pos = $this->collOrderHistories->search($orderHistory);
            $this->collOrderHistories->remove($pos);
            if (null === $this->orderHistoriesScheduledForDeletion) {
                $this->orderHistoriesScheduledForDeletion = clone $this->collOrderHistories;
                $this->orderHistoriesScheduledForDeletion->clear();
            }
            $this->orderHistoriesScheduledForDeletion[]= clone $orderHistory;
            $orderHistory->setOrders(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related OrderHistories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderHistory[] List of ChildOrderHistory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderHistory}> List of ChildOrderHistory objects
     */
    public function getOrderHistoriesJoinOrderStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderHistoryQuery::create(null, $criteria);
        $query->joinWith('OrderStatus', $joinBehavior);

        return $this->getOrderHistories($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related OrderHistories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderHistory[] List of ChildOrderHistory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderHistory}> List of ChildOrderHistory objects
     */
    public function getOrderHistoriesJoinPaymentMethods(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderHistoryQuery::create(null, $criteria);
        $query->joinWith('PaymentMethods', $joinBehavior);

        return $this->getOrderHistories($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related OrderHistories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderHistory[] List of ChildOrderHistory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderHistory}> List of ChildOrderHistory objects
     */
    public function getOrderHistoriesJoinPaymentStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderHistoryQuery::create(null, $criteria);
        $query->joinWith('PaymentStatus', $joinBehavior);

        return $this->getOrderHistories($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related OrderHistories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderHistory[] List of ChildOrderHistory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderHistory}> List of ChildOrderHistory objects
     */
    public function getOrderHistoriesJoinUsers(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderHistoryQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getOrderHistories($query, $con);
    }

    /**
     * Clears out the collPickupss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPickupss()
     */
    public function clearPickupss()
    {
        $this->collPickupss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPickupss collection loaded partially.
     */
    public function resetPartialPickupss($v = true)
    {
        $this->collPickupssPartial = $v;
    }

    /**
     * Initializes the collPickupss collection.
     *
     * By default this just sets the collPickupss collection to an empty array (like clearcollPickupss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPickupss($overrideExisting = true)
    {
        if (null !== $this->collPickupss && !$overrideExisting) {
            return;
        }

        $collectionClassName = PickupsTableMap::getTableMap()->getCollectionClassName();

        $this->collPickupss = new $collectionClassName;
        $this->collPickupss->setModel('\Pickups');
    }

    /**
     * Gets an array of ChildPickups objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildOrders is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPickups[] List of ChildPickups objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPickups> List of ChildPickups objects
     * @throws PropelException
     */
    public function getPickupss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPickupssPartial && !$this->isNew();
        if (null === $this->collPickupss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPickupss) {
                    $this->initPickupss();
                } else {
                    $collectionClassName = PickupsTableMap::getTableMap()->getCollectionClassName();

                    $collPickupss = new $collectionClassName;
                    $collPickupss->setModel('\Pickups');

                    return $collPickupss;
                }
            } else {
                $collPickupss = ChildPickupsQuery::create(null, $criteria)
                    ->filterByOrders($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPickupssPartial && count($collPickupss)) {
                        $this->initPickupss(false);

                        foreach ($collPickupss as $obj) {
                            if (false == $this->collPickupss->contains($obj)) {
                                $this->collPickupss->append($obj);
                            }
                        }

                        $this->collPickupssPartial = true;
                    }

                    return $collPickupss;
                }

                if ($partial && $this->collPickupss) {
                    foreach ($this->collPickupss as $obj) {
                        if ($obj->isNew()) {
                            $collPickupss[] = $obj;
                        }
                    }
                }

                $this->collPickupss = $collPickupss;
                $this->collPickupssPartial = false;
            }
        }

        return $this->collPickupss;
    }

    /**
     * Sets a collection of ChildPickups objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $pickupss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildOrders The current object (for fluent API support)
     */
    public function setPickupss(Collection $pickupss, ConnectionInterface $con = null)
    {
        /** @var ChildPickups[] $pickupssToDelete */
        $pickupssToDelete = $this->getPickupss(new Criteria(), $con)->diff($pickupss);


        $this->pickupssScheduledForDeletion = $pickupssToDelete;

        foreach ($pickupssToDelete as $pickupsRemoved) {
            $pickupsRemoved->setOrders(null);
        }

        $this->collPickupss = null;
        foreach ($pickupss as $pickups) {
            $this->addPickups($pickups);
        }

        $this->collPickupss = $pickupss;
        $this->collPickupssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Pickups objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Pickups objects.
     * @throws PropelException
     */
    public function countPickupss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPickupssPartial && !$this->isNew();
        if (null === $this->collPickupss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPickupss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPickupss());
            }

            $query = ChildPickupsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByOrders($this)
                ->count($con);
        }

        return count($this->collPickupss);
    }

    /**
     * Method called to associate a ChildPickups object to this object
     * through the ChildPickups foreign key attribute.
     *
     * @param  ChildPickups $l ChildPickups
     * @return $this|\Orders The current object (for fluent API support)
     */
    public function addPickups(ChildPickups $l)
    {
        if ($this->collPickupss === null) {
            $this->initPickupss();
            $this->collPickupssPartial = true;
        }

        if (!$this->collPickupss->contains($l)) {
            $this->doAddPickups($l);

            if ($this->pickupssScheduledForDeletion and $this->pickupssScheduledForDeletion->contains($l)) {
                $this->pickupssScheduledForDeletion->remove($this->pickupssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPickups $pickups The ChildPickups object to add.
     */
    protected function doAddPickups(ChildPickups $pickups)
    {
        $this->collPickupss[]= $pickups;
        $pickups->setOrders($this);
    }

    /**
     * @param  ChildPickups $pickups The ChildPickups object to remove.
     * @return $this|ChildOrders The current object (for fluent API support)
     */
    public function removePickups(ChildPickups $pickups)
    {
        if ($this->getPickupss()->contains($pickups)) {
            $pos = $this->collPickupss->search($pickups);
            $this->collPickupss->remove($pos);
            if (null === $this->pickupssScheduledForDeletion) {
                $this->pickupssScheduledForDeletion = clone $this->collPickupss;
                $this->pickupssScheduledForDeletion->clear();
            }
            $this->pickupssScheduledForDeletion[]= clone $pickups;
            $pickups->setOrders(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related Pickupss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPickups[] List of ChildPickups objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPickups}> List of ChildPickups objects
     */
    public function getPickupssJoinCalendar(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPickupsQuery::create(null, $criteria);
        $query->joinWith('Calendar', $joinBehavior);

        return $this->getPickupss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Orders is new, it will return
     * an empty collection; or if this Orders has previously
     * been saved, it will retrieve related Pickupss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Orders.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPickups[] List of ChildPickups objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPickups}> List of ChildPickups objects
     */
    public function getPickupssJoinUsers(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPickupsQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getPickupss($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aBranchOffices) {
            $this->aBranchOffices->removeOrders($this);
        }
        if (null !== $this->aUsersRelatedByIdClientUser) {
            $this->aUsersRelatedByIdClientUser->removeOrdersRelatedByIdClientUser($this);
        }
        if (null !== $this->aUsersRelatedByIdDeliveryUser) {
            $this->aUsersRelatedByIdDeliveryUser->removeOrdersRelatedByIdDeliveryUser($this);
        }
        if (null !== $this->aOrderStatus) {
            $this->aOrderStatus->removeOrders($this);
        }
        if (null !== $this->aPaymentMethods) {
            $this->aPaymentMethods->removeOrders($this);
        }
        if (null !== $this->aPriorities) {
            $this->aPriorities->removeOrders($this);
        }
        if (null !== $this->aUsersRelatedByIdUser) {
            $this->aUsersRelatedByIdUser->removeOrdersRelatedByIdUser($this);
        }
        $this->id = null;
        $this->id_branch_office = null;
        $this->folio = null;
        $this->harvest_date = null;
        $this->harvest_time = null;
        $this->reception_date = null;
        $this->reception_time = null;
        $this->delivery_date = null;
        $this->home_delivery = null;
        $this->delivery_time = null;
        $this->real_delivery_date = null;
        $this->real_delivery_time = null;
        $this->id_delivery_user = null;
        $this->id_priority = null;
        $this->pieces = null;
        $this->kilograms = null;
        $this->observations = null;
        $this->subtotal = null;
        $this->total = null;
        $this->discount = null;
        $this->amount_paid = null;
        $this->printed_note = null;
        $this->payment_status = null;
        $this->id_order_status = null;
        $this->flag_home_service = null;
        $this->id_payment_method = null;
        $this->id_user = null;
        $this->id_client_user = null;
        $this->harvest_comments = null;
        $this->harvest_contact_name = null;
        $this->harvest_contact_signature = null;
        $this->harvest_photo = null;
        $this->delivery_comments = null;
        $this->delivery_contact_name = null;
        $this->delivery_contact_signature = null;
        $this->delivery_photo = null;
        $this->rank = null;
        $this->qualified = null;
        $this->client_comments = null;
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
            if ($this->collDeliveriess) {
                foreach ($this->collDeliveriess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collElectronicPurseHistories) {
                foreach ($this->collElectronicPurseHistories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrderDetails) {
                foreach ($this->collOrderDetails as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrderHistories) {
                foreach ($this->collOrderHistories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPickupss) {
                foreach ($this->collPickupss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collDeliveriess = null;
        $this->collElectronicPurseHistories = null;
        $this->collOrderDetails = null;
        $this->collOrderHistories = null;
        $this->collPickupss = null;
        $this->aBranchOffices = null;
        $this->aUsersRelatedByIdClientUser = null;
        $this->aUsersRelatedByIdDeliveryUser = null;
        $this->aOrderStatus = null;
        $this->aPaymentMethods = null;
        $this->aPriorities = null;
        $this->aUsersRelatedByIdUser = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(OrdersTableMap::DEFAULT_STRING_FORMAT);
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
