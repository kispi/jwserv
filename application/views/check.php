<div class="wrapper"></div>
<div class="popup help">
  <span class="glyphicon glyphicon-remove-circle help"></span>
  <div class="card record-0">
    <div class="row">
      <div class="menu col-xs-12 table-cell">
        <span class="record-0 glyphicon card-button glyphicon-trash"></span>
        <span class="record-0 glyphicon card-button glyphicon-pencil"></span>
      </div>
    </div>
    <div class="row">
      <div class="area col-xs-6 table-cell"><input readonly type="text" class="input-card" value="구역 번호"></input></div>
      <div class="servant col-xs-6 table-cell"><input readonly type="text" class="input-card" value="전도인 이름"></input></div>
    </div>
    <div class="row">
      <div class="visit-start col-xs-6 table-cell datepicker"><input readonly type="text" class="input-card" value="받은 날짜"></input></div>
      <div class="visit-end col-xs-6 table-cell datepicker"><input readonly type="text" class="input-card" value="반환 날짜"></input></div>
    </div>
    <div class="row">
      <div class="memo col-xs-12 table-cell"><input readonly type="text" class="input-card" value="비고"></input></div>
    </div>
  </div>
  <div class="message">
    <div><span class="glyphicon glyphicon-pencil"></span>를 누르면 내용을 수정할 수 있으며, <span class="glyphicon glyphicon-floppy-disk"></span> 모양으로 변경됩니다.
    <span class="glyphicon glyphicon-floppy-disk"></span>를 클릭하면 수정이 반영됩니다.</div>
    <div><span class="glyphicon glyphicon-trash"></span>를 누르면 항목을 삭제할 수 있습니다.</div>
    <div>하단의 페이지네이션은 좌우로 스크롤할 수 있습니다.</div>
  </div>
</div>
<div class="popup day">
  <span class="glyphicon glyphicon-remove-circle day"></span>
  <div class="message" style="text-align: center">
    <button class="btn btn-<?=($filter_day == 'monday' ? 'primary' : 'default')?> day monday">월</button>
    <button class="btn btn-<?=($filter_day == 'tuesday' ? 'primary' : 'default')?> day tuesday">화</button>
    <button class="btn btn-<?=($filter_day == 'wednesday' ? 'primary' : 'default')?> day wednesday">수</button>
    <button class="btn btn-<?=($filter_day == 'thursday' ? 'primary' : 'default')?> day thursday">목</button>
    <button class="btn btn-<?=($filter_day == 'friday' ? 'primary' : 'default')?> day friday">금</button>
    <button class="btn btn-<?=($filter_day == 'saturday' ? 'primary' : 'default')?> day saturday">토</button>
    <button class="btn btn-<?=($filter_day == 'sunday' ? 'primary' : 'default')?> day sunday">일</button><br>
    <button class="btn btn-<?=($filter_day == 'all' ? 'primary' : 'default')?> day all">전체</button>
  </div>
  <div class="action">
    <button class="btn btn-success btn-close">닫기</button>
  </div>
</div>
<div class="popup duplicate">
  <span class="glyphicon glyphicon-remove-circle duplicate"></span>
  <div class="message">
    <div>동일 날짜에 중복된 구역번호가 있습니다</div>
  </div>
  <div class="action">
    <button class="btn btn-warning record-continue btn-close">확인</button>
  </div>
</div>
<div class="popup update ok">
  <span class="glyphicon glyphicon-remove-circle update ok"></span>
  <div class="message">
    <div>수정되었습니다</div>
  </div>
  <div class="action">
    <button class="btn btn-success btn-close">닫기</button>
  </div>
</div>
<div class="popup delete ok">
  <span class="glyphicon glyphicon-remove-circle delete ok"></span>
  <div class="message">
    <div>삭제되었습니다</div>
  </div>
  <div class="action">
    <button class="btn btn-success btn-close">닫기</button>
  </div>
</div>
<div class="popup delete confirm">
  <span class="glyphicon glyphicon-remove-circle delete confirm"></span>
  <div class="message">
    <div>정말로 삭제하시겠습니까?</div>
  </div>
  <div class="action">
    <button class="btn btn-success yes btn-close">예</button>
    <button class="btn btn-info no btn-close">아니오</button>
  </div>
