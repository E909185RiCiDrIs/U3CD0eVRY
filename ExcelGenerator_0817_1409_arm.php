<?php
// 代码生成时间: 2025-08-17 14:09:35
// Make sure to include the PHPExcel library
require_once 'PHPExcel.php';

class ExcelGenerator 
{
    
    /**
     * @var PHPExcel The Excel object.
     */
    private $objPHPExcel;
    
    /**
     * Constructor that initializes the PHPExcel object.
     */
    public function __construct() 
    {
        $this->objPHPExcel = new PHPExcel();
    }
    
    /**
     * Set the title of the Excel file.
     * 
     * @param string $title The title of the Excel file.
     * @return void
     */
    public function setTitle($title) 
    {
        $this->objPHPExcel->getProperties()->setCreator("Your Name")->setTitle($title);
    }
    
    /**
     * Add a row to the Excel file.
     * 
     * @param array $rowData The data for the row.
     * @return void
     */
    public function addRow($rowData) 
    {
        try {
            $row = $this->objPHPExcel->getActiveSheet()->toArray(null, true, true, true) + [0 => null];
            $this->objPHPExcel->getActiveSheet()->fromArray($rowData, null, 'A' . $row[0]);
        } catch (Exception $e) {
            // Handle any errors that occur when adding a row
            throw new Exception("Error adding row: " . $e->getMessage());
        }
    }
    
    /**
     * Write data to the Excel file.
     * 
     * @param string $filePath The path where the Excel file will be saved.
     * @return void
     */
    public function writeExcel($filePath) 
    {
        try {
            $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');
            $objWriter->save($filePath);
        } catch (Exception $e) {
            // Handle any errors that occur when writing to the Excel file
            throw new Exception("Error writing to Excel: " . $e->getMessage());
        }
    }
}

// Usage example
try {
    $excelGenerator = new ExcelGenerator();
    $excelGenerator->setTitle("Sample Excel File");
    $excelGenerator->addRow(["Name", "Age", "City"]);
    $excelGenerator->addRow(["John Doe", 30, "New York"]);
    $excelGenerator->writeExcel("sample.xlsx");
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
