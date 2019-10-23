<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $permissions = [ 
           'role-list' => 'Просмотр групп',
           'role-create' => 'Создание группы',
           'role-edit' => 'Редактирование группы',
           'role-delete' => 'Удаление группы',
           'article-list' => 'Просмотр материалов',
           'article-create' => 'Создание материалов',
           'article-edit' => 'Редактирование материалов',
           'article-delete' => 'Удаление материалов',
           'users-list' => 'Просмотр пользователей',
           'users-create' => 'Создание пользователей',
           'users-edit' => 'Редактирование пользователей',
           'users-delete' => 'Удаление пользователей',
           'category-list' => 'Просмотр категорий',
           'category-create' => 'Создание категорий',
           'category-edit' => 'Редактирование категорий',
           'category-delete' => 'Удаление категорий',
           'insiders-list' => 'Инсайды просмотр',
           'insiders-delete' => 'Инсайды удаление',
           'tags-list' => 'Теги просмотр',
           'tags-create' => 'Создание тегов',
           'tags-edit' => 'Редактирование тегов',
           'tags-delete' => 'Удаление тегов',
           'vkurse-list' => 'Вкурсе просмотр',
           'vkurse-create' => 'Вкурсе создание',
           'vkurse-edit' => 'Вкурсе редактирование',
           'vkurse-delete' => 'Вкурсе удаление'
        ];
       
        foreach ($permissions as $roles => $names) {
          Permission::create(['name' => $roles, 'full_name' => $names]);
        }
    }
}
