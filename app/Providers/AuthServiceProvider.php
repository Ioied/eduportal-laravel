<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

// Подключи модель и политику:
use App\Models\Article;
use App\Policies\ArticlePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Маппинг моделей → политик
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}