<?php

namespace App\Http\Model\Base;

use \Exception;
use \PDO;
use App\Http\Model\Devis as ChildDevis;
use App\Http\Model\DevisQuery as ChildDevisQuery;
use App\Http\Model\Reservation as ChildReservation;
use App\Http\Model\ReservationQuery as ChildReservationQuery;
use App\Http\Model\Reserver as ChildReserver;
use App\Http\Model\ReserverQuery as ChildReserverQuery;
use App\Http\Model\Utilisateur as ChildUtilisateur;
use App\Http\Model\UtilisateurQuery as ChildUtilisateurQuery;
use App\Http\Model\Ville as ChildVille;
use App\Http\Model\VilleQuery as ChildVilleQuery;
use App\Http\Model\Map\ReservationTableMap;
use App\Http\Model\Map\ReserverTableMap;
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

/**
 * Base class that represents a row from the 'reservation' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Reservation implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\App\\Http\\Model\\Map\\ReservationTableMap';


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
     * The value for the codereservation field.
     *
     * @var        int
     */
    protected $codereservation;

    /**
     * The value for the datedebutreservation field.
     *
     * @var        string|null
     */
    protected $datedebutreservation;

    /**
     * The value for the datefinreservation field.
     *
     * @var        string|null
     */
    protected $datefinreservation;

    /**
     * The value for the datereservation field.
     *
     * @var        string|null
     */
    protected $datereservation;

    /**
     * The value for the volumeestime field.
     *
     * @var        string|null
     */
    protected $volumeestime;

    /**
     * The value for the codedevis field.
     *
     * @var        int|null
     */
    protected $codedevis;

    /**
     * The value for the codevillemisedisposition field.
     *
     * @var        int
     */
    protected $codevillemisedisposition;

    /**
     * The value for the codevillerendre field.
     *
     * @var        int
     */
    protected $codevillerendre;

    /**
     * The value for the codeutilisateur field.
     *
     * @var        int
     */
    protected $codeutilisateur;

    /**
     * The value for the numerodereservation field.
     *
     * @var        int|null
     */
    protected $numerodereservation;

    /**
     * The value for the etat field.
     *
     * Note: this column has a database default value of: 'enCours'
     * @var        string
     */
    protected $etat;

    /**
     * @var        ChildVille
     */
    protected $aVilleRelatedByCodevillemisedisposition;

    /**
     * @var        ChildVille
     */
    protected $aVilleRelatedByCodevillerendre;

    /**
     * @var        ChildUtilisateur
     */
    protected $aUtilisateur;

    /**
     * @var        ChildDevis
     */
    protected $aDevis;

    /**
     * @var        ObjectCollection|ChildReserver[] Collection to store aggregation of ChildReserver objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildReserver> Collection to store aggregation of ChildReserver objects.
     */
    protected $collReservers;
    protected $collReserversPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildReserver[]
     * @phpstan-var ObjectCollection&\Traversable<ChildReserver>
     */
    protected $reserversScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->etat = 'enCours';
    }

    /**
     * Initializes internal state of App\Http\Model\Base\Reservation object.
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
     * Compares this with another <code>Reservation</code> instance.  If
     * <code>obj</code> is an instance of <code>Reservation</code>, delegates to
     * <code>equals(Reservation)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [codereservation] column value.
     *
     * @return int
     */
    public function getCodereservation()
    {
        return $this->codereservation;
    }

    /**
     * Get the [datedebutreservation] column value.
     *
     * @return string|null
     */
    public function getDatedebutreservation()
    {
        return $this->datedebutreservation;
    }

    /**
     * Get the [datefinreservation] column value.
     *
     * @return string|null
     */
    public function getDatefinreservation()
    {
        return $this->datefinreservation;
    }

    /**
     * Get the [datereservation] column value.
     *
     * @return string|null
     */
    public function getDatereservation()
    {
        return $this->datereservation;
    }

    /**
     * Get the [volumeestime] column value.
     *
     * @return string|null
     */
    public function getVolumeestime()
    {
        return $this->volumeestime;
    }

    /**
     * Get the [codedevis] column value.
     *
     * @return int|null
     */
    public function getCodedevis()
    {
        return $this->codedevis;
    }

    /**
     * Get the [codevillemisedisposition] column value.
     *
     * @return int
     */
    public function getCodevillemisedisposition()
    {
        return $this->codevillemisedisposition;
    }

    /**
     * Get the [codevillerendre] column value.
     *
     * @return int
     */
    public function getCodevillerendre()
    {
        return $this->codevillerendre;
    }

    /**
     * Get the [codeutilisateur] column value.
     *
     * @return int
     */
    public function getCodeutilisateur()
    {
        return $this->codeutilisateur;
    }

    /**
     * Get the [numerodereservation] column value.
     *
     * @return int|null
     */
    public function getNumerodereservation()
    {
        return $this->numerodereservation;
    }

    /**
     * Get the [etat] column value.
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set the value of [codereservation] column.
     *
     * @param int $v New value
     * @return $this|\App\Http\Model\Reservation The current object (for fluent API support)
     */
    public function setCodereservation($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->codereservation !== $v) {
            $this->codereservation = $v;
            $this->modifiedColumns[ReservationTableMap::COL_CODERESERVATION] = true;
        }

        return $this;
    } // setCodereservation()

    /**
     * Set the value of [datedebutreservation] column.
     *
     * @param string|null $v New value
     * @return $this|\App\Http\Model\Reservation The current object (for fluent API support)
     */
    public function setDatedebutreservation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->datedebutreservation !== $v) {
            $this->datedebutreservation = $v;
            $this->modifiedColumns[ReservationTableMap::COL_DATEDEBUTRESERVATION] = true;
        }

        return $this;
    } // setDatedebutreservation()

    /**
     * Set the value of [datefinreservation] column.
     *
     * @param string|null $v New value
     * @return $this|\App\Http\Model\Reservation The current object (for fluent API support)
     */
    public function setDatefinreservation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->datefinreservation !== $v) {
            $this->datefinreservation = $v;
            $this->modifiedColumns[ReservationTableMap::COL_DATEFINRESERVATION] = true;
        }

        return $this;
    } // setDatefinreservation()

    /**
     * Set the value of [datereservation] column.
     *
     * @param string|null $v New value
     * @return $this|\App\Http\Model\Reservation The current object (for fluent API support)
     */
    public function setDatereservation($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->datereservation !== $v) {
            $this->datereservation = $v;
            $this->modifiedColumns[ReservationTableMap::COL_DATERESERVATION] = true;
        }

        return $this;
    } // setDatereservation()

    /**
     * Set the value of [volumeestime] column.
     *
     * @param string|null $v New value
     * @return $this|\App\Http\Model\Reservation The current object (for fluent API support)
     */
    public function setVolumeestime($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->volumeestime !== $v) {
            $this->volumeestime = $v;
            $this->modifiedColumns[ReservationTableMap::COL_VOLUMEESTIME] = true;
        }

        return $this;
    } // setVolumeestime()

    /**
     * Set the value of [codedevis] column.
     *
     * @param int|null $v New value
     * @return $this|\App\Http\Model\Reservation The current object (for fluent API support)
     */
    public function setCodedevis($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->codedevis !== $v) {
            $this->codedevis = $v;
            $this->modifiedColumns[ReservationTableMap::COL_CODEDEVIS] = true;
        }

        if ($this->aDevis !== null && $this->aDevis->getCodedevis() !== $v) {
            $this->aDevis = null;
        }

        return $this;
    } // setCodedevis()

    /**
     * Set the value of [codevillemisedisposition] column.
     *
     * @param int $v New value
     * @return $this|\App\Http\Model\Reservation The current object (for fluent API support)
     */
    public function setCodevillemisedisposition($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->codevillemisedisposition !== $v) {
            $this->codevillemisedisposition = $v;
            $this->modifiedColumns[ReservationTableMap::COL_CODEVILLEMISEDISPOSITION] = true;
        }

        if ($this->aVilleRelatedByCodevillemisedisposition !== null && $this->aVilleRelatedByCodevillemisedisposition->getCodeville() !== $v) {
            $this->aVilleRelatedByCodevillemisedisposition = null;
        }

        return $this;
    } // setCodevillemisedisposition()

    /**
     * Set the value of [codevillerendre] column.
     *
     * @param int $v New value
     * @return $this|\App\Http\Model\Reservation The current object (for fluent API support)
     */
    public function setCodevillerendre($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->codevillerendre !== $v) {
            $this->codevillerendre = $v;
            $this->modifiedColumns[ReservationTableMap::COL_CODEVILLERENDRE] = true;
        }

        if ($this->aVilleRelatedByCodevillerendre !== null && $this->aVilleRelatedByCodevillerendre->getCodeville() !== $v) {
            $this->aVilleRelatedByCodevillerendre = null;
        }

        return $this;
    } // setCodevillerendre()

    /**
     * Set the value of [codeutilisateur] column.
     *
     * @param int $v New value
     * @return $this|\App\Http\Model\Reservation The current object (for fluent API support)
     */
    public function setCodeutilisateur($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->codeutilisateur !== $v) {
            $this->codeutilisateur = $v;
            $this->modifiedColumns[ReservationTableMap::COL_CODEUTILISATEUR] = true;
        }

        if ($this->aUtilisateur !== null && $this->aUtilisateur->getCode() !== $v) {
            $this->aUtilisateur = null;
        }

        return $this;
    } // setCodeutilisateur()

    /**
     * Set the value of [numerodereservation] column.
     *
     * @param int|null $v New value
     * @return $this|\App\Http\Model\Reservation The current object (for fluent API support)
     */
    public function setNumerodereservation($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->numerodereservation !== $v) {
            $this->numerodereservation = $v;
            $this->modifiedColumns[ReservationTableMap::COL_NUMERODERESERVATION] = true;
        }

        return $this;
    } // setNumerodereservation()

    /**
     * Set the value of [etat] column.
     *
     * @param string $v New value
     * @return $this|\App\Http\Model\Reservation The current object (for fluent API support)
     */
    public function setEtat($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->etat !== $v) {
            $this->etat = $v;
            $this->modifiedColumns[ReservationTableMap::COL_ETAT] = true;
        }

        return $this;
    } // setEtat()

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
            if ($this->etat !== 'enCours') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ReservationTableMap::translateFieldName('Codereservation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codereservation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ReservationTableMap::translateFieldName('Datedebutreservation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->datedebutreservation = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ReservationTableMap::translateFieldName('Datefinreservation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->datefinreservation = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ReservationTableMap::translateFieldName('Datereservation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->datereservation = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ReservationTableMap::translateFieldName('Volumeestime', TableMap::TYPE_PHPNAME, $indexType)];
            $this->volumeestime = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ReservationTableMap::translateFieldName('Codedevis', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codedevis = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ReservationTableMap::translateFieldName('Codevillemisedisposition', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codevillemisedisposition = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ReservationTableMap::translateFieldName('Codevillerendre', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codevillerendre = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : ReservationTableMap::translateFieldName('Codeutilisateur', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codeutilisateur = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : ReservationTableMap::translateFieldName('Numerodereservation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->numerodereservation = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : ReservationTableMap::translateFieldName('Etat', TableMap::TYPE_PHPNAME, $indexType)];
            $this->etat = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 11; // 11 = ReservationTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Http\\Model\\Reservation'), 0, $e);
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
        if ($this->aDevis !== null && $this->codedevis !== $this->aDevis->getCodedevis()) {
            $this->aDevis = null;
        }
        if ($this->aVilleRelatedByCodevillemisedisposition !== null && $this->codevillemisedisposition !== $this->aVilleRelatedByCodevillemisedisposition->getCodeville()) {
            $this->aVilleRelatedByCodevillemisedisposition = null;
        }
        if ($this->aVilleRelatedByCodevillerendre !== null && $this->codevillerendre !== $this->aVilleRelatedByCodevillerendre->getCodeville()) {
            $this->aVilleRelatedByCodevillerendre = null;
        }
        if ($this->aUtilisateur !== null && $this->codeutilisateur !== $this->aUtilisateur->getCode()) {
            $this->aUtilisateur = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(ReservationTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildReservationQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aVilleRelatedByCodevillemisedisposition = null;
            $this->aVilleRelatedByCodevillerendre = null;
            $this->aUtilisateur = null;
            $this->aDevis = null;
            $this->collReservers = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Reservation::setDeleted()
     * @see Reservation::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReservationTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildReservationQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ReservationTableMap::DATABASE_NAME);
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
                ReservationTableMap::addInstanceToPool($this);
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

            if ($this->aVilleRelatedByCodevillemisedisposition !== null) {
                if ($this->aVilleRelatedByCodevillemisedisposition->isModified() || $this->aVilleRelatedByCodevillemisedisposition->isNew()) {
                    $affectedRows += $this->aVilleRelatedByCodevillemisedisposition->save($con);
                }
                $this->setVilleRelatedByCodevillemisedisposition($this->aVilleRelatedByCodevillemisedisposition);
            }

            if ($this->aVilleRelatedByCodevillerendre !== null) {
                if ($this->aVilleRelatedByCodevillerendre->isModified() || $this->aVilleRelatedByCodevillerendre->isNew()) {
                    $affectedRows += $this->aVilleRelatedByCodevillerendre->save($con);
                }
                $this->setVilleRelatedByCodevillerendre($this->aVilleRelatedByCodevillerendre);
            }

            if ($this->aUtilisateur !== null) {
                if ($this->aUtilisateur->isModified() || $this->aUtilisateur->isNew()) {
                    $affectedRows += $this->aUtilisateur->save($con);
                }
                $this->setUtilisateur($this->aUtilisateur);
            }

            if ($this->aDevis !== null) {
                if ($this->aDevis->isModified() || $this->aDevis->isNew()) {
                    $affectedRows += $this->aDevis->save($con);
                }
                $this->setDevis($this->aDevis);
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

            if ($this->reserversScheduledForDeletion !== null) {
                if (!$this->reserversScheduledForDeletion->isEmpty()) {
                    \App\Http\Model\ReserverQuery::create()
                        ->filterByPrimaryKeys($this->reserversScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->reserversScheduledForDeletion = null;
                }
            }

            if ($this->collReservers !== null) {
                foreach ($this->collReservers as $referrerFK) {
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

        $this->modifiedColumns[ReservationTableMap::COL_CODERESERVATION] = true;
        if (null !== $this->codereservation) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ReservationTableMap::COL_CODERESERVATION . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ReservationTableMap::COL_CODERESERVATION)) {
            $modifiedColumns[':p' . $index++]  = 'codeReservation';
        }
        if ($this->isColumnModified(ReservationTableMap::COL_DATEDEBUTRESERVATION)) {
            $modifiedColumns[':p' . $index++]  = 'dateDebutReservation';
        }
        if ($this->isColumnModified(ReservationTableMap::COL_DATEFINRESERVATION)) {
            $modifiedColumns[':p' . $index++]  = 'dateFinReservation';
        }
        if ($this->isColumnModified(ReservationTableMap::COL_DATERESERVATION)) {
            $modifiedColumns[':p' . $index++]  = 'dateReservation';
        }
        if ($this->isColumnModified(ReservationTableMap::COL_VOLUMEESTIME)) {
            $modifiedColumns[':p' . $index++]  = 'volumeEstime';
        }
        if ($this->isColumnModified(ReservationTableMap::COL_CODEDEVIS)) {
            $modifiedColumns[':p' . $index++]  = 'codeDevis';
        }
        if ($this->isColumnModified(ReservationTableMap::COL_CODEVILLEMISEDISPOSITION)) {
            $modifiedColumns[':p' . $index++]  = 'codeVilleMiseDisposition';
        }
        if ($this->isColumnModified(ReservationTableMap::COL_CODEVILLERENDRE)) {
            $modifiedColumns[':p' . $index++]  = 'codeVilleRendre';
        }
        if ($this->isColumnModified(ReservationTableMap::COL_CODEUTILISATEUR)) {
            $modifiedColumns[':p' . $index++]  = 'codeUtilisateur';
        }
        if ($this->isColumnModified(ReservationTableMap::COL_NUMERODERESERVATION)) {
            $modifiedColumns[':p' . $index++]  = 'numeroDeReservation';
        }
        if ($this->isColumnModified(ReservationTableMap::COL_ETAT)) {
            $modifiedColumns[':p' . $index++]  = 'etat';
        }

        $sql = sprintf(
            'INSERT INTO reservation (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'codeReservation':
                        $stmt->bindValue($identifier, $this->codereservation, PDO::PARAM_INT);
                        break;
                    case 'dateDebutReservation':
                        $stmt->bindValue($identifier, $this->datedebutreservation, PDO::PARAM_INT);
                        break;
                    case 'dateFinReservation':
                        $stmt->bindValue($identifier, $this->datefinreservation, PDO::PARAM_INT);
                        break;
                    case 'dateReservation':
                        $stmt->bindValue($identifier, $this->datereservation, PDO::PARAM_INT);
                        break;
                    case 'volumeEstime':
                        $stmt->bindValue($identifier, $this->volumeestime, PDO::PARAM_STR);
                        break;
                    case 'codeDevis':
                        $stmt->bindValue($identifier, $this->codedevis, PDO::PARAM_INT);
                        break;
                    case 'codeVilleMiseDisposition':
                        $stmt->bindValue($identifier, $this->codevillemisedisposition, PDO::PARAM_INT);
                        break;
                    case 'codeVilleRendre':
                        $stmt->bindValue($identifier, $this->codevillerendre, PDO::PARAM_INT);
                        break;
                    case 'codeUtilisateur':
                        $stmt->bindValue($identifier, $this->codeutilisateur, PDO::PARAM_INT);
                        break;
                    case 'numeroDeReservation':
                        $stmt->bindValue($identifier, $this->numerodereservation, PDO::PARAM_INT);
                        break;
                    case 'etat':
                        $stmt->bindValue($identifier, $this->etat, PDO::PARAM_STR);
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
        $this->setCodereservation($pk);

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
        $pos = ReservationTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getCodereservation();
                break;
            case 1:
                return $this->getDatedebutreservation();
                break;
            case 2:
                return $this->getDatefinreservation();
                break;
            case 3:
                return $this->getDatereservation();
                break;
            case 4:
                return $this->getVolumeestime();
                break;
            case 5:
                return $this->getCodedevis();
                break;
            case 6:
                return $this->getCodevillemisedisposition();
                break;
            case 7:
                return $this->getCodevillerendre();
                break;
            case 8:
                return $this->getCodeutilisateur();
                break;
            case 9:
                return $this->getNumerodereservation();
                break;
            case 10:
                return $this->getEtat();
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

        if (isset($alreadyDumpedObjects['Reservation'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Reservation'][$this->hashCode()] = true;
        $keys = ReservationTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getCodereservation(),
            $keys[1] => $this->getDatedebutreservation(),
            $keys[2] => $this->getDatefinreservation(),
            $keys[3] => $this->getDatereservation(),
            $keys[4] => $this->getVolumeestime(),
            $keys[5] => $this->getCodedevis(),
            $keys[6] => $this->getCodevillemisedisposition(),
            $keys[7] => $this->getCodevillerendre(),
            $keys[8] => $this->getCodeutilisateur(),
            $keys[9] => $this->getNumerodereservation(),
            $keys[10] => $this->getEtat(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aVilleRelatedByCodevillemisedisposition) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ville';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ville';
                        break;
                    default:
                        $key = 'Ville';
                }

                $result[$key] = $this->aVilleRelatedByCodevillemisedisposition->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aVilleRelatedByCodevillerendre) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'ville';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'ville';
                        break;
                    default:
                        $key = 'Ville';
                }

                $result[$key] = $this->aVilleRelatedByCodevillerendre->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUtilisateur) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'utilisateur';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'utilisateur';
                        break;
                    default:
                        $key = 'Utilisateur';
                }

                $result[$key] = $this->aUtilisateur->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aDevis) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'devis';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'devis';
                        break;
                    default:
                        $key = 'Devis';
                }

                $result[$key] = $this->aDevis->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collReservers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'reservers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'reservers';
                        break;
                    default:
                        $key = 'Reservers';
                }

                $result[$key] = $this->collReservers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\App\Http\Model\Reservation
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ReservationTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\App\Http\Model\Reservation
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setCodereservation($value);
                break;
            case 1:
                $this->setDatedebutreservation($value);
                break;
            case 2:
                $this->setDatefinreservation($value);
                break;
            case 3:
                $this->setDatereservation($value);
                break;
            case 4:
                $this->setVolumeestime($value);
                break;
            case 5:
                $this->setCodedevis($value);
                break;
            case 6:
                $this->setCodevillemisedisposition($value);
                break;
            case 7:
                $this->setCodevillerendre($value);
                break;
            case 8:
                $this->setCodeutilisateur($value);
                break;
            case 9:
                $this->setNumerodereservation($value);
                break;
            case 10:
                $this->setEtat($value);
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
     * @return     $this|\App\Http\Model\Reservation
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = ReservationTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setCodereservation($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setDatedebutreservation($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setDatefinreservation($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDatereservation($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setVolumeestime($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCodedevis($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCodevillemisedisposition($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setCodevillerendre($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCodeutilisateur($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setNumerodereservation($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setEtat($arr[$keys[10]]);
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
     * @return $this|\App\Http\Model\Reservation The current object, for fluid interface
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
        $criteria = new Criteria(ReservationTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ReservationTableMap::COL_CODERESERVATION)) {
            $criteria->add(ReservationTableMap::COL_CODERESERVATION, $this->codereservation);
        }
        if ($this->isColumnModified(ReservationTableMap::COL_DATEDEBUTRESERVATION)) {
            $criteria->add(ReservationTableMap::COL_DATEDEBUTRESERVATION, $this->datedebutreservation);
        }
        if ($this->isColumnModified(ReservationTableMap::COL_DATEFINRESERVATION)) {
            $criteria->add(ReservationTableMap::COL_DATEFINRESERVATION, $this->datefinreservation);
        }
        if ($this->isColumnModified(ReservationTableMap::COL_DATERESERVATION)) {
            $criteria->add(ReservationTableMap::COL_DATERESERVATION, $this->datereservation);
        }
        if ($this->isColumnModified(ReservationTableMap::COL_VOLUMEESTIME)) {
            $criteria->add(ReservationTableMap::COL_VOLUMEESTIME, $this->volumeestime);
        }
        if ($this->isColumnModified(ReservationTableMap::COL_CODEDEVIS)) {
            $criteria->add(ReservationTableMap::COL_CODEDEVIS, $this->codedevis);
        }
        if ($this->isColumnModified(ReservationTableMap::COL_CODEVILLEMISEDISPOSITION)) {
            $criteria->add(ReservationTableMap::COL_CODEVILLEMISEDISPOSITION, $this->codevillemisedisposition);
        }
        if ($this->isColumnModified(ReservationTableMap::COL_CODEVILLERENDRE)) {
            $criteria->add(ReservationTableMap::COL_CODEVILLERENDRE, $this->codevillerendre);
        }
        if ($this->isColumnModified(ReservationTableMap::COL_CODEUTILISATEUR)) {
            $criteria->add(ReservationTableMap::COL_CODEUTILISATEUR, $this->codeutilisateur);
        }
        if ($this->isColumnModified(ReservationTableMap::COL_NUMERODERESERVATION)) {
            $criteria->add(ReservationTableMap::COL_NUMERODERESERVATION, $this->numerodereservation);
        }
        if ($this->isColumnModified(ReservationTableMap::COL_ETAT)) {
            $criteria->add(ReservationTableMap::COL_ETAT, $this->etat);
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
        $criteria = ChildReservationQuery::create();
        $criteria->add(ReservationTableMap::COL_CODERESERVATION, $this->codereservation);

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
        $validPk = null !== $this->getCodereservation();

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
        return $this->getCodereservation();
    }

    /**
     * Generic method to set the primary key (codereservation column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setCodereservation($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getCodereservation();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \App\Http\Model\Reservation (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setDatedebutreservation($this->getDatedebutreservation());
        $copyObj->setDatefinreservation($this->getDatefinreservation());
        $copyObj->setDatereservation($this->getDatereservation());
        $copyObj->setVolumeestime($this->getVolumeestime());
        $copyObj->setCodedevis($this->getCodedevis());
        $copyObj->setCodevillemisedisposition($this->getCodevillemisedisposition());
        $copyObj->setCodevillerendre($this->getCodevillerendre());
        $copyObj->setCodeutilisateur($this->getCodeutilisateur());
        $copyObj->setNumerodereservation($this->getNumerodereservation());
        $copyObj->setEtat($this->getEtat());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getReservers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addReserver($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setCodereservation(NULL); // this is a auto-increment column, so set to default value
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
     * @return \App\Http\Model\Reservation Clone of current object.
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
     * Declares an association between this object and a ChildVille object.
     *
     * @param  ChildVille $v
     * @return $this|\App\Http\Model\Reservation The current object (for fluent API support)
     * @throws PropelException
     */
    public function setVilleRelatedByCodevillemisedisposition(ChildVille $v = null)
    {
        if ($v === null) {
            $this->setCodevillemisedisposition(NULL);
        } else {
            $this->setCodevillemisedisposition($v->getCodeville());
        }

        $this->aVilleRelatedByCodevillemisedisposition = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildVille object, it will not be re-added.
        if ($v !== null) {
            $v->addReservationRelatedByCodevillemisedisposition($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildVille object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildVille The associated ChildVille object.
     * @throws PropelException
     */
    public function getVilleRelatedByCodevillemisedisposition(ConnectionInterface $con = null)
    {
        if ($this->aVilleRelatedByCodevillemisedisposition === null && ($this->codevillemisedisposition != 0)) {
            $this->aVilleRelatedByCodevillemisedisposition = ChildVilleQuery::create()->findPk($this->codevillemisedisposition, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aVilleRelatedByCodevillemisedisposition->addReservationsRelatedByCodevillemisedisposition($this);
             */
        }

        return $this->aVilleRelatedByCodevillemisedisposition;
    }

    /**
     * Declares an association between this object and a ChildVille object.
     *
     * @param  ChildVille $v
     * @return $this|\App\Http\Model\Reservation The current object (for fluent API support)
     * @throws PropelException
     */
    public function setVilleRelatedByCodevillerendre(ChildVille $v = null)
    {
        if ($v === null) {
            $this->setCodevillerendre(NULL);
        } else {
            $this->setCodevillerendre($v->getCodeville());
        }

        $this->aVilleRelatedByCodevillerendre = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildVille object, it will not be re-added.
        if ($v !== null) {
            $v->addReservationRelatedByCodevillerendre($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildVille object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildVille The associated ChildVille object.
     * @throws PropelException
     */
    public function getVilleRelatedByCodevillerendre(ConnectionInterface $con = null)
    {
        if ($this->aVilleRelatedByCodevillerendre === null && ($this->codevillerendre != 0)) {
            $this->aVilleRelatedByCodevillerendre = ChildVilleQuery::create()->findPk($this->codevillerendre, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aVilleRelatedByCodevillerendre->addReservationsRelatedByCodevillerendre($this);
             */
        }

        return $this->aVilleRelatedByCodevillerendre;
    }

    /**
     * Declares an association between this object and a ChildUtilisateur object.
     *
     * @param  ChildUtilisateur $v
     * @return $this|\App\Http\Model\Reservation The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUtilisateur(ChildUtilisateur $v = null)
    {
        if ($v === null) {
            $this->setCodeutilisateur(NULL);
        } else {
            $this->setCodeutilisateur($v->getCode());
        }

        $this->aUtilisateur = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUtilisateur object, it will not be re-added.
        if ($v !== null) {
            $v->addReservation($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUtilisateur object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUtilisateur The associated ChildUtilisateur object.
     * @throws PropelException
     */
    public function getUtilisateur(ConnectionInterface $con = null)
    {
        if ($this->aUtilisateur === null && ($this->codeutilisateur != 0)) {
            $this->aUtilisateur = ChildUtilisateurQuery::create()->findPk($this->codeutilisateur, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUtilisateur->addReservations($this);
             */
        }

        return $this->aUtilisateur;
    }

    /**
     * Declares an association between this object and a ChildDevis object.
     *
     * @param  ChildDevis|null $v
     * @return $this|\App\Http\Model\Reservation The current object (for fluent API support)
     * @throws PropelException
     */
    public function setDevis(ChildDevis $v = null)
    {
        if ($v === null) {
            $this->setCodedevis(NULL);
        } else {
            $this->setCodedevis($v->getCodedevis());
        }

        $this->aDevis = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildDevis object, it will not be re-added.
        if ($v !== null) {
            $v->addReservation($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildDevis object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildDevis|null The associated ChildDevis object.
     * @throws PropelException
     */
    public function getDevis(ConnectionInterface $con = null)
    {
        if ($this->aDevis === null && ($this->codedevis != 0)) {
            $this->aDevis = ChildDevisQuery::create()->findPk($this->codedevis, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aDevis->addReservations($this);
             */
        }

        return $this->aDevis;
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
        if ('Reserver' === $relationName) {
            $this->initReservers();
            return;
        }
    }

    /**
     * Clears out the collReservers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addReservers()
     */
    public function clearReservers()
    {
        $this->collReservers = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collReservers collection loaded partially.
     */
    public function resetPartialReservers($v = true)
    {
        $this->collReserversPartial = $v;
    }

    /**
     * Initializes the collReservers collection.
     *
     * By default this just sets the collReservers collection to an empty array (like clearcollReservers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initReservers($overrideExisting = true)
    {
        if (null !== $this->collReservers && !$overrideExisting) {
            return;
        }

        $collectionClassName = ReserverTableMap::getTableMap()->getCollectionClassName();

        $this->collReservers = new $collectionClassName;
        $this->collReservers->setModel('\App\Http\Model\Reserver');
    }

    /**
     * Gets an array of ChildReserver objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildReservation is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildReserver[] List of ChildReserver objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReserver> List of ChildReserver objects
     * @throws PropelException
     */
    public function getReservers(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collReserversPartial && !$this->isNew();
        if (null === $this->collReservers || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collReservers) {
                    $this->initReservers();
                } else {
                    $collectionClassName = ReserverTableMap::getTableMap()->getCollectionClassName();

                    $collReservers = new $collectionClassName;
                    $collReservers->setModel('\App\Http\Model\Reserver');

                    return $collReservers;
                }
            } else {
                $collReservers = ChildReserverQuery::create(null, $criteria)
                    ->filterByReservation($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collReserversPartial && count($collReservers)) {
                        $this->initReservers(false);

                        foreach ($collReservers as $obj) {
                            if (false == $this->collReservers->contains($obj)) {
                                $this->collReservers->append($obj);
                            }
                        }

                        $this->collReserversPartial = true;
                    }

                    return $collReservers;
                }

                if ($partial && $this->collReservers) {
                    foreach ($this->collReservers as $obj) {
                        if ($obj->isNew()) {
                            $collReservers[] = $obj;
                        }
                    }
                }

                $this->collReservers = $collReservers;
                $this->collReserversPartial = false;
            }
        }

        return $this->collReservers;
    }

    /**
     * Sets a collection of ChildReserver objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $reservers A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildReservation The current object (for fluent API support)
     */
    public function setReservers(Collection $reservers, ConnectionInterface $con = null)
    {
        /** @var ChildReserver[] $reserversToDelete */
        $reserversToDelete = $this->getReservers(new Criteria(), $con)->diff($reservers);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->reserversScheduledForDeletion = clone $reserversToDelete;

        foreach ($reserversToDelete as $reserverRemoved) {
            $reserverRemoved->setReservation(null);
        }

        $this->collReservers = null;
        foreach ($reservers as $reserver) {
            $this->addReserver($reserver);
        }

        $this->collReservers = $reservers;
        $this->collReserversPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Reserver objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Reserver objects.
     * @throws PropelException
     */
    public function countReservers(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collReserversPartial && !$this->isNew();
        if (null === $this->collReservers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collReservers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getReservers());
            }

            $query = ChildReserverQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByReservation($this)
                ->count($con);
        }

        return count($this->collReservers);
    }

    /**
     * Method called to associate a ChildReserver object to this object
     * through the ChildReserver foreign key attribute.
     *
     * @param  ChildReserver $l ChildReserver
     * @return $this|\App\Http\Model\Reservation The current object (for fluent API support)
     */
    public function addReserver(ChildReserver $l)
    {
        if ($this->collReservers === null) {
            $this->initReservers();
            $this->collReserversPartial = true;
        }

        if (!$this->collReservers->contains($l)) {
            $this->doAddReserver($l);

            if ($this->reserversScheduledForDeletion and $this->reserversScheduledForDeletion->contains($l)) {
                $this->reserversScheduledForDeletion->remove($this->reserversScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildReserver $reserver The ChildReserver object to add.
     */
    protected function doAddReserver(ChildReserver $reserver)
    {
        $this->collReservers[]= $reserver;
        $reserver->setReservation($this);
    }

    /**
     * @param  ChildReserver $reserver The ChildReserver object to remove.
     * @return $this|ChildReservation The current object (for fluent API support)
     */
    public function removeReserver(ChildReserver $reserver)
    {
        if ($this->getReservers()->contains($reserver)) {
            $pos = $this->collReservers->search($reserver);
            $this->collReservers->remove($pos);
            if (null === $this->reserversScheduledForDeletion) {
                $this->reserversScheduledForDeletion = clone $this->collReservers;
                $this->reserversScheduledForDeletion->clear();
            }
            $this->reserversScheduledForDeletion[]= clone $reserver;
            $reserver->setReservation(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Reservation is new, it will return
     * an empty collection; or if this Reservation has previously
     * been saved, it will retrieve related Reservers from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Reservation.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildReserver[] List of ChildReserver objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReserver}> List of ChildReserver objects
     */
    public function getReserversJoinTypecontainer(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildReserverQuery::create(null, $criteria);
        $query->joinWith('Typecontainer', $joinBehavior);

        return $this->getReservers($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aVilleRelatedByCodevillemisedisposition) {
            $this->aVilleRelatedByCodevillemisedisposition->removeReservationRelatedByCodevillemisedisposition($this);
        }
        if (null !== $this->aVilleRelatedByCodevillerendre) {
            $this->aVilleRelatedByCodevillerendre->removeReservationRelatedByCodevillerendre($this);
        }
        if (null !== $this->aUtilisateur) {
            $this->aUtilisateur->removeReservation($this);
        }
        if (null !== $this->aDevis) {
            $this->aDevis->removeReservation($this);
        }
        $this->codereservation = null;
        $this->datedebutreservation = null;
        $this->datefinreservation = null;
        $this->datereservation = null;
        $this->volumeestime = null;
        $this->codedevis = null;
        $this->codevillemisedisposition = null;
        $this->codevillerendre = null;
        $this->codeutilisateur = null;
        $this->numerodereservation = null;
        $this->etat = null;
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
            if ($this->collReservers) {
                foreach ($this->collReservers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collReservers = null;
        $this->aVilleRelatedByCodevillemisedisposition = null;
        $this->aVilleRelatedByCodevillerendre = null;
        $this->aUtilisateur = null;
        $this->aDevis = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ReservationTableMap::DEFAULT_STRING_FORMAT);
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
