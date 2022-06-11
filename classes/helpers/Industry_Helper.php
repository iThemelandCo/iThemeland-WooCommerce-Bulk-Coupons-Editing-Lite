<?php

namespace wccbef\classes\helpers;

class Industry_Helper
{
    public static function get_industries()
    {
        return [
            'Automotive and Transportation' => esc_html__('Automotive', WCCBEF_NAME),
            'AdTech and AdNetwork' => esc_html__('AdTech and AdNetwork', WCCBEF_NAME),
            'Agency' => esc_html__('Agency', WCCBEF_NAME),
            'B2B Software' => esc_html__('B2B Software', WCCBEF_NAME),
            'B2C Internet Services' => esc_html__('B2C Internet Services', WCCBEF_NAME),
            'Classifieds' => esc_html__('Classifieds', WCCBEF_NAME),
            'Consulting and Market Research' => esc_html__('Consulting and Market Research', WCCBEF_NAME),
            'CPG, Food and Beverages' => esc_html__('CPG', WCCBEF_NAME),
            'Education' => esc_html__('Education', WCCBEF_NAME),
            'Education (student)' => esc_html__('Education (Student)', WCCBEF_NAME),
            'Equity Research' => esc_html__('Equity Research', WCCBEF_NAME),
            'Financial services' => esc_html__('Financial Services', WCCBEF_NAME),
            'Gambling / Gaming' => esc_html__('Gambling and Gaming', WCCBEF_NAME),
            'Hedge Funds and Asset Management' => esc_html__('Hedge Funds and Asset Management', WCCBEF_NAME),
            'Investment Banking' => esc_html__('Investment Banking', WCCBEF_NAME),
            'Logistics and Shipping' => esc_html__('Logistics and Shipping', WCCBEF_NAME),
            'Payments' => esc_html__('Payments', WCCBEF_NAME),
            'Pharma and Healthcare' => esc_html__('Pharma and Healthcare', WCCBEF_NAME),
            'Private Equity and Venture Capital' => esc_html__('Private Equity and Venture Capital', WCCBEF_NAME),
            'Media and Entertainment' => esc_html__('Publishers and Media', WCCBEF_NAME),
            'Government Public Sector & Non Profit' => esc_html__('Public Sector, Non Profit, Fraud and Compliance', WCCBEF_NAME),
            'Retail / eCommerce' => esc_html__('Retail and eCommerce', WCCBEF_NAME),
            'Telecom and Hardware' => esc_html__('Telecom', WCCBEF_NAME),
            'Travel and Hospitality' => esc_html__('Travel', WCCBEF_NAME),
            'Other' => esc_html__('Other', WCCBEF_NAME),
        ];
    }
}
