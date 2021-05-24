<html lang="en">
<head>
    <title>Navarik - Zoo ! Have fun !</title>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="body-content">
    <div class="actions-wrapper">
        <span>Welcome to <span class="text-blue">Navarik Zoo!</span></span>
        <div>
            It's
            <b id="zoo-time" class="text-blue"> {{ str_pad($zoo['time'], 2, '0', STR_PAD_LEFT).':00' }}</b>
        </div>
    </div>
    <div class="zoo-wrapper">
        @foreach($zoo['animals'] as $key => $types)
            <div class="animal-type-wrapper">
                @foreach($types as $id => $animal)
                    <div class="animal-card">
                        <img src="{{ asset('/img/animals/'.strtolower($key).'.png') }}" class="image-animal" alt="{{$key}}">
                        <div class="secondary-text">
                            &#9734; {{ ucfirst(strtolower($key)).' '. ($id + 1) }} &#9734;
                        </div>
                        <div class="primary-text text-small">
                            Health <span id="health-{{$key.'-'.$id}}">{{ round($animal['health'] * 100) }}</span> %
                        </div>
                        <div class="secondary-text" id="state-{{$key.'-'.$id}}">
                            {{$animal['state']}}
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
    <div class="actions-wrapper">
        <button id="add-time" title="Simulates what will happen in the next hour">
            Next Hour!
        </button>
        <button class="btn-white" id="zoo-delete" title="Reset the health and state of the zoo!">
            Restart !
        </button>
        <button id="feed-animals">Feed Zoo!</button>
    </div>
</div>
<script src="{{ asset('js/scripts.js')  }}"></script>
</body>
</html>
