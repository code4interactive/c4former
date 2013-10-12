<?php namespace Code4\C4former;

use Illuminate\Config\FileLoader as ConfigLoader;
use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class C4formerServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('code4/c4former');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{



        // Bind classes to container
        $provider = new static($this->app);
        $app      = $provider->bindCoreClasses($this->app);
        $app      = $provider->bindFormer($app);

        return $app;




/*
        $this->app['c4former'] = $this->app->share(function($app)
        {
            return new Form(array('session' => $app['session'], 'url' => $app['url'], 'html' => $app['html']));

        });*/

        /*$autoLoader = \Illuminate\Foundation\AliasLoader::getInstance();
        $autoLoader->alias('c4former', 'Code4\C4Former\Facades\C4former');*/

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('c4former');
	}



    /**
     * Bind the core classes to the Container
     *
     * @param  Container $app
     *
     * @return Container
     */
    public function bindCoreClasses(Container $app)
    {
        // Core classes
        //////////////////////////////////////////////////////////////////

        $app->bindIf('files', 'Illuminate\Filesystem\Filesystem');
        $app->bindIf('url',   'Illuminate\Routing\UrlGenerator');

        // Session and request
        //////////////////////////////////////////////////////////////////

        $app->bindIf('session.manager', function ($app) {
            return new SessionManager($app);
        });

        $app->bindIf('session', function ($app) {
            return $app['session.manager']->driver('array');
        }, true);

        $app->bindIf('request', function ($app) {
            $request = Request::createFromGlobals();
            $request->setSessionStore($app['session']);

            return $request;
        }, true);

        // Config
        //////////////////////////////////////////////////////////////////
        $app->bindIf('config', function ($app) {
            $fileloader = new ConfigLoader($app['files'], __DIR__.'/../config');

            return new Repository($fileloader, 'config');
        }, true);

        // Add config namespace
        $app['config']->package('code4/c4former', __DIR__.'/../config');

        return $app;
    }

    /**
     * Bind Former classes to the container
     *
     * @param  Container $app
     *
     * @return Container
     */
    public function bindFormer(Container $app)
    {
        // Get framework to use
        $framework = $app['config']->get('c4former::framework');
/*
        $app->singleton('former.populator', function ($app) {
            return new Populator;
        });
*/
        $app->singleton('c4former', function ($app) {
            return new C4Former($app);
        });
/*
        Helpers::setApp($app);
*/
        return $app;
    }

}