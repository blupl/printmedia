<?php namespace Blupl\PrintMedia\Http\Presenters;

use Orchestra\Html\Form\Fieldset;
use Blupl\PrintMedia\Model\MediaPrint as Eloquent;
use Illuminate\Contracts\Config\Repository;
use Orchestra\Contracts\Html\Form\Grid as FormGrid;
use Orchestra\Contracts\Html\Table\Grid as TableGrid;
use Orchestra\Contracts\Html\Form\Factory as FormFactory;
use Orchestra\Contracts\Html\Table\Builder as TableBuilder;
use Orchestra\Contracts\Html\Table\Factory as TableFactory;

class ReporterPresenter extends Presenter
{
    /**
     * Implement of config contract.
     *
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * Create a new Role presenter.
     *
     * @param  \Illuminate\Contracts\Config\Repository  $config
     * @param  \Orchestra\Contracts\Html\Form\Factory  $form
     * @param  \Orchestra\Contracts\Html\Table\Factory  $table
     */
    public function __construct(Repository $config, FormFactory $form, TableFactory $table)
    {
        $this->config = $config;
        $this->form   = $form;
        $this->table  = $table;
    }

    /**
     * View table generator for Orchestra\Model\Role.
     *
     * @param  \Orchestra\Model\Role|\Illuminate\Pagination\Paginator  $model
     *
     * @return \Orchestra\Contracts\Html\Table\Builder
     */
    public function table($model)
    {
        return $this->table->of('student', function (TableGrid $table) use ($model) {
            // attach Model and set pagination option to true.
            $table->with($model)->paginate(true);

            $table->sortable();
            $table->searchable(['name']);

            $table->layout('orchestra/foundation::components.table');

            // Add columns.
            $table->column(trans('orchestra/foundation::label.name'), 'name');
            $table->column('Phone', 'phone');
            $table->column('Address', 'address');

            $table->attributes(['class' => 'table table-striped responsive-utilities jambo_table']);

        });
    }

    /**
     * Table actions View Generator for Orchestra\Model\User.
     *
     * @param  \Orchestra\Contracts\Html\Table\Builder  $table
     *
     * @return \Orchestra\Contracts\Html\Table\Builder
     */
    public function actions(TableBuilder $table)
    {
        return $table->extend(function (TableGrid $table) {
            $table->column('action')
                ->label('Action')
                ->escape(false)
                ->attributes(function () {
                    return ['class' => 'th-action'];
                })
                ->value(function ($row) {
                    $html = [
                        app('html')->link(
                            handles("orchestra::media/profile/{$row->id}/edit"),
                            trans('orchestra/foundation::label.edit'),
                            ['class' => 'btn btn-xs btn-warning']
                        ),
                    ];

                    $roles = [
                        (int) $this->config->get('orchestra/foundation::media.admin'),
                        (int) $this->config->get('orchestra/foundation::media.member'),
                    ];

                    if (! in_array((int) $row->id, $roles)) {
                        $html[] = app('html')->link(
                            handles("orchestra::media/profile/{$row->id}/delete", ['csrf' => true]),
                            trans('orchestra/foundation::label.delete'),
                            ['class' => 'btn btn-xs btn-danger']
                        );
                    }

                    return app('html')->create('div', app('html')->raw(implode('', $html)), ['class' => 'btn-group']);
                });
        });
    }

    /**
     * View form generator for Orchestra\Model\Role.
     *
     */
    public function form(Eloquent $model)
    {
        return $this->form->of('school.student.profile', function (FormGrid $form) use ($model) {
            $form->resource($this, 'orchestra::student/profile', $model);
            $form->hidden('id');
            $form->fieldset(function (Fieldset $fieldset) {
                $fieldset->control('input:text', 'name')
                    ->label('Name');
                $fieldset->control('input.text', 'phone')
                    ->label('Phone');
                $fieldset->control('input.text', 'address')
                    ->label('Address');
            });
        });
    }
}
