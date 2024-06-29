<!-- Component: Carousel with controls outside -->
<div class="relative w-full my-5 glide-04">
    <!-- Slides -->
    <div class="overflow-hidden" data-glide-el="track">
        <ul
            class="relative w-full overflow-hidden p-0 whitespace-no-wrap flex flex-no-wrap [backface-visibility: hidden] [transform-style: preserve-3d] [touch-action: pan-Y] [will-change: transform]">
            <li class="glide__slide"> <a
                    href="https://img.freepik.com/free-photo/anxiety-induced-by-traffic_23-2150981883.jpg?t=st=1708681377~exp=1708684977~hmac=a0eb3e6398af8a25217168018473ad24f5cccd3624de23847834f5011ea8f811&w=1380"
                    data-fancybox="gallery"><img class="object-cover h-full w-full rounded-md"
                        src="https://img.freepik.com/free-photo/anxiety-induced-by-traffic_23-2150981883.jpg?t=st=1708681377~exp=1708684977~hmac=a0eb3e6398af8a25217168018473ad24f5cccd3624de23847834f5011ea8f811&w=1380"></a>
            </li>
            <li class="glide__slide"> <a
                    href="https://img.freepik.com/free-photo/abundance-cars-crowded-parking-lot-generated-by-ai_188544-17580.jpg?t=st=1708681321~exp=1708684921~hmac=397bdf24b63c405494a9b797c1a1b8a00e55879bcbc70d7d296be52e915fbc1d&w=1380"
                    data-fancybox="gallery"><img class="object-cover h-full w-full rounded-md"
                        src="https://img.freepik.com/free-photo/abundance-cars-crowded-parking-lot-generated-by-ai_188544-17580.jpg?t=st=1708681321~exp=1708684921~hmac=397bdf24b63c405494a9b797c1a1b8a00e55879bcbc70d7d296be52e915fbc1d&w=1380"></a>
            </li>
            <li class="glide__slide"> <a
                    href="https://img.freepik.com/free-photo/orange-cone-stands-road_60438-3991.jpg?t=st=1708681459~exp=1708685059~hmac=bd85acee2d5bb16c0fd2a470fbaabc64b20a30cb397fe9f5331e2e162a35eb53&w=1380"
                    data-fancybox="gallery"><img class="object-cover h-full w-full rounded-md"
                        src="https://img.freepik.com/free-photo/orange-cone-stands-road_60438-3991.jpg?t=st=1708681459~exp=1708685059~hmac=bd85acee2d5bb16c0fd2a470fbaabc64b20a30cb397fe9f5331e2e162a35eb53&w=1380"></a>
            </li>
            <li class="glide__slide"> <a
                    href="https://img.freepik.com/free-photo/medium-shot-woman-city-lifestyle_23-2151002680.jpg?t=st=1708681524~exp=1708685124~hmac=0d3a68113fc3fedbda4d8c4b567d79326813bb336e17c68cc45445d72b05ce71&w=1060"
                    data-fancybox="gallery"><img class="object-cover h-full w-full rounded-md"
                        src="https://img.freepik.com/free-photo/medium-shot-woman-city-lifestyle_23-2151002680.jpg?t=st=1708681524~exp=1708685124~hmac=0d3a68113fc3fedbda4d8c4b567d79326813bb336e17c68cc45445d72b05ce71&w=1060"></a>
            </li>
            <li class="glide__slide"> <a
                    href="https://img.freepik.com/free-photo/aerial-view-city-street-with-cars-pedestrians-3d-rendering_1142-40249.jpg?t=st=1708681564~exp=1708685164~hmac=b717e5ac67cb193b2f64bb64cf7e1e1b4abd995c7bd944354756228a8b53f5fa&w=740"
                    data-fancybox="gallery"><img class="object-cover h-full w-full rounded-md"
                        src="https://img.freepik.com/free-photo/aerial-view-city-street-with-cars-pedestrians-3d-rendering_1142-40249.jpg?t=st=1708681564~exp=1708685164~hmac=b717e5ac67cb193b2f64bb64cf7e1e1b4abd995c7bd944354756228a8b53f5fa&w=740"></a>
            </li>

    </div>
    <!-- Controls -->
    <div class="flex items-center justify-center w-full gap-2 p-4" data-glide-el="controls">
        <button
            class="inline-flex items-center justify-center w-8 h-8 transition duration-300 border rounded-full lg:w-12 lg:h-12 text-slate-700 border-slate-700 hover:text-slate-900 hover:border-slate-900 focus-visible:outline-none bg-white/20"
            data-glide-dir="<" aria-label="prev slide">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <title>prev slide</title>
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
            </svg>
        </button>
        <button
            class="inline-flex items-center justify-center w-8 h-8 transition duration-300 border rounded-full lg:w-12 lg:h-12 text-slate-700 border-slate-700 hover:text-slate-900 hover:border-slate-900 focus-visible:outline-none bg-white/20"
            data-glide-dir=">" aria-label="next slide">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <title>next slide</title>
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
            </svg>
        </button>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.0.2/glide.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

<script>
    var glide04 = new Glide('.glide-04', {
        type: 'carousel',
        focusAt: 'center',
        perView: 3,
        autoplay: 3500,
        animationDuration: 700,
        gap: 24,
        classes: {
            activeNav: '[&>*]:bg-slate-700',
        },
        breakpoints: {
            1024: {
                perView: 3
            },
            640: {
                perView: 2
            }
        },
    });

    glide04.mount();

    // Variabla për të ruajtur pozicionin aktual të karuselit
    var currentPosition = 0;

    $(document).ready(function () {
        $(".glide__slide a").fancybox({
            beforeLoad: function (instance, slide) {
                // Ruaj pozicionin aktual të karuselit
                currentPosition = glide04.index;
            },
            btnTpl: {
                arrowLeft:
                    '<button data-fancybox-prev class="fancybox-button fancybox-button--arrow_left" title="{{PREV}}">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15.41 16.58L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.42z"/></svg>' +
                    "</button>",

                arrowRight:
                    '<button data-fancybox-next class="fancybox-button fancybox-button--arrow_right" title="{{NEXT}}">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10.59 16.58L15.17 12 10.59 7.41 12 6l6 6-6 6-1.41-1.42z"/></svg>' +
                    "</button>"
            }
        });
    });

    $("[data-fancybox]").fancybox({
        // Pas mbylljes së dritares së fancybox, kthe karuselin në pozicionin e ruajtur dhe parandalo rifreskimin
        afterClose: function () {
            setTimeout(function () {
                glide04.go('=' + currentPosition);
            }, 500); // Shto një vonesë të shkurtër për të siguruar që fancybox ka mbyllur plotësisht
            return false; // Parandalo rifreskimin automatik të karuselit
        }
    });
</script>