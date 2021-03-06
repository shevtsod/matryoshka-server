<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;

class DataTypesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $dataType = $this->dataType('slug', 'users');
        $dataType->fill([
            'name' => 'users',
            'display_name_singular' => __('voyager::seeders.data_types.user.singular'),
            'display_name_plural' => __('voyager::seeders.data_types.user.plural'),
            'icon' => 'voyager-person',
            'model_name' => 'App\\User',
            'policy_name' => 'App\\Policies\\AndroidAppPolicy',
            'controller' => '',
            'generate_permissions' => 1,
            'description' => '',
        ])->save();

        $dataType = $this->dataType('slug', 'android_apps');
        $dataType->fill([
            'name' => 'android_apps',
            'display_name_singular' => 'Android App',
            'display_name_plural' => 'Android Apps',
            'icon' => 'voyager-basket',
            'model_name' => 'App\\AndroidApp',
            'policy_name' => 'App\\Policies\\AndroidAppPolicy',
            'controller' => '',
            'generate_permissions' => 1,
            'description' => '',
        ])->save();

        $dataType = $this->dataType('slug', 'categories');
        $dataType->fill([
            'name' => 'categories',
            'display_name_singular' => 'Category',
            'display_name_plural' => 'Categories',
            'icon' => 'voyager-categories',
            'model_name' => 'App\\Category',
            'policy_name' => 'App\\Policies\\CategoryPolicy',
            'controller' => '',
            'generate_permissions' => 1,
            'description' => '',
        ])->save();

        $dataType = $this->dataType('slug', 'groups');
        $dataType->fill([
            'name' => 'groups',
            'display_name_singular' => 'Group',
            'display_name_plural' => 'Groups',
            'icon' => 'voyager-people',
            'model_name' => 'App\\Group',
            'policy_name' => 'App\\Policies\\GroupPolicy',
            'controller' => '',
            'generate_permissions' => 1,
            'description' => '',
        ])->save();

        $dataType = $this->dataType('slug', 'menus');
        $dataType->fill([
            'name' => 'menus',
            'display_name_singular' => __('voyager::seeders.data_types.menu.singular'),
            'display_name_plural' => __('voyager::seeders.data_types.menu.plural'),
            'icon' => 'voyager-list',
            'model_name' => 'TCG\\Voyager\\Models\\Menu',
            'controller' => '',
            'generate_permissions' => 1,
            'description' => '',
        ])->save();

        $dataType = $this->dataType('slug', 'roles');
        $dataType->fill([
            'name' => 'roles',
            'display_name_singular' => __('voyager::seeders.data_types.role.singular'),
            'display_name_plural' => __('voyager::seeders.data_types.role.plural'),
            'icon' => 'voyager-lock',
            'model_name' => 'TCG\\Voyager\\Models\\Role',
            'controller' => '',
            'generate_permissions' => 1,
            'description' => '',
        ])->save();
    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}
