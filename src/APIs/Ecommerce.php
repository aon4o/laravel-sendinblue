<?php

declare(strict_types=1);

namespace Aon2003\LaravelSendInBlue\APIs;

use Aon2003\LaravelSendInBlue\Objects\ErrorResponse;
use Carbon\Carbon;
use SendinBlue\Client\Api\EcommerceApi;
use SendinBlue\Client\ApiException;
use SendinBlue\Client\Model\CreateCategoryModel;
use SendinBlue\Client\Model\CreateProductModel;
use SendinBlue\Client\Model\CreateUpdateBatchCategory;
use SendinBlue\Client\Model\CreateUpdateBatchCategoryModel;
use SendinBlue\Client\Model\CreateUpdateBatchProducts;
use SendinBlue\Client\Model\CreateUpdateBatchProductsModel;
use SendinBlue\Client\Model\CreateUpdateCategories;
use SendinBlue\Client\Model\CreateUpdateCategory;
use SendinBlue\Client\Model\CreateUpdateProduct;
use SendinBlue\Client\Model\CreateUpdateProducts;
use SendinBlue\Client\Model\GetCategories;
use SendinBlue\Client\Model\GetCategoryDetails;
use SendinBlue\Client\Model\GetProductDetails;
use SendinBlue\Client\Model\GetProducts;
use SendinBlue\Client\Model\Order;
use SendinBlue\Client\Model\OrderBatch;
use SendinBlue\Client\Model\OrderBilling;
use SendinBlue\Client\Model\OrderProducts;

/**
 * SendInBlue EcommerceAPI wrapper.
 */
class Ecommerce extends BaseAPI
{
    protected EcommerceApi $api;

    public function __construct()
    {
        parent::__construct();

        $this->api = new EcommerceApi($this->getClient(), $this->config);
    }

