<?php

namespace App\Http\Model\Base;

use \Exception;
use \PDO;
use App\Http\Model\Pays as ChildPays;
use App\Http\Model\PaysQuery as ChildPaysQuery;
use App\Http\Model\Reservation as ChildReservation;
use App\Http\Model\ReservationQuery as ChildReservationQuery;
use App\Http\Model\Utilisateur as ChildUtilisateur;
use App\Http\Model\UtilisateurQuery as ChildUtilisateurQuery;
use App\Http\Model\Map\ReservationTableMap;
use App\Http\Model\Map\UtilisateurTableMap;
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
 * Base class that represents a row from the 'utilisateur' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Utilisateur implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\App\\Http\\Model\\Map\\UtilisateurTableMap';


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
     * The value for the code field.
     *
     * @var        int
     */
    protected $code;

    /**
     * The value for the raisonsociale field.
     *
     * @var        string
     */
    protected $raisonsociale;

    /**
     * The value for the adresse field.
     *
     * @var        string
     */
    protected $adresse;

    /**
     * The value for the cp field.
     *
     * @var        string|null
     */
    protected $cp;

    /**
     * The value for the ville field.
     *
     * @var        string|null
     */
    protected $ville;

    /**
     * The value for the adrmel field.
     *
     * @var        string|null
     */
    protected $adrmel;

    /**
     * The value for the telephone field.
     *
     * @var        string|null
     */
    protected $telephone;

    /**
     * The value for the contact field.
     *
     * @var        string|null
     */
    protected $contact;

    /**
     * The value for the codepays field.
     *
     * @var        string
     */
    protected $codepays;

    /**
     * The value for the login field.
     *
     * @var        string
     */
    protected $login;

    /**
     * The value for the mdp field.
     *
     * @var        string
     */
    protected $mdp;

    /**
     * @var        ChildPays
     */
    protected $aPays;

    /**
     * @var        ObjectCollection|ChildReservation[] Collection to store aggregation of ChildReservation objects.
     * @phpstan-var ObjectCollection&\Traversable<ChildReservation> Collection to store aggregation of ChildReservation objects.
     */
    protected $collReservations;
    protected $collReservationsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildReservation[]
     * @phpstan-var ObjectCollection&\Traversable<ChildReservation>
     */
    protected $reservationsScheduledForDeletion = null;

    /**
     * Initializes internal state of App\Http\Model\Base\Utilisateur object.
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
     * Compares this with another <code>Utilisateur</code> instance.  If
     * <code>obj</code> is an instance of <code>Utilisateur</code>, delegates to
     * <code>equals(Utilisateur)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [code] column value.
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Get the [raisonsociale] column value.
     *
     * @return string
     */
    public function getRaisonsociale()
    {
        return $this->raisonsociale;
    }

    /**
     * Get the [adresse] column value.
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Get the [cp] column value.
     *
     * @return string|null
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Get the [ville] column value.
     *
     * @return string|null
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Get the [adrmel] column value.
     *
     * @return string|null
     */
    public function getAdrmel()
    {
        return $this->adrmel;
    }

    /**
     * Get the [telephone] column value.
     *
     * @return string|null
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Get the [contact] column value.
     *
     * @return string|null
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Get the [codepays] column value.
     *
     * @return string
     */
    public function getCodepays()
    {
        return $this->codepays;
    }

    /**
     * Get the [login] column value.
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Get the [mdp] column value.
     *
     * @return string
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * Set the value of [code] column.
     *
     * @param int $v New value
     * @return $this|\App\Http\Model\Utilisateur The current object (for fluent API support)
     */
    public function setCode($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->code !== $v) {
            $this->code = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_CODE] = true;
        }

        return $this;
    } // setCode()

    /**
     * Set the value of [raisonsociale] column.
     *
     * @param string $v New value
     * @return $this|\App\Http\Model\Utilisateur The current object (for fluent API support)
     */
    public function setRaisonsociale($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->raisonsociale !== $v) {
            $this->raisonsociale = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_RAISONSOCIALE] = true;
        }

        return $this;
    } // setRaisonsociale()

    /**
     * Set the value of [adresse] column.
     *
     * @param string $v New value
     * @return $this|\App\Http\Model\Utilisateur The current object (for fluent API support)
     */
    public function setAdresse($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->adresse !== $v) {
            $this->adresse = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_ADRESSE] = true;
        }

        return $this;
    } // setAdresse()

    /**
     * Set the value of [cp] column.
     *
     * @param string|null $v New value
     * @return $this|\App\Http\Model\Utilisateur The current object (for fluent API support)
     */
    public function setCp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->cp !== $v) {
            $this->cp = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_CP] = true;
        }

        return $this;
    } // setCp()

    /**
     * Set the value of [ville] column.
     *
     * @param string|null $v New value
     * @return $this|\App\Http\Model\Utilisateur The current object (for fluent API support)
     */
    public function setVille($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ville !== $v) {
            $this->ville = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_VILLE] = true;
        }

        return $this;
    } // setVille()

    /**
     * Set the value of [adrmel] column.
     *
     * @param string|null $v New value
     * @return $this|\App\Http\Model\Utilisateur The current object (for fluent API support)
     */
    public function setAdrmel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->adrmel !== $v) {
            $this->adrmel = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_ADRMEL] = true;
        }

        return $this;
    } // setAdrmel()

    /**
     * Set the value of [telephone] column.
     *
     * @param string|null $v New value
     * @return $this|\App\Http\Model\Utilisateur The current object (for fluent API support)
     */
    public function setTelephone($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->telephone !== $v) {
            $this->telephone = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_TELEPHONE] = true;
        }

        return $this;
    } // setTelephone()

    /**
     * Set the value of [contact] column.
     *
     * @param string|null $v New value
     * @return $this|\App\Http\Model\Utilisateur The current object (for fluent API support)
     */
    public function setContact($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->contact !== $v) {
            $this->contact = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_CONTACT] = true;
        }

        return $this;
    } // setContact()

    /**
     * Set the value of [codepays] column.
     *
     * @param string $v New value
     * @return $this|\App\Http\Model\Utilisateur The current object (for fluent API support)
     */
    public function setCodepays($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->codepays !== $v) {
            $this->codepays = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_CODEPAYS] = true;
        }

        if ($this->aPays !== null && $this->aPays->getCodepays() !== $v) {
            $this->aPays = null;
        }

        return $this;
    } // setCodepays()

    /**
     * Set the value of [login] column.
     *
     * @param string $v New value
     * @return $this|\App\Http\Model\Utilisateur The current object (for fluent API support)
     */
    public function setLogin($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->login !== $v) {
            $this->login = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_LOGIN] = true;
        }

        return $this;
    } // setLogin()

    /**
     * Set the value of [mdp] column.
     *
     * @param string $v New value
     * @return $this|\App\Http\Model\Utilisateur The current object (for fluent API support)
     */
    public function setMdp($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->mdp !== $v) {
            $this->mdp = $v;
            $this->modifiedColumns[UtilisateurTableMap::COL_MDP] = true;
        }

        return $this;
    } // setMdp()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : UtilisateurTableMap::translateFieldName('Code', TableMap::TYPE_PHPNAME, $indexType)];
            $this->code = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : UtilisateurTableMap::translateFieldName('Raisonsociale', TableMap::TYPE_PHPNAME, $indexType)];
            $this->raisonsociale = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : UtilisateurTableMap::translateFieldName('Adresse', TableMap::TYPE_PHPNAME, $indexType)];
            $this->adresse = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : UtilisateurTableMap::translateFieldName('Cp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->cp = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : UtilisateurTableMap::translateFieldName('Ville', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ville = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : UtilisateurTableMap::translateFieldName('Adrmel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->adrmel = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : UtilisateurTableMap::translateFieldName('Telephone', TableMap::TYPE_PHPNAME, $indexType)];
            $this->telephone = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : UtilisateurTableMap::translateFieldName('Contact', TableMap::TYPE_PHPNAME, $indexType)];
            $this->contact = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : UtilisateurTableMap::translateFieldName('Codepays', TableMap::TYPE_PHPNAME, $indexType)];
            $this->codepays = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : UtilisateurTableMap::translateFieldName('Login', TableMap::TYPE_PHPNAME, $indexType)];
            $this->login = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : UtilisateurTableMap::translateFieldName('Mdp', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mdp = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 11; // 11 = UtilisateurTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\App\\Http\\Model\\Utilisateur'), 0, $e);
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
        if ($this->aPays !== null && $this->codepays !== $this->aPays->getCodepays()) {
            $this->aPays = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(UtilisateurTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildUtilisateurQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aPays = null;
            $this->collReservations = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Utilisateur::setDeleted()
     * @see Utilisateur::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(UtilisateurTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildUtilisateurQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(UtilisateurTableMap::DATABASE_NAME);
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
                UtilisateurTableMap::addInstanceToPool($this);
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

            if ($this->aPays !== null) {
                if ($this->aPays->isModified() || $this->aPays->isNew()) {
                    $affectedRows += $this->aPays->save($con);
                }
                $this->setPays($this->aPays);
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

            if ($this->reservationsScheduledForDeletion !== null) {
                if (!$this->reservationsScheduledForDeletion->isEmpty()) {
                    \App\Http\Model\ReservationQuery::create()
                        ->filterByPrimaryKeys($this->reservationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->reservationsScheduledForDeletion = null;
                }
            }

            if ($this->collReservations !== null) {
                foreach ($this->collReservations as $referrerFK) {
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

        $this->modifiedColumns[UtilisateurTableMap::COL_CODE] = true;
        if (null !== $this->code) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UtilisateurTableMap::COL_CODE . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UtilisateurTableMap::COL_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'code';
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_RAISONSOCIALE)) {
            $modifiedColumns[':p' . $index++]  = 'raisonSociale';
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_ADRESSE)) {
            $modifiedColumns[':p' . $index++]  = 'adresse';
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_CP)) {
            $modifiedColumns[':p' . $index++]  = 'cp';
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_VILLE)) {
            $modifiedColumns[':p' . $index++]  = 'ville';
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_ADRMEL)) {
            $modifiedColumns[':p' . $index++]  = 'adrMel';
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_TELEPHONE)) {
            $modifiedColumns[':p' . $index++]  = 'telephone';
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_CONTACT)) {
            $modifiedColumns[':p' . $index++]  = 'contact';
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_CODEPAYS)) {
            $modifiedColumns[':p' . $index++]  = 'codePays';
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_LOGIN)) {
            $modifiedColumns[':p' . $index++]  = 'login';
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_MDP)) {
            $modifiedColumns[':p' . $index++]  = 'mdp';
        }

        $sql = sprintf(
            'INSERT INTO utilisateur (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'code':
                        $stmt->bindValue($identifier, $this->code, PDO::PARAM_INT);
                        break;
                    case 'raisonSociale':
                        $stmt->bindValue($identifier, $this->raisonsociale, PDO::PARAM_STR);
                        break;
                    case 'adresse':
                        $stmt->bindValue($identifier, $this->adresse, PDO::PARAM_STR);
                        break;
                    case 'cp':
                        $stmt->bindValue($identifier, $this->cp, PDO::PARAM_STR);
                        break;
                    case 'ville':
                        $stmt->bindValue($identifier, $this->ville, PDO::PARAM_STR);
                        break;
                    case 'adrMel':
                        $stmt->bindValue($identifier, $this->adrmel, PDO::PARAM_STR);
                        break;
                    case 'telephone':
                        $stmt->bindValue($identifier, $this->telephone, PDO::PARAM_STR);
                        break;
                    case 'contact':
                        $stmt->bindValue($identifier, $this->contact, PDO::PARAM_STR);
                        break;
                    case 'codePays':
                        $stmt->bindValue($identifier, $this->codepays, PDO::PARAM_STR);
                        break;
                    case 'login':
                        $stmt->bindValue($identifier, $this->login, PDO::PARAM_STR);
                        break;
                    case 'mdp':
                        $stmt->bindValue($identifier, $this->mdp, PDO::PARAM_STR);
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
        $this->setCode($pk);

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
        $pos = UtilisateurTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getCode();
                break;
            case 1:
                return $this->getRaisonsociale();
                break;
            case 2:
                return $this->getAdresse();
                break;
            case 3:
                return $this->getCp();
                break;
            case 4:
                return $this->getVille();
                break;
            case 5:
                return $this->getAdrmel();
                break;
            case 6:
                return $this->getTelephone();
                break;
            case 7:
                return $this->getContact();
                break;
            case 8:
                return $this->getCodepays();
                break;
            case 9:
                return $this->getLogin();
                break;
            case 10:
                return $this->getMdp();
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

        if (isset($alreadyDumpedObjects['Utilisateur'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Utilisateur'][$this->hashCode()] = true;
        $keys = UtilisateurTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getCode(),
            $keys[1] => $this->getRaisonsociale(),
            $keys[2] => $this->getAdresse(),
            $keys[3] => $this->getCp(),
            $keys[4] => $this->getVille(),
            $keys[5] => $this->getAdrmel(),
            $keys[6] => $this->getTelephone(),
            $keys[7] => $this->getContact(),
            $keys[8] => $this->getCodepays(),
            $keys[9] => $this->getLogin(),
            $keys[10] => $this->getMdp(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aPays) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'pays';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'pays';
                        break;
                    default:
                        $key = 'Pays';
                }

                $result[$key] = $this->aPays->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collReservations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'reservations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'reservations';
                        break;
                    default:
                        $key = 'Reservations';
                }

                $result[$key] = $this->collReservations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\App\Http\Model\Utilisateur
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = UtilisateurTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\App\Http\Model\Utilisateur
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setCode($value);
                break;
            case 1:
                $this->setRaisonsociale($value);
                break;
            case 2:
                $this->setAdresse($value);
                break;
            case 3:
                $this->setCp($value);
                break;
            case 4:
                $this->setVille($value);
                break;
            case 5:
                $this->setAdrmel($value);
                break;
            case 6:
                $this->setTelephone($value);
                break;
            case 7:
                $this->setContact($value);
                break;
            case 8:
                $this->setCodepays($value);
                break;
            case 9:
                $this->setLogin($value);
                break;
            case 10:
                $this->setMdp($value);
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
     * @return     $this|\App\Http\Model\Utilisateur
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = UtilisateurTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setCode($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setRaisonsociale($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setAdresse($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setCp($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setVille($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setAdrmel($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setTelephone($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setContact($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCodepays($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setLogin($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setMdp($arr[$keys[10]]);
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
     * @return $this|\App\Http\Model\Utilisateur The current object, for fluid interface
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
        $criteria = new Criteria(UtilisateurTableMap::DATABASE_NAME);

        if ($this->isColumnModified(UtilisateurTableMap::COL_CODE)) {
            $criteria->add(UtilisateurTableMap::COL_CODE, $this->code);
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_RAISONSOCIALE)) {
            $criteria->add(UtilisateurTableMap::COL_RAISONSOCIALE, $this->raisonsociale);
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_ADRESSE)) {
            $criteria->add(UtilisateurTableMap::COL_ADRESSE, $this->adresse);
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_CP)) {
            $criteria->add(UtilisateurTableMap::COL_CP, $this->cp);
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_VILLE)) {
            $criteria->add(UtilisateurTableMap::COL_VILLE, $this->ville);
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_ADRMEL)) {
            $criteria->add(UtilisateurTableMap::COL_ADRMEL, $this->adrmel);
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_TELEPHONE)) {
            $criteria->add(UtilisateurTableMap::COL_TELEPHONE, $this->telephone);
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_CONTACT)) {
            $criteria->add(UtilisateurTableMap::COL_CONTACT, $this->contact);
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_CODEPAYS)) {
            $criteria->add(UtilisateurTableMap::COL_CODEPAYS, $this->codepays);
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_LOGIN)) {
            $criteria->add(UtilisateurTableMap::COL_LOGIN, $this->login);
        }
        if ($this->isColumnModified(UtilisateurTableMap::COL_MDP)) {
            $criteria->add(UtilisateurTableMap::COL_MDP, $this->mdp);
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
        $criteria = ChildUtilisateurQuery::create();
        $criteria->add(UtilisateurTableMap::COL_CODE, $this->code);

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
        $validPk = null !== $this->getCode();

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
        return $this->getCode();
    }

    /**
     * Generic method to set the primary key (code column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setCode($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getCode();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \App\Http\Model\Utilisateur (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setRaisonsociale($this->getRaisonsociale());
        $copyObj->setAdresse($this->getAdresse());
        $copyObj->setCp($this->getCp());
        $copyObj->setVille($this->getVille());
        $copyObj->setAdrmel($this->getAdrmel());
        $copyObj->setTelephone($this->getTelephone());
        $copyObj->setContact($this->getContact());
        $copyObj->setCodepays($this->getCodepays());
        $copyObj->setLogin($this->getLogin());
        $copyObj->setMdp($this->getMdp());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getReservations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addReservation($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setCode(NULL); // this is a auto-increment column, so set to default value
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
     * @return \App\Http\Model\Utilisateur Clone of current object.
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
     * Declares an association between this object and a ChildPays object.
     *
     * @param  ChildPays $v
     * @return $this|\App\Http\Model\Utilisateur The current object (for fluent API support)
     * @throws PropelException
     */
    public function setPays(ChildPays $v = null)
    {
        if ($v === null) {
            $this->setCodepays(NULL);
        } else {
            $this->setCodepays($v->getCodepays());
        }

        $this->aPays = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildPays object, it will not be re-added.
        if ($v !== null) {
            $v->addUtilisateur($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildPays object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildPays The associated ChildPays object.
     * @throws PropelException
     */
    public function getPays(ConnectionInterface $con = null)
    {
        if ($this->aPays === null && (($this->codepays !== "" && $this->codepays !== null))) {
            $this->aPays = ChildPaysQuery::create()->findPk($this->codepays, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aPays->addUtilisateurs($this);
             */
        }

        return $this->aPays;
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
        if ('Reservation' === $relationName) {
            $this->initReservations();
            return;
        }
    }

    /**
     * Clears out the collReservations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addReservations()
     */
    public function clearReservations()
    {
        $this->collReservations = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collReservations collection loaded partially.
     */
    public function resetPartialReservations($v = true)
    {
        $this->collReservationsPartial = $v;
    }

    /**
     * Initializes the collReservations collection.
     *
     * By default this just sets the collReservations collection to an empty array (like clearcollReservations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initReservations($overrideExisting = true)
    {
        if (null !== $this->collReservations && !$overrideExisting) {
            return;
        }

        $collectionClassName = ReservationTableMap::getTableMap()->getCollectionClassName();

        $this->collReservations = new $collectionClassName;
        $this->collReservations->setModel('\App\Http\Model\Reservation');
    }

    /**
     * Gets an array of ChildReservation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildUtilisateur is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildReservation[] List of ChildReservation objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReservation> List of ChildReservation objects
     * @throws PropelException
     */
    public function getReservations(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collReservationsPartial && !$this->isNew();
        if (null === $this->collReservations || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collReservations) {
                    $this->initReservations();
                } else {
                    $collectionClassName = ReservationTableMap::getTableMap()->getCollectionClassName();

                    $collReservations = new $collectionClassName;
                    $collReservations->setModel('\App\Http\Model\Reservation');

                    return $collReservations;
                }
            } else {
                $collReservations = ChildReservationQuery::create(null, $criteria)
                    ->filterByUtilisateur($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collReservationsPartial && count($collReservations)) {
                        $this->initReservations(false);

                        foreach ($collReservations as $obj) {
                            if (false == $this->collReservations->contains($obj)) {
                                $this->collReservations->append($obj);
                            }
                        }

                        $this->collReservationsPartial = true;
                    }

                    return $collReservations;
                }

                if ($partial && $this->collReservations) {
                    foreach ($this->collReservations as $obj) {
                        if ($obj->isNew()) {
                            $collReservations[] = $obj;
                        }
                    }
                }

                $this->collReservations = $collReservations;
                $this->collReservationsPartial = false;
            }
        }

        return $this->collReservations;
    }

    /**
     * Sets a collection of ChildReservation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $reservations A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildUtilisateur The current object (for fluent API support)
     */
    public function setReservations(Collection $reservations, ConnectionInterface $con = null)
    {
        /** @var ChildReservation[] $reservationsToDelete */
        $reservationsToDelete = $this->getReservations(new Criteria(), $con)->diff($reservations);


        $this->reservationsScheduledForDeletion = $reservationsToDelete;

        foreach ($reservationsToDelete as $reservationRemoved) {
            $reservationRemoved->setUtilisateur(null);
        }

        $this->collReservations = null;
        foreach ($reservations as $reservation) {
            $this->addReservation($reservation);
        }

        $this->collReservations = $reservations;
        $this->collReservationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Reservation objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Reservation objects.
     * @throws PropelException
     */
    public function countReservations(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collReservationsPartial && !$this->isNew();
        if (null === $this->collReservations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collReservations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getReservations());
            }

            $query = ChildReservationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUtilisateur($this)
                ->count($con);
        }

        return count($this->collReservations);
    }

    /**
     * Method called to associate a ChildReservation object to this object
     * through the ChildReservation foreign key attribute.
     *
     * @param  ChildReservation $l ChildReservation
     * @return $this|\App\Http\Model\Utilisateur The current object (for fluent API support)
     */
    public function addReservation(ChildReservation $l)
    {
        if ($this->collReservations === null) {
            $this->initReservations();
            $this->collReservationsPartial = true;
        }

        if (!$this->collReservations->contains($l)) {
            $this->doAddReservation($l);

            if ($this->reservationsScheduledForDeletion and $this->reservationsScheduledForDeletion->contains($l)) {
                $this->reservationsScheduledForDeletion->remove($this->reservationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildReservation $reservation The ChildReservation object to add.
     */
    protected function doAddReservation(ChildReservation $reservation)
    {
        $this->collReservations[]= $reservation;
        $reservation->setUtilisateur($this);
    }

    /**
     * @param  ChildReservation $reservation The ChildReservation object to remove.
     * @return $this|ChildUtilisateur The current object (for fluent API support)
     */
    public function removeReservation(ChildReservation $reservation)
    {
        if ($this->getReservations()->contains($reservation)) {
            $pos = $this->collReservations->search($reservation);
            $this->collReservations->remove($pos);
            if (null === $this->reservationsScheduledForDeletion) {
                $this->reservationsScheduledForDeletion = clone $this->collReservations;
                $this->reservationsScheduledForDeletion->clear();
            }
            $this->reservationsScheduledForDeletion[]= clone $reservation;
            $reservation->setUtilisateur(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Utilisateur is new, it will return
     * an empty collection; or if this Utilisateur has previously
     * been saved, it will retrieve related Reservations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Utilisateur.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildReservation[] List of ChildReservation objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReservation}> List of ChildReservation objects
     */
    public function getReservationsJoinVilleRelatedByCodevillemisedisposition(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildReservationQuery::create(null, $criteria);
        $query->joinWith('VilleRelatedByCodevillemisedisposition', $joinBehavior);

        return $this->getReservations($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Utilisateur is new, it will return
     * an empty collection; or if this Utilisateur has previously
     * been saved, it will retrieve related Reservations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Utilisateur.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildReservation[] List of ChildReservation objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReservation}> List of ChildReservation objects
     */
    public function getReservationsJoinVilleRelatedByCodevillerendre(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildReservationQuery::create(null, $criteria);
        $query->joinWith('VilleRelatedByCodevillerendre', $joinBehavior);

        return $this->getReservations($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Utilisateur is new, it will return
     * an empty collection; or if this Utilisateur has previously
     * been saved, it will retrieve related Reservations from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Utilisateur.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildReservation[] List of ChildReservation objects
     * @phpstan-return ObjectCollection&\Traversable<ChildReservation}> List of ChildReservation objects
     */
    public function getReservationsJoinDevis(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildReservationQuery::create(null, $criteria);
        $query->joinWith('Devis', $joinBehavior);

        return $this->getReservations($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aPays) {
            $this->aPays->removeUtilisateur($this);
        }
        $this->code = null;
        $this->raisonsociale = null;
        $this->adresse = null;
        $this->cp = null;
        $this->ville = null;
        $this->adrmel = null;
        $this->telephone = null;
        $this->contact = null;
        $this->codepays = null;
        $this->login = null;
        $this->mdp = null;
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
            if ($this->collReservations) {
                foreach ($this->collReservations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collReservations = null;
        $this->aPays = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UtilisateurTableMap::DEFAULT_STRING_FORMAT);
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
