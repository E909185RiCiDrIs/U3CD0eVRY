<?php
// 代码生成时间: 2025-08-29 19:54:25
class ExcelGenerator {

    /**
     * @var PhpSpreadsheet\Spreadsheet The Excel workbook object
     */
    private $spreadsheet;

    /**
     * @var PhpSpreadsheet\Writer\Xlsx The Excel writer object
     */
    private $writer;

    /**
     * Constructor for the ExcelGenerator class.
     */
    public function __construct() {
        // Initialize the Excel workbook and writer objects.
        $this->spreadsheet = new PhpSpreadsheet\Spreadsheet();
        $this->writer = PhpSpreadsheet\IOFactory::createWriter($this->spreadsheet, 'Xlsx');
    }

    /**
     * Adds a new worksheet to the Excel workbook.
     *
     * @param string $title The title of the worksheet.
     * @return PhpSpreadsheet\Worksheet The worksheet object.
     */
    public function addWorksheet($title) {
        $worksheet = $this->spreadsheet->createSheet();
        $worksheet->setTitle($title);
        return $worksheet;
    }

    /**
     * Sets the value of a cell in the worksheet.
     *
     * @param string $worksheetName The name of the worksheet.
     * @param string $cellCoordinates The coordinates of the cell (e.g., 'A1').
     * @param mixed $value The value to set in the cell.
     */
    public function setCellValue($worksheetName, $cellCoordinates, $value) {
        $worksheet = $this->spreadsheet->getSheetByName($worksheetName);
        $worksheet->getCell($cellCoordinates)->setValue($value);
    }

    /**
     * Saves the Excel workbook to a file.
     *
     * @param string $filePath The path where the file will be saved.
     */
    public function save($filePath) {
        try {
            $this->writer->save($filePath);
        } catch (PhpSpreadsheet\Writer\Exception $e) {
            // Handle any exceptions that occur during the save process.
            echo 'Error writing Excel file: ' . $e->getMessage();
        }
    }
}

// Usage example:
// $excelGenerator = new ExcelGenerator();
// $worksheet = $excelGenerator->addWorksheet('Sample Sheet');
// $excelGenerator->setCellValue('Sample Sheet', 'A1', 'Hello');
// $excelGenerator->setCellValue('Sample Sheet', 'B2', 'World');
// $excelGenerator->save('path/to/your/excel/file.xlsx');
