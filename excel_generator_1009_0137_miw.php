<?php
// 代码生成时间: 2025-10-09 01:37:23
// Excel Generator class using Yii Framework and PHPExcel library
class ExcelGenerator extends CComponent {

    // The PHPExcel object
    private $objPHPExcel;

    // Constructor
    public function __construct() {
        // Load the PHPExcel library
        $this->objPHPExcel = new PHPExcel();
    }

    // Function to add header
    public function addHeader($headers) {
        // Add header to the first row
        $row = 1;
        foreach ($headers as $header) {
            $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($row, 1, $header);
            $row++;
        }
    }

    // Function to add data
    public function addData($data) {
        // Add data starting from the second row
        $row = 2;
        foreach ($data as $rowData) {
            $column = 1;
            foreach ($rowData as $cellData) {
                $this->objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($column, $row, $cellData);
                $column++;
            }
            $row++;
        }
    }

    // Function to set active sheet index
    public function setActiveSheetIndex($index) {
        $this->objPHPExcel->setActiveSheetIndex($index);
    }

    // Function to set sheet title
    public function setSheetTitle($title) {
        $this->objPHPExcel->getActiveSheet()->setTitle($title);
    }

    // Function to save the Excel file
    public function save($filename) {
        try {
            $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');
            $objWriter->save($filename);
        } catch (Exception $e) {
            Yii::log('Error saving Excel file: ' . $e->getMessage(), CLogger::LEVEL_ERROR);
            throw new CException('Error saving Excel file: ' . $e->getMessage());
        }
    }
}

// Usage example
try {
    $excelGenerator = new ExcelGenerator();
    $excelGenerator->setActiveSheetIndex(0);
    $excelGenerator->setSheetTitle('Sample Sheet');
    $excelGenerator->addHeader(['ID', 'Name', 'Email']);
    $excelGenerator->addData([
        [1, 'John Doe', 'john@example.com'],
        [2, 'Jane Doe', 'jane@example.com'],
    ]);
    $excelGenerator->save('sample.xlsx');
} catch (CException $e) {
    Yii::log($e->getMessage(), CLogger::LEVEL_ERROR);
}
