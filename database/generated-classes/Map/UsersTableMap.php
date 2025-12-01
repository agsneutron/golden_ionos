<?php

namespace Map;

use \Users;
use \UsersQuery;
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
 * This class defines the structure of the 'users' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class UsersTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.UsersTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'golden_clean';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'users';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Users';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Users';

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
    const COL_ID = 'users.id';

    /**
     * the column name for the id_user_type field
     */
    const COL_ID_USER_TYPE = 'users.id_user_type';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'users.name';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'users.email';

    /**
     * the column name for the password field
     */
    const COL_PASSWORD = 'users.password';

    /**
     * the column name for the address field
     */
    const COL_ADDRESS = 'users.address';

    /**
     * the column name for the suburb field
     */
    const COL_SUBURB = 'users.suburb';

    /**
     * the column name for the phone field
     */
    const COL_PHONE = 'users.phone';

    /**
     * the column name for the notes field
     */
    const COL_NOTES = 'users.notes';

    /**
     * the column name for the postal_code field
     */
    const COL_POSTAL_CODE = 'users.postal_code';

    /**
     * the column name for the id_branch_office field
     */
    const COL_ID_BRANCH_OFFICE = 'users.id_branch_office';

    /**
     * the column name for the remember_token field
     */
    const COL_REMEMBER_TOKEN = 'users.remember_token';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'users.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'users.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'IdUserType', 'Name', 'Email', 'Password', 'Address', 'Suburb', 'Phone', 'Notes', 'PostalCode', 'IdBranchOffice', 'RememberToken', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'idUserType', 'name', 'email', 'password', 'address', 'suburb', 'phone', 'notes', 'postalCode', 'idBranchOffice', 'rememberToken', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(UsersTableMap::COL_ID, UsersTableMap::COL_ID_USER_TYPE, UsersTableMap::COL_NAME, UsersTableMap::COL_EMAIL, UsersTableMap::COL_PASSWORD, UsersTableMap::COL_ADDRESS, UsersTableMap::COL_SUBURB, UsersTableMap::COL_PHONE, UsersTableMap::COL_NOTES, UsersTableMap::COL_POSTAL_CODE, UsersTableMap::COL_ID_BRANCH_OFFICE, UsersTableMap::COL_REMEMBER_TOKEN, UsersTableMap::COL_CREATED_AT, UsersTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'id_user_type', 'name', 'email', 'password', 'address', 'suburb', 'phone', 'notes', 'postal_code', 'id_branch_office', 'remember_token', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdUserType' => 1, 'Name' => 2, 'Email' => 3, 'Password' => 4, 'Address' => 5, 'Suburb' => 6, 'Phone' => 7, 'Notes' => 8, 'PostalCode' => 9, 'IdBranchOffice' => 10, 'RememberToken' => 11, 'CreatedAt' => 12, 'UpdatedAt' => 13, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idUserType' => 1, 'name' => 2, 'email' => 3, 'password' => 4, 'address' => 5, 'suburb' => 6, 'phone' => 7, 'notes' => 8, 'postalCode' => 9, 'idBranchOffice' => 10, 'rememberToken' => 11, 'createdAt' => 12, 'updatedAt' => 13, ),
        self::TYPE_COLNAME       => array(UsersTableMap::COL_ID => 0, UsersTableMap::COL_ID_USER_TYPE => 1, UsersTableMap::COL_NAME => 2, UsersTableMap::COL_EMAIL => 3, UsersTableMap::COL_PASSWORD => 4, UsersTableMap::COL_ADDRESS => 5, UsersTableMap::COL_SUBURB => 6, UsersTableMap::COL_PHONE => 7, UsersTableMap::COL_NOTES => 8, UsersTableMap::COL_POSTAL_CODE => 9, UsersTableMap::COL_ID_BRANCH_OFFICE => 10, UsersTableMap::COL_REMEMBER_TOKEN => 11, UsersTableMap::COL_CREATED_AT => 12, UsersTableMap::COL_UPDATED_AT => 13, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_user_type' => 1, 'name' => 2, 'email' => 3, 'password' => 4, 'address' => 5, 'suburb' => 6, 'phone' => 7, 'notes' => 8, 'postal_code' => 9, 'id_branch_office' => 10, 'remember_token' => 11, 'created_at' => 12, 'updated_at' => 13, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Users.Id' => 'ID',
        'id' => 'ID',
        'users.id' => 'ID',
        'UsersTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'IdUserType' => 'ID_USER_TYPE',
        'Users.IdUserType' => 'ID_USER_TYPE',
        'idUserType' => 'ID_USER_TYPE',
        'users.idUserType' => 'ID_USER_TYPE',
        'UsersTableMap::COL_ID_USER_TYPE' => 'ID_USER_TYPE',
        'COL_ID_USER_TYPE' => 'ID_USER_TYPE',
        'id_user_type' => 'ID_USER_TYPE',
        'users.id_user_type' => 'ID_USER_TYPE',
        'Name' => 'NAME',
        'Users.Name' => 'NAME',
        'name' => 'NAME',
        'users.name' => 'NAME',
        'UsersTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'Email' => 'EMAIL',
        'Users.Email' => 'EMAIL',
        'email' => 'EMAIL',
        'users.email' => 'EMAIL',
        'UsersTableMap::COL_EMAIL' => 'EMAIL',
        'COL_EMAIL' => 'EMAIL',
        'Password' => 'PASSWORD',
        'Users.Password' => 'PASSWORD',
        'password' => 'PASSWORD',
        'users.password' => 'PASSWORD',
        'UsersTableMap::COL_PASSWORD' => 'PASSWORD',
        'COL_PASSWORD' => 'PASSWORD',
        'Address' => 'ADDRESS',
        'Users.Address' => 'ADDRESS',
        'address' => 'ADDRESS',
        'users.address' => 'ADDRESS',
        'UsersTableMap::COL_ADDRESS' => 'ADDRESS',
        'COL_ADDRESS' => 'ADDRESS',
        'Suburb' => 'SUBURB',
        'Users.Suburb' => 'SUBURB',
        'suburb' => 'SUBURB',
        'users.suburb' => 'SUBURB',
        'UsersTableMap::COL_SUBURB' => 'SUBURB',
        'COL_SUBURB' => 'SUBURB',
        'Phone' => 'PHONE',
        'Users.Phone' => 'PHONE',
        'phone' => 'PHONE',
        'users.phone' => 'PHONE',
        'UsersTableMap::COL_PHONE' => 'PHONE',
        'COL_PHONE' => 'PHONE',
        'Notes' => 'NOTES',
        'Users.Notes' => 'NOTES',
        'notes' => 'NOTES',
        'users.notes' => 'NOTES',
        'UsersTableMap::COL_NOTES' => 'NOTES',
        'COL_NOTES' => 'NOTES',
        'PostalCode' => 'POSTAL_CODE',
        'Users.PostalCode' => 'POSTAL_CODE',
        'postalCode' => 'POSTAL_CODE',
        'users.postalCode' => 'POSTAL_CODE',
        'UsersTableMap::COL_POSTAL_CODE' => 'POSTAL_CODE',
        'COL_POSTAL_CODE' => 'POSTAL_CODE',
        'postal_code' => 'POSTAL_CODE',
        'users.postal_code' => 'POSTAL_CODE',
        'IdBranchOffice' => 'ID_BRANCH_OFFICE',
        'Users.IdBranchOffice' => 'ID_BRANCH_OFFICE',
        'idBranchOffice' => 'ID_BRANCH_OFFICE',
        'users.idBranchOffice' => 'ID_BRANCH_OFFICE',
        'UsersTableMap::COL_ID_BRANCH_OFFICE' => 'ID_BRANCH_OFFICE',
        'COL_ID_BRANCH_OFFICE' => 'ID_BRANCH_OFFICE',
        'id_branch_office' => 'ID_BRANCH_OFFICE',
        'users.id_branch_office' => 'ID_BRANCH_OFFICE',
        'RememberToken' => 'REMEMBER_TOKEN',
        'Users.RememberToken' => 'REMEMBER_TOKEN',
        'rememberToken' => 'REMEMBER_TOKEN',
        'users.rememberToken' => 'REMEMBER_TOKEN',
        'UsersTableMap::COL_REMEMBER_TOKEN' => 'REMEMBER_TOKEN',
        'COL_REMEMBER_TOKEN' => 'REMEMBER_TOKEN',
        'remember_token' => 'REMEMBER_TOKEN',
        'users.remember_token' => 'REMEMBER_TOKEN',
        'CreatedAt' => 'CREATED_AT',
        'Users.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'users.createdAt' => 'CREATED_AT',
        'UsersTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'users.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Users.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'users.updatedAt' => 'UPDATED_AT',
        'UsersTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'users.updated_at' => 'UPDATED_AT',
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
        $this->setName('users');
        $this->setPhpName('Users');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Users');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 10, null);
        $this->addForeignKey('id_user_type', 'IdUserType', 'INTEGER', 'user_types', 'id', true, 10, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 191, null);
        $this->addColumn('email', 'Email', 'VARCHAR', true, 191, null);
        $this->addColumn('password', 'Password', 'VARCHAR', true, 191, null);
        $this->addColumn('address', 'Address', 'VARCHAR', true, 191, null);
        $this->addColumn('suburb', 'Suburb', 'VARCHAR', true, 191, '');
        $this->addColumn('phone', 'Phone', 'VARCHAR', true, 191, null);
        $this->addColumn('notes', 'Notes', 'VARCHAR', true, 1000, null);
        $this->addColumn('postal_code', 'PostalCode', 'INTEGER', true, 10, null);
        $this->addForeignKey('id_branch_office', 'IdBranchOffice', 'INTEGER', 'branch_offices', 'id', false, 10, null);
        $this->addColumn('remember_token', 'RememberToken', 'VARCHAR', false, 100, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('BranchOffices', '\\BranchOffices', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_branch_office',
    1 => ':id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('UserTypes', '\\UserTypes', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_user_type',
    1 => ':id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('Deliveries', '\\Deliveries', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_assigned_user',
    1 => ':id',
  ),
), null, 'CASCADE', 'Deliveriess', false);
        $this->addRelation('ElectronicPurse', '\\ElectronicPurse', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_client_user',
    1 => ':id',
  ),
), null, 'CASCADE', 'ElectronicPurses', false);
        $this->addRelation('ExpenseReports', '\\ExpenseReports', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_user',
    1 => ':id',
  ),
), null, 'CASCADE', 'ExpenseReportss', false);
        $this->addRelation('OrderDetail', '\\OrderDetail', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_delivery_user',
    1 => ':id',
  ),
), null, null, 'OrderDetails', false);
        $this->addRelation('OrderDetailHistory', '\\OrderDetailHistory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_user',
    1 => ':id',
  ),
), null, 'CASCADE', 'OrderDetailHistories', false);
        $this->addRelation('OrderHistory', '\\OrderHistory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_user',
    1 => ':id',
  ),
), null, 'CASCADE', 'OrderHistories', false);
        $this->addRelation('OrdersRelatedByIdClientUser', '\\Orders', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_client_user',
    1 => ':id',
  ),
), null, 'CASCADE', 'OrderssRelatedByIdClientUser', false);
        $this->addRelation('OrdersRelatedByIdDeliveryUser', '\\Orders', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_delivery_user',
    1 => ':id',
  ),
), null, null, 'OrderssRelatedByIdDeliveryUser', false);
        $this->addRelation('OrdersRelatedByIdUser', '\\Orders', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_user',
    1 => ':id',
  ),
), null, 'CASCADE', 'OrderssRelatedByIdUser', false);
        $this->addRelation('Pickups', '\\Pickups', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_assigned_user',
    1 => ':id',
  ),
), null, 'CASCADE', 'Pickupss', false);
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
        return $withPrefix ? UsersTableMap::CLASS_DEFAULT : UsersTableMap::OM_CLASS;
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
     * @return array           (Users object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UsersTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UsersTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UsersTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UsersTableMap::OM_CLASS;
            /** @var Users $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UsersTableMap::addInstanceToPool($obj, $key);
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
            $key = UsersTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UsersTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Users $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UsersTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(UsersTableMap::COL_ID);
            $criteria->addSelectColumn(UsersTableMap::COL_ID_USER_TYPE);
            $criteria->addSelectColumn(UsersTableMap::COL_NAME);
            $criteria->addSelectColumn(UsersTableMap::COL_EMAIL);
            $criteria->addSelectColumn(UsersTableMap::COL_PASSWORD);
            $criteria->addSelectColumn(UsersTableMap::COL_ADDRESS);
            $criteria->addSelectColumn(UsersTableMap::COL_SUBURB);
            $criteria->addSelectColumn(UsersTableMap::COL_PHONE);
            $criteria->addSelectColumn(UsersTableMap::COL_NOTES);
            $criteria->addSelectColumn(UsersTableMap::COL_POSTAL_CODE);
            $criteria->addSelectColumn(UsersTableMap::COL_ID_BRANCH_OFFICE);
            $criteria->addSelectColumn(UsersTableMap::COL_REMEMBER_TOKEN);
            $criteria->addSelectColumn(UsersTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(UsersTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_user_type');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.password');
            $criteria->addSelectColumn($alias . '.address');
            $criteria->addSelectColumn($alias . '.suburb');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.notes');
            $criteria->addSelectColumn($alias . '.postal_code');
            $criteria->addSelectColumn($alias . '.id_branch_office');
            $criteria->addSelectColumn($alias . '.remember_token');
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
            $criteria->removeSelectColumn(UsersTableMap::COL_ID);
            $criteria->removeSelectColumn(UsersTableMap::COL_ID_USER_TYPE);
            $criteria->removeSelectColumn(UsersTableMap::COL_NAME);
            $criteria->removeSelectColumn(UsersTableMap::COL_EMAIL);
            $criteria->removeSelectColumn(UsersTableMap::COL_PASSWORD);
            $criteria->removeSelectColumn(UsersTableMap::COL_ADDRESS);
            $criteria->removeSelectColumn(UsersTableMap::COL_SUBURB);
            $criteria->removeSelectColumn(UsersTableMap::COL_PHONE);
            $criteria->removeSelectColumn(UsersTableMap::COL_NOTES);
            $criteria->removeSelectColumn(UsersTableMap::COL_POSTAL_CODE);
            $criteria->removeSelectColumn(UsersTableMap::COL_ID_BRANCH_OFFICE);
            $criteria->removeSelectColumn(UsersTableMap::COL_REMEMBER_TOKEN);
            $criteria->removeSelectColumn(UsersTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(UsersTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.id_user_type');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.email');
            $criteria->removeSelectColumn($alias . '.password');
            $criteria->removeSelectColumn($alias . '.address');
            $criteria->removeSelectColumn($alias . '.suburb');
            $criteria->removeSelectColumn($alias . '.phone');
            $criteria->removeSelectColumn($alias . '.notes');
            $criteria->removeSelectColumn($alias . '.postal_code');
            $criteria->removeSelectColumn($alias . '.id_branch_office');
            $criteria->removeSelectColumn($alias . '.remember_token');
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
        return Propel::getServiceContainer()->getDatabaseMap(UsersTableMap::DATABASE_NAME)->getTable(UsersTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Users or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Users object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Users) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UsersTableMap::DATABASE_NAME);
            $criteria->add(UsersTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = UsersQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UsersTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UsersTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the users table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UsersQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Users or Criteria object.
     *
     * @param mixed               $criteria Criteria or Users object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UsersTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Users object
        }

        if ($criteria->containsKey(UsersTableMap::COL_ID) && $criteria->keyContainsValue(UsersTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.UsersTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = UsersQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UsersTableMap
