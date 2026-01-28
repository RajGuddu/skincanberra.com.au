<?php
    use App\Services\CartService;

    if(!function_exists('alertBS')){
        function alertBS($message, $type){
            return '<div class="alert alert-'.$type.' alert-dismissible">
                        <strong class="text-primary">'.$message.'</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        }
    }

    if (!function_exists('cart')) {
        function cart()
        {
            return app(CartService::class);
        }
    }