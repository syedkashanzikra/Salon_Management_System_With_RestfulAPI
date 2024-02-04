<?php

namespace App\Models;

class Permission extends \Spatie\Permission\Models\Permission
{
    /**
     * Default Permissions of the Application.
     */
    public static function defaultPermissions()
    {
        return [
            'view_branch' => 'View branch',
            'branch_gallery' => 'Branch Gallery',
            'add_branch' => 'Add branch',
            'edit_branch' => 'edit branch',
            'delete_branch' => 'delete branch',

            'view_booking' => 'View booking',
            'add_booking' => 'Add booking',
            'edit_booking' => 'Edit booking',
            'delete_booking' => 'Delete booking',
            'booking_tableview' => 'Table View booking',

            'view_service' => 'View Service',
            'service_gallery' => 'Service Gallery',
            'add_service' => 'Add Service List',
            'edit_service' => 'Edit Service List',
            'delete_service' => 'Delete Service List',

            'view_service_package' => 'View Service Package',
            'add_service_package' => 'add Service Package',
            'edit_service_package' => 'Edit Service Package',
            'delete_service_package' => 'Delete Service Package',

            'view_category' => 'View Categories',
            'add_category' => 'add Categories',
            'edit_category' => 'Edit Categories',
            'delete_category' => 'Delete Categories',

            'view_subcategory' => 'View Subcategories',
            'add_subcategory' => 'add Subcategories',
            'edit_subcategory' => 'Edit Subcategories',
            'delete_subcategory' => 'Delete Subcategories',

            'view_staff' => 'View Staff',
            'staff_password' => 'Change Staff Password',
            'add_staff' => 'add Staff',
            'edit_staff' => 'Edit Staff',
            'delete_staff' => 'Delete Staff',

            'view_customer' => 'View Customer',
            'add_customer' => 'Add Customer',
            'edit_customer' => 'Edit Customer',
            'delete_customer' => 'Delete Customer',
            'customer_password' => 'Change Customer Password',

            'view_page' => 'View Pages',
            'add_page' => 'Add Page',
            'edit_page' => 'Edit Page',
            'delete_page' => 'Delete Page',

            'view_tax' => 'View Tax',
            'add_tax' => 'Add Tax',
            'edit_tax' => 'Edit Tax',
            'delete_tax' => 'Delete Tax',

            'view_notification' => 'View Notification ',
            'add_notification' => 'Add Notification ',
            'edit_notification' => 'Edit Notification ',
            'delete_notification' => 'Delete Notification ',

            'view_notification_template' => 'View Notification Template',
            'add_notification_template' => 'add Notification Template',
            'edit_notification_template' => 'Edit Notification Template',
            'delete_notification_template' => 'Delete Notification Template',

            'view_app_banner' => 'View App Banner',
            'add_app_banner' => 'Add App Banner',
            'edit_app_banner' => 'Edit App Banner',
            'delete_app_banner' => 'Delete App Banner',

            'view_review' => 'View Review',
            'delete_review' => 'Delete Review',

        ];
    }

    /**
     * Name should be lowercase.
     *
     * @param  string  $value  Name value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }
}
