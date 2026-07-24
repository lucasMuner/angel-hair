<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\Carbon;

class UsersExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithColumnWidths,
    WithStyles,
    WithEvents
{

    private const COLOR_NOIR_DEEP = '111111';
    private const COLOR_GOLD      = 'C9952A';
    private const COLOR_GOLD_LIGHT = 'E8AC30';
    private const COLOR_ROW_ALT    = 'F5F0E6';

    public function __construct(protected array $filters = [])
    {
    }

    public function collection()
    {
        $search = $this->filters['search'] ?? null;

        return User::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->get();
    }

    public function headings(): array
    {
        return ['Usuário', 'Nome', 'E-mail', 'Função', 'E-mail Verificado', 'Criado em'];
    }

    public function map($user): array
    {
        return [
            $user->username,
            $user->name,
            $user->email,
            $user->role?->name ?? '-',
            $user->email_verified_at ? Carbon::parse($user->email_verified_at)->format('d/m/Y H:i') : '-',
            Carbon::parse($user->created_at)->format('d/m/Y H:i'),
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 18, // Usuário
            'B' => 28, // Nome
            'C' => 32, // E-mail
            'D' => 22, // Função
            'E' => 20, // E-mail Verificado
            'F' => 20, // Criado em
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        // Estilo do cabeçalho — fundo dourado, texto escuro, negrito
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => [
                'bold'  => true,
                'color' => ['rgb' => self::COLOR_NOIR_DEEP],
                'size'  => 11,
            ],
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['rgb' => self::COLOR_GOLD],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'bottom' => [
                    'borderStyle' => Border::BORDER_MEDIUM,
                    'color'       => ['rgb' => self::COLOR_GOLD_LIGHT],
                ],
            ],
        ]);

        $sheet->getRowDimension(1)->setRowHeight(24);

        return [];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastRow = $sheet->getHighestRow();
                $lastCol = $sheet->getHighestColumn();

                // Zebra striping nas linhas de dados
                for ($row = 2; $row <= $lastRow; $row++) {
                    if ($row % 2 === 0) {
                        $sheet->getStyle("A{$row}:{$lastCol}{$row}")->applyFromArray([
                            'fill' => [
                                'fillType'   => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => self::COLOR_ROW_ALT],
                            ],
                        ]);
                    }
                }

                // Bordas finas em toda a área de dados
                $sheet->getStyle("A1:{$lastCol}{$lastRow}")->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color'       => ['rgb' => 'DDDDDD'],
                        ],
                    ],
                ]);

                // Congela o cabeçalho ao rolar
                $sheet->freezePane('A2');

                // Autofiltro na linha de cabeçalho
                $sheet->setAutoFilter("A1:{$lastCol}1");

                // Alinhamento vertical central pro corpo
                $sheet->getStyle("A2:{$lastCol}{$lastRow}")
                    ->getAlignment()
                    ->setVertical(Alignment::VERTICAL_CENTER);
            },
        ];
    }
}
