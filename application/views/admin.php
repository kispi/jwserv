<div class="wrapper"></div>
<div class="popup update ok">
  <span class="glyphicon glyphicon-remove-circle update ok"></span>
  <div class="message">
    <div>수정되었습니다</div>
  </div>
  <div class="action">
    <button class="btn btn-success btn-close">닫기</button>
  </div>
</div>
<div class="popup no-admin">
  <span class="glyphicon glyphicon-remove-circle no-admin"></span>
  <div class="message">
    <div>최소 1명의 관리자는 있어야 합니다</div>
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
<div class="popup try-to-delete-admin">
  <span class="glyphicon glyphicon-remove-circle try-to-delete-admin"></span>
  <div class="message">
    <div>관리자는 삭제할 수 없습니다</div>
  </div>
  <div class="action">
    <button class="btn btn-warning btn-close">닫기</button>
  </div>
</div>
<div class="popup delete ok">
  <span class="glyphicon glyphicon-remove-circle delete ok"></span>
  <div class="message">
    <div>탈퇴 처리되었습니다</div>
  </div>
  <div class="action">
    <button class="btn btn-success btn-close">닫기</button>
  </div>
</div>
<div class="popup delete confirm">
  <span class="glyphicon glyphicon-remove-circle delete confirm"></span>
  <div class="message">
    <div>정말로 탈퇴시키겠습니까?</div>
  </div>
  <div class="action">
    <button class="btn btn-success yes btn-close">예</button>
    <button class="btn btn-info no btn-close">아니오</button>
  </div>
</div>
<div class="popup help">
  <span class="glyphicon glyphicon-remove-circle help"></span>
  <div class="message">
    <div>회중 내 계정들의 정보를 수정하거나, 삭제(탈퇴 처리)할 수 있습니다</div>
    <div>권한은 다음의 3단계로 구분됩니다</div>
    <div style="color: #088a29">
      관리 : 관리자 페이지에 접근할 수 있습니다<br>
      기록 : 봉사기록을 열람, 작성, 수정할 수 있습니다<br>
      열람 : 봉사기록을 열람할 수 있으나, 작성하거나 수정할 수는 없습니다<br>
    </div>
    <div style="color: red">관리자는 회중을 변경할 수 없으므로, 회중 변경 시 먼저 본인의 권한을 수정하시기 바랍니다</div>
  </div>
  <div class="action">
    <button class="btn btn-success btn-close">닫기</button>
  </div>
</div>

<div class="container-fluid">
  <div class="row content body admin text-center">
    <div class="col-sm-12 text-center">
      <button class="btn btn-primary help">도움말</button>
      <?php foreach($members as $member): ?>
        <div class="card member-<?=$member['member_srl']?>">
          <div class="row">
            <div class="menu col-xs-12 table-cell">
              <span class="member-<?=$member['member_srl']?> glyphicon card-button glyphicon-trash"></span>
              <span class="member-<?=$member['member_srl']?> glyphicon card-button glyphicon-pencil"></span>
            </div>
          </div>
          <div class="row">
            <div class="name col-xs-6 table-cell"><input readonly type="text" class="input-card" value="<?=$member['name']?>"></input></div>
            <div class="auth col-xs-6 table-cell">
              <select disabled id="congregation" name="congregation">
                <option <?=($member['auth'] === 'a' ? 'selected' : "")?> value="a">관리</option>
                <option <?=($member['auth'] === 'w' ? 'selected' : "")?> value="w">기록</option>
                <option <?=($member['auth'] === 'r' ? 'selected' : "")?> value="r">열람</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="email col-xs-12 table-cell"><input readonly type="text" class="input-card" value="<?=$member['email']?>"></input></div>
          </div>
          <div class="row">
            <div class="phone col-xs-12 table-cell"><input readonly type="text" class="input-card" value="<?=$member['phone']?>"></input></div>
          </div>
          <div class="row">
            <div class="phone col-xs-12 table-cell"><input readonly type="text" class="input-card" value="최종접속 : <?=$member['last_activity']?>"></input></div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</div>
<script language="javascript" type="text/javascript" src="<?=asset_url('js/'.$current_class.'.js')?>"></script>
