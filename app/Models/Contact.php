<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Contact
 *
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $position
 * @property int $account_id
 */
class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'position',
        'account_id',
    ];


    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
}
