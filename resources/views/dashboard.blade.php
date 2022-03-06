@extends('master')

@section('content')

<header>
    <button id="add-new">
        <span>
            +
        </span>
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

<section id="main">
    <aside>
        <div class="side-box"></div>
        <div class="side-box"></div>
        <div class="side-box"></div>
        <div class="side-box"></div>
    </aside>

    <article>
        <ul>
            <li>
                DATE 
                <span></span>
            </li>
             <li>
                TYPE 
                <span></span>
            </li>
             <li>
                CATEGORY 
                <span></span>
            </li>
             <li>
                TIME 
                <span></span>
            </li>
             <li>
                NOTES 
                <span></span>
            </li>
             <li>
                TAGS 
                <span></span>
            </li>
            <li>

            </li>
        </ul>
         <ul>
            <li>
                placeholder 
            </li>
             <li>
                placeholder 
            </li>
             <li>
                placeholder 
            </li>
             <li>
                placeholder 
            </li>
             <li>
                placeholder 
            </li>
             <li>
                placeholder 
            </li>
            <li>
                
            </li>
        </ul>
    </article>
</section>

@endsection
