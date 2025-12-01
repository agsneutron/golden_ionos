<?php

namespace Map;

use \Orders;
use \OrdersQuery;
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
 * This class defines the structure of the 'orders' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class OrdersTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.OrdersTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'golden_clean';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'orders';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Orders';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Orders';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 41;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 41;

    /**
     * the column name for the id field
     */
    const COL_ID = 'orders.id';

    /**
     * the column name for the id_branch_office field
     */
    const COL_ID_BRANCH_OFFICE = 'orders.id_branch_office';

    /**
     * the column name for the folio field
     */
    const COL_FOLIO = 'orders.folio';

    /**
     * the column name for the harvest_date field
     */
    const COL_HARVEST_DATE = 'orders.harvest_date';

    /**
     * the column name for the harvest_time field
     */
    const COL_HARVEST_TIME = 'orders.harvest_time';

    /**
     * the column name for the reception_date field
     */
    const COL_RECEPTION_DATE = 'orders.reception_date';

    /**
     * the column name for the reception_time field
     */
    const COL_RECEPTION_TIME = 'orders.reception_time';

    /**
     * the column name for the delivery_date field
     */
    const COL_DELIVERY_DATE = 'orders.delivery_date';

    /**
     * the column name for the home_delivery field
     */
    const COL_HOME_DELIVERY = 'orders.home_delivery';

    /**
     * the column name for the delivery_time field
     */
    const COL_DELIVERY_TIME = 'orders.delivery_time';

    /**
     * the column name for the real_delivery_date field
     */
    const COL_REAL_DELIVERY_DATE = 'orders.real_delivery_date';

    /**
     * the column name for the real_delivery_time field
     */
    const COL_REAL_DELIVERY_TIME = 'orders.real_delivery_time';

    /**
     * the column name for the id_delivery_user field
     */
    const COL_ID_DELIVERY_USER = 'orders.id_delivery_user';

    /**
     * the column name for the id_priority field
     */
    const COL_ID_PRIORITY = 'orders.id_priority';

    /**
     * the column name for the pieces field
     */
    const COL_PIECES = 'orders.pieces';

    /**
     * the column name for the kilograms field
     */
    const COL_KILOGRAMS = 'orders.kilograms';

    /**
     * the column name for the observations field
     */
    const COL_OBSERVATIONS = 'orders.observations';

    /**
     * the column name for the subtotal field
     */
    const COL_SUBTOTAL = 'orders.subtotal';

    /**
     * the column name for the total field
     */
    const COL_TOTAL = 'orders.total';

    /**
     * the column name for the discount field
     */
    const COL_DISCOUNT = 'orders.discount';

    /**
     * the column name for the amount_paid field
     */
    const COL_AMOUNT_PAID = 'orders.amount_paid';

    /**
     * the column name for the printed_note field
     */
    const COL_PRINTED_NOTE = 'orders.printed_note';

    /**
     * the column name for the payment_status field
     */
    const COL_PAYMENT_STATUS = 'orders.payment_status';

    /**
     * the column name for the id_order_status field
     */
    const COL_ID_ORDER_STATUS = 'orders.id_order_status';

    /**
     * the column name for the flag_home_service field
     */
    const COL_FLAG_HOME_SERVICE = 'orders.flag_home_service';

    /**
     * the column name for the id_payment_method field
     */
    const COL_ID_PAYMENT_METHOD = 'orders.id_payment_method';

    /**
     * the column name for the id_user field
     */
    const COL_ID_USER = 'orders.id_user';

    /**
     * the column name for the id_client_user field
     */
    const COL_ID_CLIENT_USER = 'orders.id_client_user';

    /**
     * the column name for the harvest_comments field
     */
    const COL_HARVEST_COMMENTS = 'orders.harvest_comments';

    /**
     * the column name for the harvest_contact_name field
     */
    const COL_HARVEST_CONTACT_NAME = 'orders.harvest_contact_name';

    /**
     * the column name for the harvest_contact_signature field
     */
    const COL_HARVEST_CONTACT_SIGNATURE = 'orders.harvest_contact_signature';

    /**
     * the column name for the harvest_photo field
     */
    const COL_HARVEST_PHOTO = 'orders.harvest_photo';

    /**
     * the column name for the delivery_comments field
     */
    const COL_DELIVERY_COMMENTS = 'orders.delivery_comments';

    /**
     * the column name for the delivery_contact_name field
     */
    const COL_DELIVERY_CONTACT_NAME = 'orders.delivery_contact_name';

    /**
     * the column name for the delivery_contact_signature field
     */
    const COL_DELIVERY_CONTACT_SIGNATURE = 'orders.delivery_contact_signature';

    /**
     * the column name for the delivery_photo field
     */
    const COL_DELIVERY_PHOTO = 'orders.delivery_photo';

    /**
     * the column name for the rank field
     */
    const COL_RANK = 'orders.rank';

    /**
     * the column name for the qualified field
     */
    const COL_QUALIFIED = 'orders.qualified';

    /**
     * the column name for the client_comments field
     */
    const COL_CLIENT_COMMENTS = 'orders.client_comments';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'orders.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'orders.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'IdBranchOffice', 'Folio', 'HarvestDate', 'HarvestTime', 'ReceptionDate', 'ReceptionTime', 'DeliveryDate', 'HomeDelivery', 'DeliveryTime', 'RealDeliveryDate', 'RealDeliveryTime', 'IdDeliveryUser', 'IdPriority', 'Pieces', 'Kilograms', 'Observations', 'Subtotal', 'Total', 'Discount', 'AmountPaid', 'PrintedNote', 'PaymentStatus', 'IdOrderStatus', 'FlagHomeService', 'IdPaymentMethod', 'IdUser', 'IdClientUser', 'HarvestComments', 'HarvestContactName', 'HarvestContactSignature', 'HarvestPhoto', 'DeliveryComments', 'DeliveryContactName', 'DeliveryContactSignature', 'DeliveryPhoto', 'Rank', 'Qualified', 'ClientComments', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'idBranchOffice', 'folio', 'harvestDate', 'harvestTime', 'receptionDate', 'receptionTime', 'deliveryDate', 'homeDelivery', 'deliveryTime', 'realDeliveryDate', 'realDeliveryTime', 'idDeliveryUser', 'idPriority', 'pieces', 'kilograms', 'observations', 'subtotal', 'total', 'discount', 'amountPaid', 'printedNote', 'paymentStatus', 'idOrderStatus', 'flagHomeService', 'idPaymentMethod', 'idUser', 'idClientUser', 'harvestComments', 'harvestContactName', 'harvestContactSignature', 'harvestPhoto', 'deliveryComments', 'deliveryContactName', 'deliveryContactSignature', 'deliveryPhoto', 'rank', 'qualified', 'clientComments', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(OrdersTableMap::COL_ID, OrdersTableMap::COL_ID_BRANCH_OFFICE, OrdersTableMap::COL_FOLIO, OrdersTableMap::COL_HARVEST_DATE, OrdersTableMap::COL_HARVEST_TIME, OrdersTableMap::COL_RECEPTION_DATE, OrdersTableMap::COL_RECEPTION_TIME, OrdersTableMap::COL_DELIVERY_DATE, OrdersTableMap::COL_HOME_DELIVERY, OrdersTableMap::COL_DELIVERY_TIME, OrdersTableMap::COL_REAL_DELIVERY_DATE, OrdersTableMap::COL_REAL_DELIVERY_TIME, OrdersTableMap::COL_ID_DELIVERY_USER, OrdersTableMap::COL_ID_PRIORITY, OrdersTableMap::COL_PIECES, OrdersTableMap::COL_KILOGRAMS, OrdersTableMap::COL_OBSERVATIONS, OrdersTableMap::COL_SUBTOTAL, OrdersTableMap::COL_TOTAL, OrdersTableMap::COL_DISCOUNT, OrdersTableMap::COL_AMOUNT_PAID, OrdersTableMap::COL_PRINTED_NOTE, OrdersTableMap::COL_PAYMENT_STATUS, OrdersTableMap::COL_ID_ORDER_STATUS, OrdersTableMap::COL_FLAG_HOME_SERVICE, OrdersTableMap::COL_ID_PAYMENT_METHOD, OrdersTableMap::COL_ID_USER, OrdersTableMap::COL_ID_CLIENT_USER, OrdersTableMap::COL_HARVEST_COMMENTS, OrdersTableMap::COL_HARVEST_CONTACT_NAME, OrdersTableMap::COL_HARVEST_CONTACT_SIGNATURE, OrdersTableMap::COL_HARVEST_PHOTO, OrdersTableMap::COL_DELIVERY_COMMENTS, OrdersTableMap::COL_DELIVERY_CONTACT_NAME, OrdersTableMap::COL_DELIVERY_CONTACT_SIGNATURE, OrdersTableMap::COL_DELIVERY_PHOTO, OrdersTableMap::COL_RANK, OrdersTableMap::COL_QUALIFIED, OrdersTableMap::COL_CLIENT_COMMENTS, OrdersTableMap::COL_CREATED_AT, OrdersTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'id_branch_office', 'folio', 'harvest_date', 'harvest_time', 'reception_date', 'reception_time', 'delivery_date', 'home_delivery', 'delivery_time', 'real_delivery_date', 'real_delivery_time', 'id_delivery_user', 'id_priority', 'pieces', 'kilograms', 'observations', 'subtotal', 'total', 'discount', 'amount_paid', 'printed_note', 'payment_status', 'id_order_status', 'flag_home_service', 'id_payment_method', 'id_user', 'id_client_user', 'harvest_comments', 'harvest_contact_name', 'harvest_contact_signature', 'harvest_photo', 'delivery_comments', 'delivery_contact_name', 'delivery_contact_signature', 'delivery_photo', 'rank', 'qualified', 'client_comments', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'IdBranchOffice' => 1, 'Folio' => 2, 'HarvestDate' => 3, 'HarvestTime' => 4, 'ReceptionDate' => 5, 'ReceptionTime' => 6, 'DeliveryDate' => 7, 'HomeDelivery' => 8, 'DeliveryTime' => 9, 'RealDeliveryDate' => 10, 'RealDeliveryTime' => 11, 'IdDeliveryUser' => 12, 'IdPriority' => 13, 'Pieces' => 14, 'Kilograms' => 15, 'Observations' => 16, 'Subtotal' => 17, 'Total' => 18, 'Discount' => 19, 'AmountPaid' => 20, 'PrintedNote' => 21, 'PaymentStatus' => 22, 'IdOrderStatus' => 23, 'FlagHomeService' => 24, 'IdPaymentMethod' => 25, 'IdUser' => 26, 'IdClientUser' => 27, 'HarvestComments' => 28, 'HarvestContactName' => 29, 'HarvestContactSignature' => 30, 'HarvestPhoto' => 31, 'DeliveryComments' => 32, 'DeliveryContactName' => 33, 'DeliveryContactSignature' => 34, 'DeliveryPhoto' => 35, 'Rank' => 36, 'Qualified' => 37, 'ClientComments' => 38, 'CreatedAt' => 39, 'UpdatedAt' => 40, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'idBranchOffice' => 1, 'folio' => 2, 'harvestDate' => 3, 'harvestTime' => 4, 'receptionDate' => 5, 'receptionTime' => 6, 'deliveryDate' => 7, 'homeDelivery' => 8, 'deliveryTime' => 9, 'realDeliveryDate' => 10, 'realDeliveryTime' => 11, 'idDeliveryUser' => 12, 'idPriority' => 13, 'pieces' => 14, 'kilograms' => 15, 'observations' => 16, 'subtotal' => 17, 'total' => 18, 'discount' => 19, 'amountPaid' => 20, 'printedNote' => 21, 'paymentStatus' => 22, 'idOrderStatus' => 23, 'flagHomeService' => 24, 'idPaymentMethod' => 25, 'idUser' => 26, 'idClientUser' => 27, 'harvestComments' => 28, 'harvestContactName' => 29, 'harvestContactSignature' => 30, 'harvestPhoto' => 31, 'deliveryComments' => 32, 'deliveryContactName' => 33, 'deliveryContactSignature' => 34, 'deliveryPhoto' => 35, 'rank' => 36, 'qualified' => 37, 'clientComments' => 38, 'createdAt' => 39, 'updatedAt' => 40, ),
        self::TYPE_COLNAME       => array(OrdersTableMap::COL_ID => 0, OrdersTableMap::COL_ID_BRANCH_OFFICE => 1, OrdersTableMap::COL_FOLIO => 2, OrdersTableMap::COL_HARVEST_DATE => 3, OrdersTableMap::COL_HARVEST_TIME => 4, OrdersTableMap::COL_RECEPTION_DATE => 5, OrdersTableMap::COL_RECEPTION_TIME => 6, OrdersTableMap::COL_DELIVERY_DATE => 7, OrdersTableMap::COL_HOME_DELIVERY => 8, OrdersTableMap::COL_DELIVERY_TIME => 9, OrdersTableMap::COL_REAL_DELIVERY_DATE => 10, OrdersTableMap::COL_REAL_DELIVERY_TIME => 11, OrdersTableMap::COL_ID_DELIVERY_USER => 12, OrdersTableMap::COL_ID_PRIORITY => 13, OrdersTableMap::COL_PIECES => 14, OrdersTableMap::COL_KILOGRAMS => 15, OrdersTableMap::COL_OBSERVATIONS => 16, OrdersTableMap::COL_SUBTOTAL => 17, OrdersTableMap::COL_TOTAL => 18, OrdersTableMap::COL_DISCOUNT => 19, OrdersTableMap::COL_AMOUNT_PAID => 20, OrdersTableMap::COL_PRINTED_NOTE => 21, OrdersTableMap::COL_PAYMENT_STATUS => 22, OrdersTableMap::COL_ID_ORDER_STATUS => 23, OrdersTableMap::COL_FLAG_HOME_SERVICE => 24, OrdersTableMap::COL_ID_PAYMENT_METHOD => 25, OrdersTableMap::COL_ID_USER => 26, OrdersTableMap::COL_ID_CLIENT_USER => 27, OrdersTableMap::COL_HARVEST_COMMENTS => 28, OrdersTableMap::COL_HARVEST_CONTACT_NAME => 29, OrdersTableMap::COL_HARVEST_CONTACT_SIGNATURE => 30, OrdersTableMap::COL_HARVEST_PHOTO => 31, OrdersTableMap::COL_DELIVERY_COMMENTS => 32, OrdersTableMap::COL_DELIVERY_CONTACT_NAME => 33, OrdersTableMap::COL_DELIVERY_CONTACT_SIGNATURE => 34, OrdersTableMap::COL_DELIVERY_PHOTO => 35, OrdersTableMap::COL_RANK => 36, OrdersTableMap::COL_QUALIFIED => 37, OrdersTableMap::COL_CLIENT_COMMENTS => 38, OrdersTableMap::COL_CREATED_AT => 39, OrdersTableMap::COL_UPDATED_AT => 40, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'id_branch_office' => 1, 'folio' => 2, 'harvest_date' => 3, 'harvest_time' => 4, 'reception_date' => 5, 'reception_time' => 6, 'delivery_date' => 7, 'home_delivery' => 8, 'delivery_time' => 9, 'real_delivery_date' => 10, 'real_delivery_time' => 11, 'id_delivery_user' => 12, 'id_priority' => 13, 'pieces' => 14, 'kilograms' => 15, 'observations' => 16, 'subtotal' => 17, 'total' => 18, 'discount' => 19, 'amount_paid' => 20, 'printed_note' => 21, 'payment_status' => 22, 'id_order_status' => 23, 'flag_home_service' => 24, 'id_payment_method' => 25, 'id_user' => 26, 'id_client_user' => 27, 'harvest_comments' => 28, 'harvest_contact_name' => 29, 'harvest_contact_signature' => 30, 'harvest_photo' => 31, 'delivery_comments' => 32, 'delivery_contact_name' => 33, 'delivery_contact_signature' => 34, 'delivery_photo' => 35, 'rank' => 36, 'qualified' => 37, 'client_comments' => 38, 'created_at' => 39, 'updated_at' => 40, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'Id' => 'ID',
        'Orders.Id' => 'ID',
        'id' => 'ID',
        'orders.id' => 'ID',
        'OrdersTableMap::COL_ID' => 'ID',
        'COL_ID' => 'ID',
        'IdBranchOffice' => 'ID_BRANCH_OFFICE',
        'Orders.IdBranchOffice' => 'ID_BRANCH_OFFICE',
        'idBranchOffice' => 'ID_BRANCH_OFFICE',
        'orders.idBranchOffice' => 'ID_BRANCH_OFFICE',
        'OrdersTableMap::COL_ID_BRANCH_OFFICE' => 'ID_BRANCH_OFFICE',
        'COL_ID_BRANCH_OFFICE' => 'ID_BRANCH_OFFICE',
        'id_branch_office' => 'ID_BRANCH_OFFICE',
        'orders.id_branch_office' => 'ID_BRANCH_OFFICE',
        'Folio' => 'FOLIO',
        'Orders.Folio' => 'FOLIO',
        'folio' => 'FOLIO',
        'orders.folio' => 'FOLIO',
        'OrdersTableMap::COL_FOLIO' => 'FOLIO',
        'COL_FOLIO' => 'FOLIO',
        'HarvestDate' => 'HARVEST_DATE',
        'Orders.HarvestDate' => 'HARVEST_DATE',
        'harvestDate' => 'HARVEST_DATE',
        'orders.harvestDate' => 'HARVEST_DATE',
        'OrdersTableMap::COL_HARVEST_DATE' => 'HARVEST_DATE',
        'COL_HARVEST_DATE' => 'HARVEST_DATE',
        'harvest_date' => 'HARVEST_DATE',
        'orders.harvest_date' => 'HARVEST_DATE',
        'HarvestTime' => 'HARVEST_TIME',
        'Orders.HarvestTime' => 'HARVEST_TIME',
        'harvestTime' => 'HARVEST_TIME',
        'orders.harvestTime' => 'HARVEST_TIME',
        'OrdersTableMap::COL_HARVEST_TIME' => 'HARVEST_TIME',
        'COL_HARVEST_TIME' => 'HARVEST_TIME',
        'harvest_time' => 'HARVEST_TIME',
        'orders.harvest_time' => 'HARVEST_TIME',
        'ReceptionDate' => 'RECEPTION_DATE',
        'Orders.ReceptionDate' => 'RECEPTION_DATE',
        'receptionDate' => 'RECEPTION_DATE',
        'orders.receptionDate' => 'RECEPTION_DATE',
        'OrdersTableMap::COL_RECEPTION_DATE' => 'RECEPTION_DATE',
        'COL_RECEPTION_DATE' => 'RECEPTION_DATE',
        'reception_date' => 'RECEPTION_DATE',
        'orders.reception_date' => 'RECEPTION_DATE',
        'ReceptionTime' => 'RECEPTION_TIME',
        'Orders.ReceptionTime' => 'RECEPTION_TIME',
        'receptionTime' => 'RECEPTION_TIME',
        'orders.receptionTime' => 'RECEPTION_TIME',
        'OrdersTableMap::COL_RECEPTION_TIME' => 'RECEPTION_TIME',
        'COL_RECEPTION_TIME' => 'RECEPTION_TIME',
        'reception_time' => 'RECEPTION_TIME',
        'orders.reception_time' => 'RECEPTION_TIME',
        'DeliveryDate' => 'DELIVERY_DATE',
        'Orders.DeliveryDate' => 'DELIVERY_DATE',
        'deliveryDate' => 'DELIVERY_DATE',
        'orders.deliveryDate' => 'DELIVERY_DATE',
        'OrdersTableMap::COL_DELIVERY_DATE' => 'DELIVERY_DATE',
        'COL_DELIVERY_DATE' => 'DELIVERY_DATE',
        'delivery_date' => 'DELIVERY_DATE',
        'orders.delivery_date' => 'DELIVERY_DATE',
        'HomeDelivery' => 'HOME_DELIVERY',
        'Orders.HomeDelivery' => 'HOME_DELIVERY',
        'homeDelivery' => 'HOME_DELIVERY',
        'orders.homeDelivery' => 'HOME_DELIVERY',
        'OrdersTableMap::COL_HOME_DELIVERY' => 'HOME_DELIVERY',
        'COL_HOME_DELIVERY' => 'HOME_DELIVERY',
        'home_delivery' => 'HOME_DELIVERY',
        'orders.home_delivery' => 'HOME_DELIVERY',
        'DeliveryTime' => 'DELIVERY_TIME',
        'Orders.DeliveryTime' => 'DELIVERY_TIME',
        'deliveryTime' => 'DELIVERY_TIME',
        'orders.deliveryTime' => 'DELIVERY_TIME',
        'OrdersTableMap::COL_DELIVERY_TIME' => 'DELIVERY_TIME',
        'COL_DELIVERY_TIME' => 'DELIVERY_TIME',
        'delivery_time' => 'DELIVERY_TIME',
        'orders.delivery_time' => 'DELIVERY_TIME',
        'RealDeliveryDate' => 'REAL_DELIVERY_DATE',
        'Orders.RealDeliveryDate' => 'REAL_DELIVERY_DATE',
        'realDeliveryDate' => 'REAL_DELIVERY_DATE',
        'orders.realDeliveryDate' => 'REAL_DELIVERY_DATE',
        'OrdersTableMap::COL_REAL_DELIVERY_DATE' => 'REAL_DELIVERY_DATE',
        'COL_REAL_DELIVERY_DATE' => 'REAL_DELIVERY_DATE',
        'real_delivery_date' => 'REAL_DELIVERY_DATE',
        'orders.real_delivery_date' => 'REAL_DELIVERY_DATE',
        'RealDeliveryTime' => 'REAL_DELIVERY_TIME',
        'Orders.RealDeliveryTime' => 'REAL_DELIVERY_TIME',
        'realDeliveryTime' => 'REAL_DELIVERY_TIME',
        'orders.realDeliveryTime' => 'REAL_DELIVERY_TIME',
        'OrdersTableMap::COL_REAL_DELIVERY_TIME' => 'REAL_DELIVERY_TIME',
        'COL_REAL_DELIVERY_TIME' => 'REAL_DELIVERY_TIME',
        'real_delivery_time' => 'REAL_DELIVERY_TIME',
        'orders.real_delivery_time' => 'REAL_DELIVERY_TIME',
        'IdDeliveryUser' => 'ID_DELIVERY_USER',
        'Orders.IdDeliveryUser' => 'ID_DELIVERY_USER',
        'idDeliveryUser' => 'ID_DELIVERY_USER',
        'orders.idDeliveryUser' => 'ID_DELIVERY_USER',
        'OrdersTableMap::COL_ID_DELIVERY_USER' => 'ID_DELIVERY_USER',
        'COL_ID_DELIVERY_USER' => 'ID_DELIVERY_USER',
        'id_delivery_user' => 'ID_DELIVERY_USER',
        'orders.id_delivery_user' => 'ID_DELIVERY_USER',
        'IdPriority' => 'ID_PRIORITY',
        'Orders.IdPriority' => 'ID_PRIORITY',
        'idPriority' => 'ID_PRIORITY',
        'orders.idPriority' => 'ID_PRIORITY',
        'OrdersTableMap::COL_ID_PRIORITY' => 'ID_PRIORITY',
        'COL_ID_PRIORITY' => 'ID_PRIORITY',
        'id_priority' => 'ID_PRIORITY',
        'orders.id_priority' => 'ID_PRIORITY',
        'Pieces' => 'PIECES',
        'Orders.Pieces' => 'PIECES',
        'pieces' => 'PIECES',
        'orders.pieces' => 'PIECES',
        'OrdersTableMap::COL_PIECES' => 'PIECES',
        'COL_PIECES' => 'PIECES',
        'Kilograms' => 'KILOGRAMS',
        'Orders.Kilograms' => 'KILOGRAMS',
        'kilograms' => 'KILOGRAMS',
        'orders.kilograms' => 'KILOGRAMS',
        'OrdersTableMap::COL_KILOGRAMS' => 'KILOGRAMS',
        'COL_KILOGRAMS' => 'KILOGRAMS',
        'Observations' => 'OBSERVATIONS',
        'Orders.Observations' => 'OBSERVATIONS',
        'observations' => 'OBSERVATIONS',
        'orders.observations' => 'OBSERVATIONS',
        'OrdersTableMap::COL_OBSERVATIONS' => 'OBSERVATIONS',
        'COL_OBSERVATIONS' => 'OBSERVATIONS',
        'Subtotal' => 'SUBTOTAL',
        'Orders.Subtotal' => 'SUBTOTAL',
        'subtotal' => 'SUBTOTAL',
        'orders.subtotal' => 'SUBTOTAL',
        'OrdersTableMap::COL_SUBTOTAL' => 'SUBTOTAL',
        'COL_SUBTOTAL' => 'SUBTOTAL',
        'Total' => 'TOTAL',
        'Orders.Total' => 'TOTAL',
        'total' => 'TOTAL',
        'orders.total' => 'TOTAL',
        'OrdersTableMap::COL_TOTAL' => 'TOTAL',
        'COL_TOTAL' => 'TOTAL',
        'Discount' => 'DISCOUNT',
        'Orders.Discount' => 'DISCOUNT',
        'discount' => 'DISCOUNT',
        'orders.discount' => 'DISCOUNT',
        'OrdersTableMap::COL_DISCOUNT' => 'DISCOUNT',
        'COL_DISCOUNT' => 'DISCOUNT',
        'AmountPaid' => 'AMOUNT_PAID',
        'Orders.AmountPaid' => 'AMOUNT_PAID',
        'amountPaid' => 'AMOUNT_PAID',
        'orders.amountPaid' => 'AMOUNT_PAID',
        'OrdersTableMap::COL_AMOUNT_PAID' => 'AMOUNT_PAID',
        'COL_AMOUNT_PAID' => 'AMOUNT_PAID',
        'amount_paid' => 'AMOUNT_PAID',
        'orders.amount_paid' => 'AMOUNT_PAID',
        'PrintedNote' => 'PRINTED_NOTE',
        'Orders.PrintedNote' => 'PRINTED_NOTE',
        'printedNote' => 'PRINTED_NOTE',
        'orders.printedNote' => 'PRINTED_NOTE',
        'OrdersTableMap::COL_PRINTED_NOTE' => 'PRINTED_NOTE',
        'COL_PRINTED_NOTE' => 'PRINTED_NOTE',
        'printed_note' => 'PRINTED_NOTE',
        'orders.printed_note' => 'PRINTED_NOTE',
        'PaymentStatus' => 'PAYMENT_STATUS',
        'Orders.PaymentStatus' => 'PAYMENT_STATUS',
        'paymentStatus' => 'PAYMENT_STATUS',
        'orders.paymentStatus' => 'PAYMENT_STATUS',
        'OrdersTableMap::COL_PAYMENT_STATUS' => 'PAYMENT_STATUS',
        'COL_PAYMENT_STATUS' => 'PAYMENT_STATUS',
        'payment_status' => 'PAYMENT_STATUS',
        'orders.payment_status' => 'PAYMENT_STATUS',
        'IdOrderStatus' => 'ID_ORDER_STATUS',
        'Orders.IdOrderStatus' => 'ID_ORDER_STATUS',
        'idOrderStatus' => 'ID_ORDER_STATUS',
        'orders.idOrderStatus' => 'ID_ORDER_STATUS',
        'OrdersTableMap::COL_ID_ORDER_STATUS' => 'ID_ORDER_STATUS',
        'COL_ID_ORDER_STATUS' => 'ID_ORDER_STATUS',
        'id_order_status' => 'ID_ORDER_STATUS',
        'orders.id_order_status' => 'ID_ORDER_STATUS',
        'FlagHomeService' => 'FLAG_HOME_SERVICE',
        'Orders.FlagHomeService' => 'FLAG_HOME_SERVICE',
        'flagHomeService' => 'FLAG_HOME_SERVICE',
        'orders.flagHomeService' => 'FLAG_HOME_SERVICE',
        'OrdersTableMap::COL_FLAG_HOME_SERVICE' => 'FLAG_HOME_SERVICE',
        'COL_FLAG_HOME_SERVICE' => 'FLAG_HOME_SERVICE',
        'flag_home_service' => 'FLAG_HOME_SERVICE',
        'orders.flag_home_service' => 'FLAG_HOME_SERVICE',
        'IdPaymentMethod' => 'ID_PAYMENT_METHOD',
        'Orders.IdPaymentMethod' => 'ID_PAYMENT_METHOD',
        'idPaymentMethod' => 'ID_PAYMENT_METHOD',
        'orders.idPaymentMethod' => 'ID_PAYMENT_METHOD',
        'OrdersTableMap::COL_ID_PAYMENT_METHOD' => 'ID_PAYMENT_METHOD',
        'COL_ID_PAYMENT_METHOD' => 'ID_PAYMENT_METHOD',
        'id_payment_method' => 'ID_PAYMENT_METHOD',
        'orders.id_payment_method' => 'ID_PAYMENT_METHOD',
        'IdUser' => 'ID_USER',
        'Orders.IdUser' => 'ID_USER',
        'idUser' => 'ID_USER',
        'orders.idUser' => 'ID_USER',
        'OrdersTableMap::COL_ID_USER' => 'ID_USER',
        'COL_ID_USER' => 'ID_USER',
        'id_user' => 'ID_USER',
        'orders.id_user' => 'ID_USER',
        'IdClientUser' => 'ID_CLIENT_USER',
        'Orders.IdClientUser' => 'ID_CLIENT_USER',
        'idClientUser' => 'ID_CLIENT_USER',
        'orders.idClientUser' => 'ID_CLIENT_USER',
        'OrdersTableMap::COL_ID_CLIENT_USER' => 'ID_CLIENT_USER',
        'COL_ID_CLIENT_USER' => 'ID_CLIENT_USER',
        'id_client_user' => 'ID_CLIENT_USER',
        'orders.id_client_user' => 'ID_CLIENT_USER',
        'HarvestComments' => 'HARVEST_COMMENTS',
        'Orders.HarvestComments' => 'HARVEST_COMMENTS',
        'harvestComments' => 'HARVEST_COMMENTS',
        'orders.harvestComments' => 'HARVEST_COMMENTS',
        'OrdersTableMap::COL_HARVEST_COMMENTS' => 'HARVEST_COMMENTS',
        'COL_HARVEST_COMMENTS' => 'HARVEST_COMMENTS',
        'harvest_comments' => 'HARVEST_COMMENTS',
        'orders.harvest_comments' => 'HARVEST_COMMENTS',
        'HarvestContactName' => 'HARVEST_CONTACT_NAME',
        'Orders.HarvestContactName' => 'HARVEST_CONTACT_NAME',
        'harvestContactName' => 'HARVEST_CONTACT_NAME',
        'orders.harvestContactName' => 'HARVEST_CONTACT_NAME',
        'OrdersTableMap::COL_HARVEST_CONTACT_NAME' => 'HARVEST_CONTACT_NAME',
        'COL_HARVEST_CONTACT_NAME' => 'HARVEST_CONTACT_NAME',
        'harvest_contact_name' => 'HARVEST_CONTACT_NAME',
        'orders.harvest_contact_name' => 'HARVEST_CONTACT_NAME',
        'HarvestContactSignature' => 'HARVEST_CONTACT_SIGNATURE',
        'Orders.HarvestContactSignature' => 'HARVEST_CONTACT_SIGNATURE',
        'harvestContactSignature' => 'HARVEST_CONTACT_SIGNATURE',
        'orders.harvestContactSignature' => 'HARVEST_CONTACT_SIGNATURE',
        'OrdersTableMap::COL_HARVEST_CONTACT_SIGNATURE' => 'HARVEST_CONTACT_SIGNATURE',
        'COL_HARVEST_CONTACT_SIGNATURE' => 'HARVEST_CONTACT_SIGNATURE',
        'harvest_contact_signature' => 'HARVEST_CONTACT_SIGNATURE',
        'orders.harvest_contact_signature' => 'HARVEST_CONTACT_SIGNATURE',
        'HarvestPhoto' => 'HARVEST_PHOTO',
        'Orders.HarvestPhoto' => 'HARVEST_PHOTO',
        'harvestPhoto' => 'HARVEST_PHOTO',
        'orders.harvestPhoto' => 'HARVEST_PHOTO',
        'OrdersTableMap::COL_HARVEST_PHOTO' => 'HARVEST_PHOTO',
        'COL_HARVEST_PHOTO' => 'HARVEST_PHOTO',
        'harvest_photo' => 'HARVEST_PHOTO',
        'orders.harvest_photo' => 'HARVEST_PHOTO',
        'DeliveryComments' => 'DELIVERY_COMMENTS',
        'Orders.DeliveryComments' => 'DELIVERY_COMMENTS',
        'deliveryComments' => 'DELIVERY_COMMENTS',
        'orders.deliveryComments' => 'DELIVERY_COMMENTS',
        'OrdersTableMap::COL_DELIVERY_COMMENTS' => 'DELIVERY_COMMENTS',
        'COL_DELIVERY_COMMENTS' => 'DELIVERY_COMMENTS',
        'delivery_comments' => 'DELIVERY_COMMENTS',
        'orders.delivery_comments' => 'DELIVERY_COMMENTS',
        'DeliveryContactName' => 'DELIVERY_CONTACT_NAME',
        'Orders.DeliveryContactName' => 'DELIVERY_CONTACT_NAME',
        'deliveryContactName' => 'DELIVERY_CONTACT_NAME',
        'orders.deliveryContactName' => 'DELIVERY_CONTACT_NAME',
        'OrdersTableMap::COL_DELIVERY_CONTACT_NAME' => 'DELIVERY_CONTACT_NAME',
        'COL_DELIVERY_CONTACT_NAME' => 'DELIVERY_CONTACT_NAME',
        'delivery_contact_name' => 'DELIVERY_CONTACT_NAME',
        'orders.delivery_contact_name' => 'DELIVERY_CONTACT_NAME',
        'DeliveryContactSignature' => 'DELIVERY_CONTACT_SIGNATURE',
        'Orders.DeliveryContactSignature' => 'DELIVERY_CONTACT_SIGNATURE',
        'deliveryContactSignature' => 'DELIVERY_CONTACT_SIGNATURE',
        'orders.deliveryContactSignature' => 'DELIVERY_CONTACT_SIGNATURE',
        'OrdersTableMap::COL_DELIVERY_CONTACT_SIGNATURE' => 'DELIVERY_CONTACT_SIGNATURE',
        'COL_DELIVERY_CONTACT_SIGNATURE' => 'DELIVERY_CONTACT_SIGNATURE',
        'delivery_contact_signature' => 'DELIVERY_CONTACT_SIGNATURE',
        'orders.delivery_contact_signature' => 'DELIVERY_CONTACT_SIGNATURE',
        'DeliveryPhoto' => 'DELIVERY_PHOTO',
        'Orders.DeliveryPhoto' => 'DELIVERY_PHOTO',
        'deliveryPhoto' => 'DELIVERY_PHOTO',
        'orders.deliveryPhoto' => 'DELIVERY_PHOTO',
        'OrdersTableMap::COL_DELIVERY_PHOTO' => 'DELIVERY_PHOTO',
        'COL_DELIVERY_PHOTO' => 'DELIVERY_PHOTO',
        'delivery_photo' => 'DELIVERY_PHOTO',
        'orders.delivery_photo' => 'DELIVERY_PHOTO',
        'Rank' => 'RANK',
        'Orders.Rank' => 'RANK',
        'rank' => 'RANK',
        'orders.rank' => 'RANK',
        'OrdersTableMap::COL_RANK' => 'RANK',
        'COL_RANK' => 'RANK',
        'Qualified' => 'QUALIFIED',
        'Orders.Qualified' => 'QUALIFIED',
        'qualified' => 'QUALIFIED',
        'orders.qualified' => 'QUALIFIED',
        'OrdersTableMap::COL_QUALIFIED' => 'QUALIFIED',
        'COL_QUALIFIED' => 'QUALIFIED',
        'ClientComments' => 'CLIENT_COMMENTS',
        'Orders.ClientComments' => 'CLIENT_COMMENTS',
        'clientComments' => 'CLIENT_COMMENTS',
        'orders.clientComments' => 'CLIENT_COMMENTS',
        'OrdersTableMap::COL_CLIENT_COMMENTS' => 'CLIENT_COMMENTS',
        'COL_CLIENT_COMMENTS' => 'CLIENT_COMMENTS',
        'client_comments' => 'CLIENT_COMMENTS',
        'orders.client_comments' => 'CLIENT_COMMENTS',
        'CreatedAt' => 'CREATED_AT',
        'Orders.CreatedAt' => 'CREATED_AT',
        'createdAt' => 'CREATED_AT',
        'orders.createdAt' => 'CREATED_AT',
        'OrdersTableMap::COL_CREATED_AT' => 'CREATED_AT',
        'COL_CREATED_AT' => 'CREATED_AT',
        'created_at' => 'CREATED_AT',
        'orders.created_at' => 'CREATED_AT',
        'UpdatedAt' => 'UPDATED_AT',
        'Orders.UpdatedAt' => 'UPDATED_AT',
        'updatedAt' => 'UPDATED_AT',
        'orders.updatedAt' => 'UPDATED_AT',
        'OrdersTableMap::COL_UPDATED_AT' => 'UPDATED_AT',
        'COL_UPDATED_AT' => 'UPDATED_AT',
        'updated_at' => 'UPDATED_AT',
        'orders.updated_at' => 'UPDATED_AT',
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
        $this->setName('orders');
        $this->setPhpName('Orders');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Orders');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, 10, null);
        $this->addForeignKey('id_branch_office', 'IdBranchOffice', 'INTEGER', 'branch_offices', 'id', true, 10, null);
        $this->addColumn('folio', 'Folio', 'INTEGER', true, 10, null);
        $this->addColumn('harvest_date', 'HarvestDate', 'VARCHAR', false, 191, null);
        $this->addColumn('harvest_time', 'HarvestTime', 'VARCHAR', false, 191, null);
        $this->addColumn('reception_date', 'ReceptionDate', 'DATE', true, null, null);
        $this->addColumn('reception_time', 'ReceptionTime', 'TIME', true, null, null);
        $this->addColumn('delivery_date', 'DeliveryDate', 'DATE', false, null, null);
        $this->addColumn('home_delivery', 'HomeDelivery', 'DATE', false, null, null);
        $this->addColumn('delivery_time', 'DeliveryTime', 'TIME', false, null, null);
        $this->addColumn('real_delivery_date', 'RealDeliveryDate', 'DATE', false, null, null);
        $this->addColumn('real_delivery_time', 'RealDeliveryTime', 'TIME', false, null, null);
        $this->addForeignKey('id_delivery_user', 'IdDeliveryUser', 'INTEGER', 'users', 'id', false, 10, null);
        $this->addForeignKey('id_priority', 'IdPriority', 'INTEGER', 'priorities', 'id', true, 10, null);
        $this->addColumn('pieces', 'Pieces', 'INTEGER', true, 10, 0);
        $this->addColumn('kilograms', 'Kilograms', 'DECIMAL', true, 8, 0.00);
        $this->addColumn('observations', 'Observations', 'VARCHAR', true, 200, '');
        $this->addColumn('subtotal', 'Subtotal', 'DECIMAL', true, 8, 0.00);
        $this->addColumn('total', 'Total', 'DECIMAL', true, 8, 0.00);
        $this->addColumn('discount', 'Discount', 'DECIMAL', true, 8, 0.00);
        $this->addColumn('amount_paid', 'AmountPaid', 'DECIMAL', true, 8, 0.00);
        $this->addColumn('printed_note', 'PrintedNote', 'INTEGER', true, 10, 0);
        $this->addColumn('payment_status', 'PaymentStatus', 'INTEGER', true, 10, 0);
        $this->addForeignKey('id_order_status', 'IdOrderStatus', 'INTEGER', 'order_status', 'id', true, 10, null);
        $this->addColumn('flag_home_service', 'FlagHomeService', 'INTEGER', true, 10, 0);
        $this->addForeignKey('id_payment_method', 'IdPaymentMethod', 'INTEGER', 'payment_methods', 'id', true, 10, null);
        $this->addForeignKey('id_user', 'IdUser', 'INTEGER', 'users', 'id', true, 10, null);
        $this->addForeignKey('id_client_user', 'IdClientUser', 'INTEGER', 'users', 'id', true, 10, null);
        $this->addColumn('harvest_comments', 'HarvestComments', 'VARCHAR', true, 1000, '');
        $this->addColumn('harvest_contact_name', 'HarvestContactName', 'VARCHAR', true, 191, '');
        $this->addColumn('harvest_contact_signature', 'HarvestContactSignature', 'LONGVARCHAR', true, null, null);
        $this->addColumn('harvest_photo', 'HarvestPhoto', 'LONGVARCHAR', true, null, null);
        $this->addColumn('delivery_comments', 'DeliveryComments', 'VARCHAR', true, 1000, '');
        $this->addColumn('delivery_contact_name', 'DeliveryContactName', 'VARCHAR', true, 191, '');
        $this->addColumn('delivery_contact_signature', 'DeliveryContactSignature', 'LONGVARCHAR', true, null, null);
        $this->addColumn('delivery_photo', 'DeliveryPhoto', 'LONGVARCHAR', true, null, null);
        $this->addColumn('rank', 'Rank', 'INTEGER', true, 10, 0);
        $this->addColumn('qualified', 'Qualified', 'INTEGER', true, 10, 0);
        $this->addColumn('client_comments', 'ClientComments', 'VARCHAR', true, 1000, '');
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
        $this->addRelation('UsersRelatedByIdClientUser', '\\Users', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_client_user',
    1 => ':id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('UsersRelatedByIdDeliveryUser', '\\Users', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_delivery_user',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('OrderStatus', '\\OrderStatus', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_order_status',
    1 => ':id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('PaymentMethods', '\\PaymentMethods', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_payment_method',
    1 => ':id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('Priorities', '\\Priorities', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_priority',
    1 => ':id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('UsersRelatedByIdUser', '\\Users', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_user',
    1 => ':id',
  ),
), null, 'CASCADE', null, false);
        $this->addRelation('Deliveries', '\\Deliveries', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_order',
    1 => ':id',
  ),
), null, 'CASCADE', 'Deliveriess', false);
        $this->addRelation('ElectronicPurseHistory', '\\ElectronicPurseHistory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_order',
    1 => ':id',
  ),
), null, 'CASCADE', 'ElectronicPurseHistories', false);
        $this->addRelation('OrderDetail', '\\OrderDetail', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_order',
    1 => ':id',
  ),
), null, 'CASCADE', 'OrderDetails', false);
        $this->addRelation('OrderHistory', '\\OrderHistory', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_order',
    1 => ':id',
  ),
), null, 'CASCADE', 'OrderHistories', false);
        $this->addRelation('Pickups', '\\Pickups', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_order',
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
        return $withPrefix ? OrdersTableMap::CLASS_DEFAULT : OrdersTableMap::OM_CLASS;
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
     * @return array           (Orders object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = OrdersTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = OrdersTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + OrdersTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = OrdersTableMap::OM_CLASS;
            /** @var Orders $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            OrdersTableMap::addInstanceToPool($obj, $key);
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
            $key = OrdersTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = OrdersTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Orders $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                OrdersTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(OrdersTableMap::COL_ID);
            $criteria->addSelectColumn(OrdersTableMap::COL_ID_BRANCH_OFFICE);
            $criteria->addSelectColumn(OrdersTableMap::COL_FOLIO);
            $criteria->addSelectColumn(OrdersTableMap::COL_HARVEST_DATE);
            $criteria->addSelectColumn(OrdersTableMap::COL_HARVEST_TIME);
            $criteria->addSelectColumn(OrdersTableMap::COL_RECEPTION_DATE);
            $criteria->addSelectColumn(OrdersTableMap::COL_RECEPTION_TIME);
            $criteria->addSelectColumn(OrdersTableMap::COL_DELIVERY_DATE);
            $criteria->addSelectColumn(OrdersTableMap::COL_HOME_DELIVERY);
            $criteria->addSelectColumn(OrdersTableMap::COL_DELIVERY_TIME);
            $criteria->addSelectColumn(OrdersTableMap::COL_REAL_DELIVERY_DATE);
            $criteria->addSelectColumn(OrdersTableMap::COL_REAL_DELIVERY_TIME);
            $criteria->addSelectColumn(OrdersTableMap::COL_ID_DELIVERY_USER);
            $criteria->addSelectColumn(OrdersTableMap::COL_ID_PRIORITY);
            $criteria->addSelectColumn(OrdersTableMap::COL_PIECES);
            $criteria->addSelectColumn(OrdersTableMap::COL_KILOGRAMS);
            $criteria->addSelectColumn(OrdersTableMap::COL_OBSERVATIONS);
            $criteria->addSelectColumn(OrdersTableMap::COL_SUBTOTAL);
            $criteria->addSelectColumn(OrdersTableMap::COL_TOTAL);
            $criteria->addSelectColumn(OrdersTableMap::COL_DISCOUNT);
            $criteria->addSelectColumn(OrdersTableMap::COL_AMOUNT_PAID);
            $criteria->addSelectColumn(OrdersTableMap::COL_PRINTED_NOTE);
            $criteria->addSelectColumn(OrdersTableMap::COL_PAYMENT_STATUS);
            $criteria->addSelectColumn(OrdersTableMap::COL_ID_ORDER_STATUS);
            $criteria->addSelectColumn(OrdersTableMap::COL_FLAG_HOME_SERVICE);
            $criteria->addSelectColumn(OrdersTableMap::COL_ID_PAYMENT_METHOD);
            $criteria->addSelectColumn(OrdersTableMap::COL_ID_USER);
            $criteria->addSelectColumn(OrdersTableMap::COL_ID_CLIENT_USER);
            $criteria->addSelectColumn(OrdersTableMap::COL_HARVEST_COMMENTS);
            $criteria->addSelectColumn(OrdersTableMap::COL_HARVEST_CONTACT_NAME);
            $criteria->addSelectColumn(OrdersTableMap::COL_HARVEST_CONTACT_SIGNATURE);
            $criteria->addSelectColumn(OrdersTableMap::COL_HARVEST_PHOTO);
            $criteria->addSelectColumn(OrdersTableMap::COL_DELIVERY_COMMENTS);
            $criteria->addSelectColumn(OrdersTableMap::COL_DELIVERY_CONTACT_NAME);
            $criteria->addSelectColumn(OrdersTableMap::COL_DELIVERY_CONTACT_SIGNATURE);
            $criteria->addSelectColumn(OrdersTableMap::COL_DELIVERY_PHOTO);
            $criteria->addSelectColumn(OrdersTableMap::COL_RANK);
            $criteria->addSelectColumn(OrdersTableMap::COL_QUALIFIED);
            $criteria->addSelectColumn(OrdersTableMap::COL_CLIENT_COMMENTS);
            $criteria->addSelectColumn(OrdersTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(OrdersTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.id_branch_office');
            $criteria->addSelectColumn($alias . '.folio');
            $criteria->addSelectColumn($alias . '.harvest_date');
            $criteria->addSelectColumn($alias . '.harvest_time');
            $criteria->addSelectColumn($alias . '.reception_date');
            $criteria->addSelectColumn($alias . '.reception_time');
            $criteria->addSelectColumn($alias . '.delivery_date');
            $criteria->addSelectColumn($alias . '.home_delivery');
            $criteria->addSelectColumn($alias . '.delivery_time');
            $criteria->addSelectColumn($alias . '.real_delivery_date');
            $criteria->addSelectColumn($alias . '.real_delivery_time');
            $criteria->addSelectColumn($alias . '.id_delivery_user');
            $criteria->addSelectColumn($alias . '.id_priority');
            $criteria->addSelectColumn($alias . '.pieces');
            $criteria->addSelectColumn($alias . '.kilograms');
            $criteria->addSelectColumn($alias . '.observations');
            $criteria->addSelectColumn($alias . '.subtotal');
            $criteria->addSelectColumn($alias . '.total');
            $criteria->addSelectColumn($alias . '.discount');
            $criteria->addSelectColumn($alias . '.amount_paid');
            $criteria->addSelectColumn($alias . '.printed_note');
            $criteria->addSelectColumn($alias . '.payment_status');
            $criteria->addSelectColumn($alias . '.id_order_status');
            $criteria->addSelectColumn($alias . '.flag_home_service');
            $criteria->addSelectColumn($alias . '.id_payment_method');
            $criteria->addSelectColumn($alias . '.id_user');
            $criteria->addSelectColumn($alias . '.id_client_user');
            $criteria->addSelectColumn($alias . '.harvest_comments');
            $criteria->addSelectColumn($alias . '.harvest_contact_name');
            $criteria->addSelectColumn($alias . '.harvest_contact_signature');
            $criteria->addSelectColumn($alias . '.harvest_photo');
            $criteria->addSelectColumn($alias . '.delivery_comments');
            $criteria->addSelectColumn($alias . '.delivery_contact_name');
            $criteria->addSelectColumn($alias . '.delivery_contact_signature');
            $criteria->addSelectColumn($alias . '.delivery_photo');
            $criteria->addSelectColumn($alias . '.rank');
            $criteria->addSelectColumn($alias . '.qualified');
            $criteria->addSelectColumn($alias . '.client_comments');
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
            $criteria->removeSelectColumn(OrdersTableMap::COL_ID);
            $criteria->removeSelectColumn(OrdersTableMap::COL_ID_BRANCH_OFFICE);
            $criteria->removeSelectColumn(OrdersTableMap::COL_FOLIO);
            $criteria->removeSelectColumn(OrdersTableMap::COL_HARVEST_DATE);
            $criteria->removeSelectColumn(OrdersTableMap::COL_HARVEST_TIME);
            $criteria->removeSelectColumn(OrdersTableMap::COL_RECEPTION_DATE);
            $criteria->removeSelectColumn(OrdersTableMap::COL_RECEPTION_TIME);
            $criteria->removeSelectColumn(OrdersTableMap::COL_DELIVERY_DATE);
            $criteria->removeSelectColumn(OrdersTableMap::COL_HOME_DELIVERY);
            $criteria->removeSelectColumn(OrdersTableMap::COL_DELIVERY_TIME);
            $criteria->removeSelectColumn(OrdersTableMap::COL_REAL_DELIVERY_DATE);
            $criteria->removeSelectColumn(OrdersTableMap::COL_REAL_DELIVERY_TIME);
            $criteria->removeSelectColumn(OrdersTableMap::COL_ID_DELIVERY_USER);
            $criteria->removeSelectColumn(OrdersTableMap::COL_ID_PRIORITY);
            $criteria->removeSelectColumn(OrdersTableMap::COL_PIECES);
            $criteria->removeSelectColumn(OrdersTableMap::COL_KILOGRAMS);
            $criteria->removeSelectColumn(OrdersTableMap::COL_OBSERVATIONS);
            $criteria->removeSelectColumn(OrdersTableMap::COL_SUBTOTAL);
            $criteria->removeSelectColumn(OrdersTableMap::COL_TOTAL);
            $criteria->removeSelectColumn(OrdersTableMap::COL_DISCOUNT);
            $criteria->removeSelectColumn(OrdersTableMap::COL_AMOUNT_PAID);
            $criteria->removeSelectColumn(OrdersTableMap::COL_PRINTED_NOTE);
            $criteria->removeSelectColumn(OrdersTableMap::COL_PAYMENT_STATUS);
            $criteria->removeSelectColumn(OrdersTableMap::COL_ID_ORDER_STATUS);
            $criteria->removeSelectColumn(OrdersTableMap::COL_FLAG_HOME_SERVICE);
            $criteria->removeSelectColumn(OrdersTableMap::COL_ID_PAYMENT_METHOD);
            $criteria->removeSelectColumn(OrdersTableMap::COL_ID_USER);
            $criteria->removeSelectColumn(OrdersTableMap::COL_ID_CLIENT_USER);
            $criteria->removeSelectColumn(OrdersTableMap::COL_HARVEST_COMMENTS);
            $criteria->removeSelectColumn(OrdersTableMap::COL_HARVEST_CONTACT_NAME);
            $criteria->removeSelectColumn(OrdersTableMap::COL_HARVEST_CONTACT_SIGNATURE);
            $criteria->removeSelectColumn(OrdersTableMap::COL_HARVEST_PHOTO);
            $criteria->removeSelectColumn(OrdersTableMap::COL_DELIVERY_COMMENTS);
            $criteria->removeSelectColumn(OrdersTableMap::COL_DELIVERY_CONTACT_NAME);
            $criteria->removeSelectColumn(OrdersTableMap::COL_DELIVERY_CONTACT_SIGNATURE);
            $criteria->removeSelectColumn(OrdersTableMap::COL_DELIVERY_PHOTO);
            $criteria->removeSelectColumn(OrdersTableMap::COL_RANK);
            $criteria->removeSelectColumn(OrdersTableMap::COL_QUALIFIED);
            $criteria->removeSelectColumn(OrdersTableMap::COL_CLIENT_COMMENTS);
            $criteria->removeSelectColumn(OrdersTableMap::COL_CREATED_AT);
            $criteria->removeSelectColumn(OrdersTableMap::COL_UPDATED_AT);
        } else {
            $criteria->removeSelectColumn($alias . '.id');
            $criteria->removeSelectColumn($alias . '.id_branch_office');
            $criteria->removeSelectColumn($alias . '.folio');
            $criteria->removeSelectColumn($alias . '.harvest_date');
            $criteria->removeSelectColumn($alias . '.harvest_time');
            $criteria->removeSelectColumn($alias . '.reception_date');
            $criteria->removeSelectColumn($alias . '.reception_time');
            $criteria->removeSelectColumn($alias . '.delivery_date');
            $criteria->removeSelectColumn($alias . '.home_delivery');
            $criteria->removeSelectColumn($alias . '.delivery_time');
            $criteria->removeSelectColumn($alias . '.real_delivery_date');
            $criteria->removeSelectColumn($alias . '.real_delivery_time');
            $criteria->removeSelectColumn($alias . '.id_delivery_user');
            $criteria->removeSelectColumn($alias . '.id_priority');
            $criteria->removeSelectColumn($alias . '.pieces');
            $criteria->removeSelectColumn($alias . '.kilograms');
            $criteria->removeSelectColumn($alias . '.observations');
            $criteria->removeSelectColumn($alias . '.subtotal');
            $criteria->removeSelectColumn($alias . '.total');
            $criteria->removeSelectColumn($alias . '.discount');
            $criteria->removeSelectColumn($alias . '.amount_paid');
            $criteria->removeSelectColumn($alias . '.printed_note');
            $criteria->removeSelectColumn($alias . '.payment_status');
            $criteria->removeSelectColumn($alias . '.id_order_status');
            $criteria->removeSelectColumn($alias . '.flag_home_service');
            $criteria->removeSelectColumn($alias . '.id_payment_method');
            $criteria->removeSelectColumn($alias . '.id_user');
            $criteria->removeSelectColumn($alias . '.id_client_user');
            $criteria->removeSelectColumn($alias . '.harvest_comments');
            $criteria->removeSelectColumn($alias . '.harvest_contact_name');
            $criteria->removeSelectColumn($alias . '.harvest_contact_signature');
            $criteria->removeSelectColumn($alias . '.harvest_photo');
            $criteria->removeSelectColumn($alias . '.delivery_comments');
            $criteria->removeSelectColumn($alias . '.delivery_contact_name');
            $criteria->removeSelectColumn($alias . '.delivery_contact_signature');
            $criteria->removeSelectColumn($alias . '.delivery_photo');
            $criteria->removeSelectColumn($alias . '.rank');
            $criteria->removeSelectColumn($alias . '.qualified');
            $criteria->removeSelectColumn($alias . '.client_comments');
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
        return Propel::getServiceContainer()->getDatabaseMap(OrdersTableMap::DATABASE_NAME)->getTable(OrdersTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Orders or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Orders object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(OrdersTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Orders) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(OrdersTableMap::DATABASE_NAME);
            $criteria->add(OrdersTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = OrdersQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            OrdersTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                OrdersTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the orders table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return OrdersQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Orders or Criteria object.
     *
     * @param mixed               $criteria Criteria or Orders object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrdersTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Orders object
        }

        if ($criteria->containsKey(OrdersTableMap::COL_ID) && $criteria->keyContainsValue(OrdersTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.OrdersTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = OrdersQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // OrdersTableMap
