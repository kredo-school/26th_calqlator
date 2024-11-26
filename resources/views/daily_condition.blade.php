<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cal-O-Lator</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/css/everyday_condition.style.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container mt-5">
        <h1 class="mt-5">Every day Condition</h1>
        <div class="row justify-content-center">
            <form>
                <div class="form-group">
                    <img src="{{ asset('images/goodjob.png') }}" alt="" class="icon-image"><label for="icon">Today's Condition</label>
                    <select class="form-control col-3" id="icon">
                        <option class="smile" value="smiley1" >😀</option>
                        <option class="smile" value="smiley2" >😏</option>
                        <option class="smile" value="smiley3" >😐</option>
                        <option class="smile" value="smiley4" >😷</option>
                        <option class="smile" value="smiley5" >😴</option>
                        <!-- 他のアイコンも同様に追加 -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="weight" class="weight-icon" >Weight (Kg)</label><img src="{{ asset('images/weight.png') }}" alt="" class="icon-image"><label for="icon">
                    <input type="number" class="form-control col-4" id="weight" placeholder="50" data-toggle="modal" data-target="#calculatorModal">
                </div>
                <div class="form-group">
                    <img src="{{ asset('images/pen.png') }}" alt="" class="icon-image"><label for="diary">Diary</label>
                </div>
                <div class="form-group">
                    <label for="icon">Icon</label>
                    <select class="form-control col-3" id="icon">
                        <option>🏃</option>
                        <option>🏃‍♀️</option>
                        <option>🚴</option>
                        <option>🤺</option>
                        <option>⛷️</option>
                        <option>🏂</option>
                        <option>🏌</option>
                        <option>🏄</option>
                        <option>🏊</option>
                        <option>🏕️</option>
                        <option>🏥</option>
                        <option>🗽</option>
                        <option>♨ </option>
                        <option>🎡</option>
                        <option>🚂</option>
                        <option>🚗</option>
                        <option>✈</option>
                        <option>☃</option>
                        <option>🐶</option>
                        <option>🗽</option>
                        <option>🎶</option>
                    </select>
                </div>
                <div class="form-group-1">
                    <label for="comment">Comment</label>
                    <textarea class="form-control" id="comment" rows="3"></textarea>
                </div>
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
                        <span aria-hidden="true">×</span>
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

    <script src="js/app.js"></script>
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
</body>
</html>

