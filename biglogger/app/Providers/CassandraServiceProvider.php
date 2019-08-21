<?php

namespace App\Providers;

use Cassandra;
use Illuminate\Support\ServiceProvider;

class CassandraServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('cassandra', function () {
            $cluster = Cassandra::cluster()
                ->withContactPoints(config('cassandra.contactpoints'))
                ->withPort(intval(config('cassandra.port')))
                ->withCredentials(config('cassandra.username'), config('cassandra.password'))
                ->build();

            $keyspace = config('cassandra.keyspace');

            return $cluster->connect($keyspace);
        });
    }
}