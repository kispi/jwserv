<div class="wrapper"></div>
<div class="popup signup ok">
  <span class="glyphicon glyphicon-remove-circle ok"></span>
  <div class="message">
    <div>계정이 생성되었습니다</div>
  </div>
  <div class="action">
    <button class="btn btn-success btn-close">닫기</button>
  </div>
</div>
<div class="popup add-congregation-ok">
  <span class="glyphicon glyphicon-remove-circle add-congregation-ok"></span>
  <div class="message">
    <div>새 회중이 등록되었습니다</div>
  </div>
  <div class="action">
    <button class="btn btn-success btn-close">닫기</button>
  </div>
</div>
<div class="popup duplicated-id">
  <span class="glyphicon glyphicon-remove-circle duplicated-id"></span>
  <div class="message">
    <div>이미 존재하는 아이디입니다</div>
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
<div class="popup duplicated-congregation">
  <span class="glyphicon glyphicon-remove-circle duplicated-congregation"></span>
  <div class="message">
    <div>이미 등록된 회중입니다</div>
  </div>
  <div class="action">
    <button class="btn btn-warning btn-close">닫기</button>
  </div>
</div>
<div class="popup invalid-id">
  <span class="glyphicon glyphicon-remove-circle invalid-id"></span>
  <div class="message">
    <div>ID는 공백없는 4-12자의 영문과 숫자의 조합만 사용할 수 있습니다</div>
  </div>
  <div class="action">
    <button class="btn btn-warning btn-close">닫기</button>
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
<div class="popup add-congregation">
  <span class="glyphicon glyphicon-remove-circle add-congregation"></span>
  <form>
    <div class="message">
      <div style="text-align: justify; font-size: 10pt">등록할 회중이나 집단의 이름을 적어주십시오.<br>(예시: 경기성남북부, 경기성남북부 중국어...)<br><br>회중의 첫 계정에는 관리자 권한이 부여됩니다. 관리자 계정 이후에 등록된 계정들의 처음 권한은 '열람'이며, 관리자 계정이 이들의 권한을 변경할 수 있습니다</div>
      <div><input required type="text" class="name" name="name"></input></div>
    </div>
    <div class="action">
      <button type="submit" class="btn btn-info btn-close">등록</button>
    </div>
  </form>
</div>
<div class="container-fluid">
  <div class="row content body signup text-center">
    <div class="col-sm-12 text-left">
      <form id="signup" class="form-horizontal">
        <div class="form-group">
          <div class="col-sm-offset-2">
            <p><span class="required">*</span> 는 필수입력 항목입니다</p>
            <p style="font-size: 8pt;">비밀번호는 암호화되어 저장되므로 관리자도 알 수 없습니다</p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="id">아이디 <span class="required">*</span></label>
          <div class="col-sm-10">
            <input required type="text" class="form-control" id="id" name="id" placeholder="ID를 입력해주세요">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="password">비밀번호 <span class="required">*</span></label>
          <div class="col-sm-10">
            <input required type="password" class="form-control" id="password" name="password" placeholder="비밀번호를 입력해주세요">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="name">이름 <span class="required">*</span></label>
          <div class="col-sm-10">
            <input required type="text" class="form-control" id="name" name="name" placeholder="이름을 입력해주세요">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="congregation">회중(또는 집단) <span class="required">*</span></label>
          <div class="col-sm-8">
            <select id="congregation" name="congregation">
              <?php foreach($congregations as $congregation): ?>
                <option value="<?=$congregation['congregation_srl']?>"><?=$congregation['name']?></option>
              <?php endforeach?>
            </select>
          </div>
          <div id="add-congregation" class="col-sm-2">
            <div class="btn add-congregation"><span class="glyphicon glyphicon-plus"></span> 등록</div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="password">이메일 <span class="required">*</span></label>
          <div class="col-sm-10">
            <input required type="email" class="form-control" id="email" name="email" placeholder="이메일을 입력해주세요 (비밀번호 분실시 사용됩니다)">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="phone">연락처</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="phone" name="phone" placeholder="연락처를 입력해주세요 (선택사항)">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">계정생성</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script language="javascript" type="text/javascript" src="<?=asset_url('js/'.$current_class.'.js')?>"></script>
