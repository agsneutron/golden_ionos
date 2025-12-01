<?php

namespace Base;

use \BranchOffices as ChildBranchOffices;
use \BranchOfficesQuery as ChildBranchOfficesQuery;
use \Deliveries as ChildDeliveries;
use \DeliveriesQuery as ChildDeliveriesQuery;
use \ElectronicPurse as ChildElectronicPurse;
use \ElectronicPurseQuery as ChildElectronicPurseQuery;
use \ExpenseReports as ChildExpenseReports;
use \ExpenseReportsQuery as ChildExpenseReportsQuery;
use \OrderDetail as ChildOrderDetail;
use \OrderDetailHistory as ChildOrderDetailHistory;
use \OrderDetailHistoryQuery as ChildOrderDetailHistoryQuery;
use \OrderDetailQuery as ChildOrderDetailQuery;
use \OrderHistory as ChildOrderHistory;
use \OrderHistoryQuery as ChildOrderHistoryQuery;
use \Orders as ChildOrders;
use \OrdersQuery as ChildOrdersQuery;
use \Pickups as ChildPickups;
use \PickupsQuery as ChildPickupsQuery;
use \UserTypes as ChildUserTypes;
use \UserTypesQuery as ChildUserTypesQuery;
use \Users as ChildUsers;
use \UsersQuery as ChildUsersQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\DeliveriesTableMap;
use Map\ElectronicPurseTableMap;
use Map\ExpenseReportsTableMap;
use Map\OrderDetailHistoryTableMap;
use Map\OrderDetailTableMap;
use Map\OrderHistoryTableMap;
use Map\OrdersTableMap;
use Map\PickupsTableMap;
use Map\UsersTableMap;
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
 * Base class that represents a row from the 'users' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Users implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\UsersTableMap';


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
     * The value for the id_user_type field.
     *
     * @var        int
     */
    protected $id_user_type;

    /**
     * The value for the name field.
     *
     * @var        string
     */
    protected $name;

    /**
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the password field.
     *
     * @var        string
     */
    protected $password;

    /**
     * The value for the address field.
     *
     * @var        string
     */
    protected $address;

    /**
     * The value for the suburb field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $suburb;

    /**
     * The value for the phone field.
     *
     * @var        string
     */
    protected $phone;

    /**
     * The value for the notes field.
     *
     * @var        string
     */
    protected $notes;

    /**
     * The value for the postal_code field.
     *
     * @var        int
     */
    protected $postal_code;

    /**
     * The value for the id_branch_office field.
     *
     * @var        int|null
     */
    protected $id_branch_office;

    /**
     * The value for the remember_token field.
     *
     * @var        string|null
     */
    protected $remember_token;

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
     * @var        ChildUserTypes
     */
    protected $aUserTypes;

    /**
     * @var        ObjectCollection|ChildDeliveries[] Collection to store aggregation of ChildDeliveries objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDeliveries> Collection to store aggregation of ChildDeliveries objects.
     */
    protected $collDeliveriess;
    protected $collDeliveriessPartial;

    /**
     * @var        ObjectCollection|ChildElectronicPurse[] Collection to store aggregation of ChildElectronicPurse objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildElectronicPurse> Collection to store aggregation of ChildElectronicPurse objects.
     */
    protected $collElectronicPurses;
    protected $collElectronicPursesPartial;

    /**
     * @var        ObjectCollection|ChildExpenseReports[] Collection to store aggregation of ChildExpenseReports objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildExpenseReports> Collection to store aggregation of ChildExpenseReports objects.
     */
    protected $collExpenseReportss;
    protected $collExpenseReportssPartial;

    /**
     * @var        ObjectCollection|ChildOrderDetail[] Collection to store aggregation of ChildOrderDetail objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrderDetail> Collection to store aggregation of ChildOrderDetail objects.
     */
    protected $collOrderDetails;
    protected $collOrderDetailsPartial;

    /**
     * @var        ObjectCollection|ChildOrderDetailHistory[] Collection to store aggregation of ChildOrderDetailHistory objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrderDetailHistory> Collection to store aggregation of ChildOrderDetailHistory objects.
     */
    protected $collOrderDetailHistories;
    protected $collOrderDetailHistoriesPartial;

    /**
     * @var        ObjectCollection|ChildOrderHistory[] Collection to store aggregation of ChildOrderHistory objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrderHistory> Collection to store aggregation of ChildOrderHistory objects.
     */
    protected $collOrderHistories;
    protected $collOrderHistoriesPartial;

    /**
     * @var        ObjectCollection|ChildOrders[] Collection to store aggregation of ChildOrders objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrders> Collection to store aggregation of ChildOrders objects.
     */
    protected $collOrderssRelatedByIdClientUser;
    protected $collOrderssRelatedByIdClientUserPartial;

    /**
     * @var        ObjectCollection|ChildOrders[] Collection to store aggregation of ChildOrders objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrders> Collection to store aggregation of ChildOrders objects.
     */
    protected $collOrderssRelatedByIdDeliveryUser;
    protected $collOrderssRelatedByIdDeliveryUserPartial;

    /**
     * @var        ObjectCollection|ChildOrders[] Collection to store aggregation of ChildOrders objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrders> Collection to store aggregation of ChildOrders objects.
     */
    protected $collOrderssRelatedByIdUser;
    protected $collOrderssRelatedByIdUserPartial;

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
     * @var ObjectCollection|ChildElectronicPurse[]
     * @phpstan-var ObjectCollection&\Traversable<ChildElectronicPurse>
     */
    protected $electronicPursesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildExpenseReports[]
     * @phpstan-var ObjectCollection&\Traversable<ChildExpenseReports>
     */
    protected $expenseReportssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrderDetail[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrderDetail>
     */
    protected $orderDetailsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrderDetailHistory[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrderDetailHistory>
     */
    protected $orderDetailHistoriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrderHistory[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrderHistory>
     */
    protected $orderHistoriesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrders[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrders>
     */
    protected $orderssRelatedByIdClientUserScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrders[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrders>
     */
    protected $orderssRelatedByIdDeliveryUserScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrders[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrders>
     */
    protected $orderssRelatedByIdUserScheduledForDeletion = null;

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
        $this->suburb = '';
    }

    /**
     * Initializes internal state of Base\Users object.
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
     * Compares this with another <code>Users</code> instance.  If
     * <code>obj</code> is an instance of <code>Users</code>, delegates to
     * <code>equals(Users)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [id_user_type] column value.
     *
     * @return int
     */
    public function getIdUserType()
    {
        return $this->id_user_type;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the [password] column value.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get the [address] column value.
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Get the [suburb] column value.
     *
     * @return string
     */
    public function getSuburb()
    {
        return $this->suburb;
    }

    /**
     * Get the [phone] column value.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Get the [notes] column value.
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Get the [postal_code] column value.
     *
     * @return int
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * Get the [id_branch_office] column value.
     *
     * @return int|null
     */
    public function getIdBranchOffice()
    {
        return $this->id_branch_office;
    }

    /**
     * Get the [remember_token] column value.
     *
     * @return string|null
     */
    public function getRememberToken()
    {
        return $this->remember_token;
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
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[UsersTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [id_user_type] column.
     *
     * @param int $v New value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setIdUserType($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_user_type !== $v) {
            $this->id_user_type = $v;
            $this->modifiedColumns[UsersTableMap::COL_ID_USER_TYPE] = true;
        }

        if ($this->aUserTypes !== null && $this->aUserTypes->getId() !== $v) {
            $this->aUserTypes = null;
        }

        return $this;
    } // setIdUserType()

    /**
     * Set the value of [name] column.
     *
     * @param string $v New value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[UsersTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [email] column.
     *
     * @param string $v New value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[UsersTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [password] column.
     *
     * @param string $v New value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[UsersTableMap::COL_PASSWORD] = true;
        }

        return $this;
    } // setPassword()

    /**
     * Set the value of [address] column.
     *
     * @param string $v New value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address !== $v) {
            $this->address = $v;
            $this->modifiedColumns[UsersTableMap::COL_ADDRESS] = true;
        }

        return $this;
    } // setAddress()

    /**
     * Set the value of [suburb] column.
     *
     * @param string $v New value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setSuburb($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->suburb !== $v) {
            $this->suburb = $v;
            $this->modifiedColumns[UsersTableMap::COL_SUBURB] = true;
        }

        return $this;
    } // setSuburb()

    /**
     * Set the value of [phone] column.
     *
     * @param string $v New value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone !== $v) {
            $this->phone = $v;
            $this->modifiedColumns[UsersTableMap::COL_PHONE] = true;
        }

        return $this;
    } // setPhone()

    /**
     * Set the value of [notes] column.
     *
     * @param string $v New value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setNotes($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->notes !== $v) {
            $this->notes = $v;
            $this->modifiedColumns[UsersTableMap::COL_NOTES] = true;
        }

        return $this;
    } // setNotes()

    /**
     * Set the value of [postal_code] column.
     *
     * @param int $v New value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setPostalCode($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->postal_code !== $v) {
            $this->postal_code = $v;
            $this->modifiedColumns[UsersTableMap::COL_POSTAL_CODE] = true;
        }

        return $this;
    } // setPostalCode()

    /**
     * Set the value of [id_branch_office] column.
     *
     * @param int|null $v New value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setIdBranchOffice($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_branch_office !== $v) {
            $this->id_branch_office = $v;
            $this->modifiedColumns[UsersTableMap::COL_ID_BRANCH_OFFICE] = true;
        }

        if ($this->aBranchOffices !== null && $this->aBranchOffices->getId() !== $v) {
            $this->aBranchOffices = null;
        }

        return $this;
    } // setIdBranchOffice()

    /**
     * Set the value of [remember_token] column.
     *
     * @param string|null $v New value
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setRememberToken($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->remember_token !== $v) {
            $this->remember_token = $v;
            $this->modifiedColumns[UsersTableMap::COL_REMEMBER_TOKEN] = true;
        }

        return $this;
    } // setRememberToken()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Users The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[UsersTableMap::COL_UPDATED_AT] = true;
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
            if ($this->suburb !== '') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UsersTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UsersTableMap::translateFieldName('IdUserType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_user_type = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UsersTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UsersTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UsersTableMap::translateFieldName('Password', TableMap::TYPE_PHPNAME, $indexType)];
            $this->password = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UsersTableMap::translateFieldName('Address', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UsersTableMap::translateFieldName('Suburb', TableMap::TYPE_PHPNAME, $indexType)];
            $this->suburb = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UsersTableMap::translateFieldName('Phone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : UsersTableMap::translateFieldName('Notes', TableMap::TYPE_PHPNAME, $indexType)];
            $this->notes = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : UsersTableMap::translateFieldName('PostalCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->postal_code = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : UsersTableMap::translateFieldName('IdBranchOffice', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_branch_office = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : UsersTableMap::translateFieldName('RememberToken', TableMap::TYPE_PHPNAME, $indexType)];
            $this->remember_token = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : UsersTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : UsersTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = UsersTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Users'), 0, $e);
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
        if ($this->aUserTypes !== null && $this->id_user_type !== $this->aUserTypes->getId()) {
            $this->aUserTypes = null;
        }
        if ($this->aBranchOffices !== null && $this->id_branch_office !== $this->aBranchOffices->getId()) {
            $this->aBranchOffices = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(UsersTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUsersQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aBranchOffices = null;
            $this->aUserTypes = null;
            $this->collDeliveriess = null;

            $this->collElectronicPurses = null;

            $this->collExpenseReportss = null;

            $this->collOrderDetails = null;

            $this->collOrderDetailHistories = null;

            $this->collOrderHistories = null;

            $this->collOrderssRelatedByIdClientUser = null;

            $this->collOrderssRelatedByIdDeliveryUser = null;

            $this->collOrderssRelatedByIdUser = null;

            $this->collPickupss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Users::setDeleted()
     * @see Users::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUsersQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
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
                UsersTableMap::addInstanceToPool($this);
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

            if ($this->aUserTypes !== null) {
                if ($this->aUserTypes->isModified() || $this->aUserTypes->isNew()) {
                    $affectedRows += $this->aUserTypes->save($con);
                }
                $this->setUserTypes($this->aUserTypes);
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

            if ($this->electronicPursesScheduledForDeletion !== null) {
                if (!$this->electronicPursesScheduledForDeletion->isEmpty()) {
                    \ElectronicPurseQuery::create()
                        ->filterByPrimaryKeys($this->electronicPursesScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->electronicPursesScheduledForDeletion = null;
                }
            }

            if ($this->collElectronicPurses !== null) {
                foreach ($this->collElectronicPurses as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->expenseReportssScheduledForDeletion !== null) {
                if (!$this->expenseReportssScheduledForDeletion->isEmpty()) {
                    \ExpenseReportsQuery::create()
                        ->filterByPrimaryKeys($this->expenseReportssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->expenseReportssScheduledForDeletion = null;
                }
            }

            if ($this->collExpenseReportss !== null) {
                foreach ($this->collExpenseReportss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->orderDetailsScheduledForDeletion !== null) {
                if (!$this->orderDetailsScheduledForDeletion->isEmpty()) {
                    foreach ($this->orderDetailsScheduledForDeletion as $orderDetail) {
                        // need to save related object because we set the relation to null
                        $orderDetail->save($con);
                    }
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

            if ($this->orderssRelatedByIdClientUserScheduledForDeletion !== null) {
                if (!$this->orderssRelatedByIdClientUserScheduledForDeletion->isEmpty()) {
                    \OrdersQuery::create()
                        ->filterByPrimaryKeys($this->orderssRelatedByIdClientUserScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->orderssRelatedByIdClientUserScheduledForDeletion = null;
                }
            }

            if ($this->collOrderssRelatedByIdClientUser !== null) {
                foreach ($this->collOrderssRelatedByIdClientUser as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->orderssRelatedByIdDeliveryUserScheduledForDeletion !== null) {
                if (!$this->orderssRelatedByIdDeliveryUserScheduledForDeletion->isEmpty()) {
                    foreach ($this->orderssRelatedByIdDeliveryUserScheduledForDeletion as $ordersRelatedByIdDeliveryUser) {
                        // need to save related object because we set the relation to null
                        $ordersRelatedByIdDeliveryUser->save($con);
                    }
                    $this->orderssRelatedByIdDeliveryUserScheduledForDeletion = null;
                }
            }

            if ($this->collOrderssRelatedByIdDeliveryUser !== null) {
                foreach ($this->collOrderssRelatedByIdDeliveryUser as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->orderssRelatedByIdUserScheduledForDeletion !== null) {
                if (!$this->orderssRelatedByIdUserScheduledForDeletion->isEmpty()) {
                    \OrdersQuery::create()
                        ->filterByPrimaryKeys($this->orderssRelatedByIdUserScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->orderssRelatedByIdUserScheduledForDeletion = null;
                }
            }

            if ($this->collOrderssRelatedByIdUser !== null) {
                foreach ($this->collOrderssRelatedByIdUser as $referrerFK) {
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

        $this->modifiedColumns[UsersTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UsersTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UsersTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(UsersTableMap::COL_ID_USER_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'id_user_type';
        }
        if ($this->isColumnModified(UsersTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(UsersTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(UsersTableMap::COL_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = 'password';
        }
        if ($this->isColumnModified(UsersTableMap::COL_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'address';
        }
        if ($this->isColumnModified(UsersTableMap::COL_SUBURB)) {
            $modifiedColumns[':p' . $index++]  = 'suburb';
        }
        if ($this->isColumnModified(UsersTableMap::COL_PHONE)) {
            $modifiedColumns[':p' . $index++]  = 'phone';
        }
        if ($this->isColumnModified(UsersTableMap::COL_NOTES)) {
            $modifiedColumns[':p' . $index++]  = 'notes';
        }
        if ($this->isColumnModified(UsersTableMap::COL_POSTAL_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'postal_code';
        }
        if ($this->isColumnModified(UsersTableMap::COL_ID_BRANCH_OFFICE)) {
            $modifiedColumns[':p' . $index++]  = 'id_branch_office';
        }
        if ($this->isColumnModified(UsersTableMap::COL_REMEMBER_TOKEN)) {
            $modifiedColumns[':p' . $index++]  = 'remember_token';
        }
        if ($this->isColumnModified(UsersTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(UsersTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO users (%s) VALUES (%s)',
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
                    case 'id_user_type':
                        $stmt->bindValue($identifier, $this->id_user_type, PDO::PARAM_INT);
                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'password':
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
                        break;
                    case 'address':
                        $stmt->bindValue($identifier, $this->address, PDO::PARAM_STR);
                        break;
                    case 'suburb':
                        $stmt->bindValue($identifier, $this->suburb, PDO::PARAM_STR);
                        break;
                    case 'phone':
                        $stmt->bindValue($identifier, $this->phone, PDO::PARAM_STR);
                        break;
                    case 'notes':
                        $stmt->bindValue($identifier, $this->notes, PDO::PARAM_STR);
                        break;
                    case 'postal_code':
                        $stmt->bindValue($identifier, $this->postal_code, PDO::PARAM_INT);
                        break;
                    case 'id_branch_office':
                        $stmt->bindValue($identifier, $this->id_branch_office, PDO::PARAM_INT);
                        break;
                    case 'remember_token':
                        $stmt->bindValue($identifier, $this->remember_token, PDO::PARAM_STR);
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
        $pos = UsersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getIdUserType();
                break;
            case 2:
                return $this->getName();
                break;
            case 3:
                return $this->getEmail();
                break;
            case 4:
                return $this->getPassword();
                break;
            case 5:
                return $this->getAddress();
                break;
            case 6:
                return $this->getSuburb();
                break;
            case 7:
                return $this->getPhone();
                break;
            case 8:
                return $this->getNotes();
                break;
            case 9:
                return $this->getPostalCode();
                break;
            case 10:
                return $this->getIdBranchOffice();
                break;
            case 11:
                return $this->getRememberToken();
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

        if (isset($alreadyDumpedObjects['Users'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Users'][$this->hashCode()] = true;
        $keys = UsersTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getIdUserType(),
            $keys[2] => $this->getName(),
            $keys[3] => $this->getEmail(),
            $keys[4] => $this->getPassword(),
            $keys[5] => $this->getAddress(),
            $keys[6] => $this->getSuburb(),
            $keys[7] => $this->getPhone(),
            $keys[8] => $this->getNotes(),
            $keys[9] => $this->getPostalCode(),
            $keys[10] => $this->getIdBranchOffice(),
            $keys[11] => $this->getRememberToken(),
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
            if (null !== $this->aUserTypes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userTypes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'user_types';
                        break;
                    default:
                        $key = 'UserTypes';
                }

                $result[$key] = $this->aUserTypes->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->collElectronicPurses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'electronicPurses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'electronic_purses';
                        break;
                    default:
                        $key = 'ElectronicPurses';
                }

                $result[$key] = $this->collElectronicPurses->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collExpenseReportss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'expenseReportss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'expense_reportss';
                        break;
                    default:
                        $key = 'ExpenseReportss';
                }

                $result[$key] = $this->collExpenseReportss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collOrderssRelatedByIdClientUser) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orderss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'orderss';
                        break;
                    default:
                        $key = 'Orderss';
                }

                $result[$key] = $this->collOrderssRelatedByIdClientUser->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOrderssRelatedByIdDeliveryUser) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orderss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'orderss';
                        break;
                    default:
                        $key = 'Orderss';
                }

                $result[$key] = $this->collOrderssRelatedByIdDeliveryUser->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collOrderssRelatedByIdUser) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'orderss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'orderss';
                        break;
                    default:
                        $key = 'Orderss';
                }

                $result[$key] = $this->collOrderssRelatedByIdUser->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Users
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UsersTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Users
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setIdUserType($value);
                break;
            case 2:
                $this->setName($value);
                break;
            case 3:
                $this->setEmail($value);
                break;
            case 4:
                $this->setPassword($value);
                break;
            case 5:
                $this->setAddress($value);
                break;
            case 6:
                $this->setSuburb($value);
                break;
            case 7:
                $this->setPhone($value);
                break;
            case 8:
                $this->setNotes($value);
                break;
            case 9:
                $this->setPostalCode($value);
                break;
            case 10:
                $this->setIdBranchOffice($value);
                break;
            case 11:
                $this->setRememberToken($value);
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
     * @return     $this|\Users
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = UsersTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setIdUserType($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setEmail($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPassword($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setAddress($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setSuburb($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setPhone($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setNotes($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setPostalCode($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setIdBranchOffice($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setRememberToken($arr[$keys[11]]);
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
     * @return $this|\Users The current object, for fluid interface
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
        $criteria = new Criteria(UsersTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UsersTableMap::COL_ID)) {
            $criteria->add(UsersTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(UsersTableMap::COL_ID_USER_TYPE)) {
            $criteria->add(UsersTableMap::COL_ID_USER_TYPE, $this->id_user_type);
        }
        if ($this->isColumnModified(UsersTableMap::COL_NAME)) {
            $criteria->add(UsersTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(UsersTableMap::COL_EMAIL)) {
            $criteria->add(UsersTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(UsersTableMap::COL_PASSWORD)) {
            $criteria->add(UsersTableMap::COL_PASSWORD, $this->password);
        }
        if ($this->isColumnModified(UsersTableMap::COL_ADDRESS)) {
            $criteria->add(UsersTableMap::COL_ADDRESS, $this->address);
        }
        if ($this->isColumnModified(UsersTableMap::COL_SUBURB)) {
            $criteria->add(UsersTableMap::COL_SUBURB, $this->suburb);
        }
        if ($this->isColumnModified(UsersTableMap::COL_PHONE)) {
            $criteria->add(UsersTableMap::COL_PHONE, $this->phone);
        }
        if ($this->isColumnModified(UsersTableMap::COL_NOTES)) {
            $criteria->add(UsersTableMap::COL_NOTES, $this->notes);
        }
        if ($this->isColumnModified(UsersTableMap::COL_POSTAL_CODE)) {
            $criteria->add(UsersTableMap::COL_POSTAL_CODE, $this->postal_code);
        }
        if ($this->isColumnModified(UsersTableMap::COL_ID_BRANCH_OFFICE)) {
            $criteria->add(UsersTableMap::COL_ID_BRANCH_OFFICE, $this->id_branch_office);
        }
        if ($this->isColumnModified(UsersTableMap::COL_REMEMBER_TOKEN)) {
            $criteria->add(UsersTableMap::COL_REMEMBER_TOKEN, $this->remember_token);
        }
        if ($this->isColumnModified(UsersTableMap::COL_CREATED_AT)) {
            $criteria->add(UsersTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(UsersTableMap::COL_UPDATED_AT)) {
            $criteria->add(UsersTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildUsersQuery::create();
        $criteria->add(UsersTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \Users (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setIdUserType($this->getIdUserType());
        $copyObj->setName($this->getName());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setAddress($this->getAddress());
        $copyObj->setSuburb($this->getSuburb());
        $copyObj->setPhone($this->getPhone());
        $copyObj->setNotes($this->getNotes());
        $copyObj->setPostalCode($this->getPostalCode());
        $copyObj->setIdBranchOffice($this->getIdBranchOffice());
        $copyObj->setRememberToken($this->getRememberToken());
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

            foreach ($this->getElectronicPurses() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addElectronicPurse($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getExpenseReportss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addExpenseReports($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderDetails() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrderDetail($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderDetailHistories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrderDetailHistory($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderHistories() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrderHistory($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderssRelatedByIdClientUser() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrdersRelatedByIdClientUser($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderssRelatedByIdDeliveryUser() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrdersRelatedByIdDeliveryUser($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderssRelatedByIdUser() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrdersRelatedByIdUser($relObj->copy($deepCopy));
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
     * @return \Users Clone of current object.
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
     * @param  ChildBranchOffices|null $v
     * @return $this|\Users The current object (for fluent API support)
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
            $v->addUsers($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildBranchOffices object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildBranchOffices|null The associated ChildBranchOffices object.
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
                $this->aBranchOffices->addUserss($this);
             */
        }

        return $this->aBranchOffices;
    }

    /**
     * Declares an association between this object and a ChildUserTypes object.
     *
     * @param  ChildUserTypes $v
     * @return $this|\Users The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUserTypes(ChildUserTypes $v = null)
    {
        if ($v === null) {
            $this->setIdUserType(NULL);
        } else {
            $this->setIdUserType($v->getId());
        }

        $this->aUserTypes = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUserTypes object, it will not be re-added.
        if ($v !== null) {
            $v->addUsers($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUserTypes object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUserTypes The associated ChildUserTypes object.
     * @throws PropelException
     */
    public function getUserTypes(ConnectionInterface $con = null)
    {
        if ($this->aUserTypes === null && ($this->id_user_type != 0)) {
            $this->aUserTypes = ChildUserTypesQuery::create()->findPk($this->id_user_type, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUserTypes->addUserss($this);
             */
        }

        return $this->aUserTypes;
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
        if ('ElectronicPurse' === $relationName) {
            $this->initElectronicPurses();
            return;
        }
        if ('ExpenseReports' === $relationName) {
            $this->initExpenseReportss();
            return;
        }
        if ('OrderDetail' === $relationName) {
            $this->initOrderDetails();
            return;
        }
        if ('OrderDetailHistory' === $relationName) {
            $this->initOrderDetailHistories();
            return;
        }
        if ('OrderHistory' === $relationName) {
            $this->initOrderHistories();
            return;
        }
        if ('OrdersRelatedByIdClientUser' === $relationName) {
            $this->initOrderssRelatedByIdClientUser();
            return;
        }
        if ('OrdersRelatedByIdDeliveryUser' === $relationName) {
            $this->initOrderssRelatedByIdDeliveryUser();
            return;
        }
        if ('OrdersRelatedByIdUser' === $relationName) {
            $this->initOrderssRelatedByIdUser();
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
     * If this ChildUsers is new, it will return
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
                    ->filterByUsers($this)
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
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function setDeliveriess(Collection $deliveriess, ConnectionInterface $con = null)
    {
        /** @var ChildDeliveries[] $deliveriessToDelete */
        $deliveriessToDelete = $this->getDeliveriess(new Criteria(), $con)->diff($deliveriess);


        $this->deliveriessScheduledForDeletion = $deliveriessToDelete;

        foreach ($deliveriessToDelete as $deliveriesRemoved) {
            $deliveriesRemoved->setUsers(null);
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
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collDeliveriess);
    }

    /**
     * Method called to associate a ChildDeliveries object to this object
     * through the ChildDeliveries foreign key attribute.
     *
     * @param  ChildDeliveries $l ChildDeliveries
     * @return $this|\Users The current object (for fluent API support)
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
        $deliveries->setUsers($this);
    }

    /**
     * @param  ChildDeliveries $deliveries The ChildDeliveries object to remove.
     * @return $this|ChildUsers The current object (for fluent API support)
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
            $deliveries->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related Deliveriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
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
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related Deliveriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildDeliveries[] List of ChildDeliveries objects
     * @phpstan-return ObjectCollection&\Traversable<ChildDeliveries}> List of ChildDeliveries objects
     */
    public function getDeliveriessJoinOrders(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildDeliveriesQuery::create(null, $criteria);
        $query->joinWith('Orders', $joinBehavior);

        return $this->getDeliveriess($query, $con);
    }

    /**
     * Clears out the collElectronicPurses collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addElectronicPurses()
     */
    public function clearElectronicPurses()
    {
        $this->collElectronicPurses = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collElectronicPurses collection loaded partially.
     */
    public function resetPartialElectronicPurses($v = true)
    {
        $this->collElectronicPursesPartial = $v;
    }

    /**
     * Initializes the collElectronicPurses collection.
     *
     * By default this just sets the collElectronicPurses collection to an empty array (like clearcollElectronicPurses());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initElectronicPurses($overrideExisting = true)
    {
        if (null !== $this->collElectronicPurses && !$overrideExisting) {
            return;
        }

        $collectionClassName = ElectronicPurseTableMap::getTableMap()->getCollectionClassName();

        $this->collElectronicPurses = new $collectionClassName;
        $this->collElectronicPurses->setModel('\ElectronicPurse');
    }

    /**
     * Gets an array of ChildElectronicPurse objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildElectronicPurse[] List of ChildElectronicPurse objects
     * @phpstan-return ObjectCollection&\Traversable<ChildElectronicPurse> List of ChildElectronicPurse objects
     * @throws PropelException
     */
    public function getElectronicPurses(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collElectronicPursesPartial && !$this->isNew();
        if (null === $this->collElectronicPurses || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collElectronicPurses) {
                    $this->initElectronicPurses();
                } else {
                    $collectionClassName = ElectronicPurseTableMap::getTableMap()->getCollectionClassName();

                    $collElectronicPurses = new $collectionClassName;
                    $collElectronicPurses->setModel('\ElectronicPurse');

                    return $collElectronicPurses;
                }
            } else {
                $collElectronicPurses = ChildElectronicPurseQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collElectronicPursesPartial && count($collElectronicPurses)) {
                        $this->initElectronicPurses(false);

                        foreach ($collElectronicPurses as $obj) {
                            if (false == $this->collElectronicPurses->contains($obj)) {
                                $this->collElectronicPurses->append($obj);
                            }
                        }

                        $this->collElectronicPursesPartial = true;
                    }

                    return $collElectronicPurses;
                }

                if ($partial && $this->collElectronicPurses) {
                    foreach ($this->collElectronicPurses as $obj) {
                        if ($obj->isNew()) {
                            $collElectronicPurses[] = $obj;
                        }
                    }
                }

                $this->collElectronicPurses = $collElectronicPurses;
                $this->collElectronicPursesPartial = false;
            }
        }

        return $this->collElectronicPurses;
    }

    /**
     * Sets a collection of ChildElectronicPurse objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $electronicPurses A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function setElectronicPurses(Collection $electronicPurses, ConnectionInterface $con = null)
    {
        /** @var ChildElectronicPurse[] $electronicPursesToDelete */
        $electronicPursesToDelete = $this->getElectronicPurses(new Criteria(), $con)->diff($electronicPurses);


        $this->electronicPursesScheduledForDeletion = $electronicPursesToDelete;

        foreach ($electronicPursesToDelete as $electronicPurseRemoved) {
            $electronicPurseRemoved->setUsers(null);
        }

        $this->collElectronicPurses = null;
        foreach ($electronicPurses as $electronicPurse) {
            $this->addElectronicPurse($electronicPurse);
        }

        $this->collElectronicPurses = $electronicPurses;
        $this->collElectronicPursesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ElectronicPurse objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ElectronicPurse objects.
     * @throws PropelException
     */
    public function countElectronicPurses(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collElectronicPursesPartial && !$this->isNew();
        if (null === $this->collElectronicPurses || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collElectronicPurses) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getElectronicPurses());
            }

            $query = ChildElectronicPurseQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collElectronicPurses);
    }

    /**
     * Method called to associate a ChildElectronicPurse object to this object
     * through the ChildElectronicPurse foreign key attribute.
     *
     * @param  ChildElectronicPurse $l ChildElectronicPurse
     * @return $this|\Users The current object (for fluent API support)
     */
    public function addElectronicPurse(ChildElectronicPurse $l)
    {
        if ($this->collElectronicPurses === null) {
            $this->initElectronicPurses();
            $this->collElectronicPursesPartial = true;
        }

        if (!$this->collElectronicPurses->contains($l)) {
            $this->doAddElectronicPurse($l);

            if ($this->electronicPursesScheduledForDeletion and $this->electronicPursesScheduledForDeletion->contains($l)) {
                $this->electronicPursesScheduledForDeletion->remove($this->electronicPursesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildElectronicPurse $electronicPurse The ChildElectronicPurse object to add.
     */
    protected function doAddElectronicPurse(ChildElectronicPurse $electronicPurse)
    {
        $this->collElectronicPurses[]= $electronicPurse;
        $electronicPurse->setUsers($this);
    }

    /**
     * @param  ChildElectronicPurse $electronicPurse The ChildElectronicPurse object to remove.
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function removeElectronicPurse(ChildElectronicPurse $electronicPurse)
    {
        if ($this->getElectronicPurses()->contains($electronicPurse)) {
            $pos = $this->collElectronicPurses->search($electronicPurse);
            $this->collElectronicPurses->remove($pos);
            if (null === $this->electronicPursesScheduledForDeletion) {
                $this->electronicPursesScheduledForDeletion = clone $this->collElectronicPurses;
                $this->electronicPursesScheduledForDeletion->clear();
            }
            $this->electronicPursesScheduledForDeletion[]= clone $electronicPurse;
            $electronicPurse->setUsers(null);
        }

        return $this;
    }

    /**
     * Clears out the collExpenseReportss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addExpenseReportss()
     */
    public function clearExpenseReportss()
    {
        $this->collExpenseReportss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collExpenseReportss collection loaded partially.
     */
    public function resetPartialExpenseReportss($v = true)
    {
        $this->collExpenseReportssPartial = $v;
    }

    /**
     * Initializes the collExpenseReportss collection.
     *
     * By default this just sets the collExpenseReportss collection to an empty array (like clearcollExpenseReportss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initExpenseReportss($overrideExisting = true)
    {
        if (null !== $this->collExpenseReportss && !$overrideExisting) {
            return;
        }

        $collectionClassName = ExpenseReportsTableMap::getTableMap()->getCollectionClassName();

        $this->collExpenseReportss = new $collectionClassName;
        $this->collExpenseReportss->setModel('\ExpenseReports');
    }

    /**
     * Gets an array of ChildExpenseReports objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildExpenseReports[] List of ChildExpenseReports objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenseReports> List of ChildExpenseReports objects
     * @throws PropelException
     */
    public function getExpenseReportss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collExpenseReportssPartial && !$this->isNew();
        if (null === $this->collExpenseReportss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collExpenseReportss) {
                    $this->initExpenseReportss();
                } else {
                    $collectionClassName = ExpenseReportsTableMap::getTableMap()->getCollectionClassName();

                    $collExpenseReportss = new $collectionClassName;
                    $collExpenseReportss->setModel('\ExpenseReports');

                    return $collExpenseReportss;
                }
            } else {
                $collExpenseReportss = ChildExpenseReportsQuery::create(null, $criteria)
                    ->filterByUsers($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collExpenseReportssPartial && count($collExpenseReportss)) {
                        $this->initExpenseReportss(false);

                        foreach ($collExpenseReportss as $obj) {
                            if (false == $this->collExpenseReportss->contains($obj)) {
                                $this->collExpenseReportss->append($obj);
                            }
                        }

                        $this->collExpenseReportssPartial = true;
                    }

                    return $collExpenseReportss;
                }

                if ($partial && $this->collExpenseReportss) {
                    foreach ($this->collExpenseReportss as $obj) {
                        if ($obj->isNew()) {
                            $collExpenseReportss[] = $obj;
                        }
                    }
                }

                $this->collExpenseReportss = $collExpenseReportss;
                $this->collExpenseReportssPartial = false;
            }
        }

        return $this->collExpenseReportss;
    }

    /**
     * Sets a collection of ChildExpenseReports objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $expenseReportss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function setExpenseReportss(Collection $expenseReportss, ConnectionInterface $con = null)
    {
        /** @var ChildExpenseReports[] $expenseReportssToDelete */
        $expenseReportssToDelete = $this->getExpenseReportss(new Criteria(), $con)->diff($expenseReportss);


        $this->expenseReportssScheduledForDeletion = $expenseReportssToDelete;

        foreach ($expenseReportssToDelete as $expenseReportsRemoved) {
            $expenseReportsRemoved->setUsers(null);
        }

        $this->collExpenseReportss = null;
        foreach ($expenseReportss as $expenseReports) {
            $this->addExpenseReports($expenseReports);
        }

        $this->collExpenseReportss = $expenseReportss;
        $this->collExpenseReportssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ExpenseReports objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related ExpenseReports objects.
     * @throws PropelException
     */
    public function countExpenseReportss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collExpenseReportssPartial && !$this->isNew();
        if (null === $this->collExpenseReportss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collExpenseReportss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getExpenseReportss());
            }

            $query = ChildExpenseReportsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collExpenseReportss);
    }

    /**
     * Method called to associate a ChildExpenseReports object to this object
     * through the ChildExpenseReports foreign key attribute.
     *
     * @param  ChildExpenseReports $l ChildExpenseReports
     * @return $this|\Users The current object (for fluent API support)
     */
    public function addExpenseReports(ChildExpenseReports $l)
    {
        if ($this->collExpenseReportss === null) {
            $this->initExpenseReportss();
            $this->collExpenseReportssPartial = true;
        }

        if (!$this->collExpenseReportss->contains($l)) {
            $this->doAddExpenseReports($l);

            if ($this->expenseReportssScheduledForDeletion and $this->expenseReportssScheduledForDeletion->contains($l)) {
                $this->expenseReportssScheduledForDeletion->remove($this->expenseReportssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildExpenseReports $expenseReports The ChildExpenseReports object to add.
     */
    protected function doAddExpenseReports(ChildExpenseReports $expenseReports)
    {
        $this->collExpenseReportss[]= $expenseReports;
        $expenseReports->setUsers($this);
    }

    /**
     * @param  ChildExpenseReports $expenseReports The ChildExpenseReports object to remove.
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function removeExpenseReports(ChildExpenseReports $expenseReports)
    {
        if ($this->getExpenseReportss()->contains($expenseReports)) {
            $pos = $this->collExpenseReportss->search($expenseReports);
            $this->collExpenseReportss->remove($pos);
            if (null === $this->expenseReportssScheduledForDeletion) {
                $this->expenseReportssScheduledForDeletion = clone $this->collExpenseReportss;
                $this->expenseReportssScheduledForDeletion->clear();
            }
            $this->expenseReportssScheduledForDeletion[]= clone $expenseReports;
            $expenseReports->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related ExpenseReportss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpenseReports[] List of ChildExpenseReports objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenseReports}> List of ChildExpenseReports objects
     */
    public function getExpenseReportssJoinBranchOffices(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpenseReportsQuery::create(null, $criteria);
        $query->joinWith('BranchOffices', $joinBehavior);

        return $this->getExpenseReportss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related ExpenseReportss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpenseReports[] List of ChildExpenseReports objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenseReports}> List of ChildExpenseReports objects
     */
    public function getExpenseReportssJoinExpenseConcepts(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpenseReportsQuery::create(null, $criteria);
        $query->joinWith('ExpenseConcepts', $joinBehavior);

        return $this->getExpenseReportss($query, $con);
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
     * If this ChildUsers is new, it will return
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
                    ->filterByUsers($this)
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
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function setOrderDetails(Collection $orderDetails, ConnectionInterface $con = null)
    {
        /** @var ChildOrderDetail[] $orderDetailsToDelete */
        $orderDetailsToDelete = $this->getOrderDetails(new Criteria(), $con)->diff($orderDetails);


        $this->orderDetailsScheduledForDeletion = $orderDetailsToDelete;

        foreach ($orderDetailsToDelete as $orderDetailRemoved) {
            $orderDetailRemoved->setUsers(null);
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
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collOrderDetails);
    }

    /**
     * Method called to associate a ChildOrderDetail object to this object
     * through the ChildOrderDetail foreign key attribute.
     *
     * @param  ChildOrderDetail $l ChildOrderDetail
     * @return $this|\Users The current object (for fluent API support)
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
        $orderDetail->setUsers($this);
    }

    /**
     * @param  ChildOrderDetail $orderDetail The ChildOrderDetail object to remove.
     * @return $this|ChildUsers The current object (for fluent API support)
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
            $this->orderDetailsScheduledForDeletion[]= $orderDetail;
            $orderDetail->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderDetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
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
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderDetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
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
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderDetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
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
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderDetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderDetail[] List of ChildOrderDetail objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderDetail}> List of ChildOrderDetail objects
     */
    public function getOrderDetailsJoinOrders(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderDetailQuery::create(null, $criteria);
        $query->joinWith('Orders', $joinBehavior);

        return $this->getOrderDetails($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderDetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
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
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderDetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
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
     * If this ChildUsers is new, it will return
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
                    ->filterByUsers($this)
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
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function setOrderDetailHistories(Collection $orderDetailHistories, ConnectionInterface $con = null)
    {
        /** @var ChildOrderDetailHistory[] $orderDetailHistoriesToDelete */
        $orderDetailHistoriesToDelete = $this->getOrderDetailHistories(new Criteria(), $con)->diff($orderDetailHistories);


        $this->orderDetailHistoriesScheduledForDeletion = $orderDetailHistoriesToDelete;

        foreach ($orderDetailHistoriesToDelete as $orderDetailHistoryRemoved) {
            $orderDetailHistoryRemoved->setUsers(null);
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
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collOrderDetailHistories);
    }

    /**
     * Method called to associate a ChildOrderDetailHistory object to this object
     * through the ChildOrderDetailHistory foreign key attribute.
     *
     * @param  ChildOrderDetailHistory $l ChildOrderDetailHistory
     * @return $this|\Users The current object (for fluent API support)
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
        $orderDetailHistory->setUsers($this);
    }

    /**
     * @param  ChildOrderDetailHistory $orderDetailHistory The ChildOrderDetailHistory object to remove.
     * @return $this|ChildUsers The current object (for fluent API support)
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
            $orderDetailHistory->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderDetailHistories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderDetailHistory[] List of ChildOrderDetailHistory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderDetailHistory}> List of ChildOrderDetailHistory objects
     */
    public function getOrderDetailHistoriesJoinOrderDetail(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderDetailHistoryQuery::create(null, $criteria);
        $query->joinWith('OrderDetail', $joinBehavior);

        return $this->getOrderDetailHistories($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderDetailHistories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
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
     * If this ChildUsers is new, it will return
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
                    ->filterByUsers($this)
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
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function setOrderHistories(Collection $orderHistories, ConnectionInterface $con = null)
    {
        /** @var ChildOrderHistory[] $orderHistoriesToDelete */
        $orderHistoriesToDelete = $this->getOrderHistories(new Criteria(), $con)->diff($orderHistories);


        $this->orderHistoriesScheduledForDeletion = $orderHistoriesToDelete;

        foreach ($orderHistoriesToDelete as $orderHistoryRemoved) {
            $orderHistoryRemoved->setUsers(null);
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
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collOrderHistories);
    }

    /**
     * Method called to associate a ChildOrderHistory object to this object
     * through the ChildOrderHistory foreign key attribute.
     *
     * @param  ChildOrderHistory $l ChildOrderHistory
     * @return $this|\Users The current object (for fluent API support)
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
        $orderHistory->setUsers($this);
    }

    /**
     * @param  ChildOrderHistory $orderHistory The ChildOrderHistory object to remove.
     * @return $this|ChildUsers The current object (for fluent API support)
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
            $orderHistory->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderHistories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrderHistory[] List of ChildOrderHistory objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrderHistory}> List of ChildOrderHistory objects
     */
    public function getOrderHistoriesJoinOrders(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrderHistoryQuery::create(null, $criteria);
        $query->joinWith('Orders', $joinBehavior);

        return $this->getOrderHistories($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderHistories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
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
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderHistories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
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
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderHistories from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
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
     * Clears out the collOrderssRelatedByIdClientUser collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addOrderssRelatedByIdClientUser()
     */
    public function clearOrderssRelatedByIdClientUser()
    {
        $this->collOrderssRelatedByIdClientUser = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collOrderssRelatedByIdClientUser collection loaded partially.
     */
    public function resetPartialOrderssRelatedByIdClientUser($v = true)
    {
        $this->collOrderssRelatedByIdClientUserPartial = $v;
    }

    /**
     * Initializes the collOrderssRelatedByIdClientUser collection.
     *
     * By default this just sets the collOrderssRelatedByIdClientUser collection to an empty array (like clearcollOrderssRelatedByIdClientUser());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderssRelatedByIdClientUser($overrideExisting = true)
    {
        if (null !== $this->collOrderssRelatedByIdClientUser && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrdersTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderssRelatedByIdClientUser = new $collectionClassName;
        $this->collOrderssRelatedByIdClientUser->setModel('\Orders');
    }

    /**
     * Gets an array of ChildOrders objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders> List of ChildOrders objects
     * @throws PropelException
     */
    public function getOrderssRelatedByIdClientUser(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collOrderssRelatedByIdClientUserPartial && !$this->isNew();
        if (null === $this->collOrderssRelatedByIdClientUser || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrderssRelatedByIdClientUser) {
                    $this->initOrderssRelatedByIdClientUser();
                } else {
                    $collectionClassName = OrdersTableMap::getTableMap()->getCollectionClassName();

                    $collOrderssRelatedByIdClientUser = new $collectionClassName;
                    $collOrderssRelatedByIdClientUser->setModel('\Orders');

                    return $collOrderssRelatedByIdClientUser;
                }
            } else {
                $collOrderssRelatedByIdClientUser = ChildOrdersQuery::create(null, $criteria)
                    ->filterByUsersRelatedByIdClientUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderssRelatedByIdClientUserPartial && count($collOrderssRelatedByIdClientUser)) {
                        $this->initOrderssRelatedByIdClientUser(false);

                        foreach ($collOrderssRelatedByIdClientUser as $obj) {
                            if (false == $this->collOrderssRelatedByIdClientUser->contains($obj)) {
                                $this->collOrderssRelatedByIdClientUser->append($obj);
                            }
                        }

                        $this->collOrderssRelatedByIdClientUserPartial = true;
                    }

                    return $collOrderssRelatedByIdClientUser;
                }

                if ($partial && $this->collOrderssRelatedByIdClientUser) {
                    foreach ($this->collOrderssRelatedByIdClientUser as $obj) {
                        if ($obj->isNew()) {
                            $collOrderssRelatedByIdClientUser[] = $obj;
                        }
                    }
                }

                $this->collOrderssRelatedByIdClientUser = $collOrderssRelatedByIdClientUser;
                $this->collOrderssRelatedByIdClientUserPartial = false;
            }
        }

        return $this->collOrderssRelatedByIdClientUser;
    }

    /**
     * Sets a collection of ChildOrders objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $orderssRelatedByIdClientUser A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function setOrderssRelatedByIdClientUser(Collection $orderssRelatedByIdClientUser, ConnectionInterface $con = null)
    {
        /** @var ChildOrders[] $orderssRelatedByIdClientUserToDelete */
        $orderssRelatedByIdClientUserToDelete = $this->getOrderssRelatedByIdClientUser(new Criteria(), $con)->diff($orderssRelatedByIdClientUser);


        $this->orderssRelatedByIdClientUserScheduledForDeletion = $orderssRelatedByIdClientUserToDelete;

        foreach ($orderssRelatedByIdClientUserToDelete as $ordersRelatedByIdClientUserRemoved) {
            $ordersRelatedByIdClientUserRemoved->setUsersRelatedByIdClientUser(null);
        }

        $this->collOrderssRelatedByIdClientUser = null;
        foreach ($orderssRelatedByIdClientUser as $ordersRelatedByIdClientUser) {
            $this->addOrdersRelatedByIdClientUser($ordersRelatedByIdClientUser);
        }

        $this->collOrderssRelatedByIdClientUser = $orderssRelatedByIdClientUser;
        $this->collOrderssRelatedByIdClientUserPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Orders objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Orders objects.
     * @throws PropelException
     */
    public function countOrderssRelatedByIdClientUser(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collOrderssRelatedByIdClientUserPartial && !$this->isNew();
        if (null === $this->collOrderssRelatedByIdClientUser || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderssRelatedByIdClientUser) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderssRelatedByIdClientUser());
            }

            $query = ChildOrdersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsersRelatedByIdClientUser($this)
                ->count($con);
        }

        return count($this->collOrderssRelatedByIdClientUser);
    }

    /**
     * Method called to associate a ChildOrders object to this object
     * through the ChildOrders foreign key attribute.
     *
     * @param  ChildOrders $l ChildOrders
     * @return $this|\Users The current object (for fluent API support)
     */
    public function addOrdersRelatedByIdClientUser(ChildOrders $l)
    {
        if ($this->collOrderssRelatedByIdClientUser === null) {
            $this->initOrderssRelatedByIdClientUser();
            $this->collOrderssRelatedByIdClientUserPartial = true;
        }

        if (!$this->collOrderssRelatedByIdClientUser->contains($l)) {
            $this->doAddOrdersRelatedByIdClientUser($l);

            if ($this->orderssRelatedByIdClientUserScheduledForDeletion and $this->orderssRelatedByIdClientUserScheduledForDeletion->contains($l)) {
                $this->orderssRelatedByIdClientUserScheduledForDeletion->remove($this->orderssRelatedByIdClientUserScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrders $ordersRelatedByIdClientUser The ChildOrders object to add.
     */
    protected function doAddOrdersRelatedByIdClientUser(ChildOrders $ordersRelatedByIdClientUser)
    {
        $this->collOrderssRelatedByIdClientUser[]= $ordersRelatedByIdClientUser;
        $ordersRelatedByIdClientUser->setUsersRelatedByIdClientUser($this);
    }

    /**
     * @param  ChildOrders $ordersRelatedByIdClientUser The ChildOrders object to remove.
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function removeOrdersRelatedByIdClientUser(ChildOrders $ordersRelatedByIdClientUser)
    {
        if ($this->getOrderssRelatedByIdClientUser()->contains($ordersRelatedByIdClientUser)) {
            $pos = $this->collOrderssRelatedByIdClientUser->search($ordersRelatedByIdClientUser);
            $this->collOrderssRelatedByIdClientUser->remove($pos);
            if (null === $this->orderssRelatedByIdClientUserScheduledForDeletion) {
                $this->orderssRelatedByIdClientUserScheduledForDeletion = clone $this->collOrderssRelatedByIdClientUser;
                $this->orderssRelatedByIdClientUserScheduledForDeletion->clear();
            }
            $this->orderssRelatedByIdClientUserScheduledForDeletion[]= clone $ordersRelatedByIdClientUser;
            $ordersRelatedByIdClientUser->setUsersRelatedByIdClientUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderssRelatedByIdClientUser from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssRelatedByIdClientUserJoinBranchOffices(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('BranchOffices', $joinBehavior);

        return $this->getOrderssRelatedByIdClientUser($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderssRelatedByIdClientUser from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssRelatedByIdClientUserJoinOrderStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('OrderStatus', $joinBehavior);

        return $this->getOrderssRelatedByIdClientUser($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderssRelatedByIdClientUser from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssRelatedByIdClientUserJoinPaymentMethods(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('PaymentMethods', $joinBehavior);

        return $this->getOrderssRelatedByIdClientUser($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderssRelatedByIdClientUser from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssRelatedByIdClientUserJoinPriorities(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Priorities', $joinBehavior);

        return $this->getOrderssRelatedByIdClientUser($query, $con);
    }

    /**
     * Clears out the collOrderssRelatedByIdDeliveryUser collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addOrderssRelatedByIdDeliveryUser()
     */
    public function clearOrderssRelatedByIdDeliveryUser()
    {
        $this->collOrderssRelatedByIdDeliveryUser = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collOrderssRelatedByIdDeliveryUser collection loaded partially.
     */
    public function resetPartialOrderssRelatedByIdDeliveryUser($v = true)
    {
        $this->collOrderssRelatedByIdDeliveryUserPartial = $v;
    }

    /**
     * Initializes the collOrderssRelatedByIdDeliveryUser collection.
     *
     * By default this just sets the collOrderssRelatedByIdDeliveryUser collection to an empty array (like clearcollOrderssRelatedByIdDeliveryUser());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderssRelatedByIdDeliveryUser($overrideExisting = true)
    {
        if (null !== $this->collOrderssRelatedByIdDeliveryUser && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrdersTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderssRelatedByIdDeliveryUser = new $collectionClassName;
        $this->collOrderssRelatedByIdDeliveryUser->setModel('\Orders');
    }

    /**
     * Gets an array of ChildOrders objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders> List of ChildOrders objects
     * @throws PropelException
     */
    public function getOrderssRelatedByIdDeliveryUser(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collOrderssRelatedByIdDeliveryUserPartial && !$this->isNew();
        if (null === $this->collOrderssRelatedByIdDeliveryUser || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrderssRelatedByIdDeliveryUser) {
                    $this->initOrderssRelatedByIdDeliveryUser();
                } else {
                    $collectionClassName = OrdersTableMap::getTableMap()->getCollectionClassName();

                    $collOrderssRelatedByIdDeliveryUser = new $collectionClassName;
                    $collOrderssRelatedByIdDeliveryUser->setModel('\Orders');

                    return $collOrderssRelatedByIdDeliveryUser;
                }
            } else {
                $collOrderssRelatedByIdDeliveryUser = ChildOrdersQuery::create(null, $criteria)
                    ->filterByUsersRelatedByIdDeliveryUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderssRelatedByIdDeliveryUserPartial && count($collOrderssRelatedByIdDeliveryUser)) {
                        $this->initOrderssRelatedByIdDeliveryUser(false);

                        foreach ($collOrderssRelatedByIdDeliveryUser as $obj) {
                            if (false == $this->collOrderssRelatedByIdDeliveryUser->contains($obj)) {
                                $this->collOrderssRelatedByIdDeliveryUser->append($obj);
                            }
                        }

                        $this->collOrderssRelatedByIdDeliveryUserPartial = true;
                    }

                    return $collOrderssRelatedByIdDeliveryUser;
                }

                if ($partial && $this->collOrderssRelatedByIdDeliveryUser) {
                    foreach ($this->collOrderssRelatedByIdDeliveryUser as $obj) {
                        if ($obj->isNew()) {
                            $collOrderssRelatedByIdDeliveryUser[] = $obj;
                        }
                    }
                }

                $this->collOrderssRelatedByIdDeliveryUser = $collOrderssRelatedByIdDeliveryUser;
                $this->collOrderssRelatedByIdDeliveryUserPartial = false;
            }
        }

        return $this->collOrderssRelatedByIdDeliveryUser;
    }

    /**
     * Sets a collection of ChildOrders objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $orderssRelatedByIdDeliveryUser A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function setOrderssRelatedByIdDeliveryUser(Collection $orderssRelatedByIdDeliveryUser, ConnectionInterface $con = null)
    {
        /** @var ChildOrders[] $orderssRelatedByIdDeliveryUserToDelete */
        $orderssRelatedByIdDeliveryUserToDelete = $this->getOrderssRelatedByIdDeliveryUser(new Criteria(), $con)->diff($orderssRelatedByIdDeliveryUser);


        $this->orderssRelatedByIdDeliveryUserScheduledForDeletion = $orderssRelatedByIdDeliveryUserToDelete;

        foreach ($orderssRelatedByIdDeliveryUserToDelete as $ordersRelatedByIdDeliveryUserRemoved) {
            $ordersRelatedByIdDeliveryUserRemoved->setUsersRelatedByIdDeliveryUser(null);
        }

        $this->collOrderssRelatedByIdDeliveryUser = null;
        foreach ($orderssRelatedByIdDeliveryUser as $ordersRelatedByIdDeliveryUser) {
            $this->addOrdersRelatedByIdDeliveryUser($ordersRelatedByIdDeliveryUser);
        }

        $this->collOrderssRelatedByIdDeliveryUser = $orderssRelatedByIdDeliveryUser;
        $this->collOrderssRelatedByIdDeliveryUserPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Orders objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Orders objects.
     * @throws PropelException
     */
    public function countOrderssRelatedByIdDeliveryUser(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collOrderssRelatedByIdDeliveryUserPartial && !$this->isNew();
        if (null === $this->collOrderssRelatedByIdDeliveryUser || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderssRelatedByIdDeliveryUser) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderssRelatedByIdDeliveryUser());
            }

            $query = ChildOrdersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsersRelatedByIdDeliveryUser($this)
                ->count($con);
        }

        return count($this->collOrderssRelatedByIdDeliveryUser);
    }

    /**
     * Method called to associate a ChildOrders object to this object
     * through the ChildOrders foreign key attribute.
     *
     * @param  ChildOrders $l ChildOrders
     * @return $this|\Users The current object (for fluent API support)
     */
    public function addOrdersRelatedByIdDeliveryUser(ChildOrders $l)
    {
        if ($this->collOrderssRelatedByIdDeliveryUser === null) {
            $this->initOrderssRelatedByIdDeliveryUser();
            $this->collOrderssRelatedByIdDeliveryUserPartial = true;
        }

        if (!$this->collOrderssRelatedByIdDeliveryUser->contains($l)) {
            $this->doAddOrdersRelatedByIdDeliveryUser($l);

            if ($this->orderssRelatedByIdDeliveryUserScheduledForDeletion and $this->orderssRelatedByIdDeliveryUserScheduledForDeletion->contains($l)) {
                $this->orderssRelatedByIdDeliveryUserScheduledForDeletion->remove($this->orderssRelatedByIdDeliveryUserScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrders $ordersRelatedByIdDeliveryUser The ChildOrders object to add.
     */
    protected function doAddOrdersRelatedByIdDeliveryUser(ChildOrders $ordersRelatedByIdDeliveryUser)
    {
        $this->collOrderssRelatedByIdDeliveryUser[]= $ordersRelatedByIdDeliveryUser;
        $ordersRelatedByIdDeliveryUser->setUsersRelatedByIdDeliveryUser($this);
    }

    /**
     * @param  ChildOrders $ordersRelatedByIdDeliveryUser The ChildOrders object to remove.
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function removeOrdersRelatedByIdDeliveryUser(ChildOrders $ordersRelatedByIdDeliveryUser)
    {
        if ($this->getOrderssRelatedByIdDeliveryUser()->contains($ordersRelatedByIdDeliveryUser)) {
            $pos = $this->collOrderssRelatedByIdDeliveryUser->search($ordersRelatedByIdDeliveryUser);
            $this->collOrderssRelatedByIdDeliveryUser->remove($pos);
            if (null === $this->orderssRelatedByIdDeliveryUserScheduledForDeletion) {
                $this->orderssRelatedByIdDeliveryUserScheduledForDeletion = clone $this->collOrderssRelatedByIdDeliveryUser;
                $this->orderssRelatedByIdDeliveryUserScheduledForDeletion->clear();
            }
            $this->orderssRelatedByIdDeliveryUserScheduledForDeletion[]= $ordersRelatedByIdDeliveryUser;
            $ordersRelatedByIdDeliveryUser->setUsersRelatedByIdDeliveryUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderssRelatedByIdDeliveryUser from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssRelatedByIdDeliveryUserJoinBranchOffices(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('BranchOffices', $joinBehavior);

        return $this->getOrderssRelatedByIdDeliveryUser($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderssRelatedByIdDeliveryUser from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssRelatedByIdDeliveryUserJoinOrderStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('OrderStatus', $joinBehavior);

        return $this->getOrderssRelatedByIdDeliveryUser($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderssRelatedByIdDeliveryUser from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssRelatedByIdDeliveryUserJoinPaymentMethods(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('PaymentMethods', $joinBehavior);

        return $this->getOrderssRelatedByIdDeliveryUser($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderssRelatedByIdDeliveryUser from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssRelatedByIdDeliveryUserJoinPriorities(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Priorities', $joinBehavior);

        return $this->getOrderssRelatedByIdDeliveryUser($query, $con);
    }

    /**
     * Clears out the collOrderssRelatedByIdUser collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addOrderssRelatedByIdUser()
     */
    public function clearOrderssRelatedByIdUser()
    {
        $this->collOrderssRelatedByIdUser = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collOrderssRelatedByIdUser collection loaded partially.
     */
    public function resetPartialOrderssRelatedByIdUser($v = true)
    {
        $this->collOrderssRelatedByIdUserPartial = $v;
    }

    /**
     * Initializes the collOrderssRelatedByIdUser collection.
     *
     * By default this just sets the collOrderssRelatedByIdUser collection to an empty array (like clearcollOrderssRelatedByIdUser());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderssRelatedByIdUser($overrideExisting = true)
    {
        if (null !== $this->collOrderssRelatedByIdUser && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrdersTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderssRelatedByIdUser = new $collectionClassName;
        $this->collOrderssRelatedByIdUser->setModel('\Orders');
    }

    /**
     * Gets an array of ChildOrders objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUsers is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders> List of ChildOrders objects
     * @throws PropelException
     */
    public function getOrderssRelatedByIdUser(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collOrderssRelatedByIdUserPartial && !$this->isNew();
        if (null === $this->collOrderssRelatedByIdUser || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrderssRelatedByIdUser) {
                    $this->initOrderssRelatedByIdUser();
                } else {
                    $collectionClassName = OrdersTableMap::getTableMap()->getCollectionClassName();

                    $collOrderssRelatedByIdUser = new $collectionClassName;
                    $collOrderssRelatedByIdUser->setModel('\Orders');

                    return $collOrderssRelatedByIdUser;
                }
            } else {
                $collOrderssRelatedByIdUser = ChildOrdersQuery::create(null, $criteria)
                    ->filterByUsersRelatedByIdUser($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderssRelatedByIdUserPartial && count($collOrderssRelatedByIdUser)) {
                        $this->initOrderssRelatedByIdUser(false);

                        foreach ($collOrderssRelatedByIdUser as $obj) {
                            if (false == $this->collOrderssRelatedByIdUser->contains($obj)) {
                                $this->collOrderssRelatedByIdUser->append($obj);
                            }
                        }

                        $this->collOrderssRelatedByIdUserPartial = true;
                    }

                    return $collOrderssRelatedByIdUser;
                }

                if ($partial && $this->collOrderssRelatedByIdUser) {
                    foreach ($this->collOrderssRelatedByIdUser as $obj) {
                        if ($obj->isNew()) {
                            $collOrderssRelatedByIdUser[] = $obj;
                        }
                    }
                }

                $this->collOrderssRelatedByIdUser = $collOrderssRelatedByIdUser;
                $this->collOrderssRelatedByIdUserPartial = false;
            }
        }

        return $this->collOrderssRelatedByIdUser;
    }

    /**
     * Sets a collection of ChildOrders objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $orderssRelatedByIdUser A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function setOrderssRelatedByIdUser(Collection $orderssRelatedByIdUser, ConnectionInterface $con = null)
    {
        /** @var ChildOrders[] $orderssRelatedByIdUserToDelete */
        $orderssRelatedByIdUserToDelete = $this->getOrderssRelatedByIdUser(new Criteria(), $con)->diff($orderssRelatedByIdUser);


        $this->orderssRelatedByIdUserScheduledForDeletion = $orderssRelatedByIdUserToDelete;

        foreach ($orderssRelatedByIdUserToDelete as $ordersRelatedByIdUserRemoved) {
            $ordersRelatedByIdUserRemoved->setUsersRelatedByIdUser(null);
        }

        $this->collOrderssRelatedByIdUser = null;
        foreach ($orderssRelatedByIdUser as $ordersRelatedByIdUser) {
            $this->addOrdersRelatedByIdUser($ordersRelatedByIdUser);
        }

        $this->collOrderssRelatedByIdUser = $orderssRelatedByIdUser;
        $this->collOrderssRelatedByIdUserPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Orders objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Orders objects.
     * @throws PropelException
     */
    public function countOrderssRelatedByIdUser(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collOrderssRelatedByIdUserPartial && !$this->isNew();
        if (null === $this->collOrderssRelatedByIdUser || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderssRelatedByIdUser) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderssRelatedByIdUser());
            }

            $query = ChildOrdersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsersRelatedByIdUser($this)
                ->count($con);
        }

        return count($this->collOrderssRelatedByIdUser);
    }

    /**
     * Method called to associate a ChildOrders object to this object
     * through the ChildOrders foreign key attribute.
     *
     * @param  ChildOrders $l ChildOrders
     * @return $this|\Users The current object (for fluent API support)
     */
    public function addOrdersRelatedByIdUser(ChildOrders $l)
    {
        if ($this->collOrderssRelatedByIdUser === null) {
            $this->initOrderssRelatedByIdUser();
            $this->collOrderssRelatedByIdUserPartial = true;
        }

        if (!$this->collOrderssRelatedByIdUser->contains($l)) {
            $this->doAddOrdersRelatedByIdUser($l);

            if ($this->orderssRelatedByIdUserScheduledForDeletion and $this->orderssRelatedByIdUserScheduledForDeletion->contains($l)) {
                $this->orderssRelatedByIdUserScheduledForDeletion->remove($this->orderssRelatedByIdUserScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrders $ordersRelatedByIdUser The ChildOrders object to add.
     */
    protected function doAddOrdersRelatedByIdUser(ChildOrders $ordersRelatedByIdUser)
    {
        $this->collOrderssRelatedByIdUser[]= $ordersRelatedByIdUser;
        $ordersRelatedByIdUser->setUsersRelatedByIdUser($this);
    }

    /**
     * @param  ChildOrders $ordersRelatedByIdUser The ChildOrders object to remove.
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function removeOrdersRelatedByIdUser(ChildOrders $ordersRelatedByIdUser)
    {
        if ($this->getOrderssRelatedByIdUser()->contains($ordersRelatedByIdUser)) {
            $pos = $this->collOrderssRelatedByIdUser->search($ordersRelatedByIdUser);
            $this->collOrderssRelatedByIdUser->remove($pos);
            if (null === $this->orderssRelatedByIdUserScheduledForDeletion) {
                $this->orderssRelatedByIdUserScheduledForDeletion = clone $this->collOrderssRelatedByIdUser;
                $this->orderssRelatedByIdUserScheduledForDeletion->clear();
            }
            $this->orderssRelatedByIdUserScheduledForDeletion[]= clone $ordersRelatedByIdUser;
            $ordersRelatedByIdUser->setUsersRelatedByIdUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderssRelatedByIdUser from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssRelatedByIdUserJoinBranchOffices(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('BranchOffices', $joinBehavior);

        return $this->getOrderssRelatedByIdUser($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderssRelatedByIdUser from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssRelatedByIdUserJoinOrderStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('OrderStatus', $joinBehavior);

        return $this->getOrderssRelatedByIdUser($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderssRelatedByIdUser from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssRelatedByIdUserJoinPaymentMethods(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('PaymentMethods', $joinBehavior);

        return $this->getOrderssRelatedByIdUser($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related OrderssRelatedByIdUser from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssRelatedByIdUserJoinPriorities(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Priorities', $joinBehavior);

        return $this->getOrderssRelatedByIdUser($query, $con);
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
     * If this ChildUsers is new, it will return
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
                    ->filterByUsers($this)
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
     * @return $this|ChildUsers The current object (for fluent API support)
     */
    public function setPickupss(Collection $pickupss, ConnectionInterface $con = null)
    {
        /** @var ChildPickups[] $pickupssToDelete */
        $pickupssToDelete = $this->getPickupss(new Criteria(), $con)->diff($pickupss);


        $this->pickupssScheduledForDeletion = $pickupssToDelete;

        foreach ($pickupssToDelete as $pickupsRemoved) {
            $pickupsRemoved->setUsers(null);
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
                ->filterByUsers($this)
                ->count($con);
        }

        return count($this->collPickupss);
    }

    /**
     * Method called to associate a ChildPickups object to this object
     * through the ChildPickups foreign key attribute.
     *
     * @param  ChildPickups $l ChildPickups
     * @return $this|\Users The current object (for fluent API support)
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
        $pickups->setUsers($this);
    }

    /**
     * @param  ChildPickups $pickups The ChildPickups object to remove.
     * @return $this|ChildUsers The current object (for fluent API support)
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
            $pickups->setUsers(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related Pickupss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
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
     * Otherwise if this Users is new, it will return
     * an empty collection; or if this Users has previously
     * been saved, it will retrieve related Pickupss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Users.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPickups[] List of ChildPickups objects
     * @phpstan-return ObjectCollection&\Traversable<ChildPickups}> List of ChildPickups objects
     */
    public function getPickupssJoinOrders(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPickupsQuery::create(null, $criteria);
        $query->joinWith('Orders', $joinBehavior);

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
            $this->aBranchOffices->removeUsers($this);
        }
        if (null !== $this->aUserTypes) {
            $this->aUserTypes->removeUsers($this);
        }
        $this->id = null;
        $this->id_user_type = null;
        $this->name = null;
        $this->email = null;
        $this->password = null;
        $this->address = null;
        $this->suburb = null;
        $this->phone = null;
        $this->notes = null;
        $this->postal_code = null;
        $this->id_branch_office = null;
        $this->remember_token = null;
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
            if ($this->collElectronicPurses) {
                foreach ($this->collElectronicPurses as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collExpenseReportss) {
                foreach ($this->collExpenseReportss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrderDetails) {
                foreach ($this->collOrderDetails as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrderDetailHistories) {
                foreach ($this->collOrderDetailHistories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrderHistories) {
                foreach ($this->collOrderHistories as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrderssRelatedByIdClientUser) {
                foreach ($this->collOrderssRelatedByIdClientUser as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrderssRelatedByIdDeliveryUser) {
                foreach ($this->collOrderssRelatedByIdDeliveryUser as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrderssRelatedByIdUser) {
                foreach ($this->collOrderssRelatedByIdUser as $o) {
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
        $this->collElectronicPurses = null;
        $this->collExpenseReportss = null;
        $this->collOrderDetails = null;
        $this->collOrderDetailHistories = null;
        $this->collOrderHistories = null;
        $this->collOrderssRelatedByIdClientUser = null;
        $this->collOrderssRelatedByIdDeliveryUser = null;
        $this->collOrderssRelatedByIdUser = null;
        $this->collPickupss = null;
        $this->aBranchOffices = null;
        $this->aUserTypes = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UsersTableMap::DEFAULT_STRING_FORMAT);
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
