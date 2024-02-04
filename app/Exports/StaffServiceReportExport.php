<?php

namespace App\Exports;

use App\Models\User;
use Currency;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StaffServiceReportExport implements FromCollection, WithHeadings
{
    public array $columns;

    public array $dateRange;

    public function __construct($columns, $dateRange)
    {
        $this->columns = $columns;
        $this->dateRange = $dateRange;
    }

    public function headings(): array
    {
        $modifiedHeadings = [];

        foreach ($this->columns as $column) {
            // Capitalize each word and replace underscores with spaces
            $modifiedHeadings[] = ucwords(str_replace('_', ' ', $column));
        }

        return $modifiedHeadings;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = User::staffReport();

        $query = $query->get();

        $newQuery = $query->map(function ($row) {

            $selectedData = [];

            foreach ($this->columns as $column) {
                switch ($column) {
                    case 'employee':
                        $selectedData[$column] = $row->full_name ?? '-';
                        break;

                    case 'total_services':
                        $selectedData[$column] = $row->employee_booking_count ?? 0;
                        break;

                    case 'total_service_amount':
                        $selectedData[$column] = Currency::format($row->employee_booking_sum_service_price ?? 0);
                        break;

                    case 'total_commission_earn':
                        $selectedData[$column] = Currency::format($row->commission_earning_sum_commission_amount ?? 0);
                        break;

                    case 'total_tip_earn':
                        $selectedData[$column] = Currency::format($row->tip_earning_sum_tip_amount ?? 0);
                        break;

                    case 'total_earning':
                        $selectedData[$column] = Currency::format($row->employee_booking_sum_service_price + $row->commission_earning_sum_commission_amount + $row->tip_earning_sum_tip_amount);
                        break;

                    default:
                        $selectedData[$column] = $row[$column];
                        break;
                }
            }

            return $selectedData;
        });

        return $newQuery;
    }
}
