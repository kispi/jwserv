<div class="wrapper"></div>
<div class="popup no-member">
  <span class="glyphicon glyphicon-remove-circle no-member"></span>
  <div class="message no-matching-member-info">
    <div>일치하는 계정이 없습니다</div>
  </div>
  <div class="action no-matching-member-info">
    <button class="btn btn-warning btn-close">닫기</button>
    <button class="btn btn-info open-find-account">계정찾기</button>
  </div>
  <div class="message find-account">
    <div>이메일을 입력해주세요</div>
    <div><input type="email" name="email" placeholder="계정생성시 등록한 이메일"></input></div>
  </div>
  <div class="action find-account">
    <button class="btn btn-primary find-account">계정찾기</button>
  </div>
  <div class="message find-account send-success">
    <div><span class="glyphicon glyphicon-ok"></span> 이메일 발송에 성공하였습니다</div>
  </div>
  <div class="message find-account send-fail">
    <div><span class="glyphicon glyphicon-remove"></span> 이메일 발송에 실패하였습니다</div>
  </div>
</div>
<div class="container-fluid">
  <div class="row content body signin text-center">
    <div class="col-sm-12 text-left">
      <h2>환영합니다</h2>
      <hr>
      <p>이 웹 애플리케이션은 손쉽게 회중 구역의 호별 방문 진행 상황을 확인하고 기록하고 인쇄할 수 있도록 도와줍니다.</p>
      <p>'홈 화면에 추가'를 눌러 편리하게 사용하세요!</p>
      <p></p>
      <form class="form-horizontal" id="signin">
        <div class="form-group">
          <div class="col-sm-12">
            <input required class="form-control" id="id" name="id" placeholder="아이디를 입력하세요">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <input required type="password" class="form-control" id="password" name="password" placeholder="비밀번호를 입력하세요">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <button type="submit" class="btn btn-primary">로그인</button>
            <button type="button" class="btn btn-success" id="signup">계정생성</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script language="javascript" type="text/javascript" src="<?=asset_url('js/'.$current_class.'.js')?>"></script>
