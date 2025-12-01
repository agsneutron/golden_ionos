<?php

namespace Map;

use \Modules;
use \ModulesQuery;
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
 * This class defines the structure of the 'modules' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ModulesTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ModulesTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'golden_clean';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'modules';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Modules';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Modules';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the id field
     */
    const COL_ID = 'modules.id';

    /**
     * the column name for the id_group field
     */
    const COL_ID_GROUP = 'modules.id_group';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'modules.name';

    /**
     * the column name for the url field
     */
    const COL_URL = 'modules.url';

    /**
     * the column name for the icon field
     */
    const COL_ICON = 'modules.icon';

    /**
     * the column name for the active field
     */
    const COL_ACTIVE = 'modules.active';

    /**
     * the column name for the order field
     */
    const COL_ORDER = 'modules.order';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'modules.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'modules.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'IdGroup', 'Name', 'Url', 'Icon', 'Active', 'Order', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'idGroup', 'name', 'url', 'icon', 'active', 'order', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(ModulesTableMap::COL_ID, ModulesTableMap::COL_ID_GROUP, ModulesTableMap::COL_NAME, ModulesTableMap::COL_URL, ModulesTableMap::COL_ICON, ModulesTableMap::COL_ACTIVE, ModulesTableMap::COL_ORDER, ModulesTableMap::COL_CREATED_AT, ModulesTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'id_group', 'name', 'url', 'icon', 'active', 'order', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdGroup' => 1, 'Name' => 2, 'Url' => 3, 'Icon' => 4, 'Active' => 5, 'Order' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idGroup' => 1, 'name' => 2, 'url' => 3, 'icon' => 4, 'active' => 5, 'order' => 6, 'createdAt' => 7, 'updatedAt' => 8, ),
        self::TYPE_COLNAME       => array(ModulesTableMap::COL_ID => 0, ModulesTableMap::COL_ID_GROUP => 1, ModulesTableMap::COL_NAME => 2, ModulesTableMap::COL_URL => 3, ModulesTableMap::COL_ICON => 4, ModulesTableMap::COL_ACTIVE => 5, ModulesTableMap::COL_ORDER => 6, ModulesTableMap::COL_CREATED_AT => 7, ModulesTableMap::COL_UPDATED_AT => 8, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_group' => 1, 'name' => 2, 'url' => 3, 'icon' => 4, 'active' => 5, 'order' => 6, 'created_at' => 7, 'updated_at' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Modules.Id' => 'ID',
        'id' => 'ID',
        'modules.id' => 'ID',
        'ModulesTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'IdGroup' => 'ID_GROUP',
        'Modules.IdGroup' => 'ID_GROUP',
        'idGroup' => 'ID_GROUP',
        'modules.idGroup' => 'ID_GROUP',
        'ModulesTableMap::COL_ID_GROUP' => 'ID_GROUP',
        'COL_ID_GROUP' => 'ID_GROUP',
        'id_group' => 'ID_GROUP',
        'modules.id_group' => 'ID_GROUP',
        'Name' => 'NAME',
        'Modules.Name' => 'NAME',
        'name' => 'NAME',
        'modules.name' => 'NAME',
        'ModulesTableMap::COL_NAME' => 'NAME',
        'COL_NAME' => 'NAME',
        'Url' => 'URL',
        'Modules.Url' => 'URL',
        'url' => 'URL',
        'modules.url' => 'URL',
        'ModulesTableMap::COL_URL' => 'URL',
        'COL_URL' => 'URL',
        'Icon' => 'ICON',
        'Modules.Icon' => 'ICON',
        'icon' => 'ICON',
        'modules.icon' => 'ICON',
        'ModulesTableMap::COL_ICON' => 'ICON',
        'COL_ICON' => 'ICON',
        'Active' => 'ACTIVE',
        'Modules.Active' => 'ACTIVE',
        'active' => 'ACTIVE',
        'modules.active' => 'ACTIVE',
        'ModulesTableMap::COL_ACTIVE' => 'ACTIVE',
        'COL_ACTIVE' => 'ACTIVE',
        'Order' => 'ORDER',
        'Modules.Order' => 'ORDER',
        'order' => 'ORDER',
        'modules.order' => 'ORDER',
        'ModulesTableMap::COL_ORDER' => 'ORDER',
        'COL_ORDER' => 'ORDER',
        'CreatedAt' => 'CREATED_AT',
        'Modules.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'modules.createdAt' => 'CREATED_AT',
        'ModulesTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'modules.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Modules.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'modules.updatedAt' => 'UPDATED_AT',
        'ModulesTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'modules.updated_at' => 'UPDATED_AT',
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
        $this->setName('modules');
        $this->setPhpName('Modules');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Modules');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 10, null);
        $this->addForeignKey('id_group', 'IdGroup', 'INTEGER', 'groups', 'id', true, 10, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 191, null);
        $this->addColumn('url', 'Url', 'VARCHAR', true, 191, null);
        $this->addColumn('icon', 'Icon', 'VARCHAR', true, 191, null);
        $this->addColumn('active', 'Active', 'INTEGER', true, 10, null);
        $this->addColumn('order', 'Order', 'INTEGER', true, 10, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Groups', '\\Groups', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_group',
    1 => ':id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('ProfilePermissions', '\\ProfilePermissions', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_module',
    1 => ':id',
  ),
), null, 'CASCADE', 'ProfilePermissionss', false);
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
        return $withPrefix ? ModulesTableMap::CLASS_DEFAULT : ModulesTableMap::OM_CLASS;
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
     * @return array           (Modules object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ModulesTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ModulesTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ModulesTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ModulesTableMap::OM_CLASS;
            /** @var Modules $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ModulesTableMap::addInstanceToPool($obj, $key);
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
            $key = ModulesTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ModulesTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Modules $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ModulesTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ModulesTableMap::COL_ID);
            $criteria->addSelectColumn(ModulesTableMap::COL_ID_GROUP);
            $criteria->addSelectColumn(ModulesTableMap::COL_NAME);
            $criteria->addSelectColumn(ModulesTableMap::COL_URL);
            $criteria->addSelectColumn(ModulesTableMap::COL_ICON);
            $criteria->addSelectColumn(ModulesTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(ModulesTableMap::COL_ORDER);
            $criteria->addSelectColumn(ModulesTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ModulesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_group');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.url');
            $criteria->addSelectColumn($alias . '.icon');
            $criteria->addSelectColumn($alias . '.active');
            $criteria->addSelectColumn($alias . '.order');
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
            $criteria->removeSelectColumn(ModulesTableMap::COL_ID);
            $criteria->removeSelectColumn(ModulesTableMap::COL_ID_GROUP);
            $criteria->removeSelectColumn(ModulesTableMap::COL_NAME);
            $criteria->removeSelectColumn(ModulesTableMap::COL_URL);
            $criteria->removeSelectColumn(ModulesTableMap::COL_ICON);
            $criteria->removeSelectColumn(ModulesTableMap::COL_ACTIVE);
            $criteria->removeSelectColumn(ModulesTableMap::COL_ORDER);
            $criteria->removeSelectColumn(ModulesTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(ModulesTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.id_group');
            $criteria->removeSelectColumn($alias . '.name');
            $criteria->removeSelectColumn($alias . '.url');
            $criteria->removeSelectColumn($alias . '.icon');
            $criteria->removeSelectColumn($alias . '.active');
            $criteria->removeSelectColumn($alias . '.order');
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
        return Propel::getServiceContainer()->getDatabaseMap(ModulesTableMap::DATABASE_NAME)->getTable(ModulesTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Modules or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Modules object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ModulesTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Modules) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ModulesTableMap::DATABASE_NAME);
            $criteria->add(ModulesTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ModulesQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ModulesTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ModulesTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the modules table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ModulesQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Modules or Criteria object.
     *
     * @param mixed               $criteria Criteria or Modules object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ModulesTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Modules object
        }

        if ($criteria->containsKey(ModulesTableMap::COL_ID) && $criteria->keyContainsValue(ModulesTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ModulesTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ModulesQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ModulesTableMap
