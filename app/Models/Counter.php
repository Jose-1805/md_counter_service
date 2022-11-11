<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Counter extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'counters';

    protected $fillable = [
        'amount',
        'date',
        'item_type',
        'item',
        'extra_name',
        'extra_data',
    ];

    /**
     * Aumenta la cantidad del contador
     *
     * @param integer $amount
     * @return void
     */
    public function incrementAmount(int $amount)
    {
        $this->update([
            'amount' => $this->amount + $amount
        ]);
    }

    /**
     * Decrementa la cantidad del contador
     *
     * @param integer $amount
     * @return void
     */
    public function decrementAmount(int $amount)
    {
        $this->update([
            'amount' => $this->amount - $amount
        ]);
    }

    /**
     * Obtiene un contador de acuerdo a los datos enviados en el array
     *
     * @param array $data
     * @return mixed
     */
    public static function byData(array $data = []): mixed
    {
        $columns = ['date', 'item_type', 'item', 'extra_name', 'extra_data'];

        if (array_key_exists('id', $data)) {
            return self::find($data['id']);
        } else {
            $counter = self::select('*');

            foreach ($columns as $value) {
                if (array_key_exists($value, $data)) {
                    $counter = $counter->where($value, $data[$value]);
                } else {
                    $counter = $counter->whereNull($value);
                }
            }

            return $counter->first();
        }
    }
}
