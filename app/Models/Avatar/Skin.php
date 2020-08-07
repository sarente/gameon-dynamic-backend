<?php

namespace App\Models\Avatar;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Avatar\Skin
 *
 * @property int $id
 * @property int $color
 * @property int $gender
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Avatar\Avatar[] $avatar
 * @property-read int|null $avatar_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Image[] $icon
 * @property-read int|null $icon_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Avatar\Posture[] $postures
 * @property-read int|null $postures_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Skin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Skin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Skin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Skin whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Skin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Skin whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Skin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Avatar\Skin whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Skin extends Model
{
    use LogsActivity;

    protected $fillable = [
        'color',
        'gender'
    ];

    protected $hidden = [
        'avatar'
    ];

    public function icon()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function postures()
    {
        return $this->morphMany(Posture::class, 'posturable');
    }

    public function avatar(): MorphToMany
    {
        return $this->morphToMany(
            Avatar::class,
            'item',
            'avatar_has_item',
            'item_id',
            'avatar_id'
        );
    }
}
