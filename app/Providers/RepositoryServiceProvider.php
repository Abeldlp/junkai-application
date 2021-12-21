<?php
//phpcs:disable
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->bindInterfaceToRepository('Task');
        $this->bindInterfaceToRepository('TaskType');
        $this->bindInterfaceToRepository('PriorityScale');
        $this->bindInterfaceToRepository('User');
    }

    public function provides()
    {
        return [];
    }

    private function bindInterfaceToRepository($name)
    {
        $this->app->bind(
            "App\\Interfaces\\${name}Interface",
            "App\\Repositories\\${name}Repository"
        );
    }
}
