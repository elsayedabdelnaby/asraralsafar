<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Translation\PotentiallyTranslatedString;

class IsCompositeUnique implements InvokableRule
{
    private string $tableName;
    private array $compositeColsKeyValue = [];
    private mixed $rowId;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(string $tableName, array $compositeColsKeyValue, $rowId = null)
    {
        $this->tableName = $tableName;
        $this->compositeColsKeyValue = $compositeColsKeyValue;
        $this->rowId = $rowId;
    }

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param \Closure(string): PotentiallyTranslatedString $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail): void
    {
        $passes = true;

        if ($this->rowId) {
            $record = DB::table($this->tableName)->where($this->compositeColsKeyValue)->first();
            $passes = !$record || ($record->id == $this->rowId);
        } else {
            $passes = !DB::table($this->tableName)->where($this->compositeColsKeyValue)->exists();
        }

        if (!$passes) {
            $fail($this->duplicatesErrorMessage());
        }
    }

    private function duplicatesErrorMessage(): string
    {
        $colNames = '';
        foreach ($this->compositeColsKeyValue as $col => $value) {
            $colNames .= $col . ', ';
        }
        $colNames = rtrim($colNames, ', ');

        return "The combination of $colNames must be unique.";
    }
}
