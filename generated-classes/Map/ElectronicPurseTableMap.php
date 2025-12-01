<?php

namespace Map;

use \ElectronicPurse;
use \ElectronicPurseQuery;
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
 * This class defines the structure of the 'electronic_purse' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ElectronicPurseTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ElectronicPurseTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'golden_clean';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'electronic_purse';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\ElectronicPurse';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'ElectronicPurse';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the id field
     */
    const COL_ID = 'electronic_purse.id';

    /**
     * the column name for the id_client_user field
     */
    const COL_ID_CLIENT_USER = 'electronic_purse.id_client_user';

    /**
     * the column name for the code field
     */
    const COL_CODE = 'electronic_purse.code';

    /**
     * the column name for the amount field
     */
    const COL_AMOUNT = 'electronic_purse.amount';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'electronic_purse.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'electronic_purse.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'IdClientUser', 'Code', 'Amount', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'idClientUser', 'code', 'amount', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(ElectronicPurseTableMap::COL_ID, ElectronicPurseTableMap::COL_ID_CLIENT_USER, ElectronicPurseTableMap::COL_CODE, ElectronicPurseTableMap::COL_AMOUNT, ElectronicPurseTableMap::COL_CREATED_AT, ElectronicPurseTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'id_client_user', 'code', 'amount', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdClientUser' => 1, 'Code' => 2, 'Amount' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idClientUser' => 1, 'code' => 2, 'amount' => 3, 'createdAt' => 4, 'updatedAt' => 5, ),
        self::TYPE_COLNAME       => array(ElectronicPurseTableMap::COL_ID => 0, ElectronicPurseTableMap::COL_ID_CLIENT_USER => 1, ElectronicPurseTableMap::COL_CODE => 2, ElectronicPurseTableMap::COL_AMOUNT => 3, ElectronicPurseTableMap::COL_CREATED_AT => 4, ElectronicPurseTableMap::COL_UPDATED_AT => 5, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_client_user' => 1, 'code' => 2, 'amount' => 3, 'created_at' => 4, 'updated_at' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'ElectronicPurse.Id' => 'ID',
        'id' => 'ID',
        'electronicPurse.id' => 'ID',
        'ElectronicPurseTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'electronic_purse.id' => 'ID',
        'IdClientUser' => 'ID_CLIENT_USER',
        'ElectronicPurse.IdClientUser' => 'ID_CLIENT_USER',
        'idClientUser' => 'ID_CLIENT_USER',
        'electronicPurse.idClientUser' => 'ID_CLIENT_USER',
        'ElectronicPurseTableMap::COL_ID_CLIENT_USER' => 'ID_CLIENT_USER',
        'COL_ID_CLIENT_USER' => 'ID_CLIENT_USER',
        'id_client_user' => 'ID_CLIENT_USER',
        'electronic_purse.id_client_user' => 'ID_CLIENT_USER',
        'Code' => 'CODE',
        'ElectronicPurse.Code' => 'CODE',
        'code' => 'CODE',
        'electronicPurse.code' => 'CODE',
        'ElectronicPurseTableMap::COL_CODE' => 'CODE',
        'COL_CODE' => 'CODE',
        'electronic_purse.code' => 'CODE',
        'Amount' => 'AMOUNT',
        'ElectronicPurse.Amount' => 'AMOUNT',
        'amount' => 'AMOUNT',
        'electronicPurse.amount' => 'AMOUNT',
        'ElectronicPurseTableMap::COL_AMOUNT' => 'AMOUNT',
        'COL_AMOUNT' => 'AMOUNT',
        'electronic_purse.amount' => 'AMOUNT',
        'CreatedAt' => 'CREATED_AT',
        'ElectronicPurse.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'electronicPurse.createdAt' => 'CREATED_AT',
        'ElectronicPurseTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'electronic_purse.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'ElectronicPurse.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'electronicPurse.updatedAt' => 'UPDATED_AT',
        'ElectronicPurseTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'electronic_purse.updated_at' => 'UPDATED_AT',
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
        $this->setName('electronic_purse');
        $this->setPhpName('ElectronicPurse');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\ElectronicPurse');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 10, null);
        $this->addForeignKey('id_client_user', 'IdClientUser', 'INTEGER', 'users', 'id', true, 10, null);
        $this->addColumn('code', 'Code', 'VARCHAR', true, 191, null);
        $this->addColumn('amount', 'Amount', 'DECIMAL', true, 8, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Users', '\\Users', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_client_user',
    1 => ':id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('ElectronicPurseHistory', '\\ElectronicPurseHistory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_electronic_purse',
    1 => ':id',
  ),
), null, 'CASCADE', 'ElectronicPurseHistories', false);
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
        return $withPrefix ? ElectronicPurseTableMap::CLASS_DEFAULT : ElectronicPurseTableMap::OM_CLASS;
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
     * @return array           (ElectronicPurse object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ElectronicPurseTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ElectronicPurseTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ElectronicPurseTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ElectronicPurseTableMap::OM_CLASS;
            /** @var ElectronicPurse $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ElectronicPurseTableMap::addInstanceToPool($obj, $key);
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
            $key = ElectronicPurseTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ElectronicPurseTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var ElectronicPurse $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ElectronicPurseTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ElectronicPurseTableMap::COL_ID);
            $criteria->addSelectColumn(ElectronicPurseTableMap::COL_ID_CLIENT_USER);
            $criteria->addSelectColumn(ElectronicPurseTableMap::COL_CODE);
            $criteria->addSelectColumn(ElectronicPurseTableMap::COL_AMOUNT);
            $criteria->addSelectColumn(ElectronicPurseTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ElectronicPurseTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_client_user');
            $criteria->addSelectColumn($alias . '.code');
            $criteria->addSelectColumn($alias . '.amount');
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
            $criteria->removeSelectColumn(ElectronicPurseTableMap::COL_ID);
            $criteria->removeSelectColumn(ElectronicPurseTableMap::COL_ID_CLIENT_USER);
            $criteria->removeSelectColumn(ElectronicPurseTableMap::COL_CODE);
            $criteria->removeSelectColumn(ElectronicPurseTableMap::COL_AMOUNT);
            $criteria->removeSelectColumn(ElectronicPurseTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(ElectronicPurseTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.id_client_user');
            $criteria->removeSelectColumn($alias . '.code');
            $criteria->removeSelectColumn($alias . '.amount');
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
        return Propel::getServiceContainer()->getDatabaseMap(ElectronicPurseTableMap::DATABASE_NAME)->getTable(ElectronicPurseTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a ElectronicPurse or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ElectronicPurse object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ElectronicPurseTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \ElectronicPurse) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ElectronicPurseTableMap::DATABASE_NAME);
            $criteria->add(ElectronicPurseTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = ElectronicPurseQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ElectronicPurseTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ElectronicPurseTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the electronic_purse table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ElectronicPurseQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a ElectronicPurse or Criteria object.
     *
     * @param mixed               $criteria Criteria or ElectronicPurse object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ElectronicPurseTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from ElectronicPurse object
        }

        if ($criteria->containsKey(ElectronicPurseTableMap::COL_ID) && $criteria->keyContainsValue(ElectronicPurseTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ElectronicPurseTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = ElectronicPurseQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ElectronicPurseTableMap
