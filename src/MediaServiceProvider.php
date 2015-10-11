<?php namespace Blupl\PrintMedia;

use Orchestra\Support\Providers\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    /**
     * Register service provider.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->bind('Orchestra\Control\Contracts\Command\Synchronizer', 'Orchestra\Control\Command\Synchronizer');
    }

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $path = realpath(__DIR__.'/../');

        $this->addConfigComponent('blupl/printmedia', 'blupl/printmedia', $path.'/resources/config');
        $this->addLanguageComponent('blupl/printmedia', 'blupl/printmedia', $path.'/resources/lang');
        $this->addViewComponent('blupl/printmedia', 'blupl/printmedia', $path.'/resources/views');

        $this->mapExtensionConfig();
//        $this->bootExtensionEvents();
        $this->bootExtensionRouting($path);
        $this->bootExtensionMenuEvents();
//        $this->bootTimezoneEvents();
    }

    /**
     * Boot extension events.
     *
     * @return void
     */
//    protected function bootExtensionEvents()
//    {
//        $events  = $this->app['events'];
//        $handler = 'Orchestra\Control\ExtensionConfigHandler';
//
//        $events->listen('orchestra.form: extension.orchestra/control', "{$handler}@onViewForm");
//        $events->listen('orchestra.saved: extension.orchestra/control', "{$handler}@onSaved");
//    }

    /**
     * Boot extension menu handler.
     *
     * @return void
     */
    protected function bootExtensionMenuEvents()
    {
        $this->app['events']->listen('orchestra.ready: admin', 'Blupl\PrintMedia\Http\Handlers\MediaMenuHandler');
    }

    /**
     * Boot extension routing.
     *
     * @param  string  $path
     *
     * @return void
     */
    protected function bootExtensionRouting($path)
    {
        $this->app['router']->filter('media.manage', 'Orchestra\Foundation\Http\Filters\CanManage');
        $this->app['router']->filter('media.csrf', 'Orchestra\Foundation\Http\Filters\VerifyCsrfToken');

        require_once "{$path}/src/routes.php";
    }

    /**
     * Boot timezone events.
     *
     * @return void
     */
//    protected function bootTimezoneEvents()
//    {
//        $events  = $this->app['events'];
//        $handler = 'Orchestra\Control\Timezone\UserHandler';
//
//        $events->listen('orchestra.form: user.account', "{$handler}@onViewForm");
//        $events->listen('orchestra.saved: user.account', "{$handler}@onSaved");
//    }

    /**
     * Map extension config.
     *
     * @return void
     */
    protected function mapExtensionConfig()
    {
        $this->app['orchestra.extension.config']->map('blupl/printmedia', [
//            'localtime'   => 'orchestra/control::localtime.enable',
            'admin_role'  => 'orchestra/foundation::roles.admin',
            'member_role' => 'orchestra/foundation::roles.member',
        ]);
    }
}
