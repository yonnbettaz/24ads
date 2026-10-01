<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Advertisement Status & Workflow Constants and Helpers
 *
 * Centralized status system:
 * - 0 = CLOSED: Campaign concluded or budget exhausted
 * - 1 = ACTIVE: Approved by admin and visible to public viewers
 * - 2 = PENDING: Created/resubmitted, awaiting admin review
 * - 3 = REJECTED: Denied by admin with required reason, not visible to public
 */

if (!defined('AD_STATUS_CLOSED')) {
    define('AD_STATUS_CLOSED', 0);
    define('AD_STATUS_ACTIVE', 1);
    define('AD_STATUS_PENDING', 2);
    define('AD_STATUS_REJECTED', 3);
}

/**
 * Return human-readable status label
 *
 * @param int|string $status
 * @return string
 */
if (!function_exists('ad_status_label')) {
    function ad_status_label($status) {
        switch ((int)$status) {
            case AD_STATUS_ACTIVE:
                return 'ACTIVE';
            case AD_STATUS_PENDING:
                return 'PENDING REVIEW';
            case AD_STATUS_REJECTED:
                return 'REJECTED';
            case AD_STATUS_CLOSED:
                return 'CLOSED';
            default:
                return 'UNKNOWN';
        }
    }
}

/**
 * Return HTML badge for advertisement status
 *
 * @param int|string $status
 * @return string
 */
if (!function_exists('ad_status_badge')) {
    function ad_status_badge($status) {
        switch ((int)$status) {
            case AD_STATUS_ACTIVE:
                return '<span class="badge badge-pill badge-success font-weight-700 px-3 py-1 text-white shadow-xs" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); font-size: 11.5px; letter-spacing: 0.3px;"><i class="fa fa-check-circle mr-1"></i> ACTIVE</span>';
            case AD_STATUS_PENDING:
                return '<span class="badge badge-pill badge-warning font-weight-700 px-3 py-1 text-dark shadow-xs" style="background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); color: #78350f !important; font-size: 11.5px; letter-spacing: 0.3px;"><i class="fa fa-clock-o mr-1"></i> PENDING REVIEW</span>';
            case AD_STATUS_REJECTED:
                return '<span class="badge badge-pill badge-danger font-weight-700 px-3 py-1 text-white shadow-xs" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); font-size: 11.5px; letter-spacing: 0.3px;"><i class="fa fa-times-circle mr-1"></i> REJECTED</span>';
            case AD_STATUS_CLOSED:
                return '<span class="badge badge-pill badge-secondary font-weight-700 px-3 py-1 text-white shadow-xs" style="background: linear-gradient(135deg, #64748b 0%, #475569 100%); font-size: 11.5px; letter-spacing: 0.3px;"><i class="fa fa-ban mr-1"></i> CLOSED</span>';
            default:
                return '<span class="badge badge-pill badge-light font-weight-700 px-3 py-1 font-size-11">UNKNOWN</span>';
        }
    }
}

/**
 * Check if advertisement is publicly viewable
 *
 * @param int|string $ads_status
 * @param int|string $record_status
 * @return bool
 */
if (!function_exists('ad_is_publicly_visible')) {
    function ad_is_publicly_visible($ads_status, $record_status = 0) {
        return ((int)$ads_status === AD_STATUS_ACTIVE && (int)$record_status === 0);
    }
}

/**
 * Return allowed admin actions based on status
 *
 * @param int|string $status
 * @return array
 */
if (!function_exists('ad_allowed_actions')) {
    function ad_allowed_actions($status) {
        switch ((int)$status) {
            case AD_STATUS_PENDING:
                return ['VIEW', 'REVIEW', 'APPROVE', 'REJECT'];
            case AD_STATUS_ACTIVE:
                return ['VIEW', 'REVIEW', 'REJECT', 'CLOSE'];
            case AD_STATUS_REJECTED:
                return ['VIEW', 'REVIEW', 'APPROVE'];
            case AD_STATUS_CLOSED:
                return ['VIEW', 'REVIEW', 'APPROVE'];
            default:
                return ['VIEW'];
        }
    }
}
