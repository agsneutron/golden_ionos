<?php

namespace Base;

use \BranchOfficeServices as ChildBranchOfficeServices;
use \BranchOfficeServicesQuery as ChildBranchOfficeServicesQuery;
use \BranchOffices as ChildBranchOffices;
use \BranchOfficesQuery as ChildBranchOfficesQuery;
use \ExpenseReports as ChildExpenseReports;
use \ExpenseReportsQuery as ChildExpenseReportsQuery;
use \Orders as ChildOrders;
use \OrdersQuery as ChildOrdersQuery;
use \Users as ChildUsers;
use \UsersQuery as ChildUsersQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\BranchOfficeServicesTableMap;
use Map\BranchOfficesTableMap;
use Map\ExpenseReportsTableMap;
use Map\OrdersTableMap;
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
 * Base class that represents a row from the 'branch_offices' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class BranchOffices implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\BranchOfficesTableMap';


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
     * The value for the name field.
     *
     * @var        string
     */
    protected $name;

    /**
     * The value for the address field.
     *
     * @var        string
     */
    protected $address;

    /**
     * The value for the phone field.
     *
     * @var        string
     */
    protected $phone;

    /**
     * The value for the series field.
     *
     * @var        string
     */
    protected $series;

    /**
     * The value for the current_sheet field.
     *
     * @var        int
     */
    protected $current_sheet;

    /**
     * The value for the rfc field.
     *
     * @var        string
     */
    protected $rfc;

    /**
     * The value for the email field.
     *
     * @var        string
     */
    protected $email;

    /**
     * The value for the legend field.
     *
     * @var        string
     */
    protected $legend;

    /**
     * The value for the postal_code field.
     *
     * @var        int
     */
    protected $postal_code;

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
     * @var        ObjectCollection|ChildBranchOfficeServices[] Collection to store aggregation of ChildBranchOfficeServices objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildBranchOfficeServices> Collection to store aggregation of ChildBranchOfficeServices objects.
     */
    protected $collBranchOfficeServicess;
    protected $collBranchOfficeServicessPartial;

    /**
     * @var        ObjectCollection|ChildExpenseReports[] Collection to store aggregation of ChildExpenseReports objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildExpenseReports> Collection to store aggregation of ChildExpenseReports objects.
     */
    protected $collExpenseReportss;
    protected $collExpenseReportssPartial;

    /**
     * @var        ObjectCollection|ChildOrders[] Collection to store aggregation of ChildOrders objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildOrders> Collection to store aggregation of ChildOrders objects.
     */
    protected $collOrderss;
    protected $collOrderssPartial;

    /**
     * @var        ObjectCollection|ChildUsers[] Collection to store aggregation of ChildUsers objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildUsers> Collection to store aggregation of ChildUsers objects.
     */
    protected $collUserss;
    protected $collUserssPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildBranchOfficeServices[]
     * @phpstan-var ObjectCollection&\Traversable<ChildBranchOfficeServices>
     */
    protected $branchOfficeServicessScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildExpenseReports[]
     * @phpstan-var ObjectCollection&\Traversable<ChildExpenseReports>
     */
    protected $expenseReportssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildOrders[]
     * @phpstan-var ObjectCollection&\Traversable<ChildOrders>
     */
    protected $orderssScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildUsers[]
     * @phpstan-var ObjectCollection&\Traversable<ChildUsers>
     */
    protected $userssScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\BranchOffices object.
     */
    public function __construct()
    {
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
     * Compares this with another <code>BranchOffices</code> instance.  If
     * <code>obj</code> is an instance of <code>BranchOffices</code>, delegates to
     * <code>equals(BranchOffices)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * Get the [phone] column value.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Get the [series] column value.
     *
     * @return string
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * Get the [current_sheet] column value.
     *
     * @return int
     */
    public function getCurrentSheet()
    {
        return $this->current_sheet;
    }

    /**
     * Get the [rfc] column value.
     *
     * @return string
     */
    public function getRfc()
    {
        return $this->rfc;
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
     * Get the [legend] column value.
     *
     * @return string
     */
    public function getLegend()
    {
        return $this->legend;
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
     * @return $this|\BranchOffices The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[BranchOfficesTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [name] column.
     *
     * @param string $v New value
     * @return $this|\BranchOffices The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[BranchOfficesTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [address] column.
     *
     * @param string $v New value
     * @return $this|\BranchOffices The current object (for fluent API support)
     */
    public function setAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->address !== $v) {
            $this->address = $v;
            $this->modifiedColumns[BranchOfficesTableMap::COL_ADDRESS] = true;
        }

        return $this;
    } // setAddress()

    /**
     * Set the value of [phone] column.
     *
     * @param string $v New value
     * @return $this|\BranchOffices The current object (for fluent API support)
     */
    public function setPhone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->phone !== $v) {
            $this->phone = $v;
            $this->modifiedColumns[BranchOfficesTableMap::COL_PHONE] = true;
        }

        return $this;
    } // setPhone()

    /**
     * Set the value of [series] column.
     *
     * @param string $v New value
     * @return $this|\BranchOffices The current object (for fluent API support)
     */
    public function setSeries($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->series !== $v) {
            $this->series = $v;
            $this->modifiedColumns[BranchOfficesTableMap::COL_SERIES] = true;
        }

        return $this;
    } // setSeries()

    /**
     * Set the value of [current_sheet] column.
     *
     * @param int $v New value
     * @return $this|\BranchOffices The current object (for fluent API support)
     */
    public function setCurrentSheet($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->current_sheet !== $v) {
            $this->current_sheet = $v;
            $this->modifiedColumns[BranchOfficesTableMap::COL_CURRENT_SHEET] = true;
        }

        return $this;
    } // setCurrentSheet()

    /**
     * Set the value of [rfc] column.
     *
     * @param string $v New value
     * @return $this|\BranchOffices The current object (for fluent API support)
     */
    public function setRfc($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->rfc !== $v) {
            $this->rfc = $v;
            $this->modifiedColumns[BranchOfficesTableMap::COL_RFC] = true;
        }

        return $this;
    } // setRfc()

    /**
     * Set the value of [email] column.
     *
     * @param string $v New value
     * @return $this|\BranchOffices The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[BranchOfficesTableMap::COL_EMAIL] = true;
        }

        return $this;
    } // setEmail()

    /**
     * Set the value of [legend] column.
     *
     * @param string $v New value
     * @return $this|\BranchOffices The current object (for fluent API support)
     */
    public function setLegend($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->legend !== $v) {
            $this->legend = $v;
            $this->modifiedColumns[BranchOfficesTableMap::COL_LEGEND] = true;
        }

        return $this;
    } // setLegend()

    /**
     * Set the value of [postal_code] column.
     *
     * @param int $v New value
     * @return $this|\BranchOffices The current object (for fluent API support)
     */
    public function setPostalCode($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->postal_code !== $v) {
            $this->postal_code = $v;
            $this->modifiedColumns[BranchOfficesTableMap::COL_POSTAL_CODE] = true;
        }

        return $this;
    } // setPostalCode()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\BranchOffices The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[BranchOfficesTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\BranchOffices The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            if ($this->updated_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->updated_at->format("Y-m-d H:i:s.u")) {
                $this->updated_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[BranchOfficesTableMap::COL_UPDATED_AT] = true;
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : BranchOfficesTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : BranchOfficesTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : BranchOfficesTableMap::translateFieldName('Address', TableMap::TYPE_PHPNAME, $indexType)];
            $this->address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : BranchOfficesTableMap::translateFieldName('Phone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->phone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : BranchOfficesTableMap::translateFieldName('Series', TableMap::TYPE_PHPNAME, $indexType)];
            $this->series = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : BranchOfficesTableMap::translateFieldName('CurrentSheet', TableMap::TYPE_PHPNAME, $indexType)];
            $this->current_sheet = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : BranchOfficesTableMap::translateFieldName('Rfc', TableMap::TYPE_PHPNAME, $indexType)];
            $this->rfc = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : BranchOfficesTableMap::translateFieldName('Email', TableMap::TYPE_PHPNAME, $indexType)];
            $this->email = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : BranchOfficesTableMap::translateFieldName('Legend', TableMap::TYPE_PHPNAME, $indexType)];
            $this->legend = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : BranchOfficesTableMap::translateFieldName('PostalCode', TableMap::TYPE_PHPNAME, $indexType)];
            $this->postal_code = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : BranchOfficesTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : BranchOfficesTableMap::translateFieldName('UpdatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->updated_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 12; // 12 = BranchOfficesTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\BranchOffices'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(BranchOfficesTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildBranchOfficesQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collBranchOfficeServicess = null;

            $this->collExpenseReportss = null;

            $this->collOrderss = null;

            $this->collUserss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see BranchOffices::setDeleted()
     * @see BranchOffices::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(BranchOfficesTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildBranchOfficesQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(BranchOfficesTableMap::DATABASE_NAME);
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
                BranchOfficesTableMap::addInstanceToPool($this);
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

            if ($this->branchOfficeServicessScheduledForDeletion !== null) {
                if (!$this->branchOfficeServicessScheduledForDeletion->isEmpty()) {
                    \BranchOfficeServicesQuery::create()
                        ->filterByPrimaryKeys($this->branchOfficeServicessScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->branchOfficeServicessScheduledForDeletion = null;
                }
            }

            if ($this->collBranchOfficeServicess !== null) {
                foreach ($this->collBranchOfficeServicess as $referrerFK) {
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

            if ($this->orderssScheduledForDeletion !== null) {
                if (!$this->orderssScheduledForDeletion->isEmpty()) {
                    \OrdersQuery::create()
                        ->filterByPrimaryKeys($this->orderssScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->orderssScheduledForDeletion = null;
                }
            }

            if ($this->collOrderss !== null) {
                foreach ($this->collOrderss as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->userssScheduledForDeletion !== null) {
                if (!$this->userssScheduledForDeletion->isEmpty()) {
                    foreach ($this->userssScheduledForDeletion as $users) {
                        // need to save related object because we set the relation to null
                        $users->save($con);
                    }
                    $this->userssScheduledForDeletion = null;
                }
            }

            if ($this->collUserss !== null) {
                foreach ($this->collUserss as $referrerFK) {
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

        $this->modifiedColumns[BranchOfficesTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BranchOfficesTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BranchOfficesTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(BranchOfficesTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(BranchOfficesTableMap::COL_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'address';
        }
        if ($this->isColumnModified(BranchOfficesTableMap::COL_PHONE)) {
            $modifiedColumns[':p' . $index++]  = 'phone';
        }
        if ($this->isColumnModified(BranchOfficesTableMap::COL_SERIES)) {
            $modifiedColumns[':p' . $index++]  = 'series';
        }
        if ($this->isColumnModified(BranchOfficesTableMap::COL_CURRENT_SHEET)) {
            $modifiedColumns[':p' . $index++]  = 'current_sheet';
        }
        if ($this->isColumnModified(BranchOfficesTableMap::COL_RFC)) {
            $modifiedColumns[':p' . $index++]  = 'rfc';
        }
        if ($this->isColumnModified(BranchOfficesTableMap::COL_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = 'email';
        }
        if ($this->isColumnModified(BranchOfficesTableMap::COL_LEGEND)) {
            $modifiedColumns[':p' . $index++]  = 'legend';
        }
        if ($this->isColumnModified(BranchOfficesTableMap::COL_POSTAL_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'postal_code';
        }
        if ($this->isColumnModified(BranchOfficesTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(BranchOfficesTableMap::COL_UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO branch_offices (%s) VALUES (%s)',
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
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'address':
                        $stmt->bindValue($identifier, $this->address, PDO::PARAM_STR);
                        break;
                    case 'phone':
                        $stmt->bindValue($identifier, $this->phone, PDO::PARAM_STR);
                        break;
                    case 'series':
                        $stmt->bindValue($identifier, $this->series, PDO::PARAM_STR);
                        break;
                    case 'current_sheet':
                        $stmt->bindValue($identifier, $this->current_sheet, PDO::PARAM_INT);
                        break;
                    case 'rfc':
                        $stmt->bindValue($identifier, $this->rfc, PDO::PARAM_STR);
                        break;
                    case 'email':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case 'legend':
                        $stmt->bindValue($identifier, $this->legend, PDO::PARAM_STR);
                        break;
                    case 'postal_code':
                        $stmt->bindValue($identifier, $this->postal_code, PDO::PARAM_INT);
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
        $pos = BranchOfficesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getName();
                break;
            case 2:
                return $this->getAddress();
                break;
            case 3:
                return $this->getPhone();
                break;
            case 4:
                return $this->getSeries();
                break;
            case 5:
                return $this->getCurrentSheet();
                break;
            case 6:
                return $this->getRfc();
                break;
            case 7:
                return $this->getEmail();
                break;
            case 8:
                return $this->getLegend();
                break;
            case 9:
                return $this->getPostalCode();
                break;
            case 10:
                return $this->getCreatedAt();
                break;
            case 11:
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

        if (isset($alreadyDumpedObjects['BranchOffices'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['BranchOffices'][$this->hashCode()] = true;
        $keys = BranchOfficesTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getAddress(),
            $keys[3] => $this->getPhone(),
            $keys[4] => $this->getSeries(),
            $keys[5] => $this->getCurrentSheet(),
            $keys[6] => $this->getRfc(),
            $keys[7] => $this->getEmail(),
            $keys[8] => $this->getLegend(),
            $keys[9] => $this->getPostalCode(),
            $keys[10] => $this->getCreatedAt(),
            $keys[11] => $this->getUpdatedAt(),
        );
        if ($result[$keys[10]] instanceof \DateTimeInterface) {
            $result[$keys[10]] = $result[$keys[10]]->format('Y-m-d H:i:s.u');
        }

        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('Y-m-d H:i:s.u');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collBranchOfficeServicess) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'branchOfficeServicess';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'branch_office_servicess';
                        break;
                    default:
                        $key = 'BranchOfficeServicess';
                }

                $result[$key] = $this->collBranchOfficeServicess->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
            if (null !== $this->collOrderss) {

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

                $result[$key] = $this->collOrderss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUserss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'userss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'userss';
                        break;
                    default:
                        $key = 'Userss';
                }

                $result[$key] = $this->collUserss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\BranchOffices
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = BranchOfficesTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\BranchOffices
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setAddress($value);
                break;
            case 3:
                $this->setPhone($value);
                break;
            case 4:
                $this->setSeries($value);
                break;
            case 5:
                $this->setCurrentSheet($value);
                break;
            case 6:
                $this->setRfc($value);
                break;
            case 7:
                $this->setEmail($value);
                break;
            case 8:
                $this->setLegend($value);
                break;
            case 9:
                $this->setPostalCode($value);
                break;
            case 10:
                $this->setCreatedAt($value);
                break;
            case 11:
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
     * @return     $this|\BranchOffices
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = BranchOfficesTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setAddress($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPhone($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setSeries($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCurrentSheet($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setRfc($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setEmail($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setLegend($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setPostalCode($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setCreatedAt($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setUpdatedAt($arr[$keys[11]]);
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
     * @return $this|\BranchOffices The current object, for fluid interface
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
        $criteria = new Criteria(BranchOfficesTableMap::DATABASE_NAME);

        if ($this->isColumnModified(BranchOfficesTableMap::COL_ID)) {
            $criteria->add(BranchOfficesTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(BranchOfficesTableMap::COL_NAME)) {
            $criteria->add(BranchOfficesTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(BranchOfficesTableMap::COL_ADDRESS)) {
            $criteria->add(BranchOfficesTableMap::COL_ADDRESS, $this->address);
        }
        if ($this->isColumnModified(BranchOfficesTableMap::COL_PHONE)) {
            $criteria->add(BranchOfficesTableMap::COL_PHONE, $this->phone);
        }
        if ($this->isColumnModified(BranchOfficesTableMap::COL_SERIES)) {
            $criteria->add(BranchOfficesTableMap::COL_SERIES, $this->series);
        }
        if ($this->isColumnModified(BranchOfficesTableMap::COL_CURRENT_SHEET)) {
            $criteria->add(BranchOfficesTableMap::COL_CURRENT_SHEET, $this->current_sheet);
        }
        if ($this->isColumnModified(BranchOfficesTableMap::COL_RFC)) {
            $criteria->add(BranchOfficesTableMap::COL_RFC, $this->rfc);
        }
        if ($this->isColumnModified(BranchOfficesTableMap::COL_EMAIL)) {
            $criteria->add(BranchOfficesTableMap::COL_EMAIL, $this->email);
        }
        if ($this->isColumnModified(BranchOfficesTableMap::COL_LEGEND)) {
            $criteria->add(BranchOfficesTableMap::COL_LEGEND, $this->legend);
        }
        if ($this->isColumnModified(BranchOfficesTableMap::COL_POSTAL_CODE)) {
            $criteria->add(BranchOfficesTableMap::COL_POSTAL_CODE, $this->postal_code);
        }
        if ($this->isColumnModified(BranchOfficesTableMap::COL_CREATED_AT)) {
            $criteria->add(BranchOfficesTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(BranchOfficesTableMap::COL_UPDATED_AT)) {
            $criteria->add(BranchOfficesTableMap::COL_UPDATED_AT, $this->updated_at);
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
        $criteria = ChildBranchOfficesQuery::create();
        $criteria->add(BranchOfficesTableMap::COL_ID, $this->id);

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
     * @param      object $copyObj An object of \BranchOffices (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setAddress($this->getAddress());
        $copyObj->setPhone($this->getPhone());
        $copyObj->setSeries($this->getSeries());
        $copyObj->setCurrentSheet($this->getCurrentSheet());
        $copyObj->setRfc($this->getRfc());
        $copyObj->setEmail($this->getEmail());
        $copyObj->setLegend($this->getLegend());
        $copyObj->setPostalCode($this->getPostalCode());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getBranchOfficeServicess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBranchOfficeServices($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getExpenseReportss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addExpenseReports($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getOrderss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addOrders($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUserss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUsers($relObj->copy($deepCopy));
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
     * @return \BranchOffices Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('BranchOfficeServices' === $relationName) {
            $this->initBranchOfficeServicess();
            return;
        }
        if ('ExpenseReports' === $relationName) {
            $this->initExpenseReportss();
            return;
        }
        if ('Orders' === $relationName) {
            $this->initOrderss();
            return;
        }
        if ('Users' === $relationName) {
            $this->initUserss();
            return;
        }
    }

    /**
     * Clears out the collBranchOfficeServicess collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addBranchOfficeServicess()
     */
    public function clearBranchOfficeServicess()
    {
        $this->collBranchOfficeServicess = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collBranchOfficeServicess collection loaded partially.
     */
    public function resetPartialBranchOfficeServicess($v = true)
    {
        $this->collBranchOfficeServicessPartial = $v;
    }

    /**
     * Initializes the collBranchOfficeServicess collection.
     *
     * By default this just sets the collBranchOfficeServicess collection to an empty array (like clearcollBranchOfficeServicess());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBranchOfficeServicess($overrideExisting = true)
    {
        if (null !== $this->collBranchOfficeServicess && !$overrideExisting) {
            return;
        }

        $collectionClassName = BranchOfficeServicesTableMap::getTableMap()->getCollectionClassName();

        $this->collBranchOfficeServicess = new $collectionClassName;
        $this->collBranchOfficeServicess->setModel('\BranchOfficeServices');
    }

    /**
     * Gets an array of ChildBranchOfficeServices objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBranchOffices is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildBranchOfficeServices[] List of ChildBranchOfficeServices objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBranchOfficeServices> List of ChildBranchOfficeServices objects
     * @throws PropelException
     */
    public function getBranchOfficeServicess(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collBranchOfficeServicessPartial && !$this->isNew();
        if (null === $this->collBranchOfficeServicess || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collBranchOfficeServicess) {
                    $this->initBranchOfficeServicess();
                } else {
                    $collectionClassName = BranchOfficeServicesTableMap::getTableMap()->getCollectionClassName();

                    $collBranchOfficeServicess = new $collectionClassName;
                    $collBranchOfficeServicess->setModel('\BranchOfficeServices');

                    return $collBranchOfficeServicess;
                }
            } else {
                $collBranchOfficeServicess = ChildBranchOfficeServicesQuery::create(null, $criteria)
                    ->filterByBranchOffices($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collBranchOfficeServicessPartial && count($collBranchOfficeServicess)) {
                        $this->initBranchOfficeServicess(false);

                        foreach ($collBranchOfficeServicess as $obj) {
                            if (false == $this->collBranchOfficeServicess->contains($obj)) {
                                $this->collBranchOfficeServicess->append($obj);
                            }
                        }

                        $this->collBranchOfficeServicessPartial = true;
                    }

                    return $collBranchOfficeServicess;
                }

                if ($partial && $this->collBranchOfficeServicess) {
                    foreach ($this->collBranchOfficeServicess as $obj) {
                        if ($obj->isNew()) {
                            $collBranchOfficeServicess[] = $obj;
                        }
                    }
                }

                $this->collBranchOfficeServicess = $collBranchOfficeServicess;
                $this->collBranchOfficeServicessPartial = false;
            }
        }

        return $this->collBranchOfficeServicess;
    }

    /**
     * Sets a collection of ChildBranchOfficeServices objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $branchOfficeServicess A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildBranchOffices The current object (for fluent API support)
     */
    public function setBranchOfficeServicess(Collection $branchOfficeServicess, ConnectionInterface $con = null)
    {
        /** @var ChildBranchOfficeServices[] $branchOfficeServicessToDelete */
        $branchOfficeServicessToDelete = $this->getBranchOfficeServicess(new Criteria(), $con)->diff($branchOfficeServicess);


        $this->branchOfficeServicessScheduledForDeletion = $branchOfficeServicessToDelete;

        foreach ($branchOfficeServicessToDelete as $branchOfficeServicesRemoved) {
            $branchOfficeServicesRemoved->setBranchOffices(null);
        }

        $this->collBranchOfficeServicess = null;
        foreach ($branchOfficeServicess as $branchOfficeServices) {
            $this->addBranchOfficeServices($branchOfficeServices);
        }

        $this->collBranchOfficeServicess = $branchOfficeServicess;
        $this->collBranchOfficeServicessPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BranchOfficeServices objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related BranchOfficeServices objects.
     * @throws PropelException
     */
    public function countBranchOfficeServicess(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collBranchOfficeServicessPartial && !$this->isNew();
        if (null === $this->collBranchOfficeServicess || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBranchOfficeServicess) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getBranchOfficeServicess());
            }

            $query = ChildBranchOfficeServicesQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBranchOffices($this)
                ->count($con);
        }

        return count($this->collBranchOfficeServicess);
    }

    /**
     * Method called to associate a ChildBranchOfficeServices object to this object
     * through the ChildBranchOfficeServices foreign key attribute.
     *
     * @param  ChildBranchOfficeServices $l ChildBranchOfficeServices
     * @return $this|\BranchOffices The current object (for fluent API support)
     */
    public function addBranchOfficeServices(ChildBranchOfficeServices $l)
    {
        if ($this->collBranchOfficeServicess === null) {
            $this->initBranchOfficeServicess();
            $this->collBranchOfficeServicessPartial = true;
        }

        if (!$this->collBranchOfficeServicess->contains($l)) {
            $this->doAddBranchOfficeServices($l);

            if ($this->branchOfficeServicessScheduledForDeletion and $this->branchOfficeServicessScheduledForDeletion->contains($l)) {
                $this->branchOfficeServicessScheduledForDeletion->remove($this->branchOfficeServicessScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildBranchOfficeServices $branchOfficeServices The ChildBranchOfficeServices object to add.
     */
    protected function doAddBranchOfficeServices(ChildBranchOfficeServices $branchOfficeServices)
    {
        $this->collBranchOfficeServicess[]= $branchOfficeServices;
        $branchOfficeServices->setBranchOffices($this);
    }

    /**
     * @param  ChildBranchOfficeServices $branchOfficeServices The ChildBranchOfficeServices object to remove.
     * @return $this|ChildBranchOffices The current object (for fluent API support)
     */
    public function removeBranchOfficeServices(ChildBranchOfficeServices $branchOfficeServices)
    {
        if ($this->getBranchOfficeServicess()->contains($branchOfficeServices)) {
            $pos = $this->collBranchOfficeServicess->search($branchOfficeServices);
            $this->collBranchOfficeServicess->remove($pos);
            if (null === $this->branchOfficeServicessScheduledForDeletion) {
                $this->branchOfficeServicessScheduledForDeletion = clone $this->collBranchOfficeServicess;
                $this->branchOfficeServicessScheduledForDeletion->clear();
            }
            $this->branchOfficeServicessScheduledForDeletion[]= clone $branchOfficeServices;
            $branchOfficeServices->setBranchOffices(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BranchOffices is new, it will return
     * an empty collection; or if this BranchOffices has previously
     * been saved, it will retrieve related BranchOfficeServicess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BranchOffices.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildBranchOfficeServices[] List of ChildBranchOfficeServices objects
     * @phpstan-return ObjectCollection&\Traversable<ChildBranchOfficeServices}> List of ChildBranchOfficeServices objects
     */
    public function getBranchOfficeServicessJoinServices(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildBranchOfficeServicesQuery::create(null, $criteria);
        $query->joinWith('Services', $joinBehavior);

        return $this->getBranchOfficeServicess($query, $con);
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
     * If this ChildBranchOffices is new, it will return
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
                    ->filterByBranchOffices($this)
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
     * @return $this|ChildBranchOffices The current object (for fluent API support)
     */
    public function setExpenseReportss(Collection $expenseReportss, ConnectionInterface $con = null)
    {
        /** @var ChildExpenseReports[] $expenseReportssToDelete */
        $expenseReportssToDelete = $this->getExpenseReportss(new Criteria(), $con)->diff($expenseReportss);


        $this->expenseReportssScheduledForDeletion = $expenseReportssToDelete;

        foreach ($expenseReportssToDelete as $expenseReportsRemoved) {
            $expenseReportsRemoved->setBranchOffices(null);
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
                ->filterByBranchOffices($this)
                ->count($con);
        }

        return count($this->collExpenseReportss);
    }

    /**
     * Method called to associate a ChildExpenseReports object to this object
     * through the ChildExpenseReports foreign key attribute.
     *
     * @param  ChildExpenseReports $l ChildExpenseReports
     * @return $this|\BranchOffices The current object (for fluent API support)
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
        $expenseReports->setBranchOffices($this);
    }

    /**
     * @param  ChildExpenseReports $expenseReports The ChildExpenseReports object to remove.
     * @return $this|ChildBranchOffices The current object (for fluent API support)
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
            $expenseReports->setBranchOffices(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BranchOffices is new, it will return
     * an empty collection; or if this BranchOffices has previously
     * been saved, it will retrieve related ExpenseReportss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BranchOffices.
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
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BranchOffices is new, it will return
     * an empty collection; or if this BranchOffices has previously
     * been saved, it will retrieve related ExpenseReportss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BranchOffices.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildExpenseReports[] List of ChildExpenseReports objects
     * @phpstan-return ObjectCollection&\Traversable<ChildExpenseReports}> List of ChildExpenseReports objects
     */
    public function getExpenseReportssJoinUsers(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildExpenseReportsQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getExpenseReportss($query, $con);
    }

    /**
     * Clears out the collOrderss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addOrderss()
     */
    public function clearOrderss()
    {
        $this->collOrderss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collOrderss collection loaded partially.
     */
    public function resetPartialOrderss($v = true)
    {
        $this->collOrderssPartial = $v;
    }

    /**
     * Initializes the collOrderss collection.
     *
     * By default this just sets the collOrderss collection to an empty array (like clearcollOrderss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initOrderss($overrideExisting = true)
    {
        if (null !== $this->collOrderss && !$overrideExisting) {
            return;
        }

        $collectionClassName = OrdersTableMap::getTableMap()->getCollectionClassName();

        $this->collOrderss = new $collectionClassName;
        $this->collOrderss->setModel('\Orders');
    }

    /**
     * Gets an array of ChildOrders objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBranchOffices is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders> List of ChildOrders objects
     * @throws PropelException
     */
    public function getOrderss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collOrderssPartial && !$this->isNew();
        if (null === $this->collOrderss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collOrderss) {
                    $this->initOrderss();
                } else {
                    $collectionClassName = OrdersTableMap::getTableMap()->getCollectionClassName();

                    $collOrderss = new $collectionClassName;
                    $collOrderss->setModel('\Orders');

                    return $collOrderss;
                }
            } else {
                $collOrderss = ChildOrdersQuery::create(null, $criteria)
                    ->filterByBranchOffices($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collOrderssPartial && count($collOrderss)) {
                        $this->initOrderss(false);

                        foreach ($collOrderss as $obj) {
                            if (false == $this->collOrderss->contains($obj)) {
                                $this->collOrderss->append($obj);
                            }
                        }

                        $this->collOrderssPartial = true;
                    }

                    return $collOrderss;
                }

                if ($partial && $this->collOrderss) {
                    foreach ($this->collOrderss as $obj) {
                        if ($obj->isNew()) {
                            $collOrderss[] = $obj;
                        }
                    }
                }

                $this->collOrderss = $collOrderss;
                $this->collOrderssPartial = false;
            }
        }

        return $this->collOrderss;
    }

    /**
     * Sets a collection of ChildOrders objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $orderss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildBranchOffices The current object (for fluent API support)
     */
    public function setOrderss(Collection $orderss, ConnectionInterface $con = null)
    {
        /** @var ChildOrders[] $orderssToDelete */
        $orderssToDelete = $this->getOrderss(new Criteria(), $con)->diff($orderss);


        $this->orderssScheduledForDeletion = $orderssToDelete;

        foreach ($orderssToDelete as $ordersRemoved) {
            $ordersRemoved->setBranchOffices(null);
        }

        $this->collOrderss = null;
        foreach ($orderss as $orders) {
            $this->addOrders($orders);
        }

        $this->collOrderss = $orderss;
        $this->collOrderssPartial = false;

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
    public function countOrderss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collOrderssPartial && !$this->isNew();
        if (null === $this->collOrderss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collOrderss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getOrderss());
            }

            $query = ChildOrdersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBranchOffices($this)
                ->count($con);
        }

        return count($this->collOrderss);
    }

    /**
     * Method called to associate a ChildOrders object to this object
     * through the ChildOrders foreign key attribute.
     *
     * @param  ChildOrders $l ChildOrders
     * @return $this|\BranchOffices The current object (for fluent API support)
     */
    public function addOrders(ChildOrders $l)
    {
        if ($this->collOrderss === null) {
            $this->initOrderss();
            $this->collOrderssPartial = true;
        }

        if (!$this->collOrderss->contains($l)) {
            $this->doAddOrders($l);

            if ($this->orderssScheduledForDeletion and $this->orderssScheduledForDeletion->contains($l)) {
                $this->orderssScheduledForDeletion->remove($this->orderssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildOrders $orders The ChildOrders object to add.
     */
    protected function doAddOrders(ChildOrders $orders)
    {
        $this->collOrderss[]= $orders;
        $orders->setBranchOffices($this);
    }

    /**
     * @param  ChildOrders $orders The ChildOrders object to remove.
     * @return $this|ChildBranchOffices The current object (for fluent API support)
     */
    public function removeOrders(ChildOrders $orders)
    {
        if ($this->getOrderss()->contains($orders)) {
            $pos = $this->collOrderss->search($orders);
            $this->collOrderss->remove($pos);
            if (null === $this->orderssScheduledForDeletion) {
                $this->orderssScheduledForDeletion = clone $this->collOrderss;
                $this->orderssScheduledForDeletion->clear();
            }
            $this->orderssScheduledForDeletion[]= clone $orders;
            $orders->setBranchOffices(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BranchOffices is new, it will return
     * an empty collection; or if this BranchOffices has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BranchOffices.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinUsersRelatedByIdClientUser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('UsersRelatedByIdClientUser', $joinBehavior);

        return $this->getOrderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BranchOffices is new, it will return
     * an empty collection; or if this BranchOffices has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BranchOffices.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinUsersRelatedByIdDeliveryUser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('UsersRelatedByIdDeliveryUser', $joinBehavior);

        return $this->getOrderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BranchOffices is new, it will return
     * an empty collection; or if this BranchOffices has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BranchOffices.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinOrderStatus(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('OrderStatus', $joinBehavior);

        return $this->getOrderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BranchOffices is new, it will return
     * an empty collection; or if this BranchOffices has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BranchOffices.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinPaymentMethods(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('PaymentMethods', $joinBehavior);

        return $this->getOrderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BranchOffices is new, it will return
     * an empty collection; or if this BranchOffices has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BranchOffices.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinPriorities(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('Priorities', $joinBehavior);

        return $this->getOrderss($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BranchOffices is new, it will return
     * an empty collection; or if this BranchOffices has previously
     * been saved, it will retrieve related Orderss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BranchOffices.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildOrders[] List of ChildOrders objects
     * @phpstan-return ObjectCollection&\Traversable<ChildOrders}> List of ChildOrders objects
     */
    public function getOrderssJoinUsersRelatedByIdUser(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildOrdersQuery::create(null, $criteria);
        $query->joinWith('UsersRelatedByIdUser', $joinBehavior);

        return $this->getOrderss($query, $con);
    }

    /**
     * Clears out the collUserss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addUserss()
     */
    public function clearUserss()
    {
        $this->collUserss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collUserss collection loaded partially.
     */
    public function resetPartialUserss($v = true)
    {
        $this->collUserssPartial = $v;
    }

    /**
     * Initializes the collUserss collection.
     *
     * By default this just sets the collUserss collection to an empty array (like clearcollUserss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUserss($overrideExisting = true)
    {
        if (null !== $this->collUserss && !$overrideExisting) {
            return;
        }

        $collectionClassName = UsersTableMap::getTableMap()->getCollectionClassName();

        $this->collUserss = new $collectionClassName;
        $this->collUserss->setModel('\Users');
    }

    /**
     * Gets an array of ChildUsers objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildBranchOffices is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildUsers[] List of ChildUsers objects
     * @phpstan-return ObjectCollection&\Traversable<ChildUsers> List of ChildUsers objects
     * @throws PropelException
     */
    public function getUserss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collUserssPartial && !$this->isNew();
        if (null === $this->collUserss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collUserss) {
                    $this->initUserss();
                } else {
                    $collectionClassName = UsersTableMap::getTableMap()->getCollectionClassName();

                    $collUserss = new $collectionClassName;
                    $collUserss->setModel('\Users');

                    return $collUserss;
                }
            } else {
                $collUserss = ChildUsersQuery::create(null, $criteria)
                    ->filterByBranchOffices($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collUserssPartial && count($collUserss)) {
                        $this->initUserss(false);

                        foreach ($collUserss as $obj) {
                            if (false == $this->collUserss->contains($obj)) {
                                $this->collUserss->append($obj);
                            }
                        }

                        $this->collUserssPartial = true;
                    }

                    return $collUserss;
                }

                if ($partial && $this->collUserss) {
                    foreach ($this->collUserss as $obj) {
                        if ($obj->isNew()) {
                            $collUserss[] = $obj;
                        }
                    }
                }

                $this->collUserss = $collUserss;
                $this->collUserssPartial = false;
            }
        }

        return $this->collUserss;
    }

    /**
     * Sets a collection of ChildUsers objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $userss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildBranchOffices The current object (for fluent API support)
     */
    public function setUserss(Collection $userss, ConnectionInterface $con = null)
    {
        /** @var ChildUsers[] $userssToDelete */
        $userssToDelete = $this->getUserss(new Criteria(), $con)->diff($userss);


        $this->userssScheduledForDeletion = $userssToDelete;

        foreach ($userssToDelete as $usersRemoved) {
            $usersRemoved->setBranchOffices(null);
        }

        $this->collUserss = null;
        foreach ($userss as $users) {
            $this->addUsers($users);
        }

        $this->collUserss = $userss;
        $this->collUserssPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Users objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Users objects.
     * @throws PropelException
     */
    public function countUserss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collUserssPartial && !$this->isNew();
        if (null === $this->collUserss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUserss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUserss());
            }

            $query = ChildUsersQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBranchOffices($this)
                ->count($con);
        }

        return count($this->collUserss);
    }

    /**
     * Method called to associate a ChildUsers object to this object
     * through the ChildUsers foreign key attribute.
     *
     * @param  ChildUsers $l ChildUsers
     * @return $this|\BranchOffices The current object (for fluent API support)
     */
    public function addUsers(ChildUsers $l)
    {
        if ($this->collUserss === null) {
            $this->initUserss();
            $this->collUserssPartial = true;
        }

        if (!$this->collUserss->contains($l)) {
            $this->doAddUsers($l);

            if ($this->userssScheduledForDeletion and $this->userssScheduledForDeletion->contains($l)) {
                $this->userssScheduledForDeletion->remove($this->userssScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildUsers $users The ChildUsers object to add.
     */
    protected function doAddUsers(ChildUsers $users)
    {
        $this->collUserss[]= $users;
        $users->setBranchOffices($this);
    }

    /**
     * @param  ChildUsers $users The ChildUsers object to remove.
     * @return $this|ChildBranchOffices The current object (for fluent API support)
     */
    public function removeUsers(ChildUsers $users)
    {
        if ($this->getUserss()->contains($users)) {
            $pos = $this->collUserss->search($users);
            $this->collUserss->remove($pos);
            if (null === $this->userssScheduledForDeletion) {
                $this->userssScheduledForDeletion = clone $this->collUserss;
                $this->userssScheduledForDeletion->clear();
            }
            $this->userssScheduledForDeletion[]= $users;
            $users->setBranchOffices(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this BranchOffices is new, it will return
     * an empty collection; or if this BranchOffices has previously
     * been saved, it will retrieve related Userss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in BranchOffices.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildUsers[] List of ChildUsers objects
     * @phpstan-return ObjectCollection&\Traversable<ChildUsers}> List of ChildUsers objects
     */
    public function getUserssJoinUserTypes(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildUsersQuery::create(null, $criteria);
        $query->joinWith('UserTypes', $joinBehavior);

        return $this->getUserss($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->name = null;
        $this->address = null;
        $this->phone = null;
        $this->series = null;
        $this->current_sheet = null;
        $this->rfc = null;
        $this->email = null;
        $this->legend = null;
        $this->postal_code = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
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
            if ($this->collBranchOfficeServicess) {
                foreach ($this->collBranchOfficeServicess as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collExpenseReportss) {
                foreach ($this->collExpenseReportss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collOrderss) {
                foreach ($this->collOrderss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUserss) {
                foreach ($this->collUserss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collBranchOfficeServicess = null;
        $this->collExpenseReportss = null;
        $this->collOrderss = null;
        $this->collUserss = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(BranchOfficesTableMap::DEFAULT_STRING_FORMAT);
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
