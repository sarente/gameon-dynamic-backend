<?php


namespace App\Exceptions\Activity;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class ActivityResultWrongAnswerException extends ModelNotFoundException
{
    protected $model = User::class;
    /**
     * Report the exception.
     * @return void
     */
    public function report()
    {
        Log::channel('errorlog')->error($this->getModel() . PHP_EOL . multi_implode ($this->getTrace()[0],','));
    }

    /**
     * Render the exception into an HTTP response.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        $this->report();
        return response()->error('activity.result.wrong-answer', [], $request->toArray(), 404);
    }
}