<?php

return [
    'app' => [
        'title' => 'General',
        'desc' => 'All the general settings for application.',
        'icon' => 'fas fa-cube',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'general', // data type, string, int, boolean
                'name' => 'app_name', // unique name for field
                'label' => 'App Name', // you know what label it is
                'rules' => 'required|min:2|max:50', // validation rule of laravel
                'class' => '', // any class for input
                'value' => config('app.name'), // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'general', // data type, string, int, boolean
                'name' => 'footer_text', // unique name for field
                'label' => 'Footer Text', // you know what label it is
                'rules' => 'required|min:2', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'Built with ♥ from <a href="https://iqonic.design" target="_blank">IQONIC DESIGN.</a>', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'general', // data type, string, int, boolean
                'name' => 'helpline_number', // unique name for field
                'label' => 'Helpline Number', // you know what label it is
                'rules' => 'required|min:2', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '1234567890', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'general', // data type, string, int, boolean
                'name' => 'copyright_text', // unique name for field
                'label' => 'Copyright Text', // you know what label it is
                'rules' => 'required|min:2', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'Copyright © 2023', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'general', // data type, string, int, boolean
                'name' => 'ui_text', // unique name for field
                'label' => 'UI Text', // you know what label it is
                'rules' => 'required|min:2', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'UI Powered By <a href="https://hopeui.iqonic.design/" target="_blank">HOPE UI</a>', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'general', // data type, string, int, boolean
                'name' => 'inquriy_email', // unique name for field
                'label' => 'Inquiry Email', // you know what label it is
                'rules' => 'required|min:2', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'frezka@admin.com', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'general', // data type, string, int, boolean
                'name' => 'site_description', // unique name for field
                'label' => 'Site Description', // you know what label it is
                'rules' => 'required|min:2', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'Dummy Text ', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'general', // data type, string, int, boolean
                'name' => 'google_analytics', // unique name for field
                'label' => 'Google Analytics', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
            ],
            [
                'type' => 'file', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'logo', // unique name for field
                'label' => 'Logo', // you know what label it is
                'rules' => 'nullable|image|mimes:jpg,png,gif', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'img/logo/logo.png', // default value if you want
                'help' => '', // Help text for the input field.
                'display' => 'raw', // Help text for the input field.
            ],
            [
                'type' => 'file', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'mini_logo', // unique name for field
                'label' => 'Mini Logo', // you know what label it is
                'rules' => 'nullable|image|mimes:jpg,png,gif', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'img/logo/mini_logo.png', // default value if you want
                'help' => '', // Help text for the input field.
                'display' => 'raw', // Help text for the input field.
            ],
            [
                'type' => 'file', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'dark_logo', // unique name for field
                'label' => 'Dark Logo', // you know what label it is
                'rules' => 'nullable|image|mimes:jpg,png,gif', // validation rule of laravel
                'class' => '', // any class for input
                'imageClass' => 'bg-dark',
                'value' => 'img/logo/dark_logo.png', // default value if you want
                'help' => '', // Help text for the input field.
                'display' => 'raw', // Help text for the input field.
            ],
            [
                'type' => 'file', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'dark_mini_logo', // unique name for field
                'label' => 'Dark Mini Logo', // you know what label it is
                'rules' => 'nullable|image|mimes:jpg,png,gif', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'img/logo/mini_logo.png', // default value if you want
                'help' => '', // Help text for the input field.
                'display' => 'raw', // Help text for the input field.
            ],
            [
                'type' => 'file', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'favicon', // unique name for field
                'label' => 'Favicon', // you know what label it is
                'rules' => 'nullable|image|mimes:jpg,png,gif,ico', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'img/logo/mini_logo.png', // default value if you want
                'help' => '', // Help text for the input field.
                'display' => 'raw', // Help text for the input field.
            ],
        ],
    ],
    'social' => [
        'title' => 'Social Profiles',
        'desc' => 'Link of all the social profiles.',
        'icon' => 'fas fa-users',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'facebook_url', // unique name for field
                'label' => 'Facebook Page URL', // you know what label it is
                'rules' => 'required|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '#', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'twitter_url', // unique name for field
                'label' => 'Twitter Profile URL', // you know what label it is
                'rules' => 'required|nullable|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '#', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'instagram_url', // unique name for field
                'label' => 'Instagram Account URL', // you know what label it is
                'rules' => 'required|nullable|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '#', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'linkedin_url', // unique name for field
                'label' => 'LinkedIn URL', // you know what label it is
                'rules' => 'required|nullable|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '#', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'youtube_url', // unique name for field
                'label' => 'Youtube Channel URL', // you know what label it is
                'rules' => 'required|nullable|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '#', // default value if you want
            ],
        ],

    ],
    'misc' => [
        'title' => 'Misc ',
        'desc' => 'Application Data',
        'icon' => 'fas fa-globe-asia',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'misc', // data type, string, int, boolean
                'name' => 'slot_duration', // unique name for field
                'label' => 'slot Duration', // you know what label it is
                'rules' => 'required|min:2', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '00:15', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'misc', // data type, string, int, boolean
                'name' => 'default_language', // unique name for field
                'label' => 'Language', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'en', // default value if you want
            ],

            [
                'type' => 'text', // input fields type
                'data' => 'misc', // data type, string, int, boolean
                'name' => 'default_time_zone', // unique name for field
                'label' => 'Time Zone', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'UTC', // default value if you want
            ],

            [
                'type' => 'text', // input fields type
                'data' => 'misc', // data type, string, int, boolean
                'name' => 'data_table_limit', // unique name for field
                'label' => 'Datatable Limit', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '10', // default value if you want
            ],

            [
                'type' => 'text', // input fields type
                'data' => 'misc', // data type, string, int, boolean
                'name' => 'booking_invoice_prifix', // unique name for field
                'label' => 'Booking Invoice Prefix', // you know what label it is
                'rules' => 'required|min:2', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'Inv#', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'misc', // data type, string, int, boolean
                'name' => 'is_quick_booking', // unique name for field
                'label' => 'Quick Booking', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '1', // default value if you want
            ],
        ],
    ],
    'analytics' => [
        'title' => 'Analytics',
        'desc' => 'Application Analytics',
        'icon' => 'fas fa-chart-line',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'text', // data type, string, int, boolean
                'name' => 'google_analytics', // unique name for field
                'label' => 'Google Analytics (gtag)', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
        ],

    ],
    'integration' => [
        'title' => 'Integration',
        'desc' => 'Integration',
        'icon' => 'fas fa-chart-line',

        'elements' => [
            [
                'type' => 'checkbox', // input fields type
                'data' => 'integaration', // data type, string, int, boolean
                'name' => 'is_google_login', // unique name for field
                'label' => 'integration', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '0', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            [
                'type' => 'checkbox', // input fields type
                'data' => 'integaration', // data type, string, int, boolean
                'name' => 'isForceUpdate', // unique name for field
                'label' => 'integration', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '0', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            [
                'type' => 'checkbox', // input fields type
                'data' => 'integaration', // data type, string, int, boolean
                'name' => 'is_facebook_login', // unique name for field
                'label' => 'integration', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '0', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            [
                'type' => 'checkbox', // input fields type
                'data' => 'integaration', // data type, string, int, boolean
                'name' => 'is_webpush_notification', // unique name for field
                'label' => 'integration', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '0', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            [
                'type' => 'checkbox', // input fields type
                'data' => 'integaration', // data type, string, int, boolean
                'name' => 'is_custom_webhook_notification', // unique name for field
                'label' => 'integration', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '0', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            [
                'type' => 'checkbox', // input fields type
                'data' => 'integaration', // data type, string, int, boolean
                'name' => 'is_one_signal_notification', // unique name for field
                'label' => 'integration', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '0', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            [
                'type' => 'checkbox', // input fields type
                'data' => 'integaration', // data type, string, int, boolean
                'name' => 'is_map_key', // unique name for field
                'label' => 'integration', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '0', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            [
                'type' => 'checkbox', // input fields type
                'data' => 'integaration', // data type, string, int, boolean
                'name' => 'is_application_link', // unique name for field
                'label' => 'integration', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '0', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'is_google_login', // data type, string, int, boolean
                'name' => 'google_secretkey', // unique name for field
                'label' => 'integration', // you know what label it is
                'rules' => 'required|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'is_google_login', // data type, string, int, boolean
                'name' => 'google_publickey', // unique name for field
                'label' => 'integration', // you know what label it is
                'rules' => 'required|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'is_facebook_login', // data type, string, int, boolean
                'name' => 'facebook_secretkey', // unique name for field
                'label' => 'integration', // you know what label it is
                'rules' => 'required|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'is_facebook_login', // data type, string, int, boolean
                'name' => 'facebook_publickey', // unique name for field
                'label' => 'integration', // you know what label it is
                'rules' => 'required|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'mobile_config', // data type, string, int, boolean
                'name' => 'onesignal_app_id', // unique name for field
                'label' => 'integration', // you know what label it is
                'rules' => 'required|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'mobile_config', // data type, string, int, boolean
                'name' => 'onesignal_rest_api_key', // unique name for field
                'label' => 'integration', // you know what label it is
                'rules' => 'required|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'mobile_config', // data type, string, int, boolean
                'name' => 'onesignal_channel_id', // unique name for field
                'label' => 'integration', // you know what label it is
                'rules' => 'required|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            // [
            //     'type' => 'text', // input fields type
            //     'data' => 'mobile_config', // data type, string, int, boolean
            //     'name' => 'channel_id', // unique name for field
            //     'label' => 'integration', // you know what label it is
            //     'rules' => 'required|max:191', // validation rule of laravel
            //     'class' => '', // any class for input
            //     'value' => '', // default value if you want
            //     'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            // ],
            [
                'type' => 'text', // input fields type
                'data' => 'is_map_key', // data type, string, int, boolean
                'name' => 'google_maps_key', // unique name for field
                'label' => 'integration', // you know what label it is
                'rules' => 'required|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'isForceUpdate', // data type, string, int, boolean
                'name' => 'version_code', // unique name for field
                'label' => 'integration', // you know what label it is
                'rules' => 'required|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'is_application_link', // data type, string, int, boolean
                'name' => 'customer_app_play_store', // unique name for field
                'label' => 'integration', // you know what label it is
                'rules' => 'required|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'is_application_link', // data type, string, int, boolean
                'name' => 'customer_app_app_store', // unique name for field
                'label' => 'integration', // you know what label it is
                'rules' => 'required|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'is_custom_webhook_notification', // data type, string, int, boolean
                'name' => 'custom_webhook_content_key', // unique name for field
                'label' => 'integration', // you know what label it is
                'rules' => 'required|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'is_custom_webhook_notification', // data type, string, int, boolean
                'name' => 'custom_webhook_url', // unique name for field
                'label' => 'integration', // you know what label it is
                'rules' => 'required|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
        ],

    ],
    'custom_css' => [
        'title' => 'Custom Code',
        'desc' => 'Custom code area',
        'icon' => 'fa-solid fa-file-code',

        'elements' => [
            [
                'type' => 'textarea', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'custom_css_block', // unique name for field
                'label' => 'Custom Css Code', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'help' => '', // Help text for the input field.
                'display' => 'raw', // Help text for the input field.
            ],
            [
                'type' => 'textarea', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'custom_js_block', // unique name for field
                'label' => 'Custom Js Code', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'help' => '', // Help text for the input field.
                'display' => 'raw', // Help text for the input field.
            ],

        ],

    ],
    'customization' => [
        'title' => 'Customization',
        'desc' => 'Setting on admin panel',
        'icon' => 'fa-solid fa-file-code',
        'elements' => [
            [
                'type' => 'hidden', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'customization_json', // unique name for field
                'label' => 'Customization', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '{}', // default value if you want
                'help' => '', // Help text for the input field.
                'display' => 'raw', // Help text for the input field.
            ],
            [
                'type' => 'hidden', // input fields type
                'data' => 'string', // data type, string, int, boolean
                'name' => 'root_colors', // unique name for field
                'label' => 'root_colors', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '{}', // default value if you want
                'help' => '', // Help text for the input field.
                'display' => 'raw', // Help text for the input field.
            ],
        ],
    ],
    'mobile' => [
        'title' => 'Mobile',
        'desc' => 'Application Mobile',
        'icon' => 'fas fa-chart-line',

        'elements' => [
            [
                'type' => 'text', // input fields type
                'data' => 'general', // data type, string, int, boolean
                'name' => 'primary', // unique name for field
                'label' => 'Primary', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'general', // data type, string, int, boolean
                'name' => 'secondary', // unique name for field
                'label' => 'Secondary', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
        ],

    ],

    'mail' => [
        'title' => 'Mail Setting',
        'desc' => 'Mail settings',
        'icon' => 'fas fa-envelope',

        'elements' => [
            [
                'type' => 'email', // input fields type
                'data' => 'mail_config', // data type, string, int, boolean
                'name' => 'email', // unique name for field
                'label' => 'Email', // you know what label it is
                'rules' => 'required|email', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'info@example.com', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'mail_config', // data type, string, int, boolean
                'name' => 'mail_driver', // unique name for field
                'label' => 'Mail Driver', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'smtp', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'mail_config', // data type, string, int, boolean
                'name' => 'mail_host', // unique name for field
                'label' => 'Mail Host', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'smtp.gmail.com', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'mail_config', // data type, string, int, boolean
                'name' => 'mail_port', // unique name for field
                'label' => 'Mail Port', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '587', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'mail_config', // data type, string, int, boolean
                'name' => 'mail_encryption', // unique name for field
                'label' => 'Mail Encryption', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'tls', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'mail_config', // data type, string, int, boolean
                'name' => 'mail_username', // unique name for field
                'label' => 'Mail Username', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'youremail@gmail.com', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'mail_config', // data type, string, int, boolean
                'name' => 'mail_password', // unique name for field
                'label' => 'Mail Password', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'Password', // default value if you want
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'mail_config', // data type, string, int, boolean
                'name' => 'mail_from', // unique name for field
                'label' => 'Mail From', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'youremail@gmail.com', // default value if you wantPassword
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'mail_config', // data type, string, int, boolean
                'name' => 'from_name', // unique name for field
                'label' => 'From Name', // you know what label it is
                'rules' => 'required', // validation rule of laravel
                'class' => '', // any class for input
                'value' => 'Frezka', // default value if you wantPassword
            ],
        ],

    ],
    'payment' => [
        'title' => 'Payment',
        'desc' => 'Payment',
        'icon' => 'fas fa-chart-line',

        'elements' => [
            [
                'type' => 'checkbox', // input fields type
                'data' => 'razorpayPayment', // data type, string, int, boolean
                'name' => 'razor_payment_method', // unique name for field
                'label' => 'Is Type', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '0', // default value if you want

            ],
            [
                'type' => 'text', // input fields type
                'data' => 'razor_payment_method', // data type, string, int, boolean
                'name' => 'razorpay_secretkey', // unique name for field
                'label' => 'razorpayPayment', // you know what label it is
                'rules' => 'required|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'razor_payment_method', // data type, string, int, boolean
                'name' => 'razorpay_publickey', // unique name for field
                'label' => 'razorpayPayment', // you know what label it is
                'rules' => 'required|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            [
                'type' => 'checkbox', // input fields type
                'data' => 'stripePayment', // data type, string, int, boolean
                'name' => 'str_payment_method', // unique name for field
                'label' => 'Is Type', // you know what label it is
                'rules' => '', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '0', // default value if you want

            ],
            [
                'type' => 'text', // input fields type
                'data' => 'str_payment_method', // data type, string, int, boolean
                'name' => 'stripe_secretkey', // unique name for field
                'label' => 'stripePayment', // you know what label it is
                'rules' => 'required|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
            [
                'type' => 'text', // input fields type
                'data' => 'str_payment_method', // data type, string, int, boolean
                'name' => 'stripe_publickey', // unique name for field
                'label' => 'stripePayment', // you know what label it is
                'rules' => 'required|max:191', // validation rule of laravel
                'class' => '', // any class for input
                'value' => '', // default value if you want
                'help' => 'Paste the only the Measurement Id of Google Analytics stream.', // Help text for the input field.
            ],
        ],
    ],
];
