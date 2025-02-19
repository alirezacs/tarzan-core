<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActiveCode extends Model
{
    use HasUlids;

    protected $table = 'active_codes';

    protected $fillable = [
        'code',
        'user_id',
        'expired_at'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $query
     * @param User $user
     * @return int|void
     */
    public function scopeGenerateCode($query, User $user)
    {

        /* Check User Already Have A Code */
        if($code = $this->getUserCodes($user)){
            $code = $code->code;
        }else{

            /* Make Unique Code */
            do{
                $code = mt_rand(100000, 999999);
            }while($this->checkCodeIsUnique($user , $code));
            /* Make Unique Code */

            /* Store Code */
            $user->activeCodes()->create([
                'code' => $code,
                'expired_at' => now()->addMinutes(10)
            ]);
            /* Store Code */
        }
        /* Check User Already Have A Code */

        return $code;

    }

    private function getUserCodes(User $user)
    {
        return $user->activeCodes()->where('expired_at', '>', now())->first();
    }

    /**
     * @param User $user
     * @param int $code
     * @return bool
     */
    private function checkCodeIsUnique(User $user, int $code): bool
    {
        return !! $user->activeCodes()->whereCode($code)->first();
    }

    /**
     * @param $query
     * @param User $user
     * @param int $code
     * @return bool
     */
    public function scopeVerifyCode($query, User $user, int $code): bool
    {
        return !! $user->activeCodes()->where('expired_at', '>', now())->whereCode($code)->first();
    }

}
