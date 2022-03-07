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
            <br><br><br>
            <h2>
                Tags
            </h2>
            <div class="container">
            @php
            foreach($tags as $tag) {
                echo '<input type="checkbox" name="tags[]" value="' .$tag->id. '" id="tag-'.$tag->id.'" required>';
                echo '<label for="tag-'.$tag->id.'" class="check">'.$tag->name.'</label>';
            }
            @endphp
            </div>
            <p class="main-error">
                Please include all necessary input for an entry correctly!
            </p>
            <button type="submit" id="add-button">
                Add Entry
            </button>
        </form>
    </article>
</section>