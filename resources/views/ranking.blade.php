@extends('layout')

@section('content')
    <div class="text-white flex justify-center w-full mt-[70px] h-max" style="margin-bottom: 50px">
        <div class="grid grid-rows-2 h-max">
            <div class="scoreboard">
                <div class="scoreboard__podiums">
                    <div class="scoreboard__podium js-podium" data-height="200px">
                        <div class="scoreboard__podium-base scoreboard__podium-base--second">
                            <div class="scoreboard__podium-rank">2</div>
                        </div>
                        <div class="scoreboard__podium-number">
                            {{ $top3->get(1)->player->playerName }}
                            <small><span class="js-podium-data text-white">{{ $top3->get(1)->points }} pkt</span></small>
                        </div>

                    </div>
                    <div class="scoreboard__podium js-podium" data-height="250px">
                        <div class="scoreboard__podium-base scoreboard__podium-base--first">
                            <div class="scoreboard__podium-rank">1</div>

                        </div>
                        <div class="scoreboard__podium-number">
                            {{ $top3->get(0)->player->playerName }}
                            <small><span class="js-podium-data text-white">{{ $top3->get(0)->points }} pkt</span></small>
                        </div>
                    </div>
                    <div class="scoreboard__podium js-podium" data-height="150px">
                        <div class="scoreboard__podium-base scoreboard__podium-base--third">
                            <div class="scoreboard__podium-rank">3</div>
                        </div>
                        <div class="scoreboard__podium-number">
                            {{ $top3->get(2)->player->playerName }}
                            <small><span class="js-podium-data text-white">{{ $top3->get(2)->points }} pkt</span></small>
                        </div>
                    </div>
                </div>
            </div>
            <div style="height: max-content;">
                <table class="w-full text-sm text-left text-white font-bold">
                    <thead class="text-xs text-gray-100 uppercase bg-gray-800 border-b border-gray-700">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            Place
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Points
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Player name
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $position = 3 ?>
                    @foreach($ranking as $key => $playerRank)
                        <tr class="border-b bg-gray-800 border-gray-700">
                            <td class="py-4 px-6">
                                {{ $position++ }}
                            </td>
                            <th scope="row" class="py-4 px-6 font-medium text-white whitespace-nowrap">
                                <span class="bg-red-100 text-gray-900 text-sm font-medium mr-2 px-2.5 py-0.5 rounded">{{$playerRank->points}} pkt</span>
                            </th>
                            <td class="py-4 px-6">
                                {{ $playerRank->player->playerName }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
