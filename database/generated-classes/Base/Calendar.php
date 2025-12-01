<?php

namespace Base;

use \Calendar as ChildCalendar;
use \CalendarQuery as ChildCalendarQuery;
use \Deliveries as ChildDeliveries;
use \DeliveriesQuery as ChildDeliveriesQuery;
use \Pickups as ChildPickups;
use \PickupsQuery as ChildPickupsQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\CalendarTableMap;
use Map\DeliveriesTableMap;
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
 * Base class that represents a row from the 'calendar' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Calendar implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\CalendarTableMap';


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
     * The value for the day field.
     *
     * @var        DateTime
     */
    protected $day;

    /**
     * The value for the name field.
     *
     * @var        string
     */
    protected $name;

    /**
     * The value for the year field.
     *
     * @var        int
     */
    protected $year;

    /**
     * The value for the month field.
     *
     * @var        string
     */
    protected $month;

    /**
     * The value for the month_number field.
     *
     * @var        int
     */
    protected $month_number;

    /**
     * The value for the day_of_the_year field.
     *
     * @var        int
     */
    protected $day_of_the_year;

    /**
     * The value for the weekday field.
     *
     * @var        int
     */
    protected $weekday;

    /**
     * The value for the day_of_the_month field.
     *
     * @var        int
     */
    protected $day_of_the_month;

    /**
     * The value for the name_day field.
     *
     * @var        string
     */
    protected $name_day;

    /**
     * The value for the short_name field.
     *
     * @var        string
     */
    protected $short_name;

    /**
     * The value for the week field.
     *
     * @var        int
     */
    protected $week;

    /**
     * The value for the bimester field.
     *
     * @var        int
     */
    protected $bimester;

    /**
     * The value for the trimester field.
     *
     * @var        int
     */
    protected $trimester;

    /**
     * The value for the semestre field.
     *
     * @var        int
     */
    protected $semestre;

    /**
     * @var        ObjectCollection|ChildDeliveries[] Collection to store aggregation of ChildDeliveries objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildDeliveries> Collection to store aggregation of ChildDeliveries objects.
     */
    protected $collDeliveriess;
    protected $collDeliveriessPartial;

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
     * @var ObjectCollection|ChildPickups[]
     * @phpstan-var ObjectCollection&\Traversable<ChildPickups>
     */
    protected $pickupssScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Calendar object.
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
     * Compares this with another <code>Calendar</code> instance.  If
     * <code>obj</code> is an instance of <code>Calendar</code>, delegates to
     * <code>equals(Calendar)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [optionally formatted] temporal [day] column value.
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
    public function getDay($format = 'Y-m-d')
    {
        if ($format === null) {
            return $this->day;
        } else {
            return $this->day instanceof \DateTimeInterface ? $this->day->format($format) : null;
        }
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
     * Get the [year] column value.
     *
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Get the [month] column value.
     *
     * @return string
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Get the [month_number] column value.
     *
     * @return int
     */
    public function getMonthNumber()
    {
        return $this->month_number;
    }

    /**
     * Get the [day_of_the_year] column value.
     *
     * @return int
     */
    public function getDayOfTheYear()
    {
        return $this->day_of_the_year;
    }

    /**
     * Get the [weekday] column value.
     *
     * @return int
     */
    public function getWeekday()
    {
        return $this->weekday;
    }

    /**
     * Get the [day_of_the_month] column value.
     *
     * @return int
     */
    public function getDayOfTheMonth()
    {
        return $this->day_of_the_month;
    }

    /**
     * Get the [name_day] column value.
     *
     * @return string
     */
    public function getNameDay()
    {
        return $this->name_day;
    }

    /**
     * Get the [short_name] column value.
     *
     * @return string
     */
    public function getShortName()
    {
        return $this->short_name;
    }

    /**
     * Get the [week] column value.
     *
     * @return int
     */
    public function getWeek()
    {
        return $this->week;
    }

    /**
     * Get the [bimester] column value.
     *
     * @return int
     */
    public function getBimester()
    {
        return $this->bimester;
    }

    /**
     * Get the [trimester] column value.
     *
     * @return int
     */
    public function getTrimester()
    {
        return $this->trimester;
    }

    /**
     * Get the [semestre] column value.
     *
     * @return int
     */
    public function getSemestre()
    {
        return $this->semestre;
    }

    /**
     * Sets the value of [day] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\Calendar The current object (for fluent API support)
     */
    public function setDay($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->day !== null || $dt !== null) {
            if ($this->day === null || $dt === null || $dt->format("Y-m-d") !== $this->day->format("Y-m-d")) {
                $this->day = $dt === null ? null : clone $dt;
                $this->modifiedColumns[CalendarTableMap::COL_DAY] = true;
            }
        } // if either are not null

        return $this;
    } // setDay()

    /**
     * Set the value of [name] column.
     *
     * @param string $v New value
     * @return $this|\Calendar The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[CalendarTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [year] column.
     *
     * @param int $v New value
     * @return $this|\Calendar The current object (for fluent API support)
     */
    public function setYear($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->year !== $v) {
            $this->year = $v;
            $this->modifiedColumns[CalendarTableMap::COL_YEAR] = true;
        }

        return $this;
    } // setYear()

    /**
     * Set the value of [month] column.
     *
     * @param string $v New value
     * @return $this|\Calendar The current object (for fluent API support)
     */
    public function setMonth($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->month !== $v) {
            $this->month = $v;
            $this->modifiedColumns[CalendarTableMap::COL_MONTH] = true;
        }

        return $this;
    } // setMonth()

    /**
     * Set the value of [month_number] column.
     *
     * @param int $v New value
     * @return $this|\Calendar The current object (for fluent API support)
     */
    public function setMonthNumber($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->month_number !== $v) {
            $this->month_number = $v;
            $this->modifiedColumns[CalendarTableMap::COL_MONTH_NUMBER] = true;
        }

        return $this;
    } // setMonthNumber()

    /**
     * Set the value of [day_of_the_year] column.
     *
     * @param int $v New value
     * @return $this|\Calendar The current object (for fluent API support)
     */
    public function setDayOfTheYear($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->day_of_the_year !== $v) {
            $this->day_of_the_year = $v;
            $this->modifiedColumns[CalendarTableMap::COL_DAY_OF_THE_YEAR] = true;
        }

        return $this;
    } // setDayOfTheYear()

    /**
     * Set the value of [weekday] column.
     *
     * @param int $v New value
     * @return $this|\Calendar The current object (for fluent API support)
     */
    public function setWeekday($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->weekday !== $v) {
            $this->weekday = $v;
            $this->modifiedColumns[CalendarTableMap::COL_WEEKDAY] = true;
        }

        return $this;
    } // setWeekday()

    /**
     * Set the value of [day_of_the_month] column.
     *
     * @param int $v New value
     * @return $this|\Calendar The current object (for fluent API support)
     */
    public function setDayOfTheMonth($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->day_of_the_month !== $v) {
            $this->day_of_the_month = $v;
            $this->modifiedColumns[CalendarTableMap::COL_DAY_OF_THE_MONTH] = true;
        }

        return $this;
    } // setDayOfTheMonth()

    /**
     * Set the value of [name_day] column.
     *
     * @param string $v New value
     * @return $this|\Calendar The current object (for fluent API support)
     */
    public function setNameDay($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name_day !== $v) {
            $this->name_day = $v;
            $this->modifiedColumns[CalendarTableMap::COL_NAME_DAY] = true;
        }

        return $this;
    } // setNameDay()

    /**
     * Set the value of [short_name] column.
     *
     * @param string $v New value
     * @return $this|\Calendar The current object (for fluent API support)
     */
    public function setShortName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->short_name !== $v) {
            $this->short_name = $v;
            $this->modifiedColumns[CalendarTableMap::COL_SHORT_NAME] = true;
        }

        return $this;
    } // setShortName()

    /**
     * Set the value of [week] column.
     *
     * @param int $v New value
     * @return $this|\Calendar The current object (for fluent API support)
     */
    public function setWeek($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->week !== $v) {
            $this->week = $v;
            $this->modifiedColumns[CalendarTableMap::COL_WEEK] = true;
        }

        return $this;
    } // setWeek()

    /**
     * Set the value of [bimester] column.
     *
     * @param int $v New value
     * @return $this|\Calendar The current object (for fluent API support)
     */
    public function setBimester($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->bimester !== $v) {
            $this->bimester = $v;
            $this->modifiedColumns[CalendarTableMap::COL_BIMESTER] = true;
        }

        return $this;
    } // setBimester()

    /**
     * Set the value of [trimester] column.
     *
     * @param int $v New value
     * @return $this|\Calendar The current object (for fluent API support)
     */
    public function setTrimester($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->trimester !== $v) {
            $this->trimester = $v;
            $this->modifiedColumns[CalendarTableMap::COL_TRIMESTER] = true;
        }

        return $this;
    } // setTrimester()

    /**
     * Set the value of [semestre] column.
     *
     * @param int $v New value
     * @return $this|\Calendar The current object (for fluent API support)
     */
    public function setSemestre($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->semestre !== $v) {
            $this->semestre = $v;
            $this->modifiedColumns[CalendarTableMap::COL_SEMESTRE] = true;
        }

        return $this;
    } // setSemestre()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : CalendarTableMap::translateFieldName('Day', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->day = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : CalendarTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : CalendarTableMap::translateFieldName('Year', TableMap::TYPE_PHPNAME, $indexType)];
            $this->year = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : CalendarTableMap::translateFieldName('Month', TableMap::TYPE_PHPNAME, $indexType)];
            $this->month = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : CalendarTableMap::translateFieldName('MonthNumber', TableMap::TYPE_PHPNAME, $indexType)];
            $this->month_number = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : CalendarTableMap::translateFieldName('DayOfTheYear', TableMap::TYPE_PHPNAME, $indexType)];
            $this->day_of_the_year = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : CalendarTableMap::translateFieldName('Weekday', TableMap::TYPE_PHPNAME, $indexType)];
            $this->weekday = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : CalendarTableMap::translateFieldName('DayOfTheMonth', TableMap::TYPE_PHPNAME, $indexType)];
            $this->day_of_the_month = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : CalendarTableMap::translateFieldName('NameDay', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name_day = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : CalendarTableMap::translateFieldName('ShortName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->short_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : CalendarTableMap::translateFieldName('Week', TableMap::TYPE_PHPNAME, $indexType)];
            $this->week = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : CalendarTableMap::translateFieldName('Bimester', TableMap::TYPE_PHPNAME, $indexType)];
            $this->bimester = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : CalendarTableMap::translateFieldName('Trimester', TableMap::TYPE_PHPNAME, $indexType)];
            $this->trimester = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : CalendarTableMap::translateFieldName('Semestre', TableMap::TYPE_PHPNAME, $indexType)];
            $this->semestre = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 14; // 14 = CalendarTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Calendar'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(CalendarTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildCalendarQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collDeliveriess = null;

            $this->collPickupss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Calendar::setDeleted()
     * @see Calendar::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(CalendarTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildCalendarQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(CalendarTableMap::DATABASE_NAME);
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
                CalendarTableMap::addInstanceToPool($this);
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


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(CalendarTableMap::COL_DAY)) {
            $modifiedColumns[':p' . $index++]  = 'day';
        }
        if ($this->isColumnModified(CalendarTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(CalendarTableMap::COL_YEAR)) {
            $modifiedColumns[':p' . $index++]  = 'year';
        }
        if ($this->isColumnModified(CalendarTableMap::COL_MONTH)) {
            $modifiedColumns[':p' . $index++]  = 'month';
        }
        if ($this->isColumnModified(CalendarTableMap::COL_MONTH_NUMBER)) {
            $modifiedColumns[':p' . $index++]  = 'month_number';
        }
        if ($this->isColumnModified(CalendarTableMap::COL_DAY_OF_THE_YEAR)) {
            $modifiedColumns[':p' . $index++]  = 'day_of_the_year';
        }
        if ($this->isColumnModified(CalendarTableMap::COL_WEEKDAY)) {
            $modifiedColumns[':p' . $index++]  = 'weekday';
        }
        if ($this->isColumnModified(CalendarTableMap::COL_DAY_OF_THE_MONTH)) {
            $modifiedColumns[':p' . $index++]  = 'day_of_the_month';
        }
        if ($this->isColumnModified(CalendarTableMap::COL_NAME_DAY)) {
            $modifiedColumns[':p' . $index++]  = 'name_day';
        }
        if ($this->isColumnModified(CalendarTableMap::COL_SHORT_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'short_name';
        }
        if ($this->isColumnModified(CalendarTableMap::COL_WEEK)) {
            $modifiedColumns[':p' . $index++]  = 'week';
        }
        if ($this->isColumnModified(CalendarTableMap::COL_BIMESTER)) {
            $modifiedColumns[':p' . $index++]  = 'bimester';
        }
        if ($this->isColumnModified(CalendarTableMap::COL_TRIMESTER)) {
            $modifiedColumns[':p' . $index++]  = 'trimester';
        }
        if ($this->isColumnModified(CalendarTableMap::COL_SEMESTRE)) {
            $modifiedColumns[':p' . $index++]  = 'semestre';
        }

        $sql = sprintf(
            'INSERT INTO calendar (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'day':
                        $stmt->bindValue($identifier, $this->day ? $this->day->format("Y-m-d") : null, PDO::PARAM_STR);
                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'year':
                        $stmt->bindValue($identifier, $this->year, PDO::PARAM_INT);
                        break;
                    case 'month':
                        $stmt->bindValue($identifier, $this->month, PDO::PARAM_STR);
                        break;
                    case 'month_number':
                        $stmt->bindValue($identifier, $this->month_number, PDO::PARAM_INT);
                        break;
                    case 'day_of_the_year':
                        $stmt->bindValue($identifier, $this->day_of_the_year, PDO::PARAM_INT);
                        break;
                    case 'weekday':
                        $stmt->bindValue($identifier, $this->weekday, PDO::PARAM_INT);
                        break;
                    case 'day_of_the_month':
                        $stmt->bindValue($identifier, $this->day_of_the_month, PDO::PARAM_INT);
                        break;
                    case 'name_day':
                        $stmt->bindValue($identifier, $this->name_day, PDO::PARAM_STR);
                        break;
                    case 'short_name':
                        $stmt->bindValue($identifier, $this->short_name, PDO::PARAM_STR);
                        break;
                    case 'week':
                        $stmt->bindValue($identifier, $this->week, PDO::PARAM_INT);
                        break;
                    case 'bimester':
                        $stmt->bindValue($identifier, $this->bimester, PDO::PARAM_INT);
                        break;
                    case 'trimester':
                        $stmt->bindValue($identifier, $this->trimester, PDO::PARAM_INT);
                        break;
                    case 'semestre':
                        $stmt->bindValue($identifier, $this->semestre, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

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
        $pos = CalendarTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getDay();
                break;
            case 1:
                return $this->getName();
                break;
            case 2:
                return $this->getYear();
                break;
            case 3:
                return $this->getMonth();
                break;
            case 4:
                return $this->getMonthNumber();
                break;
            case 5:
                return $this->getDayOfTheYear();
                break;
            case 6:
                return $this->getWeekday();
                break;
            case 7:
                return $this->getDayOfTheMonth();
                break;
            case 8:
                return $this->getNameDay();
                break;
            case 9:
                return $this->getShortName();
                break;
            case 10:
                return $this->getWeek();
                break;
            case 11:
                return $this->getBimester();
                break;
            case 12:
                return $this->getTrimester();
                break;
            case 13:
                return $this->getSemestre();
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

        if (isset($alreadyDumpedObjects['Calendar'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Calendar'][$this->hashCode()] = true;
        $keys = CalendarTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getDay(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getYear(),
            $keys[3] => $this->getMonth(),
            $keys[4] => $this->getMonthNumber(),
            $keys[5] => $this->getDayOfTheYear(),
            $keys[6] => $this->getWeekday(),
            $keys[7] => $this->getDayOfTheMonth(),
            $keys[8] => $this->getNameDay(),
            $keys[9] => $this->getShortName(),
            $keys[10] => $this->getWeek(),
            $keys[11] => $this->getBimester(),
            $keys[12] => $this->getTrimester(),
            $keys[13] => $this->getSemestre(),
        );
        if ($result[$keys[0]] instanceof \DateTimeInterface) {
            $result[$keys[0]] = $result[$keys[0]]->format('Y-m-d');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
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
     * @return $this|\Calendar
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = CalendarTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Calendar
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setDay($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setYear($value);
                break;
            case 3:
                $this->setMonth($value);
                break;
            case 4:
                $this->setMonthNumber($value);
                break;
            case 5:
                $this->setDayOfTheYear($value);
                break;
            case 6:
                $this->setWeekday($value);
                break;
            case 7:
                $this->setDayOfTheMonth($value);
                break;
            case 8:
                $this->setNameDay($value);
                break;
            case 9:
                $this->setShortName($value);
                break;
            case 10:
                $this->setWeek($value);
                break;
            case 11:
                $this->setBimester($value);
                break;
            case 12:
                $this->setTrimester($value);
                break;
            case 13:
                $this->setSemestre($value);
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
     * @return     $this|\Calendar
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = CalendarTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setDay($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setYear($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setMonth($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setMonthNumber($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setDayOfTheYear($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setWeekday($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setDayOfTheMonth($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setNameDay($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setShortName($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setWeek($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setBimester($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setTrimester($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setSemestre($arr[$keys[13]]);
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
     * @return $this|\Calendar The current object, for fluid interface
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
        $criteria = new Criteria(CalendarTableMap::DATABASE_NAME);

        if ($this->isColumnModified(CalendarTableMap::COL_DAY)) {
            $criteria->add(CalendarTableMap::COL_DAY, $this->day);
        }
        if ($this->isColumnModified(CalendarTableMap::COL_NAME)) {
            $criteria->add(CalendarTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(CalendarTableMap::COL_YEAR)) {
            $criteria->add(CalendarTableMap::COL_YEAR, $this->year);
        }
        if ($this->isColumnModified(CalendarTableMap::COL_MONTH)) {
            $criteria->add(CalendarTableMap::COL_MONTH, $this->month);
        }
        if ($this->isColumnModified(CalendarTableMap::COL_MONTH_NUMBER)) {
            $criteria->add(CalendarTableMap::COL_MONTH_NUMBER, $this->month_number);
        }
        if ($this->isColumnModified(CalendarTableMap::COL_DAY_OF_THE_YEAR)) {
            $criteria->add(CalendarTableMap::COL_DAY_OF_THE_YEAR, $this->day_of_the_year);
        }
        if ($this->isColumnModified(CalendarTableMap::COL_WEEKDAY)) {
            $criteria->add(CalendarTableMap::COL_WEEKDAY, $this->weekday);
        }
        if ($this->isColumnModified(CalendarTableMap::COL_DAY_OF_THE_MONTH)) {
            $criteria->add(CalendarTableMap::COL_DAY_OF_THE_MONTH, $this->day_of_the_month);
        }
        if ($this->isColumnModified(CalendarTableMap::COL_NAME_DAY)) {
            $criteria->add(CalendarTableMap::COL_NAME_DAY, $this->name_day);
        }
        if ($this->isColumnModified(CalendarTableMap::COL_SHORT_NAME)) {
            $criteria->add(CalendarTableMap::COL_SHORT_NAME, $this->short_name);
        }
        if ($this->isColumnModified(CalendarTableMap::COL_WEEK)) {
            $criteria->add(CalendarTableMap::COL_WEEK, $this->week);
        }
        if ($this->isColumnModified(CalendarTableMap::COL_BIMESTER)) {
            $criteria->add(CalendarTableMap::COL_BIMESTER, $this->bimester);
        }
        if ($this->isColumnModified(CalendarTableMap::COL_TRIMESTER)) {
            $criteria->add(CalendarTableMap::COL_TRIMESTER, $this->trimester);
        }
        if ($this->isColumnModified(CalendarTableMap::COL_SEMESTRE)) {
            $criteria->add(CalendarTableMap::COL_SEMESTRE, $this->semestre);
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
        $criteria = ChildCalendarQuery::create();
        $criteria->add(CalendarTableMap::COL_DAY, $this->day);

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
        $validPk = null !== $this->getDay();

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
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getDay();
    }

    /**
     * Generic method to set the primary key (day column).
     *
     * @param       string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setDay($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getDay();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Calendar (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setDay($this->getDay());
        $copyObj->setName($this->getName());
        $copyObj->setYear($this->getYear());
        $copyObj->setMonth($this->getMonth());
        $copyObj->setMonthNumber($this->getMonthNumber());
        $copyObj->setDayOfTheYear($this->getDayOfTheYear());
        $copyObj->setWeekday($this->getWeekday());
        $copyObj->setDayOfTheMonth($this->getDayOfTheMonth());
        $copyObj->setNameDay($this->getNameDay());
        $copyObj->setShortName($this->getShortName());
        $copyObj->setWeek($this->getWeek());
        $copyObj->setBimester($this->getBimester());
        $copyObj->setTrimester($this->getTrimester());
        $copyObj->setSemestre($this->getSemestre());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getDeliveriess() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addDeliveries($relObj->copy($deepCopy));
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
     * @return \Calendar Clone of current object.
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
        if ('Deliveries' === $relationName) {
            $this->initDeliveriess();
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
     * If this ChildCalendar is new, it will return
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
                    ->filterByCalendar($this)
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
     * @return $this|ChildCalendar The current object (for fluent API support)
     */
    public function setDeliveriess(Collection $deliveriess, ConnectionInterface $con = null)
    {
        /** @var ChildDeliveries[] $deliveriessToDelete */
        $deliveriessToDelete = $this->getDeliveriess(new Criteria(), $con)->diff($deliveriess);


        $this->deliveriessScheduledForDeletion = $deliveriessToDelete;

        foreach ($deliveriessToDelete as $deliveriesRemoved) {
            $deliveriesRemoved->setCalendar(null);
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
                ->filterByCalendar($this)
                ->count($con);
        }

        return count($this->collDeliveriess);
    }

    /**
     * Method called to associate a ChildDeliveries object to this object
     * through the ChildDeliveries foreign key attribute.
     *
     * @param  ChildDeliveries $l ChildDeliveries
     * @return $this|\Calendar The current object (for fluent API support)
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
        $deliveries->setCalendar($this);
    }

    /**
     * @param  ChildDeliveries $deliveries The ChildDeliveries object to remove.
     * @return $this|ChildCalendar The current object (for fluent API support)
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
            $deliveries->setCalendar(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Calendar is new, it will return
     * an empty collection; or if this Calendar has previously
     * been saved, it will retrieve related Deliveriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Calendar.
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
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Calendar is new, it will return
     * an empty collection; or if this Calendar has previously
     * been saved, it will retrieve related Deliveriess from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Calendar.
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
     * If this ChildCalendar is new, it will return
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
                    ->filterByCalendar($this)
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
     * @return $this|ChildCalendar The current object (for fluent API support)
     */
    public function setPickupss(Collection $pickupss, ConnectionInterface $con = null)
    {
        /** @var ChildPickups[] $pickupssToDelete */
        $pickupssToDelete = $this->getPickupss(new Criteria(), $con)->diff($pickupss);


        $this->pickupssScheduledForDeletion = $pickupssToDelete;

        foreach ($pickupssToDelete as $pickupsRemoved) {
            $pickupsRemoved->setCalendar(null);
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
                ->filterByCalendar($this)
                ->count($con);
        }

        return count($this->collPickupss);
    }

    /**
     * Method called to associate a ChildPickups object to this object
     * through the ChildPickups foreign key attribute.
     *
     * @param  ChildPickups $l ChildPickups
     * @return $this|\Calendar The current object (for fluent API support)
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
        $pickups->setCalendar($this);
    }

    /**
     * @param  ChildPickups $pickups The ChildPickups object to remove.
     * @return $this|ChildCalendar The current object (for fluent API support)
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
            $pickups->setCalendar(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Calendar is new, it will return
     * an empty collection; or if this Calendar has previously
     * been saved, it will retrieve related Pickupss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Calendar.
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
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Calendar is new, it will return
     * an empty collection; or if this Calendar has previously
     * been saved, it will retrieve related Pickupss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Calendar.
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
        $this->day = null;
        $this->name = null;
        $this->year = null;
        $this->month = null;
        $this->month_number = null;
        $this->day_of_the_year = null;
        $this->weekday = null;
        $this->day_of_the_month = null;
        $this->name_day = null;
        $this->short_name = null;
        $this->week = null;
        $this->bimester = null;
        $this->trimester = null;
        $this->semestre = null;
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
            if ($this->collDeliveriess) {
                foreach ($this->collDeliveriess as $o) {
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
        $this->collPickupss = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(CalendarTableMap::DEFAULT_STRING_FORMAT);
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
