<?php

use App\Models\Activity;
use App\Models\Workflow\Transition;
use App\Models\Workflow\Workflow;
use App\Models\Workflow\WorkflowType;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new \App\Models\Category([
            'name' => "Yetkinlikler"
        ]);
        $category->save();
        //$category->users()->attach([1,2,3]);

        for ($level_no = 0; $level_no < 6; $level_no++) {
            $pane = \App\Models\Pane::create(['level_no' => $level_no, 'pane_no' => 1, 'category_id' => $category->id]);
            $pane->image()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/level/level_{$level_no}/pane-1.png")),
            ]));
        }

        $workflow = new Workflow(['name' => 'Yetkinlik 1']);
        $workflow->category()->associate($category);
        $workflow->save();
        $workflow->users()->attach([1, 2, 3]);

        $from_activity = null;
        $to_activity = null;
        $activities = ['Giriş', 'Gelişme', 'Sonuç'];

        foreach ($activities as $key => $activity) {

            $activity = new Activity(['name' => $activity]);
            $activity->workflow()->associate($workflow);
            $activity->save();

            $to_activity = $activity->id;

            if ($from_activity && $to_activity) {
                $transition = new Transition(['name' => $workflow->name . ' transition' . $key, 'from_activity_id' => $from_activity, 'to_activity_id' => $to_activity]);
                $transition->workflow()->associate($workflow);
                $transition->save();
            }

            $from_activity = $activity->id;
        }

        $category = new \App\Models\Category([
            'name' => "Değerler Eğitimi"
        ]);
        $category->save();
        $category->users()->attach([1,2,3]);

        for ($level_no = 0; $level_no < 6; $level_no++) {
            $pane = \App\Models\Pane::create(['level_no' => $level_no, 'pane_no' => 2, 'category_id' => $category->id]);
            $pane->image()->save(new  \App\Models\Image([
                'image' => Intervention::make(resource_path("images/level/level_{$level_no}/pane-2.png")),
            ]));
        }

        $workflow = new Workflow(['name' => 'Dürüstlük']);
        $workflow->category()->associate($category);
        $workflow->save();
        $workflow->users()->attach([1, 2, 3]);

        $from_activity = null;
        $to_activity = null;
        $activities = ['Videoyu İzle', 'Bulmacayı Çöz', 'Soruyu Cevapla'];

        foreach ($activities as $key => $activity) {

            $activity = new Activity(['name' => $activity]);
            $activity->workflow()->associate($workflow);
            $activity->save();

            $to_activity = $activity->id;

            if ($from_activity && $to_activity) {
                $transition = new Transition(['name' => $workflow->name . ' transition' . $key, 'from_activity_id' => $from_activity, 'to_activity_id' => $to_activity]);
                $transition->workflow()->associate($workflow);
                $transition->save();
            }

            $from_activity = $activity->id;
        }
    }
}