    /**
     * Create orders in batch
     * Create multiple orders at one time instead of one order at a time
     *
     * @param array<Order> $orders
     * @param string $notify_url
     * @return ErrorResponse|null
     */
    public function createBatchOrder(array $orders, string $notify_url): ErrorResponse|null
    {
        $order_batch = new OrderBatch([
            'orders' => $orders,
            'notifyUrl' => $notify_url,
        ]);

        try {
            $this->api->createBatchOrder($order_batch);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Managing the status of the order
     * Manages the transactional status of the order
     *
     * @param string $id
     * @param Carbon $created_at
     * @param Carbon $updated_at
     * @param string $status
     * @param float $amount
     * @param array<OrderProducts> $products
     * @param string|null $email
     * @param OrderBilling|null $billing
     * @param array<string> $coupons
     *
     * @return ErrorResponse|null
     */
    public function createOrder(
        string            $id,
        Carbon            $created_at,
        Carbon            $updated_at,
        string            $status,
        float             $amount,
        array             $products,
        string|null       $email = null,
        OrderBilling|null $billing = null,
        array|null        $coupons = null,
    ): ErrorResponse|null
    {
        $order = new Order([
            'id' => $id,
            'createdAt' => $created_at->format('Y-m-d\TH:i:s.u\Z'),
            'updatedAt' => $updated_at->format('Y-m-d\TH:i:s.u\Z'),
            'status' => $status,
            'amount' => $amount,
            'products' => $products,
            'email' => $email,
            'billing' => $billing,
            'coupons' => $coupons,
        ]);

        try {
            $this->api->createOrder($order);
            return null;
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Create categories in batch
     *
     * @param array<CreateUpdateCategories> $categories
     * @param bool $enable_update
     * @return CreateUpdateBatchCategoryModel|ErrorResponse
     */
    public function createUpdateBatchCategory(array $categories, bool $enable_update): CreateUpdateBatchCategoryModel|ErrorResponse
    {
        $batch_category = new CreateUpdateBatchCategory([
            'categories' => $categories,
            'updateEnabled' => $enable_update,
        ]);

        try {
            return $this->api->createUpdateBatchCategory($batch_category);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Create products in batch
     *
     * @param array<CreateUpdateProducts> $products
     * @param bool $enable_update
     * @return CreateUpdateBatchProductsModel|ErrorResponse
     */
    public function createUpdateBatchProducts(array $products, bool $enable_update): CreateUpdateBatchProductsModel|ErrorResponse
    {
        $batch_products = new CreateUpdateBatchProducts([
            'products' => $products,
            'updateEnabled' => $enable_update,
        ]);

        try {
            return $this->api->createUpdateBatchProducts($batch_products);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Create/Update a category
     *
     * @param string $id
     * @param string|null $name
     * @param string|null $url
     * @param bool $update_enabled
     * @param Carbon|null $deleted_at
     * @return ErrorResponse|CreateCategoryModel
     */
    public function createUpdateCategory(
        string      $id,
        string|null $name = null,
        string|null $url = null,
        bool        $update_enabled = false,
        Carbon|null $deleted_at = null,
    )
    {
        $category = new CreateUpdateCategory([
            'id' => $id,
            'name' => $name,
            'url' => $url,
            'updateEnabled' => $update_enabled,
            'deletedAt' => $deleted_at->format('Y-m-d\TH:i:s.u\Z'),
        ]);

        try {
            return $this->api->createUpdateCategory($category);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Create/Update a product
     *
     * @param string $id
     * @param string $name
     * @param string $url
     * @param string $image_url
     * @param string $sku
     * @param float $price
     * @param array<string> $categories
     * @param string $parent_id
     * @param array<string, string> $meta_info
     * @param bool $update_enabled
     * @param Carbon $deleted_at
     *
     * @return ErrorResponse|CreateProductModel
     */
    public function createUpdateProduct(
        string $id,
        string $name,
        string $url,
        string $image_url,
        string $sku,
        float  $price,
        array  $categories,
        string $parent_id,
        array  $meta_info,
        bool   $update_enabled,
        Carbon $deleted_at,
    ): ErrorResponse|CreateProductModel
    {
        $product = new CreateUpdateProduct([
            'id' => $id,
            'name' => $name,
            'url' => $url,
            'imageUrl' => $image_url,
            'sku' => $sku,
            'price' => $price,
            'categories' => $categories,
            'parentId' => $parent_id,
            'metaInfo' => $meta_info,
            'updateEnabled' => $update_enabled,
            'deletedAt' => $deleted_at,
        ]);

        try {
            return $this->api->createUpdateProduct($product);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Activate the eCommerce app
     * Getting access to Sendinblue eCommerce.
     * @return ErrorResponse|void
     */
    public function ecommerceActivate()
    {
        try {
            $this->api->ecommerceActivatePost();
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Return all your categories
     * @param int $limit
     * @param int $offset
     * @param string $sort
     * @param array|null $category_ids
     * @param string|null $category_name
     * @return ErrorResponse|GetCategories
     */
    public function getCategories(
        int         $limit = 50,
        int         $offset = 0,
        string      $sort = 'desc',
        array|null  $category_ids = null,
        string|null $category_name = null,
    ): ErrorResponse|GetCategories
    {
        try {
            return $this->api->getCategories($limit, $offset, $sort, $category_ids, $category_name);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Get a category details
     *
     * @param string $id
     * @return ErrorResponse|GetCategoryDetails
     */
    public function getCategoryInfo(string $id): ErrorResponse|GetCategoryDetails
    {
        try {
            return $this->api->getCategoryInfo($id);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Get a product's details
     * @param string $id
     * @return ErrorResponse|GetProductDetails
     */
    public function getProductInfo(string $id): ErrorResponse|GetProductDetails
    {
        try {
            return $this->api->getProductInfo($id);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }

    /**
     * Return all your products
     *
     * @param int $limit
     * @param int $offset
     * @param string $sort
     * @param array|null $ids
     * @param string|null $name
     * @param array|null $price
     * @param array|null $categories
     *
     * @return ErrorResponse|GetProducts
     */
    public function getProducts(
        int         $limit = 50,
        int         $offset = 0,
        string      $sort = 'desc',
        array|null  $ids = null,
        string|null $name = null,
        array|null  $price = null,
        array|null  $categories = null,
    ): ErrorResponse|GetProducts
    {
        try {
            return $this->api->getProducts($limit, $offset, $sort, $ids, $name, $price, $categories);
        } catch (ApiException $exception) {
            return $this->returnError($exception);
        }
    }
}
