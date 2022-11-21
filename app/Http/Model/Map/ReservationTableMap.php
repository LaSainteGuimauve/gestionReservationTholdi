<?php

namespace App\Http\Model\Map;

use App\Http\Model\Reservation;
use App\Http\Model\ReservationQuery;
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
 * This class defines the structure of the 'reservation' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ReservationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.ReservationTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'reservation';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\App\\Http\\Model\\Reservation';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Reservation';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the codeReservation field
     */
    const COL_CODERESERVATION = 'reservation.codeReservation';

    /**
     * the column name for the dateDebutReservation field
     */
    const COL_DATEDEBUTRESERVATION = 'reservation.dateDebutReservation';

    /**
     * the column name for the dateFinReservation field
     */
    const COL_DATEFINRESERVATION = 'reservation.dateFinReservation';

    /**
     * the column name for the dateReservation field
     */
    const COL_DATERESERVATION = 'reservation.dateReservation';

    /**
     * the column name for the volumeEstime field
     */
    const COL_VOLUMEESTIME = 'reservation.volumeEstime';

    /**
     * the column name for the codeDevis field
     */
    const COL_CODEDEVIS = 'reservation.codeDevis';

    /**
     * the column name for the codeVilleMiseDisposition field
     */
    const COL_CODEVILLEMISEDISPOSITION = 'reservation.codeVilleMiseDisposition';

    /**
     * the column name for the codeVilleRendre field
     */
    const COL_CODEVILLERENDRE = 'reservation.codeVilleRendre';

    /**
     * the column name for the codeUtilisateur field
     */
    const COL_CODEUTILISATEUR = 'reservation.codeUtilisateur';

    /**
     * the column name for the numeroDeReservation field
     */
    const COL_NUMERODERESERVATION = 'reservation.numeroDeReservation';

    /**
     * the column name for the etat field
     */
    const COL_ETAT = 'reservation.etat';

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
        self::TYPE_PHPNAME       => array('Codereservation', 'Datedebutreservation', 'Datefinreservation', 'Datereservation', 'Volumeestime', 'Codedevis', 'Codevillemisedisposition', 'Codevillerendre', 'Codeutilisateur', 'Numerodereservation', 'Etat', ),
        self::TYPE_CAMELNAME     => array('codereservation', 'datedebutreservation', 'datefinreservation', 'datereservation', 'volumeestime', 'codedevis', 'codevillemisedisposition', 'codevillerendre', 'codeutilisateur', 'numerodereservation', 'etat', ),
        self::TYPE_COLNAME       => array(ReservationTableMap::COL_CODERESERVATION, ReservationTableMap::COL_DATEDEBUTRESERVATION, ReservationTableMap::COL_DATEFINRESERVATION, ReservationTableMap::COL_DATERESERVATION, ReservationTableMap::COL_VOLUMEESTIME, ReservationTableMap::COL_CODEDEVIS, ReservationTableMap::COL_CODEVILLEMISEDISPOSITION, ReservationTableMap::COL_CODEVILLERENDRE, ReservationTableMap::COL_CODEUTILISATEUR, ReservationTableMap::COL_NUMERODERESERVATION, ReservationTableMap::COL_ETAT, ),
        self::TYPE_FIELDNAME     => array('codeReservation', 'dateDebutReservation', 'dateFinReservation', 'dateReservation', 'volumeEstime', 'codeDevis', 'codeVilleMiseDisposition', 'codeVilleRendre', 'codeUtilisateur', 'numeroDeReservation', 'etat', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Codereservation' => 0, 'Datedebutreservation' => 1, 'Datefinreservation' => 2, 'Datereservation' => 3, 'Volumeestime' => 4, 'Codedevis' => 5, 'Codevillemisedisposition' => 6, 'Codevillerendre' => 7, 'Codeutilisateur' => 8, 'Numerodereservation' => 9, 'Etat' => 10, ),
        self::TYPE_CAMELNAME     => array('codereservation' => 0, 'datedebutreservation' => 1, 'datefinreservation' => 2, 'datereservation' => 3, 'volumeestime' => 4, 'codedevis' => 5, 'codevillemisedisposition' => 6, 'codevillerendre' => 7, 'codeutilisateur' => 8, 'numerodereservation' => 9, 'etat' => 10, ),
        self::TYPE_COLNAME       => array(ReservationTableMap::COL_CODERESERVATION => 0, ReservationTableMap::COL_DATEDEBUTRESERVATION => 1, ReservationTableMap::COL_DATEFINRESERVATION => 2, ReservationTableMap::COL_DATERESERVATION => 3, ReservationTableMap::COL_VOLUMEESTIME => 4, ReservationTableMap::COL_CODEDEVIS => 5, ReservationTableMap::COL_CODEVILLEMISEDISPOSITION => 6, ReservationTableMap::COL_CODEVILLERENDRE => 7, ReservationTableMap::COL_CODEUTILISATEUR => 8, ReservationTableMap::COL_NUMERODERESERVATION => 9, ReservationTableMap::COL_ETAT => 10, ),
        self::TYPE_FIELDNAME     => array('codeReservation' => 0, 'dateDebutReservation' => 1, 'dateFinReservation' => 2, 'dateReservation' => 3, 'volumeEstime' => 4, 'codeDevis' => 5, 'codeVilleMiseDisposition' => 6, 'codeVilleRendre' => 7, 'codeUtilisateur' => 8, 'numeroDeReservation' => 9, 'etat' => 10, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Codereservation' => 'CODERESERVATION',
        'Reservation.Codereservation' => 'CODERESERVATION',
        'codereservation' => 'CODERESERVATION',
        'reservation.codereservation' => 'CODERESERVATION',
        'ReservationTableMap::COL_CODERESERVATION' => 'CODERESERVATION',
        'COL_CODERESERVATION' => 'CODERESERVATION',
        'codeReservation' => 'CODERESERVATION',
        'reservation.codeReservation' => 'CODERESERVATION',
        'Datedebutreservation' => 'DATEDEBUTRESERVATION',
        'Reservation.Datedebutreservation' => 'DATEDEBUTRESERVATION',
        'datedebutreservation' => 'DATEDEBUTRESERVATION',
        'reservation.datedebutreservation' => 'DATEDEBUTRESERVATION',
        'ReservationTableMap::COL_DATEDEBUTRESERVATION' => 'DATEDEBUTRESERVATION',
        'COL_DATEDEBUTRESERVATION' => 'DATEDEBUTRESERVATION',
        'dateDebutReservation' => 'DATEDEBUTRESERVATION',
        'reservation.dateDebutReservation' => 'DATEDEBUTRESERVATION',
        'Datefinreservation' => 'DATEFINRESERVATION',
        'Reservation.Datefinreservation' => 'DATEFINRESERVATION',
        'datefinreservation' => 'DATEFINRESERVATION',
        'reservation.datefinreservation' => 'DATEFINRESERVATION',
        'ReservationTableMap::COL_DATEFINRESERVATION' => 'DATEFINRESERVATION',
        'COL_DATEFINRESERVATION' => 'DATEFINRESERVATION',
        'dateFinReservation' => 'DATEFINRESERVATION',
        'reservation.dateFinReservation' => 'DATEFINRESERVATION',
        'Datereservation' => 'DATERESERVATION',
        'Reservation.Datereservation' => 'DATERESERVATION',
        'datereservation' => 'DATERESERVATION',
        'reservation.datereservation' => 'DATERESERVATION',
        'ReservationTableMap::COL_DATERESERVATION' => 'DATERESERVATION',
        'COL_DATERESERVATION' => 'DATERESERVATION',
        'dateReservation' => 'DATERESERVATION',
        'reservation.dateReservation' => 'DATERESERVATION',
        'Volumeestime' => 'VOLUMEESTIME',
        'Reservation.Volumeestime' => 'VOLUMEESTIME',
        'volumeestime' => 'VOLUMEESTIME',
        'reservation.volumeestime' => 'VOLUMEESTIME',
        'ReservationTableMap::COL_VOLUMEESTIME' => 'VOLUMEESTIME',
        'COL_VOLUMEESTIME' => 'VOLUMEESTIME',
        'volumeEstime' => 'VOLUMEESTIME',
        'reservation.volumeEstime' => 'VOLUMEESTIME',
        'Codedevis' => 'CODEDEVIS',
        'Reservation.Codedevis' => 'CODEDEVIS',
        'codedevis' => 'CODEDEVIS',
        'reservation.codedevis' => 'CODEDEVIS',
        'ReservationTableMap::COL_CODEDEVIS' => 'CODEDEVIS',
        'COL_CODEDEVIS' => 'CODEDEVIS',
        'codeDevis' => 'CODEDEVIS',
        'reservation.codeDevis' => 'CODEDEVIS',
        'Codevillemisedisposition' => 'CODEVILLEMISEDISPOSITION',
        'Reservation.Codevillemisedisposition' => 'CODEVILLEMISEDISPOSITION',
        'codevillemisedisposition' => 'CODEVILLEMISEDISPOSITION',
        'reservation.codevillemisedisposition' => 'CODEVILLEMISEDISPOSITION',
        'ReservationTableMap::COL_CODEVILLEMISEDISPOSITION' => 'CODEVILLEMISEDISPOSITION',
        'COL_CODEVILLEMISEDISPOSITION' => 'CODEVILLEMISEDISPOSITION',
        'codeVilleMiseDisposition' => 'CODEVILLEMISEDISPOSITION',
        'reservation.codeVilleMiseDisposition' => 'CODEVILLEMISEDISPOSITION',
        'Codevillerendre' => 'CODEVILLERENDRE',
        'Reservation.Codevillerendre' => 'CODEVILLERENDRE',
        'codevillerendre' => 'CODEVILLERENDRE',
        'reservation.codevillerendre' => 'CODEVILLERENDRE',
        'ReservationTableMap::COL_CODEVILLERENDRE' => 'CODEVILLERENDRE',
        'COL_CODEVILLERENDRE' => 'CODEVILLERENDRE',
        'codeVilleRendre' => 'CODEVILLERENDRE',
        'reservation.codeVilleRendre' => 'CODEVILLERENDRE',
        'Codeutilisateur' => 'CODEUTILISATEUR',
        'Reservation.Codeutilisateur' => 'CODEUTILISATEUR',
        'codeutilisateur' => 'CODEUTILISATEUR',
        'reservation.codeutilisateur' => 'CODEUTILISATEUR',
        'ReservationTableMap::COL_CODEUTILISATEUR' => 'CODEUTILISATEUR',
        'COL_CODEUTILISATEUR' => 'CODEUTILISATEUR',
        'codeUtilisateur' => 'CODEUTILISATEUR',
        'reservation.codeUtilisateur' => 'CODEUTILISATEUR',
        'Numerodereservation' => 'NUMERODERESERVATION',
        'Reservation.Numerodereservation' => 'NUMERODERESERVATION',
        'numerodereservation' => 'NUMERODERESERVATION',
        'reservation.numerodereservation' => 'NUMERODERESERVATION',
        'ReservationTableMap::COL_NUMERODERESERVATION' => 'NUMERODERESERVATION',
        'COL_NUMERODERESERVATION' => 'NUMERODERESERVATION',
        'numeroDeReservation' => 'NUMERODERESERVATION',
        'reservation.numeroDeReservation' => 'NUMERODERESERVATION',
        'Etat' => 'ETAT',
        'Reservation.Etat' => 'ETAT',
        'etat' => 'ETAT',
        'reservation.etat' => 'ETAT',
        'ReservationTableMap::COL_ETAT' => 'ETAT',
        'COL_ETAT' => 'ETAT',
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
        $this->setName('reservation');
        $this->setPhpName('Reservation');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Http\\Model\\Reservation');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('codeReservation', 'Codereservation', 'INTEGER', true, null, null);
        $this->addColumn('dateDebutReservation', 'Datedebutreservation', 'BIGINT', false, null, null);
        $this->addColumn('dateFinReservation', 'Datefinreservation', 'BIGINT', false, null, null);
        $this->addColumn('dateReservation', 'Datereservation', 'BIGINT', false, null, null);
        $this->addColumn('volumeEstime', 'Volumeestime', 'DECIMAL', false, 4, null);
        $this->addForeignKey('codeDevis', 'Codedevis', 'SMALLINT', 'devis', 'codeDevis', false, null, null);
        $this->addForeignKey('codeVilleMiseDisposition', 'Codevillemisedisposition', 'SMALLINT', 'ville', 'codeVille', true, null, null);
        $this->addForeignKey('codeVilleRendre', 'Codevillerendre', 'SMALLINT', 'ville', 'codeVille', true, null, null);
        $this->addForeignKey('codeUtilisateur', 'Codeutilisateur', 'SMALLINT', 'utilisateur', 'code', true, null, null);
        $this->addColumn('numeroDeReservation', 'Numerodereservation', 'INTEGER', false, null, null);
        $this->addColumn('etat', 'Etat', 'CHAR', true, null, 'enCours');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('VilleRelatedByCodevillemisedisposition', '\\App\\Http\\Model\\Ville', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':codeVilleMiseDisposition',
    1 => ':codeVille',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('VilleRelatedByCodevillerendre', '\\App\\Http\\Model\\Ville', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':codeVilleRendre',
    1 => ':codeVille',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('Utilisateur', '\\App\\Http\\Model\\Utilisateur', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':codeUtilisateur',
    1 => ':code',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('Devis', '\\App\\Http\\Model\\Devis', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':codeDevis',
    1 => ':codeDevis',
  ),
), 'SET NULL', null, null, false);
        $this->addRelation('Reserver', '\\App\\Http\\Model\\Reserver', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':codeReservation',
    1 => ':codeReservation',
  ),
), 'CASCADE', 'CASCADE', 'Reservers', false);
    } // buildRelations()

    /**
     * Method to invalidate the instance pool of all tables related to reservation     * by a foreign key with ON DELETE CASCADE
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codereservation', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codereservation', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codereservation', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codereservation', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codereservation', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Codereservation', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('Codereservation', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ReservationTableMap::CLASS_DEFAULT : ReservationTableMap::OM_CLASS;
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
     * @return array           (Reservation object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ReservationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ReservationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ReservationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ReservationTableMap::OM_CLASS;
            /** @var Reservation $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ReservationTableMap::addInstanceToPool($obj, $key);
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
            $key = ReservationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ReservationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Reservation $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ReservationTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ReservationTableMap::COL_CODERESERVATION);
            $criteria->addSelectColumn(ReservationTableMap::COL_DATEDEBUTRESERVATION);
            $criteria->addSelectColumn(ReservationTableMap::COL_DATEFINRESERVATION);
            $criteria->addSelectColumn(ReservationTableMap::COL_DATERESERVATION);
            $criteria->addSelectColumn(ReservationTableMap::COL_VOLUMEESTIME);
            $criteria->addSelectColumn(ReservationTableMap::COL_CODEDEVIS);
            $criteria->addSelectColumn(ReservationTableMap::COL_CODEVILLEMISEDISPOSITION);
            $criteria->addSelectColumn(ReservationTableMap::COL_CODEVILLERENDRE);
            $criteria->addSelectColumn(ReservationTableMap::COL_CODEUTILISATEUR);
            $criteria->addSelectColumn(ReservationTableMap::COL_NUMERODERESERVATION);
            $criteria->addSelectColumn(ReservationTableMap::COL_ETAT);
        } else {
            $criteria->addSelectColumn($alias . '.codeReservation');
            $criteria->addSelectColumn($alias . '.dateDebutReservation');
            $criteria->addSelectColumn($alias . '.dateFinReservation');
            $criteria->addSelectColumn($alias . '.dateReservation');
            $criteria->addSelectColumn($alias . '.volumeEstime');
            $criteria->addSelectColumn($alias . '.codeDevis');
            $criteria->addSelectColumn($alias . '.codeVilleMiseDisposition');
            $criteria->addSelectColumn($alias . '.codeVilleRendre');
            $criteria->addSelectColumn($alias . '.codeUtilisateur');
            $criteria->addSelectColumn($alias . '.numeroDeReservation');
            $criteria->addSelectColumn($alias . '.etat');
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
            $criteria->removeSelectColumn(ReservationTableMap::COL_CODERESERVATION);
            $criteria->removeSelectColumn(ReservationTableMap::COL_DATEDEBUTRESERVATION);
            $criteria->removeSelectColumn(ReservationTableMap::COL_DATEFINRESERVATION);
            $criteria->removeSelectColumn(ReservationTableMap::COL_DATERESERVATION);
            $criteria->removeSelectColumn(ReservationTableMap::COL_VOLUMEESTIME);
            $criteria->removeSelectColumn(ReservationTableMap::COL_CODEDEVIS);
            $criteria->removeSelectColumn(ReservationTableMap::COL_CODEVILLEMISEDISPOSITION);
            $criteria->removeSelectColumn(ReservationTableMap::COL_CODEVILLERENDRE);
            $criteria->removeSelectColumn(ReservationTableMap::COL_CODEUTILISATEUR);
            $criteria->removeSelectColumn(ReservationTableMap::COL_NUMERODERESERVATION);
            $criteria->removeSelectColumn(ReservationTableMap::COL_ETAT);
        } else {
            $criteria->removeSelectColumn($alias . '.codeReservation');
            $criteria->removeSelectColumn($alias . '.dateDebutReservation');
            $criteria->removeSelectColumn($alias . '.dateFinReservation');
            $criteria->removeSelectColumn($alias . '.dateReservation');
            $criteria->removeSelectColumn($alias . '.volumeEstime');
            $criteria->removeSelectColumn($alias . '.codeDevis');
            $criteria->removeSelectColumn($alias . '.codeVilleMiseDisposition');
            $criteria->removeSelectColumn($alias . '.codeVilleRendre');
            $criteria->removeSelectColumn($alias . '.codeUtilisateur');
            $criteria->removeSelectColumn($alias . '.numeroDeReservation');
            $criteria->removeSelectColumn($alias . '.etat');
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
        return Propel::getServiceContainer()->getDatabaseMap(ReservationTableMap::DATABASE_NAME)->getTable(ReservationTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Reservation or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Reservation object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ReservationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Http\Model\Reservation) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ReservationTableMap::DATABASE_NAME);
            $criteria->add(ReservationTableMap::COL_CODERESERVATION, (array) $values, Criteria::IN);
        }

        $query = ReservationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ReservationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ReservationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the reservation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ReservationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Reservation or Criteria object.
     *
     * @param mixed               $criteria Criteria or Reservation object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReservationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Reservation object
        }

        if ($criteria->containsKey(ReservationTableMap::COL_CODERESERVATION) && $criteria->keyContainsValue(ReservationTableMap::COL_CODERESERVATION) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ReservationTableMap::COL_CODERESERVATION.')');
        }


        // Set the correct dbName
        $query = ReservationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ReservationTableMap
