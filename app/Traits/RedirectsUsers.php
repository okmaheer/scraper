<?php

namespace App\Traits;

trait RedirectsUsers {
    public function redirectedPath() {
       
        if (method_exists($this, 'redirectTo')) {
            
            return $this->redirectTo();
        }
       
        return property_exists($this, 'redirectTo') ? $this->redirectTo: '/admin/dashboard';
    }
}
