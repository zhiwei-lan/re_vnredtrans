<?php

namespace App\Services\Frontend;

use App\Models\SlideModel;
use App\Models\SlideItemModel;
use Config\Database;

class SlideService
{
    protected SlideModel $SlideModel;
    protected SlideItemModel $SlideItemModel;
    public function __construct()
    {
        $this->SlideModel  = new SlideModel();
        $this->SlideItemModel  = new SlideItemModel();
    }
    
     public function getSlideWithCode(string $code): array
    {
        $slides = null;
        $locale = service('lang')->getLocale();
        $cacheKey = 'slides_'.$locale.'_'.$code;
        $cache = cache();

        if (ENVIRONMENT !== 'development') {
            //缓存读取  
            $slides = $cache->get($cacheKey);
        }
        if ($slides === null) {
            
            //先查是否有对应语言的数据
            if (! $this->SlideModel->where('code', $code)->where('lang', $locale)->first()) {
                //无数据则使用默认语言
                $locale = config('App')->defaultLocale;
            }

            $slide = $this->SlideModel->where('code', $code)->where('lang', $locale)->first();
            if (empty($slide)) {
                return [];
            }
            $slideConfig = [
                'autoplay' => (bool)$slide['autoplay'],
                'loop' => (bool)$slide['loop'],
                'delay' => (int)$slide['delay'],
                'speed' => (int)$slide['speed'],
                'pagination' => (bool)$slide['pagination'],
                'navigation' => (bool)$slide['navigation'],
                'scrollbar' => (bool)$slide['scrollbar'],
            ];
            $slideConfig = arrayToBool($slideConfig,['autoplay','loop','pagination','navigation','scrollbar']);
            $slideItems = $this->SlideItemModel->where('slide_id', $slide['id'])->findAll();

            $slides = [
                'config' => $slideConfig,
                'items' => $slideItems,
            ];
            // 缓存 60 分钟
            $cache->save($cacheKey, $slides, 3600);
        }

        return $slides;
        
    }

}
