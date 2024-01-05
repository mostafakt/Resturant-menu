<?php

namespace App\Enums\Permission;

use App\Enums\Base\EnumToArray;

enum PermissionName: string
{
    use EnumToArray;

    // <editor-fold default-state="collapsed" desc="Permissions">
    /**
     *  Permissions
     */
    case CAN_VIEW_PERMISSIONS = 'can_view_permissions';
    // </editor-fold>

    // <editor-fold default-state="collapsed" desc="Role">
    /**
     * Roles Permissions
     */
    case CAN_VIEW_ROLE = 'can_view_role';
    case CAN_CREATE_ROLE = 'can_create_role';
    case CAN_UPDATE_ROLE = 'can_update_role';
    case CAN_DELETE_ROLE = 'can_delete_role';
    case CAN_EXPORT_ROLE = 'can_export_role';
    // </editor-fold>

    // <editor-fold default-state="collapsed" desc="Categories">
    /**
     * Categories Permissions
     */
    case CAN_VIEW_CATEGORY = 'can_view_category';
    case CAN_CREATE_CATEGORY = 'can_create_category';
    case CAN_UPDATE_CATEGORY = 'can_update_category';
    case CAN_DELETE_CATEGORY = 'can_delete_category';
    case CAN_EXPORT_CATEGORY = 'can_export_category';
    // </editor-fold>


    // <editor-fold default-state="collapsed" desc="Client">
    /**
     * Clients Permissions
     */
    case CAN_VIEW_CLIENT = 'can_view_client';
    case CAN_UPDATE_CLIENT = 'can_update_client';
    case CAN_DELETE_CLIENT = 'can_delete_client';
    case CAN_EXPORT_CLIENT = 'can_export_client';
    // </editor-fold>


    // <editor-fold default-state="collapsed" desc="Employee">
    /**
     * Employees Permissions
     */
    case CAN_VIEW_EMPLOYEE = 'can_view_employee';
    case CAN_CREATE_EMPLOYEE = 'can_create_employee';
    case CAN_UPDATE_EMPLOYEE = 'can_update_employee';
    case CAN_DELETE_EMPLOYEE = 'can_delete_employee';
    case CAN_EXPORT_EMPLOYEE = 'can_export_employee';
    // </editor-fold>


    // <editor-fold default-state="collapsed" desc="Statistics">
    /**
     * Statistics Permissions
     */
    case CAN_VIEW_STATISTICS = 'can_view_statistics';
    // </editor-fold>


    // <editor-fold default-state="collapsed" desc="dashboard">

    // </editor-fold>

}
