<div class="wrapper"></div>
<div class="popup help">
  <span class="glyphicon glyphicon-remove-circle help"></span>
  <div class="message" style="font-size: 1vw">
    <div>키보드를 눌러 아래의 조작을 할 수 있습니다.(PC)</div>
    <div>ENTER, ←, → : 슬라이드쇼</div>
    <div>+, - : 글씨 크기 확대, 축소</div>
    <div>h : 상단 바(header) 토글</div>
    <div>f : 하단 바(footer) 토글</div>
    <div>? : 이 도움말 팝업 보기</div>
    <div>F11 : 전체화면</div>
    <div>16:9 비율의 스크린과 크롬에 최적화되어 있습니다.</div>
  </div>
  <div class="action">
    <button class="btn btn-success btn-close">닫기</button>
  </div>
</div>
<div class="container-fluid">
  <div class="row content body gathering">
    <div id="gatheringContentCarousel" class="carousel" data-ride="carousel" data-interval="false">
      <?php if($style === 'section'): ?>
        <div id="style-section" class="carousel-inner" role="listbox">
          <div class="item active">
            <div class="pGroup" style="text-align: center; margin-top: 30vh">
              <ul>
                <li style="font-size: 4vw"><?=$section[1]->find('div.pGroup')[0]->first_child()->first_child()->first_child()?></li>
                <li style="font-size: 3vw"><?=$section[1]->find('div.pGroup')[0]->first_child()->first_child()->next_sibling()->first_child()?></li>
              </ul>
            </div>
          </div>
          <div class="item">
            <?=$section[2]?>
          </div>
          <div class="item">
            <?=$section[3]?>
          </div>
          <div class="item">
            <?=$section[4]?>
          </div>
      <?php elseif($style === 'program'): ?>
        <div id="style-program" class="carousel-inner" role="listbox">
          <div class="item active">
            <div class="pGroup" style="text-align: center; margin-top: 30vh">
              <ul>
                <li style="font-size: 4vw"><?=$section[1]->find('div.pGroup')[0]->first_child()->first_child()->first_child()?></li>
                <li style="font-size: 3vw"><?=$section[1]->find('div.pGroup')[0]->first_child()->first_child()->next_sibling()->first_child()?></li>
              </ul>
            </div>
          </div>
          <div class="item">
            <?=$section[2]->find('h2')[0]?>
            <div class="pGroup">
              <ul>
                <?=$section[2]->find('div.pGroup')[0]->first_child()->first_child()?>
              </ul>
            </div>
          </div>
          <div class="item">
            <?=$section[2]->find('h2')[0]?>
            <div class="pGroup">
              <ul>
                <?=$section[2]->find('div.pGroup')[0]->first_child()->first_child()->next_sibling()?>
              </ul>
            </div>
          </div>
          <div class="item">
            <?=$section[2]->find('h2')[0]?>
            <div class="pGroup">
              <ul>
                <?=$section[2]->find('div.pGroup')[0]->first_child()->first_child()->next_sibling()->next_sibling()?>
              </ul>
            </div>
          </div>
          <div class="item">
            <?=$section[3]->find('h2')[0]?>
            <div class="pGroup">
              <ul>
                <?=$section[3]->find('div.pGroup')[0]->first_child()->first_child()?>
              </ul>
            </div>
          </div>
          <?php
            $additional = $section[3]->find('div.pGroup')[0]->first_child()->first_child()->next_sibling();
            if($additional): ?>
              <div class="item">
                <?=$section[3]->find('h2')[0]?>
                  <div class="pGroup">
                    <ul>
                      <?=$additional?>
                    </ul>
                  </div>
              </div>
              <div class="item">
                <?=$section[3]->find('h2')[0]?>
                <div class="pGroup">
                  <ul>
                    <?=$additional->next_sibling()?>
                  </ul>
                </div>
              </div>
          <?php endif ?>
          <?php $additional = $section[4]->find('div.pGroup')[0]->first_child()->first_child()->next_sibling()->next_sibling()->next_sibling()->next_sibling()->next_sibling();?>
          <div class="item">
            <?=$section[4]->find('h2')[0]?>
            <div class="pGroup" style="text-align: center">
              <ul>
                <?=$section[4]->find('div.pGroup')[0]->first_child()->first_child()?>
              </ul>
            </div>
          </div>
          <div class="item">
            <?=$section[4]->find('h2')[0]?>
            <div class="pGroup">
              <ul>
                <?=$section[4]->find('div.pGroup')[0]->first_child()->first_child()->next_sibling()?>
              </ul>
            </div>
          </div>
          <div class="item">
            <?=$section[4]->find('h2')[0]?>
            <div class="pGroup">
              <ul>
                <?=$section[4]->find('div.pGroup')[0]->first_child()->first_child()->next_sibling()->next_sibling()?>
              </ul>
            </div>
          </div>
          <div class="item">
            <?=$section[4]->find('h2')[0]?>
            <div class="pGroup" <?php if(!$additional):?>style="text-align: center"<?php endif ?>>
              <ul>
                <?=$section[4]->find('div.pGroup')[0]->first_child()->first_child()->next_sibling()->next_sibling()->next_sibling()?>
              </ul>
            </div>
          </div>
          <div class="item">
            <?=$section[4]->find('h2')[0]?>
            <div class="pGroup" style="text-align: center">
              <ul>
                <?=$section[4]->find('div.pGroup')[0]->first_child()->first_child()->next_sibling()->next_sibling()->next_sibling()->next_sibling()?>
              </ul>
            </div>
          </div>
          <?php if($additional): ?>
            <div class="item">
              <?=$section[4]->find('h2')[0]?>
              <div class="pGroup" style="text-align: center">
                <ul>
                  <?=$additional?>
                </ul>
              </div>
            </div>
          <?php endif ?>
        <?php endif ?>

        <?php foreach($img as $image): ?>
          <div class="item">
            <div class="inner-item">
              <?=$image?>
            </div>
          </div>
        <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script language="javascript" type="text/javascript" src="<?=asset_url('js/'.$current_class.'.js')?>"></script>
