<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Look & feel customizations
    |--------------------------------------------------------------------------
    |
    | Make it yours.
    |
    */

    // Date & Datetime Format Syntax: https://carbon.nesbot.com/docs/#api-localization
    'default_date_format'     => 'D MMM YYYY',
    'default_datetime_format' => 'D MMM YYYY, HH:mm',

    // Direction, according to language
    // (left-to-right vs right-to-left)
    'html_direction' => 'ltr',

    // ----
    // HEAD
    // ----

    // Project name. Shown in the window title.
    'project_name' => env('APP_NAME', 'Laravel') . ' Admin Panel',

    // When clicking on the admin panel's top-left logo/name,
    // where should the user be redirected?
    // The string below will be passed through the url() helper.
    // - default: '' (project root)
    // - alternative: 'admin' (the admin's dashboard)
    'home_link' => '',

    // Content of the HTML meta robots tag to prevent indexing and link following
    'meta_robots_content' => 'noindex, nofollow',

    // ---------
    // DASHBOARD
    // ---------

    // Show "Getting Started with Backpack" info block?
    'show_getting_started' => false,

    // ------
    // STYLES
    // ------

    // CSS files that are loaded in all pages, using Laravel's asset() helper
    'styles' => [
        'packages/backpack/base/css/sightcms-bundle.css', // has primary color sightcms green
        // 'packages/backpack/base/css/bundle.css', // has primary color electric purple (backpack default)
        // 'packages/backpack/base/css/blue-bundle.css', // has primary color blue

        // Here's what's inside the bundle:
        // 'packages/@digitallyhappy/backstrap/css/style.min.css',
        // 'packages/animate.css/animate.min.css',
        // 'packages/noty/noty.css',

        // Load the fonts separately (so that you can replace them at will):
        'packages/source-sans-pro/source-sans-pro.css',
        'packages/line-awesome/css/line-awesome.min.css',

        // Example (the fonts above, loaded from CDN instead)
        // 'https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome-font-awesome.min.css',
        // 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic',

        // Example (load font-awesome instead of line-awesome):
        // 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css',
    ],

    // CSS files that are loaded in all pages, using Laravel's mix() helper
    'mix_styles' => [ // file_path => manifest_directory_path
        // 'css/app.css' => '',
    ],

    // CSS files that are loaded in all pages, using Laravel's @vite() helper
    // Please note that support for Vite was added in Laravel 9.19. Earlier versions are not able to use this feature.
    'vite_styles' => [ // resource file_path
        // 'resources/css/app.css' => '',
    ],

    // ------
    // HEADER
    // ------

    // Menu logo. You can replace this with an <img> tag if you have a logo.
    'project_logo'   => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="isolation:isolate" viewBox="0 0 512 128" width="512pt" height="128pt"><g><path d=" M 18.342 13.29 C 11.525 13.29 6 18.815 6 25.632 C 6 32.448 11.525 37.974 18.342 37.974 C 25.157 37.974 30.685 32.448 30.685 25.632 C 30.685 18.815 25.157 13.29 18.342 13.29 Z " fill="rgb(255,255,255)"/><path d=" M 67.291 86.168 C 60.476 86.168 54.951 80.642 54.951 73.826 C 54.951 67.009 60.476 61.484 67.291 61.484 C 74.108 61.484 79.634 67.009 79.634 73.826 C 79.634 80.642 74.108 86.168 67.291 86.168 Z  M 87.939 19.929 L 46.227 19.929 C 46.227 37.727 31.798 52.155 13.999 52.155 L 13.999 93.867 C 13.999 96.608 16.221 98.83 18.962 98.83 L 60.231 98.83 C 61.468 98.83 62.663 99.293 63.578 100.129 L 78.853 114.089 C 80.364 115.47 82.795 114.398 82.795 112.351 L 82.795 103.792 C 82.795 101.052 85.018 98.83 87.758 98.83 L 87.939 98.83 C 90.68 98.83 92.9 96.608 92.9 93.867 L 92.9 24.891 C 92.9 22.15 90.68 19.929 87.939 19.929 Z " fill="rgb(55,183,121)"/><path d=" M 125.701 85.333 C 122.389 84.368 119.795 83.14 117.919 81.649 L 121.23 75.358 C 123.162 76.738 125.507 77.841 128.267 78.669 C 131.026 79.497 133.813 79.911 136.628 79.911 C 143.582 79.911 147.059 77.924 147.059 73.95 C 147.059 72.626 146.588 71.578 145.651 70.805 C 144.712 70.032 143.54 69.467 142.133 69.108 C 140.726 68.749 138.724 68.349 136.131 67.907 C 132.599 67.356 129.716 66.721 127.48 66.004 C 125.246 65.287 123.327 64.073 121.727 62.361 C 120.126 60.651 119.326 58.25 119.326 55.158 C 119.326 51.185 120.982 47.998 124.294 45.597 C 127.604 43.196 132.046 41.996 137.621 41.996 C 140.546 41.996 143.471 42.356 146.396 43.073 C 149.321 43.79 151.721 44.757 153.599 45.97 L 150.205 52.262 C 146.616 49.943 142.395 48.784 137.538 48.784 C 134.172 48.784 131.605 49.337 129.84 50.44 C 128.073 51.545 127.191 53.006 127.191 54.828 C 127.191 56.263 127.687 57.394 128.681 58.221 C 129.674 59.049 130.902 59.658 132.365 60.043 C 133.826 60.43 135.883 60.871 138.532 61.368 C 142.063 61.976 144.919 62.623 147.1 63.313 C 149.279 64.004 151.143 65.176 152.688 66.831 C 154.232 68.487 155.005 70.805 155.005 73.785 C 155.005 77.759 153.309 80.918 149.915 83.263 C 146.52 85.61 141.898 86.782 136.048 86.782 C 132.461 86.782 129.012 86.298 125.701 85.333 Z " fill="rgb(55,183,121)"/><path d=" M 164.939 42.41 L 172.886 42.41 L 172.886 86.285 L 164.939 86.285 L 164.939 42.41 Z  M 165.063 32.476 C 164.041 31.483 163.532 30.269 163.532 28.834 C 163.532 27.399 164.041 26.172 165.063 25.15 C 166.084 24.129 167.367 23.619 168.913 23.619 C 170.457 23.619 171.74 24.102 172.762 25.067 C 173.782 26.033 174.293 27.233 174.293 28.668 C 174.293 30.158 173.782 31.414 172.762 32.435 C 171.74 33.457 170.457 33.966 168.913 33.966 C 167.367 33.966 166.084 33.469 165.063 32.476 Z " fill="rgb(55,183,121)"/><path d=" M 214.897 75.689 C 217.187 74.476 218.981 72.779 220.279 70.598 C 221.574 68.418 222.224 65.949 222.224 63.189 C 222.224 58.94 220.816 55.504 218.002 52.882 C 215.187 50.262 211.572 48.95 207.157 48.95 C 202.687 48.95 199.045 50.262 196.23 52.882 C 193.415 55.504 192.009 58.94 192.009 63.189 C 192.009 65.949 192.656 68.418 193.954 70.598 C 195.249 72.779 197.043 74.476 199.334 75.689 C 201.624 76.903 204.232 77.51 207.157 77.51 C 210.026 77.51 212.607 76.903 214.897 75.689 Z  M 230.005 42.41 L 230.005 80.325 C 230.005 87.995 228.102 93.665 224.293 97.337 C 220.485 101.006 214.801 102.842 207.24 102.842 C 203.101 102.842 199.155 102.276 195.402 101.145 C 191.649 100.013 188.614 98.399 186.296 96.302 L 190.104 90.176 C 192.145 91.941 194.67 93.335 197.679 94.357 C 200.687 95.377 203.79 95.888 206.991 95.888 C 212.124 95.888 215.918 94.673 218.374 92.245 C 220.829 89.816 222.059 86.119 222.059 81.152 L 222.059 77.676 C 220.181 79.939 217.877 81.636 215.146 82.767 C 212.415 83.899 209.447 84.464 206.246 84.464 C 202.052 84.464 198.259 83.567 194.864 81.773 C 191.47 79.98 188.807 77.468 186.876 74.24 C 184.943 71.012 183.978 67.328 183.978 63.189 C 183.978 59.049 184.943 55.366 186.876 52.137 C 188.807 48.908 191.47 46.412 194.864 44.645 C 198.259 42.88 202.052 41.996 206.246 41.996 C 209.558 41.996 212.634 42.604 215.477 43.818 C 218.319 45.032 220.651 46.826 222.472 49.198 L 222.472 42.41 L 230.005 42.41 Z " fill="rgb(55,183,121)"/><path d=" M 281.868 46.839 C 285.151 50.067 286.793 54.801 286.793 61.037 L 286.793 86.285 L 278.846 86.285 L 278.846 61.947 C 278.846 57.698 277.824 54.496 275.783 52.344 C 273.741 50.192 270.817 49.115 267.009 49.115 C 262.704 49.115 259.31 50.372 256.826 52.882 C 254.343 55.395 253.101 58.995 253.101 63.685 L 253.101 86.285 L 245.154 86.285 L 245.154 24.86 L 253.101 24.86 L 253.101 48.619 C 254.757 46.523 256.922 44.893 259.599 43.735 C 262.276 42.576 265.27 41.996 268.581 41.996 C 274.155 41.996 278.584 43.61 281.868 46.839 Z " fill="rgb(55,183,121)"/><path d=" M 326.198 83.719 C 325.04 84.712 323.604 85.471 321.893 85.995 C 320.182 86.519 318.416 86.782 316.595 86.782 C 312.18 86.782 308.759 85.596 306.33 83.223 C 303.901 80.85 302.688 77.455 302.688 73.04 L 302.688 48.95 L 295.237 48.95 L 295.237 42.41 L 302.688 42.41 L 302.688 32.807 L 310.635 32.807 L 310.635 42.41 L 323.218 42.41 L 323.218 48.95 L 310.635 48.95 L 310.635 72.708 C 310.635 75.082 311.227 76.903 312.415 78.173 C 313.601 79.443 315.298 80.077 317.506 80.077 C 319.934 80.077 322.004 79.387 323.715 78.007 L 326.198 83.719 Z " fill="rgb(55,183,121)"/><path d=" M 342.96 84.009 C 339.18 82.051 336.227 79.332 334.102 75.854 C 331.977 72.377 330.915 68.432 330.915 64.016 C 330.915 59.602 331.977 55.655 334.102 52.178 C 336.227 48.702 339.18 45.984 342.96 44.024 C 346.74 42.066 351.003 41.085 355.75 41.085 C 360.44 41.085 364.538 42.066 368.044 44.024 C 371.548 45.984 374.099 48.784 375.702 52.427 L 365.685 57.808 C 363.366 53.724 360.027 51.682 355.668 51.682 C 352.301 51.682 349.513 52.787 347.306 54.993 C 345.099 57.201 343.996 60.208 343.996 64.016 C 343.996 67.824 345.099 70.834 347.306 73.04 C 349.513 75.248 352.301 76.351 355.668 76.351 C 360.082 76.351 363.421 74.31 365.685 70.225 L 375.702 75.689 C 374.099 79.221 371.548 81.98 368.044 83.967 C 364.538 85.954 360.44 86.948 355.75 86.948 C 351.003 86.948 346.74 85.968 342.96 84.009 Z " fill="rgb(254,254,254)"/><path d=" M 453.474 46.012 C 456.758 49.295 458.401 54.221 458.401 60.788 L 458.401 86.285 L 445.486 86.285 L 445.486 62.774 C 445.486 59.244 444.754 56.608 443.292 54.869 C 441.83 53.13 439.746 52.262 437.042 52.262 C 434.006 52.262 431.606 53.242 429.841 55.2 C 428.073 57.16 427.191 60.071 427.191 63.933 L 427.191 86.285 L 414.277 86.285 L 414.277 62.774 C 414.277 55.766 411.462 52.262 405.834 52.262 C 402.853 52.262 400.479 53.242 398.713 55.2 C 396.947 57.16 396.065 60.071 396.065 63.933 L 396.065 86.285 L 383.151 86.285 L 383.151 41.747 L 395.486 41.747 L 395.486 46.88 C 397.141 45.005 399.169 43.569 401.57 42.576 C 403.971 41.582 406.605 41.085 409.476 41.085 C 412.622 41.085 415.463 41.707 418.002 42.948 C 420.54 44.19 422.582 45.999 424.128 48.37 C 425.949 46.052 428.254 44.26 431.04 42.99 C 433.827 41.721 436.877 41.085 440.188 41.085 C 445.762 41.085 450.19 42.728 453.474 46.012 Z " fill="rgb(254,254,254)"/><path d=" M 474.129 85.581 C 470.596 84.671 467.781 83.526 465.685 82.146 L 469.99 72.874 C 471.977 74.145 474.377 75.179 477.192 75.979 C 480.007 76.779 482.766 77.179 485.47 77.179 C 490.934 77.179 493.665 75.827 493.665 73.123 C 493.665 71.854 492.921 70.943 491.43 70.391 C 489.941 69.84 487.65 69.37 484.559 68.983 C 480.917 68.432 477.909 67.798 475.537 67.079 C 473.163 66.363 471.107 65.093 469.368 63.271 C 467.63 61.45 466.76 58.857 466.76 55.49 C 466.76 52.676 467.574 50.179 469.203 47.998 C 470.831 45.818 473.204 44.121 476.323 42.907 C 479.44 41.694 483.123 41.085 487.374 41.085 C 490.52 41.085 493.652 41.431 496.77 42.121 C 499.888 42.811 502.468 43.763 504.51 44.977 L 500.205 54.165 C 496.287 51.959 492.01 50.854 487.374 50.854 C 484.614 50.854 482.544 51.241 481.165 52.013 C 479.785 52.787 479.096 53.78 479.096 54.993 C 479.096 56.374 479.841 57.34 481.33 57.891 C 482.821 58.443 485.193 58.966 488.451 59.463 C 492.093 60.071 495.073 60.719 497.391 61.409 C 499.709 62.099 501.723 63.354 503.434 65.176 C 505.144 66.997 506 69.536 506 72.791 C 506 75.552 505.172 78.007 503.516 80.159 C 501.86 82.312 499.446 83.982 496.273 85.167 C 493.099 86.354 489.332 86.948 484.974 86.948 C 481.275 86.948 477.66 86.492 474.129 85.581 Z " fill="rgb(254,254,254)"/></g></svg>',

    // Show / hide breadcrumbs on admin panel pages.
    'breadcrumbs' => true,

    // Horizontal navbar classes. Helps make the admin panel look similar to your project's design.
    'header_class' => 'app-header bg-dark border-0 navbar',
    // For background colors use: bg-dark, bg-primary, bg-secondary, bg-danger, bg-warning, bg-success, bg-info, bg-blue, bg-light-blue, bg-indigo, bg-purple, bg-pink, bg-red, bg-orange, bg-yellow, bg-green, bg-teal, bg-cyan, bg-white
    // For links to be visible on different background colors use: "navbar-dark", "navbar-light", "navbar-color"

    // ----
    // BODY
    // ----

    // Body element classes.
    'body_class' => 'app aside-menu-fixed sidebar-lg-show',
    // Try sidebar-hidden, sidebar-fixed, sidebar-compact, sidebar-lg-show

    // Sidebar element classes.
    'sidebar_class' => 'sidebar sidebar-pills sidebar-light bg-dark text-white',
    // Remove "sidebar-transparent" for standard sidebar look
    // Try "sidebar-light" or "sidebar-dark" for dark/light links
    // You can also add a background class like bg-dark, bg-primary, bg-secondary, bg-danger, bg-warning, bg-success, bg-info, bg-blue, bg-light-blue, bg-indigo, bg-purple, bg-pink, bg-red, bg-orange, bg-yellow, bg-green, bg-teal, bg-cyan

    // ------
    // FOOTER
    // ------

    // Footer element classes.
    'footer_class' => 'app-footer d-none',
    // hide it with d-none
    // change background color with bg-dark, bg-primary, bg-secondary, bg-danger, bg-warning, bg-success, bg-info, bg-blue, bg-light-blue, bg-indigo, bg-purple, bg-pink, bg-red, bg-orange, bg-yellow, bg-green, bg-teal, bg-cyan, bg-white

    // Developer or company name. Shown in footer.
    'developer_name' => false,

    // Developer website. Link in footer. Type false if you want to hide it.
    'developer_link' => false,

    // Show powered by Laravel Backpack in the footer? true/false
    'show_powered_by' => false,

    // -------
    // SCRIPTS
    // -------

    // JS files that are loaded in all pages, using Laravel's asset() helper
    'scripts' => [
        // Backstrap includes jQuery, Bootstrap, CoreUI, PNotify, Popper
        'packages/backpack/base/js/bundle.js',

        // examples (everything inside the bundle, loaded from CDN)
        // 'https://code.jquery.com/jquery-3.4.1.min.js',
        // 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js',
        // 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js',
        // 'https://unpkg.com/@coreui/coreui@2.1.16/dist/js/coreui.min.js',
        // 'https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
        // 'https://unpkg.com/sweetalert/dist/sweetalert.min.js',
        // 'https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js'

        // examples (VueJS or React)
        // 'https://unpkg.com/vue@2.4.4/dist/vue.min.js',
        // 'https://unpkg.com/react@16/umd/react.production.min.js',
        // 'https://unpkg.com/react-dom@16/umd/react-dom.production.min.js',
    ],

    // JS files that are loaded in all pages, using Laravel's mix() helper
    'mix_scripts' => [ // file_path => manifest_directory_path
        // 'js/app.js' => '',
    ],

    // JS files that are loaded in all pages, using Laravel's @vite() helper
    'vite_scripts' => [ // resource file_path
        // 'resources/js/app.js',
    ],

    // -------------
    // CACHE-BUSTING
    // -------------

    // All JS and CSS assets defined above have this string appended as query string (?v=string).
    // If you want to manually trigger cachebusting for all styles and scripts,
    // append or prepend something to the string below, so that it's different.
    'cachebusting_string' => \PackageVersions\Versions::getVersion('backpack/crud'),

    /*
    |--------------------------------------------------------------------------
    | Registration Open
    |--------------------------------------------------------------------------
    |
    | Choose whether new users/admins are allowed to register.
    | This will show the Register button on the login page and allow access to the
    | Register functions in AuthController.
    |
    | By default the registration is open only on localhost.
    */

    'registration_open' => env('BACKPACK_REGISTRATION_OPEN', env('APP_ENV') === 'local'),

    /*
    |--------------------------------------------------------------------------
    | Routing
    |--------------------------------------------------------------------------
    */

    // The prefix used in all base routes (the 'admin' in admin/dashboard)
    // You can make sure all your URLs use this prefix by using the backpack_url() helper instead of url()
    'route_prefix' => 'admin',

    // The web middleware (group) used in all base & CRUD routes
    // If you've modified your "web" middleware group (ex: removed sessions), you can use a different
    // route group, that has all the the middleware listed below in the comments.
    'web_middleware' => 'web',
    // Or you can comment the above, and uncomment the complete list below.
    // 'web_middleware' => [
    //     \App\Http\Middleware\EncryptCookies::class,
    //     \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
    //     \Illuminate\Session\Middleware\StartSession::class,
    //     \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    //     \App\Http\Middleware\VerifyCsrfToken::class,
    // ],

    // Set this to false if you would like to use your own AuthController and PasswordController
    // (you then need to setup your auth routes manually in your routes.php file)
    // Warning: if you disable this, the password recovery routes (below) will be disabled too!
    'setup_auth_routes' => true,

    // Set this to false if you would like to skip adding the dashboard routes
    // (you then need to overwrite the login route on your AuthController)
    'setup_dashboard_routes' => true,

    // Set this to false if you would like to skip adding "my account" routes
    // (you then need to manually define the routes in your web.php)
    'setup_my_account_routes' => true,

    // Set this to false if you would like to skip adding the password recovery routes
    // (you then need to manually define the routes in your web.php)
    'setup_password_recovery_routes' => true,

    /*
    |--------------------------------------------------------------------------
    | Security
    |--------------------------------------------------------------------------
    */

    // Backpack will prevent visitors from requesting password recovery too many times
    // for a certain email, to make sure they cannot be spammed that way.
    // How many seconds should a visitor wait, after they've requested a
    // password reset, before they can try again for the same email?
    'password_recovery_throttle_notifications' => 600, // time in seconds

    // How much time should the token sent to the user email be considered valid?
    // After this time expires, user needs to request a new reset token.
    'password_recovery_token_expiration' => 60, // time in minutes

    // Backpack will prevent an IP from trying to reset the password too many times,
    // so that a malicious actor cannot try too many emails, too see if they have
    // accounts or to increase the AWS/SendGrid/etc bill.
    //
    // How many times in any given time period should the user be allowed to
    // attempt a password reset? Take into account that user might wrongly
    // type an email at first, so at least allow one more try.
    // Defaults to 3,10 - 3 times in 10 minutes.
    'password_recovery_throttle_access' => '3,10',

    /*
    |--------------------------------------------------------------------------
    | Authentication
    |--------------------------------------------------------------------------
    */

    // Fully qualified namespace of the User model
    'user_model_fqn' => config('auth.providers.users.model'),
    // 'user_model_fqn' => App\User::class, // works on Laravel <= 7
    // 'user_model_fqn' => App\Models\User::class, // works on Laravel >= 8

    // The classes for the middleware to check if the visitor is an admin
    // Can be a single class or an array of classes
    'middleware_class' => [
        App\Http\Middleware\CheckIfAdmin::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \Backpack\CRUD\app\Http\Middleware\AuthenticateSession::class,
        // \Backpack\CRUD\app\Http\Middleware\UseBackpackAuthGuardInsteadOfDefaultAuthGuard::class,
    ],

    // Alias for that middleware
    'middleware_key' => 'admin',
    // Note: It's recommended to use the backpack_middleware() helper everywhere, which pulls this key for you.

    // Username column for authentication
    // The Backpack default is the same as the Laravel default (email)
    // If you need to switch to username, you also need to create that column in your db
    'authentication_column'      => 'email',
    'authentication_column_name' => 'Email',

    // Backpack assumes that your "database email column" for operations like Login and Register is called "email".
    // If your database email column have a different name, you can configure it here. Eg: `user_mail`
    'email_column' => 'email',

    // The guard that protects the Backpack admin panel.
    // If null, the config.auth.defaults.guard value will be used.
    'guard' => 'backpack',

    // The password reset configuration for Backpack.
    // If null, the config.auth.defaults.passwords value will be used.
    'passwords' => 'backpack',

    // What kind of avatar will you like to show to the user?
    // Default: gravatar (automatically use the gravatar for their email)
    // Other options:
    // - null (generic image with their first letter)
    // - example_method_name (specify the method on the User model that returns the URL)
    'avatar_type' => 'gravatar',

    // Gravatar fallback options are 'identicon', 'monsterid', 'wavatar', 'retro', 'robohash', 'blank'
    // 'blank' will keep the generic image with the user first letter
    'gravatar_fallback' => 'blank',

    /*
    |--------------------------------------------------------------------------
    | Theme (User Interface)
    |--------------------------------------------------------------------------
    */
    // Change the view namespace in order to load a different theme than the one Backpack provides.
    // You can create child themes yourself, by creating a view folder anywhere in your resources/views
    // and choosing that view_namespace instead of the default one. Backpack will load a file from there
    // if it exists, otherwise it will load it from the default namespace ("backpack::").

    'view_namespace' => 'backpack::',

    // EXAMPLE: if you create a new folder in resources/views/vendor/myname/mypackage,
    // your namespace would be the one below. IMPORTANT: in this case the namespace ends with a dot.
    // 'view_namespace' => 'vendor.myname.mypackage.',

    // Tell Backpack to look in more places for component views (like widgets)
    'component_view_namespaces' => [
        'widgets' => [
            'backpack::widgets', // falls back to 'resources/views/vendor/backpack/base/widgets'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | File System
    |--------------------------------------------------------------------------
    */

    // Backpack\Base sets up its own filesystem disk, just like you would by
    // adding an entry to your config/filesystems.php. It points to the root
    // of your project and it's used throughout all Backpack packages.
    //
    // You can rename this disk here. Default: root
    'root_disk_name' => 'root',

    /*
    |--------------------------------------------------------------------------
    | Backpack Token Username
    |--------------------------------------------------------------------------
    |
    | If you have access to closed-source Backpack add-ons, please provide
    | your token username here, if you're getting yellow alerts on your
    | admin panel's pages. Normally this is not needed, it is
    | preferred to add this as an environment variable
    | (most likely in your .env file).
    |
    | More info and payment form on:
    | https://www.backpackforlaravel.com
    |
    */

    'token_username' => env('BACKPACK_TOKEN_USERNAME', false),
];
