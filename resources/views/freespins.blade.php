@extends('layout')

@section('title')
    {{ $user->username }} Freespins
@endsection

@section('content')

    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="col-md-15 mx-auto">
                <div class="card d-flex justify-content-center align-items-center">
                    <div class="m-3 btn-group-vertical btn-block">
                        {!! Form::open(['route' => ['freespins.generateNewLink', $user->link], 'method' => 'delete']) !!}
                        <button type="submit" class="btn btn-info mb-2">Generate new link</button>
                        {!! Form::close() !!}
                        <button type="button" class="btn btn-info mb-2" id="feelingLuckyBtn">IM FELLING LUCKY</button>
                        <button type="button" id="showPopup" class="btn btn-info mb-2">History</button>
                        {!! Form::open(['route' => ['freespins.deactivateLink', $user->link], 'method' => 'delete']) !!}
                        <button type="submit" class="btn btn-secondary">Deactivate current link</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div id="popup" class="popup">
            <div class="popup-content">
                <span class="close">&times;</span>
                <p>History</p>
                <table class="table table-borderless">
                    <tbody>
                    @foreach($user->freespins as $freespin)
                        <tr>
                            <td>{{ $freespin->spin_number }}</td>
                            <td>{{ $freespin->gain }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#feelingLuckyBtn").click(function(){
                var randomNumber = Math.floor(Math.random() * 1000) + 1;
                var result = (randomNumber % 2 === 0) ? "Win" : "Lose";
                var winAmount;
                if (result === "Win") {
                    if (randomNumber > 900) {
                        winAmount = randomNumber * 0.7;
                    } else if (randomNumber > 600) {
                        winAmount = randomNumber * 0.5;
                    } else if (randomNumber > 300) {
                        winAmount = randomNumber * 0.3;
                    } else {
                        winAmount = randomNumber * 0.1;
                    }
                } else {
                    winAmount = 0;
                }


                $.ajax({
                    url: "/freespins/store",
                    method: 'post',
                    dataType: 'html',
                    data: {
                        user_id: {{ $user->id }},
                        spin_number: randomNumber,
                        gain: winAmount
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        console.log("Response:", data);
                    }
                });



                alert("Random number: " + randomNumber + "\nResult: " + result + "\nWin amount: $" + winAmount.toFixed(2));
            });
        });

        document.getElementById('showPopup').addEventListener('click', function() {
            document.getElementById('popup').style.display = 'block';
        });

        document.querySelector('.close').addEventListener('click', function() {
            document.getElementById('popup').style.display = 'none';
        });
    </script>


@endsection
