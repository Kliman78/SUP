<?php

namespace App\Modules\Contracts\Models;

class Contracts
{
    public $id;
    public $title;
    public $client_id;

    public function __construct($id, $title, $client_id)
    {
        $this->id = $id;
        $this->title = $title;
        $this->client_id = $client_id;
    }

    /**
     * Возвращает пример списка договоров
     */
    public static function all()
    {
        return [
            new self(1, 'Договор №1', 101),
            new self(2, 'Договор №2', 102),
            new self(3, 'Договор №3', 103),
        ];
    }

    /**
     * Возвращает конкретный "договор" по id
     */
    public static function findOrFail($id)
    {
        $contracts = self::all();

        foreach ($contracts as $contract) {
            if ($contract->id == $id) {
                return $contract;
            }
        }

        abort(404, 'Contract not found');
    }
}
