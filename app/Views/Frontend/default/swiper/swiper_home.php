<div class="item-11">
        <div class="scroll">
            <div class="txt">SCROLL</div>
            <div class="arrow"></div>
        </div>
        <div class="owl-carousel" id="main-banner-slide">
          <?php if (!empty($slides)): ?>
          <?php foreach ($slides as $slide): ?>
          <div class="item">
            <div class="container">
              <div class="text-area text-area1">
                <div class="txt1"></div>
                <div class="txt2"></div>
              </div>
            </div>
            
            <div class="background">
              <img src="<?= esc($slide['image']) ?>">
            </div>
          </div>
        <?php endforeach;?>
        <?php endif;?>
        </div>
    </div>