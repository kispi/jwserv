<?php
require_once('JSController.php');
require_once(APPPATH.'third_party/PHPExcel/Classes/PHPExcel.php');

class Check extends JSController {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('record_model');
  }

  public function extract()
  {
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=area.xls");

    $session = $this->session->userdata('logged_in');
    $data = $this->record_model->getRecords($session['congregation_srl'], NULL, NULL, $this->input->post('from'), $this->input->post('to'));

    $area_number_max = 1;
    $result = NULL;
    foreach($data as $record)
    {
      if((int)$record['area'] > $area_number_max)
        $area_number_max = (int)$record['area'];

      $result[$record['area']][] = [
        'servant' => $record['servant'],
        'visit_start' => $record['visit_start'],
        'visit_end' => $record['visit_end'],
      ];
    }
    // 구역 기록 카드상에서는 과거->현재순으로 출력
    for($index = 1; $index <= $area_number_max; $index++) {
      if(isset($result[$index]))
        $result[$index] = array_reverse($result[$index]);
    }

    self::createXML($result, $area_number_max);
  }

  private function createXML($data, $area_number_max)
  {
    // 페이지당 구역 5개이므로, 회중의 구역 개수 / 5 만큼의 페이지 필요
    $rows_per_page = 52; // 페이지당 행 개수는 52개(공백 한줄)
    $number_of_pages = ceil($area_number_max / 5);

    $oPHPExcel = new PHPExcel();
    $oPHPExcel->setActiveSheetIndex(0);
    $oPHPExcel->getActiveSheet()->setTitle("구역 임명 기록");
    $oPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader("&L&B구역 임명 기록");
    $oPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
    $oPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
    $oPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.75);
    $oPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.24);
    $oPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.24);
    $oPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.4);
    $oPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
    $oPHPExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(true);
    $oPHPExcel->getActiveSheet()->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    for($page = 0; $page < $number_of_pages; $page++) {
      $current_row = $rows_per_page*$page+1;
      // 페이지 상단에 구역 번호를 기록
      $oPHPExcel->getActiveSheet()
      ->mergeCells('A'.$current_row.':B'.$current_row)
      ->mergeCells('C'.$current_row.':D'.$current_row)
      ->mergeCells('E'.$current_row.':F'.$current_row)
      ->mergeCells('G'.$current_row.':H'.$current_row)
      ->mergeCells('I'.$current_row.':J'.$current_row);
      $oPHPExcel->getActiveSheet()
      ->setCellValue('A'.$current_row, $page * 5 + 1)
      ->setCellValue('C'.$current_row, $page * 5 + 2)
      ->setCellValue('E'.$current_row, $page * 5 + 3)
      ->setCellValue('G'.$current_row, $page * 5 + 4)
      ->setCellValue('I'.$current_row, $page * 5 + 5);

      $oPHPExcel->getActiveSheet()->getStyle('A'.($current_row + 1).':J'.($current_row + 50))
      ->applyFromArray([
        'borders' => [
          'allborders' => [
            'style' => PHPExcel_Style_Border::BORDER_THIN
          ]
        ]
      ]);
      for($i = 1; $i <= $rows_per_page; $i = $i + 2) {
        $oPHPExcel->getActiveSheet()
        ->mergeCells('A'.($current_row + $i).':B'.($current_row + $i))
        ->mergeCells('C'.($current_row + $i).':D'.($current_row + $i))
        ->mergeCells('E'.($current_row + $i).':F'.($current_row + $i))
        ->mergeCells('G'.($current_row + $i).':H'.($current_row + $i))
        ->mergeCells('I'.($current_row + $i).':J'.($current_row + $i));

        if($i < $rows_per_page - 1) {
          $oPHPExcel->getActiveSheet()->getStyle('A'.($current_row + $i).':B'.($current_row + $i + 1))
          ->applyFromArray(['borders' => ['outline' => ['style' => PHPExcel_Style_Border::BORDER_MEDIUM]]]);
          $oPHPExcel->getActiveSheet()->getStyle('C'.($current_row + $i).':D'.($current_row + $i + 1))
          ->applyFromArray(['borders' => ['outline' => ['style' => PHPExcel_Style_Border::BORDER_MEDIUM]]]);
          $oPHPExcel->getActiveSheet()->getStyle('E'.($current_row + $i).':F'.($current_row + $i + 1))
          ->applyFromArray(['borders' => ['outline' => ['style' => PHPExcel_Style_Border::BORDER_MEDIUM]]]);
          $oPHPExcel->getActiveSheet()->getStyle('G'.($current_row + $i).':H'.($current_row + $i + 1))
          ->applyFromArray(['borders' => ['outline' => ['style' => PHPExcel_Style_Border::BORDER_MEDIUM]]]);
          $oPHPExcel->getActiveSheet()->getStyle('I'.($current_row + $i).':J'.($current_row + $i + 1))
          ->applyFromArray(['borders' => ['outline' => ['style' => PHPExcel_Style_Border::BORDER_MEDIUM]]]);
        }
      }
    }

    for($index = 1; $index <= $area_number_max; $index++) {
      if(isset($data[$index])) {
        foreach($data[$index] as $record_index => $record) {
          $page = floor(($index - 1) / 5);
          $row_position = $page * $rows_per_page + $record_index * 2 + 2;

          $visit_end = '';
          if($record['visit_end'] !== '0000-00-00')
            $visit_end = substr($record['visit_end'], 2);

          if($index % 5 === 1) {
            $oPHPExcel->getActiveSheet()
            ->setCellValue('A'.($row_position), $record['servant'])
            ->setCellValue('A'.($row_position+1), substr($record['visit_start'], 2))
            ->setCellValue('B'.($row_position+1), $visit_end);
          } elseif($index % 5 === 2) {
            $oPHPExcel->getActiveSheet()
            ->setCellValue('C'.($row_position), $record['servant'])
            ->setCellValue('C'.($row_position+1), substr($record['visit_start'], 2))
            ->setCellValue('D'.($row_position+1), $visit_end);
          } elseif($index % 5 === 3) {
            $oPHPExcel->getActiveSheet()
            ->setCellValue('E'.($row_position), $record['servant'])
            ->setCellValue('E'.($row_position+1), substr($record['visit_start'], 2))
            ->setCellValue('F'.($row_position+1), $visit_end);
          } elseif($index % 5 === 4) {
            $oPHPExcel->getActiveSheet()
            ->setCellValue('G'.($row_position), $record['servant'])
            ->setCellValue('G'.($row_position+1), substr($record['visit_start'], 2))
            ->setCellValue('H'.($row_position+1), $visit_end);
          } elseif($index % 5 === 0) {
            $oPHPExcel->getActiveSheet()
            ->setCellValue('I'.($row_position), $record['servant'])
            ->setCellValue('I'.($row_position+1), substr($record['visit_start'], 2))
            ->setCellValue('J'.($row_position+1), $visit_end);
          }
        }
      }
    }
    $oWriter = PHPExcel_IOFactory::createWriter($oPHPExcel, 'Excel5');
    $oWriter->save('php://output');
  }

  public function updateRecord()
  {
    $updated_row = $this->record_model->updateRecord($this->input->post());
    echo json_encode($updated_row);
  }

  public function deleteRecord()
  {
    $affected_rows = $this->record_model->deleteRecord($this->input->post());
    if($affected_rows > 0)
    {
      $result['msg'] = 'SUCCESS';
      $result['deleted_rows'] = $affected_rows;
    } else {
      $result['msg'] = 'NO_CHANGE';
      $result['deleted_rows'] = $affected_rows;
    }
    echo json_encode($result);
  }

  public function filterDay()
  {
    $day = $this->input->post('day');
    $session = $this->session->userdata('logged_in');
    $session['filter_day'] = $day;
    $this->session->set_userdata('logged_in', $session);
    echo json_encode([$day]);
  }


  public function index()
	{
    $session = $this->session->userdata('logged_in');
    if($session === NULL)
      header('location: signin');

    $record_per_page = 20;
    $data['num_of_pages'] = ceil($this->record_model->getNumOfRecords($session['congregation_srl'], ($session['filter_day'] != 'all'? $session['filter_day'] : NULL)) / $record_per_page);

    $page = $this->input->get('page');
    if(!is_numeric($page))
      $page = 1;
    elseif($page > $data['num_of_pages'])
      $page = $data['num_of_pages'];
    elseif($page < 1)
      $page = 1;

    $data['latest_record'] = $this->record_model->getTerminalRecord($session['congregation_srl'], 'desc')['visit_start'];
    $data['oldest_record'] = $this->record_model->getTerminalRecord($session['congregation_srl'], 'asc')['visit_start'];
    $data['current_page'] = $page;
    $data['filter_day'] = $session['filter_day'];
    $data['records'] = $this->record_model->getRecords($session['congregation_srl'], $record_per_page, $page - 1, NULL, NULL, ($session['filter_day'] != 'all' ? $session['filter_day'] : NULL));
    parent::view('check', $data);
	}
}
