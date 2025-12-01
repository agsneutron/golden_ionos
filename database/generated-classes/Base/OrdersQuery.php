<?php

namespace Base;

use \Orders as ChildOrders;
use \OrdersQuery as ChildOrdersQuery;
use \Exception;
use \PDO;
use Map\OrdersTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'orders' table.
 *
 *
 *
 * @method     ChildOrdersQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildOrdersQuery orderByIdBranchOffice($order = Criteria::ASC) Order by the id_branch_office column
 * @method     ChildOrdersQuery orderByFolio($order = Criteria::ASC) Order by the folio column
 * @method     ChildOrdersQuery orderByHarvestDate($order = Criteria::ASC) Order by the harvest_date column
 * @method     ChildOrdersQuery orderByHarvestTime($order = Criteria::ASC) Order by the harvest_time column
 * @method     ChildOrdersQuery orderByReceptionDate($order = Criteria::ASC) Order by the reception_date column
 * @method     ChildOrdersQuery orderByReceptionTime($order = Criteria::ASC) Order by the reception_time column
 * @method     ChildOrdersQuery orderByDeliveryDate($order = Criteria::ASC) Order by the delivery_date column
 * @method     ChildOrdersQuery orderByHomeDelivery($order = Criteria::ASC) Order by the home_delivery column
 * @method     ChildOrdersQuery orderByDeliveryTime($order = Criteria::ASC) Order by the delivery_time column
 * @method     ChildOrdersQuery orderByRealDeliveryDate($order = Criteria::ASC) Order by the real_delivery_date column
 * @method     ChildOrdersQuery orderByRealDeliveryTime($order = Criteria::ASC) Order by the real_delivery_time column
 * @method     ChildOrdersQuery orderByIdDeliveryUser($order = Criteria::ASC) Order by the id_delivery_user column
 * @method     ChildOrdersQuery orderByIdPriority($order = Criteria::ASC) Order by the id_priority column
 * @method     ChildOrdersQuery orderByPieces($order = Criteria::ASC) Order by the pieces column
 * @method     ChildOrdersQuery orderByKilograms($order = Criteria::ASC) Order by the kilograms column
 * @method     ChildOrdersQuery orderByObservations($order = Criteria::ASC) Order by the observations column
 * @method     ChildOrdersQuery orderBySubtotal($order = Criteria::ASC) Order by the subtotal column
 * @method     ChildOrdersQuery orderByTotal($order = Criteria::ASC) Order by the total column
 * @method     ChildOrdersQuery orderByDiscount($order = Criteria::ASC) Order by the discount column
 * @method     ChildOrdersQuery orderByAmountPaid($order = Criteria::ASC) Order by the amount_paid column
 * @method     ChildOrdersQuery orderByPrintedNote($order = Criteria::ASC) Order by the printed_note column
 * @method     ChildOrdersQuery orderByPaymentStatus($order = Criteria::ASC) Order by the payment_status column
 * @method     ChildOrdersQuery orderByIdOrderStatus($order = Criteria::ASC) Order by the id_order_status column
 * @method     ChildOrdersQuery orderByFlagHomeService($order = Criteria::ASC) Order by the flag_home_service column
 * @method     ChildOrdersQuery orderByIdPaymentMethod($order = Criteria::ASC) Order by the id_payment_method column
 * @method     ChildOrdersQuery orderByIdUser($order = Criteria::ASC) Order by the id_user column
 * @method     ChildOrdersQuery orderByIdClientUser($order = Criteria::ASC) Order by the id_client_user column
 * @method     ChildOrdersQuery orderByHarvestComments($order = Criteria::ASC) Order by the harvest_comments column
 * @method     ChildOrdersQuery orderByHarvestContactName($order = Criteria::ASC) Order by the harvest_contact_name column
 * @method     ChildOrdersQuery orderByHarvestContactSignature($order = Criteria::ASC) Order by the harvest_contact_signature column
 * @method     ChildOrdersQuery orderByHarvestPhoto($order = Criteria::ASC) Order by the harvest_photo column
 * @method     ChildOrdersQuery orderByDeliveryComments($order = Criteria::ASC) Order by the delivery_comments column
 * @method     ChildOrdersQuery orderByDeliveryContactName($order = Criteria::ASC) Order by the delivery_contact_name column
 * @method     ChildOrdersQuery orderByDeliveryContactSignature($order = Criteria::ASC) Order by the delivery_contact_signature column
 * @method     ChildOrdersQuery orderByDeliveryPhoto($order = Criteria::ASC) Order by the delivery_photo column
 * @method     ChildOrdersQuery orderByRank($order = Criteria::ASC) Order by the rank column
 * @method     ChildOrdersQuery orderByQualified($order = Criteria::ASC) Order by the qualified column
 * @method     ChildOrdersQuery orderByClientComments($order = Criteria::ASC) Order by the client_comments column
 * @method     ChildOrdersQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildOrdersQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildOrdersQuery groupById() Group by the id column
 * @method     ChildOrdersQuery groupByIdBranchOffice() Group by the id_branch_office column
 * @method     ChildOrdersQuery groupByFolio() Group by the folio column
 * @method     ChildOrdersQuery groupByHarvestDate() Group by the harvest_date column
 * @method     ChildOrdersQuery groupByHarvestTime() Group by the harvest_time column
 * @method     ChildOrdersQuery groupByReceptionDate() Group by the reception_date column
 * @method     ChildOrdersQuery groupByReceptionTime() Group by the reception_time column
 * @method     ChildOrdersQuery groupByDeliveryDate() Group by the delivery_date column
 * @method     ChildOrdersQuery groupByHomeDelivery() Group by the home_delivery column
 * @method     ChildOrdersQuery groupByDeliveryTime() Group by the delivery_time column
 * @method     ChildOrdersQuery groupByRealDeliveryDate() Group by the real_delivery_date column
 * @method     ChildOrdersQuery groupByRealDeliveryTime() Group by the real_delivery_time column
 * @method     ChildOrdersQuery groupByIdDeliveryUser() Group by the id_delivery_user column
 * @method     ChildOrdersQuery groupByIdPriority() Group by the id_priority column
 * @method     ChildOrdersQuery groupByPieces() Group by the pieces column
 * @method     ChildOrdersQuery groupByKilograms() Group by the kilograms column
 * @method     ChildOrdersQuery groupByObservations() Group by the observations column
 * @method     ChildOrdersQuery groupBySubtotal() Group by the subtotal column
 * @method     ChildOrdersQuery groupByTotal() Group by the total column
 * @method     ChildOrdersQuery groupByDiscount() Group by the discount column
 * @method     ChildOrdersQuery groupByAmountPaid() Group by the amount_paid column
 * @method     ChildOrdersQuery groupByPrintedNote() Group by the printed_note column
 * @method     ChildOrdersQuery groupByPaymentStatus() Group by the payment_status column
 * @method     ChildOrdersQuery groupByIdOrderStatus() Group by the id_order_status column
 * @method     ChildOrdersQuery groupByFlagHomeService() Group by the flag_home_service column
 * @method     ChildOrdersQuery groupByIdPaymentMethod() Group by the id_payment_method column
 * @method     ChildOrdersQuery groupByIdUser() Group by the id_user column
 * @method     ChildOrdersQuery groupByIdClientUser() Group by the id_client_user column
 * @method     ChildOrdersQuery groupByHarvestComments() Group by the harvest_comments column
 * @method     ChildOrdersQuery groupByHarvestContactName() Group by the harvest_contact_name column
 * @method     ChildOrdersQuery groupByHarvestContactSignature() Group by the harvest_contact_signature column
 * @method     ChildOrdersQuery groupByHarvestPhoto() Group by the harvest_photo column
 * @method     ChildOrdersQuery groupByDeliveryComments() Group by the delivery_comments column
 * @method     ChildOrdersQuery groupByDeliveryContactName() Group by the delivery_contact_name column
 * @method     ChildOrdersQuery groupByDeliveryContactSignature() Group by the delivery_contact_signature column
 * @method     ChildOrdersQuery groupByDeliveryPhoto() Group by the delivery_photo column
 * @method     ChildOrdersQuery groupByRank() Group by the rank column
 * @method     ChildOrdersQuery groupByQualified() Group by the qualified column
 * @method     ChildOrdersQuery groupByClientComments() Group by the client_comments column
 * @method     ChildOrdersQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildOrdersQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildOrdersQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildOrdersQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildOrdersQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildOrdersQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildOrdersQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildOrdersQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildOrdersQuery leftJoinBranchOffices($relationAlias = null) Adds a LEFT JOIN clause to the query using the BranchOffices relation
 * @method     ChildOrdersQuery rightJoinBranchOffices($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BranchOffices relation
 * @method     ChildOrdersQuery innerJoinBranchOffices($relationAlias = null) Adds a INNER JOIN clause to the query using the BranchOffices relation
 *
 * @method     ChildOrdersQuery joinWithBranchOffices($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the BranchOffices relation
 *
 * @method     ChildOrdersQuery leftJoinWithBranchOffices() Adds a LEFT JOIN clause and with to the query using the BranchOffices relation
 * @method     ChildOrdersQuery rightJoinWithBranchOffices() Adds a RIGHT JOIN clause and with to the query using the BranchOffices relation
 * @method     ChildOrdersQuery innerJoinWithBranchOffices() Adds a INNER JOIN clause and with to the query using the BranchOffices relation
 *
 * @method     ChildOrdersQuery leftJoinUsersRelatedByIdClientUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsersRelatedByIdClientUser relation
 * @method     ChildOrdersQuery rightJoinUsersRelatedByIdClientUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsersRelatedByIdClientUser relation
 * @method     ChildOrdersQuery innerJoinUsersRelatedByIdClientUser($relationAlias = null) Adds a INNER JOIN clause to the query using the UsersRelatedByIdClientUser relation
 *
 * @method     ChildOrdersQuery joinWithUsersRelatedByIdClientUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UsersRelatedByIdClientUser relation
 *
 * @method     ChildOrdersQuery leftJoinWithUsersRelatedByIdClientUser() Adds a LEFT JOIN clause and with to the query using the UsersRelatedByIdClientUser relation
 * @method     ChildOrdersQuery rightJoinWithUsersRelatedByIdClientUser() Adds a RIGHT JOIN clause and with to the query using the UsersRelatedByIdClientUser relation
 * @method     ChildOrdersQuery innerJoinWithUsersRelatedByIdClientUser() Adds a INNER JOIN clause and with to the query using the UsersRelatedByIdClientUser relation
 *
 * @method     ChildOrdersQuery leftJoinUsersRelatedByIdDeliveryUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsersRelatedByIdDeliveryUser relation
 * @method     ChildOrdersQuery rightJoinUsersRelatedByIdDeliveryUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsersRelatedByIdDeliveryUser relation
 * @method     ChildOrdersQuery innerJoinUsersRelatedByIdDeliveryUser($relationAlias = null) Adds a INNER JOIN clause to the query using the UsersRelatedByIdDeliveryUser relation
 *
 * @method     ChildOrdersQuery joinWithUsersRelatedByIdDeliveryUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UsersRelatedByIdDeliveryUser relation
 *
 * @method     ChildOrdersQuery leftJoinWithUsersRelatedByIdDeliveryUser() Adds a LEFT JOIN clause and with to the query using the UsersRelatedByIdDeliveryUser relation
 * @method     ChildOrdersQuery rightJoinWithUsersRelatedByIdDeliveryUser() Adds a RIGHT JOIN clause and with to the query using the UsersRelatedByIdDeliveryUser relation
 * @method     ChildOrdersQuery innerJoinWithUsersRelatedByIdDeliveryUser() Adds a INNER JOIN clause and with to the query using the UsersRelatedByIdDeliveryUser relation
 *
 * @method     ChildOrdersQuery leftJoinOrderStatus($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderStatus relation
 * @method     ChildOrdersQuery rightJoinOrderStatus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderStatus relation
 * @method     ChildOrdersQuery innerJoinOrderStatus($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderStatus relation
 *
 * @method     ChildOrdersQuery joinWithOrderStatus($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderStatus relation
 *
 * @method     ChildOrdersQuery leftJoinWithOrderStatus() Adds a LEFT JOIN clause and with to the query using the OrderStatus relation
 * @method     ChildOrdersQuery rightJoinWithOrderStatus() Adds a RIGHT JOIN clause and with to the query using the OrderStatus relation
 * @method     ChildOrdersQuery innerJoinWithOrderStatus() Adds a INNER JOIN clause and with to the query using the OrderStatus relation
 *
 * @method     ChildOrdersQuery leftJoinPaymentMethods($relationAlias = null) Adds a LEFT JOIN clause to the query using the PaymentMethods relation
 * @method     ChildOrdersQuery rightJoinPaymentMethods($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PaymentMethods relation
 * @method     ChildOrdersQuery innerJoinPaymentMethods($relationAlias = null) Adds a INNER JOIN clause to the query using the PaymentMethods relation
 *
 * @method     ChildOrdersQuery joinWithPaymentMethods($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PaymentMethods relation
 *
 * @method     ChildOrdersQuery leftJoinWithPaymentMethods() Adds a LEFT JOIN clause and with to the query using the PaymentMethods relation
 * @method     ChildOrdersQuery rightJoinWithPaymentMethods() Adds a RIGHT JOIN clause and with to the query using the PaymentMethods relation
 * @method     ChildOrdersQuery innerJoinWithPaymentMethods() Adds a INNER JOIN clause and with to the query using the PaymentMethods relation
 *
 * @method     ChildOrdersQuery leftJoinPriorities($relationAlias = null) Adds a LEFT JOIN clause to the query using the Priorities relation
 * @method     ChildOrdersQuery rightJoinPriorities($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Priorities relation
 * @method     ChildOrdersQuery innerJoinPriorities($relationAlias = null) Adds a INNER JOIN clause to the query using the Priorities relation
 *
 * @method     ChildOrdersQuery joinWithPriorities($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Priorities relation
 *
 * @method     ChildOrdersQuery leftJoinWithPriorities() Adds a LEFT JOIN clause and with to the query using the Priorities relation
 * @method     ChildOrdersQuery rightJoinWithPriorities() Adds a RIGHT JOIN clause and with to the query using the Priorities relation
 * @method     ChildOrdersQuery innerJoinWithPriorities() Adds a INNER JOIN clause and with to the query using the Priorities relation
 *
 * @method     ChildOrdersQuery leftJoinUsersRelatedByIdUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsersRelatedByIdUser relation
 * @method     ChildOrdersQuery rightJoinUsersRelatedByIdUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsersRelatedByIdUser relation
 * @method     ChildOrdersQuery innerJoinUsersRelatedByIdUser($relationAlias = null) Adds a INNER JOIN clause to the query using the UsersRelatedByIdUser relation
 *
 * @method     ChildOrdersQuery joinWithUsersRelatedByIdUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UsersRelatedByIdUser relation
 *
 * @method     ChildOrdersQuery leftJoinWithUsersRelatedByIdUser() Adds a LEFT JOIN clause and with to the query using the UsersRelatedByIdUser relation
 * @method     ChildOrdersQuery rightJoinWithUsersRelatedByIdUser() Adds a RIGHT JOIN clause and with to the query using the UsersRelatedByIdUser relation
 * @method     ChildOrdersQuery innerJoinWithUsersRelatedByIdUser() Adds a INNER JOIN clause and with to the query using the UsersRelatedByIdUser relation
 *
 * @method     ChildOrdersQuery leftJoinDeliveries($relationAlias = null) Adds a LEFT JOIN clause to the query using the Deliveries relation
 * @method     ChildOrdersQuery rightJoinDeliveries($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Deliveries relation
 * @method     ChildOrdersQuery innerJoinDeliveries($relationAlias = null) Adds a INNER JOIN clause to the query using the Deliveries relation
 *
 * @method     ChildOrdersQuery joinWithDeliveries($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Deliveries relation
 *
 * @method     ChildOrdersQuery leftJoinWithDeliveries() Adds a LEFT JOIN clause and with to the query using the Deliveries relation
 * @method     ChildOrdersQuery rightJoinWithDeliveries() Adds a RIGHT JOIN clause and with to the query using the Deliveries relation
 * @method     ChildOrdersQuery innerJoinWithDeliveries() Adds a INNER JOIN clause and with to the query using the Deliveries relation
 *
 * @method     ChildOrdersQuery leftJoinElectronicPurseHistory($relationAlias = null) Adds a LEFT JOIN clause to the query using the ElectronicPurseHistory relation
 * @method     ChildOrdersQuery rightJoinElectronicPurseHistory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ElectronicPurseHistory relation
 * @method     ChildOrdersQuery innerJoinElectronicPurseHistory($relationAlias = null) Adds a INNER JOIN clause to the query using the ElectronicPurseHistory relation
 *
 * @method     ChildOrdersQuery joinWithElectronicPurseHistory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ElectronicPurseHistory relation
 *
 * @method     ChildOrdersQuery leftJoinWithElectronicPurseHistory() Adds a LEFT JOIN clause and with to the query using the ElectronicPurseHistory relation
 * @method     ChildOrdersQuery rightJoinWithElectronicPurseHistory() Adds a RIGHT JOIN clause and with to the query using the ElectronicPurseHistory relation
 * @method     ChildOrdersQuery innerJoinWithElectronicPurseHistory() Adds a INNER JOIN clause and with to the query using the ElectronicPurseHistory relation
 *
 * @method     ChildOrdersQuery leftJoinOrderDetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderDetail relation
 * @method     ChildOrdersQuery rightJoinOrderDetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderDetail relation
 * @method     ChildOrdersQuery innerJoinOrderDetail($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderDetail relation
 *
 * @method     ChildOrdersQuery joinWithOrderDetail($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderDetail relation
 *
 * @method     ChildOrdersQuery leftJoinWithOrderDetail() Adds a LEFT JOIN clause and with to the query using the OrderDetail relation
 * @method     ChildOrdersQuery rightJoinWithOrderDetail() Adds a RIGHT JOIN clause and with to the query using the OrderDetail relation
 * @method     ChildOrdersQuery innerJoinWithOrderDetail() Adds a INNER JOIN clause and with to the query using the OrderDetail relation
 *
 * @method     ChildOrdersQuery leftJoinOrderHistory($relationAlias = null) Adds a LEFT JOIN clause to the query using the OrderHistory relation
 * @method     ChildOrdersQuery rightJoinOrderHistory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the OrderHistory relation
 * @method     ChildOrdersQuery innerJoinOrderHistory($relationAlias = null) Adds a INNER JOIN clause to the query using the OrderHistory relation
 *
 * @method     ChildOrdersQuery joinWithOrderHistory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the OrderHistory relation
 *
 * @method     ChildOrdersQuery leftJoinWithOrderHistory() Adds a LEFT JOIN clause and with to the query using the OrderHistory relation
 * @method     ChildOrdersQuery rightJoinWithOrderHistory() Adds a RIGHT JOIN clause and with to the query using the OrderHistory relation
 * @method     ChildOrdersQuery innerJoinWithOrderHistory() Adds a INNER JOIN clause and with to the query using the OrderHistory relation
 *
 * @method     ChildOrdersQuery leftJoinPickups($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pickups relation
 * @method     ChildOrdersQuery rightJoinPickups($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pickups relation
 * @method     ChildOrdersQuery innerJoinPickups($relationAlias = null) Adds a INNER JOIN clause to the query using the Pickups relation
 *
 * @method     ChildOrdersQuery joinWithPickups($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Pickups relation
 *
 * @method     ChildOrdersQuery leftJoinWithPickups() Adds a LEFT JOIN clause and with to the query using the Pickups relation
 * @method     ChildOrdersQuery rightJoinWithPickups() Adds a RIGHT JOIN clause and with to the query using the Pickups relation
 * @method     ChildOrdersQuery innerJoinWithPickups() Adds a INNER JOIN clause and with to the query using the Pickups relation
 *
 * @method     \BranchOfficesQuery|\UsersQuery|\OrderStatusQuery|\PaymentMethodsQuery|\PrioritiesQuery|\DeliveriesQuery|\ElectronicPurseHistoryQuery|\OrderDetailQuery|\OrderHistoryQuery|\PickupsQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildOrders|null findOne(ConnectionInterface $con = null) Return the first ChildOrders matching the query
 * @method     ChildOrders findOneOrCreate(ConnectionInterface $con = null) Return the first ChildOrders matching the query, or a new ChildOrders object populated from the query conditions when no match is found
 *
 * @method     ChildOrders|null findOneById(int $id) Return the first ChildOrders filtered by the id column
 * @method     ChildOrders|null findOneByIdBranchOffice(int $id_branch_office) Return the first ChildOrders filtered by the id_branch_office column
 * @method     ChildOrders|null findOneByFolio(int $folio) Return the first ChildOrders filtered by the folio column
 * @method     ChildOrders|null findOneByHarvestDate(string $harvest_date) Return the first ChildOrders filtered by the harvest_date column
 * @method     ChildOrders|null findOneByHarvestTime(string $harvest_time) Return the first ChildOrders filtered by the harvest_time column
 * @method     ChildOrders|null findOneByReceptionDate(string $reception_date) Return the first ChildOrders filtered by the reception_date column
 * @method     ChildOrders|null findOneByReceptionTime(string $reception_time) Return the first ChildOrders filtered by the reception_time column
 * @method     ChildOrders|null findOneByDeliveryDate(string $delivery_date) Return the first ChildOrders filtered by the delivery_date column
 * @method     ChildOrders|null findOneByHomeDelivery(string $home_delivery) Return the first ChildOrders filtered by the home_delivery column
 * @method     ChildOrders|null findOneByDeliveryTime(string $delivery_time) Return the first ChildOrders filtered by the delivery_time column
 * @method     ChildOrders|null findOneByRealDeliveryDate(string $real_delivery_date) Return the first ChildOrders filtered by the real_delivery_date column
 * @method     ChildOrders|null findOneByRealDeliveryTime(string $real_delivery_time) Return the first ChildOrders filtered by the real_delivery_time column
 * @method     ChildOrders|null findOneByIdDeliveryUser(int $id_delivery_user) Return the first ChildOrders filtered by the id_delivery_user column
 * @method     ChildOrders|null findOneByIdPriority(int $id_priority) Return the first ChildOrders filtered by the id_priority column
 * @method     ChildOrders|null findOneByPieces(int $pieces) Return the first ChildOrders filtered by the pieces column
 * @method     ChildOrders|null findOneByKilograms(string $kilograms) Return the first ChildOrders filtered by the kilograms column
 * @method     ChildOrders|null findOneByObservations(string $observations) Return the first ChildOrders filtered by the observations column
 * @method     ChildOrders|null findOneBySubtotal(string $subtotal) Return the first ChildOrders filtered by the subtotal column
 * @method     ChildOrders|null findOneByTotal(string $total) Return the first ChildOrders filtered by the total column
 * @method     ChildOrders|null findOneByDiscount(string $discount) Return the first ChildOrders filtered by the discount column
 * @method     ChildOrders|null findOneByAmountPaid(string $amount_paid) Return the first ChildOrders filtered by the amount_paid column
 * @method     ChildOrders|null findOneByPrintedNote(int $printed_note) Return the first ChildOrders filtered by the printed_note column
 * @method     ChildOrders|null findOneByPaymentStatus(int $payment_status) Return the first ChildOrders filtered by the payment_status column
 * @method     ChildOrders|null findOneByIdOrderStatus(int $id_order_status) Return the first ChildOrders filtered by the id_order_status column
 * @method     ChildOrders|null findOneByFlagHomeService(int $flag_home_service) Return the first ChildOrders filtered by the flag_home_service column
 * @method     ChildOrders|null findOneByIdPaymentMethod(int $id_payment_method) Return the first ChildOrders filtered by the id_payment_method column
 * @method     ChildOrders|null findOneByIdUser(int $id_user) Return the first ChildOrders filtered by the id_user column
 * @method     ChildOrders|null findOneByIdClientUser(int $id_client_user) Return the first ChildOrders filtered by the id_client_user column
 * @method     ChildOrders|null findOneByHarvestComments(string $harvest_comments) Return the first ChildOrders filtered by the harvest_comments column
 * @method     ChildOrders|null findOneByHarvestContactName(string $harvest_contact_name) Return the first ChildOrders filtered by the harvest_contact_name column
 * @method     ChildOrders|null findOneByHarvestContactSignature(string $harvest_contact_signature) Return the first ChildOrders filtered by the harvest_contact_signature column
 * @method     ChildOrders|null findOneByHarvestPhoto(string $harvest_photo) Return the first ChildOrders filtered by the harvest_photo column
 * @method     ChildOrders|null findOneByDeliveryComments(string $delivery_comments) Return the first ChildOrders filtered by the delivery_comments column
 * @method     ChildOrders|null findOneByDeliveryContactName(string $delivery_contact_name) Return the first ChildOrders filtered by the delivery_contact_name column
 * @method     ChildOrders|null findOneByDeliveryContactSignature(string $delivery_contact_signature) Return the first ChildOrders filtered by the delivery_contact_signature column
 * @method     ChildOrders|null findOneByDeliveryPhoto(string $delivery_photo) Return the first ChildOrders filtered by the delivery_photo column
 * @method     ChildOrders|null findOneByRank(int $rank) Return the first ChildOrders filtered by the rank column
 * @method     ChildOrders|null findOneByQualified(int $qualified) Return the first ChildOrders filtered by the qualified column
 * @method     ChildOrders|null findOneByClientComments(string $client_comments) Return the first ChildOrders filtered by the client_comments column
 * @method     ChildOrders|null findOneByCreatedAt(string $created_at) Return the first ChildOrders filtered by the created_at column
 * @method     ChildOrders|null findOneByUpdatedAt(string $updated_at) Return the first ChildOrders filtered by the updated_at column *

 * @method     ChildOrders requirePk($key, ConnectionInterface $con = null) Return the ChildOrders by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOne(ConnectionInterface $con = null) Return the first ChildOrders matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrders requireOneById(int $id) Return the first ChildOrders filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByIdBranchOffice(int $id_branch_office) Return the first ChildOrders filtered by the id_branch_office column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByFolio(int $folio) Return the first ChildOrders filtered by the folio column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByHarvestDate(string $harvest_date) Return the first ChildOrders filtered by the harvest_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByHarvestTime(string $harvest_time) Return the first ChildOrders filtered by the harvest_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByReceptionDate(string $reception_date) Return the first ChildOrders filtered by the reception_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByReceptionTime(string $reception_time) Return the first ChildOrders filtered by the reception_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByDeliveryDate(string $delivery_date) Return the first ChildOrders filtered by the delivery_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByHomeDelivery(string $home_delivery) Return the first ChildOrders filtered by the home_delivery column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByDeliveryTime(string $delivery_time) Return the first ChildOrders filtered by the delivery_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByRealDeliveryDate(string $real_delivery_date) Return the first ChildOrders filtered by the real_delivery_date column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByRealDeliveryTime(string $real_delivery_time) Return the first ChildOrders filtered by the real_delivery_time column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByIdDeliveryUser(int $id_delivery_user) Return the first ChildOrders filtered by the id_delivery_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByIdPriority(int $id_priority) Return the first ChildOrders filtered by the id_priority column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByPieces(int $pieces) Return the first ChildOrders filtered by the pieces column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByKilograms(string $kilograms) Return the first ChildOrders filtered by the kilograms column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByObservations(string $observations) Return the first ChildOrders filtered by the observations column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneBySubtotal(string $subtotal) Return the first ChildOrders filtered by the subtotal column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByTotal(string $total) Return the first ChildOrders filtered by the total column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByDiscount(string $discount) Return the first ChildOrders filtered by the discount column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByAmountPaid(string $amount_paid) Return the first ChildOrders filtered by the amount_paid column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByPrintedNote(int $printed_note) Return the first ChildOrders filtered by the printed_note column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByPaymentStatus(int $payment_status) Return the first ChildOrders filtered by the payment_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByIdOrderStatus(int $id_order_status) Return the first ChildOrders filtered by the id_order_status column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByFlagHomeService(int $flag_home_service) Return the first ChildOrders filtered by the flag_home_service column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByIdPaymentMethod(int $id_payment_method) Return the first ChildOrders filtered by the id_payment_method column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByIdUser(int $id_user) Return the first ChildOrders filtered by the id_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByIdClientUser(int $id_client_user) Return the first ChildOrders filtered by the id_client_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByHarvestComments(string $harvest_comments) Return the first ChildOrders filtered by the harvest_comments column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByHarvestContactName(string $harvest_contact_name) Return the first ChildOrders filtered by the harvest_contact_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByHarvestContactSignature(string $harvest_contact_signature) Return the first ChildOrders filtered by the harvest_contact_signature column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByHarvestPhoto(string $harvest_photo) Return the first ChildOrders filtered by the harvest_photo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByDeliveryComments(string $delivery_comments) Return the first ChildOrders filtered by the delivery_comments column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByDeliveryContactName(string $delivery_contact_name) Return the first ChildOrders filtered by the delivery_contact_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByDeliveryContactSignature(string $delivery_contact_signature) Return the first ChildOrders filtered by the delivery_contact_signature column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByDeliveryPhoto(string $delivery_photo) Return the first ChildOrders filtered by the delivery_photo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByRank(int $rank) Return the first ChildOrders filtered by the rank column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByQualified(int $qualified) Return the first ChildOrders filtered by the qualified column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByClientComments(string $client_comments) Return the first ChildOrders filtered by the client_comments column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByCreatedAt(string $created_at) Return the first ChildOrders filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildOrders requireOneByUpdatedAt(string $updated_at) Return the first ChildOrders filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildOrders[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildOrders objects based on current ModelCriteria
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> find(ConnectionInterface $con = null) Return ChildOrders objects based on current ModelCriteria
 * @method     ChildOrders[]|ObjectCollection findById(int $id) Return ChildOrders objects filtered by the id column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findById(int $id) Return ChildOrders objects filtered by the id column
 * @method     ChildOrders[]|ObjectCollection findByIdBranchOffice(int $id_branch_office) Return ChildOrders objects filtered by the id_branch_office column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByIdBranchOffice(int $id_branch_office) Return ChildOrders objects filtered by the id_branch_office column
 * @method     ChildOrders[]|ObjectCollection findByFolio(int $folio) Return ChildOrders objects filtered by the folio column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByFolio(int $folio) Return ChildOrders objects filtered by the folio column
 * @method     ChildOrders[]|ObjectCollection findByHarvestDate(string $harvest_date) Return ChildOrders objects filtered by the harvest_date column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByHarvestDate(string $harvest_date) Return ChildOrders objects filtered by the harvest_date column
 * @method     ChildOrders[]|ObjectCollection findByHarvestTime(string $harvest_time) Return ChildOrders objects filtered by the harvest_time column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByHarvestTime(string $harvest_time) Return ChildOrders objects filtered by the harvest_time column
 * @method     ChildOrders[]|ObjectCollection findByReceptionDate(string $reception_date) Return ChildOrders objects filtered by the reception_date column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByReceptionDate(string $reception_date) Return ChildOrders objects filtered by the reception_date column
 * @method     ChildOrders[]|ObjectCollection findByReceptionTime(string $reception_time) Return ChildOrders objects filtered by the reception_time column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByReceptionTime(string $reception_time) Return ChildOrders objects filtered by the reception_time column
 * @method     ChildOrders[]|ObjectCollection findByDeliveryDate(string $delivery_date) Return ChildOrders objects filtered by the delivery_date column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByDeliveryDate(string $delivery_date) Return ChildOrders objects filtered by the delivery_date column
 * @method     ChildOrders[]|ObjectCollection findByHomeDelivery(string $home_delivery) Return ChildOrders objects filtered by the home_delivery column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByHomeDelivery(string $home_delivery) Return ChildOrders objects filtered by the home_delivery column
 * @method     ChildOrders[]|ObjectCollection findByDeliveryTime(string $delivery_time) Return ChildOrders objects filtered by the delivery_time column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByDeliveryTime(string $delivery_time) Return ChildOrders objects filtered by the delivery_time column
 * @method     ChildOrders[]|ObjectCollection findByRealDeliveryDate(string $real_delivery_date) Return ChildOrders objects filtered by the real_delivery_date column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByRealDeliveryDate(string $real_delivery_date) Return ChildOrders objects filtered by the real_delivery_date column
 * @method     ChildOrders[]|ObjectCollection findByRealDeliveryTime(string $real_delivery_time) Return ChildOrders objects filtered by the real_delivery_time column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByRealDeliveryTime(string $real_delivery_time) Return ChildOrders objects filtered by the real_delivery_time column
 * @method     ChildOrders[]|ObjectCollection findByIdDeliveryUser(int $id_delivery_user) Return ChildOrders objects filtered by the id_delivery_user column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByIdDeliveryUser(int $id_delivery_user) Return ChildOrders objects filtered by the id_delivery_user column
 * @method     ChildOrders[]|ObjectCollection findByIdPriority(int $id_priority) Return ChildOrders objects filtered by the id_priority column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByIdPriority(int $id_priority) Return ChildOrders objects filtered by the id_priority column
 * @method     ChildOrders[]|ObjectCollection findByPieces(int $pieces) Return ChildOrders objects filtered by the pieces column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByPieces(int $pieces) Return ChildOrders objects filtered by the pieces column
 * @method     ChildOrders[]|ObjectCollection findByKilograms(string $kilograms) Return ChildOrders objects filtered by the kilograms column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByKilograms(string $kilograms) Return ChildOrders objects filtered by the kilograms column
 * @method     ChildOrders[]|ObjectCollection findByObservations(string $observations) Return ChildOrders objects filtered by the observations column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByObservations(string $observations) Return ChildOrders objects filtered by the observations column
 * @method     ChildOrders[]|ObjectCollection findBySubtotal(string $subtotal) Return ChildOrders objects filtered by the subtotal column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findBySubtotal(string $subtotal) Return ChildOrders objects filtered by the subtotal column
 * @method     ChildOrders[]|ObjectCollection findByTotal(string $total) Return ChildOrders objects filtered by the total column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByTotal(string $total) Return ChildOrders objects filtered by the total column
 * @method     ChildOrders[]|ObjectCollection findByDiscount(string $discount) Return ChildOrders objects filtered by the discount column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByDiscount(string $discount) Return ChildOrders objects filtered by the discount column
 * @method     ChildOrders[]|ObjectCollection findByAmountPaid(string $amount_paid) Return ChildOrders objects filtered by the amount_paid column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByAmountPaid(string $amount_paid) Return ChildOrders objects filtered by the amount_paid column
 * @method     ChildOrders[]|ObjectCollection findByPrintedNote(int $printed_note) Return ChildOrders objects filtered by the printed_note column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByPrintedNote(int $printed_note) Return ChildOrders objects filtered by the printed_note column
 * @method     ChildOrders[]|ObjectCollection findByPaymentStatus(int $payment_status) Return ChildOrders objects filtered by the payment_status column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByPaymentStatus(int $payment_status) Return ChildOrders objects filtered by the payment_status column
 * @method     ChildOrders[]|ObjectCollection findByIdOrderStatus(int $id_order_status) Return ChildOrders objects filtered by the id_order_status column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByIdOrderStatus(int $id_order_status) Return ChildOrders objects filtered by the id_order_status column
 * @method     ChildOrders[]|ObjectCollection findByFlagHomeService(int $flag_home_service) Return ChildOrders objects filtered by the flag_home_service column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByFlagHomeService(int $flag_home_service) Return ChildOrders objects filtered by the flag_home_service column
 * @method     ChildOrders[]|ObjectCollection findByIdPaymentMethod(int $id_payment_method) Return ChildOrders objects filtered by the id_payment_method column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByIdPaymentMethod(int $id_payment_method) Return ChildOrders objects filtered by the id_payment_method column
 * @method     ChildOrders[]|ObjectCollection findByIdUser(int $id_user) Return ChildOrders objects filtered by the id_user column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByIdUser(int $id_user) Return ChildOrders objects filtered by the id_user column
 * @method     ChildOrders[]|ObjectCollection findByIdClientUser(int $id_client_user) Return ChildOrders objects filtered by the id_client_user column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByIdClientUser(int $id_client_user) Return ChildOrders objects filtered by the id_client_user column
 * @method     ChildOrders[]|ObjectCollection findByHarvestComments(string $harvest_comments) Return ChildOrders objects filtered by the harvest_comments column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByHarvestComments(string $harvest_comments) Return ChildOrders objects filtered by the harvest_comments column
 * @method     ChildOrders[]|ObjectCollection findByHarvestContactName(string $harvest_contact_name) Return ChildOrders objects filtered by the harvest_contact_name column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByHarvestContactName(string $harvest_contact_name) Return ChildOrders objects filtered by the harvest_contact_name column
 * @method     ChildOrders[]|ObjectCollection findByHarvestContactSignature(string $harvest_contact_signature) Return ChildOrders objects filtered by the harvest_contact_signature column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByHarvestContactSignature(string $harvest_contact_signature) Return ChildOrders objects filtered by the harvest_contact_signature column
 * @method     ChildOrders[]|ObjectCollection findByHarvestPhoto(string $harvest_photo) Return ChildOrders objects filtered by the harvest_photo column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByHarvestPhoto(string $harvest_photo) Return ChildOrders objects filtered by the harvest_photo column
 * @method     ChildOrders[]|ObjectCollection findByDeliveryComments(string $delivery_comments) Return ChildOrders objects filtered by the delivery_comments column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByDeliveryComments(string $delivery_comments) Return ChildOrders objects filtered by the delivery_comments column
 * @method     ChildOrders[]|ObjectCollection findByDeliveryContactName(string $delivery_contact_name) Return ChildOrders objects filtered by the delivery_contact_name column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByDeliveryContactName(string $delivery_contact_name) Return ChildOrders objects filtered by the delivery_contact_name column
 * @method     ChildOrders[]|ObjectCollection findByDeliveryContactSignature(string $delivery_contact_signature) Return ChildOrders objects filtered by the delivery_contact_signature column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByDeliveryContactSignature(string $delivery_contact_signature) Return ChildOrders objects filtered by the delivery_contact_signature column
 * @method     ChildOrders[]|ObjectCollection findByDeliveryPhoto(string $delivery_photo) Return ChildOrders objects filtered by the delivery_photo column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByDeliveryPhoto(string $delivery_photo) Return ChildOrders objects filtered by the delivery_photo column
 * @method     ChildOrders[]|ObjectCollection findByRank(int $rank) Return ChildOrders objects filtered by the rank column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByRank(int $rank) Return ChildOrders objects filtered by the rank column
 * @method     ChildOrders[]|ObjectCollection findByQualified(int $qualified) Return ChildOrders objects filtered by the qualified column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByQualified(int $qualified) Return ChildOrders objects filtered by the qualified column
 * @method     ChildOrders[]|ObjectCollection findByClientComments(string $client_comments) Return ChildOrders objects filtered by the client_comments column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByClientComments(string $client_comments) Return ChildOrders objects filtered by the client_comments column
 * @method     ChildOrders[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildOrders objects filtered by the created_at column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByCreatedAt(string $created_at) Return ChildOrders objects filtered by the created_at column
 * @method     ChildOrders[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildOrders objects filtered by the updated_at column
 * @psalm-method ObjectCollection&\Traversable<ChildOrders> findByUpdatedAt(string $updated_at) Return ChildOrders objects filtered by the updated_at column
 * @method     ChildOrders[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 * @psalm-method \Propel\Runtime\Util\PropelModelPager&\Traversable<ChildOrders> paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class OrdersQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\OrdersQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'golden_clean', $modelName = '\\Orders', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildOrdersQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildOrdersQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildOrdersQuery) {
            return $criteria;
        }
        $query = new ChildOrdersQuery();
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
     * @return ChildOrders|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(OrdersTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = OrdersTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildOrders A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, id_branch_office, folio, harvest_date, harvest_time, reception_date, reception_time, delivery_date, home_delivery, delivery_time, real_delivery_date, real_delivery_time, id_delivery_user, id_priority, pieces, kilograms, observations, subtotal, total, discount, amount_paid, printed_note, payment_status, id_order_status, flag_home_service, id_payment_method, id_user, id_client_user, harvest_comments, harvest_contact_name, harvest_contact_signature, harvest_photo, delivery_comments, delivery_contact_name, delivery_contact_signature, delivery_photo, rank, qualified, client_comments, created_at, updated_at FROM orders WHERE id = :p0';
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
            /** @var ChildOrders $obj */
            $obj = new ChildOrders();
            $obj->hydrate($row);
            OrdersTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildOrders|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(OrdersTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(OrdersTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the id_branch_office column
     *
     * Example usage:
     * <code>
     * $query->filterByIdBranchOffice(1234); // WHERE id_branch_office = 1234
     * $query->filterByIdBranchOffice(array(12, 34)); // WHERE id_branch_office IN (12, 34)
     * $query->filterByIdBranchOffice(array('min' => 12)); // WHERE id_branch_office > 12
     * </code>
     *
     * @see       filterByBranchOffices()
     *
     * @param     mixed $idBranchOffice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByIdBranchOffice($idBranchOffice = null, $comparison = null)
    {
        if (is_array($idBranchOffice)) {
            $useMinMax = false;
            if (isset($idBranchOffice['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ID_BRANCH_OFFICE, $idBranchOffice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idBranchOffice['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ID_BRANCH_OFFICE, $idBranchOffice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_ID_BRANCH_OFFICE, $idBranchOffice, $comparison);
    }

    /**
     * Filter the query on the folio column
     *
     * Example usage:
     * <code>
     * $query->filterByFolio(1234); // WHERE folio = 1234
     * $query->filterByFolio(array(12, 34)); // WHERE folio IN (12, 34)
     * $query->filterByFolio(array('min' => 12)); // WHERE folio > 12
     * </code>
     *
     * @param     mixed $folio The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByFolio($folio = null, $comparison = null)
    {
        if (is_array($folio)) {
            $useMinMax = false;
            if (isset($folio['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_FOLIO, $folio['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($folio['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_FOLIO, $folio['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_FOLIO, $folio, $comparison);
    }

    /**
     * Filter the query on the harvest_date column
     *
     * Example usage:
     * <code>
     * $query->filterByHarvestDate('fooValue');   // WHERE harvest_date = 'fooValue'
     * $query->filterByHarvestDate('%fooValue%', Criteria::LIKE); // WHERE harvest_date LIKE '%fooValue%'
     * </code>
     *
     * @param     string $harvestDate The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByHarvestDate($harvestDate = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($harvestDate)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_HARVEST_DATE, $harvestDate, $comparison);
    }

    /**
     * Filter the query on the harvest_time column
     *
     * Example usage:
     * <code>
     * $query->filterByHarvestTime('fooValue');   // WHERE harvest_time = 'fooValue'
     * $query->filterByHarvestTime('%fooValue%', Criteria::LIKE); // WHERE harvest_time LIKE '%fooValue%'
     * </code>
     *
     * @param     string $harvestTime The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByHarvestTime($harvestTime = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($harvestTime)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_HARVEST_TIME, $harvestTime, $comparison);
    }

    /**
     * Filter the query on the reception_date column
     *
     * Example usage:
     * <code>
     * $query->filterByReceptionDate('2011-03-14'); // WHERE reception_date = '2011-03-14'
     * $query->filterByReceptionDate('now'); // WHERE reception_date = '2011-03-14'
     * $query->filterByReceptionDate(array('max' => 'yesterday')); // WHERE reception_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $receptionDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByReceptionDate($receptionDate = null, $comparison = null)
    {
        if (is_array($receptionDate)) {
            $useMinMax = false;
            if (isset($receptionDate['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_RECEPTION_DATE, $receptionDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($receptionDate['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_RECEPTION_DATE, $receptionDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_RECEPTION_DATE, $receptionDate, $comparison);
    }

    /**
     * Filter the query on the reception_time column
     *
     * Example usage:
     * <code>
     * $query->filterByReceptionTime('2011-03-14'); // WHERE reception_time = '2011-03-14'
     * $query->filterByReceptionTime('now'); // WHERE reception_time = '2011-03-14'
     * $query->filterByReceptionTime(array('max' => 'yesterday')); // WHERE reception_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $receptionTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByReceptionTime($receptionTime = null, $comparison = null)
    {
        if (is_array($receptionTime)) {
            $useMinMax = false;
            if (isset($receptionTime['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_RECEPTION_TIME, $receptionTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($receptionTime['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_RECEPTION_TIME, $receptionTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_RECEPTION_TIME, $receptionTime, $comparison);
    }

    /**
     * Filter the query on the delivery_date column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryDate('2011-03-14'); // WHERE delivery_date = '2011-03-14'
     * $query->filterByDeliveryDate('now'); // WHERE delivery_date = '2011-03-14'
     * $query->filterByDeliveryDate(array('max' => 'yesterday')); // WHERE delivery_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $deliveryDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByDeliveryDate($deliveryDate = null, $comparison = null)
    {
        if (is_array($deliveryDate)) {
            $useMinMax = false;
            if (isset($deliveryDate['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_DELIVERY_DATE, $deliveryDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deliveryDate['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_DELIVERY_DATE, $deliveryDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_DELIVERY_DATE, $deliveryDate, $comparison);
    }

    /**
     * Filter the query on the home_delivery column
     *
     * Example usage:
     * <code>
     * $query->filterByHomeDelivery('2011-03-14'); // WHERE home_delivery = '2011-03-14'
     * $query->filterByHomeDelivery('now'); // WHERE home_delivery = '2011-03-14'
     * $query->filterByHomeDelivery(array('max' => 'yesterday')); // WHERE home_delivery > '2011-03-13'
     * </code>
     *
     * @param     mixed $homeDelivery The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByHomeDelivery($homeDelivery = null, $comparison = null)
    {
        if (is_array($homeDelivery)) {
            $useMinMax = false;
            if (isset($homeDelivery['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_HOME_DELIVERY, $homeDelivery['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($homeDelivery['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_HOME_DELIVERY, $homeDelivery['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_HOME_DELIVERY, $homeDelivery, $comparison);
    }

    /**
     * Filter the query on the delivery_time column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryTime('2011-03-14'); // WHERE delivery_time = '2011-03-14'
     * $query->filterByDeliveryTime('now'); // WHERE delivery_time = '2011-03-14'
     * $query->filterByDeliveryTime(array('max' => 'yesterday')); // WHERE delivery_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $deliveryTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByDeliveryTime($deliveryTime = null, $comparison = null)
    {
        if (is_array($deliveryTime)) {
            $useMinMax = false;
            if (isset($deliveryTime['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_DELIVERY_TIME, $deliveryTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deliveryTime['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_DELIVERY_TIME, $deliveryTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_DELIVERY_TIME, $deliveryTime, $comparison);
    }

    /**
     * Filter the query on the real_delivery_date column
     *
     * Example usage:
     * <code>
     * $query->filterByRealDeliveryDate('2011-03-14'); // WHERE real_delivery_date = '2011-03-14'
     * $query->filterByRealDeliveryDate('now'); // WHERE real_delivery_date = '2011-03-14'
     * $query->filterByRealDeliveryDate(array('max' => 'yesterday')); // WHERE real_delivery_date > '2011-03-13'
     * </code>
     *
     * @param     mixed $realDeliveryDate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByRealDeliveryDate($realDeliveryDate = null, $comparison = null)
    {
        if (is_array($realDeliveryDate)) {
            $useMinMax = false;
            if (isset($realDeliveryDate['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_REAL_DELIVERY_DATE, $realDeliveryDate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($realDeliveryDate['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_REAL_DELIVERY_DATE, $realDeliveryDate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_REAL_DELIVERY_DATE, $realDeliveryDate, $comparison);
    }

    /**
     * Filter the query on the real_delivery_time column
     *
     * Example usage:
     * <code>
     * $query->filterByRealDeliveryTime('2011-03-14'); // WHERE real_delivery_time = '2011-03-14'
     * $query->filterByRealDeliveryTime('now'); // WHERE real_delivery_time = '2011-03-14'
     * $query->filterByRealDeliveryTime(array('max' => 'yesterday')); // WHERE real_delivery_time > '2011-03-13'
     * </code>
     *
     * @param     mixed $realDeliveryTime The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByRealDeliveryTime($realDeliveryTime = null, $comparison = null)
    {
        if (is_array($realDeliveryTime)) {
            $useMinMax = false;
            if (isset($realDeliveryTime['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_REAL_DELIVERY_TIME, $realDeliveryTime['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($realDeliveryTime['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_REAL_DELIVERY_TIME, $realDeliveryTime['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_REAL_DELIVERY_TIME, $realDeliveryTime, $comparison);
    }

    /**
     * Filter the query on the id_delivery_user column
     *
     * Example usage:
     * <code>
     * $query->filterByIdDeliveryUser(1234); // WHERE id_delivery_user = 1234
     * $query->filterByIdDeliveryUser(array(12, 34)); // WHERE id_delivery_user IN (12, 34)
     * $query->filterByIdDeliveryUser(array('min' => 12)); // WHERE id_delivery_user > 12
     * </code>
     *
     * @see       filterByUsersRelatedByIdDeliveryUser()
     *
     * @param     mixed $idDeliveryUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByIdDeliveryUser($idDeliveryUser = null, $comparison = null)
    {
        if (is_array($idDeliveryUser)) {
            $useMinMax = false;
            if (isset($idDeliveryUser['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ID_DELIVERY_USER, $idDeliveryUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idDeliveryUser['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ID_DELIVERY_USER, $idDeliveryUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_ID_DELIVERY_USER, $idDeliveryUser, $comparison);
    }

    /**
     * Filter the query on the id_priority column
     *
     * Example usage:
     * <code>
     * $query->filterByIdPriority(1234); // WHERE id_priority = 1234
     * $query->filterByIdPriority(array(12, 34)); // WHERE id_priority IN (12, 34)
     * $query->filterByIdPriority(array('min' => 12)); // WHERE id_priority > 12
     * </code>
     *
     * @see       filterByPriorities()
     *
     * @param     mixed $idPriority The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByIdPriority($idPriority = null, $comparison = null)
    {
        if (is_array($idPriority)) {
            $useMinMax = false;
            if (isset($idPriority['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ID_PRIORITY, $idPriority['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idPriority['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ID_PRIORITY, $idPriority['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_ID_PRIORITY, $idPriority, $comparison);
    }

    /**
     * Filter the query on the pieces column
     *
     * Example usage:
     * <code>
     * $query->filterByPieces(1234); // WHERE pieces = 1234
     * $query->filterByPieces(array(12, 34)); // WHERE pieces IN (12, 34)
     * $query->filterByPieces(array('min' => 12)); // WHERE pieces > 12
     * </code>
     *
     * @param     mixed $pieces The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByPieces($pieces = null, $comparison = null)
    {
        if (is_array($pieces)) {
            $useMinMax = false;
            if (isset($pieces['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_PIECES, $pieces['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pieces['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_PIECES, $pieces['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_PIECES, $pieces, $comparison);
    }

    /**
     * Filter the query on the kilograms column
     *
     * Example usage:
     * <code>
     * $query->filterByKilograms(1234); // WHERE kilograms = 1234
     * $query->filterByKilograms(array(12, 34)); // WHERE kilograms IN (12, 34)
     * $query->filterByKilograms(array('min' => 12)); // WHERE kilograms > 12
     * </code>
     *
     * @param     mixed $kilograms The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByKilograms($kilograms = null, $comparison = null)
    {
        if (is_array($kilograms)) {
            $useMinMax = false;
            if (isset($kilograms['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_KILOGRAMS, $kilograms['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($kilograms['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_KILOGRAMS, $kilograms['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_KILOGRAMS, $kilograms, $comparison);
    }

    /**
     * Filter the query on the observations column
     *
     * Example usage:
     * <code>
     * $query->filterByObservations('fooValue');   // WHERE observations = 'fooValue'
     * $query->filterByObservations('%fooValue%', Criteria::LIKE); // WHERE observations LIKE '%fooValue%'
     * </code>
     *
     * @param     string $observations The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByObservations($observations = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($observations)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_OBSERVATIONS, $observations, $comparison);
    }

    /**
     * Filter the query on the subtotal column
     *
     * Example usage:
     * <code>
     * $query->filterBySubtotal(1234); // WHERE subtotal = 1234
     * $query->filterBySubtotal(array(12, 34)); // WHERE subtotal IN (12, 34)
     * $query->filterBySubtotal(array('min' => 12)); // WHERE subtotal > 12
     * </code>
     *
     * @param     mixed $subtotal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterBySubtotal($subtotal = null, $comparison = null)
    {
        if (is_array($subtotal)) {
            $useMinMax = false;
            if (isset($subtotal['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_SUBTOTAL, $subtotal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($subtotal['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_SUBTOTAL, $subtotal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_SUBTOTAL, $subtotal, $comparison);
    }

    /**
     * Filter the query on the total column
     *
     * Example usage:
     * <code>
     * $query->filterByTotal(1234); // WHERE total = 1234
     * $query->filterByTotal(array(12, 34)); // WHERE total IN (12, 34)
     * $query->filterByTotal(array('min' => 12)); // WHERE total > 12
     * </code>
     *
     * @param     mixed $total The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByTotal($total = null, $comparison = null)
    {
        if (is_array($total)) {
            $useMinMax = false;
            if (isset($total['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_TOTAL, $total['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($total['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_TOTAL, $total['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_TOTAL, $total, $comparison);
    }

    /**
     * Filter the query on the discount column
     *
     * Example usage:
     * <code>
     * $query->filterByDiscount(1234); // WHERE discount = 1234
     * $query->filterByDiscount(array(12, 34)); // WHERE discount IN (12, 34)
     * $query->filterByDiscount(array('min' => 12)); // WHERE discount > 12
     * </code>
     *
     * @param     mixed $discount The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByDiscount($discount = null, $comparison = null)
    {
        if (is_array($discount)) {
            $useMinMax = false;
            if (isset($discount['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_DISCOUNT, $discount['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($discount['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_DISCOUNT, $discount['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_DISCOUNT, $discount, $comparison);
    }

    /**
     * Filter the query on the amount_paid column
     *
     * Example usage:
     * <code>
     * $query->filterByAmountPaid(1234); // WHERE amount_paid = 1234
     * $query->filterByAmountPaid(array(12, 34)); // WHERE amount_paid IN (12, 34)
     * $query->filterByAmountPaid(array('min' => 12)); // WHERE amount_paid > 12
     * </code>
     *
     * @param     mixed $amountPaid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByAmountPaid($amountPaid = null, $comparison = null)
    {
        if (is_array($amountPaid)) {
            $useMinMax = false;
            if (isset($amountPaid['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_AMOUNT_PAID, $amountPaid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($amountPaid['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_AMOUNT_PAID, $amountPaid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_AMOUNT_PAID, $amountPaid, $comparison);
    }

    /**
     * Filter the query on the printed_note column
     *
     * Example usage:
     * <code>
     * $query->filterByPrintedNote(1234); // WHERE printed_note = 1234
     * $query->filterByPrintedNote(array(12, 34)); // WHERE printed_note IN (12, 34)
     * $query->filterByPrintedNote(array('min' => 12)); // WHERE printed_note > 12
     * </code>
     *
     * @param     mixed $printedNote The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByPrintedNote($printedNote = null, $comparison = null)
    {
        if (is_array($printedNote)) {
            $useMinMax = false;
            if (isset($printedNote['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_PRINTED_NOTE, $printedNote['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($printedNote['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_PRINTED_NOTE, $printedNote['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_PRINTED_NOTE, $printedNote, $comparison);
    }

    /**
     * Filter the query on the payment_status column
     *
     * Example usage:
     * <code>
     * $query->filterByPaymentStatus(1234); // WHERE payment_status = 1234
     * $query->filterByPaymentStatus(array(12, 34)); // WHERE payment_status IN (12, 34)
     * $query->filterByPaymentStatus(array('min' => 12)); // WHERE payment_status > 12
     * </code>
     *
     * @param     mixed $paymentStatus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByPaymentStatus($paymentStatus = null, $comparison = null)
    {
        if (is_array($paymentStatus)) {
            $useMinMax = false;
            if (isset($paymentStatus['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_PAYMENT_STATUS, $paymentStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($paymentStatus['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_PAYMENT_STATUS, $paymentStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_PAYMENT_STATUS, $paymentStatus, $comparison);
    }

    /**
     * Filter the query on the id_order_status column
     *
     * Example usage:
     * <code>
     * $query->filterByIdOrderStatus(1234); // WHERE id_order_status = 1234
     * $query->filterByIdOrderStatus(array(12, 34)); // WHERE id_order_status IN (12, 34)
     * $query->filterByIdOrderStatus(array('min' => 12)); // WHERE id_order_status > 12
     * </code>
     *
     * @see       filterByOrderStatus()
     *
     * @param     mixed $idOrderStatus The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByIdOrderStatus($idOrderStatus = null, $comparison = null)
    {
        if (is_array($idOrderStatus)) {
            $useMinMax = false;
            if (isset($idOrderStatus['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ID_ORDER_STATUS, $idOrderStatus['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idOrderStatus['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ID_ORDER_STATUS, $idOrderStatus['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_ID_ORDER_STATUS, $idOrderStatus, $comparison);
    }

    /**
     * Filter the query on the flag_home_service column
     *
     * Example usage:
     * <code>
     * $query->filterByFlagHomeService(1234); // WHERE flag_home_service = 1234
     * $query->filterByFlagHomeService(array(12, 34)); // WHERE flag_home_service IN (12, 34)
     * $query->filterByFlagHomeService(array('min' => 12)); // WHERE flag_home_service > 12
     * </code>
     *
     * @param     mixed $flagHomeService The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByFlagHomeService($flagHomeService = null, $comparison = null)
    {
        if (is_array($flagHomeService)) {
            $useMinMax = false;
            if (isset($flagHomeService['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_FLAG_HOME_SERVICE, $flagHomeService['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($flagHomeService['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_FLAG_HOME_SERVICE, $flagHomeService['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_FLAG_HOME_SERVICE, $flagHomeService, $comparison);
    }

    /**
     * Filter the query on the id_payment_method column
     *
     * Example usage:
     * <code>
     * $query->filterByIdPaymentMethod(1234); // WHERE id_payment_method = 1234
     * $query->filterByIdPaymentMethod(array(12, 34)); // WHERE id_payment_method IN (12, 34)
     * $query->filterByIdPaymentMethod(array('min' => 12)); // WHERE id_payment_method > 12
     * </code>
     *
     * @see       filterByPaymentMethods()
     *
     * @param     mixed $idPaymentMethod The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByIdPaymentMethod($idPaymentMethod = null, $comparison = null)
    {
        if (is_array($idPaymentMethod)) {
            $useMinMax = false;
            if (isset($idPaymentMethod['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ID_PAYMENT_METHOD, $idPaymentMethod['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idPaymentMethod['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ID_PAYMENT_METHOD, $idPaymentMethod['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_ID_PAYMENT_METHOD, $idPaymentMethod, $comparison);
    }

    /**
     * Filter the query on the id_user column
     *
     * Example usage:
     * <code>
     * $query->filterByIdUser(1234); // WHERE id_user = 1234
     * $query->filterByIdUser(array(12, 34)); // WHERE id_user IN (12, 34)
     * $query->filterByIdUser(array('min' => 12)); // WHERE id_user > 12
     * </code>
     *
     * @see       filterByUsersRelatedByIdUser()
     *
     * @param     mixed $idUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_ID_USER, $idUser, $comparison);
    }

    /**
     * Filter the query on the id_client_user column
     *
     * Example usage:
     * <code>
     * $query->filterByIdClientUser(1234); // WHERE id_client_user = 1234
     * $query->filterByIdClientUser(array(12, 34)); // WHERE id_client_user IN (12, 34)
     * $query->filterByIdClientUser(array('min' => 12)); // WHERE id_client_user > 12
     * </code>
     *
     * @see       filterByUsersRelatedByIdClientUser()
     *
     * @param     mixed $idClientUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByIdClientUser($idClientUser = null, $comparison = null)
    {
        if (is_array($idClientUser)) {
            $useMinMax = false;
            if (isset($idClientUser['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ID_CLIENT_USER, $idClientUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idClientUser['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_ID_CLIENT_USER, $idClientUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_ID_CLIENT_USER, $idClientUser, $comparison);
    }

    /**
     * Filter the query on the harvest_comments column
     *
     * Example usage:
     * <code>
     * $query->filterByHarvestComments('fooValue');   // WHERE harvest_comments = 'fooValue'
     * $query->filterByHarvestComments('%fooValue%', Criteria::LIKE); // WHERE harvest_comments LIKE '%fooValue%'
     * </code>
     *
     * @param     string $harvestComments The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByHarvestComments($harvestComments = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($harvestComments)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_HARVEST_COMMENTS, $harvestComments, $comparison);
    }

    /**
     * Filter the query on the harvest_contact_name column
     *
     * Example usage:
     * <code>
     * $query->filterByHarvestContactName('fooValue');   // WHERE harvest_contact_name = 'fooValue'
     * $query->filterByHarvestContactName('%fooValue%', Criteria::LIKE); // WHERE harvest_contact_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $harvestContactName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByHarvestContactName($harvestContactName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($harvestContactName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_HARVEST_CONTACT_NAME, $harvestContactName, $comparison);
    }

    /**
     * Filter the query on the harvest_contact_signature column
     *
     * Example usage:
     * <code>
     * $query->filterByHarvestContactSignature('fooValue');   // WHERE harvest_contact_signature = 'fooValue'
     * $query->filterByHarvestContactSignature('%fooValue%', Criteria::LIKE); // WHERE harvest_contact_signature LIKE '%fooValue%'
     * </code>
     *
     * @param     string $harvestContactSignature The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByHarvestContactSignature($harvestContactSignature = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($harvestContactSignature)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_HARVEST_CONTACT_SIGNATURE, $harvestContactSignature, $comparison);
    }

    /**
     * Filter the query on the harvest_photo column
     *
     * Example usage:
     * <code>
     * $query->filterByHarvestPhoto('fooValue');   // WHERE harvest_photo = 'fooValue'
     * $query->filterByHarvestPhoto('%fooValue%', Criteria::LIKE); // WHERE harvest_photo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $harvestPhoto The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByHarvestPhoto($harvestPhoto = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($harvestPhoto)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_HARVEST_PHOTO, $harvestPhoto, $comparison);
    }

    /**
     * Filter the query on the delivery_comments column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryComments('fooValue');   // WHERE delivery_comments = 'fooValue'
     * $query->filterByDeliveryComments('%fooValue%', Criteria::LIKE); // WHERE delivery_comments LIKE '%fooValue%'
     * </code>
     *
     * @param     string $deliveryComments The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByDeliveryComments($deliveryComments = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deliveryComments)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_DELIVERY_COMMENTS, $deliveryComments, $comparison);
    }

    /**
     * Filter the query on the delivery_contact_name column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryContactName('fooValue');   // WHERE delivery_contact_name = 'fooValue'
     * $query->filterByDeliveryContactName('%fooValue%', Criteria::LIKE); // WHERE delivery_contact_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $deliveryContactName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByDeliveryContactName($deliveryContactName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deliveryContactName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_DELIVERY_CONTACT_NAME, $deliveryContactName, $comparison);
    }

    /**
     * Filter the query on the delivery_contact_signature column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryContactSignature('fooValue');   // WHERE delivery_contact_signature = 'fooValue'
     * $query->filterByDeliveryContactSignature('%fooValue%', Criteria::LIKE); // WHERE delivery_contact_signature LIKE '%fooValue%'
     * </code>
     *
     * @param     string $deliveryContactSignature The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByDeliveryContactSignature($deliveryContactSignature = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deliveryContactSignature)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_DELIVERY_CONTACT_SIGNATURE, $deliveryContactSignature, $comparison);
    }

    /**
     * Filter the query on the delivery_photo column
     *
     * Example usage:
     * <code>
     * $query->filterByDeliveryPhoto('fooValue');   // WHERE delivery_photo = 'fooValue'
     * $query->filterByDeliveryPhoto('%fooValue%', Criteria::LIKE); // WHERE delivery_photo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $deliveryPhoto The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByDeliveryPhoto($deliveryPhoto = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($deliveryPhoto)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_DELIVERY_PHOTO, $deliveryPhoto, $comparison);
    }

    /**
     * Filter the query on the rank column
     *
     * Example usage:
     * <code>
     * $query->filterByRank(1234); // WHERE rank = 1234
     * $query->filterByRank(array(12, 34)); // WHERE rank IN (12, 34)
     * $query->filterByRank(array('min' => 12)); // WHERE rank > 12
     * </code>
     *
     * @param     mixed $rank The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByRank($rank = null, $comparison = null)
    {
        if (is_array($rank)) {
            $useMinMax = false;
            if (isset($rank['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_RANK, $rank['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rank['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_RANK, $rank['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_RANK, $rank, $comparison);
    }

    /**
     * Filter the query on the qualified column
     *
     * Example usage:
     * <code>
     * $query->filterByQualified(1234); // WHERE qualified = 1234
     * $query->filterByQualified(array(12, 34)); // WHERE qualified IN (12, 34)
     * $query->filterByQualified(array('min' => 12)); // WHERE qualified > 12
     * </code>
     *
     * @param     mixed $qualified The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByQualified($qualified = null, $comparison = null)
    {
        if (is_array($qualified)) {
            $useMinMax = false;
            if (isset($qualified['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_QUALIFIED, $qualified['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($qualified['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_QUALIFIED, $qualified['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_QUALIFIED, $qualified, $comparison);
    }

    /**
     * Filter the query on the client_comments column
     *
     * Example usage:
     * <code>
     * $query->filterByClientComments('fooValue');   // WHERE client_comments = 'fooValue'
     * $query->filterByClientComments('%fooValue%', Criteria::LIKE); // WHERE client_comments LIKE '%fooValue%'
     * </code>
     *
     * @param     string $clientComments The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByClientComments($clientComments = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($clientComments)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_CLIENT_COMMENTS, $clientComments, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(OrdersTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(OrdersTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(OrdersTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \BranchOffices object
     *
     * @param \BranchOffices|ObjectCollection $branchOffices The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByBranchOffices($branchOffices, $comparison = null)
    {
        if ($branchOffices instanceof \BranchOffices) {
            return $this
                ->addUsingAlias(OrdersTableMap::COL_ID_BRANCH_OFFICE, $branchOffices->getId(), $comparison);
        } elseif ($branchOffices instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrdersTableMap::COL_ID_BRANCH_OFFICE, $branchOffices->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByBranchOffices() only accepts arguments of type \BranchOffices or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BranchOffices relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function joinBranchOffices($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BranchOffices');

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
            $this->addJoinObject($join, 'BranchOffices');
        }

        return $this;
    }

    /**
     * Use the BranchOffices relation BranchOffices object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \BranchOfficesQuery A secondary query class using the current class as primary query
     */
    public function useBranchOfficesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBranchOffices($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BranchOffices', '\BranchOfficesQuery');
    }

    /**
     * Use the BranchOffices relation BranchOffices object
     *
     * @param callable(\BranchOfficesQuery):\BranchOfficesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withBranchOfficesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useBranchOfficesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to BranchOffices table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \BranchOfficesQuery The inner query object of the EXISTS statement
     */
    public function useBranchOfficesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('BranchOffices', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to BranchOffices table for a NOT EXISTS query.
     *
     * @see useBranchOfficesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \BranchOfficesQuery The inner query object of the NOT EXISTS statement
     */
    public function useBranchOfficesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('BranchOffices', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Users object
     *
     * @param \Users|ObjectCollection $users The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByUsersRelatedByIdClientUser($users, $comparison = null)
    {
        if ($users instanceof \Users) {
            return $this
                ->addUsingAlias(OrdersTableMap::COL_ID_CLIENT_USER, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrdersTableMap::COL_ID_CLIENT_USER, $users->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUsersRelatedByIdClientUser() only accepts arguments of type \Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UsersRelatedByIdClientUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function joinUsersRelatedByIdClientUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UsersRelatedByIdClientUser');

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
            $this->addJoinObject($join, 'UsersRelatedByIdClientUser');
        }

        return $this;
    }

    /**
     * Use the UsersRelatedByIdClientUser relation Users object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UsersQuery A secondary query class using the current class as primary query
     */
    public function useUsersRelatedByIdClientUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsersRelatedByIdClientUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UsersRelatedByIdClientUser', '\UsersQuery');
    }

    /**
     * Use the UsersRelatedByIdClientUser relation Users object
     *
     * @param callable(\UsersQuery):\UsersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUsersRelatedByIdClientUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUsersRelatedByIdClientUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the UsersRelatedByIdClientUser relation to the Users table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \UsersQuery The inner query object of the EXISTS statement
     */
    public function useUsersRelatedByIdClientUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('UsersRelatedByIdClientUser', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the UsersRelatedByIdClientUser relation to the Users table for a NOT EXISTS query.
     *
     * @see useUsersRelatedByIdClientUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \UsersQuery The inner query object of the NOT EXISTS statement
     */
    public function useUsersRelatedByIdClientUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('UsersRelatedByIdClientUser', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Users object
     *
     * @param \Users|ObjectCollection $users The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByUsersRelatedByIdDeliveryUser($users, $comparison = null)
    {
        if ($users instanceof \Users) {
            return $this
                ->addUsingAlias(OrdersTableMap::COL_ID_DELIVERY_USER, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrdersTableMap::COL_ID_DELIVERY_USER, $users->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUsersRelatedByIdDeliveryUser() only accepts arguments of type \Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UsersRelatedByIdDeliveryUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function joinUsersRelatedByIdDeliveryUser($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UsersRelatedByIdDeliveryUser');

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
            $this->addJoinObject($join, 'UsersRelatedByIdDeliveryUser');
        }

        return $this;
    }

    /**
     * Use the UsersRelatedByIdDeliveryUser relation Users object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UsersQuery A secondary query class using the current class as primary query
     */
    public function useUsersRelatedByIdDeliveryUserQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUsersRelatedByIdDeliveryUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UsersRelatedByIdDeliveryUser', '\UsersQuery');
    }

    /**
     * Use the UsersRelatedByIdDeliveryUser relation Users object
     *
     * @param callable(\UsersQuery):\UsersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUsersRelatedByIdDeliveryUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useUsersRelatedByIdDeliveryUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the UsersRelatedByIdDeliveryUser relation to the Users table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \UsersQuery The inner query object of the EXISTS statement
     */
    public function useUsersRelatedByIdDeliveryUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('UsersRelatedByIdDeliveryUser', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the UsersRelatedByIdDeliveryUser relation to the Users table for a NOT EXISTS query.
     *
     * @see useUsersRelatedByIdDeliveryUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \UsersQuery The inner query object of the NOT EXISTS statement
     */
    public function useUsersRelatedByIdDeliveryUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('UsersRelatedByIdDeliveryUser', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \OrderStatus object
     *
     * @param \OrderStatus|ObjectCollection $orderStatus The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByOrderStatus($orderStatus, $comparison = null)
    {
        if ($orderStatus instanceof \OrderStatus) {
            return $this
                ->addUsingAlias(OrdersTableMap::COL_ID_ORDER_STATUS, $orderStatus->getId(), $comparison);
        } elseif ($orderStatus instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrdersTableMap::COL_ID_ORDER_STATUS, $orderStatus->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByOrderStatus() only accepts arguments of type \OrderStatus or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrderStatus relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function joinOrderStatus($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrderStatus');

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
            $this->addJoinObject($join, 'OrderStatus');
        }

        return $this;
    }

    /**
     * Use the OrderStatus relation OrderStatus object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrderStatusQuery A secondary query class using the current class as primary query
     */
    public function useOrderStatusQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderStatus($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrderStatus', '\OrderStatusQuery');
    }

    /**
     * Use the OrderStatus relation OrderStatus object
     *
     * @param callable(\OrderStatusQuery):\OrderStatusQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrderStatusQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrderStatusQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to OrderStatus table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \OrderStatusQuery The inner query object of the EXISTS statement
     */
    public function useOrderStatusExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('OrderStatus', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to OrderStatus table for a NOT EXISTS query.
     *
     * @see useOrderStatusExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \OrderStatusQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrderStatusNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('OrderStatus', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \PaymentMethods object
     *
     * @param \PaymentMethods|ObjectCollection $paymentMethods The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByPaymentMethods($paymentMethods, $comparison = null)
    {
        if ($paymentMethods instanceof \PaymentMethods) {
            return $this
                ->addUsingAlias(OrdersTableMap::COL_ID_PAYMENT_METHOD, $paymentMethods->getId(), $comparison);
        } elseif ($paymentMethods instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrdersTableMap::COL_ID_PAYMENT_METHOD, $paymentMethods->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPaymentMethods() only accepts arguments of type \PaymentMethods or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PaymentMethods relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function joinPaymentMethods($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PaymentMethods');

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
            $this->addJoinObject($join, 'PaymentMethods');
        }

        return $this;
    }

    /**
     * Use the PaymentMethods relation PaymentMethods object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PaymentMethodsQuery A secondary query class using the current class as primary query
     */
    public function usePaymentMethodsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPaymentMethods($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PaymentMethods', '\PaymentMethodsQuery');
    }

    /**
     * Use the PaymentMethods relation PaymentMethods object
     *
     * @param callable(\PaymentMethodsQuery):\PaymentMethodsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPaymentMethodsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePaymentMethodsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to PaymentMethods table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \PaymentMethodsQuery The inner query object of the EXISTS statement
     */
    public function usePaymentMethodsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('PaymentMethods', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to PaymentMethods table for a NOT EXISTS query.
     *
     * @see usePaymentMethodsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \PaymentMethodsQuery The inner query object of the NOT EXISTS statement
     */
    public function usePaymentMethodsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('PaymentMethods', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Priorities object
     *
     * @param \Priorities|ObjectCollection $priorities The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByPriorities($priorities, $comparison = null)
    {
        if ($priorities instanceof \Priorities) {
            return $this
                ->addUsingAlias(OrdersTableMap::COL_ID_PRIORITY, $priorities->getId(), $comparison);
        } elseif ($priorities instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrdersTableMap::COL_ID_PRIORITY, $priorities->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPriorities() only accepts arguments of type \Priorities or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Priorities relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function joinPriorities($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Priorities');

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
            $this->addJoinObject($join, 'Priorities');
        }

        return $this;
    }

    /**
     * Use the Priorities relation Priorities object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PrioritiesQuery A secondary query class using the current class as primary query
     */
    public function usePrioritiesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPriorities($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Priorities', '\PrioritiesQuery');
    }

    /**
     * Use the Priorities relation Priorities object
     *
     * @param callable(\PrioritiesQuery):\PrioritiesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPrioritiesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePrioritiesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Priorities table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \PrioritiesQuery The inner query object of the EXISTS statement
     */
    public function usePrioritiesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Priorities', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Priorities table for a NOT EXISTS query.
     *
     * @see usePrioritiesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \PrioritiesQuery The inner query object of the NOT EXISTS statement
     */
    public function usePrioritiesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Priorities', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Users object
     *
     * @param \Users|ObjectCollection $users The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByUsersRelatedByIdUser($users, $comparison = null)
    {
        if ($users instanceof \Users) {
            return $this
                ->addUsingAlias(OrdersTableMap::COL_ID_USER, $users->getId(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(OrdersTableMap::COL_ID_USER, $users->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUsersRelatedByIdUser() only accepts arguments of type \Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UsersRelatedByIdUser relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function joinUsersRelatedByIdUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UsersRelatedByIdUser');

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
            $this->addJoinObject($join, 'UsersRelatedByIdUser');
        }

        return $this;
    }

    /**
     * Use the UsersRelatedByIdUser relation Users object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UsersQuery A secondary query class using the current class as primary query
     */
    public function useUsersRelatedByIdUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsersRelatedByIdUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UsersRelatedByIdUser', '\UsersQuery');
    }

    /**
     * Use the UsersRelatedByIdUser relation Users object
     *
     * @param callable(\UsersQuery):\UsersQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withUsersRelatedByIdUserQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useUsersRelatedByIdUserQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the UsersRelatedByIdUser relation to the Users table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \UsersQuery The inner query object of the EXISTS statement
     */
    public function useUsersRelatedByIdUserExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('UsersRelatedByIdUser', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the UsersRelatedByIdUser relation to the Users table for a NOT EXISTS query.
     *
     * @see useUsersRelatedByIdUserExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \UsersQuery The inner query object of the NOT EXISTS statement
     */
    public function useUsersRelatedByIdUserNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('UsersRelatedByIdUser', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Deliveries object
     *
     * @param \Deliveries|ObjectCollection $deliveries the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByDeliveries($deliveries, $comparison = null)
    {
        if ($deliveries instanceof \Deliveries) {
            return $this
                ->addUsingAlias(OrdersTableMap::COL_ID, $deliveries->getIdOrder(), $comparison);
        } elseif ($deliveries instanceof ObjectCollection) {
            return $this
                ->useDeliveriesQuery()
                ->filterByPrimaryKeys($deliveries->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDeliveries() only accepts arguments of type \Deliveries or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Deliveries relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function joinDeliveries($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Deliveries');

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
            $this->addJoinObject($join, 'Deliveries');
        }

        return $this;
    }

    /**
     * Use the Deliveries relation Deliveries object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \DeliveriesQuery A secondary query class using the current class as primary query
     */
    public function useDeliveriesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDeliveries($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Deliveries', '\DeliveriesQuery');
    }

    /**
     * Use the Deliveries relation Deliveries object
     *
     * @param callable(\DeliveriesQuery):\DeliveriesQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withDeliveriesQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useDeliveriesQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Deliveries table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \DeliveriesQuery The inner query object of the EXISTS statement
     */
    public function useDeliveriesExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Deliveries', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Deliveries table for a NOT EXISTS query.
     *
     * @see useDeliveriesExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \DeliveriesQuery The inner query object of the NOT EXISTS statement
     */
    public function useDeliveriesNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Deliveries', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \ElectronicPurseHistory object
     *
     * @param \ElectronicPurseHistory|ObjectCollection $electronicPurseHistory the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByElectronicPurseHistory($electronicPurseHistory, $comparison = null)
    {
        if ($electronicPurseHistory instanceof \ElectronicPurseHistory) {
            return $this
                ->addUsingAlias(OrdersTableMap::COL_ID, $electronicPurseHistory->getIdOrder(), $comparison);
        } elseif ($electronicPurseHistory instanceof ObjectCollection) {
            return $this
                ->useElectronicPurseHistoryQuery()
                ->filterByPrimaryKeys($electronicPurseHistory->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByElectronicPurseHistory() only accepts arguments of type \ElectronicPurseHistory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ElectronicPurseHistory relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function joinElectronicPurseHistory($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ElectronicPurseHistory');

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
            $this->addJoinObject($join, 'ElectronicPurseHistory');
        }

        return $this;
    }

    /**
     * Use the ElectronicPurseHistory relation ElectronicPurseHistory object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ElectronicPurseHistoryQuery A secondary query class using the current class as primary query
     */
    public function useElectronicPurseHistoryQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinElectronicPurseHistory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ElectronicPurseHistory', '\ElectronicPurseHistoryQuery');
    }

    /**
     * Use the ElectronicPurseHistory relation ElectronicPurseHistory object
     *
     * @param callable(\ElectronicPurseHistoryQuery):\ElectronicPurseHistoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withElectronicPurseHistoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useElectronicPurseHistoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to ElectronicPurseHistory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \ElectronicPurseHistoryQuery The inner query object of the EXISTS statement
     */
    public function useElectronicPurseHistoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('ElectronicPurseHistory', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to ElectronicPurseHistory table for a NOT EXISTS query.
     *
     * @see useElectronicPurseHistoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \ElectronicPurseHistoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useElectronicPurseHistoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('ElectronicPurseHistory', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \OrderDetail object
     *
     * @param \OrderDetail|ObjectCollection $orderDetail the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByOrderDetail($orderDetail, $comparison = null)
    {
        if ($orderDetail instanceof \OrderDetail) {
            return $this
                ->addUsingAlias(OrdersTableMap::COL_ID, $orderDetail->getIdOrder(), $comparison);
        } elseif ($orderDetail instanceof ObjectCollection) {
            return $this
                ->useOrderDetailQuery()
                ->filterByPrimaryKeys($orderDetail->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByOrderDetail() only accepts arguments of type \OrderDetail or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrderDetail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function joinOrderDetail($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrderDetail');

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
            $this->addJoinObject($join, 'OrderDetail');
        }

        return $this;
    }

    /**
     * Use the OrderDetail relation OrderDetail object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrderDetailQuery A secondary query class using the current class as primary query
     */
    public function useOrderDetailQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderDetail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrderDetail', '\OrderDetailQuery');
    }

    /**
     * Use the OrderDetail relation OrderDetail object
     *
     * @param callable(\OrderDetailQuery):\OrderDetailQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrderDetailQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrderDetailQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to OrderDetail table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \OrderDetailQuery The inner query object of the EXISTS statement
     */
    public function useOrderDetailExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('OrderDetail', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to OrderDetail table for a NOT EXISTS query.
     *
     * @see useOrderDetailExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \OrderDetailQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrderDetailNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('OrderDetail', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \OrderHistory object
     *
     * @param \OrderHistory|ObjectCollection $orderHistory the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByOrderHistory($orderHistory, $comparison = null)
    {
        if ($orderHistory instanceof \OrderHistory) {
            return $this
                ->addUsingAlias(OrdersTableMap::COL_ID, $orderHistory->getIdOrder(), $comparison);
        } elseif ($orderHistory instanceof ObjectCollection) {
            return $this
                ->useOrderHistoryQuery()
                ->filterByPrimaryKeys($orderHistory->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByOrderHistory() only accepts arguments of type \OrderHistory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the OrderHistory relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function joinOrderHistory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('OrderHistory');

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
            $this->addJoinObject($join, 'OrderHistory');
        }

        return $this;
    }

    /**
     * Use the OrderHistory relation OrderHistory object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \OrderHistoryQuery A secondary query class using the current class as primary query
     */
    public function useOrderHistoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinOrderHistory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'OrderHistory', '\OrderHistoryQuery');
    }

    /**
     * Use the OrderHistory relation OrderHistory object
     *
     * @param callable(\OrderHistoryQuery):\OrderHistoryQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withOrderHistoryQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useOrderHistoryQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to OrderHistory table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \OrderHistoryQuery The inner query object of the EXISTS statement
     */
    public function useOrderHistoryExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('OrderHistory', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to OrderHistory table for a NOT EXISTS query.
     *
     * @see useOrderHistoryExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \OrderHistoryQuery The inner query object of the NOT EXISTS statement
     */
    public function useOrderHistoryNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('OrderHistory', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Pickups object
     *
     * @param \Pickups|ObjectCollection $pickups the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildOrdersQuery The current query, for fluid interface
     */
    public function filterByPickups($pickups, $comparison = null)
    {
        if ($pickups instanceof \Pickups) {
            return $this
                ->addUsingAlias(OrdersTableMap::COL_ID, $pickups->getIdOrder(), $comparison);
        } elseif ($pickups instanceof ObjectCollection) {
            return $this
                ->usePickupsQuery()
                ->filterByPrimaryKeys($pickups->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPickups() only accepts arguments of type \Pickups or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Pickups relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function joinPickups($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Pickups');

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
            $this->addJoinObject($join, 'Pickups');
        }

        return $this;
    }

    /**
     * Use the Pickups relation Pickups object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PickupsQuery A secondary query class using the current class as primary query
     */
    public function usePickupsQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPickups($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Pickups', '\PickupsQuery');
    }

    /**
     * Use the Pickups relation Pickups object
     *
     * @param callable(\PickupsQuery):\PickupsQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPickupsQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->usePickupsQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Pickups table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \PickupsQuery The inner query object of the EXISTS statement
     */
    public function usePickupsExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Pickups', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Pickups table for a NOT EXISTS query.
     *
     * @see usePickupsExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \PickupsQuery The inner query object of the NOT EXISTS statement
     */
    public function usePickupsNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Pickups', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildOrders $orders Object to remove from the list of results
     *
     * @return $this|ChildOrdersQuery The current query, for fluid interface
     */
    public function prune($orders = null)
    {
        if ($orders) {
            $this->addUsingAlias(OrdersTableMap::COL_ID, $orders->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the orders table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(OrdersTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            OrdersTableMap::clearInstancePool();
            OrdersTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(OrdersTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(OrdersTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            OrdersTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            OrdersTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // OrdersQuery
