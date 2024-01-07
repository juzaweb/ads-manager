<?php

namespace Juzaweb\AdsManager\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Juzaweb\CMS\Facades\HookAction;
use Juzaweb\CMS\Models\Model;
use Juzaweb\CMS\Traits\UseUUIDColumn;
use Juzaweb\Network\Traits\Networkable;

/**
 * Juzaweb\AdsManager\Models\Ads
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $position
 * @property string|null $body
 * @property bool $active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Ads newModelQuery()
 * @method static Builder|Ads newQuery()
 * @method static Builder|Ads query()
 * @method static Builder|Ads whereActive($value)
 * @method static Builder|Ads whereBody($value)
 * @method static Builder|Ads whereCreatedAt($value)
 * @method static Builder|Ads whereId($value)
 * @method static Builder|Ads whereName($value)
 * @method static Builder|Ads wherePosition($value)
 * @method static Builder|Ads whereSiteId($value)
 * @method static Builder|Ads whereType($value)
 * @method static Builder|Ads whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Ads extends Model
{
    use Networkable, UseUUIDColumn;

    public const TYPE_BANNER = 'banner';
    public const TYPE_HTML = 'html';

    protected $table = 'juad_ads';
    protected $fillable = [
        'name',
        'body',
        'active',
        'position',
    ];

    public static function getPositions(): array
    {
        return HookAction::getAdsPositions()
            ->whereIn('type', [self::TYPE_BANNER, self::TYPE_HTML])
            ->pluck('name', 'key')
            ->toArray();
    }

    public function getBody(): ?string
    {
        if ($this->type == self::TYPE_BANNER) {
            return '<img src="'.upload_url($this->body).'" />';
        }

        return $this->body;
    }

    public function getFieldName(): string
    {
        return 'name';
    }
}
