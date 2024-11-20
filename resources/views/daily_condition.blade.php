<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cal-O-Lator</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/everyday_condition.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mt-5">Every day Condition</h1>
        <div class="row justify-content-center">
            <form>
                <div class="form-group">
                    <label for="icon">Today's Condition</label>
                    <select class="form-control" id="icon">
                        <option class="smile" value="smiley1" data-icon="{{ asset('images/img01.png') }}">
                            <img src="{{ asset('images/img01.png') }}" alt=""> Smiley 1
                        </option>
                        <option class="smile" value="smiley2" data-icon="{{ asset('images/img05.png') }}">
                            <img src="{{ asset('images/img05.png') }}" alt=""> Smiley 2
                        </option>
                        <option class="smile" value="smiley3" data-icon="{{ asset('images/img11.png') }}">
                            <img src="{{ asset('images/img11.png') }}" alt=""> Smiley 3
                        </option>
                        <option class="smile" value="smiley4" data-icon="{{ asset('images/img12.png') }}">
                            <img src="{{ asset('images/img12.png') }}" alt=""> Smiley 4
                        </option>
                        <option class="smile" value="smiley5" data-icon="{{ asset('images/img15.png') }}">
                            <img src="{{ asset('images/img15.png') }}" alt=""> Smiley 5
                        </option>
                        <!-- 他のアイコンも同様に追加 -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="weight">Weight (Kg)</label>
                    <input type="number" class="form-control" id="weight" placeholder="Enter your weight">
                </div>
                <div class="form-group">
                    <label for="diary">Diary</label>
                    <textarea class="form-control" id="diary" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="icon">Icon</label>
                    <select class="form-control" id="icon">
                        <option>Running</option>
                        <option>Cycling</option>
                        <option>Swimming</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea class="form-control" id="comment" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">OK</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </form>
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
