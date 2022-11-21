<?php

namespace App\Http\Model\Base;

use \Exception;
use \PDO;
use App\Http\Model\Typecontainer as ChildTypecontainer;
use App\Http\Model\TypecontainerQuery as ChildTypecontainerQuery;
use App\Http\Model\Map\TypecontainerTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'typeContainer' table.
 *
 *
 *
 * @method     ChildTypecontainerQuery orderByNumtypecontainer($order = Criteria::ASC) Order by the numTypeContainer column
 * @method     ChildTypecontainerQuery orderByCodetypecontainer($order = Criteria::ASC) Order by the codeTypeContainer column
 * @method     ChildTypecontainerQuery orderByLibelletypecontainer($order = Criteria::ASC) Order by the libelleTypeContainer column
 * @method     ChildTypecontainerQuery orderByLongueurcont($order = Criteria::ASC) Order by the longueurCont column
 * @method     ChildTypecontainerQuery orderByLargeurcont($order = Criteria::ASC) Order by the largeurCont column
 * @method     ChildTypecontainerQuery orderByHauteurcont($order = Criteria::ASC) Order by the hauteurCont column
 * @method     ChildTypecontainerQuery orderByPoidscont($order = Criteria::ASC) Order by the poidsCont column
 * @method     ChildTypecontainerQuery orderByTare($order = Criteria::ASC) Order by the tare column
 * @method     ChildTypecontainerQuery orderByCapacitedecharge($order = Criteria::ASC) Order by the capaciteDeCharge column
 *
 * @method     ChildTypecontainerQuery groupByNumtypecontainer() Group by the numTypeContainer column
 * @method     ChildTypecontainerQuery groupByCodetypecontainer() Group by the codeTypeContainer column
 * @method     ChildTypecontainerQuery groupByLibelletypecontainer() Group by the libelleTypeContainer column
 * @method     ChildTypecontainerQuery groupByLongueurcont() Group by the longueurCont column
 * @method     ChildTypecontainerQuery groupByLargeurcont() Group by the largeurCont column
 * @method     ChildTypecontainerQuery groupByHauteurcont() Group by the hauteurCont column
 * @method     ChildTypecontainerQuery groupByPoidscont() Group by the poidsCont column
 * @method     ChildTypecontainerQuery groupByTare() Group by the tare column
 * @method     ChildTypecontainerQuery groupByCapacitedecharge() Group by the capaciteDeCharge column
 *
 * @method     ChildTypecontainerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTypecontainerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTypecontainerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTypecontainerQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildTypecontainerQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildTypecontainerQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildTypecontainerQuery leftJoinReserver($relationAlias = null) Adds a LEFT JOIN clause to the query using the Reserver relation
 * @method     ChildTypecontainerQuery rightJoinReserver($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Reserver relation
 * @method     ChildTypecontainerQuery innerJoinReserver($relationAlias = null) Adds a INNER JOIN clause to the query using the Reserver relation
 *
 * @method     ChildTypecontainerQuery joinWithReserver($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Reserver relation
 *
 * @method     ChildTypecontainerQuery leftJoinWithReserver() Adds a LEFT JOIN clause and with to the query using the Reserver relation
 * @method     ChildTypecontainerQuery rightJoinWithReserver() Adds a RIGHT JOIN clause and with to the query using the Reserver relation
 * @method     ChildTypecontainerQuery innerJoinWithReserver() Adds a INNER JOIN clause and with to the query using the Reserver relation
 *
 * @method     ChildTypecontainerQuery leftJoinTarificationcontainer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tarificationcontainer relation
 * @method     ChildTypecontainerQuery rightJoinTarificationcontainer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tarificationcontainer relation
 * @method     ChildTypecontainerQuery innerJoinTarificationcontainer($relationAlias = null) Adds a INNER JOIN clause to the query using the Tarificationcontainer relation
 *
 * @method     ChildTypecontainerQuery joinWithTarificationcontainer($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tarificationcontainer relation
 *
 * @method     ChildTypecontainerQuery leftJoinWithTarificationcontainer() Adds a LEFT JOIN clause and with to the query using the Tarificationcontainer relation
 * @method     ChildTypecontainerQuery rightJoinWithTarificationcontainer() Adds a RIGHT JOIN clause and with to the query using the Tarificationcontainer relation
 * @method     ChildTypecontainerQuery innerJoinWithTarificationcontainer() Adds a INNER JOIN clause and with to the query using the Tarificationcontainer relation
 *
 * @method     \App\Http\Model\ReserverQuery|\App\Http\Model\TarificationcontainerQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildTypecontainer|null findOne(ConnectionInterface $con = null) Return the first ChildTypecontainer matching the query
 * @method     ChildTypecontainer findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTypecontainer matching the query, or a new ChildTypecontainer object populated from the query conditions when no match is found
 *
 * @method     ChildTypecontainer|null findOneByNumtypecontainer(int $numTypeContainer) Return the first ChildTypecontainer filtered by the numTypeContainer column
 * @method     ChildTypecontainer|null findOneByCodetypecontainer(string $codeTypeContainer) Return the first ChildTypecontainer filtered by the codeTypeContainer column
 * @method     ChildTypecontainer|null findOneByLibelletypecontainer(string $libelleTypeContainer) Return the first ChildTypecontainer filtered by the libelleTypeContainer column
 * @method     ChildTypecontainer|null findOneByLongueurcont(string $longueurCont) Return the first ChildTypecontainer filtered by the longueurCont column
 * @method     ChildTypecontainer|null findOneByLargeurcont(string $largeurCont) Return the first ChildTypecontainer filtered by the largeurCont column
 * @method     ChildTypecontainer|null findOneByHauteurcont(string $hauteurCont) Return the first ChildTypecontainer filtered by the hauteurCont column
 * @method     ChildTypecontainer|null findOneByPoidscont(string $poidsCont) Return the first ChildTypecontainer filtered by the poidsCont column
 * @method     ChildTypecontainer|null findOneByTare(string $tare) Return the first ChildTypecontainer filtered by the tare column
 * @method     ChildTypecontainer|null findOneByCapacitedecharge(string $capaciteDeCharge) Return the first ChildTypecontainer filtered by the capaciteDeCharge column *

 * @method     ChildTypecontainer requirePk($key, ConnectionInterface $con = null) Return the ChildTypecontainer by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTypecontainer requireOne(ConnectionInterface $con = null) Return the first ChildTypecontainer matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTypecontainer requireOneByNumtypecontainer(int $numTypeContainer) Return the first ChildTypecontainer filtered by the numTypeContainer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTypecontainer requireOneByCodetypecontainer(string $codeTypeContainer) Return the first ChildTypecontainer filtered by the codeTypeContainer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTypecontainer requireOneByLibelletypecontainer(string $libelleTypeContainer) Return the first ChildTypecontainer filtered by the libelleTypeContainer column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTypecontainer requireOneByLongueurcont(string $longueurCont) Return the first ChildTypecontainer filtered by the longueurCont column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTypecontainer requireOneByLargeurcont(string $largeurCont) Return the first ChildTypecontainer filtered by the largeurCont column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTypecontainer requireOneByHauteurcont(string $hauteurCont) Return the first ChildTypecontainer filtered by the hauteurCont column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTypecontainer requireOneByPoidscont(string $poidsCont) Return the first ChildTypecontainer filtered by the poidsCont column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTypecontainer requireOneByTare(string $tare) Return the first ChildTypecontainer filtered by the tare column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildTypecontainer requireOneByCapacitedecharge(string $capaciteDeCharge) Return the first ChildTypecontainer filtered by the capaciteDeCharge column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildTypecontainer[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildTypecontainer objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildTypecontainer> find(ConnectionInterface $con = null) Return ChildTypecontainer objects based on current ModelCriteria
 * @method     ChildTypecontainer[]|ObjectCollection findByNumtypecontainer(int $numTypeContainer) Return ChildTypecontainer objects filtered by the numTypeContainer column
 * @psalm-method ObjectCollection&\Traversable<ChildTypecontainer> findByNumtypecontainer(int $numTypeContainer) Return ChildTypecontainer objects filtered by the numTypeContainer column
 * @method     ChildTypecontainer[]|ObjectCollection findByCodetypecontainer(string $codeTypeContainer) Return ChildTypecontainer objects filtered by the codeTypeContainer column
 * @psalm-method ObjectCollection&\Traversable<ChildTypecontainer> findByCodetypecontainer(string $codeTypeContainer) Return ChildTypecontainer objects filtered by the codeTypeContainer column
 * @method     ChildTypecontainer[]|ObjectCollection findByLibelletypecontainer(string $libelleTypeContainer) Return ChildTypecontainer objects filtered by the libelleTypeContainer column
 * @psalm-method ObjectCollection&\Traversable<ChildTypecontainer> findByLibelletypecontainer(string $libelleTypeContainer) Return ChildTypecontainer objects filtered by the libelleTypeContainer column
 * @method     ChildTypecontainer[]|ObjectCollection findByLongueurcont(string $longueurCont) Return ChildTypecontainer objects filtered by the longueurCont column
 * @psalm-method ObjectCollection&\Traversable<ChildTypecontainer> findByLongueurcont(string $longueurCont) Return ChildTypecontainer objects filtered by the longueurCont column
 * @method     ChildTypecontainer[]|ObjectCollection findByLargeurcont(string $largeurCont) Return ChildTypecontainer objects filtered by the largeurCont column
 * @psalm-method ObjectCollection&\Traversable<ChildTypecontainer> findByLargeurcont(string $largeurCont) Return ChildTypecontainer objects filtered by the largeurCont column
 * @method     ChildTypecontainer[]|ObjectCollection findByHauteurcont(string $hauteurCont) Return ChildTypecontainer objects filtered by the hauteurCont column
 * @psalm-method ObjectCollection&\Traversable<ChildTypecontainer> findByHauteurcont(string $hauteurCont) Return ChildTypecontainer objects filtered by the hauteurCont column
 * @method     ChildTypecontainer[]|ObjectCollection findByPoidscont(string $poidsCont) Return ChildTypecontainer objects filtered by the poidsCont column
 * @psalm-method ObjectCollection&\Traversable<ChildTypecontainer> findByPoidscont(string $poidsCont) Return ChildTypecontainer objects filtered by the poidsCont column
 * @method     ChildTypecontainer[]|ObjectCollection findByTare(string $tare) Return ChildTypecontainer objects filtered by the tare column
 * @psalm-method ObjectCollection&\Traversable<ChildTypecontainer> findByTare(string $tare) Return ChildTypecontainer objects filtered by the tare column
 * @method     ChildTypecontainer[]|ObjectCollection findByCapacitedecharge(string $capaciteDeCharge) Return ChildTypecontainer objects filtered by the capaciteDeCharge column
 * @psalm-method ObjectCollection&\Traversable<ChildTypecontainer> findByCapacitedecharge(string $capaciteDeCharge) Return ChildTypecontainer objects filtered by the capaciteDeCharge column
 * @method     ChildTypecontainer[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildTypecontainer> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class TypecontainerQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Http\Model\Base\TypecontainerQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Http\\Model\\Typecontainer', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTypecontainerQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTypecontainerQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildTypecontainerQuery) {
            return $criteria;
        }
        $query = new ChildTypecontainerQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildTypecontainer|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TypecontainerTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = TypecontainerTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildTypecontainer A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT numTypeContainer, codeTypeContainer, libelleTypeContainer, longueurCont, largeurCont, hauteurCont, poidsCont, tare, capaciteDeCharge FROM typeContainer WHERE numTypeContainer = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildTypecontainer $obj */
            $obj = new ChildTypecontainer();
            $obj->hydrate($row);
            TypecontainerTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildTypecontainer|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildTypecontainerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TypecontainerTableMap::COL_NUMTYPECONTAINER, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildTypecontainerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TypecontainerTableMap::COL_NUMTYPECONTAINER, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the numTypeContainer column
     *
     * Example usage:
     * <code>
     * $query->filterByNumtypecontainer(1234); // WHERE numTypeContainer = 1234
     * $query->filterByNumtypecontainer(array(12, 34)); // WHERE numTypeContainer IN (12, 34)
     * $query->filterByNumtypecontainer(array('min' => 12)); // WHERE numTypeContainer > 12
     * </code>
     *
     * @param     mixed $numtypecontainer The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTypecontainerQuery The current query, for fluid interface
     */
    public function filterByNumtypecontainer($numtypecontainer = null, $comparison = null)
    {
        if (is_array($numtypecontainer)) {
            $useMinMax = false;
            if (isset($numtypecontainer['min'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_NUMTYPECONTAINER, $numtypecontainer['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($numtypecontainer['max'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_NUMTYPECONTAINER, $numtypecontainer['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TypecontainerTableMap::COL_NUMTYPECONTAINER, $numtypecontainer, $comparison);
    }

    /**
     * Filter the query on the codeTypeContainer column
     *
     * Example usage:
     * <code>
     * $query->filterByCodetypecontainer('fooValue');   // WHERE codeTypeContainer = 'fooValue'
     * $query->filterByCodetypecontainer('%fooValue%', Criteria::LIKE); // WHERE codeTypeContainer LIKE '%fooValue%'
     * </code>
     *
     * @param     string $codetypecontainer The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTypecontainerQuery The current query, for fluid interface
     */
    public function filterByCodetypecontainer($codetypecontainer = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($codetypecontainer)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TypecontainerTableMap::COL_CODETYPECONTAINER, $codetypecontainer, $comparison);
    }

    /**
     * Filter the query on the libelleTypeContainer column
     *
     * Example usage:
     * <code>
     * $query->filterByLibelletypecontainer('fooValue');   // WHERE libelleTypeContainer = 'fooValue'
     * $query->filterByLibelletypecontainer('%fooValue%', Criteria::LIKE); // WHERE libelleTypeContainer LIKE '%fooValue%'
     * </code>
     *
     * @param     string $libelletypecontainer The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTypecontainerQuery The current query, for fluid interface
     */
    public function filterByLibelletypecontainer($libelletypecontainer = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($libelletypecontainer)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TypecontainerTableMap::COL_LIBELLETYPECONTAINER, $libelletypecontainer, $comparison);
    }

    /**
     * Filter the query on the longueurCont column
     *
     * Example usage:
     * <code>
     * $query->filterByLongueurcont(1234); // WHERE longueurCont = 1234
     * $query->filterByLongueurcont(array(12, 34)); // WHERE longueurCont IN (12, 34)
     * $query->filterByLongueurcont(array('min' => 12)); // WHERE longueurCont > 12
     * </code>
     *
     * @param     mixed $longueurcont The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTypecontainerQuery The current query, for fluid interface
     */
    public function filterByLongueurcont($longueurcont = null, $comparison = null)
    {
        if (is_array($longueurcont)) {
            $useMinMax = false;
            if (isset($longueurcont['min'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_LONGUEURCONT, $longueurcont['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($longueurcont['max'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_LONGUEURCONT, $longueurcont['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TypecontainerTableMap::COL_LONGUEURCONT, $longueurcont, $comparison);
    }

    /**
     * Filter the query on the largeurCont column
     *
     * Example usage:
     * <code>
     * $query->filterByLargeurcont(1234); // WHERE largeurCont = 1234
     * $query->filterByLargeurcont(array(12, 34)); // WHERE largeurCont IN (12, 34)
     * $query->filterByLargeurcont(array('min' => 12)); // WHERE largeurCont > 12
     * </code>
     *
     * @param     mixed $largeurcont The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTypecontainerQuery The current query, for fluid interface
     */
    public function filterByLargeurcont($largeurcont = null, $comparison = null)
    {
        if (is_array($largeurcont)) {
            $useMinMax = false;
            if (isset($largeurcont['min'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_LARGEURCONT, $largeurcont['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($largeurcont['max'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_LARGEURCONT, $largeurcont['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TypecontainerTableMap::COL_LARGEURCONT, $largeurcont, $comparison);
    }

    /**
     * Filter the query on the hauteurCont column
     *
     * Example usage:
     * <code>
     * $query->filterByHauteurcont(1234); // WHERE hauteurCont = 1234
     * $query->filterByHauteurcont(array(12, 34)); // WHERE hauteurCont IN (12, 34)
     * $query->filterByHauteurcont(array('min' => 12)); // WHERE hauteurCont > 12
     * </code>
     *
     * @param     mixed $hauteurcont The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTypecontainerQuery The current query, for fluid interface
     */
    public function filterByHauteurcont($hauteurcont = null, $comparison = null)
    {
        if (is_array($hauteurcont)) {
            $useMinMax = false;
            if (isset($hauteurcont['min'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_HAUTEURCONT, $hauteurcont['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($hauteurcont['max'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_HAUTEURCONT, $hauteurcont['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TypecontainerTableMap::COL_HAUTEURCONT, $hauteurcont, $comparison);
    }

    /**
     * Filter the query on the poidsCont column
     *
     * Example usage:
     * <code>
     * $query->filterByPoidscont(1234); // WHERE poidsCont = 1234
     * $query->filterByPoidscont(array(12, 34)); // WHERE poidsCont IN (12, 34)
     * $query->filterByPoidscont(array('min' => 12)); // WHERE poidsCont > 12
     * </code>
     *
     * @param     mixed $poidscont The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTypecontainerQuery The current query, for fluid interface
     */
    public function filterByPoidscont($poidscont = null, $comparison = null)
    {
        if (is_array($poidscont)) {
            $useMinMax = false;
            if (isset($poidscont['min'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_POIDSCONT, $poidscont['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($poidscont['max'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_POIDSCONT, $poidscont['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TypecontainerTableMap::COL_POIDSCONT, $poidscont, $comparison);
    }

    /**
     * Filter the query on the tare column
     *
     * Example usage:
     * <code>
     * $query->filterByTare(1234); // WHERE tare = 1234
     * $query->filterByTare(array(12, 34)); // WHERE tare IN (12, 34)
     * $query->filterByTare(array('min' => 12)); // WHERE tare > 12
     * </code>
     *
     * @param     mixed $tare The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTypecontainerQuery The current query, for fluid interface
     */
    public function filterByTare($tare = null, $comparison = null)
    {
        if (is_array($tare)) {
            $useMinMax = false;
            if (isset($tare['min'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_TARE, $tare['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tare['max'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_TARE, $tare['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TypecontainerTableMap::COL_TARE, $tare, $comparison);
    }

    /**
     * Filter the query on the capaciteDeCharge column
     *
     * Example usage:
     * <code>
     * $query->filterByCapacitedecharge(1234); // WHERE capaciteDeCharge = 1234
     * $query->filterByCapacitedecharge(array(12, 34)); // WHERE capaciteDeCharge IN (12, 34)
     * $query->filterByCapacitedecharge(array('min' => 12)); // WHERE capaciteDeCharge > 12
     * </code>
     *
     * @param     mixed $capacitedecharge The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildTypecontainerQuery The current query, for fluid interface
     */
    public function filterByCapacitedecharge($capacitedecharge = null, $comparison = null)
    {
        if (is_array($capacitedecharge)) {
            $useMinMax = false;
            if (isset($capacitedecharge['min'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_CAPACITEDECHARGE, $capacitedecharge['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($capacitedecharge['max'])) {
                $this->addUsingAlias(TypecontainerTableMap::COL_CAPACITEDECHARGE, $capacitedecharge['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TypecontainerTableMap::COL_CAPACITEDECHARGE, $capacitedecharge, $comparison);
    }

    /**
     * Filter the query by a related \App\Http\Model\Reserver object
     *
     * @param \App\Http\Model\Reserver|ObjectCollection $reserver the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTypecontainerQuery The current query, for fluid interface
     */
    public function filterByReserver($reserver, $comparison = null)
    {
        if ($reserver instanceof \App\Http\Model\Reserver) {
            return $this
                ->addUsingAlias(TypecontainerTableMap::COL_NUMTYPECONTAINER, $reserver->getNumtypecontainer(), $comparison);
        } elseif ($reserver instanceof ObjectCollection) {
            return $this
                ->useReserverQuery()
                ->filterByPrimaryKeys($reserver->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByReserver() only accepts arguments of type \App\Http\Model\Reserver or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Reserver relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTypecontainerQuery The current query, for fluid interface
     */
    public function joinReserver($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Reserver');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Reserver');
        }

        return $this;
    }

    /**
     * Use the Reserver relation Reserver object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Http\Model\ReserverQuery A secondary query class using the current class as primary query
     */
    public function useReserverQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinReserver($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Reserver', '\App\Http\Model\ReserverQuery');
    }

    /**
     * Use the Reserver relation Reserver object
     *
     * @param callable(\App\Http\Model\ReserverQuery):\App\Http\Model\ReserverQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withReserverQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useReserverQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Reserver table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\Http\Model\ReserverQuery The inner query object of the EXISTS statement
     */
    public function useReserverExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Reserver', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Reserver table for a NOT EXISTS query.
     *
     * @see useReserverExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\ReserverQuery The inner query object of the NOT EXISTS statement
     */
    public function useReserverNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Reserver', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \App\Http\Model\Tarificationcontainer object
     *
     * @param \App\Http\Model\Tarificationcontainer|ObjectCollection $tarificationcontainer the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTypecontainerQuery The current query, for fluid interface
     */
    public function filterByTarificationcontainer($tarificationcontainer, $comparison = null)
    {
        if ($tarificationcontainer instanceof \App\Http\Model\Tarificationcontainer) {
            return $this
                ->addUsingAlias(TypecontainerTableMap::COL_NUMTYPECONTAINER, $tarificationcontainer->getNumtypecontainer(), $comparison);
        } elseif ($tarificationcontainer instanceof ObjectCollection) {
            return $this
                ->useTarificationcontainerQuery()
                ->filterByPrimaryKeys($tarificationcontainer->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTarificationcontainer() only accepts arguments of type \App\Http\Model\Tarificationcontainer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Tarificationcontainer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildTypecontainerQuery The current query, for fluid interface
     */
    public function joinTarificationcontainer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Tarificationcontainer');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Tarificationcontainer');
        }

        return $this;
    }

    /**
     * Use the Tarificationcontainer relation Tarificationcontainer object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Http\Model\TarificationcontainerQuery A secondary query class using the current class as primary query
     */
    public function useTarificationcontainerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTarificationcontainer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Tarificationcontainer', '\App\Http\Model\TarificationcontainerQuery');
    }

    /**
     * Use the Tarificationcontainer relation Tarificationcontainer object
     *
     * @param callable(\App\Http\Model\TarificationcontainerQuery):\App\Http\Model\TarificationcontainerQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withTarificationcontainerQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useTarificationcontainerQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Tarificationcontainer table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \App\Http\Model\TarificationcontainerQuery The inner query object of the EXISTS statement
     */
    public function useTarificationcontainerExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Tarificationcontainer', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Tarificationcontainer table for a NOT EXISTS query.
     *
     * @see useTarificationcontainerExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \App\Http\Model\TarificationcontainerQuery The inner query object of the NOT EXISTS statement
     */
    public function useTarificationcontainerNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Tarificationcontainer', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildTypecontainer $typecontainer Object to remove from the list of results
     *
     * @return $this|ChildTypecontainerQuery The current query, for fluid interface
     */
    public function prune($typecontainer = null)
    {
        if ($typecontainer) {
            $this->addUsingAlias(TypecontainerTableMap::COL_NUMTYPECONTAINER, $typecontainer->getNumtypecontainer(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the typeContainer table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TypecontainerTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TypecontainerTableMap::clearInstancePool();
            TypecontainerTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TypecontainerTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TypecontainerTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            TypecontainerTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TypecontainerTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // TypecontainerQuery
