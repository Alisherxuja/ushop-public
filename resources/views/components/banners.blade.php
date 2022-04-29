<div data-u="slides"
     style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">
    @foreach ($banners as $banner)
        <div data-p="680">
            <a href="javascript:void(0)">
                <img data-u="image" src="{{$banner->image_url}}" alt="{{$banner->image}}"/>
            </a>
        </div>
    @endforeach

</div>
<!-- Bullet Navigator -->
<div data-u="navigator" class="jssorb057" style="position:absolute;bottom:16px;right:16px;"
     data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
    <div data-u="prototype" class="i" style="width:14px;height:14px;">
        <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
            <circle class="b" cx="8000" cy="8000" r="5000"></circle>
        </svg>
    </div>
</div>
<!-- Arrow Navigator -->
<div data-u="arrowleft" class="jssora051" style="width:65px;height:65px;top:0px;left:25px;"
     data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
        <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
    </svg>
</div>
<div data-u="arrowright" class="jssora051" style="width:65px;height:65px;top:0px;right:25px;"
     data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
        <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
    </svg>
</div>

