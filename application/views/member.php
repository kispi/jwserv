<div class="wrapper"></div>
<div class="popup ok">
  <span class="glyphicon glyphicon-remove-circle update ok"></span>
  <div class="message">
    <div>수정되었습니다</div>
  </div>
  <div class="action">
    <button class="btn btn-success btn-close">닫기</button>
  </div>
</div>
<div class="popup password-with-spaces">
  <span class="glyphicon glyphicon-remove-circle password-with-spaces"></span>
  <div class="message">
    <div>비밀번호에는 공백이 포함될 수 없습니다</div>
  </div>
  <div class="action">
    <button class="btn btn-warning btn-close">닫기</button>
  </div>
</div>
<div class="popup duplicated-email">
  <span class="glyphicon glyphicon-remove-circle duplicated-email"></span>
  <div class="message">
    <div>이미 해당 이메일로 가입한 아이디가 있습니다</div>
  </div>
  <div class="action">
    <button class="btn btn-warning btn-close">닫기</button>
  </div>
</div>
<div class="container-fluid">
  <div class="row content body member text-center">
    <div class="col-sm-12 text-left">
      <form id="member" class="form-horizontal">
        <input type="hidden" class="form-control" id="member_srl" name="member_srl" value="<?=$session['member_srl']?>">
        <div class="form-group">
          <label class="control-label col-sm-2" for="password">새 비밀번호 <span class="required">*</span></label>
          <div class="col-sm-10">
            <input required type="password" class="form-control" id="password" name="password" placeholder="새 비밀번호를 입력해주세요">
          </div>
        </div>
        <?php if($session['auth'] != 'a'): ?>
          <div class="form-group">
            <label class="control-label col-sm-2" for="congregation">회중 <span class="required">*</span></label>
            <div class="col-sm-10">
              <select id="congregation" name="congregation">
                <?php foreach($congregations as $congregation): ?>
                  <option <?=($session['congregation_srl'] === $congregation['congregation_srl'] ? 'selected' : '')?> value="<?=$congregation['congregation_srl']?>"><?=$congregation['name']?></option>
                <?php endforeach?>
              </select>
            </div>
          </div>
        <?php endif ?>
        <div class="form-group">
          <label class="control-label col-sm-2" for="name">이메일 <span class="required">*</span></label>
          <div class="col-sm-10">
            <input required type="email" class="form-control" id="email" name="email" placeholder="이메일을 입력해주세요 (비밀번호 분실시 사용됩니다)" value=<?=$session['email']?>>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="phone">연락처</label>
          <div class="col-sm-10">
            <input type="phone" class="form-control" id="phone" name="phone" placeholder="연락처를 입력해주세요 (선택사항)" value=<?=$session['phone']?>>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">저장</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script language="javascript" type="text/javascript" src="<?=asset_url('js/'.$current_class.'.js')?>"></script>