</div>
<div class="popup extract set">
  <span class="glyphicon glyphicon-remove-circle extract set"></span>
  <form action='check/extract' method='post'>
    <div class="message">
      <div style="text-align: justify; font-size: 11pt">- 범위를 지정하신 후, 추출을 누르시면 S-13 양식의 스프레드시트 파일을 작성합니다. 작성에는 수 초가 소요될 수 있으며, 완료되면 다운로드가 시작되니 잠시만 기다려주십시오.<br>
          - 컨텐츠 크기가 페이지에 맞지 않아 페이지가 넘어갈 때마다 조금씩 밀리거나 당겨진다면, 인쇄 옵션에서 적절히 상하 여백을 조절하신 후 인쇄하십시오.<br>
          - 마이크로소프트 엑셀로 열람하는 경우는 기본 여백설정에서 별도의 변경 없이 인쇄가 가능합니다.</div>
      <div><input readonly required type="text" class="datepicker range-from" name="from" value="<?=$oldest_record?>"></input>부터</div>
      <div><input readonly required type="text" class="datepicker range-to" name="to" value="<?=$latest_record?>"></input>까지</div>
    </div>
    <div class="action">
      <button type="submit" class="btn btn-info btn-close">추출</button>
    </div>
  </form>
</div>
<div class="container-fluid">
  <div class="row content body check text-center">
    <?php if(empty($records)): ?>
      <div class="col-sm-12 text-center">
        <p style="width: 100vw; height: 80vh; vertical-align: middle; display: table-cell; font-size: 20pt">메뉴에서 <label class="record"><span class="glyphicon glyphicon-pencil"></span> 기록하기</label>를 눌러 첫 기록을 작성해보세요!</p>
      </div>
    <?php else: ?>
      <div class="col-sm-12 text-center">
        <button class="btn btn-primary help">도움말</button>
        <button class="btn btn-success filter-day">요일</button>
        <button class="btn btn-info extract">추출</button><br>
      </div>
      <div class="col-sm-12 text-center">
        <?php foreach($records as $record):?>
          <div class="card record-<?=$record['record_srl']?>">
              <div class="row">
                <?php if($session['auth'] != 'r'): ?>
                  <div class="menu col-xs-12 table-cell">
                    <span class="record-<?=$record['record_srl']?> glyphicon card-button glyphicon-trash"></span>
                    <span class="record-<?=$record['record_srl']?> glyphicon card-button glyphicon-pencil"></span>
                  </div>
                <?php endif ?>
              </div>
            <div class="row">
              <div class="area col-xs-6 table-cell"><input readonly type="text" class="input-card" value="<?=$record['area']?>"></input></div>
              <div class="servant col-xs-6 table-cell"><input readonly type="text" class="input-card" value="<?=$record['servant']?>"></input></div>
            </div>
            <div class="row">
              <div class="visit-start col-xs-6 table-cell"><input readonly onkeydown="return false" type="text" class="input-card datepicker" value="<?=$record['visit_start']?> (<?=getDayOfTheWeek($record['visit_start'])?>)"></input></div>
              <?php if($record['visit_end'] === '0000-00-00'): ?>
                <div class="visit-end col-xs-6 table-cell"><input readonly onkeydown="return false" type="text" class="input-card datepicker" value=""></input></div>
              <?php else: ?>
                <div class="visit-end col-xs-6 table-cell"><input readonly onkeydown="return false" type="text" class="input-card datepicker" value="<?=$record['visit_end']?> (<?=getDayOfTheWeek($record['visit_end'])?>)"></input></div>
              <?php endif ?>
            </div>
            <div class="row">
              <div class="memo col-xs-12 table-cell"><input readonly type="text" class="input-card" value="<?=$record['memo']?>"</input></div>
            </div>
          </div>
        <?php endforeach ?>
      </div>
      <ul class="pagination">
        <?php for($index = 1; $index <= $num_of_pages; $index++): ?>
          <li <?=((int)$current_page === $index ? 'class="active"' : '')?>><a href="?page=<?=($index)?>"><?=$index?></a></li>
        <?php endfor ?>
      </ul>
    <?php endif ?>
  </div>
</div>

<script language="javascript" type="text/javascript" src="<?=asset_url('js/'.$current_class.'.js')?>"></script>
