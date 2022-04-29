<?php


namespace App\Helpers;


class Permissions
{
    protected static array $location = [
        ['name' => 'admin.location.index', 'description' => ''],
        ['name' => 'admin.location.list', 'description' => ''],
        ['name' => 'admin.location.parentList', 'description' => ''],
        ['name' => 'admin.location.withTree', 'description' => ''],
        ['name' => 'admin.location.get', 'description' => ''],
        ['name' => 'admin.location.create', 'description' => ''],
        ['name' => 'admin.location.update', 'description' => ''],
        ['name' => 'admin.location.destroy', 'description' => ''],
    ];
    protected static array $brand = [
        ['name' => 'admin.brand.update', 'description' => ''],
        ['name' => 'admin.brand.index', 'description' => ''],
        ['name' => 'admin.brand.list', 'description' => ''],
        ['name' => 'admin.brand.get', 'description' => ''],
        ['name' => 'admin.brand.create', 'description' => ''],
        ['name' => 'admin.brand.update', 'description' => ''],
        ['name' => 'admin.brand.destroy', 'description' => ''],
    ];
    protected static array $supplierStore = [
        ['name' => 'admin.supplierStore.product', 'description' => ''],
        ['name' => 'admin.supplierStore.index', 'description' => ''],
        ['name' => 'admin.supplierStore.list', 'description' => ''],
        ['name' => 'admin.supplierStore.get', 'description' => ''],
        ['name' => 'admin.supplierStore.create', 'description' => ''],
        ['name' => 'admin.supplierStore.update', 'description' => ''],
        ['name' => 'admin.supplierStore.destroy', 'description' => ''],
    ];
    protected static array $courier = [
        ['name' => 'admin.courier.index', 'description' => ''],
        ['name' => 'admin.courier.list', 'description' => ''],
        ['name' => 'admin.courier.get', 'description' => ''],
        ['name' => 'admin.courier.create', 'description' => ''],
        ['name' => 'admin.courier.update', 'description' => ''],
        ['name' => 'admin.courier.destroy', 'description' => ''],
    ];
    protected static array $vacancy = [
        ['name' => 'admin.vacancy.index', 'description' => ''],
        ['name' => 'admin.vacancy.list', 'description' => ''],
        ['name' => 'admin.vacancy.get', 'description' => ''],
        ['name' => 'admin.vacancy.create', 'description' => ''],
        ['name' => 'admin.vacancy.update', 'description' => ''],
        ['name' => 'admin.vacancy.destroy', 'description' => ''],
    ];
    protected static array $role = [
        ['name' => 'admin.role.permissions', 'description' => ''],
        ['name' => 'admin.role.index', 'description' => ''],
        ['name' => 'admin.role.list', 'description' => ''],
        ['name' => 'admin.role.get', 'description' => ''],
        ['name' => 'admin.role.create', 'description' => ''],
        ['name' => 'admin.role.update', 'description' => ''],
        ['name' => 'admin.role.destroy', 'description' => ''],
    ];

    public static function list(): array
    {
        return array_merge(
            Permissions::$location,
            Permissions::$brand,
            Permissions::$supplierStore,
            Permissions::$courier,
            Permissions::$vacancy,
            Permissions::$role
        );
    }

    public static function groupList(): array
    {
        return [
            ['name' => 'Locations', 'items' => Permissions::$location],
            ['name' => 'Brands', 'items' => Permissions::$brand],
            ['name' => 'Supplier stores', 'items' => Permissions::$supplierStore],
            ['name' => 'Couriers', 'items' => Permissions::$courier],
            ['name' => 'Vacancies', 'items' => Permissions::$vacancy],
            ['name' => 'Roles', 'items' => Permissions::$role],
        ];
    }
}
