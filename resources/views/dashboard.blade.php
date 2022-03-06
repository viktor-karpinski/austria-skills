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
            <span>X</span>
            Close
        </button>

        <form id="add-form">
            @csrf
            <label for="training-type">
                Type *
            </label>
            <span for="training-type" class="word-counter">
                0 / 64
            </span>
            <input id="training-type" name="training-type" type="text" placeholder="private project" class="general-input" autocomplete="off" required>
            <span for="training-type" class="validation">
                Only 
                <span class="validation-char">a - z, A - Z</span>, 
                <span class="validation-char">0 - 9</span> and
                <span class="validation-char">ä, ö, ü, Ä, Ö, Ü</span> are allowed.
            </span>

            <label for="training-note">
                Notes
            </label>
            <span for="training-note" class="word-counter">
                0 / 255
            </span>
            <textarea id="training-note" name="training-note" type="text" placeholder="I did CSS, alot." class="general-input" autocomplete="off" required></textarea>
        </form>
    </article>
</section>

<section id="main">
    <aside id="side-box">
        <div class="side-box">1</div>
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

            <ul>
                <li>
                    30.10.2022
                </li>
                <li>
                    private project
                </li>
                <li>
                    Frontend
                </li>
                <li>
                    5h
                </li>
                <li>
                    Lorem ipsum dolor sit amet. Igmund das ist Lorems.
                </li>
                <li>
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
                    <button>
                        <img src="{{ asset('images/edit.png') }}">
                    </button>
                </li>
            </ul>

            <ul>
                <li>
                    30.10.2022
                </li>
                <li>
                    private project
                </li>
                <li>
                    Frontend
                </li>
                <li>
                    5h
                </li>
                <li>
                    Lorem ipsum dolor sit amet. Igmund das ist Lorems.
                </li>
                <li>
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
                    <button>
                        <img src="{{ asset('images/edit.png') }}">
                    </button>
                </li>
            </ul>

            <ul>
                <li>
                    30.10.2022
                </li>
                <li>
                    private project
                </li>
                <li>
                    Frontend
                </li>
                <li>
                    5h
                </li>
                <li>
                    Lorem ipsum 
                </li>
                <li>
                    <span class="tag">
                        CSS
                    </span>
                    <span class="tag">
                        HTML
                    </span>
                </li>
                <li class="last">
                    <button>
                        <img src="{{ asset('images/edit.png') }}">
                    </button>
                </li>
            </ul>

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
