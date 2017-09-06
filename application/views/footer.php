    <footer class="container-fluid text-center">
      <?php if(isset($session) && $current_class !== 'gathering'): ?>
        <div class="user-info"><a href="member"><?=$session['congregation_name']?> <?=$session['name']?>, <?=date("Y-m-d")?> (<?=getDayOfTheWeek(date("Y-m-d"))?>)</a></div>
      <?php endif ?>

      <?php if($current_class === 'gathering'): ?>
        <div class="carousel-controller">
          <a class="left carousel-control" href="#gatheringContentCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#gatheringContentCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      <?php endif ?>
        <img class="logo" src="<?=asset_url('img/favicon.png')?>" onclick="location.href = 'main'">
    </footer>
  </body>
</html>
