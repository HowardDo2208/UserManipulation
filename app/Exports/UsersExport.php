<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class UsersExport implements FromCollection,Responsable, WithHeadings, ShouldAutoSize, WithColumnFormatting, WithStyles, WithMapping
{
    use Exportable;

    private $fileName = "userlist.xlsx";
    private $writerType = Excel::XLSX;
    private $headers = [
        'Content-Type' => 'test/csv',
    ];

    protected $usersCollection;
    /**
     * UsersExport constructor.
     */
    public function __construct($usersCollection)
    {
        $this->usersCollection = $usersCollection;
    }


    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return $this->usersCollection;
    }


    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
            'id',
            'name',
            'email',
            'email_verified_at',
            'geoTownId',
            'geoTownShipId',
            'geoDistrictId',
            'geoRegionId',
            'created_at',
            'updated_at',
        ];
    }

    /**
     * @var User $user
     */
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->email_verified_at == null ? $user->email_verified_at : Date::dateTimeToExcel($user->email_verified_at),
            $user->geoTownId,
            $user->geoTownShipId,
            $user->geoDistrictId,
            $user->geoRegionId,
            $user->created_at == null ? $user->created_at : Date::dateTimeToExcel($user->created_at),
            $user->updated_at == null ? $user->updated_at : Date::dateTimeToExcel($user->updated_at),

        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DATETIME,
            'I' => NumberFormat::FORMAT_DATE_DATETIME,
            'J' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
