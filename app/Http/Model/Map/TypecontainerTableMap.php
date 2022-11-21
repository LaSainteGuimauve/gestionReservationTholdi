<?php

namespace App\Http\Model\Map;

use App\Http\Model\Typecontainer;
use App\Http\Model\TypecontainerQuery;
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
 * This class defines the structure of the 'typeContainer' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class TypecontainerTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.TypecontainerTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'typeContainer';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\App\\Http\\Model\\Typecontainer';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Typecontainer';

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
     * the column name for the numTypeContainer field
     */
    const COL_NUMTYPECONTAINER = 'typeContainer.numTypeContainer';

    /**
     * the column name for the codeTypeContainer field
     */
    const COL_CODETYPECONTAINER = 'typeContainer.codeTypeContainer';

    /**
     * the column name for the libelleTypeContainer field
     */
    const COL_LIBELLETYPECONTAINER = 'typeContainer.libelleTypeContainer';

    /**
     * the column name for the longueurCont field
     */
    const COL_LONGUEURCONT = 'typeContainer.longueurCont';

    /**
     * the column name for the largeurCont field
     */
    const COL_LARGEURCONT = 'typeContainer.largeurCont';

    /**
     * the column name for the hauteurCont field
     */
    const COL_HAUTEURCONT = 'typeContainer.hauteurCont';

    /**
     * the column name for the poidsCont field
     */
    const COL_POIDSCONT = 'typeContainer.poidsCont';

    /**
     * the column name for the tare field
     */
    const COL_TARE = 'typeContainer.tare';

    /**
     * the column name for the capaciteDeCharge field
     */
    const COL_CAPACITEDECHARGE = 'typeContainer.capaciteDeCharge';

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
        self::TYPE_PHPNAME       => array('Numtypecontainer', 'Codetypecontainer', 'Libelletypecontainer', 'Longueurcont', 'Largeurcont', 'Hauteurcont', 'Poidscont', 'Tare', 'Capacitedecharge', ),
        self::TYPE_CAMELNAME     => array('numtypecontainer', 'codetypecontainer', 'libelletypecontainer', 'longueurcont', 'largeurcont', 'hauteurcont', 'poidscont', 'tare', 'capacitedecharge', ),
        self::TYPE_COLNAME       => array(TypecontainerTableMap::COL_NUMTYPECONTAINER, TypecontainerTableMap::COL_CODETYPECONTAINER, TypecontainerTableMap::COL_LIBELLETYPECONTAINER, TypecontainerTableMap::COL_LONGUEURCONT, TypecontainerTableMap::COL_LARGEURCONT, TypecontainerTableMap::COL_HAUTEURCONT, TypecontainerTableMap::COL_POIDSCONT, TypecontainerTableMap::COL_TARE, TypecontainerTableMap::COL_CAPACITEDECHARGE, ),
        self::TYPE_FIELDNAME     => array('numTypeContainer', 'codeTypeContainer', 'libelleTypeContainer', 'longueurCont', 'largeurCont', 'hauteurCont', 'poidsCont', 'tare', 'capaciteDeCharge', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Numtypecontainer' => 0, 'Codetypecontainer' => 1, 'Libelletypecontainer' => 2, 'Longueurcont' => 3, 'Largeurcont' => 4, 'Hauteurcont' => 5, 'Poidscont' => 6, 'Tare' => 7, 'Capacitedecharge' => 8, ),
        self::TYPE_CAMELNAME     => array('numtypecontainer' => 0, 'codetypecontainer' => 1, 'libelletypecontainer' => 2, 'longueurcont' => 3, 'largeurcont' => 4, 'hauteurcont' => 5, 'poidscont' => 6, 'tare' => 7, 'capacitedecharge' => 8, ),
        self::TYPE_COLNAME       => array(TypecontainerTableMap::COL_NUMTYPECONTAINER => 0, TypecontainerTableMap::COL_CODETYPECONTAINER => 1, TypecontainerTableMap::COL_LIBELLETYPECONTAINER => 2, TypecontainerTableMap::COL_LONGUEURCONT => 3, TypecontainerTableMap::COL_LARGEURCONT => 4, TypecontainerTableMap::COL_HAUTEURCONT => 5, TypecontainerTableMap::COL_POIDSCONT => 6, TypecontainerTableMap::COL_TARE => 7, TypecontainerTableMap::COL_CAPACITEDECHARGE => 8, ),
        self::TYPE_FIELDNAME     => array('numTypeContainer' => 0, 'codeTypeContainer' => 1, 'libelleTypeContainer' => 2, 'longueurCont' => 3, 'largeurCont' => 4, 'hauteurCont' => 5, 'poidsCont' => 6, 'tare' => 7, 'capaciteDeCharge' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Numtypecontainer' => 'NUMTYPECONTAINER',
        'Typecontainer.Numtypecontainer' => 'NUMTYPECONTAINER',
        'numtypecontainer' => 'NUMTYPECONTAINER',
        'typecontainer.numtypecontainer' => 'NUMTYPECONTAINER',
        'TypecontainerTableMap::COL_NUMTYPECONTAINER' => 'NUMTYPECONTAINER',
        'COL_NUMTYPECONTAINER' => 'NUMTYPECONTAINER',
        'numTypeContainer' => 'NUMTYPECONTAINER',
        'typeContainer.numTypeContainer' => 'NUMTYPECONTAINER',
        'Codetypecontainer' => 'CODETYPECONTAINER',
        'Typecontainer.Codetypecontainer' => 'CODETYPECONTAINER',
        'codetypecontainer' => 'CODETYPECONTAINER',
        'typecontainer.codetypecontainer' => 'CODETYPECONTAINER',
        'TypecontainerTableMap::COL_CODETYPECONTAINER' => 'CODETYPECONTAINER',
        'COL_CODETYPECONTAINER' => 'CODETYPECONTAINER',
        'codeTypeContainer' => 'CODETYPECONTAINER',
        'typeContainer.codeTypeContainer' => 'CODETYPECONTAINER',
        'Libelletypecontainer' => 'LIBELLETYPECONTAINER',
        'Typecontainer.Libelletypecontainer' => 'LIBELLETYPECONTAINER',
        'libelletypecontainer' => 'LIBELLETYPECONTAINER',
        'typecontainer.libelletypecontainer' => 'LIBELLETYPECONTAINER',
        'TypecontainerTableMap::COL_LIBELLETYPECONTAINER' => 'LIBELLETYPECONTAINER',
        'COL_LIBELLETYPECONTAINER' => 'LIBELLETYPECONTAINER',
        'libelleTypeContainer' => 'LIBELLETYPECONTAINER',
        'typeContainer.libelleTypeContainer' => 'LIBELLETYPECONTAINER',
        'Longueurcont' => 'LONGUEURCONT',
        'Typecontainer.Longueurcont' => 'LONGUEURCONT',
        'longueurcont' => 'LONGUEURCONT',
        'typecontainer.longueurcont' => 'LONGUEURCONT',
        'TypecontainerTableMap::COL_LONGUEURCONT' => 'LONGUEURCONT',
        'COL_LONGUEURCONT' => 'LONGUEURCONT',
        'longueurCont' => 'LONGUEURCONT',
        'typeContainer.longueurCont' => 'LONGUEURCONT',
        'Largeurcont' => 'LARGEURCONT',
        'Typecontainer.Largeurcont' => 'LARGEURCONT',
        'largeurcont' => 'LARGEURCONT',
        'typecontainer.largeurcont' => 'LARGEURCONT',
        'TypecontainerTableMap::COL_LARGEURCONT' => 'LARGEURCONT',
        'COL_LARGEURCONT' => 'LARGEURCONT',
        'largeurCont' => 'LARGEURCONT',
        'typeContainer.largeurCont' => 'LARGEURCONT',
        'Hauteurcont' => 'HAUTEURCONT',
        'Typecontainer.Hauteurcont' => 'HAUTEURCONT',
        'hauteurcont' => 'HAUTEURCONT',
        'typecontainer.hauteurcont' => 'HAUTEURCONT',
        'TypecontainerTableMap::COL_HAUTEURCONT' => 'HAUTEURCONT',
        'COL_HAUTEURCONT' => 'HAUTEURCONT',
        'hauteurCont' => 'HAUTEURCONT',
        'typeContainer.hauteurCont' => 'HAUTEURCONT',
        'Poidscont' => 'POIDSCONT',
        'Typecontainer.Poidscont' => 'POIDSCONT',
        'poidscont' => 'POIDSCONT',
        'typecontainer.poidscont' => 'POIDSCONT',
        'TypecontainerTableMap::COL_POIDSCONT' => 'POIDSCONT',
        'COL_POIDSCONT' => 'POIDSCONT',
        'poidsCont' => 'POIDSCONT',
        'typeContainer.poidsCont' => 'POIDSCONT',
        'Tare' => 'TARE',
        'Typecontainer.Tare' => 'TARE',
        'tare' => 'TARE',
        'typecontainer.tare' => 'TARE',
        'TypecontainerTableMap::COL_TARE' => 'TARE',
        'COL_TARE' => 'TARE',
        'typeContainer.tare' => 'TARE',
        'Capacitedecharge' => 'CAPACITEDECHARGE',
        'Typecontainer.Capacitedecharge' => 'CAPACITEDECHARGE',
        'capacitedecharge' => 'CAPACITEDECHARGE',
        'typecontainer.capacitedecharge' => 'CAPACITEDECHARGE',
        'TypecontainerTableMap::COL_CAPACITEDECHARGE' => 'CAPACITEDECHARGE',
        'COL_CAPACITEDECHARGE' => 'CAPACITEDECHARGE',
        'capaciteDeCharge' => 'CAPACITEDECHARGE',
        'typeContainer.capaciteDeCharge' => 'CAPACITEDECHARGE',
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
        $this->setName('typeContainer');
        $this->setPhpName('Typecontainer');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Http\\Model\\Typecontainer');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('numTypeContainer', 'Numtypecontainer', 'SMALLINT', true, null, null);
        $this->addColumn('codeTypeContainer', 'Codetypecontainer', 'CHAR', true, 4, null);
        $this->addColumn('libelleTypeContainer', 'Libelletypecontainer', 'VARCHAR', true, 50, null);
        $this->addColumn('longueurCont', 'Longueurcont', 'DECIMAL', true, 5, null);
        $this->addColumn('largeurCont', 'Largeurcont', 'DECIMAL', true, 5, null);
        $this->addColumn('hauteurCont', 'Hauteurcont', 'DECIMAL', true, 4, null);
        $this->addColumn('poidsCont', 'Poidscont', 'DECIMAL', false, 5, null);
        $this->addColumn('tare', 'Tare', 'DECIMAL', false, 4, null);
        $this->addColumn('capaciteDeCharge', 'Capacitedecharge', 'DECIMAL', false, 5, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Reserver', '\\App\\Http\\Model\\Reserver', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':numTypeContainer',
    1 => ':numTypeContainer',
  ),
), 'CASCADE', 'CASCADE', 'Reservers', false);
        $this->addRelation('Tarificationcontainer', '\\App\\Http\\Model\\Tarificationcontainer', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':numTypeContainer',
    1 => ':numTypeContainer',
  ),
), null, null, 'Tarificationcontainers', false);
    } // buildRelations()

    /**
     * Method to invalidate the instance pool of all tables related to typeContainer     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        ReserverTableMap::clearInstancePool();
    }

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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Numtypecontainer', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Numtypecontainer', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Numtypecontainer', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Numtypecontainer', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Numtypecontainer', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Numtypecontainer', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Numtypecontainer', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? TypecontainerTableMap::CLASS_DEFAULT : TypecontainerTableMap::OM_CLASS;
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
     * @return array           (Typecontainer object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = TypecontainerTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = TypecontainerTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + TypecontainerTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = TypecontainerTableMap::OM_CLASS;
            /** @var Typecontainer $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            TypecontainerTableMap::addInstanceToPool($obj, $key);
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
            $key = TypecontainerTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = TypecontainerTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Typecontainer $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                TypecontainerTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(TypecontainerTableMap::COL_NUMTYPECONTAINER);
            $criteria->addSelectColumn(TypecontainerTableMap::COL_CODETYPECONTAINER);
            $criteria->addSelectColumn(TypecontainerTableMap::COL_LIBELLETYPECONTAINER);
            $criteria->addSelectColumn(TypecontainerTableMap::COL_LONGUEURCONT);
            $criteria->addSelectColumn(TypecontainerTableMap::COL_LARGEURCONT);
            $criteria->addSelectColumn(TypecontainerTableMap::COL_HAUTEURCONT);
            $criteria->addSelectColumn(TypecontainerTableMap::COL_POIDSCONT);
            $criteria->addSelectColumn(TypecontainerTableMap::COL_TARE);
            $criteria->addSelectColumn(TypecontainerTableMap::COL_CAPACITEDECHARGE);
        } else {
            $criteria->addSelectColumn($alias . '.numTypeContainer');
            $criteria->addSelectColumn($alias . '.codeTypeContainer');
            $criteria->addSelectColumn($alias . '.libelleTypeContainer');
            $criteria->addSelectColumn($alias . '.longueurCont');
            $criteria->addSelectColumn($alias . '.largeurCont');
            $criteria->addSelectColumn($alias . '.hauteurCont');
            $criteria->addSelectColumn($alias . '.poidsCont');
            $criteria->addSelectColumn($alias . '.tare');
            $criteria->addSelectColumn($alias . '.capaciteDeCharge');
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
            $criteria->removeSelectColumn(TypecontainerTableMap::COL_NUMTYPECONTAINER);
            $criteria->removeSelectColumn(TypecontainerTableMap::COL_CODETYPECONTAINER);
            $criteria->removeSelectColumn(TypecontainerTableMap::COL_LIBELLETYPECONTAINER);
            $criteria->removeSelectColumn(TypecontainerTableMap::COL_LONGUEURCONT);
            $criteria->removeSelectColumn(TypecontainerTableMap::COL_LARGEURCONT);
            $criteria->removeSelectColumn(TypecontainerTableMap::COL_HAUTEURCONT);
            $criteria->removeSelectColumn(TypecontainerTableMap::COL_POIDSCONT);
            $criteria->removeSelectColumn(TypecontainerTableMap::COL_TARE);
            $criteria->removeSelectColumn(TypecontainerTableMap::COL_CAPACITEDECHARGE);
        } else {
            $criteria->removeSelectColumn($alias . '.numTypeContainer');
            $criteria->removeSelectColumn($alias . '.codeTypeContainer');
            $criteria->removeSelectColumn($alias . '.libelleTypeContainer');
            $criteria->removeSelectColumn($alias . '.longueurCont');
            $criteria->removeSelectColumn($alias . '.largeurCont');
            $criteria->removeSelectColumn($alias . '.hauteurCont');
            $criteria->removeSelectColumn($alias . '.poidsCont');
            $criteria->removeSelectColumn($alias . '.tare');
            $criteria->removeSelectColumn($alias . '.capaciteDeCharge');
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
        return Propel::getServiceContainer()->getDatabaseMap(TypecontainerTableMap::DATABASE_NAME)->getTable(TypecontainerTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Typecontainer or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Typecontainer object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(TypecontainerTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Http\Model\Typecontainer) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(TypecontainerTableMap::DATABASE_NAME);
            $criteria->add(TypecontainerTableMap::COL_NUMTYPECONTAINER, (array) $values, Criteria::IN);
        }

        $query = TypecontainerQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            TypecontainerTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                TypecontainerTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the typeContainer table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return TypecontainerQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Typecontainer or Criteria object.
     *
     * @param mixed               $criteria Criteria or Typecontainer object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TypecontainerTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Typecontainer object
        }

        if ($criteria->containsKey(TypecontainerTableMap::COL_NUMTYPECONTAINER) && $criteria->keyContainsValue(TypecontainerTableMap::COL_NUMTYPECONTAINER) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.TypecontainerTableMap::COL_NUMTYPECONTAINER.')');
        }


        // Set the correct dbName
        $query = TypecontainerQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // TypecontainerTableMap
