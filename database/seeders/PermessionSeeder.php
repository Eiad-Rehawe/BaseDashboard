<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class PermessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        //admins
        Permission::create(['name'=>'Display Employees','permission_id'=>1,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'عرض الموظفين','permission_id'=>1,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Create Employee','permission_id'=>3,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'إضافة موظف','permission_id'=>3,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Update Employee','permission_id'=>5,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'تعديل موظف','permission_id'=>5,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Update Status Employee','permission_id'=>7,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'تعديل حالة موظف','permission_id'=>7,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Delete Employee','permission_id'=>9,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'حذف موظف','permission_id'=>9,'lang_id'=>1,'guard_name' => 'admin']);
       

        

        //roles
        Permission::create(['name'=>'Display Roles','permission_id'=>11,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'عرض الصلاحيات','permission_id'=>11,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Create Role','permission_id'=>13,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'إضافة صلاحية','permission_id'=>13,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Update Role','permission_id'=>15,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'تعديل صلاحية','permission_id'=>15,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Delete Role','permission_id'=>17,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'حذف صلاحية','permission_id'=>17,'lang_id'=>1,'guard_name' => 'admin']);

        //Products
        Permission::create(['name'=>'Display Products','permission_id'=>19,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'عرض المنتجات','permission_id'=>19,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Create Product','permission_id'=>21,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'إضافة منتج','permission_id'=>21,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Update Product','permission_id'=>23,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'تعديل منتج','permission_id'=>23,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Update Product Status','permission_id'=>25,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'تعديل حالة المنتج','permission_id'=>25,'lang_id'=>1,'guard_name' => 'admin']);
       
        Permission::create(['name'=>'Delete Product','permission_id'=>27,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'حذف منتج','permission_id'=>27,'lang_id'=>1,'guard_name' => 'admin']);

   

        //users
        Permission::create(['name'=>'Display Users','permission_id'=>29,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'عرض المستخدمين','permission_id'=>29,'lang_id'=>1,'guard_name' => 'admin']);


        //categories
        Permission::create(['name'=>'Display Categories','permission_id'=>31,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'عرض الأقسام','permission_id'=>31,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Create Category','permission_id'=>33,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'إضافة قسم','permission_id'=>33,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Update Category','permission_id'=>35,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'تعديل قسم','permission_id'=>35,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Update Category Status','permission_id'=>37,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'تعديل حالة القسم','permission_id'=>37,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Delete Category','permission_id'=>39,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'حذف قسم','permission_id'=>39,'lang_id'=>1,'guard_name' => 'admin']);

        //complaiments
        Permission::create(['name'=>'Display Complaiments','permission_id'=>41,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'عرض الشكاوي','permission_id'=>41,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Create Complaiment','permission_id'=>43,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'إضافة شكوى','permission_id'=>43,'lang_id'=>1,'guard_name' => 'admin']);
        //coupons
        Permission::create(['name'=>'Display Coupons','permission_id'=>45,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'عرض الكوبونات','permission_id'=>45,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Create Coupon','permission_id'=>47,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'إضافة كوبون','permission_id'=>47,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Update Coupon','permission_id'=>49,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'تعديل كوبون','permission_id'=>49,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Update Coupon Status','permission_id'=>51,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'تعديل حالة كوبون','permission_id'=>51,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Delete Coupon','permission_id'=>53,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'حذف كوبون','permission_id'=>53,'lang_id'=>1,'guard_name' => 'admin']);


        //links
        Permission::create(['name'=>'Display Links','permission_id'=>55,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'عرض الروابط','permission_id'=>55,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Create Link','permission_id'=>57,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'إضافة رابط','permission_id'=>57,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Update Link','permission_id'=>59,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'تعديل رابط','permission_id'=>59,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Update Link Status','permission_id'=>61,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'تعديل حالة رابط','permission_id'=>61,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Delete Link','permission_id'=>63,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'حذف رابط','permission_id'=>63,'lang_id'=>1,'guard_name' => 'admin']);

        //posters
        Permission::create(['name'=>'Display Offers','permission_id'=>65,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'عرض العروض','permission_id'=>65,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Create Offer','permission_id'=>67,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'إضافة العرض','permission_id'=>67,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Update Offer','permission_id'=>69,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'تعديل العرض','permission_id'=>69,'lang_id'=>1,'guard_name' => 'admin']);
        // Permission::create(['name'=>'Update Poster Status','permission_id'=>71,'lang_id'=>2,'guard_name' => 'admin']);
        // Permission::create(['name'=>'تعديل حالة إعلان','permission_id'=>71,'lang_id'=>1,'guard_name' => 'admin']);
        Permission::create(['name'=>'Delete Offer','permission_id'=>71,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'حذف العرض','permission_id'=>71,'lang_id'=>1,'guard_name' => 'admin']);

        Permission::create(['name'=>'Display Orders','permission_id'=>73,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'عرض الطلبات','permission_id'=>73,'lang_id'=>1,'guard_name' => 'admin']);

        Permission::create(['name'=>'Delete Multible','permission_id'=>75,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'حذف متعدد','permission_id'=>75,'lang_id'=>2,'guard_name' => 'admin']);

        //comments
        Permission::create(['name'=>'Display Comments','permission_id'=>77,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'عرض التعليقات','permission_id'=>77,'lang_id'=>1,'guard_name' => 'admin']);

        //contacts
        Permission::create(['name'=>'Display Contacts','permission_id'=>77,'lang_id'=>2,'guard_name' => 'admin']);
        Permission::create(['name'=>'عرض الرسائل','permission_id'=>77,'lang_id'=>1,'guard_name' => 'admin']);
        

        }
}
