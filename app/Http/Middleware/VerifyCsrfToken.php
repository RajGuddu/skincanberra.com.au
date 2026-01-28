<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'admin/remove_image',
        'save_appointment_service',
        'save_book_appointment_h',
        'save_contact_us',
        // 'add_to_cart'
    ];
}
