<?php

declare(strict_types=1);

namespace App\Services;

use App\Enum\TableNames;
use Box\Spout\Common\Exception\InvalidArgumentException;
use Box\Spout\Common\Exception\IOException;
use Box\Spout\Writer\CSV\Writer as CSVWriter;
use Box\Spout\Writer\Exception\WriterNotOpenedException;
use Box\Spout\Writer\XLSX\Writer as XLSXWriter;
use Illuminate\Database\Eloquent\Collection;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;

class FileExportService
{
    private const BATCH_SIZE = 500;

    private const TABLE_HEADERS_INDEXED_BY_TABLE_NAME = [
        TableNames::TABLE_ADMIN_LOG => [
            'id', 'user_id', 'type', 'table', 'reg_id', 'reg_name', 'detail', 'detail_before', 'created_at', 'updated_at', 'user_name'
        ],
    ];

    public const EXTENSION_TYPE_CSV = 'csv';

    public const EXTENSION_TYPE_XLS = 'xls';

    public const EXTENSION_TYPE_XLSX = 'xlsx';

    public function exportByTable(string $tableName, Collection $data, string $type, ?string $fileName): string
    {
        $headers = self::TABLE_HEADERS_INDEXED_BY_TABLE_NAME[$tableName] ?? null;

        if ($headers === null) {
            throw new \InvalidArgumentException();
        }

        $filePath = \tempnam(sys_get_temp_dir(), 'export_');

        if ($filePath === false) {
            throw new \RuntimeException();
        }

        try {
            $this->export($headers, $data->toArray(), $filePath, $type);
        } catch (\Throwable $exception) {
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            throw new \RuntimeException();
        }

        return $filePath;
    }

    /**
     * @param string[] $headers
     */
    public function export(array $headers, array $data, string $filePath, string $type): void
    {
        try {
            $writer = $this->createWriter($type);
            $writer->openToFile($filePath);
            $this->writeData($writer, $headers, $data);
            $writer->close();
        } catch (\Throwable $exception) {
            throw new \RuntimeException();
        }
    }

    private function createWriter(string $extension): CSVWriter|XLSXWriter
    {
        return match (strtolower($extension)) {
            self::EXTENSION_TYPE_CSV => WriterEntityFactory::createCSVWriter(),
            self::EXTENSION_TYPE_XLS, self::EXTENSION_TYPE_XLSX => WriterEntityFactory::createXLSXWriter(),
            default => throw new \InvalidArgumentException("Unsupported file extension: {$extension}"),
        };
    }

    /**
     * @throws WriterNotOpenedException
     * @throws IOException
     * @throws InvalidArgumentException
     */
    private function writeData(CSVWriter|XLSXWriter $writer, array $headers, array $data): void
    {
        $headersRow = WriterEntityFactory::createRowFromArray($headers);
        $writer->addRow($headersRow);

        foreach (\array_chunk($data, self::BATCH_SIZE) as $chunkData) {
            $rows = [];

            foreach ($chunkData as $datum) {
                $row = WriterEntityFactory::createRowFromArray($datum);
                $rows[] = $row;
            }

            $writer->addRows($rows);
        }
    }
}
