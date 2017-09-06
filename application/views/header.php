<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="main">JW SERV</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
          <?php if($current_class !== 'gathering'): ?>
            <li><a href="check"><span class="glyphicon glyphicon-folder-open"></span> 현황보기</a></li>
            <li><a href="record"><span class="glyphicon glyphicon-pencil"></span> 기록하기</a></li>
            <li><a href="member"><span class="glyphicon glyphicon-user"></span> 내 정보</a></li>
            <li><a href="gathering"><span class="glyphicon glyphicon-home"></span> 집회</a></li>
            <?php if($session['auth'] === 'a'): ?>
              <li><a href="admin"><span class="glyphicon glyphicon-wrench"></span> 관리자</a></li>
            <?php endif ?>
          <?php endif ?>
          <?php if(isset($style) && $style === 'section'): ?>
            <li><a href="?style=program">집회(범주별)</a></li>
          <?php elseif(isset($style) && $style === 'program'): ?>
            <li><a href="?style=section">집회(프로그램별)</a></li>
          <?php endif ?>
        </ul>
        <?php if(isset($session) && $current_class !== "gathering"): ?>
          <ul class="nav navbar-nav navbar-right"><li><a href="signout"><span class="glyphicon glyphicon-log-out"></span> 로그아웃</a></li></ul>
        <?php endif ?>
    </div>
  </div>
</nav>
