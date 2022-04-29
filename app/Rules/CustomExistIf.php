<?php


namespace App\Rules;


use Illuminate\Contracts\Validation\Rule;

class CustomExistIf implements Rule
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



    public function passes($attribute, $value)
    {
        $value = clearPhone($value);
        $query = \DB::table($this->table);
        foreach ($this->columns as $column) {
            $query->orWhere($column, mb_strtolower($value));
        }
        return $query->exists();
    }

    public function message()
    {
        return 'The :attribute not exists';
    }
}
