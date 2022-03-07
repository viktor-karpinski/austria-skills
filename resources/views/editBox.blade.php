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