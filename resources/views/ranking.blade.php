@extends('layout')

@section('content')
    @if($mode)
        <div class="text-white flex justify-center w-full mt-10 h-max" style="margin-bottom: 50px">
            <div class="grid">
                @include('parts.ranking.top3')
                @include('parts.ranking.table')
            </div>
        </div>
    @else
        <div class="text-white mt-10 flex justify-center text-2xl mb-10 uppercase">Wybierz ranking</div>
        <div class="flex justify-center items-center mt-10 px-4 py-16 mx-auto sm:max-w-xl text-white md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
            <h5 class="text-4xl mr-8 uppercase font-bold lg:text-5xl xl:text-6xl">
                <a href="{{ route('ranking.type', ['modeType' => \App\Enums\MatchGameModeEnum::PARENT_TPP]) }}">Tpp</a>
            </h5>
            <h5 class="text-4xl mr-8 uppercase font-bold lg:text-5xl xl:text-6xl">
                <a href="{{ route('ranking.type', ['modeType' => \App\Enums\MatchGameModeEnum::PARENT_FPP]) }}">Fpp</a>
            </h5>
            <h5 class="text-4xl mr-8 uppercase font-bold lg:text-5xl xl:text-6xl">
                <a href="{{ route('ranking.type', ['modeType' => \App\Enums\MatchGameModeEnum::PARENT_RANKED]) }}">Ranked</a>
            </h5>
        </div>
    @endif
@endsection

@section('scripts')
    <script>
        var sum = 1000; // rank 1.
        var time = 250;

        $(document).ready(function () {

            $('.js-style-switch').on('click', function (e) {
                e.preventDefault();
                $('body').toggleClass('dark-mode');
            });

            $('.js-podium').each(function () {
                var t = $(this);
                setTimeout(function () {
                    t.addClass('is-visible');
                    var h = t.data('height');
                    console.log(h);
                    t.find('.scoreboard__podium-base').css('height', h).addClass('is-expanding');
                }, time);
                time += 250;
            });

            // randomizeData();
            startBars();
            sortItems();
            countUp();
            // randomizePodium();


            setInterval(function () {

                randomizeData();
                startBars();
                sortItems();
                countUp();
                oneUp();
                $('.js-podium').removeClass('bump');
                podiumUpdate();

            }, 10000);

        });


        function countUp () {

            $('.scoreboard__item').each(function () {
                var $this = $(this),
                    countTo = $this.data('count');

                $({countNum: $this.text()}).animate({
                        countNum: countTo
                    },

                    {
                        duration: 500,
                        easing: 'linear',
                        step: function () {
                            $this.find('.js-number').text(Math.floor(this.countNum));
                        },
                        complete: function () {
                            $this.find('.js-number').text(this.countNum);
                            //alert('finished');
                        }

                    });
            });
        }

        function randomizeData () {
            $('.scoreboard__item').each(function () {
                var rand = Math.floor(Math.random() * 900) + 1;
                $(this).data('count', rand);
                $(this).find('.js-number').text(rand);
            });

        }

        function startBars () {
            $('.js-bar').each(function () {
                console.log('running');
                // calculate %.
                var t = $(this);
                setTimeout(function () {
                    var width = t.parent('.scoreboard__item').data('count');
                    width = width / sum * 100;
                    width = Math.round(width);
                    t.find('.scoreboard__bar-bar').css('width', width + "%");
                    t.parent('li').addClass('is-visible');
                }, time);
                time += 0;
            });
        }

        function sortItems () {
            tinysort.defaults.order = 'desc';

            var ul = document.getElementById('scoreboard__items')
                , lis = ul.querySelectorAll('li')
                , liHeight = lis[0].offsetHeight
            ;
            ul.style.height = ul.offsetHeight + 'px';
            for (var i = 0, l = lis.length; i < l; i++) {
                var li = lis[i];
                li.style.position = 'absolute';
                li.style.top = i * liHeight + 'px';
            }
            tinysort('ol#scoreboard__items>li', 'span.js-number').forEach(function (elm, i) {
                setTimeout((function (elm, i) {
                    elm.style.top = i * liHeight + 'px';
                }).bind(null, elm, i), 40);
            });


        }

        function randEmail () {
            var chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
            var string = '';
            for (var ii = 0; ii < 15; ii++) {
                string += chars[Math.floor(Math.random() * chars.length)];
            }
            return string + '@domain.tld';
        }

        function oneUp () {
            // play audio - update email.
            var randEmail = window.randEmail();
            $('.js-oneup').html('Ny påmeldt: ' + randEmail);
            $('.js-oneup-audio')[0].play();
        }


        function randomizePodium () {
            $('.js-podium-data').each(function () {
                var random = Math.floor(Math.random() * 900) + 1;
                $(this).fadeOut(200).text(random + ' deltagere').fadeIn(200);
            });
            $(this).data('count', random);
        }

        function podiumUpdate () {
            $('.js-podium').each(function () {
                $(this).addClass('bump');
                randomizePodium();
            });
        }
    </script>
@endsection
