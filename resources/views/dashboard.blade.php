@extends('master')

@section('content')
<header>
    <button id="add-new">
        <span>
            +
        </span>
        ADD NEW
    </button>

    <aside>
        <h2>
            {{ $user->name }}
        </h2>

        <a href="/logout/">
            Sign Out
        </a>
    </aside>
</header>

@include('addBox')
@include('editBox')

<section id="main">
    <article>
        <ul class="first">
            <li>
                DATE 
                <span>
                    <img class="u" data-do="date" src="{{ asset('images/arrow-up.png') }}">
                    <img class="d" data-do="date" src="{{ asset('images/arrow-down.png') }}">
                </span>
            </li>
             <li>
                TYPE 
                <span>
                    <img class="u" data-do="type" src="{{ asset('images/arrow-up.png') }}">
                    <img class="d" data-do="type" src="{{ asset('images/arrow-down.png') }}">
                </span>
            </li>
             <li>
                CATEGORY 
                <span>
                    <img class="u" data-do="category" src="{{ asset('images/arrow-up.png') }}">
                    <img class="d" data-do="category" src="{{ asset('images/arrow-down.png') }}">
                </span>
            </li>
             <li>
                TIME 
                <span>
                    <img class="u" data-do="time" src="{{ asset('images/arrow-up.png') }}">
                    <img class="d" data-do="time" src="{{ asset('images/arrow-down.png') }}">
                </span>
            </li>
             <li>
                NOTES 
            </li>
             <li>
                TAGS 
            </li>
            <li>

            </li>
        </ul>
         <div id="order">
            @php
            $tagz_arr = array();
            @endphp
            @foreach ($data as $d)
                <ul id="{{ $d->id }}">
                    <li class="date">
                        {{ $d->date }}
                    </li>
                    <li class="type">
                        {{ $d->type }}
                    </li>
                    <li class="category">
                        {{ $d->category }}
                    </li>
                    <li class="time">
                       {{ $d->time }}h
                    </li>
                    <li class="notes">
                        {{ $d->notes }}
                    </li>
                    <li class="tags">

                        @php
                        $tagz = explode(';', $d->tags);
                        array_pop($tagz);
                        foreach ($tags as $tag) {
                            if (in_array($tag->id, $tagz)) {
                                array_push($tagz_arr, $tag->id);
                                echo '<span class="tag" data-id="edit-tag-' .$tag->id. '">' .$tag->name. '</span>';
                            }
                        }
                        @endphp
                    </li>
                    <li class="last">
                        <button class="edit-button">
                            <img src="{{ asset('images/edit.png') }}">
                        </button>
                    </li>
                </ul>
             @endforeach

         </div>
    </article>
    <aside id="side-box">
        @php
        $total = 0;
        $month = 0;
        $date = date('y-m-d');

        $frontend = 0;
        $backend = 0;
        $design = 0;
        $configuring = 0;
        $fullstack = 0;

        $frontendTime = 0;
        $backendTime = 0;
        $designTime = 0;
        $configuringTime = 0;
        $fullstackTime = 0;

        foreach ($data as $d) {
            $total += $d->time;
            if (explode('-', $d->date)[1] === explode('-', $date)[1]) {
                $month += $d->time;
            }

            if ($d->category === 'backend') {
                $backend++;
                $frontendTime += $d->time;
            }
            if ($d->category === 'frontend') {
                $frontend++;
                $backendTime += $d->time;
            }
            if ($d->category === 'design') {
                $design++;
                $designTime += $d->time;
            }
            if ($d->category === 'configuring') {
                $configuring++;
                $configuringTime += $d->time;
            }
            if ($d->category === 'fullstack') {
                $fullstack++;
                $fullstackTime += $d->time;
            }
        }

        $ocu = ($frontend + $backend + $fullstack + $configuring + $design);
        $tim = ($frontendTime + $backendTime + $fullstackTime + $configuringTime + $designTime);

        function percent($an, $gr) {
            if ($gr === 0)
                return 0;
            return ($an * 100) / $gr;
        }

        $frp = percent($frontend, $ocu);
        $bap = percent($backend, $ocu);
        $cop = percent($configuring, $ocu);
        $dep = percent($design, $ocu);
        $flp = percent($fullstack, $ocu);

        $frpT = percent($frontendTime, $tim);
        $bapT = percent($backendTime, $tim);
        $copT = percent($configuringTime, $tim);
        $depT = percent($designTime, $tim);
        $flpT = percent($fullstackTime, $tim);

        $ocu_css = 'background: conic-gradient(
                    coral 0.0% ' .$frp. '%, 
                    lightblue ' .$frp. '%' .($bap + $frp). '%, 
                    blueviolet ' .($bap + $frp). '% ' .($bap + $frp + $cop). '%, 
                    green ' .($bap + $frp + $cop). '% ' .($bap + $frp + $cop + $dep). '%, 
                    slategray ' .($bap + $frp + $cop + $dep). '% ' .($bap + $frp + $cop + $dep + $flp). '%);';

        $tim_css = 'background: conic-gradient(
                    coral 0.0% ' .$frpT. '%, 
                    lightblue ' .$frpT. '%' .($bapT + $frpT). '%, 
                    blueviolet ' .($bapT + $frpT). '% ' .($bapT + $frpT + $copT). '%, 
                    green ' .($bapT + $frpT + $copT). '% ' .($bapT + $frpT + $copT + $depT). '%, 
                    slategray ' .($bapT + $frpT + $copT + $depT). '% ' .($bapT + $frpT + $copT + $depT + $flpT). '%);';
        @endphp
        <div class="side-box">
            <h2>
                Logged working hours
            </h2>
            <div class="hour-box-container">
                <div class="hours-box">
                    <h2>
                        {{ $total }}h
                    </h2>
                    <p>
                    Total
                    </p>
                </div>
                <div class="hours-box">
                    <h2>
                        {{ $month }}h
                    </h2>
                    <p>
                    This Month
                    </p>
                </div>
            </div>
        </div>
        <div class="side-box">
            <h2 style="margin-bottom: 3rem">
                Categories
            </h2>
            <div class="category-box">
                <span>
                    frontend
                </span>
                <span>
                    backend
                </span>
                <span>
                    configuring
                </span>
                <span>
                    design
                </span>
                <span>
                    fullstack
                </span>
            </div>
            <div class="hour-box-container">
                <div class="hours-box">
                    <div class="chart" style="{{ $ocu_css }}"></div>
                    <p>
                        Occurencies
                    </p>
                </div>
                <div class="hours-box">
                    <div class="chart" style="{{ $tim_css }}"></div>
                    <p>
                        Time
                    </p>
                </div>
            </div>
        </div>
        <div class="side-box">
            <h2>
                Used Technologies
            </h2>

            <div class="tag-box">
                @php
                foreach ($tags as $tag) {
                    if (in_array($tag->id, $tagz_arr)) {
                        echo '<span class="tag">' .$tag->name. '</span>';
                    }
                }
                @endphp
            </div>
        </div>
    </aside>
</section>

<script src="{{ asset('js/main.js') }}"></script>

@endsection
