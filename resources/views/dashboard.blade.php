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

<section class="shadow-box">
    <article id="add-box">
        <h1>
            Add training
        </h1>

        <button class="close" data-id="#add-box">
            <span data-id="#add-box">X</span>
            Close
        </button>

        <form id="add-form" novalidate>
            @csrf
            <label for="training-type">
                Type (minal length: 2)*
            </label>
            <span for="training-type" class="word-counter">
                0 / 64
            </span>
            <input name="type" id="training-type" type="text" placeholder="private project" class="general-input" autocomplete="off" required>
            <span for="training-type" class="validation">
                Only 
                <span class="validation-char">a - z, A - Z</span>, 
                <span class="validation-char">0 - 9</span> and
                <span class="validation-char">ä, ö, ü, Ä, Ö, Ü</span> are allowed.
            </span>

            <h2>
                Category *
            </h2>
            <div class="container">
                <input type="radio" name="category" value="frontend" id="cat-frontend" required>
                <input type="radio" name="category" value="backend" id="cat-backend" required>
                <input type="radio" name="category" value="design" id="cat-design" required>
                <input type="radio" name="category" value="fullstack" id="cat-fullstack" required>
                <input type="radio" name="category" value="configuring" id="cat-configuring" required>
                <label for="cat-frontend">frontend</label>
                <label for="cat-backend">backend</label>
                <label for="cat-design">design</label>
                <label for="cat-fullstack">fullstack</label>
                <label for="cat-configuring">configuring</label>
            </div>

            <h2>
                Time spent (hours) *
            </h2>
            <div class="range-box">
                <h2>1h</h2>
                <input type="range" min="1" max="24" name="time" id="training-time" value="2" style="padding: 1rem 0">
                <h2>24h</h2>
            </div>
            <h2 class="your-range" for="#training-time">
            </h2>

            <label for="training-note">
                Notes
            </label>
            <span for="training-note" class="word-counter">
                0 / 255
            </span>
            <textarea id="training-note" name="note" type="text" placeholder="I did CSS, alot." class="general-input" autocomplete="off" required></textarea>
            <p class="main-error">
                Please include all necessary input for an entry correctly!
            </p>
            <button type="submit" id="add-button">
                Add Entry
            </button>
        </form>
    </article>
</section>

<section class="shadow-box">
    <article id="editing-box">
        <h1>
            Edit Entry
        </h1>

        <button class="close" data-id="#editing-box">
            <span data-id="#editing-box">X</span>
            Close
        </button>

        <form id="editing-form" novalidate>
            @csrf
            <label for="edit-type">
                Type (minal length: 2)*
            </label>
            <span for="edit-type" class="word-counter">
                0 / 64
            </span>
            <input name="type" id="edit-type" type="text" placeholder="private project" class="general-input" autocomplete="off" required>
            <span for="edit-type" class="validation">
                Only 
                <span class="validation-char">a - z, A - Z</span>, 
                <span class="validation-char">0 - 9</span> and
                <span class="validation-char">ä, ö, ü, Ä, Ö, Ü</span> are allowed.
            </span>

            <h2>
                Category *
            </h2>
            <div class="container">
                <input type="radio" name="ecategory" value="frontend" id="edit-frontend" required>
                <input type="radio" name="ecategory" value="backend" id="edit-backend" required>
                <input type="radio" name="ecategory" value="design" id="edit-design" required>
                <input type="radio" name="ecategory" value="fullstack" id="edit-fullstack" required>
                <input type="radio" name="ecategory" value="configuring" id="edit-configuring" required>
                <label for="edit-frontend">frontend</label>
                <label for="edit-backend">backend</label>
                <label for="edit-design">design</label>
                <label for="edit-fullstack">fullstack</label>
                <label for="edit-configuring">configuring</label>
            </div>

            <h2>
                Time spent (hours) *
            </h2>
            <div class="range-box">
                <h2>1h</h2>
                <input type="range" min="1" max="24" name="time" id="edit-time" value="2" style="padding: 1rem 0">
                <h2>24h</h2>
            </div>
            <h2 class="your-range" for="#edit-time">
            </h2>

            <label for="edit-note">
                Notes
            </label>
            <span for="edit-note" class="word-counter">
                0 / 255
            </span>
            <textarea id="edit-note" name="note" type="text" placeholder="I did CSS, alot." class="general-input" autocomplete="off" required></textarea>
            <p class="main-error">
                Please include all necessary input for an entry correctly!
            </p>
            <button type="submit" id="edit-button">
                Save
            </button>
        </form>
    </article>
