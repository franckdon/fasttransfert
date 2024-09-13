<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Class Namespace
    |--------------------------------------------------------------------------
    |
    | This value sets the root class namespace for Livewire component classes
    | in your application. This value effects component auto-discovery and
    | any livewire file helper commands, like `artisan make:livewire`.
    |
    */

    'class_namespace' => 'App\\Livewire',

    /*
    |--------------------------------------------------------------------------
    | View Path
    |--------------------------------------------------------------------------
    |
    | This value sets the path for Livewire component views. If you'd like to
    | change the directory that Livewire component views are stored in, you
    | can do so here. Component views are stored in the resources/views dir.
    |
    */

    'view_path' => resource_path('views/livewire'),

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    | 
    | The default layout used when rendering a single component as a full-page.
    | This can be overridden on a per-component basis by defining a `layout()`
    | method within your Livewire components.
    |
    */

    'layout' => 'layouts.app',

    /*
    |--------------------------------------------------------------------------
    | Temporary File Upload Configuration
    |--------------------------------------------------------------------------
    |
    | Livewire handles file uploads by storing them in a temporary directory
    | until the developer chooses to store the file permanently. Here you can
    | configure various aspects of this temporary file storage.
    |
    */

    'temporary_file_upload' => [
        'disk' => 'local',        // Example: 'local', 's3'              | Null means use the default disk
        'rules' => ['file', 'max:10240'], // Change the max size according to your needs
        'directory' => null,   // Example: 'tmp'                       | Null means default directory
        'middleware' => 'throttle:60,1', // Throttle file uploads if needed
        'preview_mimes' => ['png', 'gif', 'bmp', 'svg', 'wav', 'mp4', 'mov', 'avi', 'wmv', 'mp3', 'm4a', 'jpg', 'jpeg', 'pdf', 'txt'], // Allow previews for these file types
        'max_upload_time' => 5, // Max duration (in minutes) to keep files in temp before automatic deletion
    ],

    /*
    |--------------------------------------------------------------------------
    | Render On Redirect
    |--------------------------------------------------------------------------
    |
    | This configuration controls whether Livewire will render before redirecting
    | or not. By default, it will wait until the browser performs the redirect
    | and then Livewire will re-render. Set this to true for immediate rendering.
    |
    */

    'render_on_redirect' => false,
];
