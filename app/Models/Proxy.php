<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * App\Models\Proxy
 *
 * @property int $id
 * @property string $ip IP地址
 * @property string $port 端口
 * @property string $anonymity 匿名度 transparent透明 anonymous匿名
 * @property string $protocol 协议
 * @property int $speed 响应速度 毫秒
 * @property string|null $checked_at 最新校验时间
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Proxy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Proxy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Proxy query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Proxy whereAnonymity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Proxy whereCheckedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Proxy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Proxy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Proxy whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Proxy wherePort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Proxy whereProtocol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Proxy whereSpeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Proxy whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Proxy extends Model
{

    protected $guarded = [];

    /**
     * 获取最新验证代理
     */
    public static function getNewest()
    {
        $proxy = self::query()
            ->orderByDesc('checked_at')
            ->orderBy('speed')
            ->first();
        $data = $proxy->ip . ':' . $proxy->port;
        $proxy->delete();
        return $data;
    }

    /**
     * 获取代理列表
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getList()
    {
        $proxies = self::query()
            ->orderByDesc('checked_at')
            ->orderBy('speed')
            ->paginate(20);
        return $proxies;
    }
}