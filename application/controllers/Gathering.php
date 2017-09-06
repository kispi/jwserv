<?php
require_once('JSController.php');
require_once(APPPATH.'third_party/simplehtmldom/simple_html_dom.php');

class Gathering extends JSController {
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
	{
    $style = $this->input->get('style');
    if(($style !== NULL && $style !== 'section' && $style !== 'program') || !$style)
      $style = 'program';

    $lastMonday = strtotime('Monday this week');
    $thisSunday = strtotime('Sunday this week');

    $url = 'https://www.jw.org/ko/publications/%EC%97%AC%ED%98%B8%EC%99%80%EC%9D%98-%EC%A6%9D%EC%9D%B8-%EC%A7%91%ED%9A%8C-%EA%B5%90%EC%9E%AC/';
    $url .= date('Y', $lastMonday).'%EB%85%84-';
    $url .= date('n', $lastMonday).'%EC%9B%94-%EC%A7%91%ED%9A%8C-%EA%B5%90%EC%9E%AC/%EC%A7%91%ED%9A%8C-%EA%B3%84%ED%9A%8D%ED%91%9C-';

    $isSameMonth = (date('Y-n', $lastMonday) === date('Y-n', $thisSunday) ? TRUE : FALSE);
    if($isSameMonth === TRUE)
      $url .= date('n', $lastMonday).'%EC%9B%94-'.date('j', $lastMonday).'-'.date('j', $thisSunday).'%EC%9D%BC/';
    else
      $url .= date('n', $lastMonday).'%EC%9B%94-'.date('j', $lastMonday).'%EC%9D%BC-'.date('n', $thisSunday).'%EC%9B%94-'.date('j', $thisSunday).'%EC%9D%BC/';

    $dom = self::dlPage($url);

    // 가져온 링크 앞에 jw 링크 붙이기
    foreach($dom->find('a') as $element) {
      $href = $element->href;
      $element->href = 'https://www.jw.org'.$href;
    }

    // 금주 연구 범위 구하기
    $study_range_data;
    foreach($dom->find('a.pubSym-kr') as $index => $element) {
      $study_range_data = $element->attr;
      if(isset($study_range_data['data-highlightrange'])) {
        $data['study_range'] = $study_range_data['data-highlightrange'];
        break;
      }
    }
    $data['study_link'] = str_replace(explode('-', $study_range_data['data-highlightrange'])[0], $study_range_data['data-highlightrange'], $study_range_data['href']);

    // 그리스도인 생활과 봉사 집회 교재 가져오기 (섹션)
    foreach($dom->find('div.section') as $index => $element) {
      // 성경에 담긴 보물에서는 세부 내용 제외
      foreach($element->find('ul.noMarker') as $target)
        $target->outertext = '';

      $data['section'][$index-1] = $element;
    }

    // 연구 삽화 가져오기
    $dom = self::dlPage($data['study_link']);
    foreach($dom->find('img[class]') as $index => $element) {
      $element->src = str_replace('xs.jpg', 'xl.jpg', $element->src);
      // 삽화는 'class'와 'alt' 속성을 다 가지고 있는 img들
      if(isset($element->attr['alt']))
        $data['img'][$index] = $element;
    }

    $data['style'] = $style;
    parent::view('gathering', $data);
	}

  function dlPage($href)
  {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_URL, $href);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.125 Safari/533.4");
    $str = curl_exec($curl);
    curl_close($curl);

    // Create a DOM object
    $dom = new simple_html_dom();
    // Load HTML from a string
    $dom->load($str);

    return $dom;
  }
}
