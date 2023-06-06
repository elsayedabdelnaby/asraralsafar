<?php

namespace Modules\Settings\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Settings\Entities\Category;

class ExportCategory implements FromCollection, WithHeadings
{

    public function collection()
    {
        return Category::with('translations', 'type.translations', 'parent.translations')
            ->get()
            ->map(function ($q) {
                return [
                    'id' => $q->id,
                    'name' => $q->translations->first()->name,
                    'category_type' => $q->type->translations->first()->name,
                    'category_parent' => isset($q->parent) ? $q->parent->translations->first()->name : null,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'category type',
            'category parent',
        ];
    }
}
