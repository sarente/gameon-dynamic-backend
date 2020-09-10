<?php
/*
 * @author Nicolas Grekas <p@tchwork.com>*/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ZeroDaHero\LaravelWorkflow\Exceptions\DuplicateWorkflowException;

/*
 * @author Javad Fathi <k1fathi33@gmail.com>
 * */

class CustomWorkflow extends Model
{
    protected $table='workflows';

    protected $fillable = [
        'name',
        'config',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'config' => 'array',
    ];

/*    protected $attributes = [
        'type' => Setting::WF_TYPE_WF,
    ];*/

//    public static function boot()
//    {
//        parent::boot();
//
//        static::created(function (self $model) {
//            //create last activity as finishing state of workflow
//            $activity = new Activity(['name' => "Final"]);
//            $activity->workflow()->associate($model);
//            $activity->save();
//        });
//    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_workflow')->withPivot('marking');
    }

    /**
     * Load the workflow type definition into the registry
     */
    public function loadWorkflow(string $name = null)
    {
        $registry = app()->make('workflow');
        $workflowName = $name ?? $this->name;

        $workflowDefinition = include(config_path('workflow1.php'));

        $registry->addFromArray($workflowName, $workflowDefinition['values1']);

        // or if catching duplicates

        try {
            $registry->addFromArray($workflowName, $workflowDefinition['values1']);
        } catch (DuplicateWorkflowException $e) {
            // already loaded
        }
    }
}