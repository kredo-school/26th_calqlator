@extends('layouts.everyday')

@section('title', 'Every day Condition')

@push('styles')
<link rel="stylesheet" href="{{ asset('/css/everyday_condition.style.css') }}">
@endpush

@section('content')
<div class="container mt-5 w-50">
    <h1 class="mt-5">Every day Condition</h1>
    <div class="row justify-content-center">
        <form action="{{route('condition.store',$date)}}" method="POST">
            @csrf
            <div class="form-group">
                <img src="{{ asset('images/goodjob.png') }}" alt="" class="icon-image"><label for="icon">Today's Condition</label>
                <select class="form-control col-3" id="smile" name="smile">
                    <option class="smile" value="1" >😀</option>
                    <option class="smile" value="2" >😏</option>
                    <option class="smile" value="3" >😐</option>
                    <option class="smile" value="4" >😷</option>
                    <option class="smile" value="5" >😴</option>
                    <!-- 他のアイコンも同様に追加 -->
                </select>
            </div>
            <div class="form-group">
                <label for="weight" class="weight-icon" >Weight (Kg)<img src="{{ asset('images/weight.png') }}" alt="" class="icon-image"></label>
                <input type="number" class="form-control col-3" step="0.01" id="weight" name="weight" data-toggle="modal" data-target="#calculatorModal">
            </div>
            <div class="form-group">
                <img src="{{ asset('images/pen.png') }}" alt="" class="icon-image">Diary
            </div>
            <div class="form-group">
                <label for="icon">Icon</label>
                <select class="form-control col-3" id="icon" name="icon">
                    <option value="1">🏃</option>
                    <option value="2">🏃‍♀️</option>
                    <option value="3">🚴</option>
                    <option value="4">🤺</option>
                    <option value="5">⛷️</option>
                    <option value="6">🏂</option>
                    <option value="7">🏌</option>
                    <option value="8">🏄</option>
                    <option value="9">🏊</option>
                    <option value="10">🏕️</option>
                    <option value="11">🏥</option>
                    <option value="12">🗽</option>
                    <option value="13">♨ </option>
                    <option value="14">🎡</option>
                    <option value="15">🚂</option>
                    <option value="16">🚗</option>
                    <option value="17">✈</option>
                    <option value="18">☃</option>
                    <option value="19">🐶</option>
                    <option value="20">🎶</option>
                </select>
            </div>
            <div class="form-group-1">
                <label for="comment">Comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            </div>
            <form action="views\users\calendar.blade.php" method="POST">
                @csrf
            <div class="button-group">
                <button type="reset" class="btn btn-success ">Cancel</button>
                <button type="submit" class="btn btn-warning ok">OK</button>
            </div>
        </form>
    </div>
</div>

<!-- モーダルの追加 -->
<div class="modal fade" id="calculatorModal" tabindex="-1" role="dialog" aria-labelledby="calculatorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="calculatorModalLabel"><img src="{{ asset('images/apple.png') }}" alt="" class="icon-image">Calculator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <!-- 電卓の内容をここに追加 -->
                <div id="calculator">
                    <input type="text" id="calc-display" class="form-control mb-3" readonly>
                    <button type="button" class="btn btn-success">7</button>
                    <button type="button" class="btn btn-success">8</button>
                    <button type="button" class="btn btn-success">9</button>
                    <button type="button" class="btn btn-success">/</button>
                    <button type="button" class="btn btn-success">4</button>
                    <button type="button" class="btn btn-success">5</button>
                    <button type="button" class="btn btn-success">6</button>
                    <button type="button" class="btn btn-success">*</button>
                    <button type="button" class="btn btn-success">1</button>
                    <button type="button" class="btn btn-success">2</button>
                    <button type="button" class="btn btn-success">3</button>
                    <button type="button" class="btn btn-success">-</button>
                    <button type="button" class="btn btn-success">0</button>
                    <button type="button" class="btn btn-success">.</button>
                    <button type="button" class="btn btn-success">=</button>
                    <button type="button" class="btn btn-success">+</button>
                    <button type="button" class="btn btn-success">C</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning" id="calc-confirm">OK</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#icon option').each(function() {
            var iconUrl = $(this).attr('data-icon');
            if (iconUrl) {
                $(this).html('<img src="' + iconUrl + '" style="width: 20px; height: 20px; vertical-align: middle;"> ' + $(this).text());
            }
        });

        // 電卓の機能を追加
        var calcDisplay = $('#calc-display');
        var calcValue = '';

        $('#calculator button').on('click', function() {
            var btnValue = $(this).text();

            if (btnValue === '=') {
                try {
                    calcValue = eval(calcValue);
                } catch (e) {
                    calcValue = 'Error';
                }
            } else if (btnValue === 'C') {
                calcValue = '';
            } else {
                calcValue += btnValue;
            }

            calcDisplay.val(calcValue);
        });

        // 決定ボタンの機能を追加
        $('#calc-confirm').on('click', function() {
            $('#weight').val(calcDisplay.val());
            $('#calculatorModal').modal('hide');
        });
    });
</script>
@endpush