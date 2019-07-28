<?php 
namespace Tools;
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Excel{
    
    public $workBook = 'hey from excel class';
    
    public function readSheetName($file = null,$type = 'Xls'){
        if($file == null){
            show_error("Can't Read Excel File",500);
        }
        $reader = IOFactory::createReader($type);
        /**  Load $inputFileName to a Spreadsheet Object  **/
        $reader->setLoadAllSheets();
        
        $spreadsheet = $reader->load($file);
        $getSheetName = $spreadsheet->getSheetNames();
        return $getSheetName;
    }
    public function readSpecificSheet($sheetName,$type){
        // if($file == null){
        //     show_error("Can't Read Excel File",500);
        // }
        $file = '/Users/random/Desktop/Playground/Simprakerin/uploads/Data_PKL_MO13.xlsx';
        $reader = IOFactory::createReader($type);
        /**  Load $inputFileName to a Spreadsheet Object  **/
        $reader->setLoadSheetsOnly($sheetName);
        
        $spreadsheet = $reader->load($file);
        return $spreadsheet;
    }
    public function read($file = null,$type ='Xlsx'){
        if($file == null){
            return show_error("Can't Read File Excel",500);
        }
        $reader = IOFactory::createReader($type);
        /**  Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = $reader->load($file);
        return $spreadsheet;
    }
    public function write(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        
        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
    }
}
?>