</section>

<section id="main">
    <aside id="side-box">
        <div class="side-box">
            <h2>
                Logged working hours
            </h2>
            @php
            $total = 0;
            $month = 0;
            $date = date('y-m-d');
            foreach ($data as $d) {
                $total += $d->time;
                if (explode('-', $d->date)[1] === explode('-', $date)[1]) {
                    $month += $d->time;
                }
            }
            @endphp
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
        <div class="side-box">2</div>
        <div class="side-box">3</div>
        <div class="side-box">4</div>
    </aside>

    <article>
        <ul class="first">
            <li>
                DATE 
                <span>
                    <img src="{{ asset('images/arrow-up.png') }}">
                    <img src="{{ asset('images/arrow-down.png') }}">
                </span>
            </li>
             <li>
                TYPE 
                <span>
                    <img src="{{ asset('images/arrow-up.png') }}">
                    <img src="{{ asset('images/arrow-down.png') }}">
                </span>
            </li>
             <li>
                CATEGORY 
                <span>
                    <img src="{{ asset('images/arrow-up.png') }}">
                    <img src="{{ asset('images/arrow-down.png') }}">
                </span>
            </li>
             <li>
                TIME 
                <span>
                    <img src="{{ asset('images/arrow-up.png') }}">
                    <img src="{{ asset('images/arrow-down.png') }}">
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
         <div>

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
                        <span class="tag">
                            CSS
                        </span>
                        <span class="tag">
                            HTML
                        </span>
                        <span class="tag">
                            jQuery
                        </span>
                        <span class="tag">
                            Laravel
                        </span>
                        <span class="tag">
                            SQL
                        </span>
                        <span class="tag">
                            SCSS
                        </span>
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
</section>

<script>
/*createSortable('#side-box')

function createSortable(selector) {
  var sortable = document.querySelector(selector);
  Draggable.create(sortable.children, {
    type: "y",
    bounds: sortable,
    edgeResistance: 1,
    onPress: sortablePress,
    onDragStart: sortableDragStart,
    onDrag: sortableDrag,
    liveSnap: sortableSnap,
    onDragEnd: sortableDragEnd
  });
}

function sortablePress() {
  var t = this.target,
      i = 0,
      child = t;
  while(child = child.previousSibling)
    if (child.nodeType === 1) i++;
  t.currentIndex = i;
  t.currentHeight = t.offsetHeight;
  t.kids = [].slice.call(t.parentNode.children); // convert to array
}

function sortableDragStart() {
  TweenLite.set(this.target, { background: "#fafafa" });
}
                 
function sortableDrag() {
  var t = this.target,
      elements = t.kids.slice(), // clone
      indexChange = Math.round(this.y / t.currentHeight),
      bound1 = t.currentIndex,
      bound2 = bound1 + indexChange;
  if (bound1 < bound2) { // moved down
    TweenLite.to(elements.splice(bound1+1, bound2-bound1), 0.15, { yPercent: -200 });
    TweenLite.to(elements, 0.15, { yPercent: 0 });
  } else if (bound1 === bound2) {
    elements.splice(bound1, 1);
    TweenLite.to(elements, 0.15, { yPercent: 0 });
  } else { // moved up
    TweenLite.to(elements.splice(bound2, bound1-bound2), 0.15, { yPercent: 200 });
    TweenLite.to(elements, 0.15, { yPercent: 0 });
  }
}

function sortableSnap(y) {
  var h = this.target.currentHeight;
  return Math.round(y / h) * h;
}
                 
function sortableDragEnd() {
  var t = this.target,
      max = t.kids.length - 1,
      newIndex = Math.round(this.y / t.currentHeight);
  newIndex += (newIndex < 0 ? -1 : 0) + t.currentIndex;
  if (newIndex === max) {
    t.parentNode.appendChild(t);
  } else {
    t.parentNode.insertBefore(t, t.kids[newIndex+1]);
  }
  TweenLite.set(t.kids, { yPercent: 0, overwrite: "all" });
  TweenLite.set(t, { y: 0, background: "transparent" });
}*/
</script>

<script src="{{ asset('js/main.js') }}"></script>

@endsection
