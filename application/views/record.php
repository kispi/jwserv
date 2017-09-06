<div class="wrapper"></div>
<div class="popup ok">
  <span class="glyphicon glyphicon-remove-circle ok"></span>
  <div class="message">
    <div>기록되었습니다</div>
  </div>
  <div class="action">
    <button class="btn btn-success record-continue btn-close">계속기록</button>
    <button class="btn btn-info redirect-check btn-close">현황보기</button>
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
<div class="container-fluid">
  <div class="row content body record">
    <?php if($session['auth'] != 'r'): ?>
      <div class="col-sm-12">
        <form id="record" class="form-horizontal">
          <div class="form-group">
            <div class="col-sm-offset-2">
              <p><span class="required">*</span> 는 필수입력 항목입니다</p>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="area">구역번호 <span class="required">*</span></label>
            <div class="col-sm-10">
              <input required class="form-control" id="area" name="area" value="<?=$latest['area']+1?>" placeholder="구역번호를 입력해주세요">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="visit_start">시작일 <span class="required">*</span></label>
            <div class="col-sm-10">
              <input readonly required class="form-control datepicker" id="visit_start" name="visit_start" placeholder="시작일 (기본값은 '오늘')">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="visit_end">완료일</label>
            <div class="col-sm-8">
              <input readonly class="form-control datepicker" id="visit_end" name="visit_end" placeholder="">
            </div>
            <div id="incomplete" class="col-sm-2">
              <div class="checkbox">
                <label><input id="incomplete-check" type="checkbox" value="">미완료</label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="servant">전도인 <span class="required">*</span></label>
            <div class="col-sm-8">
              <input required class="form-control" id="servant" name="servant" placeholder="전도인 이름">
            </div>
            <div id="sustain" class="col-sm-2">
              <div class="checkbox">
                <label><input id="sustain-check" type="checkbox" value="">이름유지</label>
              </div>
            </div>
          </div>
          <input required type="hidden" class="form-control" id="congregation" name="congregation" value="<?=$congregation_srl?>">
          <input required type="hidden" class="form-control" id="recorder_srl" name="recorder_srl" value="<?=$session['member_srl']?>">
          <div class="form-group">
            <label class="control-label col-sm-2" for="memo">비고</label>
            <div class="col-sm-10">
              <input class="form-control" id="memo" name="memo" placeholder="비고">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary write-record">저장</button>
            </div>
          </div>
        </form>
      </div>
    <?php else: ?>
      <div class="col-sm-12 text-center">
        <p style="width: 100vw; height: 80vh; vertical-align: middle; display: table-cell; font-size: 15pt"><?=$session['name']?>님은 현재 봉사 기록의 열람만 가능합니다.<br>봉사 기록을 작성, 수정하기 원하신다면 다음의 관리자에게 권한을 요청해주세요.<br><br>
          <?php foreach($members as $member): ?>
            <?php if($member['auth'] === 'a'): ?>
              <?=$member['name']?>
            <?php endif ?>
          <?php endforeach ?>
        </p>
      </div>
    <?php endif ?>
  </div>
</div>
<script language="javascript" type="text/javascript" src="<?=asset_url('js/'.$current_class.'.js')?>"></script>
