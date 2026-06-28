
<swiper-container 
class="swiper full" 
slides-per-view="1" 
autoplay="<?= !empty($config['autoplay']) ? 'true':'false' ?>" 
autoplay-delay="<?= $config['delay'] ?? '3000' ?>"
speed="<?= $config['speed'] ?? '500' ?>" 
loop="<?= !empty($config['loop']) ? 'true':'false' ?>" 
css-mode="true" 
pagination="<?= !empty($config['pagination']) ? 'true':'false' ?>" 
navigation="<?= !empty($config['navigation']) ? 'true':'false' ?>" 
scrollbar="<?= !empty($config['scrollbar']) ? 'true':'false' ?>" 
>
<?php if (!empty($slides)): ?>
    <?php foreach ($slides as $slide): ?>
        <swiper-slide>
          <div class="item">
            <div class="container">
                <div class="text-area">
                <?= !empty($slide['title']) ? '<div class="title">'.esc($slide['title']).'</div>' : '' ?>
                <?= !empty($slide['subject']) ? '<div class="subject">'.esc($slide['subject']).'</div>' : '' ?>
                <?= !empty($slide['description']) ? '<div class="description">'.esc($slide['description']).'</div>' : '' ?>
                <?= !empty($slide['content']) ? '<div class="content">'.esc($slide['content']).'</div>' : '' ?>
                </div>
            </div>
            <div class="background">
              <?php if (!empty($slide['video'])): ?>
              <video id="bannervideo" playsinline="" muted="" poster="" loop="" autoplay="">
                <source src="<?= esc($slide['video']) ?>" type="video/mp4">
              </video>
              <?php else: ?>
              <img src="<?= esc($slide['image']) ?>" loading="lazy" />
              <?php endif; ?>
            </div>
        </div>
        </swiper-slide>
    <?php endforeach ?>
<?php endif ?>
</swiper-container>