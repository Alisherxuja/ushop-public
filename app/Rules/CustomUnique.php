<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CustomUnique implements Rule
{
    private string $table;
    private array $columns;

    /**
     * Create a new rule instance.
     *
     * @param string $table
     * @param array $columns
     */
    public function __construct(string $table, array $columns)
    {
        $this->table = $table;
        $this->columns = $columns;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $value = clearPhone($value);
        $query = \DB::table($this->table);
        foreach ($this->columns as $column) {
            $query->orWhere($column, mb_strtolower($value));
        }
        return $query->count() == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute has already been taken.';
    }
}
